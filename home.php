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
        <div id="discover-anim"></div>
        <?php include 'parts/universal_parts.html' ?>
    </body>
</html>