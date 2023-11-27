<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nadzorna plosca</title>
    <link rel="stylesheet" type="text/css" href="style/home.css"/>
</head>
<?php session_start(); ?>
<body>
<div class="container">
    <div id="sidenav">
        <div id="username" style="font-size: 26px;">
            <?php
                $uporabnik = htmlspecialchars($_SESSION['uname']);
                $prilag = str_replace(' ','&nbsp;',$uporabnik);
                echo $prilag;
            ?>
        </div>
        <hr>
        <div class="zgornji">
            <a>
                <span>Domov</span>
            </a>
            <a>
                <span>List</span>
            </a>
            <a>
                <span>Tekmovanja</span>
            </a>
            <a>
                <span>Uspeh</span>
            </a>
        </div>
        <div class="spodnji">
            <p><a href="http://localhost/prijava.php?action=logout">Odjava</a></p>
            <a href="#" class="sideMenuButton" id="sideMenuButtonSettings">
                <img src="images/Icons/Nastavitve.svg" alt="" class="sideMenuButtonIcon">
                <span class="sideMenuButtonText">Nastavitve</span>
            </a>
        </div>
    </div>
    <div id="main">
        <div id="uporabniki">
            <?php
            if (isset($_SESSION['uname']) && $_SESSION['msatg'] = 1){
                //var_dump($_SESSION);
                //echo 'forsen';
            } else {
                header('Location: http://localhost/prijava.php'); //izbrisi pri delanju css-a
            }
            ?>
        </div>
        <div class="main-side">

        </div>
    </div>
</div>
</body>
</html>
<script src="script/dash.js"></script>
