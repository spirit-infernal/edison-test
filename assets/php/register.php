<?php
$error = '';
if (isset($_POST['loginFieldR'])) {
    $login = isset( $_POST['loginFieldR'] ) ? $_POST['loginFieldR'] : false;
    if ($login == '') {
        unset($login);
        $error = ("No login");
    }
}
if (isset($_POST['passwordFieldR1'])) {
    $password = isset( $_POST['passwordFieldR1'] ) ? $_POST['passwordFieldR1'] : false;
    if ($password =='') {
        unset($password);
        $error = ("No password");
    }
}
if (isset($_POST['passwordFieldR2'])) {
    $password2 = isset( $_POST['passwordFieldR2'] ) ? $_POST['passwordFieldR2'] : false;
    if ($password2 =='') {
        unset($password2);
        $error = ("password didn't entered for checking");
    }
}

if ($password != $password2) {
    $error = ("Passwords are different");
}

if (empty($login) or empty($password)) {
    $error = ("Some fields are empty");
}

include ("db.php");

$login = htmlentities(mysqli_real_escape_string( $db, $login ));
$password = htmlentities(mysqli_real_escape_string( $db, $password ));
$result = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id'])) {
    exit ("Login already taken. Chose different");
}

$result2 = mysqli_query($db, "INSERT INTO users (login, password) VALUES('$login', '$password')");

if ($result2=='TRUE')
{
    echo "Succesfully registered";
}
else {
    echo "Something gone wrong. You're NOT registered";
}

mysqli_free_result($result);
mysqli_close($db);
?>