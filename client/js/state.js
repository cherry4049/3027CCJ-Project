/*
    SCAMSHIELD - SCENARIO STATE

    Stores the player's decisions while they
    complete the training scenario.
*/


/*
    START / RESET SCENARIO
*/

function startScenario() {

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


/*
    SAVE A DECISION

    Stores:
    - decision number
    - safety rating
    - response selected
    - feedback for that response
    - caller dialogue for that decision
*/

function saveChoice(
    decision,
    choice,
    responseText,
    feedback,
    callerText
) {

    let choices = JSON.parse(
        sessionStorage.getItem(
            "scenarioChoices"
        )
    ) || [];


    /*
        Remove an existing answer for the
        same decision.

        This prevents duplicate decisions
        if the user goes backwards and
        changes their response.
    */

    choices = choices.filter(
        item => item.decision !== decision
    );


    /*
        Store the new decision.
    */

    choices.push({

        decision: decision,

        choice: choice,

        response: responseText,

        feedback: feedback,

        caller: callerText

    });


    /*
        Keep decisions in numerical order.
    */

    choices.sort(
        (a, b) =>
            a.decision - b.decision
    );


    /*
        Save everything to sessionStorage.
    */

    sessionStorage.setItem(
        "scenarioChoices",
        JSON.stringify(choices)
    );
}


/*
    HANDLE RESPONSE BUTTON

    Gets the information stored in the
    response button's data attributes,
    saves it, then moves to the next page.
*/

function handleScenarioChoice(button) {

    const decision = Number(
        button.dataset.decision
    );

    const rating =
        button.dataset.rating;

    const responseText =
        button.dataset.response;

    const feedback =
        button.dataset.feedback;

    const callerText =
        button.dataset.caller;

    const nextPage =
        button.href;


    saveChoice(
        decision,
        rating,
        responseText,
        feedback,
        callerText
    );


    window.location.href =
        nextPage;
}


/*
    GET SAVED DECISIONS
*/

function getScenarioChoices() {

    return JSON.parse(
        sessionStorage.getItem(
            "scenarioChoices"
        )
    ) || [];

}

/*
    PHONE STATUS BAR
    Updates the simulated phone time and battery
    information across every page of the app.
*/


/*
    UPDATE CURRENT TIME
*/

function updateDeviceTime() {

    const timeElement =
        document.getElementById(
            "device-time"
        );

    if (!timeElement) {
        return;
    }

    const now =
        new Date();

    const time =
        now.toLocaleTimeString(
            [],
            {
                hour: "2-digit",
                minute: "2-digit",
                hour12: false
            }
        );

    timeElement.textContent =
        time;
}


/*
    UPDATE TIME IMMEDIATELY
*/

updateDeviceTime();


/*
    KEEP TIME UPDATED
*/

setInterval(
    updateDeviceTime,
    1000
);


/*
    BATTERY DISPLAY
*/

async function updateBatteryStatus() {

    const batteryLevel =
        document.getElementById(
            "battery-level"
        );

    const batteryIcon =
        document.getElementById(
            "battery-icon"
        );

    if (
        !batteryLevel ||
        !batteryIcon
    ) {
        return;
    }


    /*
        Try to use the device's real
        battery information if the
        browser supports it.
    */

    if (
        "getBattery" in navigator
    ) {

        try {

            const battery =
                await navigator.getBattery();


            function displayBattery() {

                const percentage =
                    Math.round(
                        battery.level * 100
                    );

                batteryLevel.textContent =
                    percentage + "%";


                if (battery.charging) {

                    batteryIcon.textContent =
                        "⚡";

                }
                else {

                    batteryIcon.textContent =
                        "▰";

                }

            }


            displayBattery();


            /*
                Update if battery level
                changes.
            */

            battery.addEventListener(
                "levelchange",
                displayBattery
            );


            /*
                Update if charging status
                changes.
            */

            battery.addEventListener(
                "chargingchange",
                displayBattery
            );

        }
        catch (error) {

            showDefaultBattery();

        }

    }
    else {

        showDefaultBattery();

    }

}


/*
    FALLBACK BATTERY

    Some browsers do not allow websites
    to access the device battery level.
*/

function showDefaultBattery() {

    const batteryLevel =
        document.getElementById(
            "battery-level"
        );

    const batteryIcon =
        document.getElementById(
            "battery-icon"
        );

    if (batteryLevel) {

        batteryLevel.textContent =
            "85%";

    }

    if (batteryIcon) {

        batteryIcon.textContent =
            "▰";

    }

}


/*
    START BATTERY DISPLAY
*/

updateBatteryStatus();


/*
    SCENARIO CALL TIMER

    Keeps the call timer running across
    all scenario decision pages.
*/

/*
    SCENARIO CALL TIMER
*/

let callTimerInterval = null;


function initialiseCallTimer() {

    const timerElement =
        document.getElementById(
            "call-timer"
        );

    /*
        If this page does not have a
        call timer, do nothing.
    */

    if (!timerElement) {
        return;
    }


    /*
        Create the start time only once.

        sessionStorage means the timer
        continues between scenario pages.
    */

    let startTime =
        sessionStorage.getItem(
            "callStartTime"
        );

    if (!startTime) {

        startTime =
            Date.now().toString();

        sessionStorage.setItem(
            "callStartTime",
            startTime
        );

    }


    /*
        Update the visible timer.
    */

    function updateTimer() {

        const elapsed =
            Date.now() -
            Number(startTime);

        const totalSeconds =
            Math.floor(
                elapsed / 1000
            );

        const minutes =
            Math.floor(
                totalSeconds / 60
            );

        const seconds =
            totalSeconds % 60;


        const formattedMinutes =
            String(minutes).padStart(
                2,
                "0"
            );

        const formattedSeconds =
            String(seconds).padStart(
                2,
                "0"
            );


        timerElement.textContent =
            formattedMinutes +
            ":" +
            formattedSeconds;

    }


    /*
        Show the initial value.
    */

    updateTimer();


    /*
        Update every second.
    */

    callTimerInterval =
        setInterval(
            updateTimer,
            1000
        );

}


/*
    Start once the page has loaded.
*/

if (
    document.readyState === "loading"
) {

    document.addEventListener(
        "DOMContentLoaded",
        initialiseCallTimer
    );

}
else {

    initialiseCallTimer();

}


function updateCallTimer() {

    const timerElement =
        document.getElementById(
            "call-timer"
        );

    /*
        Only run on pages that actually
        contain the call timer.
    */

    if (!timerElement) {
        return;
    }


    let startTime =
        sessionStorage.getItem(
            "callStartTime"
        );


    /*
        If there is no existing timer,
        start one now.
    */

    if (!startTime) {

        startCallTimer();

        startTime =
            sessionStorage.getItem(
                "callStartTime"
            );

    }


    const elapsedMilliseconds =
        Date.now() -
        Number(startTime);

    const totalSeconds =
        Math.floor(
            elapsedMilliseconds / 1000
        );

    const minutes =
        Math.floor(
            totalSeconds / 60
        );

    const seconds =
        totalSeconds % 60;


    const formattedMinutes =
        String(minutes).padStart(
            2,
            "0"
        );

    const formattedSeconds =
        String(seconds).padStart(
            2,
            "0"
        );


    timerElement.textContent =
        formattedMinutes +
        ":" +
        formattedSeconds;

}


/*
    Update immediately and then
    once every second.
*/

updateCallTimer();

setInterval(
    updateCallTimer,
    1000
);