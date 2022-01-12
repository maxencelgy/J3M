<?php
session_start();
require_once "config.php";
 require_once "inc/fonction/pdo.php";
 require_once "inc/fonction/toolbox.php";

include_once('inc/header.php');
?>

<section id="acceuil">
        <div class="main">
            <img class="imgwhite" src="asset/img/logo white.svg" alt="">
            <h1>Les meilleurs analyste reseaux de Normandie</h1>
            <a href="#infos">voir plus</a>
        </div>
</section>

<section id="analyse">
        <h2 class="title">Supervision du trafic du réseau avec J3M</h2>
</section>


<section id="infos">
	<h2> <i>Ils nous ont fait confiance</i>  </h2>
	<div id="contentContainer" class="trans3d" style="display: block;"> 	
		<section id="carouselContainer" class="trans3d">
			<figure id="item1" class="carouselItem trans3d"><div class="carouselItemInner trans3d"><img src="asset/img/pigier.png" alt=""></div></figure>
			<figure id="item2" class="carouselItem trans3d"><div class="carouselItemInner trans3d"><img src="asset/img/campus.jpg" alt=""></div></figure>
			<figure id="item3" class="carouselItem trans3d"><div class="carouselItemInner trans3d"><img src="asset/img/logo_Need_For_School.jpg" alt=""></div></figure>
			<figure id="item4" class="carouselItem trans3d"><div class="carouselItemInner trans3d"><img src="asset/img/iscom.jpg" alt=""></div></figure>
			<figure id="item5" class="carouselItem trans3d"><div class="carouselItemInner trans3d"><img src="asset/img/supveto.jpg" alt=""></div></figure>
		</section>
	</div>
</section>

<section id="where">
    <h2>Où trouver notre agence </h2>

    <div class="container">
        <div class="contact">
            <div class="box">
                <i class="fas fa-phone-alt"></i>
                <p>55-55-55-55-55</p>
            </div>

            <div class="box">
                <i class="far fa-envelope"></i>
                <p>supportclient@gmail.com</p>
            </div>

            <div class="box">
                <i class="fas fa-map-marked-alt"></i>
                <p>30 Pl. Henri Gadeau de Kerville, 76100 Rouen</p>
            </div>

            <div class="box">
                <i class="far fa-clock"></i>
                <p>Ouvert 7 jours sûr 7 24/24</p>
            </div>
        </div>

        <div class="maps">
            <h3>Google maps :</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2594.8631778922763!2d1.079024015576695!3d49.430400679347684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e0df1548cd768b%3A0x70b4b34959b1ec9f!2sNeed%20for%20School!5e0!3m2!1sfr!2sfr!4v1641908326519!5m2!1sfr!2sfr" width="80%" height="350" style="border: 1px solid black; border-radius:.5rem;" allowfullscreen="" loading="lazy" ></iframe>
        </div>
    </div>

</section>



<?php include('inc/footer.php');




