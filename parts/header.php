<?php

if(isset($_SESSION['id'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );
    $userInfo = $checkuser->fetch();
}

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
        <div class="big" style="background-color: #7289DA; animation-delay: .2s;"><i class="fab fa-discord"></i> Discord</div>
        <div style="background-color: red; animation-delay: .1s;"><i class="fab fa-youtube"></i></div>
    </div>
    <div class="buttons-container">
        <?php if(isset($userInfo) && in_array('admin', explode(',', $userInfo['access']))) { ?>
            <img src="assets/admin.png" style="animation-delay: .4s;" onclick="link('manage.php')" />
        <?php } ?>
        <img src="assets/light_mode.png" style="animation-delay: .3s;" />
        <img src="assets/account.png" style="animation-delay: .2s;" onclick="link('signin.php')" />
        <img src="assets/cog.png" style="animation-delay: .1s;" />
    </div>
    <div class="more-container shown">
        <img onclick="toggleHeaderMore()" />
        <div class="vl"></div>
        <img src="assets/french_flag.png" />
    </div>
    <div class="burger-btn">
        <input type="checkbox" onclick="mobileMenu(this)" />
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>