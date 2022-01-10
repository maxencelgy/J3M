<?php
include('inc/header_b.php');
?>

<section id="connexion">
    <div class="logo"><img src="asset/img/logo.svg" alt=""></div>
        <form action="" method="post" class="box-boite" novalidate>
        <h2>Connexion</h2>  
                <label for="login">E-mail</label>
                <input type="text" id="login" name="login" value="" placeholder="Entrez votre email">
                <span class="error"><?= returnError($error,'login')?></span>

                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" value="<?= returnValue('password') ?>" class="input" placeholder="Entrez votre mot de passe">
                <span class="error"><?= returnError($error,'password')?></span>
                <input type="submit" name="submitted" value="Connexion" class="submit input2">
                <a href="lost-pwd.php">Mot de passe oublié ?</a>
                <p class="inscription">Si vous n'avez pas de compte <a href="inscription.php">inscrivez vous-ici</a></p>
            </form>
</section>

<?php include('inc/footer_b.php');