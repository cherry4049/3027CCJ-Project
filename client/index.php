<?php

$pageTitle = 'Home';

include 'includes/header.php';

?>

<section class="screen non-call-layout home-screen">


    <!-- LOGO -->

    <div class="home-logo">

        <img
            src="assets/images/icon.jpg"
            alt="Beat the Scammer logo"
        >

    </div>


    <!-- APP TITLE-->

    <div class="non-call-title ">

        AI Scam Awareness<br>
        Training Application

    </div>


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
    <div class="non-call-buttons">

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
            href="instructions.php"
            class="button secondary-button"
        >

            <span class="button-icon">ⓘ</span>

            How It Works

        </a>

    </div>


</section>


<?php

include 'includes/footer.php';

?>