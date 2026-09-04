<!-- Incoming call screen for the scam-call simulation. -->
<?php

$pageTitle = 'Incoming Call';

include 'includes/header.php';

?>

<section class="screen incoming-call-screen">
    <div class="phone-icon">
        📞
    </div>

    <h2>Incoming Call</h2>

    <p class="caller-name">
        Unknown Number
    </p>

    <!--
    Placeholder description.

    The actual scenario/caller information
    can be added later.
    -->

    <p>
        Someone is calling you claiming to be a family member.
    </p>

    <div class="button-group">

        <a
            href="instructions.php"
            class="button secondary-button"
        >
            Back to Instructions
        </a>

        <a
            href="scenario.php?decision=1"
            class="button primary-button"
        >
            Answer Call
        </a>
    </div>

</section>

<?php

include 'includes/footer.php';

?>

