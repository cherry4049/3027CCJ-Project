<?php

$pageTitle = 'Final Results';

include 'includes/header.php';

?>

<section class="screen non-call-layout call-screen feedback-screen">

    <div class="feedback-content">

        <div class="training-label">
            Training Scenario
        </div>


        <!-- COACH MESSAGE -->

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
                You've completed the scenario.
                Let's look at how you responded
                to the scam attempt.
            </p>

        </div>


        <!-- OVERALL RESULT -->

        <div class="feedback-section">

            <h2>
                Your Results
            </h2>

            <p id="overall-result">
            </p>

            <p id="result-counts">
            </p>

        </div>


        <!-- DECISION BREAKDOWN -->

        <div class="feedback-section">

            <h2>
                Decision Breakdown
            </h2>

            <p>
                Review what happened during
                each stage of the call and how
                you responded.
            </p>

            <div id="decision-breakdown">
            </div>

        </div>


        <!-- REFLECTION RESULT -->

        <div class="feedback-section">

            <h2>
                Your Reflection
            </h2>

            <p id="reflection-summary">
            </p>

        </div>


        <!-- STRENGTHS -->

        <div class="feedback-section">

            <h2>
                What You Did Well
            </h2>

            <p id="strength-feedback">
            </p>

        </div>


        <!-- IMPROVEMENTS -->

        <div class="feedback-section">

            <h2>
                What You Could Improve
            </h2>

            <p id="improvement-feedback">
            </p>

        </div>


        <!-- WARNING SIGNS -->

        <div class="feedback-section">

            <h2>
                Warning Signs in This Call
            </h2>

            <ul>

                <li>
                    The caller created urgency
                    and pressured you to act
                    immediately.
                </li>

                <li>
                    The caller asked you to keep
                    the situation private.
                </li>

                <li>
                    The caller requested $800.
                </li>

                <li>
                    The caller wanted money sent
                    to unfamiliar or new account
                    details.
                </li>

                <li>
                    The caller discouraged you
                    from contacting your daughter
                    another way.
                </li>

            </ul>

        </div>


        <!-- TIPS -->

        <div class="feedback-section">

            <h2>
                Remember
            </h2>

            <ul>

                <li>
                    Stay calm when someone
                    contacts you with an urgent
                    request.
                </li>

                <li>
                    Verify the person's identity
                    independently.
                </li>

                <li>
                    Do not send money simply
                    because the caller sounds
                    familiar.
                </li>

                <li>
                    Hang up and contact the
                    person using a phone number
                    or method you already trust.
                </li>

            </ul>

        </div>
    </div>

    <!-- BOTTOM BUTTONS -->
    <div class="non-call-buttons">

        <a
            href="incoming-call.php"
            class="call-continue-button"
            onclick="clearScenarioResults();"
        >
            Try Scenario Again
        </a>

        <a
            href="index.php"
            class="call-continue-button"
            onclick="clearScenarioResults();"
        >
            Return Home
        </a>
    </div>

</section>


<script>

/*
    GET SAVED RESULTS
*/

const choices = JSON.parse(
    sessionStorage.getItem(
        "scenarioChoices"
    )
) || [];

const reflectionAnswer =
    sessionStorage.getItem(
        "reflectionAnswer"
    );


/*
    COUNT RESPONSE TYPES
*/

const safeChoices =
    choices.filter(
        item =>
            item.choice === "SAFE"
    ).length;

const unsureChoices =
    choices.filter(
        item =>
            item.choice === "UNSURE"
    ).length;

const unsafeChoices =
    choices.filter(
        item =>
            item.choice === "UNSAFE"
    ).length;


/*
    OVERALL RESULT
*/

const overallResult =
    document.getElementById(
        "overall-result"
    );

if (
    unsafeChoices === 0 &&
    unsureChoices <= 2
) {

    overallResult.textContent =
        "Strong scam awareness. You regularly used safer responses and avoided the highest-risk actions.";

}
else if (
    unsafeChoices <= 2
) {

    overallResult.textContent =
        "You recognised several warning signs, but there were some points where the caller's pressure influenced your decisions.";

}
else {

    overallResult.textContent =
        "There were several points where the scammer's tactics influenced your decisions. Reviewing these choices can help you recognise similar scams in the future.";

}


/*
    RESULT COUNTS
*/

document.getElementById(
    "result-counts"
).textContent =
    "Safe responses: " +
    safeChoices +
    " | Cautious responses: " +
    unsureChoices +
    " | Risky responses: " +
    unsafeChoices;


/*
    INDIVIDUAL DECISION BREAKDOWN
*/

const breakdown =
    document.getElementById(
        "decision-breakdown"
    );


choices.forEach(function(item) {

    const decisionItem =
        document.createElement("div");

    decisionItem.classList.add(
        "result-item"
    );


    /*
        Determine symbol and rating text.
    */

    let symbol = "";
    let description = "";


    if (item.choice === "SAFE") {

        symbol = "✓";

        description =
            "Safe response";

        decisionItem.classList.add(
            "result-correct"
        );

    }
    else if (
        item.choice === "UNSURE"
    ) {

        symbol = "?";

        description =
            "Cautious, but could be safer";

    }
    else {

        symbol = "✗";

        description =
            "Risky response";

        decisionItem.classList.add(
            "result-incorrect"
        );

    }


    /*
        DECISION HEADING
    */

    const heading =
        document.createElement("h3");

    heading.textContent =
        symbol +
        " Decision " +
        item.decision;


    /*
        CALLER DIALOGUE / QUESTION
    */

    const question =
        document.createElement("p");

    question.classList.add(
        "decision-question"
    );

    if (item.caller) {

        question.textContent =
            '"' +
            item.caller +
            '"';

    } else {

        question.textContent =
            "Caller dialogue unavailable.";

    }


    /*
        SAFETY RATING
    */

    const ratingText =
        document.createElement("p");

    const ratingStrong =
        document.createElement("strong");

    ratingStrong.textContent =
        description;

    ratingText.appendChild(
        ratingStrong
    );


    /*
        USER RESPONSE
    */

    const response =
        document.createElement("p");

    const responseLabel =
        document.createElement(
            "strong"
        );

    responseLabel.textContent =
        "You chose: ";

    response.appendChild(
        responseLabel
    );

    response.appendChild(
        document.createTextNode(
            '"' +
            item.response +
            '"'
        )
    );


    /*
        FEEDBACK
    */

    const feedback =
        document.createElement("p");

    const feedbackLabel =
        document.createElement(
            "strong"
        );

    feedbackLabel.textContent =
        "Why: ";

    feedback.appendChild(
        feedbackLabel
    );


    /*
        Fallback feedback in case an older
        stored result does not contain
        personalised feedback.
    */

    let feedbackText =
        item.feedback;


    if (!feedbackText) {

        if (
            item.choice === "SAFE"
        ) {

            feedbackText =
                "This was a safer response because you slowed down the interaction and avoided immediately following the caller's instructions.";

        }
        else if (
            item.choice === "UNSURE"
        ) {

            feedbackText =
                "You showed some caution, but there were safer ways to verify the caller before continuing the conversation.";

        }
        else {

            feedbackText =
                "This response increased your risk because you continued following the caller's instructions without independently verifying their identity.";

        }

    }


    feedback.appendChild(
        document.createTextNode(
            feedbackText
        )
    );


    /*
        ADD EVERYTHING TO THE RESULT CARD
    */

    decisionItem.appendChild(
        heading
    );

    decisionItem.appendChild(
        question
    );

    decisionItem.appendChild(
        ratingText
    );

    decisionItem.appendChild(
        response
    );

    decisionItem.appendChild(
        feedback
    );

    breakdown.appendChild(
        decisionItem
    );

});


/*
    REFLECTION RESULT
*/

const reflectionSummary =
    document.getElementById(
        "reflection-summary"
    );


if (
    reflectionAnswer === "YES"
) {

    reflectionSummary.textContent =
        "You correctly identified the call as an AI impersonation scam.";

}
else if (
    reflectionAnswer === "UNSURE"
) {

    reflectionSummary.textContent =
        "You were unsure whether the caller was genuine. The call was an AI impersonation scam.";

}
else if (
    reflectionAnswer === "NO"
) {

    reflectionSummary.textContent =
        "You believed the caller was really your daughter. The call was actually an AI impersonation scam.";

}
else {

    reflectionSummary.textContent =
        "No reflection answer was recorded.";

}


/*
    STRENGTH FEEDBACK
*/

const strengthFeedback =
    document.getElementById(
        "strength-feedback"
    );


if (
    safeChoices >= 6
) {

    strengthFeedback.textContent =
        "You frequently slowed the conversation down, questioned unusual requests and used verification strategies before taking action.";

}
else if (
    safeChoices >= 3
) {

    strengthFeedback.textContent =
        "You recognised several suspicious parts of the call and made some strong attempts to verify what was happening.";

}
else {

    strengthFeedback.textContent =
        "You made some safer choices during the call. Building a habit of independently verifying urgent requests will make these responses stronger.";

}


/*
    IMPROVEMENT FEEDBACK
*/

const improvementFeedback =
    document.getElementById(
        "improvement-feedback"
    );


if (
    unsafeChoices === 0
) {

    improvementFeedback.textContent =
        "You avoided the highest-risk responses. Continue using independent verification whenever someone unexpectedly asks for money or personal information.";

}
else if (
    unsafeChoices <= 2
) {

    improvementFeedback.textContent =
        "At some points you were willing to trust the caller or continue following their instructions. Try to stop the interaction and verify the person independently before continuing.";

}
else {

    improvementFeedback.textContent =
        "Several responses allowed urgency, emotional pressure or familiarity to influence your decisions. In a real situation, stop before sending money and contact the person using details you already trust.";

}


/*
    CLEAR RESULTS WHEN RESTARTING
*/

function clearScenarioResults() {

    sessionStorage.removeItem(
        "scenarioChoices"
    );

    sessionStorage.removeItem(
        "reflectionAnswer"
    );

    sessionStorage.removeItem(
    "callStartTime"
    );

}

</script>


<?php

include 'includes/footer.php';

?>