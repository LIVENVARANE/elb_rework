<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_GET['code']) && !empty(htmlspecialchars($_GET['code']))) {
    $loadManage = $db->prepare("SELECT * FROM manage WHERE id = 1");
    $loadManage->execute(array());
    $products = json_decode($loadManage->fetch()['products']);

    foreach ($products as $product) {
        var_dump($product);
    }

} else {
    $_SESSION['message'] = 'We could not find the product you were looking for';
    Header('Location: home.php');
}

?>
<html>
    <head>
        <title>ELBModzz - Home</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/product.css" />
        <script src="js/product.js"></script>
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>