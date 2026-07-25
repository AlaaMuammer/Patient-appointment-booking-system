<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'DatabaseConnection.php';

// التحقق من صلاحية الأدمن
if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php");
    exit();
}

$dbConn = new DatabaseConnection();
$conn = $dbConn->connect();

date_default_timezone_set('Asia/Gaza');
$current_date = date('Y-m-d');
$current_time = date('H:i:s');

$message = "";
$error = "";

// إجراء تأكيد الحضور من قبل الأدمن
if (isset($_GET['confirm_id'])) {
    $c_id = intval($_GET['confirm_id']);
    $sql_confirm = "UPDATE time_slots SET status = 'completed' WHERE id = '$c_id'";
    if (mysqli_query($conn, $sql_confirm)) {
        header("Location: admin_dashboard.php?status=confirmed");
        exit();
    }
}

//  معالجة إضافة موعد جديد
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_slot'])) {
    $doctor_id  = intval($_POST['doctor_id']);
    $date       = mysqli_real_escape_string($conn, $_POST['date']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $end_time   = mysqli_real_escape_string($conn, $_POST['end_time']);

    if (empty($doctor_id) || empty($date) || empty($start_time) || empty($end_time)) {
        $error = "يرجى تعبئة جميع الحقول بشكل صحيح.";
    } elseif ($start_time >= $end_time) {
        $error = "وقت البداية يجب أن يكون قبل وقت النهاية.";
    } else {
        $sql_insert = "INSERT INTO time_slots (doctor_id, date, start_time, end_time, is_booked, status) 
                       VALUES ('$doctor_id', '$date', '$start_time', '$end_time', 0, 'available')";
        
        if (mysqli_query($conn, $sql_insert)) {
            $message = "تمت إضافة الموعد بنجاح!";
        } else {
            $error = "حدث خطأ أثناء إضافة الموعد: " . mysqli_error($conn);
        }
    }
}

//  معالجة حذف موعد متاح
if (isset($_GET['delete_slot_id'])) {
    $delete_id = intval($_GET['delete_slot_id']);
    // نحذف فقط المواعيد غير المحجوزة
    $sql_delete = "DELETE FROM time_slots WHERE id = '$delete_id' AND is_booked = 0";
    if (mysqli_query($conn, $sql_delete)) {
        header("Location: admin_dashboard.php?status=deleted");
        exit();
    }
}

// جلب قائمة الأطباء للإضافة
$sql_doctors = "SELECT USERID, First_Name, Last_Name FROM USERS WHERE LOWER(role) = 'doctor'";
$doctors_result = mysqli_query($conn, $sql_doctors);

// جلب المواعيد المتاحة فقط
$sql_available_all = "SELECT ts.*, doctors.First_Name AS doc_first, doctors.Last_Name AS doc_last 
                      FROM time_slots ts
                      JOIN USERS doctors ON ts.doctor_id = doctors.USERID
                      WHERE ts.is_booked = 0 
                        AND (ts.date > '$current_date' OR (ts.date = '$current_date' AND ts.start_time >= '$current_time'))
                      ORDER BY ts.date ASC, ts.start_time ASC";

$available_result = mysqli_query($conn, $sql_available_all);

// جلب الحجوزات (المواعيد المحجوزة للمرضى)
$sql_booked_all = "SELECT ts.*, 
                          doctors.First_Name AS doc_first, doctors.Last_Name AS doc_last,
                          patients.First_Name AS pat_first, patients.Last_Name AS pat_last
                   FROM time_slots ts
                   JOIN USERS doctors ON ts.doctor_id = doctors.USERID
                   JOIN USERS patients ON ts.patient_id = patients.USERID
                   WHERE ts.is_booked = 1
                   ORDER BY ts.date DESC, ts.start_time DESC";

$booked_result = mysqli_query($conn, $sql_booked_all);

include '../view/adminDash.html';
?>
