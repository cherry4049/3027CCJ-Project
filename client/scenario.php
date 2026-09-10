<?php

/*
    REUSABLE DECISION / SCENARIO SCREEN

    IMPORTANT:


    The decision number is passed through the URL.

    Example:

        scenario.php?decision=1

        scenario.php?decision=2

        scenario.php?decision=3


    This means we can duplicate the decision
    structure without creating lots of PHP files.

*/


$pageTitle = 'Training Scenario';


/*
    Get the decision number from the URL.

    If no number is provided, start at Decision 1.
*/

$decision = isset($_GET['decision'])
    ? (int) $_GET['decision']
    : 1;


/*
    Number of decisions in the scenario.

    This can easily be changed later.
*/

$totalDecisions = 3;


/*
    Calculate the next decision number.
*/

$nextDecision = $decision + 1;


include 'includes/header.php';

?>

<section class="screen training-screen scenario-screen">


    <!-- TRAINING SCENARIO-->

    <div class="training-label">

        Training Scenario

    </div>


    <!-- CALL TIMER-->

    <!--
        Placeholder only.

        JavaScript can make this a real timer later.
    -->

    <div class="call-timer">

        📞 00:15 &nbsp;&nbsp; ...............

    </div>


    <!--  DECISION NUMBER -->

    <div class="progress">

        Decision

        <?php echo $decision; ?>

        of

        <?php echo $totalDecisions; ?>

    </div>


    <!-- CALLER MESSAGE -->

    <div class="message-bubble caller-message">

        <strong>
            🔊 Caller:
        </strong>

        <p>

            "Script Response"

        </p>

    </div>


    <!-- DECISION QUESTION -->

    <h2>
        What would you do?
    </h2>


    <!-- RESPONSE OPTIONS -->

    <div class="response-buttons">


        <?php if ($decision < $totalDecisions): ?>


            <!-- RESPONSE 1 -->

            <a
                href="scenario.php?decision=<?php echo $nextDecision; ?>"
                class="response-button"
            >

                Response Option 1

            </a>


            <!-- RESPONSE 2 -->

            <a
                href="scenario.php?decision=<?php echo $nextDecision; ?>"
                class="response-button"
            >

                Response Option 2

            </a>


            <!-- RESPONSE 3 -->

            <a
                href="scenario.php?decision=<?php echo $nextDecision; ?>"
                class="response-button"
            >

                Response Option 3

            </a>


        <?php else: ?>


            <a
                href="reflection.php"
                class="response-button"
            >

                Continue to Reflection

            </a>


        <?php endif; ?>


    </div>


    <!-- BACK BUTTON -->

    <div class="button-group">


        <?php if ($decision > 1): ?>


            <!--
                Go back to the previous decision.
            -->

            <a
                href="scenario.php?decision=<?php echo $decision - 1; ?>"
                class="button secondary-button"
            >

                Back

            </a>


        <?php else: ?>


            <!--
                Decision 1 goes back to the
                incoming call.
            -->

            <a
                href="incoming-call.php"
                class="button secondary-button"
            >

                Back

            </a>


        <?php endif; ?>


    </div>


</section>


<?php

include 'includes/footer.php';

?>