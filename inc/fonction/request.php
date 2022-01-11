<?php
// select
function verifyApiData($date, $identification )
{
    global $pdo;
    $sql = "SELECT date FROM `jsondata` where `date`:date and `identification`:identification";
//    $sql = "SELECT id,nom,prenom,age,email,pseudo,role FROM psv_user LIMIT 5 OFFSET 5";
    $query = $pdo->prepare($sql);
    $query->bindValue(':date',$date);
    $query->bindValue(':identification',$identification);
    $query->execute();
    //return $query->fetchAll();
}

function test()
{
    global $pdo;
    $sql = "SELECT * FROM `jsondata`";
//    $sql = "SELECT id,nom,prenom,age,email,pseudo,role FROM psv_user LIMIT 5 OFFSET 5";
    $query = $pdo->prepare($sql);

    $query->execute();
    return $query->fetchAll();
}

// insert

// update

// delete