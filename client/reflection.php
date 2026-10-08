<?php

$pageTitle = 'Reflection';

include 'includes/header.php';

?>

<section class="screen non-call-layout call-screen">

    <!-- TRAINING LABEL -->

    <div class="training-label">
        Training Scenario
    </div>


    <!-- CALL ENDED -->

    <div class="call-timer">
        🔴 Call ended
    </div>


    <!-- COACH REFLECTION QUESTION -->

    <div class="message-bubble coach-message">

        <div class="coach-introduction">

            <img
                src="assets/images/coach.png"
                alt="Training coach"
                class="coach-image"
            >

            <div class="coach-text">

                <button
                    type="button"
                    class="audio-replay-button"
                    id="reflection-question-audio-button"
                    aria-label="Replay reflection question"
                >▶</button>

                <strong>
                    Coach:
                </strong>

            </div>

        </div>

        <p id="reflection-question">
            Loading reflection question...
        </p>

    </div>


    <!-- REFLECTION RESPONSE OPTIONS -->

    <div
        class="response-buttons"
        id="reflection-options"
    >

        <button
            type="button"
            class="response-button"
            onclick="submitReflection('yes')"
        >
            Yes, I think it was an AI impersonation scam.
        </button>

        <button
            type="button"
            class="response-button"
            onclick="submitReflection('notsure')"
        >
            I'm not sure. Some parts of the call seemed suspicious.
        </button>

        <button
            type="button"
            class="response-button"
            onclick="submitReflection('no')"
        >
            No, I think the caller was really my daughter.
        </button>

    </div>


    <!-- REFLECTION RESULT -->

    <div
        class="message-bubble coach-message"
        id="reflection-result"
        style="display: none;"
    >

        <div class="coach-introduction">

            <img
                src="assets/images/coach.png"
                alt="Training coach"
                class="coach-image"
            >

            <div class="coach-text">

                <button
                    type="button"
                    class="audio-replay-button"
                    id="reflection-result-audio-button"
                    aria-label="Replay reflection feedback"
                    style="display: none;"
                >▶</button>

                <strong>
                    Coach:
                </strong>

            </div>

        </div>

        <p id="reflection-result-text"></p>

    </div>


    <!-- CONTINUE TO FINAL RESULTS -->

    <div class="non-call-buttons">

        <a
            href="feedback.php"
            class="call-continue-button"
            id="final-results-button"
            style="display: none;"
        >
            Continue to Final Results
        </a>

    </div>

</section>


<script>

const REFLECTION_API = '/api/caller-turn.php';

let reflectionQuestionAudio = null;
let reflectionResultAudio = null;


/*
    STOP ALL REFLECTION AUDIO
*/

function stopReflectionAudio() {

    if (reflectionQuestionAudio) {

        reflectionQuestionAudio.pause();

        reflectionQuestionAudio.currentTime = 0;

    }


    if (reflectionResultAudio) {

        reflectionResultAudio.pause();

        reflectionResultAudio.currentTime = 0;

    }

}


/*
    LOAD REFLECTION QUESTION
*/

async function loadReflectionQuestion() {

    try {

        const response =
            await fetch(
                `${REFLECTION_API}?action=reflection`
            );


        if (!response.ok) {

            throw new Error(
                `Server returned ${response.status}`
            );

        }


        const result =
            await response.json();


        if (!result.ok) {

            throw new Error(
                result.error ||
                'Unable to load reflection.'
            );

        }


        document.getElementById(
            'reflection-question'
        ).textContent =
            result.question;


        /*
            Play the coach's reflection question
            automatically when the page loads.
        */

        if (result.audioUrl) {

            reflectionQuestionAudio =
                new Audio(
                    result.audioUrl
                );


            reflectionQuestionAudio.play().catch(
                function(error) {

                    console.warn(
                        'Reflection question audio could not autoplay:',
                        error
                    );

                }
            );

        }

    }
    catch (error) {

        console.error(
            'Reflection question error:',
            error
        );


        document.getElementById(
            'reflection-question'
        ).textContent =
            'Let\'s reflect on the call. Do you think this caller could be an AI impersonation scam?';

    }

}


/*
    REPLAY REFLECTION QUESTION AUDIO
*/

function replayReflectionQuestionAudio() {

    if (!reflectionQuestionAudio) {
        return;
    }


    /*
        Stop any reflection audio
        before replaying the question.
    */

    stopReflectionAudio();


    reflectionQuestionAudio.play().catch(
        function(error) {

            console.warn(
                'Reflection question audio could not replay:',
                error
            );

        }
    );

}


/*
    REPLAY REFLECTION RESULT AUDIO
*/

function replayReflectionResultAudio() {

    if (!reflectionResultAudio) {
        return;
    }


    /*
        Stop any reflection audio
        before replaying the result.
    */

    stopReflectionAudio();


    reflectionResultAudio.play().catch(
        function(error) {

            console.warn(
                'Reflection result audio could not replay:',
                error
            );

        }
    );

}


/*
    SUBMIT REFLECTION ANSWER
*/

async function submitReflection(optionId) {

    const options =
        document.getElementById(
            'reflection-options'
        );

    const resultBox =
        document.getElementById(
            'reflection-result'
        );

    const resultText =
        document.getElementById(
            'reflection-result-text'
        );

    const finalResultsButton =
        document.getElementById(
            'final-results-button'
        );


    try {

        /*
            Prevent multiple submissions.
        */

        options.style.display =
            'none';


        /*
            Stop all current reflection audio
            before requesting the result.
        */

        stopReflectionAudio();


        const response =
            await fetch(
                `${REFLECTION_API}?action=reflect&optionId=${encodeURIComponent(optionId)}`
            );


        if (!response.ok) {

            throw new Error(
                `Server returned ${response.status}`
            );

        }


        const result =
            await response.json();


        if (!result.ok) {

            throw new Error(
                result.error ||
                'Unable to submit reflection.'
            );

        }


        /*
            Save the reflection locally as well.
        */

        sessionStorage.setItem(
            'reflectionAnswer',
            optionId
        );


        /*
            Display server feedback.
        */

        resultText.textContent =
            result.feedback;


        resultBox.style.display =
            'block';


        /*
            Play reflection feedback audio
            if available.
        */

        if (result.audioUrl) {

            /*
                Stop any existing reflection
                audio before creating the result audio.
            */

            stopReflectionAudio();


            reflectionResultAudio =
                new Audio(
                    result.audioUrl
                );


            reflectionResultAudio.play().catch(
                function(error) {

                    console.warn(
                        'Reflection audio could not autoplay:',
                        error
                    );

                }
            );


            /*
                Show the replay button beside
                the Coach label.
            */

            const resultAudioButton =
                document.getElementById(
                    'reflection-result-audio-button'
                );


            if (resultAudioButton) {

                resultAudioButton.style.display =
                    'inline-block';


                resultAudioButton.onclick =
                    replayReflectionResultAudio;

            }

        }


        /*
            Show final results button.
        */

        finalResultsButton.style.display =
            'block';

    }
    catch (error) {

        console.error(
            'Reflection error:',
            error
        );


        /*
            Allow the user to try again
            if the API request failed.
        */

        options.style.display =
            'flex';


        alert(
            'Unable to submit your reflection. Please try again.'
        );

    }

}


/*
    PAGE LOADED
*/

document.addEventListener(
    'DOMContentLoaded',
    function() {

        loadReflectionQuestion();


        /*
            Connect the replay button for
            the reflection question.
        */

        const questionAudioButton =
            document.getElementById(
                'reflection-question-audio-button'
            );


        if (questionAudioButton) {

            questionAudioButton.addEventListener(
                'click',
                replayReflectionQuestionAudio
            );

        }

    }
);

</script>


<?php

include 'includes/footer.php';

?>