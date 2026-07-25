<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../Model/Patient.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['slot_id'])) {
    header("Location: indexPat.php");
    exit();
}

$patient = new Patient();
$result = $patient->bookSlot($_POST['slot_id'], $_SESSION['user_id']);

if ($result) {
    header("Location: indexPat.php?booking=success");
} else {
    echo "حدث خطأ أثناء الحجز";
}
exit();
?>