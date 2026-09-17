<?php

$pageTitle = 'Home';

include 'includes/header.php';

?>

<section class="screen home-screen">


    <!-- LOGO -->

    <div class="home-logo">

        <img
            src="assets/images/icon.jpg"
            alt="Beat the Scammer logo"
        >

    </div>


    <!-- APP TITLE-->

    <h2 class="home-title">

        AI Scam Awareness<br>
        Training Application

    </h2>


    <!-- COACH INTRODUCTION-->

    <div class="coach-introduction">


        <!-- Actual coach PNG -->

        <img
            src="assets/images/coach.png"
            alt="Training coach"
            class="coach-image"
        >


        <!-- Coach message -->

        <div class="coach-text">

            "Welcome! I will help you practise
            recognising scam calls safely."

        </div>

    </div>


    <!-- START TRAINING-->

    <!--
        Takes the user to the Instructions screen.
    -->

    <a
        href="instructions.php"
        class="button primary-button"
    >

        <span class="button-icon">▶</span>

        Start Training

    </a>


    <!-- HOW IT WORKS -->

    <!--
        For now, this also goes to Instructions.

        We can make a separate How It Works screen
        later if required.
    -->

    <a
        href="family-voice.php"
        class="button secondary-button"
    >

        <span class="button-icon">ⓘ</span>

        Family Voice Training 

    </a>


</section>


<?php

include 'includes/footer.php';

?>