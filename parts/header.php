<?php

if(isset($_SESSION['id'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );
    $userInfo = $checkuser->fetch();
}

$loadManage = $db->prepare("SELECT * FROM manage WHERE id = 1");
$loadManage->execute(array());
$headerManageInfos = $loadManage->fetch();

?>
<header>
    <div class="logo-container" onclick="link('home.php')">
        <img src="assets/elb.png" />
    </div>
    <div class="link-container">
        <div class="link" onclick="link('paidmods.php')"><a>Paid Mods</a></div>
        <div class="link" onclick="link('freemods.php')"><a>Free Mods</a></div>
        <div class="link"><a>GTA Accounts</a></div>
        <div class="link" onclick="link('faq.php')"><a>FAQ</a></div>
    </div>
    <div class="media-container shown">
        <div class="big" onclick="linkForLang('<?= $headerManageInfos['discordEn']  ?>', '<?= $headerManageInfos['discordFr']  ?>', true)" style="background-color: #7289DA; animation-delay: .2s;"><i class="fab fa-discord"></i> Discord</div>
        <div onclick="link('<?= $headerManageInfos['youtube']  ?>', true)" style="background-color: red; animation-delay: .1s;"><i class="fab fa-youtube"></i></div>
    </div>
    <div class="more-container shown">
        <img onclick="document.getElementById('more-cb').click(); document.querySelector('.account-tooltip').style.display = 'none';" />
        <div class="vl"></div>
        <img src="assets/account.png" onclick="document.getElementById('account-cb').click()" />
    </div>
    <div class="burger-btn">
        <input type="checkbox" onclick="mobileMenu(this)" />
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>
<input id="account-cb" type="checkbox" />
<div class="account">
    <div class="header">
        <h1>Account</h1>
        <span>Account</span>
        <i class="fas fa-times" onclick="document.getElementById('account-cb').click()"></i>
    </div>
    <?php if(!isset($_SESSION['id'])) { ?>
        <div class="line" onclick="link('signin.php')"><i class="fas fa-sign-in-alt"></i>Sign-in</div>
        <div class="line" onclick="link('signup.php')"><i class="fas fa-user-plus"></i>Create an account</div>
    <?php } else { ?>
        <div class="line" onclick="link('profile.php')"><i class="fas fa-user-edit"></i>Manage account</div>
        <?php if(isset($userInfo) && in_array('admin', explode(',', $userInfo['access']))) { ?>
            <div class="line" onclick="link('manage.php')"><i class="fas fa-wrench"></i>manage.js panel</div>
        <?php } ?>
    <div class="line" onclick="link('logout.php')"><i class="fas fa-sign-out-alt"></i>Disconnect</div>
    <?php } ?>
</div>
<input id="more-cb" type="checkbox" />
<div class="more">
    <div class="header">
            <h1>More</h1>
            <span>More</span>
            <i class="fas fa-times" onclick="document.getElementById('more-cb').click()"></i>
        </div>
        <div class="line"><i class="fas fa-sign-in-alt"></i>Language</div>
        <div class="line"><i class="fas fa-sign-in-alt"></i>Toggle light mode</div>
        <div class="line" onclick="link('legal.php')"><i class="fas fa-balance-scale"></i>Legal pages</div>
        <div class="line" onclick="link('about.php')"><i class="fas fa-sign-in-alt"></i>About the website</div>
    </div>
</div>