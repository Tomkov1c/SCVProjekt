<?php
require_once 'povezava.php';
?>
<!DOCTYPE html>
<html lang="en" id="darmModeID" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domača Stran</title>
    <link rel="stylesheet" type="text/css" href="style/global.css" />
    <link rel="stylesheet" type="text/css" href="style/index.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<header id="header">
    <img alt="" src="images/Logos/SCV.svg" id="SCV">
    <div id="headerPointers">
        <a href="#sec1" class="headerPointerButton">Prijava</a>
        <a href="#sec2" class="headerPointerButton">Kaj omogoča</a>
        <a href="#sec3" class="headerPointerButton">Top dijaki</a>
        <a href="#sec4" class="headerPointerButton">Razvijalci</a>
    </div>
</header>
<body id="body">
    <section id="sec1">
        <h1>Dosežki tukaj,</h1>
        <h1>tam in</h1>
        <h1>povsod</h1>
        <p>Sledite svojim akademskim dosežkom kjerkoli in kadarkoli</p>
        <a href="prijava.php"><i class="fa-solid fa-right-to-bracket"></i><p>Prijava</p></a>
    </section>
    <section id="sec2">
        <div>
            <h1 class="sectionTitle"><i class="fa-solid fa-circle-info"></i>Kaj omogoča</h1>
            <h2>dijakom / dijakinjam?</h2>
            <p>Spremljanje svojih dosežkov skozi vsa leta izobraževanja. Poglejte si uspeh svojih sošolcev in "tekmujte". Profesorje / mentorje opozorite na pozabljen vpis.</p>
            <h2>profesorjem / profesoricam?</h2>
            <p>Vpisovanje dosežkov posameznim dijakom katerim ste mentor / mentorica. Če pa na to pozabite vas lahko dijaki na to tudi opozorijo in to lahko tudi spremljate v tej aplikaciji, pod zavihkom "Obvestila".</p>
            <h2>vsem uporabnikom?</h2>
            <p>Temni način za lažjo vidljivost. Preprosta uporaba. Vpis s EMŠO ali Microsoft računom.</p>
        </div>
        <img src="images/graduation.jpg">
    </section>
    <section id="sec3">
        <h1 class="sectionTitle"><i class="fa-solid fa-book-open-reader"></i>Top dijaki</h1>
        <p>Spoznajte naše najboljše dijake, ki s svojo predanostjo, znanjem in dosežki izstopajo med svojimi vrstniki. Ti nadarjeni posamezniki ne le dosegajo odlične rezultate, temveč tudi navdihujejo druge s svojo strastjo do učenja in dosežkov na različnih področjih. Odkrijte, kako se izstopajo in kaj jih dela edinstvene v naši skupnosti.</p>
        <div>
            <div>
                <?php
                    for ($i = 0; $i <= 2; $i++) { 
                        $query = "SELECT d.id_di, d.ime, d.priimek, sl.leto, COUNT(dd.id_dd) AS mentions_count FROM dijaki d LEFT JOIN dijaki_dosezki dd ON d.id_di = dd.id_di LEFT JOIN razredi_dijaki rd ON d.id_di = rd.id_di LEFT JOIN solska_leta sl ON rd.id_sl = sl.id_sl GROUP BY d.id_di, d.ime, d.priimek, sl.leto ORDER BY mentions_count DESC LIMIT 5;";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<div>';
                            echo '<img src="images/testProfilePicture.jpeg" alt="">';
                            echo "<p class='ime'>" . $row['ime'] . " " . $row['priimek'] . "</p>";
                            echo "<p class='leto'>" . $row['leto'] . "</p>";
                            echo "<p class='tocke'>" . $row['mentions_count'] . "</p>";
                            echo '</div>';

                        }
                    }
                ?>
                <!-- 
                <div><img src="images/testProfilePicture.jpeg" alt=""><p class="ime">Jure Primer</p><p class="leto">2024 / 2025</p><p class="tocke">437</p></div>
                -->
            </div>
        </div>
    </section>
    <section id="sec4">
        <h1 class="sectionTitle"><i class="fa-solid fa-code"></i></i>Razvijalci</h1>
        <div>
            <a target="_blank" href="https://github.com/Tomkov1c"><img src="https://avatars.githubusercontent.com/u/83597418?v=4"><div><h1>Tom Kliner</h1><p>Dezajn, Frontend</p></div></a>
            <a target="_blank" href="https://github.com/MarkieWasTaken"><img src="https://avatars.githubusercontent.com/u/146825528?v=4"><div><h1>Mark Kotnik</h1><p>Frontend, Backend</p></div></a>
            <a target="_blank" href="https://github.com/pungiu"><img src="https://avatars.githubusercontent.com/u/131058916?v=4"><div><h1>Gal Pungartnik</h1><p>Frontend, Backend</p></div></a>
        </div>
    </section>



    <img id="blob" src="images/blobprojects.png"></img>
</body>
<footer>
    <div>
        <img src="images/Logos/SCV.svg" alt="Loading...">
    </div>
    <div>
        <h3>Povezave</h3>
        <a href="https://www.scv.si/">Šolski Center Velenje</a>
        <a href="https://www.scv.si/">Šolski Center Velenje</a>
        <a href="https://www.scv.si/">Šolski Center Velenje</a>
    </div>
    <div>
        <h3>Naslov</h3>
        <p>Šolski center Velenje
        <br>Trg mladosti 3,
        <br>3320 Velenje</p>

        <br>
        <br>

        <p>03 89 60 600</p>
        <p>03 89 60 660</p>
    </div>
    
</footer>
<script src="script/headerScroll.js"></script>
<!-- <script src="script/blob.js"></script> -->
</html>
