<?php

if(isset($_GET['anim'])) {
    echo '<script>document.addEventListener(\'DOMContentLoaded\', function() { setTimeout(function() { document.getElementById("discover-anim").style.left = "100%"; }, 500); });</script>';
} else {
    echo '<script>document.addEventListener(\'DOMContentLoaded\', function() { document.getElementById("discover-anim").style.display = "none"; });</script>';
}

?>
<html>
    <head>
        <title>ELBModzz - Discover</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/discover.css" />
        <script src="js/discover.js"></script>
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <h1>Let's show you the website</h1>
        <div class="slideshow-container">
            <img id="slideshow" />
            <div class="last-wrapper" onclick="lastItem()"><i class="fas fa-long-arrow-alt-left" style="left: 30px;"></i></div>
            <div class="next-wrapper" onclick="nextItem()"><i class="fas fa-long-arrow-alt-right" style="right: 30px;"></i></div>
        </div>
        <div id="discover-anim"></div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>