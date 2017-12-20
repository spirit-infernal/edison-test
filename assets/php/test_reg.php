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
$result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);
if (empty($myrow['password']))
{
    $error = 'Incorrect password';
}
else {
    if ($myrow['password']==$password) {
        $_SESSION['login']=$myrow['login'];
        $_SESSION['id']=$myrow['id'];
    }
    else {
        $error = 'Empty password';
    }
}
if (!$error) {
    echo 'Logged in!';
} else {
    echo $error;
}

mysqli_free_result($result);
mysqli_close($db);
die();
?>
