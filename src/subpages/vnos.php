<?php
require_once '../povezava.php';
session_start();
session_regenerate_id();

if (isset($_POST['selectedOption'])) {
    $_SESSION['selectedOption'] = $_POST['selectedOption'];
}

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}
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
<h1>Vnos</h1>
<p>Vnesite uspeh dijakom iz posameznega razreda</p>
<?php
$query = "SELECT razred FROM razredi";
$result = mysqli_query($conn, $query);

if ($result) {
    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $optionValue = $row['razred'];
        $selected = (isset($_SESSION['selectedOption']) && $_SESSION['selectedOption'] == $optionValue) ? 'selected' : '';
        $options .= "<option value='$optionValue' $selected>$optionValue</option>";
    }
} else {
    $options = "<option value=''>Failed to fetch options</option>";
}
?>

<form id="dropdown" action="" method="post">
    <select id="select" name="selectedOption">
        <?php echo $options; ?>
    </select>

    <input type="text" name="search" placeholder="Išči..." value="<?php echo htmlspecialchars($searchQuery); ?>">
    <input type="submit" value="Išči">

</form>

<?php
if (isset($_SESSION['selectedOption'])) {
    $selectedClass = $_SESSION['selectedOption'];


    $query = "SELECT * FROM dijaki d 
                  JOIN razredi_dijaki rd ON d.id_di = rd.id_di 
                  JOIN razredi r ON rd.id_r = r.id_r 
                  WHERE r.razred = '$selectedClass'";

    if ($searchQuery) {
        $query .= " AND (d.ime LIKE '%$searchQuery%' OR d.priimek LIKE '%$searchQuery%')";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <form method="get" action="vnosDosezka.php"> <!-- samo za muho -->

<div class='highlightRow'>
    <img src='../images/testProfilePicture.jpeg' alt='Loading'>
    <p class='name'><?php echo $row['ime'] . " " . $row['priimek']; ?></p>
    <input type="hidden" name="id" value="<?= $row['id_di']; ?>">
    <input type='submit' value='Vnesi dosezek' >
</div>

                </form>
<?php
        }
    } else {
        echo "<p>Failed to fetch students</p>";
    }
}
?>

<script>
    document.getElementById("select").addEventListener("change", function() {
        document.getElementById("dropdown").submit();
    });
</script>
</body>
<script src="../script/darkMode.js"></script>
</html>
