<?php

$pageTitle = 'Instructions';

include 'includes/header.php';

?>

<section class="screen non-call-layout instructions-screen">

    <!-- HEADING -->

    <div class="non-call-title">
        How This Training Works
    </div>


    <!-- COACH -->

    <div class="coach-introduction">

        <img
            src="assets/images/coach.png"
            alt="Training coach"
            class="coach-image"
        >

        <div class="coach-text">

            <strong>🔊</strong>

            "Before we begin, I will explain
            how this training works..."

        </div>

    </div>


    <!-- AUDIO -->

    <a
        href="#"
        class="audio-link"
        id="listen-instructions"
    >
        ▶ Listen to instructions
    </a>


    <hr>


    <!-- TRAINING EXPLANATION -->

    <h2>
        During this training:
    </h2>


    <ul class="instructions-list">

        <li>
            ✓ Listen carefully to the caller
        </li>

        <li>
            ✓ Choose how you would respond
        </li>

        <li>
            ✓ Think before taking action
        </li>

        <li>
            ✓ Learn from your choices and feedback
        </li>

    </ul>


    <!-- FAMILY VOICE INFORMATION -->

    <div class="message-bubble coach-message">

        <div class="coach-text">

            <strong>
                Using a Family Member's Voice
            </strong>

            <p>
                This training may also use the
                voice of a participating family
                member.
            </p>

            <p>
                The scenario works in the same
                way, but hearing a familiar voice
                can make an impersonation attempt
                feel more convincing.
            </p>

            <p>
                Even when a caller sounds exactly
                like someone you know, you should
                still stop, think and independently
                verify who you are speaking to.
            </p>

        </div>

    </div>


    <!-- CONTINUE / EXIT BUTTONS -->

    <div class="non-call-buttons">

        <!-- CONTINUE -->

        <a
            href="incoming-call.php"
            class="button primary-button"
        >

            <span class="button-icon">▶</span>

            Continue

        </a>


        <!-- EXIT -->

        <a
            href="index.php"
            class="button secondary-button"
        >

            Exit

        </a>

    </div>

</section>

<script>
const INSTRUCTION_API =
    '/api/caller-turn.php';

let instructionsAudio = null; 

//Load the instructions audio
async function loadInstructionsAudio() {

    // Use the existing Audio object if already loaded.
    if (instructionsAudio) {
        return instructionsAudio;
    }

    try {
        const response = await fetch(
            `${INSTRUCTION_API}?action=intro&page=instructions`            
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
                'Unable to load instructions audio.'
            );
        }

        const audioUrl =
            result.narration &&
            result.narration.instructions &&
            result.narration.instructions.audioUrl;
        
        if (!audioUrl) {
            throw new Error(
                'Instructions audio URL was not returned.'
            );
        }

        instructionsAudio =
            new Audio(audioUrl);

        return instructionsAudio;
    }
    catch (error) {
        console.error(
            'Instructions audio error:',
            error
        );

    return null;
    }
}

// Play the instructions audio if it is not already playing. 
async function playInstructionsAudio() {
    const audio =
        await loadInstructionsAudio();

    if (!audio) {
        return;
    }

    // do nothing if the audio is already playing.
    if (!audio.paused && !audio.ended) {
        return;
    }

    try {
        await audio.play();
    }
    catch (error) {
        console.warn(
            'Instructions audio could not autoplay:',
            error
        );
    }
}

// page loaded.
document.addEventListener(
    'DOMContentLoaded',
    function() {
        const listenButton =
            document.getElementById(
                'listen-instructions'
            );

        // try to autoplay when the page first loads.
        playInstructionsAudio();

        // if the browser blocked autoplay, start audio on the first user interaction with the page.
        const startAfterInteraction = function() {
            playInstructionsAudio();
            
            document.removeEventListener(
                'click',
                startAfterInteraction
            );
            
            document.removeEventListener(
                'keydown',
                startAfterInteraction
            );
            
            document.removeEventListener(
                'touchstart',
                startAfterInteraction
            );
        };

        document.addEventListener(
            'click',
            startAfterInteraction
        );
        
        document.addEventListener(
            'keydown',
            startAfterInteraction
        );
        
        document.addEventListener(
            'touchstart',
            startAfterInteraction
        );

        // if the user clicks "▶ Listen to instructions" link,
        // play only if audio is not already playing.            
        if (listenButton) {
            listenButton.addEventListener(
                'click',
                function(event) {
                    event.preventDefault();
                
                playInstructionsAudio();
                }
            );
        }
    }
);

</script>


<?php

include 'includes/footer.php';

?>