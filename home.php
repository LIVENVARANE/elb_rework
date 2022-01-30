<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_SESSION['just_connected']) && $_SESSION['just_connected']) {
    $_SESSION['just_connected'] = false;
    $message = 'You are now connected to the account "' . $_SESSION['username'] . '"';
}

if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $_SESSION['message'] = null;
}

?>
<html>
    <head>
        <title>ELBModzz - Home</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/home.css" />
        <script src="js/home.js"></script>
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="welcome-container" align="center">
            <div align="right">
                <img class="logo" src="assets/elb.png" />
            </div>
            <div class="vh"></div>
            <div>
                <div class="content" align="center">
                    <h1>WELCOME</h1>
                    <h3>TO MY WEBSITE</h3>
                    <button onclick="discoverAnim()">Discover the website</button>
                </div>
            </div>
        </div>
        <?php if(isset($message)) { ?>
            <div id="message" onclick="this.remove();"><i class="fas fa-info-circle"></i><span class="text"><?= $message ?></span><span class="dismiss">Dismiss</span></div>
        <?php } ?>
        <div id="discover-anim"></div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>