<?php
// Il y a un style différent du header pour la page d'accueil
// On test la page, si on est n'est pas sur l'accueil 
// On ajoute un class au header pour qu'il s'addapte au style voulu

// Si vrai = true (index.php ou racine), si non = second (=> class changement graphique pour le header)
$classHeader = (basename($_SERVER['PHP_SELF']) === 'index.php') ?: 'second';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo ROOTDIR; ?>asset/css/styles.css">
    <title>J3M Analyste Tram Normandie</title>
</head>
<body>


<header class="<?php echo $classHeader; ?>" id="header">
    <nav>
        <div class="logo_nav">
           <a class="linkNav" href="<?php echo ROOTDIR; ?>index.php"><img src="<?php echo ROOTDIR; ?>asset/img/logo.svg" alt="logo du site"></a>
        </div>
        <div class="header_btn">
            <?php if($classHeader === true){?>
            <a class="linkNav" href="#infos">A propos</a>
            <a class="linkNav" href="#where">Contact</a>
            <?php
            }            
            if(isLogged()){ ?>
            <a class="linkNav" href="<?php echo ROOTDIR; ?>auth/deconnexion.php">Déconnexion</a>
            <?php }else{ ?>
            <a class="linkNav" href="<?php echo ROOTDIR; ?>auth/inscription.php">Inscription</a>
            <a class="linkNav" href="<?php echo ROOTDIR; ?>auth/connexion.php">Connexion</a>
            <?php } ?>
        </div>
    </nav>
</header>
