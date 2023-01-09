<?php
session_start();
require_once '../src/db/connect.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

$user = query("SELECT * FROM `users` WHERE email = ? AND password = ?;", [$email, $password]);

if (count($user)) {

    $_SESSION['user'] = [
        "id" => $user[0]['id'],
        "email" => $user[0]['email']
    ];

    header('Location: ../pages/feedback.php');

} else {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: ../pages/login.php');
}
