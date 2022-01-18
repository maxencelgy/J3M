<?php

require'../config.php';
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

$dataUdpStatus = getUdpStatus(); //Renvoie status et nb UDP

echo($dataUdpStatus);