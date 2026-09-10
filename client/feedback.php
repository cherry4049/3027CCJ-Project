<?php



$pageTitle = 'Final Results';

include 'includes/header.php';

?>

<section class="screen">


    <!--HEADING-->

    <h2>
        Final Results & Tips
    </h2>


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


        <h3>
            What you did right
        </h3>


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


        <h3>
            What you could improve
        </h3>


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

    <h3>
        Remember:
    </h3>


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

    <div class="button-group">


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