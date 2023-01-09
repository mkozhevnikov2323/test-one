<?php
session_start();
require_once '../src/db/connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];
$date_reg = date("Y-m-d H:i:s");
$date_edit = date("Y-m-d H:i:s");

if ($password === $passwordConfirm) {
    $password = md5($password);

    make("INSERT INTO `users` (`id`, `email`, `password`, `date_reg`, `date_edit`) VALUES (?, ?, ?, ?, ?)", [NULL, $email, $password, $date_reg, $date_edit]);

    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: ../pages/login.php');
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../pages/register.php');
}