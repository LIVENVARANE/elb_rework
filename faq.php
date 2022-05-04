<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

?>
<html>
    <head>
        <title>ELBModzz - FAQ</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/faq.css" />
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="title-effect">
            <h1>FAQ</h1>
            <span>FAQ</span>
        </div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>