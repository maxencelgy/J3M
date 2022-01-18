<?php
session_start();
require_once "../config.php";
require_once('../inc/fonction/pdo.php');
require_once('../inc/fonction/request.php');
require_once('../inc/fonction/toolbox.php');

if(isLogged()){
    header('Location: ../pageError/403.php');
}else{
    $errors = [];
    if(!empty($_POST['submitted'])) {
        // Faille XSS
        $email = cleanXss('email');

        //Verif si email correspond à un user
        $verifUser = requestVerifMailRegister($email);

        if(empty($verifUser)) {
            $errors['email'] = 'Veuillez renseigner un email valide';
        }

        if (count($errors) == 0) {
//        mail($_POST['email'], 'Reinitialisation de votre mot de passe' Ignorez ce mail si vous n'êtes pas à l'origine de cette demande.
//        Cliquez sur ce lien pour choisir un nouveau mot de passe : lien/resetpassword?state=confirmed&token= ', 'From: $email ');
            echo 'Changer votre mot de passe en cliquant sur <a href="changementMdp.php?token=' . urldecode($verifUser['token']) . '&email=' . urldecode($verifUser['email']) . '" style="color: green; text-decoration: underline;">cette page.</a>';
        }
    }
}
include('../inc/header.php'); ?>


    <section id="connexion">
        <div class="wrap2">
            <div class="cadre_left">
                <img src="<?php echo ROOTDIR; ?>asset/img/wing.png" alt="illustration éclair bleu">
            </div>

            <div class="cadre_right">
                <h1>Mot de passe oublié</h1>
                <form action="" method="post">
                    <p style="font-size: 1rem;" >Pour changer votre mot de passe, vous devez renseigner l'email utilisé lors de votre inscription</p>
                    <label for="email">Votre email :</label>
                    <input type="text" name="email" id="email" placeholder="exemple@gmail.com" value="<?= recupInputValue('email'); ?>">
                    <span class="error"><?= viewError($errors,'email'); ?></span>

                    <button class="btn btn-1 hover-filled-slide-down">
                        <input type="submit" name="submitted" id="submitted" value="Confirmer">
                    </button>
                </form>
            </div>
        </div>
    </section>

<?php
include('../inc/footer.php');