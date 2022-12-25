<?php
session_start();
require_once 'connect.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

if (isset($connect)) {
    $checkUser = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    if (mysqli_num_rows($checkUser) > 0) {
        header('Location: ../feedback.php');
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: ../login.php');
    }
}
