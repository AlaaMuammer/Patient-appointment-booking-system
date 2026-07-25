<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'init.php';
require_once '../Model/User.php';

$dbConn = new DatabaseConnection();
$conn = $dbConn->connect();

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM USERS WHERE EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password']) || $password === $user['password']) {
            $_SESSION['user_id'] = $user['USERID'];
            $_SESSION['First_Name'] = $user['First_Name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['role'] === 'doctor') {
                header("Location: indexDoc.php");
            } else {
                header("Location: indexPat.php");
            }
            exit();
        } else {
            $error = "كلمة المرور غير صحيحة!";
        }
    } else {
        $error = "البريد الإلكتروني غير مسجل!";
    }
}

include '../view/loginView.html';

?>

