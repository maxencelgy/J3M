<?php
include('inc/header.php');
?>

<section id="connexion">
    <div class="logo"><img src="asset/img/logo.svg" alt=""></div>
        <form action="" method="post" class="box-boite" novalidate>
        <h2>Connexion</h2>  
                <label for="login">E-mail</label>
                <input type="text" id="login" name="login" vaglue="" placeholder="Entrez votre email">
               
                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" value="" placeholder="Entrez votre mot de passe">
                
                <input type="submit" name="submitted" value="Connexion">
                <a href="">Mot de passe oublié ?</a>
                <p class="inscription">Si vous n'avez pas de compte <a href="inscription.php">inscrivez vous-ici</a></p>
            </form>
</section>

<?php include('inc/footer.php');