<?php
require_once 'User.php';

class Doctor extends User {

    public function confirmAttendance($slotID) {
        $slotID = intval($slotID);
        $sql = "UPDATE time_slots SET status = 'completed' WHERE id = '$slotID'";
        return mysqli_query($this->db, $sql);
    }
}
?>