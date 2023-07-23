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
    $u_email = $_POST["u_email"];
    $u_password = $_POST["u_password"];
    $u_name = $_POST["u_name"];
    $u_tel = $_POST["u_tel"];
    // ... รับค่าอื่นๆ

    // เชื่อมต่อฐานข้อมูล
    $objCon = connectDB();

    // สร้าง SQL query สำหรับการตรวจสอบว่ามีแถวที่ต้องการอัปเดตหรือไม่
$checkQuery = "SELECT * FROM user WHERE u_email='$u_email'";
$result = $objCon->query($checkQuery);

if ($result->num_rows > 0) {
    // มีแถวที่ต้องการอัปเดต
    $updateQuery = "UPDATE 
        user 
    SET 
        u_email='$u_email',
        u_password='$u_password',
        u_name='$u_name', 
        u_tel='$u_tel' 
    WHERE 
        u_email='$u_email'";

    if ($objCon->query($updateQuery) === TRUE) {
        // อัปเดตสำเร็จ
        echo '<script>alert("Data updated successfully");window.location="people.php";</script>';
    } else {
        // อัปเดตไม่สำเร็จ
        echo '<script>alert("Error");window.location="admin_lwork.php";</script>' . $objCon->error;
    }
} else {
    // ไม่พบแถวที่ต้องการอัปเดต
    echo "No rows found for the provided email: $u_email";
}
}
?>