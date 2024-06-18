<?php
require_once '../povezava.php';
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/subpages.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nadzorna Plošča</title>
</head>
<body>
<?php
if(isset($_SESSION['emso']) && $_SESSION['stat'] == false)
{
    // Query to get the class
    $query = "SELECT r.razred 
                  FROM dijaki d 
                  JOIN razredi_dijaki rd ON d.id_di = rd.id_di 
                  JOIN razredi r ON rd.id_r = r.id_r 
                  WHERE d.emso = '".$_SESSION['emso']."'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['razred'] = $row['razred'];
    }
    else
    {
        echo "<h2>Razred: Ni podatka</h2>";
    }


    $query_teacher = "SELECT u.ime, u.priimek
                          FROM razredi r
                          JOIN razredniki rz ON r.id_r = rz.id_r
                          JOIN ucitelji u ON rz.id_u = u.id_u
                          JOIN razredi_dijaki rd ON r.id_r = rd.id_r
                          JOIN dijaki d ON rd.id_di = d.id_di
                          WHERE d.emso = '".$_SESSION['emso']."'";

    $result_teacher = mysqli_query($conn, $query_teacher);

    if (mysqli_num_rows($result_teacher) > 0)
    {
        $row_teacher = mysqli_fetch_assoc($result_teacher);
        $teacher_name = $row_teacher['ime'] . ' ' . $row_teacher['priimek'];
    }
    else
    {
        $teacher_name = "Ni podatka";
    }

    $query_stdosezkov = "SELECT COUNT(*) FROM dijaki_dosezki WHERE id_di = (SELECT id_di FROM dijaki WHERE emso = '".$_SESSION['emso']."')";
    $result_stdosezkov = mysqli_query($conn, $query_stdosezkov);

    $stdosezkov = mysqli_fetch_array($result_stdosezkov);
}

?>

<?php
if($_SESSION['stat'] == false)
{
    ?>
    <div class="studentStats">
        <img src="../images/testProfilePicture.jpeg" alt="Loading">
        <div>
            <p class="name"><?php echo $_SESSION['uname']. ' ' .$_SESSION['razred']. " ";?></p>
            <p>RAZREDNIK: <span><?php echo $teacher_name; ?></span></p>
            <p>ŠTEVILO DOSEŽKOV: <span><?php echo $stdosezkov[0]; ?> </span></p>
        </div>
    </div>
    <?php


}
else
{
    ?>
    <div class="studentStats">
        <img src="../images/testProfilePicture.jpeg" alt="Loading">
        <div>
            <p class="name"><?php echo "Prof. " . $_SESSION['uname']?></p>

        </div>
    </div>
    <?php
}
?>

<br>
<br>
<br>
<br>


<?php
if($_SESSION['stat'] == false)
{
    ?>
    <h1>Moji Dosežki</h1>


    <?php

    $query = "SELECT dd.datum_vpisa, m.mesto, v.vrsta, d.dosezek, dd.potrditev
        FROM dijaki_dosezki dd
        JOIN mesta m ON dd.id_m = m.id_m
        JOIN vrste v ON dd.id_vr = v.id_vr
        JOIN dosezki d ON dd.id_do = d.id_do
        WHERE dd.id_di = (SELECT id_di FROM dijaki WHERE emso = '".$_SESSION['emso']."') AND dd.potrditev = 1";

    $result_dosezki = mysqli_query($conn, $query);

    if(mysqli_num_rows($result_dosezki) > 0) {
        while($row_dosezki = mysqli_fetch_assoc($result_dosezki)) {
            ?>
            <div class="highlightRow">
                <i class="fa-solid fa-medal"></i>
                <p class='name'><?= $row_dosezki['vrsta'] ?><span><?= $row_dosezki['mesto']; ?> mesto | <?=$row_dosezki['dosezek'];?> | <?=$row_dosezki['datum_vpisa']?></span></p>
            </div>
                <?php
            //echo "<p>DATUM: " . $row_dosezki['datum_vpisa'] . "  |  " . "MESTO: " . $row_dosezki['mesto'] .  "  |  " . "VRSTA: " . $row_dosezki['vrsta'] . "  |  " . "DOSEZEK: " . $row_dosezki['dosezek'] . " | STATUS:". $row_dosezki['potrditev'] ."</p>";
        }
    } else {
        echo "<p>Ni najdenih dosežkov.</p>";
    }
}
else
{

    ?>
    <h1>Moja Prispevanja</h1>

    <?php
    $query = "SELECT dd.datum_vpisa, m.mesto, v.vrsta, d.dosezek, dd.id_di, di.ime, di.priimek,d.vrednost
        FROM dijaki_dosezki dd
        JOIN mesta m ON dd.id_m = m.id_m
        JOIN vrste v ON dd.id_vr = v.id_vr
        JOIN dosezki d ON dd.id_do = d.id_do
        JOIN mentorji me ON dd.id_dd = me.id_dd
        JOIN dijaki di ON dd.id_di = di.id_di
        WHERE me.id_u = (SELECT id_u FROM ucitelji WHERE emso = '".$_SESSION['emso']."') AND dd.potrditev = 0";

    $result_prispevanja = mysqli_query($conn, $query);

    if(mysqli_num_rows($result_prispevanja) > 0) {
        while($row_prispevanja = mysqli_fetch_assoc($result_prispevanja)) {
            ?>
            <div class="contribution">
                <div>
                    <div class="displayFlex">
                        <img src="../images/testProfilePicture.jpeg" alt="">
                        <p><?= htmlspecialchars($row_prispevanja['ime']." ".$row_prispevanja['priimek']); ?></p>
                        <i><?= htmlspecialchars($row_prispevanja['datum_vpisa']); ?></i>
                    </div>
                    <h1><?= htmlspecialchars($row_prispevanja['vrsta']); ?></h1>
                </div>
                <div>
                    <p><?= htmlspecialchars($row_prispevanja['dosezek']); ?></p>
                    <h1><?php echo $row_prispevanja['vrednost']; ?></h1>
                </div>
            </div>
            <?php


            //echo "<p>DATUM: " . $row_prispevanja['datum_vpisa'] . "  |  " . "MESTO: " . $row_prispevanja['mesto'] .  "  |  " . "VRSTA: " . $row_prispevanja['vrsta'] . "  |  " . "DOSEZEK: " . $row_prispevanja['dosezek'] .  "  |   " . "DIJAK: " . $row_prispevanja['ime'] . " " . $row_prispevanja['priimek'] . "</p>";
        }
    }
    else
    {
        echo "<p>Ni najdenih prispevanj.</p>";
    }
}
?>

<!-- <div> //ucenec
    <h3>2024-2025</h3>
    <div class="highlightRow">
        <i class="fa-solid fa-medal"></i>
        <p class='name'>Kenguru<span>jwerfiwuriuweioruusduidsu</span></p>
    </div>
    <h3>2023-2024</h3>
    <div class="highlightRow">
        <i class="fa-solid fa-medal"></i>
        <p class='name'>Jure Primer <span>voluptatibus blanditiis harum</span></p>
    </div>

</div>
<br></br>
<div>
    <div class="contribution">
        <div>
            <div class="displayFlex">
                <img src="../images/testProfilePicture.jpeg" alt="">
                <p>Mark Kotnik</p>
                <i>08.09.2023</i>
            </div>
            <h1>Razvedrilna Matematika</h1>
        </div>
        <div>
            <p>Srebrno Priznanje</p>
            <h1>7</h1>
        </div>
    </div>
    <div class="contribution">
        <div>
            <div class="displayFlex">
                <img src="../images/testProfilePicture.jpeg" alt="">
                <p>Mark Kotnik</p>
                <i>08.09.2023</i>
            </div>
            <h1>Razvedrilna Matematika</h1>
            <p>Kao opis al pa neke. (potional)    Distinctio rem quaerat quo cupiditate recusandae veniam cum labore, est perspiciatis necessitatibus nesciunt nemo officiis nobis voluptates molestiae facilis fuga quaerat, nobis aperiam repudiandae?</p>
            <p>Kao opis al pa neke. (potional)    Distinctio rem quaerat quo cupiditate recusandae veniam cum labore, est perspiciatis necessitatibus nesciunt nemo officiis nobis voluptates molestiae facilis fuga quaerat, nobis aperiam repudiandae?</p>
            <p>Kao opis al pa neke. (potional)    Distinctio rem quaerat quo cupiditate recusandae veniam cum labore, est perspiciatis necessitatibus nesciunt nemo officiis nobis voluptates molestiae facilis fuga quaerat, nobis aperiam repudiandae?</p>
            <p>Kao opis al pa neke. (potional)    Distinctio rem quaerat quo cupiditate recusandae veniam cum labore, est perspiciatis necessitatibus nesciunt nemo officiis nobis voluptates molestiae facilis fuga quaerat, nobis aperiam repudiandae?</p>
        </div>
        <div>
            <p>Srebrno Priznanje</p>
            <h1>7</h1>
        </div>
    </div>
</div> -->



</body>
<script src="../script/darkMode.js"></script>
</html>
