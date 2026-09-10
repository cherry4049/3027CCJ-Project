<?php


$pageTitle = 'Reflection';

include 'includes/header.php';

?>

<section class="screen non-call-layout call-screen">


    <!-- TRAINING LABEL-->

    <div class="training-label">

        Training Scenario

    </div>


    <!--CALL ENDED-->

    <div class="call-timer">

        🔴 Call ended

    </div>


    <!-- COACH QUESTION-->

    <div class="message-bubble coach-message">


        <div class="coach-introduction">


            <img
                src="assets/images/coach.png"
                alt="Training coach"
                class="coach-image"
            >


            <div class="coach-text">

                <strong>
                    Coach:
                </strong>

            </div>


        </div>


        <p>

            "Let's reflect on the call.
            Do you think this caller could be
            an AI impersonation scam?"

        </p>


    </div>



    <!-- COACH FEEDBACK PLACEHOLDER-->

    <div class="message-bubble coach-message">

        <strong>
            🔊 Coach feedback:
        </strong>

        <p>

            Your reflection feedback will
            appear here.

        </p>

    </div>


    <!-- FINAL RESULTS-->

    <div class="non-call-buttons">

        <a
            href="feedback.php"
            class="call-continue-button"
        >
            🔄 Final results...
        </a>

    </div>


</section>


<?php

include 'includes/footer.php';

?>