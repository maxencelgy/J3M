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
            <select name="trame" id="trame">
                <option value="tcp">TCP</option>
                <option value="udp">UDP</option>
                <option value="tls">TLSv1.2</option>
                <option value="icmp">ICMP</option>
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
    <th>Ip venant</th>
    <th>Ip destination</th>
  </tr>
  <!-- <tr>
    <td data-th="id">0xf30f</td>
    <td data-th="status">Good</td>
    <td data-th="protocole">UDP</td>
    <td data-th="checksum" class="disable">disabled</td>
    <td data-th="ttl">128</td>
    <td data-th="portA">50046</td>
    <td data-th="portB">3481</td>
    <td data-th="ipA">c0a8014a</td>
    <td data-th="ipB">3470ff25</td>
  </tr> -->
  
</table>


    <div class="formfirst">
        


    </div>


    </div>
</section>



<?php }else{
  header('Location: ../index.php');
} include('../inc/footer.php');