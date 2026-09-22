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


<?php

include 'includes/footer.php';

?>