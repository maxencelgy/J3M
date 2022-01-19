<?php
// /* code commenté pour éviter ajout donné via URL (réalisé une fois en base)

require'../config.php'; // integre le toolbox
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

echo substr(sha1(mt_rand()),17,4); //To Generate Random Numbers with Letters.
echo substr(sha1(mt_rand()),17,5); //titre

$IpDest = ['3470ff25','343111a8','acd913e3','c0a8014a','d83ac6ce','c0a8c99f','acd90734','acd9efed','0d85c1c6','0d8523b1'];
// randomBitintoHexa
echo '<br>';
echo $IpDest[9];
echo '<br>';
$bytes = random_bytes(2);
echo '<br>';
var_dump(bin2hex($bytes));
echo '<br>';

echo random_int(1,100);
echo '<br>';
// protocol code false
$dateMax = 1606906653;
// verssion iP V4 80% ipV6 20%
// si IPv6 hearder lenght = 40
// et nom service = 0x20
// ttl 90% 128 1% avec 0 9% avec un nombre en enter 13 et 127
// protocol name reste 'ICMP' | 10% 'TCP' | 10% 'TLSv1.2' | 30% 'UDP'
// ICMP protolcol status 95% good autre 10%
// si good headerCheckSum & protocol-checksum = '0x(random)(random)(random)(random)

for($i=0; $i<80 ;$i++){
    //   generedate
    $date =  $dateMax-(random_int(1,10000000)); 
    //ttl
    $randomTtl = random_int(0,100);
    if($randomTtl<90){
        $ttl = 128;
    }elseif($randomTtl<99){
        $ttl = 10+random_int(0,117);
    }else{
        $ttl=0;
        $status = 'any';
    }
    // genereID  
    $identification = 'x0'.substr(sha1(mt_rand()),17,5);     
    // Version 
    $randomIpType = random_int(0,100);
        if($randomIpType>40){
            $version = '4'; //60%
            $service = '0x00';
        }else{
            $version = '6'; //40%
            $service = '0x20';
        }
    // nomProtocol
    $randomProtocol = random_int(0,100);
    $protocolPortsDest  = '443';
    $protocolCode = 'Fausses Données';
    $flagsCode = '0x00';
    $status ='';
    $protocolType = '';
    if($randomIpType<50){
        $protocolName = 'ICMP';
        $protocolPortsFrom = '51062';
        $randomGood = random_int(0,100);
        $protocolFlagsCode  = '0x01'.rand(1, 9);
        $rand2 = random_int(0,100);
        
        if($rand2<10){
        $status ='timeout';
        $ttl = 128;
        $protocolType = 8;
        }
        $rand3 = random_int(0,10);
        if($rand2<7)$protocolType = 8;
        if($randomGood<90){
            $protocolChecksumStatus  = 'good';
        }else{
            $protocolChecksumStatus  = 'disabled';
        }
    }elseif($randomIpType<60){
        $protocolName  = 'TLSv1.2';
        $protocolPortsFrom = '50046';
        $protocolFlagsCode = '0x01'.rand(1, 9);
        $randomGood = random_int(0,100);
        $flagsCode = '0x40';
        if($randomGood<20){
            $protocolChecksumStatus  = 'good';
        }else{
            $protocolChecksumStatus  = 'disabled';
        }
    }elseif($randomIpType<70){
        $protocolName  = 'TCP';
        $protocolPortsFrom = '51062';
        $protocolFlagsCode = '0x01'.rand(1, 9);
        $randomGood = random_int(0,100);
        if($randomGood<10){
            $protocolChecksumStatus  = 'good';
        }else{
            $protocolChecksumStatus  = 'disabled';
        }
    }else{
        $protocolName = 'UDP';
        $protocolPortsFrom = '50046';
        $protocolFlagsCode = '';
        $protocolePortsDest = '3481';
        $randomGood = random_int(0,100);
        if($randomGood<58){
            $protocolChecksumStatus  = 'good';
        }else{
            $protocolChecksumStatus  = 'disabled';
        }
    }
    if($protocolChecksumStatus == 'good'){
        $protocolChecksumCode  = '0x435'.rand(9, 1);;
        $headerChecksum = '0x'.substr(sha1(mt_rand()),17,4);
    }else{
        $protocolChecksumCode  ='';
        $headerChecksum = 'unverified';
    }
        
       // echo $titre.' Ip version : '.$version.' date : '.$date;
        
        // ip Dest
    $rand = random_int(0,100);
    if($rand<15){
        $ipDest = $IpDest[0];
    }elseif($rand<25){
        $ipDest = $IpDest[1];
    }elseif($rand<30){
        $ipDest = $IpDest[2];
    }elseif($rand<42){
        $ipDest = $IpDest[3];
    }elseif($rand<57){
        $ipDest = $IpDest[4];
    }elseif($rand<66){
        $ipDest = $IpDest[5];
    }elseif($rand<83){
        $ipDest = $IpDest[6];
    }elseif($rand<90){
        $ipDest = $IpDest[7];
    }elseif($rand<95){
        $ipDest = $IpDest[8];
    }elseif($rand<30){
        $ipDest = $IpDest[9];
    }
    $bytes = random_bytes(5);
    $ipFrom = bin2hex($bytes);

    
    $headerLength = 20;
 
    
    //echo $date,$version,$headerLength,$service,$identification,$status,$flagsCode,$ttl,$protocolName,$protocolFlagsCode,$protocolChecksumStatus,$protocolChecksumCode,$protocolPortsFrom,$protocolPortsDest,$protocolType,$protocolCode,$headerChecksum,$ipFrom,$ipDest;
    
    addTrame($date,$version,$headerLength,$service,$identification,$status,$flagsCode,$ttl,$protocolName,$protocolFlagsCode,$protocolChecksumStatus,$protocolChecksumCode,$protocolPortsFrom,$protocolPortsDest,$protocolType,$protocolCode,$headerChecksum,$ipFrom,$ipDest);
    
    
}//fin for


?>
// */