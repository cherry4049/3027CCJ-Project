const API_URL = '/api/caller-turn.php';

let currentDecision = 1;
let currentCallerText = '';

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

        sessionStorage.removeItem(
            "callStartTime"
        );

        const result = await apiRequest('start', {
            scenarioId: 'scenario01'
        });
        
        currentDecision = 1;

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
    console.log('API TURN:', turn);

    const callerMessage = document.querySelector('.caller-message');
    const responseContainer = document.querySelector('.response-buttons');
    const progress = document.querySelector('.progress');

    if (callerMessage) {
        callerMessage.innerHTML = `
            <strong>🔊 Caller:</strong>
            <p>${turn.text}</p>
        `;
    
        currentCallerText = turn.text;
    }
   
    if (progress) {
        progress.textContent =
            `Decision ${currentDecision} of 9`;
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

        saveChoice(
            currentDecision,
            result.rating,
            result.userText,
            result.coachFeedback,
            currentCallerText
        );

        if (result.callEnded) {
            const responseContainer = document.querySelector('.response-buttons');

            if (responseContainer) {
                responseContainer.innerHTML = '';
                responseContainer.style.display = 'none';
            }

            window.location.href = 'reflection.php';
            return;
        }

        currentDecision++;
        
        displayTurn(result.nextTurn);

    } catch (error) {
        console.error('Response error:', error);
        alert('Unable to submit your response. Please try again.');
    }
}


document.addEventListener('DOMContentLoaded', () => {
    startServerScenario();
});