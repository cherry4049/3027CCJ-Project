<?php


$pageTitle = 'Reflection';

include 'includes/header.php';

?>

<section class="screen non-call-layout call-screen">

    <!-- TRAINING LABEL -->

    <div class="training-label">

        Training Scenario

    </div>


    <!-- CALL ENDED -->

    <div class="call-timer">

        🔴 Call ended

    </div>


    <!-- COACH REFLECTION QUESTION -->

    <div class="message-bubble coach-message">


        <div class="coach-introduction">


            <img
                src="assets/images/coach.png"
                alt="Training coach"
                class="coach-image"
            >


            <div class="coach-text">

                <strong>
                    Coach:
                </strong>

            </div>


        </div>


        <p>

            "Let's reflect on the call.
            Do you think this caller could be
            an AI impersonation scam?"

        </p>


    </div>


    <!-- REFLECTION RESPONSE OPTIONS -->

    <div
        class="response-buttons"
        id="reflection-options"
    >


        <button
            type="button"
            class="response-button"
            onclick="showReflection('YES')"
        >

            Yes, I think it was an AI impersonation scam.

        </button>


        <button
            type="button"
            class="response-button"
            onclick="showReflection('UNSURE')"
        >

            I'm not sure. Some parts of the call seemed suspicious.

        </button>


        <button
            type="button"
            class="response-button"
            onclick="showReflection('NO')"
        >

            No, I think the caller was really my daughter.

        </button>


    </div>


    <!-- REFLECTION RESULT -->

    <div
        class="message-bubble coach-message"
        id="reflection-result"
        style="display: none;"
    >


        <div class="coach-introduction">


            <img
                src="assets/images/coach.png"
                alt="Training coach"
                class="coach-image"
            >


            <div class="coach-text">

                <strong>
                    Coach:
                </strong>

            </div>


        </div>


        <p id="reflection-result-text"></p>


    </div>


    <!-- CONTINUE TO FINAL RESULTS -->

    <div class="non-call-buttons">

        <a
            href="feedback.php"
            class="call-continue-button"
            id="final-results-button"
            style="display: none;"
        >
            Continue to Final Results
        </a>

    </div>

</section>


<script>


function showReflection(answer) {


    /*
        Save the player's answer.

        feedback.php can read this later
        when creating the final breakdown.
    */

    sessionStorage.setItem(
        "reflectionAnswer",
        answer
    );


    /*
        Create the immediate response.

        Detailed feedback about the player's
        decisions will be shown on feedback.php.
    */

    let resultText = "";


    if (answer === "YES") {

        resultText =
            "Correct! This call was an AI impersonation scam.";

    }


    else if (answer === "UNSURE") {

        resultText =
            "This call was an AI impersonation scam. " +
            "The caller was not really your daughter.";

    }


    else {

        resultText =
            "This call was an AI impersonation scam. " +
            "The caller was impersonating your daughter.";

    }


    /*
        Put the result onto the page.
    */

    document.getElementById(
        "reflection-result-text"
    ).textContent = resultText;


    /*
        Hide the response options after
        the player has answered.
    */

    document.getElementById(
        "reflection-options"
    ).style.display = "none";


    /*
        Show the result.
    */

    document.getElementById(
        "reflection-result"
    ).style.display = "block";


    /*
        Show the button that takes the
        player to their detailed results.
    */

    document.getElementById(
        "final-results-button"
    ).style.display = "block";


}


</script>


<?php

include 'includes/footer.php';

?>