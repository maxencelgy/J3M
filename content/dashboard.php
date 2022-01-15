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
        <!-- <div class="type_tram">
        <label for="trame">Type de trame :</label>
            <select name="trame" id="trame">
                <option value="tcp">TCP</option>
                <option value="icmp">ICMP</option>
                <option value="ip">IP</option>
            </select>
        </div>
        <div class="type_tram">
        <label for="pet-select">Date :</label>
            <select name="pets" id="pet">
                <option value="">24h</option>
                <option value="dog">1 mois</option>
                <option value="cat">2 mois</option>
                <option value="hamster">3 mois</option>
                <option value="parrot">4 mois</option>
            </select>
        </div> -->
        <a href="../ajax/sendDataJson.php">Refresh</a>

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



<?php }else{
  header('Location: ../index.php');
} include('../inc/footer.php');
