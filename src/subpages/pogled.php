<?php
require_once("../povezava.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/subpages.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nadzorna Plošča</title>
</head>
<body>
    <h1>Pogled</h1>
    <p>Poglejte uspeh vseh svojih sosolcev v razredu <?php echo $_SESSION['razred']?></p>

    <?php
    $query = "SELECT ime, priimek FROM dijaki d JOIN razredi_dijaki rd ON d.id_di = rd.id_di JOIN razredi r ON rd.id_r = r.id_r WHERE r.razred = '".$_SESSION['razred']."'";
    $result = mysqli_query($conn, $query);
    $stevilo = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $stevilo++;
        ?>
        
        <div class="highlightRow">
            <img src="../images/testProfilePicture.jpeg" alt="Loading">
            <p class="name"><?php echo $stevilo . '. '; echo $row['ime'] . ' '; echo $row['priimek']?></p>
        </div>
        <?php
    }
    ?>

        
        
        
</body>
<script src="../script/darkMode.js"></script>
</html>