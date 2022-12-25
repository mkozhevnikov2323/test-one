<?php
session_start();
require_once 'connect.php';

$name = $_POST['name'];
$comment = $_POST['comment'];
$employeeCategory = $_POST['employeeCategory'];
$salesDepartment = $_POST['salesDepartment'];
$supplyDepartment = $_POST['supplyDepartment'];
$inlineRadioOptions =$_POST['inlineRadioOptions'];

if (isset($connect)) {
    var_dump($name);
    print_r("<br>");
    var_dump($comment);
    print_r("<br>");
    var_dump($employeeCategory);
    print_r("<br>");
    var_dump($salesDepartment);
    print_r("<br>");
    var_dump($supplyDepartment);
    print_r("<br>");
    var_dump($inlineRadioOptions);
}