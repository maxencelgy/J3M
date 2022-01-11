<?php
include('inc/header.php');
?>

<section id="connexion">
<div class="wrap2">
    <div class="cadre_left">
    <img src="asset/img/wing.png" alt="">
</div>

    <div class="cadre_right">
    <h1>Connexion</h1>
        <form action="" method="post">
            <label for="email">Votre email :</label>
            <input type="email" name="email" id="email" placeholder="exemple@gmail.com">

            <div class="form_separator"></div>

            <label for="password1">Mot de passe :</label>
            <input type="password" name="password1" id="password1">

            <div class="form_separator"></div>
            <input type="submit" name="submitted" id="submitted" value="Se connecter">
        </form>
    </div>
       
    </div>
</section>

<?php include('inc/footer.php');