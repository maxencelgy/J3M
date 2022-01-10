<?php
function cleanXss($key): string
{
    return trim(strip_tags($_POST[$key]));
}

function textValidation(array $errors,string $value,string $key,int $min = 3,int $max = 50):array
{
    if(!empty($value)) {
        if(mb_strlen($value) < $min) {
            $errors[$key] = 'Min '.$min.' caractères';
        } elseif (mb_strlen($value) > $max) {
            $errors[$key] = 'Max '.$max.' caractères';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner ce champ.';
    }
    return $errors;
}

function selectValidation(array $errors,string $value,int $key,array $values):array
{
	$errors[$key] = (count($values)>$key)  ? "veuillez saisir une données valide" : '';

	if(empty($value)) {
		$errors[$key] = 'Veuillez selectionner un etat';
	}
	return $errors;
}

function emailValidation($errors,$email,$key)
{
    if(!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[$key] = 'Veuillez renseigner un email valide';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner un email';
    }
    return $errors;
}

function numberValidation($errors,$value,$key,$min=3,$max=1000000)
{
    if(!is_numeric($value)){
        $errors[$key] = 'Veuillez rentrer un nombre';
        var_dump($value);
    }elseif($value > $max){
        $errors[$key] = 'Nombre trop grand';
        var_dump($value);
    }elseif($value < $min){
        $errors[$key] = 'Nombre trop petit';
        var_dump($value);
    }

    return $errors;
}

function recupInputValue($key){
    if(!empty($_POST[$key]))return $_POST[$key];
}

function viewError($errors,$key):string
{
    return $errors[$key];
}

function recupInputValueForUpdate($key,$data):string
{
    if(!empty($_POST[$key])) {
        $value =  $_POST[$key];
    } else {
        $value = $data;
    }
		return $value;
}

// test

function input(string $key,array $errors,string $class = '',string $type = 'text'){?>
    <label for="<?php echo $key ?>"> <?php echo $key ?> : </label>
    <input type="<?php echo $type ?>" class="<?php echo $class ?>" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php if(!empty($_POST[$key]))echo $_POST[$key]; ?>">
    <span class="error"><?php if(!empty($errors[$key])) {echo $errors[$key];} ?></span><?php
}

function inputUpdate(string $key,array $errors,$data,string $class = '',string $type = 'text'){?>
	<label for="<?php echo $key ?>"> <?php echo $key ?> : </label>
	<input type="<?php echo $type ?>" class="<?php echo $class ?>" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php if(!empty($_POST[$key])) {echo $_POST[$key];}else {echo $data;} ?>">
	<span class="error"><?php if(!empty($errors[$key])) {echo $errors[$key];} ?></span><?php

}

function textArea(string $key,array $errors,string $class = '',$cols = 30, $rows = 5){?>
	<label for="<?php echo $key ?>"><?php echo $key ?> : </label>
	<textarea class="<?php echo $class ?>" name="<?php echo $key ?>" id="<?php echo $key ?>" cols="<?php echo $cols ?>" rows="<?php echo $rows ?>"><?php if(!empty($_POST[$key])) {echo $_POST[$key]; } ?></textarea>
	<span class="error"><?php if(!empty($errors[$key])) {echo $errors[$key]; } ?></span>
<?php
}

function textAreaUpdate(string $key,array $errors,$data,string $class = '',$cols = 30, $rows = 5) {?>
	<label for="<?php echo $key ?>"><?php echo $key ?> : </label>
	<textarea class="<?php echo $class ?>" name="<?php echo $key ?>" id="<?php echo $key ?>" cols="<?php echo $cols ?>" rows="<?php echo $rows ?>"><?php if(!empty($_POST[$key])) {echo $_POST[$key];}else {echo $data;} ?></textarea>
	<span class="error"><?php if(!empty($errors[$key])) {echo $errors[$key];} ?></span>
<?php
}

function radio(string $key,array $errors,array $elements,string $class = '',string $label = 'key'){
// A FAIRE
}

function radioUpdate(){
	
}