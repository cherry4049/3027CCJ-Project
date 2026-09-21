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
        'audioUrl' => bts_audio_url(isset($node['audioFile']) ? $node['audioFile'] : null),
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

    if (!in_array($responseId, $currentTurn['responseIds'])) {
        throw new InvalidArgumentException('That response is not available at this point.');
    }

    $response = $scenario['nodes'][$responseId];
    $nextNodeId = $response['nextNodeId'];

    $rating = $response['isSafe'] ? 'SAFE' : 'UNSAFE';
    
    if (!$response['isSafe']) {
        $run['unsafeCount'] = $run['unsafeCount'] + 1;
    }

    $reply = [
        'userText' => $response['text'],
        'coachFeedback' => $response['coachFeedback'],
        'rating' => $rating,
        'nextTurn' => null,
        'callEnded' => false,
    ];

    if ($nextNodeId === null) {
        $reply['callEnded'] = true;
        $run['currentNodeId'] = null;
    } else {
        $run['currentNodeId'] = $nextNodeId;
        $nextTurn = bts_build_turn($scenario, $nextNodeId);
        $reply['nextTurn'] = $nextTurn;

        
        if ($nextTurn['endsCall']) {
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

    $reflection = bts_config()['reflection'];

    foreach ($reflection['options'] as $option) {
        if ($option['optionId'] === $optionId) {
            $run['reflection'] = $optionId;
            $_SESSION['bts_run'] = $run;

            return [
                'isCorrect' => $option['isCorrect'],
                'feedback' => $option['feedback'],
                'audioUrl' => bts_audio_url($option['audioFile']),
                'nextText' => $reflection['nextText'],
                'nextAudioUrl' => bts_audio_url($reflection['nextAudioFile']),
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
    $outcome = $run['unsafeCount'] > 0 ? 'unsafe' : 'safe';
    $feedback = $scenario['feedback'][$outcome];

    return [
        'scenarioId' => $run['scenarioId'],
        'title' => $scenario['title'],
        'outcome' => $outcome,
        'unsafeResponses' => $run['unsafeCount'],
        'reflection' => $run['reflection'],
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
