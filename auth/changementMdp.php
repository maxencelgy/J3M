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
    $success=false;
    $token=urldecode($_GET['token']);
    $email=($_GET['email']);
    $user=getUserResetPassword($email,$token);

    //Si user n'existe pas
    if(empty($user)){
        header('Location: ../pageError/403.php');
    }

    if(!empty($_POST['submitted'])) {
        // Faille xss
        $password  = cleanXss('password');
        $password2 = cleanXss('password2');

        // Recherche de l'utilisateur par son token
        $user = getUserByToken($token);

        // Changement mot de passe
        if(!empty($password) || !empty($password2)) {
            if($password != $password2) {
                $errors['password'] = 'Veuillez renseigner des mot de passe identiques';
            } elseif (mb_strlen($password2) < 6) {
                $errors['password'] = 'Min 6 caractères pour votre mot de passe';
            }
        } else {
            $errors['password'] = 'Veuillez renseigner un mot de passe';
        }

        if(count($errors) == 0) {
            // hashpassword
            $hashpassword = password_hash($password,PASSWORD_DEFAULT);
            // Changement mot de passe en base de données
            updatePassword($hashpassword, $token);
            // redirection
            $success=true;
            header('refresh:2;url='.ROOTDIR.'auth/connexion.php');
        }
    }
}

include('../inc/header.php');

if($success==false){
?>

    <section id="formulaire">
        <div class="wrap2">
            <div class="cadre_left">
                <img src="<?php echo ROOTDIR; ?>asset/img/wing.png" alt="illustration éclair bleu">
            </div>

            <div class="cadre_right">
                <h1>Changement mot de passe</h1>
                <form action="" method="post">
                    <p style="font-size: 1rem;" >Veuillez renseigner votre nouveau mot de passe</p>
                    <label for="password">Nouveau mot de passe :</label>
                    <input type="password" name="password" id="password" placeholder="******">
                    <span class="error"><?= viewError($errors,'password'); ?></span>

                    <label for="password2">Nouveau mot de passe :</label>
                    <input type="password" name="password2" id="password2" placeholder="******">
                    <span class="error"><?= viewError($errors,'password2'); ?></span>

                    <button class="btn btn-1 hover-filled-slide-down">
                        <input type="submit" name="submitted" id="submitted" value="Modifier">
                    </button>
                </form>
            </div>
        </div>
    </section>
<?php
}else{
    echo'<div class="info_box_success"><h2>Mot de passe modifié avec succès !</h2><h4>Redirection ...</h4></div>';
}
include('../inc/footer.php');
