<?php
require_once 'User.php';

class Patient extends User {

    public function registerAccount($firstName, $lastName, $email, $phone, $password) {
        $firstName = mysqli_real_escape_string($this->db, $firstName);
        $lastName  = mysqli_real_escape_string($this->db, $lastName);
        $email     = mysqli_real_escape_string($this->db, $email);
        $phone     = mysqli_real_escape_string($this->db, $phone);

        $check_email = mysqli_query($this->db, "SELECT * FROM USERS WHERE EMAIL = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            return "هذا البريد الإلكتروني مسجل بالفعل لدينا!";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO USERS (First_Name, Last_Name, EMAIL, PHONE, password, role) 
                VALUES ('$firstName', '$lastName', '$email', '$phone', '$hashed_password', 'user')";

        if (mysqli_query($this->db, $sql)) {
            return true;
        } else {
            return "حدث خطأ أثناء التسجيل: " . mysqli_error($this->db);
        }
    }

    public function bookSlot($slotID, $patientID) {
        $slotID = intval($slotID);
        $patientID = intval($patientID);
        $sql = "UPDATE time_slots 
                SET is_booked = 1, patient_id = '$patientID', status = 'upcoming' 
                WHERE id = '$slotID' AND is_booked = 0";
        return mysqli_query($this->db, $sql);
    }

    public function cancelMyBooking($slotID, $patientID) {
        $slotID = intval($slotID);
        $patientID = intval($patientID);
        $sql = "UPDATE time_slots 
                SET is_booked = 0, patient_id = NULL, status = 'available' 
                WHERE id = '$slotID' AND patient_id = '$patientID'";
        return mysqli_query($this->db, $sql);
    }
}
?>