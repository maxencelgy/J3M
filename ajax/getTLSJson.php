<?php

require'../config.php';
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

$dataTlsStatus = getTlsStatus(); //Renvoie status et nb UDP

echo($dataTlsStatus);