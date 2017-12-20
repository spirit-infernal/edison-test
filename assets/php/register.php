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
        $error = ("password didn't confirmed");
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
if (strlen($login) < 3 or strlen($login) > 15) {
    exit ("Login must be more than 3 and less than 15 symbols length");
}
if (strlen($password) < 3 or strlen($password) > 15) {
    exit ("Login must be more than 3 and less than 15 symbols length");
}

if (isset($_FILES['file'])) {
    $file = isset( $_FILES['file'] ) ? $_FILES['file'] : false;
    var_dump($file);
}
if (!isset($file) or empty($file) or $file =='') {
    $avatar = "https://yt3.ggpht.com/-nfAyU-h1MVY/AAAAAAAAAAI/AAAAAAAAAAA/pepeb_q41qo/s900-c-k-no-mo-rj-c0xffffff/photo.jpg";
} else {
    $path_to_90_directory    = '../img/';
    $path_to_assets_directory    = '/assets/img/';
    if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $source = $_FILES['file']['tmp_name'];
        $target = $path_to_90_directory . $filename;
        move_uploaded_file($source, $target);
        if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
            $im = imagecreatefromgif($path_to_90_directory.$filename) ;
        }
        if(preg_match('/[.](PNG)|(png)$/', $filename)) {
            $im = imagecreatefrompng($path_to_90_directory.$filename) ;
        }
        if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
            $im = imagecreatefromjpeg($path_to_90_directory.$filename);
        }
        $w = 90;
        $w_src    = imagesx($im);
        $h_src    = imagesy($im);
        $dest = imagecreatetruecolor($w,$w);
        if    ($w_src>$h_src)
            imagecopyresampled($dest, $im, 0, 0,
                round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                0, $w, $w,    min($w_src,$h_src), min($w_src,$h_src));
        if    ($w_src<$h_src)
            imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                min($w_src,$h_src), min($w_src,$h_src));
        if ($w_src==$h_src)
            imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);
        $date=date("d-m-y");
        imagejpeg($dest, $path_to_90_directory.'avatar-'.$login.'-'.$date.".jpg");
        $avatar = $path_to_assets_directory.'avatar-'.$login.'-'.$date.".jpg";
        $delfull = $path_to_90_directory.$filename;
        unlink ($delfull);
    } else  {
        exit ("Allowed formats are <strong>JPG,GIF or PNG</strong>");
    }
}
$password    = md5($password);
$password    = strrev($password);
$password    = $password."qw3r1z";


$result = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id'])) {
    exit ("Login already taken. Chose different");
}
$result2 = mysqli_query($db, "INSERT INTO users (login, password,avatar) VALUES('$login', '$password', '$avatar')");

if ($result2=='TRUE')
{
    echo "Succesfully registered";
}
else {
    echo "Something gone wrong. You're NOT registered";
}

mysqli_free_result($result);
mysqli_close($db);
echo "<html><head><meta http-equiv='Refresh' content='0; URL=../../index.php'></head></html>";
?>