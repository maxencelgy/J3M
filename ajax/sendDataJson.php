<?php
require'../config.php'; // integre le toolbox
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';
// appel de l'API
$json_url = "http://51.255.160.47:8282/resources/frames.json";
$json     = file_get_contents($json_url);
echo $json;
// transformation de l'API en un objet
$data = json_decode(($json));
debug($data);
// boucle de toutes les data
// On verifi que les datas ne soit pas en base
// Si oui on ne fait rien
// Si non on insert les nouvelles données de l'api
$i =0; 

echo($data[0]->protocol->name);
foreach($data as $trame)
{   
    // Variables (pour plus de visiblité et remplis donnes au cas où le champs est vide)
    // 1 : date
    $date                   = (!empty($trame->date)) ? $trame->date : '';
    // 2 : version   
    $version                = (!empty($trame->version)) ? $trame->version : '';
    // 3 : headerLength   
    $headerLength           = (!empty($trame->headerLength)) ? $trame->headerLength : '';
    // 4 : service   
    $service                = (!empty($trame->service)) ? $trame->service : '';
    // 5 : identification   
    $identification         = (!empty($trame->identification)) ? $trame->identification : '';
    // 6  : status   
    $status                 = (!empty($trame->status)) ? $trame->status : '';
    // 7 : flags.code   
    $flagsCode              = (!empty($trame->flags->code)) ? $trame->flags->code : '';
    // 8 : ttl   
    $ttl                    = (!empty($trame->ttl)) ? $trame->ttl : '';
    // 9 : protocol.name   
    $protocolName           = (!empty($trame->protocol->name)) ? $trame->protocol->name : '';
    // 10 : protocol.flags.code
    $protocolFlagsCode      = (!empty($trame->protocol->flags->code)) ? $trame->protocol->flags->code : '';
    // 11 :  protocol.checksum.status 
    $protocolChecksumStatus = (!empty($trame->protocol->checksum->status)) ? $trame->protocol->checksum->status : '';
    // 12 : protocol.checksum.code
    $protocolChecksumCode   = (!empty($trame->protocol->checksum->code)) ? $trame->protocol->checksum->code : '';
    // 13 :  protocol.ports.from
    $protocolPortsFrom      = (!empty($trame->protocol->ports->from)) ? $trame->protocol->ports->from : '';
    // 14 : protocol.ports.dest
    $protocolPortsDest      = (!empty($trame->protocol->ports->dest)) ? $trame->protocol->ports->dest : '';
    // 15 : protocol.type
    $protocolType           = (!empty($trame->protocol->type)) ? $trame->protocol->type : '';
    // 16 :  protocol.code
    $protocolCode           = (!empty($trame->protocol->code)) ? $trame->protocol->code : '';
    // 17 : headerChecksum
    $headerChecksum         = (!empty($trame->headerChecksum)) ? $trame->headerChecksum : '';
    // 18 : ip.from
    $ipFrom                 = (!empty($trame->ip->from)) ? $trame->ip->from : '';
    // 19 : ip.dest
    $ipDest                 = (!empty($trame->ip->dest)) ? $trame->ip->dest : '';   

    $isVoid = verifyApiData($date, $identification);

    if(empty($isVoid)){
        addTrame($date,$version,$headerLength,$service,$identification,$status,$flagsCode,$ttl,$protocolName,$protocolFlagsCode,$protocolChecksumStatus,$protocolChecksumCode,$protocolPortsFrom,$protocolPortsDest,$protocolType,$protocolCode,$headerChecksum,$ipFrom,$ipDest);
    }
}
// debug ($data[0]);
