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
        if (!empty($_SESSION['user']['id'])) {
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
        header('Location: pageError/403.php');
    }
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


/*
 * Cette fonction boucle dans l'URL explosé précédemment
 * Si c'est index.php ou /, on peuple une string
 * par exemple /projet_reseau/J3M/
 * SINON c'est connexion.php par exemple, on peuple une string
 * en enlevant le sous-dossier du fichier pour garder /projet_reseau/J3M/
 */
function loopUri($array, $index){
    $result = "";
    /*
    $array = [
        0 => "",
        1 => "projet_reseau",
        2 => "J3M",
        3 => "index.php"
    ]
    $key = 0, 1, 2, 3.... du tableau ci-dessus
    $string = "", "projet_reseau", "J3M", "index.php"... ci-dessus
    */
    foreach($array as $key => $string)
    {
        if($index && $key < count($array) - 1)
        {
            // Si l'URL est /projet_reseau/J3M/index.php
            $result .= $string."/";
        }elseif(!$index && $key < count($array) - 2){
            // Sinon si l'URL est /projet_reseau/J3M/auth/connnexion.php
            // par exemple...
            // On s'arrête non pas à connexion.php mais à auth/
            $result .= $string."/";
        }
    }
    return $result;
}
/*
 * Cette fonction sépare l'URL en morceaux via "/"
 * Si c'est index.php ou / on appelle loopUri avec TRUE
 * Sinon, ce sont tous les autres (auth/connexion.php par exemple) avec FALSE
 */
function getCurrentFile(){
    $array = explode('/',$_SERVER['REQUEST_URI']);

    $result = '';
    // count($array) return le nombre d'élément du tableau
    // pour avoir le dernier élément du tableau, on fait -1
    // car un tableau commence à zéro, le count commence à 1
    if($array[count($array)-1] === 'index.php' || $array[count($array)-1] === ''){
        $result = loopUri($array, true);
    }else{
        $result = loopUri($array, false);
    }
   
   return $result;
}
function recupInputValue($key){
    if (!empty($_POST[$key])) {
        echo $_POST[$key];
    }

}




