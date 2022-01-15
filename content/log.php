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
        <p>Voici les logs</p>
    </div>
    <div class="search">
        <h2>Dashboard Log</h2>
        <div class="tram">
        <div class="type_tram">

      
        <label for="trame">Type de trame :</label>
            <select name="list" id="select-list">
                <option value="ALL">ALL</option>
                <option value="TCP">TCP</option>
                <option value="UDP">UDP</option>
                <option value="TLSv1.2">TLSv1.2</option>
                <option value="ICMP">ICMP</option>
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
        </div>
        <a href="../ajax/sendDataJson.php">Refresh</a>
        </div>
</section>


<section id="tableau">
<div class="tab">
    <table class="rwd-table">
        <tr>
          <th>Id</th>
          <th>Date</th>
          <th>Status</th>
          <th>Protocole Name</th>
          <th>Protocole Checksum</th>
          <th>TTL</th>
          <th>Ip source</th>
          <th>Ip destination</th>
        </tr> 
    </table>
    <div class="formfirst">        
    </div>
</div>
</section>
<?php }else{
  header('Location: ../index.php');
} include('../inc/footer.php');