<!-- Shared page header, logo, document settings, and CSS import. -->

<?php
//Sets default page title if individual page doesnt have one
$pageTitle = $pageTitle ?? 'Beat the Scammer';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device=width, initial-scale=1.0"
    >

    <title>
        <?php echo htmlspecialchars($pageTitle); ?>
    </title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<div class="app">
    <header class="app-header">
        <h1>Beat the Scammer</h1>
    </header>