const API_URL = '../server/caller-turn.php';

async function apiRequest(action, data = {}) {
    const params = new URLSearchParams({
        action: action,
        ...data
    });

    const response = await fetch(`${API_URL}?${params.toString()}`);

    if (!response.ok) {
        throw new Error(`Server returned ${response.status}`);
    }

    const result = await response.json();

    if (!result.ok) {
        throw new Error(result.error || 'Something went wrong.');
    }

    return result;
}


async function startServerScenario() {
    try {
        const result = await apiRequest('start', {
            scenarioId: 'scenario01'
        });

        displayTurn(result.turn);

    } catch (error) {
        console.error('Scenario error:', error);

        const callerMessage = document.querySelector('.caller-message');

        if (callerMessage) {
            callerMessage.textContent =
                'Unable to load the training scenario. Please try again.';
        }
    }
}


function displayTurn(turn) {
    const callerName = document.querySelector('.caller-name');
    const callerNumber = document.querySelector('.caller-number');
    const callerMessage = document.querySelector('.caller-message');
    const responseContainer = document.querySelector('.response-options');

    if (callerName) {
        callerName.textContent = turn.caller.name;
    }

    if (callerNumber) {
        callerNumber.textContent = turn.caller.number;
    }

    if (callerMessage) {
        callerMessage.textContent = turn.text;
    }

    if (!responseContainer) {
        return;
    }

    responseContainer.innerHTML = '';

    turn.responses.forEach(response => {
        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'response-button';
        button.textContent = response.label;

        button.addEventListener('click', () => {
            submitResponse(response.responseId);
        });

        responseContainer.appendChild(button);
    });
}


async function submitResponse(responseId) {
    try {
        const result = await apiRequest('respond', {
            responseId: responseId
        });

        const decision = getCurrentDecision();

        saveChoice(
            decision,
            result.rating,
            result.userText,
            result.coachFeedback,
            result.nextTurn ? result.nextTurn.text : ''
        );

        if (result.callEnded) {
            window.location.href = 'reflection.php';
            return;
        }

        displayTurn(result.nextTurn);

    } catch (error) {
        console.error('Response error:', error);
        alert('Unable to submit your response. Please try again.');
    }
}


function getCurrentDecision() {
    const progress = document.querySelector('.decision-progress');

    if (!progress) {
        return 1;
    }

    const match = progress.textContent.match(/Decision\s+(\d+)\s+of/i);

    if (match) {
        return Number(match[1]);
    }

    return 1;
}


document.addEventListener('DOMContentLoaded', () => {
    startServerScenario();
});