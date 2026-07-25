<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'patient' && $_SESSION['role'] !== 'user')) {
    header("Location: login.php");
    exit();
}

$dbConn = new DatabaseConnection();
$conn = $dbConn->connect();

date_default_timezone_set('Asia/Gaza');
$current_date = date('Y-m-d');
$current_time = date('H:i:s');

$patient_id = intval($_SESSION['user_id']);

$sql_my_bookings = "SELECT ts.*, doctors.First_Name AS doc_first, doctors.Last_Name AS doc_last 
                    FROM time_slots ts
                    JOIN USERS doctors ON ts.doctor_id = doctors.USERID
                    WHERE ts.patient_id = '$patient_id' AND ts.is_booked = 1
                    ORDER BY ts.date ASC, ts.start_time ASC";
$my_bookings_result = mysqli_query($conn, $sql_my_bookings);

$sql_available = "SELECT ts.*, doctors.First_Name AS doc_first, doctors.Last_Name AS doc_last 
                  FROM time_slots ts
                  JOIN USERS doctors ON ts.doctor_id = doctors.USERID
                  WHERE ts.is_booked = 0 
                    AND (ts.date > '$current_date' OR (ts.date = '$current_date' AND ts.start_time >= '$current_time'))
                  ORDER BY ts.date ASC, ts.start_time ASC";
$available_result = mysqli_query($conn, $sql_available);

include '../view/indexPatView.html';

?>

