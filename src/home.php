<?php
require_once "povezava.php";

?>



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
<body>
    <section id="sectionL">
        <button id="active"><i class="fa-solid fa-house"></i><p>Dom</p></button>
        <button><i class="fa-solid fa-hashtag"></i><p>Vnos</p></button>
        <button><i class="fa-solid fa-eye"></i><p>Pogled</p></button>
        <button><i class="fa-solid fa-chair"></i><p>3. TRB</p></button>
    </section>
    <section id="sectionR">
        
        
        <?php
        session_start();
        if(isset($_SESSION['ime']))
        {
            echo "<h1>Pozdravljen, " . $_SESSION['ime'] . "</h1>";
        }
        else
        {
            header("Location: index.html");
        }

        $query = "SELECT r.razred FROM dijaki d JOIN razredi_dijaki rd ON d.id_di = rd.id_di JOIN razredi r ON rd.id_r = r.id_r WHERE d.ime = '".$_SESSION['ime']."'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h2>Razred: " . $row['razred'] . "</h2>";
        } 
        else {
            echo "<h2>Razred: Ni podatka</h2>";
        }



        ?>
        
        <br><br>
        
        



        <div class="highlightRow">
            <img src="images/testProfilePicture.jpeg" alt="Loading">
            <p class="name">Jure Primer</p>
        </div>

        <div class="submenuSplitSelect">
            <div><p>2019/2020</p></div>
            <div><p>2020/2021</p></div>
            <div><p>2021/2022</p></div>
            <div><p>2022/2023</p></div>
            <div><p>2023/2024</p></div>
        </div>

    </section>
</body>
    <div id="devMenu">
        <h1>Zavihki</h1>
        <p>Kako bi naj zgledali zavihki na tej strani. Vsak je .html datoteka. Način navigacije na zavihke je pa odvisen od tega za kaj se bomo odločili.</p>
        <div class="display_inline_flex">
            <a href="samples/home.html"><i class="fa-solid fa-house"></i><p>Dom</p></a>
            <a href="samples/vnos.html"><i class="fa-solid fa-hashtag"></i><p>Vnos</p></a>
            <a href="samples/pogled.html"><i class="fa-solid fa-eye"></i><p>Pogled</p></a>
            <a href="samples/"><i class="fa-solid fa-chair"></i><p>Razred</p></a>
            <a href="Logout.php">logout</a>
            <a href="povezavatest.php">Baza Test</a>
            
        </div>
    </div>
    
<script src="script/darkMode.js"></script>
<script src="script/devMenu.js"></script>
</html>