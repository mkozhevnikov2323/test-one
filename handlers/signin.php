<?php
session_start();
require_once '../src/db/connect.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

if (isset($connect)) {
    $checkUser = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    if (mysqli_num_rows($checkUser) > 0) {
        $user = mysqli_fetch_assoc($checkUser);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "email" => $user['email']
        ];

        header('Location: ../pages/feedback.php');

    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: ../pages/login.php');
    }
}
