<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_GET['code']) && !empty(htmlspecialchars($_GET['code']))) {
    $loadManage = $db->prepare("SELECT * FROM manage WHERE id = 1");
    $loadManage->execute(array());
    $products = json_decode($loadManage->fetch()['products']);
    $productData;

    foreach ($products as $product) {
        if($product->{'productNumber'} == htmlspecialchars($_GET['code'])) {
            $productData = $product;
        } else {
            $_SESSION['message'] = 'We could not find the product you were looking for';
            Header('Location: home.php');
        }
    }
} else {
    $_SESSION['message'] = 'We could not find the product you were looking for';
    Header('Location: home.php');
}
?>
<html>
    <head>
        <title><?= $productData->{'name'} ?> - ELBModzz</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/product.css" />
        <script src="js/product.js"></script>
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <div class="title-effect">
            <h1><?= $productData->{'name'} ?></h1>
            <span><?= $productData->{'name'} ?></span>
        </div>
        <div class="pane-wrapper">
            <div class="info-pane">
                <div class="visual-header">
                    <?php if(!empty($productData->{'enYTB'})) { echo '<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="356" height="200" type="text/html" src="https://www.youtube.com/embed/DBXH9jJRaDk?autoplay=1&fs=1&iv_load_policy=3&showinfo=0&rel=0&cc_load_policy=0&start=0&end=0&origin=http://youtubeembedcode.com"><div><small><a href="https://youtubeembedcode.com/en">youtubeembedcode.com/en/</a></small></div><div><small><a href="https://casinoutanspelgränser.se/">https://casinoutanspelgränser.se/</a></small></div><div><small><a href="https://youtubeembedcode.com/nl/">youtubeembedcode.com/nl/</a></small></div><div><small><a href="https://youtubeembed.net/">https://youtubeembed.net/</a></small></div><div><small><a href="https://youtubeembedcode.com/nl/">youtubeembedcode.com/nl/</a></small></div><div><small><a href="https://britecasinoutansvensklicens.se/">https://britecasinoutansvensklicens.se/</a></small></div></iframe>'; } ?>
                    <img src="assets/material/gtamods/kiddions.png" />
                    <img src="assets/material/gtamods/kiddions.png" />
                </div>
                <div class="description"><?= $productData->{'description'}  ?></div>
            </div>
            <div class="buy-pane" align="center">
                <h1>€ <?= $productData->{'price'} ?></h1>
                <button>BUY NOW</button>
                <div class="payment-info">The key will be delivered to your email address with instructions to use it. The delivery will be done as soon as possible (somes seconds or minutes in a Sellix email), if you have a question DM ELB#9999 on Discord !</div>
                <div class="aggreement">By committing to buy this item, you agree to dgfhjbdbgjdgjkbdjbgdbgdbg</div>
            </div>
        </div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>