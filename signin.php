<html>
    <head>
        <title>Sign in</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/signinup.css" />
        <script src="js/signinup.js"></script>
    </head>
    <body>
        <div class="sign">
            <div class="header">
                <h1><i class="fas fa-chevron-left" onclick="link('home.php')" title="Back to home"></i>Sign In</h1>
                <span>Sign In</span>
            </div>
            <form method="post">
                <input type="text" name="username" placeholder="username" />
                <input type="password" name="password" placeholder="password" />
                <input type="submit" name="signin" value="SIGN IN"
            </form>
            <h5>No account? Create one <a href="signup.php">here</a></h5>
        </div>
    </body>
</html>