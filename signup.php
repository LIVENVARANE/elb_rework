<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_SESSION['id'])) {
    Header('Location: home.php');
}

if(isset($_POST['signup'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
        if(strlen($username) <= 64) {
            if(strlen($email) <= 255) {
                if(strlen($password) <= 1024) {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $askmail = $db->prepare('SELECT * FROM users WHERE email = ?');
                        $askmail->execute(array($email));
                        $mailcount = $askmail->rowCount();
                        if($mailcount == 0) {
                            $askusername = $db->prepare('SELECT * FROM users WHERE username = ?');
                            $askusername->execute(array($username));
                            $usernamecount = $askusername->rowCount();
                            if($usernamecount == 0) {
                                $insertuser = $db->prepare('INSERT INTO users(username, email, password) VALUES(?, ?, ?)');
                                $insertuser->execute(array($username, $email, $password));
                                $_SESSION['account_created'] = true;
                                Header('Location: signin.php');
                            } else {
                                $error = 'An account with that username already exists.';
                            }
                        } else {
                            $error = 'An account with that e-mail address already exists.';
                        }
                    } else {
                        $error = 'Please enter a valid e-mail.';
                    }
                } else {
                    $error = 'Your password is too long. (' . strlen($password) . '/1024)';
                }
            } else {
                $error = 'Your e-mail address is too long. (' . strlen($email) . '/255)';
            }
        } else {
            $error = 'Your username is too long. (' . strlen($username) . '/64)';
        }
    } else {
        $error = 'Please fill out the entire form.';
    }
}

?>
<html>
    <head>
        <title>Sign up</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/signinup.css" />
        <script src="js/signinup.js"></script>
    </head>
    <body>
        <div class="sign">
            <div class="header">
                <h1><i class="fas fa-chevron-left" onclick="link('home.php')" title="Back to home"></i>New account</h1>
                <span>New account</span>
            </div>
            <?php if(isset($error)) { echo '<span class="error">' . $error . '</span>'; } ?>
            <form method="post">
                <input type="text" name="username" placeholder="username" />
                <input type="text" name="email" placeholder="e-mail" />
                <input type="password" name="password" placeholder="password" />
                <input type="submit" name="signup" value="SIGN UP" />
            </form>
            <h5>Already have an account? Sign in <a href="signin.php">here</a></h5>
        </div>
    </body>
</html>