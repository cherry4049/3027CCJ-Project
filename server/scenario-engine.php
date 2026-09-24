<?php
// Handles one training call: starting the scenario, working out what the
// caller says next, and deciding the final result.
// There is no database. The current run is kept in $_SESSION and is gone
// when the session ends.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function bts_config()
{
    static $config = null;

    if ($config === null) {
        $config = require __DIR__ . '/scenario-config.php';
    }

    return $config;
}

function bts_get_scenario($scenarioId)
{
    foreach (bts_config()['scenarios'] as $scenario) {
        if ($scenario['scenarioId'] === $scenarioId) {
            return $scenario;
        }
    }

    return null;
}

function bts_audio_url($filename)
{
    if (empty($filename)) {
        return null;
    }

    return bts_config()['audioBasePath'] . $filename;
}

function bts_get_run()
{
    return isset($_SESSION['bts_run']) ? $_SESSION['bts_run'] : null;
}

function bts_intro()
{
    $narration = bts_config()['narration'];

    foreach ($narration as $key => $block) {
        $narration[$key]['audioUrl'] = bts_audio_url($block['audioFile']);
    }

    $scenarios = [];

    foreach (bts_config()['scenarios'] as $scenario) {
        $scenarios[] = [
            'scenarioId' => $scenario['scenarioId'],
            'title' => $scenario['title'],
            'summary' => $scenario['summary'],
            'caller' => $scenario['caller'],
        ];
    }

    return ['narration' => $narration, 'scenarios' => $scenarios];
}

// Builds one caller turn to send to the front end.
// Only the label of each response is sent, not its rating.
function bts_build_turn($scenario, $nodeId)
{
    $node = $scenario['nodes'][$nodeId];
    $responses = [];

    foreach ($node['responseIds'] as $responseId) {
        $responses[] = [
            'responseId' => $responseId,
            'label' => $scenario['nodes'][$responseId]['label'],
        ];
    }

    return [
        'nodeId' => $nodeId,
        'caller' => $scenario['caller'],
        'text' => $node['text'],
        'audioUrl' => bts_audio_url($node['audioFile']),
        'responses' => $responses,
        'endsCall' => count($responses) === 0,
    ];
}

function bts_start($scenarioId = '')
{
    if ($scenarioId === '') {
        $scenario = bts_config()['scenarios'][0];
    } else {
        $scenario = bts_get_scenario($scenarioId);
    }

    if ($scenario === null) {
        throw new InvalidArgumentException('Unknown scenario: ' . $scenarioId);
    }

    $_SESSION['bts_run'] = [
        'scenarioId' => $scenario['scenarioId'],
        'currentNodeId' => $scenario['startNodeId'],
        'unsafeCount' => 0,
        'reflection' => null,
        'decisions' => [],
    ];

    return [
        'scenarioId' => $scenario['scenarioId'],
        'title' => $scenario['title'],
        'turn' => bts_build_turn($scenario, $scenario['startNodeId']),
    ];
}

function bts_respond($responseId)
{
    $run = bts_get_run();

    if ($run === null || $run['currentNodeId'] === null) {
        throw new RuntimeException('No training call in progress.');
    }

    $scenario = bts_get_scenario($run['scenarioId']);
    $currentTurn = $scenario['nodes'][$run['currentNodeId']];

    // Only accept a response that was offered at this point in the call.
    if (!in_array($responseId, $currentTurn['responseIds'])) {
        throw new InvalidArgumentException('That response is not available at this point.');
    }

    $response = $scenario['nodes'][$responseId];

    if ($response['rating'] === 'UNSAFE') {
        $run['unsafeCount']++;
    }

    // Save this decision for the results screen.
    $run['decisions'][] = [
        'decision' => count($run['decisions']) + 1,
        'caller' => $currentTurn['text'],
        'response' => $response['label'],
        'choice' => $response['rating'],
        'feedback' => $response['coachFeedback'],
    ];

    $reply = [
        'userText' => $response['label'],
        'coachFeedback' => $response['coachFeedback'],
        'rating' => $response['rating'],
        'nextTurn' => null,
        'callEnded' => false,
    ];

    if ($response['nextNodeId'] === null) {
        $reply['callEnded'] = true;
        $run['currentNodeId'] = null;
    } else {
        $run['currentNodeId'] = $response['nextNodeId'];
        $reply['nextTurn'] = bts_build_turn($scenario, $response['nextNodeId']);

        if ($reply['nextTurn']['endsCall']) {
            $reply['callEnded'] = true;
            $run['currentNodeId'] = null;
        }
    }

    $_SESSION['bts_run'] = $run;

    return $reply;
}

function bts_reflection_question()
{
    $reflection = bts_config()['reflection'];
    $options = [];

    foreach ($reflection['options'] as $option) {
        $options[] = [
            'optionId' => $option['optionId'],
            'label' => $option['label'],
        ];
    }

    return [
        'question' => $reflection['question'],
        'audioUrl' => bts_audio_url($reflection['audioFile']),
        'options' => $options,
    ];
}

function bts_reflect($optionId)
{
    $run = bts_get_run();

    if ($run === null) {
        throw new RuntimeException('No training call in progress.');
    }

    foreach (bts_config()['reflection']['options'] as $option) {
        if ($option['optionId'] === $optionId) {
            $run['reflection'] = $optionId;
            $_SESSION['bts_run'] = $run;

            return [
                'isCorrect' => $option['isCorrect'],
                'feedback' => $option['feedback'],
                'audioUrl' => bts_audio_url($option['audioFile']),
            ];
        }
    }

    throw new InvalidArgumentException('Unknown reflection option: ' . $optionId);
}

function bts_result()
{
    $run = bts_get_run();

    if ($run === null) {
        throw new RuntimeException('No training call in progress.');
    }

    $scenario = bts_get_scenario($run['scenarioId']);

    // One unsafe response is enough to make the whole call unsafe.
    $outcome = $run['unsafeCount'] > 0 ? 'unsafe' : 'safe';
    $feedback = $scenario['feedback'][$outcome];

    // Count each type of response.
    $safeChoices = 0;
    $unsureChoices = 0;
    $unsafeChoices = 0;

    foreach ($run['decisions'] as $decision) {
        if ($decision['choice'] === 'SAFE') {
            $safeChoices++;
        } elseif ($decision['choice'] === 'UNSURE') {
            $unsureChoices++;
        } else {
            $unsafeChoices++;
        }
    }

    if ($unsafeChoices === 0 && $unsureChoices <= 2) {
        $overallResult = 'Strong scam awareness. You regularly used safer responses and avoided the highest-risk actions.';
    } elseif ($unsafeChoices <= 2) {
        $overallResult = "You recognised several warning signs, but there were some points where the caller's pressure influenced your decisions.";
    } else {
        $overallResult = "There were several points where the scammer's tactics influenced your decisions. Reviewing these choices can help you recognise similar scams in the future.";
    }

    if ($safeChoices >= 6) {
        $strengthFeedback = 'You frequently slowed the conversation down, questioned unusual requests and used verification strategies before taking action.';
    } elseif ($safeChoices >= 3) {
        $strengthFeedback = 'You recognised several suspicious parts of the call and made some strong attempts to verify what was happening.';
    } else {
        $strengthFeedback = 'You made some safer choices during the call. Building a habit of independently verifying urgent requests will make these responses stronger.';
    }

    if ($unsafeChoices === 0) {
        $improvementFeedback = 'You avoided the highest-risk responses. Continue using independent verification whenever someone unexpectedly asks for money or personal information.';
    } elseif ($unsafeChoices <= 2) {
        $improvementFeedback = 'At some points you were willing to trust the caller or continue following their instructions. Try to stop the interaction and verify the person independently before continuing.';
    } else {
        $improvementFeedback = 'Several responses allowed urgency, emotional pressure or familiarity to influence your decisions. In a real situation, stop before sending money and contact the person using details you already trust.';
    }

    if ($run['reflection'] === 'yes') {
        $reflectionSummary = 'You correctly identified the call as an AI impersonation scam.';
    } elseif ($run['reflection'] === 'notsure') {
        $reflectionSummary = 'You were unsure whether the caller was genuine. The call was an AI impersonation scam.';
    } elseif ($run['reflection'] === 'no') {
        $reflectionSummary = 'You believed the caller was really your daughter. The call was actually an AI impersonation scam.';
    } else {
        $reflectionSummary = 'No reflection answer was recorded.';
    }

    return [
        'scenarioId' => $run['scenarioId'],
        'title' => $scenario['title'],
        'outcome' => $outcome,
        'safeResponses' => $safeChoices,
        'unsureResponses' => $unsureChoices,
        'unsafeResponses' => $unsafeChoices,
        'overallResult' => $overallResult,
        'strengthFeedback' => $strengthFeedback,
        'improvementFeedback' => $improvementFeedback,
        'reflection' => $run['reflection'],
        'reflectionSummary' => $reflectionSummary,
        'decisions' => $run['decisions'],
        'text' => $feedback['text'],
        'audioUrl' => bts_audio_url($feedback['audioFile']),
        'warningSigns' => $feedback['warningSigns'],
        'reminders' => $feedback['reminders'],
    ];
}

function bts_reset()
{
    unset($_SESSION['bts_run']);
}
