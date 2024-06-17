<!DOCTYPE html>
<html lang="en" data-theme="light" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/subpages.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Obvestila</title>
</head>
<?php
    require_once '../povezava.php';

    if (isset($_POST['sub'])){
        $date = $_POST['date'];
        $opis = mysqli_real_escape_string($conn, $_POST['opis']);
        $dosezek = mysqli_real_escape_string($conn, $_POST['dosezek']);
        $mesto = mysqli_real_escape_string($conn, $_POST['mesto']);
        $vrsta = mysqli_real_escape_string($conn, $_POST['vrsta']);
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sqlins = "INSERT INTO dijaki_dosezki (datum_vpisa,opis,potrditev,id_do,id_m,id_vr,id_di) VALUES ('$date','$opis',0,(SELECT id_do FROM dosezki WHERE dosezek = '$dosezek'),(SELECT id_m FROM mesta WHERE mesto = '$mesto' LIMIT 1),(SELECT id_vr FROM vrste WHERE vrsta = '$vrsta'),$id)";

        $query = mysqli_query($conn, $sqlins);

        header("Location: vnos.php");

    }

?>
<body>
<h1>Vnos Dosežka</h1>
<?php
echo "<p>Dijak: ";
$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT ime, priimek FROM dijaki WHERE id_di = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo $row['ime'] . " " . $row['priimek'];
echo "</p>";

?>

<form action="" method="post">
    <input type="date" name="date">
    <input type="text" placeholder="Opis" name="opis">
    <input type="file" name="files">
    <select id="select" name="dosezek"> <!--Dosetki-->
        <?php
            $sqldosezki = "SELECT * FROM dosezki";
            $resultdosezki = mysqli_query($conn,$sqldosezki);

            while ($row = mysqli_fetch_assoc($resultdosezki)) {
                ?>
                <option><?= $row['dosezek']; ?></option>
        <?php
            }
        ?>
    </select>
    <select id="select" name="vrsta" > <!--Vrsta tekmovanja-->
        <?php
            $sqlvrsta = "SELECT * FROM vrste";
            $sqlvrsta = mysqli_query($conn, $sqlvrsta);

            while ($row = mysqli_fetch_assoc($sqlvrsta)) {
                ?>
            <option><?= $row['vrsta']; ?></option>
        <?php
            }
        ?>
    </select>
    <select id="select" name="mesto" default=""> <!--Mesto (~1., 2., 3.)-->
        <?php
            $sqlmesto = "SELECT * FROM mesta";
            $resultmesto = mysqli_query($conn, $sqlmesto);

            while ($row = mysqli_fetch_assoc($resultmesto)) {
                ?>
                <option><?= $row['mesto']; ?></option>
        <?php
            }
        ?>
    </select>
    
    <input type="submit" name="sub">


</form>
</body>
<script src="../script/darkMode.js"></script>
</html>