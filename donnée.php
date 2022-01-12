<?php
session_start();
require_once "config.php";
require_once "inc/fonction/pdo.php";
require_once "inc/fonction/toolbox.php";

include_once('inc/header.php');?>
<section id="myChart">
    <div>
        <canvas id="myChart"></canvas>
    </div>
</section>


<?php include_once ('inc/footer.php');
