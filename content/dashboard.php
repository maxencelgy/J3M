<?php
session_start();
require_once "../config.php";
require_once "../inc/fonction/pdo.php";
require_once "../inc/fonction/toolbox.php";
include_once('../inc/header.php');
?>

<section id="searchbar">
    <div class="search">
        <h2>Project Status Dashboard</h2>
        <div class="tram">
        <div class="type_tram">
        <label for="pet-select">Choose a pet:</label>
            <select name="pets" id="pet-select">
                <option value="">--Please choose an option--</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="hamster">Hamster</option>
                <option value="parrot">Parrot</option>
                <option value="spider">Spider</option>
                <option value="goldfish">Goldfish</option>
            </select>
        </div>
        <div class="type_tram">
        <label for="pet-select">Choose a pet:</label>
            <select name="pets" id="pet">
                <option value="">--Please choose an option--</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="hamster">Hamster</option>
                <option value="parrot">Parrot</option>
                <option value="spider">Spider</option>
                <option value="goldfish">Goldfish</option>
            </select>
        </div>
        </div>
       
    </div>
</section>




<?php include('../inc/footer.php');