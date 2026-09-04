<!-- Feedback page for collecting or displaying user reflection after the scenario. -->
<?php

$pageTitle = 'Reflection';

include 'includes/header.php';

?>


<section class="screen">

    <h2>Reflection</h2>


    <p>
        Think about the choices you made during
        the phone call.
    </p>


    <p>
        What warning signs did you notice?
    </p>


    <div class="button-group">


        <!--
            Back takes the user to the final decision.
        -->
        <a
            href="scenario.php?decision=3"
            class="button secondary-button"
        >
            Back
        </a>


        <!--
            Continue takes the user to the
            Feedback/Results screen.

            This is where they will eventually
            see what they got right and wrong.
        -->
        <a
            href="feedback.php"
            class="button primary-button"
        >
            See My Results
        </a>

    </div>

</section>


<?php

// Load the shared footer.
include 'includes/footer.php';

?>