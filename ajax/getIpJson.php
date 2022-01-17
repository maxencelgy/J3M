<?php

require'../config.php'; // integre le toolbox
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

$dataIpDest = getIpDest(); //Renvoie ip dest distinct

echo($dataIpDest);