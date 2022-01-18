<?php

require'../config.php';
require'../inc/fonction/pdo.php';
require'../inc/fonction/request.php';

$dataIcmpStatus = getIcmpStatus(); //Renvoie status et nb ICMP

echo($dataIcmpStatus);