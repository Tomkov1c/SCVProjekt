<?php
require_once 'povezava.php';
?>
    <!DOCTYPE html>
    <html lang="en" data-theme="light" id="darmModeID">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prijava</title>
        <link rel="stylesheet" type="text/css" href="style/global.css" />
        <link rel="stylesheet" type="text/css" href="style/login.css"/>
    </head>
    <!--
    <header>
    <h1 class="appName">Dosežki</h1>
    <h2 class="subAppName">Prijava</h2>
    </header>
    -->
    <body>
    <?php
    $appid = "f73324d4-392d-402d-a1b7-9b72268e29ee";
    $tennantid = "f6232921-d0d7-4c1a-9eee-0da15213004d";
    $login_url = "https://login.microsoftonline.com/" . $tennantid . "/oauth2/v2.0/authorize";
    session_start();
    session_regenerate_id();
    $_SESSION['state'] = session_id();
    ?>

    <section>
        <div id="sideL">
            <h1>Prijava</h1>
            <h2>Dijak / Dijakinja</h2>
            <form action="" method="get">
                <input type="password" name="emso" maxlength="13" class="inputField" placeholder="EMŠO" autofocus>
                <input type="submit" value="Prijava" class="inputPrijava">
            </form>
            <hr>

            <?php
            if (isset($_SESSION['msatg'])) {
                echo '<p><a href="?action=logout">Log Out</a></p>'; //to je samo za test ce hoces lahka naredis css za to, ni pa nujno itak noben ne bo vidu.
                header('Location: http://localhost/home.php');
            } else {
            ?>
                <a id="microsoftPrijava" href="?action=login">
                    <img alt="Loading..." src="images/Logos/Microsoft.svg">
                    <p>Microsoft prijava</p>
                </a>
                <?php
            }
            ?>
        </div>
        <div id="sideR">

        </div>
    </section>

        <div class="theForm-R">

        </div>
    </div>
    </body>
    </html>
    <script src="script/darkMode.js"></script>
<?php
if ($_GET['action'] == 'login'){
    $params = array ('client_id' =>$appid,
        'redirect_uri' =>'http://localhost/prijava.php',
        'response_type' =>'token',
        'response_mode' =>'form_post',
        'scope' =>'https://graph.microsoft.com/User.Read',
        'state' =>$_SESSION['state']);
    header ('Location: '.$login_url.'?'.http_build_query ($params));
}

if (array_key_exists ('access_token', $_POST))
{
    $_SESSION['t'] = $_POST['access_token'];
    $t = $_SESSION['t'];
    $ch = curl_init ();
    curl_setopt ($ch, CURLOPT_HTTPHEADER, array ('Authorization: Bearer '.$t,
        'Conent-type: application/json'));
    curl_setopt ($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $rez = json_decode (curl_exec ($ch), 1);
    if (array_key_exists ('error', $rez)){
        var_dump ($rez['error']);
        die();
    }
    else  {
        $_SESSION['msatg'] = 1;
        $_SESSION['uname'] = $rez["displayName"];
        $_SESSION['id'] = $rez["id"];

        if (isset($rez['id'])) {
            $ca = curl_init ();
            curl_setopt ($ca, CURLOPT_HTTPHEADER, array ('Authorization: Bearer '.$t,
                'Conent-type: application/json'));
            curl_setopt ($ca, CURLOPT_URL, "https://graph.microsoft.com/beta/users/" . $rez['id']);
            curl_setopt ($ca, CURLOPT_RETURNTRANSFER, 1);
            $resu = json_decode (curl_exec ($ca), 1);

            if (isset($resu['onPremisesDistinguishedName'])) {
                $statusprijave = $resu['onPremisesDistinguishedName'];

                if (str_contains($statusprijave, 'Dijak')){ // ??Mogoce kak boljsi nacin?? (Zaposleni,Dijak)
                    $_SESSION['stat'] = true;
                } else {
                    $_SESSION['stat'] = false;
                }

            } else {
                $_SESSION['nekaj'] = false;
            }

            curl_close($ca);
        }
    }
    curl_close ($ch);
    header ('Location: http://localhost/prijava.php');
    die();
}
if ($_GET['action'] == 'logout'){
    session_destroy();
    unset ($_SESSION);
    header ('Location: http://localhost/prijava.php');
    die();
}

if(isset($_POST['emso']))
{
    $_SESSION['emso'] = $_POST['emso'];
    //check if emso exists in database
    $query = "SELECT ime FROM dijaki WHERE emso = '".$_SESSION['emso']."'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['ime'] = $row['ime'];

        header('Location: home.php');
    }
    else if ($_POST['emso'] == 999){
        header("Location: admin.php");
    } else {echo "Esihsdgfusdg";}

}