<?php


$pageTitle = $pageTitle ?? 'Beat the Scammer';

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Basic page information -->
    <meta charset="UTF-8">

    <!-- Makes the layout responsive on phones -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <!-- Page title shown in the browser -->
    <title>
        <?php echo htmlspecialchars($pageTitle); ?>
    </title>

    <!-- Main application stylesheet -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!--
        Main phone application container.
        All of the screens sit inside this area.
    -->

    <div class="app">

        <!-- PHONE STATUS BAR
-->

        <div class="phone-status-bar">

            <!-- Current device time -->
            <span id="device-time">--:--</span>

            <!-- Battery information -->
            <span class="phone-status-right">

                <span id="battery-icon">▰</span>

                <span id="battery-level">--%</span>

            </span>

        </div>

        <!-- Main content area starts here -->

        <main class="app-content">