<?php
session_start();
require_once '../src/db/connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];

if ($password === $passwordConfirm) {
    $password = md5($password);
    if (isset($connect)) {
        mysqli_query($connect, "INSERT INTO `users` (`id`, `email`, `password`, `date_reg`, `date_edit`) VALUES (NULL, '$email', '$password', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: ../login.php');
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}