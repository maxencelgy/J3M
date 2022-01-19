<?php

require'../../config.php'; // integre le toolbox
require'../../inc/fonction/pdo.php';
require'../../inc/fonction/request.php';

$dataSql = getJsonDataTcp();  // renvoie les données en JSON

echo($dataSql);
