<?php
session_start();
require_once 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];

if ($password === $passwordConfirm) {

} else {
    die('Пароли не совпадают');
}