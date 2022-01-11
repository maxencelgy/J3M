<?php
session_start();
require('inc/fonction/pdo.php');
require('inc/fonction/request.php');
require('inc/fonction/toolbox.php');

verifUserAlreadyConnected();
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

    }
}

include('inc/header.php');
?>

<section id="inscription">
    <div class="wrap2">
        <h1>Inscription</h1>
        <form action="" method="post">
            <label for="nom">Votre nom :</label>
            <input type="text" name="nom" id="nom" placeholder="ex : Doe">

            <div class="form_separator"></div>

            <label for="prenom">Votre prénom :</label>
            <input type="text" name="prenom" id="prenom" placeholder="ex : John">

            <div class="form_separator"></div>

            <label for="email">Votre email :</label>
            <input type="email" name="email" id="email" placeholder="exemple@gmail.com">

            <div class="form_separator"></div>

            <label for="password1">Mot de passe :</label>
            <input type="password" name="password1" id="password1">

            <div class="form_separator"></div>

            <label for="password2">Confirmer :</label>
            <input type="password" name="password2" id="password2">

            <div class="form_separator"></div>

            <input type="submit" name="submitted" id="submitted" value="S'inscrire">
        </form>
    </div>
</section>


