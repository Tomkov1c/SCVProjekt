<!DOCTYPE html>
<html lang="en" data-theme="light" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nadzorna Plošča</title>
</head>
<?php session_start();
session_regenerate_id();?>
<body>
    <section id="sectionL">
        <?php
            if ($_SESSION['stat'] == true) { //to kar vidi ucitelj
                ?>
                <button onclick="switchSub('subpages/home.php', this)" id="active"><i class="fa-solid fa-house"></i><p>Dom</p></button>
                <button onclick="switchSub('subpages/vnos.php', this)"><i class="fa-solid fa-i-cursor"></i><p>Vnos</p></button>
                <button onclick="switchSub('subpages/obvestila.php', this)"><i class="fa-solid fa-bullhorn"></i><p>Obvestila</p></button>
                <button onclick="switchSub('subpages/admin.php', this)"><i class="fa-solid fa-shield"></i><p>Admin</p></button>
                <?php
            }
            if ($_SESSION['stat'] == false) { //to kar vidi dijak
                ?>
                <button onclick="switchSub('subpages/home.php', this)" id="active"><i class="fa-solid fa-house"></i><p>Dom</p></button>
                <button onclick="switchSub('subpages/pogled.php', this)"><i class="fa-solid fa-eye"></i><p>Pogled</p></button>
                <button onclick="switchSub('subpages/vnosDosezka.php', this)"><i class="fa-solid fa-sheet-plastic"></i><p>Vnos Dosežka</p></button>
                <?php
            }
        ?>

        <!-- <button onclick="switchSub('subpages/razred.html', this)"><i class="fa-solid fa-compass-drafting"></i><p>3. TRB</p></button>
        <button><i class="fa-solid fa-compass-drafting"></i><p>3. TRA</p></button> -->
        <!--Bottom-->
        <button onclick="switchSub('subpages/nastavitve.html', this)" class="bottom"><i class="fa-solid fa-gear"></i><p>Nastavitve</p></button>
        <button><i class="fa-solid fa-right-from-bracket" ></i><a href="prijava.php?action=logout">Izpis</a></button>
    </section>
    <section id="sectionR">
        <iframe id="iframe" src="subpages/home.php" data-theme="dark" frameborder="0" sandbox="allow-same-origin allow-scripts allow-forms">

        </iframe>

    </section>
</body>
<script src="script/darkMode.js"></script>
<script src="script/devMenu.js"></script>
<script src="script/subpageSwitch.js"></script>
</html>