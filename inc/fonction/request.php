<?php
// select
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
// update

// delete