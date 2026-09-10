<?php



$pageTitle = 'Final Results';

include 'includes/header.php';

?>

<section class="screen non-call-layout feedback-screen">


    <!--HEADING-->

    <div class="non-call-title">
        Final Results & Tips
    </div>


    <!-- COACH-->

    <div class="coach-introduction">


        <img
            src="assets/images/coach.png"
            alt="Training coach"
            class="coach-image"
        >


        <div class="coach-text">

            <strong>
                🔊 Coach speaking:
            </strong>

            <p>

                "Well done! You have completed
                this training scenario."

            </p>

        </div>

    </div>


    <!-- OVERALL FEEDBACK-->

    <div class="results-box">


        <h2>
            What you did right
        </h2>


        <div class="result-item result-correct">

            <h4>
                ✓ Correct decision
            </h4>

            <p>

                You recognised that the caller
                was creating urgency and asking
                for money.

            </p>

        </div>


        <h2>
            What you could improve:
        </h2>


        <div class="result-item result-incorrect">

            <h4>
                ✗ Needs improvement
            </h4>

            <p>

                Remember to verify the caller's
                identity before taking action.

            </p>

        </div>


    </div>


    <!-- REMEMBER-->

    <h2>
        Remember:
    </h2>


    <div class="tip">

        ✓ Stay calm.

    </div>


    <div class="tip">

        ✓ Verify the caller's identity.

    </div>


    <div class="tip">

        ✓ Never send money immediately.

    </div>


    <div class="tip">

        ✓ Contact the person using a trusted
        phone number.

    </div>


    <!-- RESTART / END -->

    <div class="non-call-buttons">


        <a
            href="index.php"
            class="button primary-button"
        >

            ↻ Restart

        </a>


        <a
            href="index.php"
            class="button secondary-button"
        >

            ✕ End Training

        </a>


    </div>


</section>


<?php

include 'includes/footer.php';

?>