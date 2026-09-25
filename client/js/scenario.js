const API_URL = '/api/caller-turn.php';

let currentDecision = 1;
let currentCallerText = '';

/*
    CURRENT CALLER AUDIO

    Only one caller audio file should play
    at a time.
*/

let callerAudio = null;

/*
    API REQUEST
*/


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

/*
    PLAY CALLER AUDIO

    Stops any previous caller audio before playing the new turn.
*/

function playCallerAudio(audioUrl) {

    /*
        Stop the previous audio.
    */

    if (callerAudio) {

        callerAudio.pause();

        callerAudio.currentTime = 0;

    }


    /*
        No audio URL was supplied.
    */

    if (!audioUrl) {

        console.warn(
            'No caller audio URL was provided.'
        );

        return;

    }


    /*
        Create the audio for this caller turn.
    */

    callerAudio =
        new Audio(audioUrl);


    /*
        Try to play automatically.
    */

    callerAudio.play()
        .catch(function(error) {

            console.warn(
                'Caller audio autoplay was blocked:',
                error
            );

        });

}


/*
    START SERVER SCENARIO
*/

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

/*
    DISPLAY CALLER TURN
*/

function displayTurn(turn) {
    console.log('API TURN:', turn);

    const callerMessage = document.querySelector('.caller-message');
    const responseContainer = document.querySelector('.response-buttons');
    const progress = document.querySelector('.progress');

    /*
        Display caller message.
    */
    if (callerMessage) {
        callerMessage.innerHTML = `
            <strong>🔊 Caller:</strong>
            <p>${turn.text}</p>
        `;
    
        currentCallerText = turn.text;
    }
   
    /*
        Update decision progress.
    */
    if (progress) {
        progress.textContent =
            `Decision ${currentDecision} of 9`;
    }     
    
    /*
        Play the audio for this
        caller turn.
    */

    playCallerAudio(
        turn.audioUrl
    );


    /*
        Create response buttons.
    */
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


/*
    SUBMIT USER RESPONSE
*/

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

        /*
            If the call has ended, stop the caller audio.
        */

        if (result.callEnded) {

            if (callerAudio) {

                callerAudio.pause();

                callerAudio.currentTime = 0;

            }

            const responseContainer = document.querySelector('.response-buttons');

            if (responseContainer) {
                responseContainer.innerHTML = '';
                responseContainer.style.display = 'none';
            }

            window.location.href = 'reflection.php';
            return;
        }

        /*
            Move to the next decision.
        */
        currentDecision++;
        
        displayTurn(result.nextTurn);

    } catch (error) {
        console.error('Response error:', error);
        alert('Unable to submit your response. Please try again.');
    }
}

/*
    PAGE LOADED
*/

document.addEventListener(
    'DOMContentLoaded',
    function() {

        startServerScenario();


        /*
            If autoplay is blocked, try to start
            the current caller audio after the
            user's first interaction.
        */

        const startAudioAfterInteraction =
            function() {

                if (
                    callerAudio &&
                    callerAudio.paused
                ) {

                    callerAudio.play()
                        .catch(function() {});

                }

                document.removeEventListener(
                    'click',
                    startAudioAfterInteraction
                );

                document.removeEventListener(
                    'keydown',
                    startAudioAfterInteraction
                );

                document.removeEventListener(
                    'touchstart',
                    startAudioAfterInteraction
                );

            };


        document.addEventListener(
            'click',
            startAudioAfterInteraction
        );

        document.addEventListener(
            'keydown',
            startAudioAfterInteraction
        );

        document.addEventListener(
            'touchstart',
            startAudioAfterInteraction
        );

    }
);