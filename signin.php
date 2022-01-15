<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_SESSION['id'])) {
    Header('Location: home.php');
}

if(isset($_SESSION['account_created']) && $_SESSION['account_created']) {
    $_SESSION['account_created'] = false;
    $message = 'Your account has been successfully created. You can now log-in!';
}

if(isset($_POST['signin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);
    
    if(!empty($username)) {
        $checkuser = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $checkuser->execute(array($username, $password));
        $usercount = $checkuser->rowCount();
        if($usercount == 1) {
            $userInfo = $checkuser->fetch();
    
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['username'] = $userInfo['username'];
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['just_connected'] = true;
            
            Header('Location: home.php');
        } else {
            $error = 'No account was found for these credentials.';
        }
    } else {
        $error = 'Please fill out the entire form.';
    }
}

?>
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
            <?php if(isset($message)) { echo '<span class="message">' . $message . '</span>'; } ?>
            <?php if(isset($error)) { echo '<span class="error">' . $error . '</span>'; } ?>
            <form method="post">
                <input type="text" name="username" placeholder="username" />
                <input type="password" name="password" placeholder="password" />
                <input type="submit" name="signin" value="SIGN IN" />
            </form>
            <h5>No account? Create one <a href="signup.php">here</a></h5>
        </div>
    </body>
</html>