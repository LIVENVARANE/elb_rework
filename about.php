<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

?>
<html>
    <head>
        <title>About ELBModzz</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/faq.css" />
        <style>
            h2 {
                text-align: center;
                letter-spacing: 2px;
                font-weight: 300;
            }

            a {
                transition: .2s ease-out;
            }

            a:hover {
                letter-spacing: 3px;
            }
            
            h5 {
                margin-top: 60px;
                opacity: .8;
                text-align: center;
            }

            img.text-header {
                width: 80px;
                position: relative;
                left: 50%;
                transform: translateX(-50%);
                margin-bottom: 5px;
                transition: .2s ease-out;
            }

            img.text-header:hover {
                transform: translateX(-50%) rotate(3deg);
            }
        </style>
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="title-effect">
            <h1>About</h1>
            <span>About</span>
        </div>
        <br /><br />
        <img src="assets/elb.png" class="text-header" />
        <h2>Website production & maintaining from <a href="#">???</a></h2>
        <h2>UI & Website foundations from <a href="https://livenvarane.github.io/">LVN</a></h2>
        <h5>Thanks for looking around here! If you have any questions about anything here, feel free to ask me on my Discord server!</h5>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>