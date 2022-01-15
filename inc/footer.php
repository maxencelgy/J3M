<footer>
    <div class="footer_logo div_foot">
        <img src="<?php echo ROOTDIR; ?>asset/img/logo white.svg" alt="">
    </div>
    <div class="footer_service div_foot">
        <h2>Nos services</h2>
        <p>Analyse de trame</p>
        <p>Sécurité réseaux</p>
        <p>Hébergement</p>
    </div>
    <div class="footer_contact div_foot">
        <h2>Restons en contact</h2>
        <p>55-55-55-55-55</p>
        <p>supportclient@gmail.com</p>
        <p>30 Pl. Henri Gadeau de Kerville, 76100 Rouen</p>
    </div>
    <div class="footer_horraires div_foot">
        <h2>Horaires</h2>
        <div class="horraires">
            <p>Ouvert 7 jours sûr 7 24/24</p>
        </div>
       

        
    </div>
    <div class="footer_horraires div_foot">
        <h2>Mention légales</h2>
        <p>Ⓡ mentions légales site web crée par la j3m team.</p>
    </div>
    
</footer>


<?php 
$page = basename($_SERVER['PHP_SELF']);

// Determine la page dans laquel on se trouve pour ne pas charger unitilement du js
if($page === 'index.php'){?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r123/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.21/vanta.net.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="asset/js/main.js"></script>
<?php
}else if($page === 'log.php'){?>
<script type="module" src="../asset/js/log.js"></script>
<?php
}else if($page === 'dashboard.php'){?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="../asset/js/dashboard.js"></script>
<?php
}

?>
</body>
</html>
