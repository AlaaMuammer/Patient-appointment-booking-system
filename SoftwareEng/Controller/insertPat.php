<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../Model/Patient.php'; 
$message = "";
$error = "";

if (isset($_POST['register'])) {
    $patient = new Patient();
    
    $result = $patient->registerAccount(
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['password']
    );

    if ($result === true) {
        $message = "تم إنشاء الحساب بنجاح! جاري تحويلك لصفحة تسجيل الدخول...";
        header("refresh:2; url=login.php"); 
    } else {
        $error = $result; 
    }
}

include '../view/insertPatView.html';

?>
