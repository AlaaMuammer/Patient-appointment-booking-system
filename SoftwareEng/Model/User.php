<?php
require_once '../Controller/DatabaseConnection.php';

class User {
    public $userID;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    protected $password;
    public $role;
    public $image;
    protected $db;

    public function __construct() {
        $dbConn = new DatabaseConnection();
        $this->db = $dbConn->connect();
    }

    public function login($email, $password) {
        $email = mysqli_real_escape_string($this->db, $email);
        $sql = "SELECT * FROM USERS WHERE EMAIL='$email'";
        $result = mysqli_query($this->db, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $this->userID = $user['USERID'];
                $this->firstName = $user['First_Name'];
                $this->lastName = $user['Last_Name'];
                $this->email = $user['EMAIL'];
                $this->role = $user['role'];
                
                $_SESSION['user_id'] = $this->userID;
                $_SESSION['First_Name'] = $this->firstName;
                $_SESSION['role'] = $this->role;
                return true;
            }
        }
        return false;
    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>