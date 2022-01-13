<?php
// select

function verifyApiData($date, $identification )
{
    global $pdo;
    $sql = "SELECT `date` FROM `jsondata` where `date` = :date and `identification`= :identification";
//    $sql = "SELECT id,nom,prenom,age,email,pseudo,role FROM psv_user LIMIT 5 OFFSET 5";
    $query = $pdo->prepare($sql);
    $query->bindValue(':date',$date);
    $query->bindValue(':identification',$identification);
    $query->execute();
    return $query->fetchAll();
}

function getJsonData()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata`";
    $query = $pdo->prepare($sql);
    $query->execute();    
    return json_encode($query->fetchAll());
}
function requestVerifMailRegister($email){
    global $pdo;
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $verifUser = $query->fetch();
    if(!empty($verifUser)) {
        $errors['email'] = 'Vous avez déjà un compte avec cette adresse mail';
    }
}


function requestVerifLogin($email){
    global $pdo;
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}


// insert
function addUser($email, $pseudo, $hashPassword, $token){
    global $pdo;
    $sql = "INSERT INTO `user`(`email`, `pseudo`, `mdp`, `token`, `status`, `created_at`, `modified_at`) 
        VALUES (:email,:pseudo,:mdp,:token,'user',NOW(),NOW())";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->bindValue(':mdp',$hashPassword,PDO::PARAM_STR);
    $query->bindValue(':token',$token,PDO::PARAM_STR);
    $query->execute();
}

function addTrame($date,$version,$headerLength,$service,$identification,$status,$flagsCode,$ttl,$protocolName,$protocolFlagsCode,$protocolChecksumStatus,$protocolChecksumCode,$protocolPortsFrom,$protocolPortsDest,$protocolType,$protocolCode,$headerChecksum,$ipFrom,$ipDest )
{
    global $pdo;
    $sql = "INSERT INTO `jsondata`( `date`, `version`, `headerLength`, `service`, `identification`, `status`, `flags_code`, `ttl`, `protocol_name`, `protocol_flags__code`, `protocol_checksum__status`, `protocol_checksum__code`, `protocol_ports__from`, `protocol_ports__dest`, `protocol_type`, `protocol_code`, `headerChecksum`, `ip_from`, `ip_dest`)
     VALUES (:date,:version,:headerLength,:service,:identification,:status,:flagsCode,:ttl,:protocolName,:protocolFlagsCode,:protocolChecksumStatus,:protocolChecksumCode,:protocolPortsFrom,:protocolPortsDest,:protocolType,:protocolCode,:headerChecksum,:ipFrom,:ipDest)";         
    $query = $pdo->prepare($sql);
    $query->bindValue(':date',$date);
    $query->bindValue(':version',$version);
    $query->bindValue(':headerLength',$headerLength);    
    $query->bindValue(':service',$service);
    $query->bindValue(':identification',$identification);
    $query->bindValue(':status',$status);
    $query->bindValue(':flagsCode',$flagsCode);
    $query->bindValue(':ttl',$ttl);
    $query->bindValue(':protocolName',$protocolName);
    $query->bindValue(':protocolFlagsCode',$protocolFlagsCode);
    $query->bindValue(':protocolChecksumStatus',$protocolChecksumStatus);
    $query->bindValue(':protocolChecksumCode',$protocolChecksumCode);
    $query->bindValue(':protocolPortsFrom',$protocolPortsFrom);
    $query->bindValue(':protocolPortsDest',$protocolPortsDest);
    $query->bindValue(':protocolType',$protocolType);
    $query->bindValue(':protocolCode',$protocolCode);
    $query->bindValue(':headerChecksum',$headerChecksum);
    $query->bindValue(':ipFrom',$ipFrom);
    $query->bindValue(':ipDest',$ipDest);    
    $query->execute();
}
// update

// delete