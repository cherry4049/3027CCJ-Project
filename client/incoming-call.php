<?php

$pageTitle = 'Incoming Call';

include 'includes/header.php';

?>

<section class="screen training-screen call-screen">

    <div class="training-label">
        TRAINING SCENARIO
    </div>

    <div class="incoming-call">

        <div class="phone-icon">
            ☎
        </div>

        <p class="incoming-text">
            Incoming call
        </p>

        <h1>
            Emily
        </h1>

        <p class="phone-number">
            0411 223 344
        </p>


        <!-- =========================================
            SWIPE TO ANSWER
            ========================================= -->

        <div
            class="swipe-container"
            id="swipe-to-answer"
        >

            <div
                class="swipe-track"
                id="swipe-track"
            >

                <div
                    class="swipe-handle"
                    id="swipe-handle"
                >
                    →
                </div>

                <span class="swipe-text">
                    Swipe to answer
                </span>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
    BACK TO INSTRUCTIONS
    ========================================= -->

<a
    href="instructions.php"
    class="back-to-instructions button primary-button"
>
    ← Back to Instructions
</a>


<script src="js/navigation.js"></script>

<script>

/*
    INCOMING CALL AUDIO

    1. Play the "Swipe to answer" audio once.
    2. When it finishes, start the ringing audio.
    3. Keep the ringing audio looping.
    4. Stop the ringing when the call is answered.
*/

const swipeAudio =
    new Audio(
        "assets/audio/IncomingCall_SwipeToAnswer.mp3"
    );

const ringingAudio =
    new Audio(
        "assets/audio/IncomingCall_Ringing.mp3"
    );


/*
    Ringing should repeat until the
    user successfully answers.
*/

ringingAudio.loop = true;


/*
    Start the incoming call audio.
*/

function startIncomingCallAudio() {

    /*
        Play the swipe instruction once.
    */

    swipeAudio.currentTime = 0;

    swipeAudio.play()
        .catch(function(error) {

            console.warn(
                "Incoming call autoplay was blocked:",
                error
            );

        });
}


/*
    When the swipe instruction finishes,
    start the ringing sound.
*/

swipeAudio.addEventListener(
    "ended",
    function() {

        ringingAudio.currentTime = 0;

        ringingAudio.play()
            .catch(function(error) {

                console.warn(
                    "Ringing autoplay was blocked:",
                    error
                );

            });

    }
);


/*
    If the browser blocks autoplay,
    start the appropriate audio after
    the first user interaction.
*/

function startAudioAfterInteraction() {

    /*
        If the swipe instruction has not
        finished yet, try playing it.
    */

    if (!swipeAudio.ended) {

        swipeAudio.play()
            .catch(function() {});

    }

    /*
        If the swipe instruction has already
        finished, try playing the ringing.
    */

    else if (ringingAudio.paused) {

        ringingAudio.play()
            .catch(function() {});

    }


    document.removeEventListener(
        "click",
        startAudioAfterInteraction
    );

    document.removeEventListener(
        "keydown",
        startAudioAfterInteraction
    );

    document.removeEventListener(
        "touchstart",
        startAudioAfterInteraction
    );

}


/*
    Try autoplay when the page loads.
*/

document.addEventListener(
    "DOMContentLoaded",
    function() {

        startIncomingCallAudio();


        /*
            Fallback for browsers that block
            autoplay.
        */

        document.addEventListener(
            "click",
            startAudioAfterInteraction
        );

        document.addEventListener(
            "keydown",
            startAudioAfterInteraction
        );

        document.addEventListener(
            "touchstart",
            startAudioAfterInteraction
        );

    }
);


/*
    Start the audio when the page is ready.
*/

startIncomingCallAudio();

</script>

<?php

include 'includes/footer.php';

?>