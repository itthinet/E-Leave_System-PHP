<?php
include_once('./function.php');
$objCon = connectDB();

$data = $_POST;
$u_email = $data['u_email'];
$u_password = md5($data['u_password']); // เข้ารหัสด้วย md5 password
$u_level = $data['u_level'];
$u_name = $data['u_name'];
$u_tel = $data['u_tel'];
//
$strSQL = "INSERT INTO 
user(
    `u_email`,
    `u_password`, 
    `u_level`,
    `u_name`,
    `u_tel`
) VALUES (
    '$u_email', 
    '$u_password', 
    '$u_level',
    '$u_name',
    '$u_tel'
)";

$confirm_password = $_POST["confirm_password"];

if ($u_password === $confirm_password) {
    // รหัสผ่านถูกต้อง
    
   
echo "Password confirmed successfully.";
} else {
    
   
// รหัสผ่านไม่ตรงกัน
    
   
echo "Passwords do not match.";
}


$objQuery = mysqli_query($objCon, $strSQL) or die(mysqli_error($objCon));
if ($objQuery) {
    echo '<script>alert("ลงทะเบียนเรียบร้อยแล้ว");window.location="singin.php";</script>';
} else {
    echo '<script>alert("พบข้อผิดพลาด");window.location="register.php";</script>';
}

	