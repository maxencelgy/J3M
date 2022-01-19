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

//SELECT ip dest
function getIpDest(){
    global $pdo;
    $sql = "SELECT COUNT(ip_dest) AS nbIp, ip_dest FROM `jsondata` GROUP BY ip_dest";
    $query = $pdo->prepare($sql);
    $query->execute();
    return json_encode($query->fetchAll());
}

//SELECT ICMP STATUS
function getIcmpStatus(){
    global $pdo;
    $sql = 'SELECT protocol_name AS nbICMP, status FROM `jsondata` WHERE protocol_name = "ICMP" ';
    $query = $pdo->prepare($sql);
    $query->execute();
    return json_encode($query->fetchAll());
}

function getJsonData()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata` ORDER BY `jsondata`.`date` DESC";
    $query = $pdo->prepare($sql);
    $query->execute();    
    return json_encode($query->fetchAll());
}

function getJsonDataIcmp()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata` WHERE `protocol_name` = 'ICMP'";
    $query = $pdo->prepare($sql);
    $query->execute();    
    return json_encode($query->fetchAll());
}
function getJsonDataUdp()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata` WHERE `protocol_name` = 'UDP'";
    $query = $pdo->prepare($sql);
    $query->execute();    
    return json_encode($query->fetchAll());
}
function getJsonDataTls()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata` WHERE `protocol_name` = 'TLSv1.2'";
    $query = $pdo->prepare($sql);
    $query->execute();    
    return json_encode($query->fetchAll());
}
function getJsonDataTcp()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata` WHERE `protocol_name` = 'TCP'";
    $query = $pdo->prepare($sql);
    $query->execute();    
    return json_encode($query->fetchAll());
}

//Requete pour recuper//Function pour recuperer user après clique sur lien du mail changement de mdp
function getUserResetPassword($email,$token){
    global $pdo;
    $sql="SELECT * FROM user WHERE email = :email AND token= :token";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':email',$email,PDO::PARAM_INT);
    $query ->bindValue(':token',$token,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}
//Recupère utilisateur par son token
function getUserByToken($token){
    global $pdo;
    $sql = "SELECT * FROM user WHERE token=:token ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':token',$token,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
//Changement mot de passe en bdd
function updatePassword($password, $token){
    global $pdo;
    $sql = "UPDATE user SET `mdp`=:password WHERE token=:token";
    $query = $pdo->prepare($sql);
    $query->bindValue(':password',$password,PDO::PARAM_STR);
    $query->bindValue(':token',$token,PDO::PARAM_STR);
    $query->execute();
}




function requestVerifMailRegister($email){
    global $pdo;
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
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