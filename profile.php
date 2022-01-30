<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_SESSION['id'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );
    $userInfo = $checkuser->fetch();
} else {
    $_SESSION['message'] = 'You need to be connected to do that.';
    Header('Location: home.php');
}

?>
<html>
    <head>
        <title><?= $userInfo['username'] ?> - Profile</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/profile.css" />
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="title-effect">
            <h1><?= $userInfo['username'] ?></h1>
            <span><?= $userInfo['username'] ?></span>
        </div>
        <div class="content">
            <h3>Account information</h3>
            <span>Date created: <i><?= $userInfo['dateCreated'] ?></i> </span>
            <span>E-mail address: <i><?= $userInfo['email'] ?></i></span>
            <span>Password: <i><a href="#">Change</a></i></span>
            <h3>Order history</h3>
        </div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>