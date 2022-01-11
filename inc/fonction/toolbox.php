<?php
function debug(array $tableau)
{
    echo '<pre style="height:300px;overflow-y: scroll;font-size: .7rem;padding: .6rem;font-family: Verdana;background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}
function dump($value)
{
    echo '<pre style="height:150px;overflow-y: scroll;font-size: 1rem;padding: .5rem;font-family: Verdana;background-color: #111;color:#eee;">';
    var_dump($value);
    echo '</pre>';
}
function mailValidation($errors,$value,$key){
    if(!empty($value)){
        if (filter_var($value, FILTER_VALIDATE_EMAIL)==false) {
            $errors[$key]='Veuillez renseigner un email valide';
        }
    } else{
        $errors[$key]='Veuillez renseigner ce champ';
    }
    return $errors;
}

function cleanXss($key){
    return trim(strip_tags($_POST[$key]));
}

function isLogged()
{
    if(!empty($_SESSION['user'])) {
        if (!empty($_SESSION['user']['id_user'])) {
            if (!empty($_SESSION['user']['email'])) {
                if (!empty($_SESSION['user']['pseudo'])){
                    if (!empty($_SESSION['user']['status'])) {
                        if (!empty($_SESSION['user']['ip'])) {
                            if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}

function isAdmin()
{
    if(isLogged()) {
        if($_SESSION['user']['status'] == 'admin') {
            return true;
        }
    }
    return false;
}

function verifUserAlreadyConnected(){
    if (isLogged()==true){
        header('Location: index.php');
    }else{ }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function viewError($errors,$key){
    if(!empty($errors[$key])) {
        echo $errors[$key];
    }
}

function recupInputValue($key){
    if (!empty($_POST[$key])) {
        echo $_POST[$key];
    }
}


