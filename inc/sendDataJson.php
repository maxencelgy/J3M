<?php
include "../config.php";
require(ROOTDIR.'/inc/fonction/pdo.php');
require(ROOTDIR.'/inc/fonction/request.php');
require(ROOTDIR.'/inc/fonction/toolbox.php');


$json_url = "http://51.255.160.47:8282/resources/frames.json";
$json = file_get_contents($json_url);
echo $json;
$data = json_decode(($json));
 debug($data);

global $pdo;
var_dump($pdo);
foreach($data as $trame){

    
    // echo($trame->protocol->checksum->status);
   
     // verifier si trame n'est pas déjà en base
    
    // Si oui ne rien faire 
    // Si non executer l'update

}
// debug ($data[0]);