<?php
session_start();
require_once "../config.php";
require_once "../inc/fonction/pdo.php";
require_once "../inc/fonction/toolbox.php";
include_once('../inc/header.php');


if(isLogged() == true){

?>




<section id="hello">
    <h2>Bonjour <?= $_SESSION['user']['pseudo']?></h2>
    <p>Voici les dernieres données mise à jours</p>
</section>

<section id="searchbar">
    <div class="search">
        <h2>Tableau de bord</h2>
        <div class="tram">
        <a href="../ajax/sendDataJson.php">Actualiser</a>

        </div>
       
    </div>
</section>

<section id="graphique">
    <div class="double_box">
        <canvas id="canvas1" class="canvas"></canvas>
        <canvas id="canvas2" class="canvas"></canvas>
    </div>

    <div class="single_box">
        <canvas id="canvas3" class="canvas"></canvas>
    </div>

    <div class="double_box">
        <canvas id="canvas4" class="canvas"></canvas>
        <canvas id="canvas5" class="canvas"></canvas>
    </div>

</section>



<?php include('../inc/footer.php');
}else{
  header('Location: ../pageError/404.php');
}
