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

<!-- TCP -->
<section class="detail " id="graphiqueTCP">
<h2 class="title">TCP</h2>
    <div class="single_box">
        <div class="infos" id="infosTCP"></div>
    </div> 
<div class="single_box">
        <canvas id="canvasTcp1" class="canvas"></canvas>
    </div>
    <div class="single_box">
        <canvas id="canvasTcp3" class="canvas"></canvas>
    </div>  
</section>

<!-- UDP -->

<section class="detail secNone" id="graphiqueUDP">
<h2 class="title">UDP</h2>
<div class="single_box">
     <div class="infos" id="infosUDP"></div>
</div>  
<div class="single_box">
        <canvas id="canvasUdp1" class="canvas"></canvas>
    </div>
    <div class="single_box">
        <canvas id="canvasUdp3" class="canvas"></canvas>
    </div>  
</section>

<!-- TLS V12 -->

<section class="detail secNone" id="graphiqueTLS">
<h2 class="title">TLS</h2>

<div class="single_box">
    <div class="infos" id="infosTLS"></div>
</div>  

<div class="single_box">
        <canvas id="canvasTls1" class="canvas"></canvas>
    
    </div>
    <div class="single_box">
        <canvas id="canvasTls3" class="canvas"></canvas>
    </div>  
</section>

<!-- DETAIL ICMP -->
<section class="detail secNone" id="graphiqueICMP">

<h2 class="title">ICMP</h2>
<div class="single_box">
        <div class="infos" id="infosICMP"></div>
    </div>
<div class="double_box">
        <canvas id="canvasIcmp1" class="canvas"></canvas>
        <canvas id="canvasIcmp2" class="canvas"></canvas>
    </div>

    

    <div class="single_box">
        <canvas id="canvasIcmp3" class="canvas"></canvas>
    </div>  
</section>

<?php include('../inc/footer.php');
}else{
  header('Location: ../pageError/404.php');
}