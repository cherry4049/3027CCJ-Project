<?php


$pageTitle = 'Instructions';

include 'includes/header.php';

?>

<section class="screen instructions-screen">


    <!-- HEADING -->

    <h2>
        How This Training Works
    </h2>


    <!-- COACH-->

    <div class="coach-introduction">


        <!-- Actual coach PNG -->

        <img
            src="assets/images/coach.png"
            alt="Training coach"
            class="coach-image"
        >


        <!-- Coach instructions -->

        <div class="coach-text">

            <strong>🔊</strong>

            "Before we begin, I will explain
            how this training works..."

        </div>

    </div>


    <!-- AUDIO PLACEHOLDER -->
    <!--
        This will eventually link to an audio
        file inside assets/audio/.
    -->

    <a
        href="#"
        class="audio-link"
    >

        ▶ Listen to instructions

    </a>


    <hr>


    <!-- TRAINING RULES -->

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
            ✓ Listen carefully
        </li>

        <li>
            ✓ Think before you respond
        </li>

        <li>
            ✓ Learn from feedback
        </li>

    </ul>


    <!-- CONTINUE-->

    <a
        href="incoming-call.php"
        class="button primary-button"
    >

        <span class="button-icon">▶</span>

        Continue

    </a>


    <!--  EXIT-->

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