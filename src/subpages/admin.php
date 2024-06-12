<!DOCTYPE html>
<html lang="en" data-theme="light" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/subpages.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin</title>
</head>
<?php
    require_once '../povezava.php';

    session_start();

    if (isset($_POST['autorizacija'])) { // tta koda bo ful shit + prestaula se bo, mogoce
        $geslo = $_POST['autorizacija'];

        $sql = "SELECT * FROM admini";
        $resultatdo = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($resultatdo)) {
            $verify = password_verify($geslo, $row['gesloa']);

            if ($verify)
            {
                $_SESSION['admin'] = true;
            } else $_SESSION['admin'] = false;
        }
    }

if (isset($_POST['sub'])) {
    $ime = mysqli_real_escape_string($conn,$_POST['ime']);
    $priimek = mysqli_real_escape_string($conn,$_POST['priimek']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $geslo = mysqli_real_escape_string($conn,$_POST['geslo']);
    $tel = mysqli_real_escape_string($conn,$_POST['tel']);

    $sqls = "SELECT * FROM ucitelji";
    $rezultat = mysqli_query($conn,$sqls);
    $i = 0;
    while ($row = mysqli_fetch_array($rezultat)){
        $i++;
    }
    $i++;

    $opcije = [
        'cost' => 14, //vecja stevilka dlje bo kalkuliral, ampak bo pol tud ugotavlajnje trajalo dlje casa
    ];

    $hash = password_hash($geslo, PASSWORD_DEFAULT, $opcije);

    $sql = "INSERT INTO ucitelji (id_u, ime, priimek, email, geslo, emso) VALUES ($i,'$ime', '$priimek', '$email','$hash', '$tel')";

    $result = mysqli_query($conn,$sql);

}
?>
<body>
<?php
    if ($_SESSION['admin'] == true){
        ?>
    <h1>Admin</h1>
    <p>Dodajajte, brišite ali promovirajte profesorje. Za hitrejše vpisovanje lahko po vnosu pritisnete <span class="keybind"><span>TAB</span></span> da se pomikate med vpisnimi polji.</p>
    <form action="" method="post">
        <input type="text" placeholder="Ime" name="ime">
        <input type="text" placeholder="Priimek" name="priimek">
        <input type="email" placeholder="E-Mail" name="email">
        <input type="password" placeholder="Geslo" name="geslo">
        <input type="tel" placeholder="EMŠO" size="13" name="tel">
        <div class="display_inline_flex">
            <input type="submit" value="Submit" name="sub">
        </div>
    </form>
    <div>
        <?php
        $sql = "SELECT * FROM ucitelji";
        $query = mysqli_query($conn,$sql);

        while ($row = mysqli_fetch_array($query)){
            ?>
            <form action="" method="post">
            <div class="highlightRow">
                <img src="../images/testProfilePicture.jpeg" alt="Loading">
                <p class="name"><?= htmlspecialchars($row['ime']." ".$row['priimek']); ?></p>
                <button id="promote"><i class="fa-solid fa-user-shield"></i><p>Postane admin</p></button> 
                <button id="remove"><i class="fa-solid fa-trash-can"></i></button>
            </div>
            </form>
            <?php
        }
        ?>
    </div>

<?php
    } else if ($_SESSION['admin'] == false){
        ?>
        <h1>Autorizacija</h1>

        <form action="" method="post">
            <input type="text" name="autorizacija">
            <div class="display_inline_flex">
                <input type="submit">
            </div>
        </form>
<?php
    }
?>
    
</body>
<script src="../script/darkMode.js"></script>
<script>
        document.getElementById("select").addEventListener("change", function() {
            document.getElementById("dropdown").submit();
        });
</script>
</html>