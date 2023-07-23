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
function connectDB()
{
    $serverName = "127.0.0.1";
    $userName = "root";
    $userPassword = "";
    $dbName = "eazy_db";

    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    mysqli_set_charset($objCon, "utf8");
    return $objCon;
}

$objCon = connectDB();

// ตรวจสอบการส่งค่า id ผ่านแบบฟอร์ม
if(isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    
    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM leaves WHERE id = '$id'";
    
    // ดำเนินการลบข้อมูล
    if ($objCon->query($sql) === TRUE) {
        echo '<script>alert("DELETE สำเร็จ");window.location="admin_lwork.php";</script>';
    } else {
        echo '<script>alert("พบข้อผิดพลาด");window.location="admin_lwork.php";</script>';
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$objCon->close();
?>