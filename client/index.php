<?php

$pageTitle = 'Home';

include 'includes/header.php';

?>

<section class="screen non-call-layout home-screen">


    <!-- LOGO -->

    <div class="home-logo">

        <img
            src="assets/images/icon.jpg"
            alt="Beat the Scammer logo"
        >

    </div>


    <!-- APP TITLE-->

    <div class="non-call-title">

        AI Scam Awareness<br>
        Training Application

    </div>


    <!-- COACH INTRODUCTION-->

    <div class="coach-introduction">


        <!-- Actual coach PNG -->

        <img
            src="assets/images/coach.png"
            alt="Training coach"
            class="coach-image"
        >


        <!-- Coach message -->

        <div class="coach-text">

            <button
                type="button"
                class="audio-replay-button"
                id="home-audio-button"
                aria-label="Replay coach introduction"
            >▶</button>

            "Welcome! I will help you practise
            recognising scam calls safely."

        </div>

    </div>


    <!-- START TRAINING-->

    <div class="non-call-buttons">

        <!--
            Takes the user to the Instructions screen.
        -->

        <a
            href="instructions.php"
            class="button primary-button"
        >

            <span class="button-icon">▶</span>

            Start Training

        </a>


        <!-- HOW IT WORKS -->

        <!--
            For now, this also goes to Instructions.

            We can make a separate How It Works screen
            later if required.
        -->

        <a
            href="family-voice.php"
            class="button secondary-button"
        >

            <span class="button-icon">ⓘ</span>

            Family Voice Training

        </a>

    </div>

</section>


<script>

const HOME_API = '/api/caller-turn.php';

let homeAudio = null;


/*
    LOAD HOME AUDIO
*/

async function loadHomeAudio() {

    if (homeAudio) {
        return homeAudio;
    }

    try {

        const response =
            await fetch(
                `${HOME_API}?action=intro&page=home`
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
                'Unable to load home audio.'
            );

        }


        if (
            result.narration &&
            result.narration.home &&
            result.narration.home.audioUrl
        ) {

            homeAudio =
                new Audio(
                    result.narration.home.audioUrl
                );

            return homeAudio;

        }


        throw new Error(
            'Home audio URL was not returned.'
        );

    }
    catch (error) {

        console.error(
            'Home audio error:',
            error
        );

        return null;

    }

}


/*
    PLAY HOME AUDIO
*/

async function playHomeAudio() {

    const audio =
        await loadHomeAudio();


    if (!audio) {
        return;
    }


    /*
        Stop the current audio
        and restart from the beginning.
    */

    audio.pause();

    audio.currentTime = 0;


    audio.play().catch(
        function(error) {

            console.warn(
                'Home audio could not play:',
                error
            );

        }
    );

}


/*
    PAGE LOADED
*/

document.addEventListener(
    'DOMContentLoaded',
    async function() {

        const audioButton =
            document.getElementById(
                'home-audio-button'
            );


        /*
            Keep automatic audio playback.
        */

        const audio =
            await loadHomeAudio();


        if (audio) {

            audio.play().catch(
                function(error) {

                    console.warn(
                        'Home audio could not autoplay:',
                        error
                    );

                }
            );

        }


        /*
            Replay audio from the beginning
            when the user presses ▶.
        */

        if (audioButton) {

            audioButton.addEventListener(
                'click',
                playHomeAudio
            );

        }

    }
);

</script>


<?php

include 'includes/footer.php';

?>