<?php
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: singin.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['user_login'];
if ($user['level'] != 'administrator') {
    echo '<script>alert("สำหรับผู้ดูแลระบบเท่านั้น");window.location="index.php";</script>';
    exit;
}

include_once('./function.php');
$objCon = connectDB();

$data = $_POST;
$u_email = $data['u_email'];
$u_password = ($data['u_password']); // เข้ารหัสด้วย md5 password
$u_level = $data['u_level'];
//
$strSQL = "INSERT INTO user(`u_email`,`u_password`, `u_level`) VALUES ('$u_email', '$u_password', '$u_level')";

$objQuery = mysqli_query($objCon, $strSQL) or die(mysqli_error($objCon));
if ($objQuery) {
    echo '<script>alert("ADD USER สำเร็จ");window.location="people.php";</script>';
} else {
    echo '<script>alert("พบข้อผิดพลาด");window.location="people.php";</script>';
}

