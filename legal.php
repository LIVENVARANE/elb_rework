<?php

if(isset($_GET['show'])) {
    $show = htmlspecialchars($_GET['show']);

    switch ($show) {
        case 'privacypolicy':
            break;
        case 'legalnotice':
            break;
        default:
            $show = 'home';
            break;
    }
} else {
    $show = 'home';
}

?>
<html>
    <head>
        <title>ELBModzz - Legal</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/legal.css" />
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="title-effect">
            <h1>Legal</h1>
            <span>Legal</span>
        </div>
        <?php
        if(isset($show)) {
            if($show == 'home') {
        ?>
        <h2>Please select a category</h2>
        <a href="?show=privacypolicy">Privacy Policy</a>
        <a href="?show=legalnotice">Legal Notice</a>
        <?php
            } else include 'parts/' . $show . '.html';
        }
        ?>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>