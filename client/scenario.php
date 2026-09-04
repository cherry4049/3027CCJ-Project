<!-- Main scenario page for presenting the simulated scam call and choices. -->

<?php

// Set the page title.
$pageTitle = 'Decision';


/*
    GET THE DECISION NUMBER

    The URL will contain something like:

        scenario.php?decision=1

    or:

        scenario.php?decision=2

    or:

        scenario.php?decision=3

    $_GET['decision'] gets that number from the URL.

    If no number is provided, we default to Decision 1.
*/
$decision = isset($_GET['decision'])
    ? (int) $_GET['decision']
    : 1;


/*
    NUMBER OF DECISIONS

    Used 3 decisions in basic structure

    This can easily be changed later.
*/
$totalDecisions = 3;


/*
    WORK OUT THE NEXT DECISION

    If the current decision is 1:

        $nextDecision = 2

    If the current decision is 2:

        $nextDecision = 3

    This allows the same screen to be reused.
*/
$nextDecision = $decision + 1;


include 'includes/header.php';

?>


<!--
    SCENARIO / DECISION SCREEN

    This is intentionally ONE PHP file.

-->
<section class="screen scenario-screen">


    <!--
        PROGRESS INDICATOR

        Shows the user where they are in the scenario.
    -->
    <div class="progress">

        Decision

        <?php echo $decision; ?>

        of

        <?php echo $totalDecisions; ?>

    </div>


    <!--
        CALLER SECTION

        This is where the caller's dialogue will
        eventually appear.
    -->
    <section class="caller-box">

        <!-- Placeholder phone icon -->
        <div class="caller-icon">
            📞
        </div>


        <h2>Caller</h2>


        <!--
            PLACEHOLDER
            The actual dialogue will be added later.
        -->
        <p>
            This is where the caller's dialogue
            will appear.
        </p>

    </section>


    <section class="decision-box">

        <h2>
            What would you do?
        </h2>

        <div class="response-buttons">


            <?php if ($decision < $totalDecisions): ?>


                <!--
                    RESPONSE OPTION 1

                    Just moves to the next decision for now
                -->
                <a
                    href="scenario.php?decision=<?php echo $nextDecision; ?>"
                    class="response-button"
                >
                    Response Option 1
                </a>


                <!-- Response Option 2 -->
                <a
                    href="scenario.php?decision=<?php echo $nextDecision; ?>"
                    class="response-button"
                >
                    Response Option 2
                </a>


                <!-- Response Option 3 -->
                <a
                    href="scenario.php?decision=<?php echo $nextDecision; ?>"
                    class="response-button"
                >
                    Response Option 3
                </a>


            <?php else: ?>


                <!--
                    FINAL DECISION

                    After Decision 3, the user moves
                    to the Reflection screen.
                -->
                <a
                    href="reflection.php"
                    class="response-button"
                >
                    Continue
                </a>


            <?php endif; ?>

        </div>

    </section>


    <!--
        BACK BUTTON

        If the user is on Decision 2 or 3,
        they go back to the previous decision.

        If they are on Decision 1,
        they return to the Incoming Call screen.
    -->
    <div class="button-group">


        <?php if ($decision > 1): ?>

            <a
                href="scenario.php?decision=<?php echo $decision - 1; ?>"
                class="button secondary-button"
            >
                Back
            </a>


        <?php else: ?>


            <!--
                Decision 1 goes back to
                the Incoming Call screen.
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