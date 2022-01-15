<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_SESSION['id'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );
    $userInfo = $checkuser->fetch();

    if(!in_array('admin', explode(',', $userInfo['access']))) {
        Header('Location: error/403.htm');
    }
} else {
    Header('Location: error/403.htm');
}

?>
<html>
    <head>
        <title>manage.js</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/manage.css" />
        <script src="js/manage.js"></script>
    </head>
    <body>
        Welcome to the manage.js panel
    </body>
</html>