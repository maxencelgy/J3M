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

<<<<<<< HEAD

=======
function requestVerifLogin($email){
    global $pdo;
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
>>>>>>> b9fdb5237f5f989494aacd12f26a145401b75c9d

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
// update

// delete