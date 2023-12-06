<!DOCTYPE html>
<html lang="en" data-theme="light" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nadzorna plosca</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style/global.css"/>
    <link rel="stylesheet" type="text/css" href="style/home.css"/>
</head>
<body>
    <section id="sectionL">
        <div id="sectionLProfileButton">
            <img class="sectionLButtonIcon" id="sectionLProfileButtonIcon" alt="" src="images/testProfilePicture.jpeg"></img>
            <p class="sectionLButtonText" id="sectionLProfileButtonText">Ime</p> <!--       Samo ime nič drugiga        -->
        </div>
        <div class="sectionLButton">
            <i class="fa-solid fa-house sectionLButtonIcon"></i>
            <p class="sectionLButtonText">Domov</p>
        </div>
        <div class="sectionLButton">
            <i class="fa-solid fa-list-ul sectionLButtonIcon"></i>
            <p class="sectionLButtonText">Lestvica</p>
        </div>
        <div class="sectionLButton">
            <i class="fa-solid fa-file-pen sectionLButtonIcon"></i>
            <p class="sectionLButtonText">Tekmovanja</p>
        </div>
        <div class="sectionLButton">
            <i class="fa-solid fa-graduation-cap sectionLButtonIcon"></i>
            <p class="sectionLButtonText">Uspeh</p>
        </div>


        <!---->
        <div class="sectionLButton" id="sectionLSettingsButton">
            <i class="fa-solid fa-gear sectionLButtonIcon"></i>
            <p class="sectionLButtonText">Nastavitve</p>
        </div>
    </section>
    <section id="sectionR">
        <iframe src="home.html" id="sectionLIframe" frameborder="0" data-theme="light" id="darmModeIframe"></iframe>
    </section>
</body>
</html>
<script src="script/dash.js"></script>
<script src="script/menuButtons.js"></script>
<script src="script/darkMode.js"></script>
