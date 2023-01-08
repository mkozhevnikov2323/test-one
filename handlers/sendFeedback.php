<?php
session_start();
require_once '../src/db/connect.php';

$name = $_POST['name'];
$comment = $_POST['comment'];
$employeeCategory = $_POST['employeeCategory'];
$commentCategory = $_POST['inlineRadioOptions'];
$salesDepartment = $_POST['salesDepartment'];
$supplyDepartment = $_POST['supplyDepartment'];

$currentUserId = $_SESSION['user']['id'];

if (isset($employeeCategory)) {
    if ($employeeCategory[0] === '0') {
        $_SESSION['message'] = 'Выберите категорию сотрудника';
        header('Location: ../pages/feedback.php');
    }
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