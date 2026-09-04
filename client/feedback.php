<?php

$pageTitle = 'Your Results';

include 'includes/header.php';

?>


<!--
    FEEDBACK / RESULTS SCREEN

    This is AFTER Reflection.

    Later this screen will automatically tell
    the user which decisions they got right and wrong.

-->
<section class="screen feedback-screen">


    <h2>Your Results</h2>


    <p>
        Here's how you went during the scenario.
    </p>


    <section class="results-box">


        <!-- Overall score -->
        <h3>Your Score</h3>

        <p>
            Your score will appear here.
        </p>


        <!--
            DECISION 1 RESULT

            Placeholder only.

            Later this will automatically say
            something like:

                ✓ Correct
                or
                ✗ Incorrect
        -->
        <div class="result-item">

            <h4>Decision 1</h4>

            <p>
                ✓ / ✗ Your result will appear here.
            </p>

        </div>


        <!-- Decision 2 result -->
        <div class="result-item">

            <h4>Decision 2</h4>

            <p>
                ✓ / ✗ Your result will appear here.
            </p>

        </div>


        <!-- Decision 3 result -->
        <div class="result-item">

            <h4>Decision 3</h4>

            <p>
                ✓ / ✗ Your result will appear here.
            </p>

        </div>

    </section>


    <!--
        NAVIGATION

        Back = Reflection

        Continue = Prevention Tips
    -->
    <div class="button-group">


        <a
            href="reflection.php"
            class="button secondary-button"
        >
            Back
        </a>


        <a
            href="prevention-tips.php"
            class="button primary-button"
        >
            Prevention Tips
        </a>

    </div>

</section>


<?php

include 'includes/footer.php';

?>