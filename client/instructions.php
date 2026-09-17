<?php

$pageTitle = 'Instructions';

include 'includes/header.php';

?>

<section class="screen instructions-screen">


    <!-- HEADING -->

    <h2>
        How This Training Works
    </h2>


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


    <!-- AUDIO PLACEHOLDER -->

    <a
        href="#"
        class="audio-link"
    >
        ▶ Listen to instructions
    </a>


    <hr>


    <!-- TRAINING EXPLANATION -->

    <h2
        style="
            text-align: left;
            margin-top: 30px;
        "
    >
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


</section>


<?php

include 'includes/footer.php';

?>