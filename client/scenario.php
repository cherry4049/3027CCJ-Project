<?php

$pageTitle = 'Training Scenario';

include 'includes/header.php';

?>

<section class="screen training-screen scenario-screen">

    <!-- TRAINING SCENARIO -->

    <div class="training-label">
        Training Scenario
    </div>


    <!-- CALL TIMER -->

    <div
        class="call-timer"
        id="call-timer"
    >
        00:00
    </div>


    <!-- PROGRESS -->

    <div class="progress">
        Decision 1 of 9
    </div>


    <!-- CALLER MESSAGE -->

    <div class="message-bubble caller-message">

        <strong>
            🔊 Caller:
        </strong>

        <p>
            Loading caller...
        </p>

    </div>


    <!-- QUESTION -->

    <h2>
        What would you do?
    </h2>


    <!-- RESPONSE BUTTONS -->

    <div class="response-buttons">
        <!-- Response buttons are created by scenario.js -->
    </div>


    <!-- BACK BUTTON -->

    <div class="button-group">

        <a
            href="incoming-call.php"
            class="button secondary-button"
        >
            Back
        </a>

    </div>


</section>


<script src="/js/scenario.js"></script>


<?php

include 'includes/footer.php';

?>