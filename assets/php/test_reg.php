<?php
session_start();
$error = '';
if (isset($_POST['loginField'])) {
    $login = isset( $_POST['loginField'] ) ? $_POST['loginField'] : false;
    if (!$login) {
        unset($login);
        $error = 'Empty login';
    }
}
if (isset($_POST['passwordField'])) {
    $password = isset( $_POST['passwordField'] ) ? $_POST['passwordField'] : false;
    if (!$password) {
        unset($password);
        $error = 'Empty password';
    }
}
if (!$login || !$password)
{
    $error = 'Empty fields';
}
//

include ("db.php");

$login = htmlentities(mysqli_real_escape_string( $db, $login ));
$password = htmlentities(mysqli_real_escape_string( $db, $password ));

// минипроверка на подбор паролей

$ip=getenv("HTTP_X_FORWARDED_FOR");
if (empty($ip) || $ip=='unknown') {
    $ip=getenv("REMOTE_ADDR");
}
mysqli_query ($db, "DELETE FROM banlist WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 300");
$result = mysqli_query($db, "SELECT errors FROM banlist WHERE ip='$ip'");
$myrow = mysqli_fetch_array($result);

if ($myrow['errors'] > 2) {
    exit("You entered password 3 times incorrect. Please wait for 5 minutes");
}
$password = md5($password);//шифруем пароль
$password = strrev($password);// для надежности добавим реверс
$password = $password."qw3r1z";
$result = mysqli_query($db, "SELECT * FROM users WHERE login='$login' AND password='$password'");
$myrow    = mysqli_fetch_array($result);
if (empty($myrow['id'])) {
    $select = mysqli_query($db, "SELECT ip FROM banlist WHERE ip='$ip'");
    $tmp = mysqli_fetch_row($select);
    if ($ip == $tmp[0]) {
        $result_err = mysqli_query($db, "SELECT errors FROM banlist WHERE ip='$ip'");
        $myrow_err = mysqli_fetch_array($result_err);
        $errors = $myrow_err[0] + 1;
        mysqli_query($db, "UPDATE banlist SET errors=$errors,date=NOW() WHERE ip='$ip'");
    } else {
        mysqli_query($db, "INSERT INTO banlist (ip,date,errors) VALUES ('$ip',NOW(),'1')");
    }
    exit ("Login or password incorrect");
}
else {
    $_SESSION['password']=$myrow['password'];
    $_SESSION['login']=$myrow['login'];
    $_SESSION['id']=$myrow['id'];
    if ($_POST['save'] == 1) {
        setcookie("login",    $_POST["login"], time()+9999999);
        setcookie("password",    $_POST["password"], time()+9999999);
    }
}
echo "Logged in";

mysqli_free_result($result);
mysqli_close($db);
die();
?>
