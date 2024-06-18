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
session_regenerate_id();

if (isset($_POST['autorizacija'])) { // tta koda bo ful shit + prestaula se bo, mogoce
    $geslo = $_POST['autorizacija'];

    $sqlauth = "SELECT * FROM admini a INNER JOIN ucitelji u ON a.id_uc = u.id_u";
    $resultatdo = mysqli_query($conn, $sqlauth);

    while ($row = mysqli_fetch_array($resultatdo)) {

        $name = $row['email'];

        if (strtoupper($name) == strtoupper($_SESSION['email'])) {
            $verify = password_verify($geslo, $row['gesloa']);

            if ($verify)
            {
                $_SESSION['admin'] = true;
            } else { $_SESSION['admin'] = false; }
        }
    }
}

if (isset($_POST['sub'])) {

    $imeA = strtoupper($_POST['ime']);
    $priimekA = strtoupper($_POST['priimek']);

    $ime = mysqli_real_escape_string($conn,$imeA);
    $priimek = mysqli_real_escape_string($conn,$priimekA);
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

    $sqluc = "INSERT INTO ucitelji (ime, priimek, email, geslo, emso) VALUES ('$ime', '$priimek', '$email','$hash', '$tel')";

    $result = mysqli_query($conn,$sqluc);

}
if (isset($_POST['delete'])){

    $id = $_POST['delete'];

    $sql1 = "DELETE FROM razredniki WHERE id_u = $id";
    $sql2 = "DELETE FROM admini WHERE id_uc = $id";
    $sql3 = "DELETE FROM ucitelji WHERE id_u = $id";

    $query1 = mysqli_query($conn,$sql1);
    $query2 = mysqli_query($conn,$sql2);
    $query3 = mysqli_query($conn,$sql3);
}

if(isset($_POST['makeadmin']))
{
    $id = $_POST['makeadmin'];
    $sql = "INSERT INTO admini (id_uc , gesloa) VALUES ('$id',(SELECT geslo FROM ucitelji WHERE id_u = $id))";
    $query = mysqli_query($conn,$sql);
}

?>
<body>
<?php
if ($_SESSION['admin'] == true){
    ?>
    <h1>Admin</h1>
    <p>Nastavitve so shranjene lokalno, kar pomeni da se shranijo samo za posamezno napravo. Po vsake premembi morate ponovno naložiti stran (<span class="keybind"><span>CTRL</span> + <span>R</span></span>).</p>
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
    <div id="misc1">
        <?php
        $sql = "SELECT * FROM ucitelji";
        $query = mysqli_query($conn,$sql);

        $isadmin = false;

        while ($row = mysqli_fetch_array($query)){
            $id_uc = $row['id_u'];

            $sqladmin = "SELECT * FROM admini a INNER JOIN ucitelji u ON a.id_uc = u.id_u WHERE id_uc = $id_uc";
            $queryadmin = mysqli_query($conn,$sqladmin);

            if (mysqli_num_rows($queryadmin) >= 1){
                ?>
                <div class="highlightRow" style="background-color: #e7c200">
                    <img src="../images/testProfilePicture.jpeg" alt="Loading">
                    <p class="name"><?= htmlspecialchars($row['ime']." ".$row['priimek']); ?></p>
                </div>

                <?php
            } else if (mysqli_num_rows($queryadmin) == 0) {
                ?>
                <form action="" method="post" id="formadel">
                    <div class="highlightRow">
                        <img src="../images/testProfilePicture.jpeg" alt="Loading">
                        <p class="name"><?= htmlspecialchars($row['ime']." ".$row['priimek']); ?></p>
                        <button id="promote" name="makeadmin" value="<?= $row['id_u']; ?>"><i class="fa-solid fa-user-shield"></i><p>Postane admin</p></button>
                        <button id="remove" name="delete" value="<?= $row['id_u']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </form>
                <?php
            }
        }
        ?>
    </div>

    <?php
} else if ($_SESSION['admin'] == false){
    ?>
    <h1>Avtorizacija</h1>

    <form action="" method="post">
        <input type="password" name="autorizacija">
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
    document.getElementById("remove").addEventListener("change", function() {
        document.getElementById("formadel").submit();
    });
</script>
</html>