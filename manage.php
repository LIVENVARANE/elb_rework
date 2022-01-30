<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=elbmodzz', 'root', '');

if(isset($_SESSION['id'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );
    $userInfo = $checkuser->fetch();

    if(!in_array('admin', explode(',', $userInfo['access']))) {
        Header('Location: error/403.htm');
    } else {
        $loadManage = $db->prepare("SELECT * FROM manage WHERE id = 1");
        $loadManage->execute(array());
        $manageInfos = $loadManage->fetch();
    }
} else {
    Header('Location: error/403.htm');
}

if(isset($_POST['modifyCustomValue'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );

    if(!in_array('admin', explode(',', $userInfo['access']))) {
        Header('Location: error/403.htm');
    } else {
        $value = $_POST['customValue'];

        switch($_POST['customValue']) {
            case 'false':
                $value = False;
                break;
            case 'true':
                $value = True;
                break;
        }

        $sendValue = $db->prepare("UPDATE manage SET " . $_POST['customColumn'] . " = ? WHERE id = 1");
        $sendValue->execute(array($value));

        echo '<div class="saved">Vos changement ont été enregistrés ✔️</div>';
    }
}

if(isset($_POST['submitSocialMedias'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );

    if(!in_array('admin', explode(',', $userInfo['access']))) {
        Header('Location: error/403.htm');
    } else {
        $sendValue = $db->prepare("UPDATE manage SET discordFr = ?, discordEn = ?, youtube = ?, instagram = ?, twitch = ?, twitter = ? WHERE id = 1");
        $sendValue->execute(array($_POST['discordFr'], $_POST['discordEn'], $_POST['youtube'], $_POST['instagram'], $_POST['twitch'], $_POST['twitter']));

        echo '<div class="saved">Vos changement ont été enregistrés ✔️</div>';
    }
}

if(isset($_POST['submitMessages'])) {
    $checkuser = $db->prepare("SELECT * FROM users WHERE id = ?");
    $checkuser->execute(array($_SESSION['id']) );

    if(!in_array('admin', explode(',', $userInfo['access']))) {
        Header('Location: error/403.htm');
    } else {
        $sendValue = $db->prepare("UPDATE manage SET homeMessageFr = ?, homeMessageEn = ?, freeMessageFr = ?, freeMessageEn = ?, paidMessageFr = ?, paidMessageEn = ?, accountsMessageFr = ?, accountMessageEn = ? WHERE id = 1");
        $sendValue->execute(array($_POST['homeMessageFr'], $_POST['homeMessageEn'], $_POST['freeMessageFr'], $_POST['paidMessageFr'], $_POST['paidMessageFr'], $_POST['paidMessageEn'], $_POST['accountsMessageFr'], $_POST['accountMessageEn']));

        echo '<div class="saved">Vos changement ont été enregistrés ✔️</div>';
    }
}

?>
<html>
    <head>
        <title>manage.js</title>
        <?php include 'parts/head.html' ?>
        <link rel="stylesheet" href="css/manage.css" />
        <script src="js/manage.js"></script>
        <script src="js/Sortable.js"></script>
    </head>
    <body>
        <header>
            <a href="home.php"><i class="fas fa-chevron-left"></i>Retour à l'accueil</a>
            <div class="middle">
                <img src="assets/elb.png" />
                <span>manage.js</span>
            </div>
        </header>
        <nav>
            <span onclick="page('general')">Général</span>
            <span onclick="page('home')">Accueil</span>
            <span onclick="page('free')">Menus gratuits</span>
            <span onclick="page('paid')">Menus payants</span>
            <span onclick="page('accounts')">Comptes GTA</span>
            <span onclick="page('faq')">FAQ</span>
            <span onclick="page('contact')">Contact</span>
        </nav>
        <div class="pages">
            <form method="POST">
                <input type="text" name="customColumn" id="customColumn" style="display: none;" value="" />
                <input type="text" name="customValue" id="customValue" style="display: none;" value="" />
                <input type="submit" id="customValueInput" name="modifyCustomValue" style="display: none;" />
                <div class="page" page="general" style="display: block;">
                    <h1>Général</h1>
                    <span>Paramètres généraux du site</span>
                    <h2>Réseaux sociaux</h2>
                    <label>Discord (Français)</label><input name="discordFr" type="text" placeholder="Insérez un lien..." value="<?= isset($_POST['discordFr']) ? $_POST['discordFr'] : $manageInfos['discordFr'] ?>" />
                    <br />
                    <label>Discord (Anglais)</label><input name="discordEn" type="text" placeholder="Insérez un lien..." value="<?= isset($_POST['discordEn']) ? $_POST['discordEn'] : $manageInfos['discordEn'] ?>" />
                    <br />
                    <label>YouTube</label><input name="youtube" type="text" placeholder="Insérez un lien..." value="<?= isset($_POST['youtube']) ? $_POST['youtube'] : $manageInfos['youtube'] ?>" />
                    <br />
                    <label>Instagram</label><input name="instagram" type="text" placeholder="Insérez un lien..." value="<?= isset($_POST['instagram']) ? $_POST['instagram'] : $manageInfos['instagram'] ?>" />
                    <br />
                    <label>Twitch</label><input name="twitch" type="text" placeholder="Insérez un lien..." value="<?= isset($_POST['twitch']) ? $_POST['twitch'] : $manageInfos['twitch'] ?>" />
                    <br />
                    <label>Twitter</label><input name="twitter" type="text" placeholder="Insérez un lien..." value="<?= isset($_POST['twitter']) ? $_POST['twitter'] : $manageInfos['twitter'] ?>" />
                    <br />
                    <input type="submit" value="Sauvegarder les changements" name="submitSocialMedias" />
                    <h2>Désactiver les info-bulles (tooltips)</h2>
                    <div class="checkbox <?php if($manageInfos['tooltipsEnabled']) { echo 'on'; } else { echo "off"; } ?>" onclick="useCheckbox(this)" param="tooltipsEnabled"><?php if($manageInfos['tooltipsEnabled']) { echo 'Activé'; } else { echo "Désactivé"; } ?></div>
                </div>
                <div class="page" page="home">
                    <h1>Accueil</h1>
                    <h2>Bannières Messages</h2>
                    <label>Accueil (Français)</label><input name="homeMessageFr" type="text" placeholder="Aucun message" value="<?= isset($_POST['homeMessageFr']) ? $_POST['homeMessageFr'] : $manageInfos['homeMessageFr'] ?>" />
                    <br />
                    <label>Accueil (Anglais)</label><input name="homeMessageEn" type="text" placeholder="Aucun message" value="<?= isset($_POST['homeMessageEn']) ? $_POST['homeMessageEn'] : $manageInfos['homeMessageEn'] ?>" />
                    <br />
                    <label>Menus gratuis (Français)</label><input name="freeMessageFr" type="text" placeholder="Aucun message" value="<?= isset($_POST['freeMessageFr']) ? $_POST['freeMessageFr'] : $manageInfos['freeMessageFr'] ?>" />
                    <br />
                    <label>Menus gratuis (Anglais)</label><input name="freeMessageEn" type="text" placeholder="Aucun message" value="<?= isset($_POST['freeMessageEn']) ? $_POST['freeMessageEn'] : $manageInfos['freeMessageEn'] ?>" />
                    <br />
                    <label>Menus payants (Français)</label><input name="paidMessageFr" type="text" placeholder="Aucun message" value="<?= isset($_POST['paidMessageFr']) ? $_POST['paidMessageFr'] : $manageInfos['paidMessageFr'] ?>" />
                    <br />
                    <label>Menus payants (Anglais)</label><input name="paidMessageEn" type="text" placeholder="Aucun message" value="<?= isset($_POST['paidMessageEn']) ? $_POST['paidMessageEn'] : $manageInfos['paidMessageEn'] ?>" />
                    <br />
                    <label>Comptes GTA (Français)</label><input name="accountsMessageFr" type="text" placeholder="Aucun message" value="<?= isset($_POST['accountsMessageFr']) ? $_POST['accountsMessageFr'] : $manageInfos['accountsMessageFr'] ?>" />
                    <br />
                    <label>Comptes GTA (Anglais)</label><input name="accountMessageEn" type="text" placeholder="Aucun message" value="<?= isset($_POST['accountMessageEn']) ? $_POST['accountMessageEn'] : $manageInfos['accountMessageEn'] ?>" />
                    <br />
                    <input type="submit" value="Sauvegarder les changements" name="submitMessages" />

                </div>
                <div class="page" page="free">
                    <h1>Mods gratuits</h1>
                    <button type="button" onclick="toggleWizard('free')">Ajouter un mod menu</button>
                    <table>
                        <tbody id="table-body-free">
                            <tr>
                                <td style="width: 19px; text-align: center;"></td>
                                <td style="width: 140px; text-align: center;">Nom</td>
                                <td style="width: 90px; text-align: center;">Statut</td>
                                <td style="width: 160px; text-align: center;">Image</td>
                                <td style="width: 300px; text-align: center;">Lien téléchargement (FR)</td>
                                <td style="width: 300px; text-align: center;">Lien téléchargement (EN)</td>
                                <td style="width: 19px; text-align: center;">Activé</td>
                                <td style="width: 19px; text-align: center;"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8">Enregistrer les modifications</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="wizard" id="free-wizard" style="display: none;">
                        <h1>Ajouter un menu gratuit</h1>
                        <label>Nom</label><input name="name" type="text" placeholder="Nom du menu..." />
                        <br />
                        <label>Statut</label><input name="status" type="text" placeholder="Ex: Safe/Unsafe/Maintenance..." />
                        <br />
                        <label>Image</label><input name="image" type="file" accept="image/png, image/jpeg, image/jpg" />
                        <br />
                        <label>Téléchargement (Français)</label><input name="frDL" type="text" placeholder="Lien de téléchargement..." />
                        <br />
                        <label>Téléchargement (Anglais)</label><input name="enDL" type="text" placeholder="Lien de téléchargement..." />
                        <span>Le menu sera désactivé quand vous cliquerez sur 'Ajouter le menu', il vous restera à l'activer dans le tableau des menus.</span>
                        <button type="button" onclick="addRowForWizardValues('free')">Ajouter le menu</button>
                        <button type="button" style="background-color: grey; margin-top: 10px;" onclick="toggleWizard('free')">Annuler</button>
                    </div>
                </div>
                <div class="page" page="paid">
                    <h1>Mods payants</h1>
                    <span>Cette page n'est pas terminée, passez plus tard</span>
                </div>
                <div class="page" page="accounts">
                    <h1>Comptes GTA</h1>
                    <span>Cette page n'est pas terminée, passez plus tard</span>
                </div>
                <div class="page" page="faq">
                    <h1>FAQ</h1>
                    <span>Cette page n'est pas terminée, passez plus tard</span>
                </div>
                <div class="page" page="contact">
                    <h1>Contact</h1>
                    <span>Cette page n'est pas terminée, passez plus tard</span>
                </div>
            </form>
        </div>
    </body>
</html>