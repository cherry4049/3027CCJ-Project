<?php
// Serves the training call one turn at a time.
// The front end does not hold the branching or the correct answers. It
// asks this file what happens next and shows the reply.


require_once __DIR__ . '/scenario-engine.php';

header('Content-Type: application/json');


function bts_param($name)
{
    if (isset($_GET[$name])) {
        return trim($_GET[$name]);
    }

    static $body = null;

    if ($body === null) {
        $body = json_decode(file_get_contents('php://input'), true);

        if (!is_array($body)) {
            $body = [];
        }
    }

    return isset($body[$name]) ? trim($body[$name]) : '';
}

// Sends a JSON reply and stops.
function bts_send($data, $status = 200)
{
    http_response_code($status);
    echo json_encode($data);
    exit;
}

try {
    $action = bts_param('action');

    if ($action === 'intro') {
        bts_send(array_merge(['ok' => true], bts_intro()));
    }

    if ($action === 'start') {
        bts_send(array_merge(['ok' => true], bts_start(bts_param('scenarioId'))));
    }

    if ($action === 'respond') {
        bts_send(array_merge(['ok' => true], bts_respond(bts_param('responseId'))));
    }

    if ($action === 'reflection') {
        bts_send(array_merge(['ok' => true], bts_reflection_question()));
    }

    if ($action === 'reflect') {
        bts_send(array_merge(['ok' => true], bts_reflect(bts_param('optionId'))));
    }

    if ($action === 'result') {
        bts_send(array_merge(['ok' => true], bts_result()));
    }

    if ($action === 'reset') {
        bts_reset();
        bts_send(['ok' => true]);
    }

    bts_send(['ok' => false, 'error' => 'Unknown action: ' . $action], 400);

} catch (InvalidArgumentException $e) {
    
    bts_send(['ok' => false, 'error' => $e->getMessage()], 400);

} catch (Throwable $e) {
    
    bts_send(['ok' => false, 'error' => $e->getMessage()], 500);
}
