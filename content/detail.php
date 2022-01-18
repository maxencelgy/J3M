<?php
session_start();
require_once "../config.php";
require_once "../inc/fonction/pdo.php";
require_once "../inc/fonction/toolbox.php";
include_once('../inc/header.php');
if(isLogged() == true){
?>

<section id="log">
    <div class="title_log">
        <h2>Bonjour <?= $_SESSION['user']['pseudo']?></h2>
        <p>Detail des trames </p>
    </div>
    <div class="search">
        <h2>Graphiques et informations complémentaires</h2>
        <div class="tram">
            <div class="type_tram">
                <label for="trame">Type de trame :</label>
                    <select name="list" id="select-list-detail">
                        <option value="TCP">TCP</option>
                        <option value="UDP">UDP</option>
                        <option value="TLSv1.2">TLSv1.2</option>
                        <option value="ICMP">ICMP</option>
                    </select>
            </div>    
        </div>
</section>

<section class="detail" id="graphique">
    <div class="single_box">
        <canvas id="canvasIcmp1" class="canvas"></canvas>
    </div>  

</section>

<?php include('../inc/footer.php');
}else{
  header('Location: ../pageError/404.php');
}