<?php

require'../config.php'; // integre le toolbox
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

$dataSql = getJsonData();  // renvoie les données en JSON
echo($dataSql);
