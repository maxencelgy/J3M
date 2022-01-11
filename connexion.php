<?php
require_once('inc/fonction/pdo.php');
require_once('inc/fonction/request.php');
require_once('inc/fonction/toolbox.php');

include('inc/header.php');

verifUserAlreadyConnected();
$success=false;
$errors = [];

if(!empty($_POST['submitted'])){
    $email = cleanXss('email');
    $password1 = cleanXss('password1');

    //Verification email
    $errors = mailValidation($errors,$email,'email');

    $user = requestVerifLogin($email);

    if(empty($user)){
        $errors['email'] = "Aucun compte trouvé avec cet adresse mail";
    }
    else{
        if(password_verify($password1 , $user['mdp'] )==true){
            $_SESSION['user']=array(
                'id'=>$user['id_user'],
                'pseudo'=>$user['pseudo'],
                'email' =>$user['email'],
                'status'=>$user['status'],
                'ip'=>$_SERVER['REMOTE_ADDR']
            );
        }else {
            $errors['password1'] = "Mot de passe incorrect";
        }
        if(count($errors) == 0) {
            header('Location: index.php');
        }
    }
}

?>

<section id="connexion">
<div class="wrap2">
    <div class="cadre_left">
    <img src="asset/img/wing.png" alt="illustration éclair bleu">
</div>

    <div class="cadre_right">
    <h1>Connexion</h1>
        <form action="" method="post">
            <label for="email">Votre email :</label>
            <input type="text" name="email" id="email" placeholder="exemple@gmail.com" value="<?= recupInputValue('email'); ?>">
            <span class="error"><?= viewError($errors,'email'); ?></span>

            <label for="password1">Mot de passe :</label>
            <input type="password" name="password1" id="password1" placeholder="*****">
            <span class="error"><?= viewError($errors,'password1'); ?></span>

            <input type="submit" name="submitted" id="submitted" value="Se connecter">
        </form>
    </div>
       
    </div>
</section>

<?php include('inc/footer.php');