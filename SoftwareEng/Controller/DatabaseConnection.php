<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!class_exists('DatabaseConnection')) {

    class DatabaseConnection {
        private $host = "127.0.0.1";
        private $username = "root";
        private $password = "";
        private $port = 3307; // المنفذ المضبوط في جهازك
        private $dbname = "clinic_db";
        public $conn;

        public function connect() {
            mysqli_report(MYSQLI_REPORT_OFF);

            $this->conn = @mysqli_connect($this->host, $this->username, $this->password, "", $this->port);

            if (!$this->conn) {
                die("<div style='color:red; font-weight:bold; font-family:sans-serif; text-align:center; margin-top:30px; direction:rtl;'>
                         فشل الاتصال بالسيرفر: <br>" . mysqli_connect_error() . "
                     </div>");
            }
            
            // إنشاء قاعدة البيانات إن لم تكن موجودة
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            mysqli_query($this->conn, $sql);
            mysqli_select_db($this->conn, $this->dbname);
            
            $this->initializeTables();
            return $this->conn;
        }

        public function initializeTables() {
            // 1️⃣ إنشاء جدول المستخدمين
            $sql1 = "CREATE TABLE IF NOT EXISTS USERS (
                USERID INT AUTO_INCREMENT PRIMARY KEY,
                First_Name VARCHAR(50),
                Last_Name VARCHAR(50),
                EMAIL VARCHAR(100) UNIQUE,
                PHONE VARCHAR(20),
                password VARCHAR(255),
                role VARCHAR(20) DEFAULT 'user',
                IMAGE VARCHAR(255) DEFAULT 'default.png'
            )";
            mysqli_query($this->conn, $sql1);

            // 2️⃣ إنشاء جدول المواعيد
            $sql2 = "CREATE TABLE IF NOT EXISTS time_slots (
                id INT AUTO_INCREMENT PRIMARY KEY,
                doctor_id INT,
                patient_id INT NULL,
                specialty VARCHAR(100),
                date DATE,
                start_time TIME,
                end_time TIME,
                is_booked TINYINT(1) DEFAULT 0,
                status VARCHAR(20) DEFAULT 'available',
                FOREIGN KEY (doctor_id) REFERENCES USERS(USERID) ON DELETE CASCADE,
                FOREIGN KEY (patient_id) REFERENCES USERS(USERID) ON DELETE SET NULL
            )";
            mysqli_query($this->conn, $sql2);

            $this->insertDefaultUsers();
        }

        private function insertDefaultUsers() {
            // كلمة المرور الموحدة للتجربة هي: 123456 (مشفورة بنفس طريقة النظام)
            $defaultPassword = password_hash("123456", PASSWORD_BCRYPT);

            // إضافة الأدمن
            $sqlAdmin = "INSERT IGNORE INTO USERS (First_Name, Last_Name, EMAIL, PHONE, password, role) 
                         VALUES ('Admin', 'System', 'admin@clinic.com', '0590000000', '$defaultPassword', 'admin')";
            mysqli_query($this->conn, $sqlAdmin);

            // إضافة الدكتور الأول (عام)
            $sqlDoc1 = "INSERT IGNORE INTO USERS (First_Name, Last_Name, EMAIL, PHONE, password, role) 
                        VALUES ('أحمد', 'العام', 'doc.general@clinic.com', '0591111111', '$defaultPassword', 'doctor')";
            mysqli_query($this->conn, $sqlDoc1);

            // إضافة الدكتور الثاني (أطفال)
            $sqlDoc2 = "INSERT IGNORE INTO USERS (First_Name, Last_Name, EMAIL, PHONE, password, role) 
                        VALUES ('سارة', 'الأطفال', 'doc.pediatric@clinic.com', '0592222222', '$defaultPassword', 'doctor')";
            mysqli_query($this->conn, $sqlDoc2);
        }
    }

}
?>