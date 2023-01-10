<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../src/db/connect.php';
print_r('hello');

$email = $_POST['email'];
$password = $_POST['password'];

$user = query("SELECT `id`,`email`, `password` FROM `users` WHERE email = ?;", [$email]);

if (count($user)) {

    if (password_verify($password, $user[0]['password'])) {
        $_SESSION['user'] = [
            "id" => $user[0]['id'],
            "email" => $user[0]['email']
        ];

        header('Location: ../pages/feedback.php');
    } else {
        $_SESSION['errorMessage'] = 'Неверный логин или пароль';
        header('Location: ../pages/login.php');
    }
} else {
    $_SESSION['errorMessage'] = 'Неверный логин или пароль';
    header('Location: ../pages/login.php');
}
