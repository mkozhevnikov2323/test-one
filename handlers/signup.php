<?php
session_start();
require_once '../src/db/connect.php';
require_once '../src/functions/checkDuplicateEmail.php';

$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];
$date_reg = date("Y-m-d H:i:s");
$date_edit = date("Y-m-d H:i:s");

if ($password === $passwordConfirm) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorMessage'] = 'Введите корректный e-mail';
        header('Location: ../pages/register.php');
        return false;
    }

    if (isEmailDuplicate($email)) {
        $_SESSION['errorMessage'] = 'Пользователь уже зарегистрирован';
        header('Location: ../pages/register.php');
    } else {
        make("INSERT INTO `users` (`id`, `email`, `password`, `date_reg`, `date_edit`) VALUES (?, ?, ?, ?, ?)", [NULL, $email, $password, $date_reg, $date_edit]);

        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: ../pages/login.php');
    }
} else {
    $_SESSION['errorMessage'] = 'Пароли не совпадают';
    header('Location: ../pages/register.php');
}