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

    session_start();
    session_regenerate_id();

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'leto',
        'm' => 'mesec',
        'w' => 'teden',
        'd' => 'dne',
        'h' => 'ur',
        'i' => 'minut',
        's' => 'sekund',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'vi' : 'om');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ' : 'ravno kar';
}

if (isset($_GET['id']) && $_SESSION['stat'] == true) {

    if (isset($_GET['potrdi']) && !isset($_GET['zavrni'])){
        $sql = "UPDATE dijaki_dosezki SET potrditev = 1 WHERE id_dd = ".$_GET['id'];
        $sqldose = mysqli_query($conn, $sql);
    } elseif (isset($_GET['zavrni']) && !isset($_GET['potrdi'])){
        $sql = "DELETE FROM mentorji WHERE id_dd = ".$_GET['id'];
        $sqldose = mysqli_query($conn, $sql);
        $sql = "DELETE FROM dijaki_dosezki WHERE id_dd = ".$_GET['id'];
        $sqldose = mysqli_query($conn, $sql);
    }
}
?>
<body>
    <h1>Obvestila</h1>
    <p>Pregljete obvestila ki ste jih prejeli.</p>
    <br>
    <?php
        $sqlquery = "SELECT * FROM dijaki_dosezki WHERE potrditev = 0";

        $query = mysqli_query($conn, $sqlquery);
        while ($row = mysqli_fetch_assoc($query)) {

            $dijakID = $row['id_di'];
            $sqldij = "SELECT * FROM dijaki d INNER JOIN dijaki_dosezki dd ON d.id_di = dd.id_di INNER JOIN dosezki do ON dd.id_do = do.id_do INNER JOIN mesta m ON dd.id_m = m.id_m INNER JOIN vrste v ON dd.id_vr = v.id_vr WHERE d.id_di = $dijakID";
            $querydij = mysqli_query($conn, $sqldij);
            $namedij = mysqli_fetch_assoc($querydij);

            ?>
    <form method="get" action="">
            <div class="highlightRow">
                <img src='../images/testProfilePicture.jpeg' alt='Loading'>
                <p class='name'><?= htmlspecialchars($namedij['ime'] . " ". $namedij['priimek']); ?> <span><?= htmlspecialchars($namedij[''] .$namedij['vrsta'] . "   |   pred " . time_elapsed_string($namedij['datum_vpisa'])); ?></span></p>

                    <input type='submit' value='Potrdi' name="potrdi">
                    <input type='submit' value='Zanikaj' name="zavrni">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id_dd']); ?>">
            </div>
    </form>
    <?php
        }
    ?>

</body>
<script src="../script/darkMode.js"></script>
</html>