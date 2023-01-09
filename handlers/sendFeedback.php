<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../src/db/connect.php';
require_once '../src/functions/validate.php';

$name = validate($_POST['name']);
$comment = validate($_POST['comment']);
$employeeCategory = $_POST['employeeCategory'][0];
$commentCategory = $_POST['inlineRadioOptions'][0];
$salesDepartment = $_POST['salesDepartment'];
$supplyDepartment = $_POST['supplyDepartment'];
$currentUserId = $_SESSION['user']['id'];

$currentFields = [
    "name" => $name,
    "comment" => $comment,
    "employeeCategory" => $employeeCategory,
    "commentCategory" => $commentCategory,
//    "salesDepartment" => $salesDepartment,
//    "supplyDepartment" => $supplyDepartment,
];

$_SESSION['user'] = array_merge($_SESSION['user'], $currentFields);

if (!isNotEmpty($name) or !isNotEmpty($comment)) {
    return false;
}

if ($employeeCategory[0] === '0') {
    $_SESSION['errorMessage'] = 'Выберите категорию сотрудника';
    header('Location: ../pages/feedback.php');
}

if ($salesDepartment === NULL) {
    $salesDepartment = (int) $salesDepartment;
}

if ($supplyDepartment === NULL) {
    $supplyDepartment = (int) $supplyDepartment;
}

if (isset($connect)) {
    mysqli_query($connect, "INSERT INTO `comments` (`id`, `name`, `comment`, `user_id`, `employee_category_id`, `comment_category_id`, `sales_department`, `supply_department`) VALUES (NULL, '$name', '$comment', '$currentUserId', '$employeeCategory[0]', '$commentCategory[0]', '$salesDepartment', '$supplyDepartment')");

    $_SESSION['message'] = 'Сообщение отправлено';
    header('Location: ../pages/feedback.php');
} else {
    $_SESSION['message'] = 'Ошибка';
    header('Location: ../pages/feedback.php');
}