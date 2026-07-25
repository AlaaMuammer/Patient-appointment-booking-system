<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../Model/Patient.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['slot_id'])) {
    header("Location: indexPat.php");
    exit();
}

$patient = new Patient();
$patient->cancelMyBooking($_GET['slot_id'], $_SESSION['user_id']);

header("Location: indexPat.php?cancelled=success");
exit();
?>