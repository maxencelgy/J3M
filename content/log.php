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
        <p>Voici les journaux, n'oubliez pas de cliquer sur le bouton actualiser</p>
    </div>
    <div class="search">
        <h2>Journaux</h2>
        <div class="tram">
            <div class="type_tram">
                <label for="trame">Type de trame :</label>
                <select name="list" id="select-list">
                    <option value="ALL">TOUTE</option>
                    <option value="TCP">TCP</option>
                    <option value="UDP">UDP</option>
                    <option value="TLSv1.2">TLSv1.2</option>
                    <option value="ICMP">ICMP</option>
                </select>
            </div>
            <div class="type_tram">
                <label for="trame">Status :</label>
                <select name="listTwo" id="select-list2">
                    <option value="Tous">TOUTE</option>
                    <option value="Acceptée">Acceptée</option>
                    <option value="Refusée">Refusée</option>
                </select>
            </div>
            <div class="log_button">
                <a href="../ajax/sendDataJson.php">Actualiser</a>
                <a class="sendFakeData" href="#">Ajout fausses données</a>
            </div>
        </div>
    </div>

</section>

<div class="popup">
<i id="crossPop" class="fas fa-times"></i>
    <div class="left">
        <h2 class="violet">Id</h2>
        <h2>Date</h2>
        <h2 class="red">Status</h2>
        <h2 class="vert">Nom du protocole</h2>
        <h2 class="vert">Somme de contrôle</h2>
        <h2 class="vert">Protocole TTL</h2>
        <h2 class="orange">Ip Source</h2>
        <h2 class="orange">Ip Destination</h2>
        <h2 class="orange">Version</h2>
        <h2>Longueur d'en-tête</h2>
        <h2>Service</h2>
        <h2>Somme de contrôle d'en-tête</h2>
        <h2 class="orange">Ports from</h2>
        <h2 class="orange">Ports Dest</h2>
        <h2>Flags_code</h2>
        <h2>Code de somme de contrôle du protocole</h2>
    </div>

    <div class="right">
        
    </div>
</div>

<section id="tableau">

<div class="tab">
    <table class="rwd-table">
        <tr>
          <th>Id</th>
          <th>Date / Heure</th>
          <th>Status</th>
          <th>Nom du protocole</th>
          <th>Somme de contrôle</th>
          <th>TTL</th>
          <th>Ip source</th>
          <th>Ip destination</th>
        </tr> 
    </table>    
    <div class="formfirst">        
    </div>
</div>
</section>
<?php include('../inc/footer.php');
}else{
  header('Location: ../pageError/404.php');
}