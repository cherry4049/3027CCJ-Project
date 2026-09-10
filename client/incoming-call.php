<?php

$pageTitle = 'Incoming Call';

include 'includes/header.php';

?>

<section class="screen call-screen">

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
            Caller Name
        </h1>

        <p class="phone-number">
            04XX XXX XXX
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


        <!-- =========================================
            BACK TO INSTRUCTIONS
            ========================================= -->

        <a
            href="instructions.php"
            class="back-to-instructions"
        >
            ← Back to Instructions
        </a>

    </div>

</section>


<script src="js/navigation.js"></script>


<?php

include 'includes/footer.php';

?>