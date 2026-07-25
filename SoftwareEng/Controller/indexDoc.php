<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../Model/Doctor.php';
require_once 'DatabaseConnection.php';

//  التأكد من تسجيل الدخول وأن المستخدم ذو دور 'doctor'
if (!isset($_SESSION['user_id']) || strtolower(trim($_SESSION['role'])) !== 'doctor') {
    header("Location: login.php");
    exit();
}

$dbConn = new DatabaseConnection();
$conn = $dbConn->connect();

date_default_timezone_set('Asia/Gaza'); 
$current_date = date('Y-m-d');
$current_time = date('H:i:s');

// معرف الطبيب المسجل حالياً في الجلسة
$doctor_id = intval($_SESSION['user_id']);

// استعلام جلب المواعيد المحجوزة الخاصة بهذا الطبيب فقط ($doctor_id)
$sql_appointments = "SELECT ts.*, 
                            patients.First_Name AS pat_first, patients.Last_Name AS pat_last
                     FROM time_slots ts
                     JOIN USERS AS patients ON ts.patient_id = patients.USERID
                     WHERE ts.doctor_id = ? AND ts.is_booked = 1
                     ORDER BY ts.date ASC, ts.start_time ASC";

$stmt_apps = mysqli_prepare($conn, $sql_appointments);
mysqli_stmt_bind_param($stmt_apps, "i", $doctor_id);
mysqli_stmt_execute($stmt_apps);
$result_apps = mysqli_stmt_get_result($stmt_apps);

include '../view/indexDocView.html';
?>

