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

            <p id="feedback-intro">
                Loading your results...
            </p>

        </div>


        <!-- OVERALL RESULT -->

        <div class="feedback-section">

            <h2>
                Your Results
            </h2>

            <p id="overall-result">
                Loading overall result...
            </p>

            <div id="result-counts">
                Loading...
            </div>

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
                Loading decisions...
            </div>

        </div>


        <!-- REFLECTION RESULT -->

        <div class="feedback-section">

            <h2>
                Your Reflection
            </h2>

            <p id="reflection-summary">
                Loading...
            </p>

        </div>


        <!-- STRENGTHS -->

        <div class="feedback-section">

            <h2>
                What You Did Well
            </h2>

            <p id="strength-feedback">
                Loading...
            </p>

        </div>


        <!-- IMPROVEMENTS -->

        <div class="feedback-section">

            <h2>
                What You Could Improve
            </h2>

            <p id="improvement-feedback">
                Loading...
            </p>

        </div>


        <!-- WARNING SIGNS -->

        <div class="feedback-section">

            <h2>
                Warning Signs in This Call
            </h2>

            <ul id="warning-signs">

                <li>
                    Loading...
                </li>

            </ul>

        </div>


        <!-- TIPS -->

        <div class="feedback-section">

            <h2>
                Remember
            </h2>

            <ul id="reminders">

                <li>
                    Loading...
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

const RESULTS_API =
    '/api/caller-turn.php';


/*
    LOAD FINAL RESULTS
*/

async function loadResults() {

    try {

        const response =
            await fetch(
                `${RESULTS_API}?action=result`
            );

        const result =
            await response.json();


        if (
            !response.ok ||
            !result.ok
        ) {

            throw new Error(
                result.error ||
                'Unable to load results.'
            );

        }


        /*
            COACH INTRODUCTION
        */

        document.getElementById(
            'feedback-intro'
        ).textContent =
            result.text;


        /*
            OVERALL RESULT
        */

        document.getElementById(
            'overall-result'
        ).textContent =
            result.overallResult;


        /*
            RESPONSE COUNTS
        */

        document.getElementById(
            'result-counts'
        ).innerHTML =

            '<div class="result-count-line">' +

                '<span>Safe responses:</span> ' +

                '<strong class="count-safe">' +
                    result.safeResponses +
                '</strong>' +

            '</div>' +

            '<div class="result-count-line">' +

                '<span>Cautious responses:</span> ' +

                '<strong class="count-cautious">' +
                    result.unsureResponses +
                '</strong>' +

            '</div>' +

            '<div class="result-count-line">' +

                '<span>Risky responses:</span> ' +

                '<strong class="count-risky">' +
                    result.unsafeResponses +
                '</strong>' +

            '</div>';


        /*
            DECISION BREAKDOWN
        */

        const breakdown =
            document.getElementById(
                'decision-breakdown'
            );

        breakdown.innerHTML = '';


        result.decisions.forEach(
            function(item) {

                const decisionItem =
                    document.createElement(
                        'div'
                    );


                decisionItem.classList.add(
                    'result-item'
                );


                /*
                    Determine symbol
                    and rating text.
                */

                let symbol = '';
                let description = '';


                if (
                    item.choice === 'SAFE'
                ) {

                    symbol = '✓';

                    description =
                        'Safe response';

                    decisionItem.classList.add(
                        'result-correct'
                    );

                }
                else if (
                    item.choice === 'UNSURE'
                ) {

                    symbol = '?';

                    description =
                        'Cautious, but could be safer';

                }
                else {

                    symbol = '✗';

                    description =
                        'Risky response';

                    decisionItem.classList.add(
                        'result-incorrect'
                    );

                }


                /*
                    DECISION HEADING
                */

                const heading =
                    document.createElement(
                        'h3'
                    );

                heading.textContent =
                    symbol +
                    ' Decision ' +
                    item.decision;


                /*
                    CALLER DIALOGUE
                */

                const question =
                    document.createElement(
                        'p'
                    );

                question.classList.add(
                    'decision-question'
                );

                question.textContent =
                    '"' +
                    item.caller +
                    '"';


                /*
                    SAFETY RATING
                */

                const ratingText =
                    document.createElement(
                        'p'
                    );

                const ratingStrong =
                    document.createElement(
                        'strong'
                    );

                ratingStrong.textContent =
                    description;

                ratingText.appendChild(
                    ratingStrong
                );


                /*
                    USER RESPONSE
                */

                const response =
                    document.createElement(
                        'p'
                    );

                const responseLabel =
                    document.createElement(
                        'strong'
                    );

                responseLabel.textContent =
                    'You chose: ';

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
                    COACH FEEDBACK
                */

                const feedback =
                    document.createElement(
                        'p'
                    );

                const feedbackLabel =
                    document.createElement(
                        'strong'
                    );

                feedbackLabel.textContent =
                    'Why: ';

                feedback.appendChild(
                    feedbackLabel
                );

                feedback.appendChild(
                    document.createTextNode(
                        item.feedback
                    )
                );


                /*
                    ADD CONTENT TO CARD
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

            }
        );


        /*
            REFLECTION
        */

        document.getElementById(
            'reflection-summary'
        ).textContent =
            result.reflectionSummary;


        /*
            STRENGTH FEEDBACK
        */

        document.getElementById(
            'strength-feedback'
        ).textContent =
            result.strengthFeedback;


        /*
            IMPROVEMENT FEEDBACK
        */

        document.getElementById(
            'improvement-feedback'
        ).textContent =
            result.improvementFeedback;


        /*
            WARNING SIGNS
        */

        document.getElementById(
            'warning-signs'
        ).innerHTML =
            result.warningSigns
                .map(
                    sign =>
                        `<li>${sign}</li>`
                )
                .join('');


        /*
            REMINDERS
        */

        document.getElementById(
            'reminders'
        ).innerHTML =
            result.reminders
                .map(
                    reminder =>
                        `<li>${reminder}</li>`
                )
                .join('');


        /*
            FEEDBACK AUDIO
        */

        if (result.audioUrl) {

            const audio =
                new Audio(
                    result.audioUrl
                );

            audio.play().catch(
                function(error) {

                    console.warn(
                        'Feedback audio could not autoplay:',
                        error
                    );

                }
            );

        }

    }
    catch (error) {

        console.error(
            'Results error:',
            error
        );


        document.getElementById(
            'feedback-intro'
        ).textContent =
            'Unable to load your results. Please try again.';


        document.getElementById(
            'overall-result'
        ).textContent =
            'Your results could not be loaded.';

    }

}


/*
    CLEAR OLD FRONTEND RESULTS
    WHEN RESTARTING OR
    RETURNING HOME
*/

function clearScenarioResults() {

    sessionStorage.removeItem(
        'scenarioChoices'
    );

    sessionStorage.removeItem(
        'reflectionAnswer'
    );

    sessionStorage.removeItem(
        'callStartTime'
    );

}


/*
    LOAD RESULTS
    AFTER PAGE LOAD
*/

document.addEventListener(
    'DOMContentLoaded',
    loadResults
);

</script>


<?php

include 'includes/footer.php';

?>