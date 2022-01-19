<?php

require'../config.php';
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

$dataUdpStatus = getTcpStatus(); //Renvoie status et nb UDP

echo($dataTcpStatus);