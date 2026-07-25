<?php
require_once '../Controller/DatabaseConnection.php';

class TimeSlot {
    public $id;
    public $doctorID;
    public $patientID;
    public $specialty;
    public $date;
    public $startTime;
    public $endTime;
    public $isBooked;
    public $status;
    private $db;

    public function __construct() {
        $dbConn = new DatabaseConnection();
        $this->db = $dbConn->connect();
    }

    public function markAsBooked($patientID) {
        $sql = "UPDATE time_slots SET is_booked = 1, patient_id = '$patientID', status = 'upcoming' WHERE id = '$this->id'";
        return mysqli_query($this->db, $sql);
    }

    public function markAsAvailable() {
        $sql = "UPDATE time_slots SET is_booked = 0, patient_id = NULL, status = 'available' WHERE id = '$this->id'";
        return mysqli_query($this->db, $sql);
    }

    public function updateStatus($newStatus) {
        $sql = "UPDATE time_slots SET status = '$newStatus' WHERE id = '$this->id'";
        return mysqli_query($this->db, $sql);
    }
}
?>