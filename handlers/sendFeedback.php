<?php
session_start();
require_once '../src/db/connect.php';
require_once '../src/functions/validate.php';
require_once '../src/functions/reselFields.php';

$name = validate($_POST['name']);
$comment = validate($_POST['comment']);
$employeeCategory = $_POST['employeeCategory'][0];
$commentCategory = $_POST['inlineRadioOptions'][0];
$salesDepartment = $_POST['salesDepartment'];
$supplyDepartment = $_POST['supplyDepartment'];
$currentUserId = $_SESSION['user']['id'];

// сохранение текущего текстового поля
$currentFields = [
    "name" => $name,
    "comment" => $comment,
];
$_SESSION['user'] = array_merge($_SESSION['user'], $currentFields);

// запрет на отправку множественныех пробелов
if (!isNotEmpty($name) or !isNotEmpty($comment)) {
    return false;
}

if ($employeeCategory[0] === '0') {
    $_SESSION['errorMessage'] = 'Выберите категорию сотрудника';
    header('Location: ../pages/feedback.php');
}

// преобразование для БД
if ($salesDepartment === NULL) {
    $salesDepartment = (int) $salesDepartment;
}
if ($supplyDepartment === NULL) {
    $supplyDepartment = (int) $supplyDepartment;
}

make("INSERT INTO `comments` (`id`, `name`, `comment`, `user_id`, `employee_category_id`, `comment_category_id`, `sales_department`, `supply_department`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);", [NULL, $name, $comment, $currentUserId, $employeeCategory[0], $commentCategory[0], $salesDepartment, $supplyDepartment]);

$_SESSION['message'] = 'Сообщение отправлено';
resetTextFields();
header('Location: ../pages/feedback.php');