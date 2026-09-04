<!-- Instructions page for explaining how the training application works. -->
<?php

$pageTitle='Instructions';

include 'includes/header.php';
?>

<!--
    INSTRUCTIONS SCREEN

    This screen explains how the game works before
    the user starts the simulated scam.
-->

<section class="screen">
    <h2>How to Play</h2>

    <p>
        You will recieve a simulated phone call.
    </p>

    <p>
        Listen carefully to what the caller says.
    </p>

    <p>
        At different points, you will need to decide how you would respond.
    </p>

    <div class="button-group">
        <a
            href="index.php"
            class="button secondary-button"
        >
            Back
        </a>

        <a
            href="incoming-call.php"
            class="button primary-button"
        >
            Continue
        </a>
    </div>
</section>

<?php
include 'includes/footer.php';
?>
