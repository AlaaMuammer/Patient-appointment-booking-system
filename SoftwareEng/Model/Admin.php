<?php
require_once 'User.php';

class Admin extends User {

    public function addTimeSlot($doctorId, $specialty, $date, $startTime, $endTime) {
        $sql = "INSERT INTO time_slots (doctor_id, specialty, date, start_time, end_time, is_booked, status) 
                VALUES ('$doctorId', '$specialty', '$date', '$startTime', '$endTime', 0, 'available')";
        return mysqli_query($this->db, $sql);
    }

    public function cancelBooking($slotId) {
        $slotId = intval($slotId);
        $sql = "UPDATE time_slots 
                SET is_booked = 0, patient_id = NULL, status = 'available' 
                WHERE id = '$slotId'";
        return mysqli_query($this->db, $sql);
    }
}
?>