<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

$loadManage = $db->prepare("SELECT * FROM manage WHERE id = 1");
$loadManage->execute(array());

$mods = json_decode($loadManage->fetch()['paidMenus']);

?>
<html>
    <head>
        <title>ELBModzz - Paid Mods</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/paidmods.css" />
        <script src="js/paidmods.js"></script>
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="title-effect">
            <h1>Paid Mods</h1>
            <span>Paid Mods</span>
        </div>
        <div class="upper-part">
            <h3><span id="counter">0</span> mods are safe right now.</h3>
            <div class="colors-container">
                <div><div style="background-color: green;"></div><span>undetected</span></div>
                <div><div style="background-color: red;"></div><span>detected</span></div>
                <div><div style="background-color: orange;"></div><span>risky</span></div>
                <div><div style="background-color: #0054ff;"></div><span>maintenance</span></div>
            </div>
        </div>
        <div id="card-container" align="center">
            <?php
            foreach ($mods as $mod) {
                if($mod->{'enabled'}) {
                    echo '
                    <div onclick="link(\'product.php?code=' . $mod->{'productNumber'} . '\')">
                        <img src="assets/material/paidmods/kiddions.png" />
                        <span class="name">' . $mod->{'name'} . '</span>
                        <span class="body">' . $mod->{'description'} . '</span>
                        <span class="price">€' . $mod->{'price'} . '</span>
                        <span class="see"><i class="fas fa-eye"></i>MORE INFO</span>
                    </div>
                    ';
                }
            }
            ?>
        </div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>