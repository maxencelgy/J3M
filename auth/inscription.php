<?php
session_start();
require_once "../config.php";
require_once('../inc/fonction/pdo.php');
require_once('../inc/fonction/request.php');

if(isLogged() == false){

$success=false;
$errors = [];

if(!empty($_POST['submitted'])){
    //Faille Xss
    $pseudo = cleanXss('pseudo');
    $email = cleanXss('email');
    $password1 = cleanXss('password1');
    $password2 = cleanXss('password2');


    $errors = mailValidation($errors,$email,'email');

    if(empty($errors['email'])){
        $verifUserMail = requestVerifMailRegister($email);
        if(!empty($verifUserMail)) {
            $errors['email'] = 'Vous avez déjà un compte avec cette adresse mail';
        }
    }

    //Verif pseudo
    if(!empty($pseudo)){
        if(mb_strlen($pseudo)<3){
            $errors['pseudo'] = "Le pseudo doit comporter au moins 3 caractères.";
        }
    }else{
        $errors['pseudo'] = "Le champ ne doit pas être vide.";
    }

    //Verif Password
    if (!empty($password1) && !empty($password2)){
        if ($password1 != $password2){
            $errors['password2'] = 'Le mot de passe doit être identique';
        }
        elseif (mb_strlen($password2) < 6){
            $errors['password2'] = 'Le mot de passe doit contenir au moins 6 caractères.';
        }
    }elseif (empty($password1) || empty($password2)){
        $errors['password1'] = 'Veuillez renseigner un mot de passe puis confirmez-le.';
    }

    //Verif CGU
    if(empty($_POST['cgu'])){
        $errors['cgu'] = "Vous devez accepter les condition d'utilisation";
    }

    if(count($errors)==0) {
        //hash mot de passe
        $hashPassword = password_hash($password1, PASSWORD_DEFAULT);
        //Generation token
        $token = generateRandomString(100);

        //Request pour ajout user
        addUser($email, $pseudo, $hashPassword, $token);

        $success=true;
        //redirection
        header('refresh:3;url='.ROOTDIR.'auth/connexion.php');
    }
}

include('../inc/header.php');

?>

<?php if($success==false){ ?>
<section id="formulaire">
    <div class="wrap2">
    <div class="cadre_left">
    <img src="../asset/img/wing.png" alt="illustration éclair bleu">
</div>
<div class="cadre_right">
    <h1>Inscription</h1>
        <form action="" method="post">
            <label for="pseudo">Votre pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="ex : Doe" value="<?= recupInputValue('pseudo'); ?>">
            <span class="error"><?= viewError($errors,'pseudo'); ?></span>

            <label for="email">Votre email :</label>
            <input type="text" name="email" id="email" placeholder="exemple@gmail.com" value="<?= recupInputValue('email'); ?>">
            <span class="error"><?= viewError($errors,'email'); ?></span>

            <label for="password1">Mot de passe :</label>
            <input type="password" name="password1" id="password1" placeholder="*******">
            <span class="error"><?= viewError($errors,'password1'); ?></span>

            <label for="password2">Confirmer :</label>
            <input type="password" name="password2" id="password2" placeholder="*******">
            <span class="error"><?= viewError($errors,'password2'); ?></span>

            <div class="cgu">
                <input type="checkbox" id="cgu" name="cgu" class="cgu_check"><a href="../inc/cgu.php">J'accepte les conditions d'utilisation</a>
            </div>
            <span class="error"><?= viewError($errors,'cgu'); ?></span>
            
            <button class="btn btn-1 hover-filled-slide-down">
                <input type="submit" name="submitted" id="submitted" value="S'inscrire">
            </button>

            
        </form>
</div>
        <?php } else {echo'<div class="info_box_success"><h2>Bienvenue ! Votre compte a bien été créé !</h2><h4>Vous allez être redirigé...</h4></div>';} ?>
    </div>
</section>

<?php include('../inc/footer.php');
}else{
    header('Location: ../pageError/403.php');
}


