// JavaScript functions for application navigation.
/*
    PHONE STATUS BAR

    Updates the time using the user's device/browser
    clock.

    The time updates every second so it stays current.
*/

function updateDeviceTime() {

    const timeElement = document.getElementById("device-time");

    if (!timeElement) {
        return;
    }

    const now = new Date();

    const hours = String(now.getHours()).padStart(2, "0");

    const minutes = String(now.getMinutes()).padStart(2, "0");

    timeElement.textContent = `${hours}:${minutes}`;
}


/*
    Update the time immediately when the page loads.
*/

updateDeviceTime();


/*
    Keep the time updated every second.
*/

setInterval(updateDeviceTime, 1000);


/*
    BATTERY

    Some browsers allow websites to access the
    device's battery level.

    If the browser does not support this feature,
    the battery will simply remain as --%.
*/

async function updateBattery() {

    const batteryLevel = document.getElementById("battery-level");
    const batteryIcon = document.getElementById("battery-icon");

    if (!batteryLevel) {
        return;
    }

    if (!("getBattery" in navigator)) {
        return;
    }

    try {

        const battery = await navigator.getBattery();

        function displayBattery() {

            const percentage =
                Math.round(battery.level * 100);

            batteryLevel.textContent =
                `${percentage}%`;


            /*
                Change the simple battery symbol
                depending on the battery level.
            */

            if (percentage <= 20) {

                batteryIcon.textContent = "▱";

            } else if (percentage <= 50) {

                batteryIcon.textContent = "▰";

            } else {

                batteryIcon.textContent = "▰";
            }

        }

        displayBattery();

        battery.addEventListener(
            "levelchange",
            displayBattery
        );

    } catch (error) {

        console.log(
            "Battery information is unavailable."
        );

    }
}


/*
    Start battery checking.
*/

updateBattery();

/* ==================================================
   SLIDE TO ANSWER
   ==================================================

   The user must physically drag the white circle
   across the answer bar.

   A normal click will NOT answer the call.

   This works with a computer mouse and touchscreen.
*/


const handle = document.getElementById("swipe-handle");
const track = document.getElementById("swipe-track");


if (handle && track) {

    let isDragging = false;

    let startX = 0;

    let startPosition = 0;


    /*
        START DRAGGING

        This happens when the user presses down
        on the white circle.
    */

    handle.addEventListener("pointerdown", function(event) {

        isDragging = true;

        startX = event.clientX;

        startPosition = 0;

        /*
            Tell the browser that we are handling
            this pointer ourselves.
        */

        handle.setPointerCapture(event.pointerId);

        handle.style.cursor = "grabbing";

        event.preventDefault();

    });


    /*
        MOVE THE CIRCLE

        This runs while the mouse/finger is moving.
    */

    handle.addEventListener("pointermove", function(event) {

        if (!isDragging) {
            return;
        }


        /*
            Calculate how far the mouse/finger
            has moved from the starting point.
        */

        let distance =
            event.clientX - startX;


        /*
            Calculate the maximum distance available
            inside the track.
        */

        const maxDistance =
            track.clientWidth -
            handle.clientWidth -
            8;


        /*
            Don't allow the circle to move backwards.
        */

        if (distance < 0) {
            distance = 0;
        }


        /*
            Don't allow the circle to move outside
            the answer bar.
        */

        if (distance > maxDistance) {
            distance = maxDistance;
        }


        /*
            Move the circle.
        */

        handle.style.transform =
            `translateX(${distance}px)`;


        /*
            Once the user has dragged the circle
            75% of the way across, answer the call.
        */

        if (distance >= maxDistance * 0.75) {

            isDragging = false;

            handle.releasePointerCapture(
                event.pointerId
            );


            /*
                Move to the scenario screen.
            */

            window.location.href =
                "scenario.php?decision=1";

        }

    });


    /*
        STOP DRAGGING

        If the user releases the mouse/finger
        before reaching the required distance,
        return the circle to the beginning.
    */

    handle.addEventListener("pointerup", function(event) {

        if (!isDragging) {
            return;
        }

        isDragging = false;

        handle.releasePointerCapture(
            event.pointerId
        );

        handle.style.cursor = "grab";

        handle.style.transform =
            "translateX(0)";

    });


    /*
        If the pointer is cancelled, reset the
        circle as well.
    */

    handle.addEventListener("pointercancel", function() {

        isDragging = false;

        handle.style.cursor = "grab";

        handle.style.transform =
            "translateX(0)";

    });

}