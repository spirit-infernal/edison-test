<?php
session_start();
//if    (empty($_SESSION['login']) or empty($_SESSION['password']))
//{
//    exit ("This page is only for registred users<br><a href='/'>Return</a>");
//}

unset($_SESSION['password']);
unset($_SESSION['login']);
unset($_SESSION['id']);//    уничтожаем переменные в сессиях
echo 'logged out!';
//exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");
?>