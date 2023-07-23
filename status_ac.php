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

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if (mysqli_connect_errno()) {
        die("การเชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
    }

    return $objCon;

}


// ตรวจสอบการส่งค่า POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์มหรือแหล่งข้อมูล
    $id = $_POST["id"];
    $user_email = $_POST["user_email"];
    $leave_date = $_POST["leave_date"];
    $leave_reason = $_POST["leave_reason"];
    $status_a = $_POST["status_a"];
    $status_reason = $_POST["status_reason"];
    // ... รับค่าอื่นๆ

    // เชื่อมต่อฐานข้อมูล
    $objCon = connectDB();

    // สร้าง SQL query สำหรับการตรวจสอบว่ามีแถวที่ต้องการอัปเดตหรือไม่
$checkQuery = "SELECT * FROM leaves WHERE id='$id'";
$result = $objCon->query($checkQuery);

if ($result->num_rows > 0) {
    // มีแถวที่ต้องการอัปเดต
    $updateQuery = "UPDATE 
        leaves 
    SET 
        id='$id',
        user_email='$user_email',
        leave_date='$leave_date',
        leave_reason='$leave_reason',
        status_a='$status_a',
        status_reason='$status_reason' 
    WHERE 
    id='$id'";

    if ($objCon->query($updateQuery) === TRUE) {
        // อัปเดตสำเร็จ
        echo '<script>alert("Status successfully");window.location="admin_lwork.php";</script>';
    } else {
        // อัปเดตไม่สำเร็จ
        echo '<script>alert("Error");window.location="admin_lwork.php";</script>' . $objCon->error;
    }
} else {
    // ไม่พบแถวที่ต้องการอัปเดต
    echo "No rows found for the provided email: $id";
}
}
?>