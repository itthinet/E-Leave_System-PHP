<?php
session_start();
if (!isset($_SESSION['user_login'])) { // Check ถ้าไม่ได้เข้าระบบอยู่
    header("location: singin.php"); // redirect ไปยังหน้า singin.php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>singin_ac</title>
    <!-- SWEET Aleart -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- SWEET Aleart -->
</head>

<body>
    <?php

    // เชื่อมต่อกับฐานข้อมูล
    function connectDB()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "eazy_db";

        // สร้างการเชื่อมต่อฐานข้อมูล
        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
        }

        // คืนค่าการเชื่อมต่อฐานข้อมูล
        return $conn;
    }

    // เชื่อมต่อกับฐานข้อมูล
    $conn = connectDB();

    // ตรวจสอบการส่งคำขอ POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // รับค่าจากแบบฟอร์ม

        $u_email = $_POST["u_email"];
        $leaveDate = $_POST["leave_date"];
        $leaveReason = $_POST["leave_reason"];

        // เชื่อมต่อกับฐานข้อมูล
        $conn = connectDB();

        // ตรวจสอบว่าวันลาที่ผู้ใช้ต้องการจองซ้ำกับข้อมูลที่มีอยู่ในฐานข้อมูลหรือไม่
        $sql = "SELECT * FROM leaves WHERE leave_date = '$leaveDate'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // แสดงข้อความว่าวันลาถูกจองไปแล้ว
            echo '<script>swal({
            title: "การจองไม่สำเร็จ",
            text: "คุณได้ทำการจองวันลานี้ไปแล้ว",
            icon: "error"
        }).then(function() {
            window.location="lwork.php";
        });</script>';
        } else {
            // ดำเนินการจองวันลาต่อไป
            // ตรวจสอบเงื่อนไขอื่นๆ และดำเนินการตามต้องการ
            // ...
            // บันทึกข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO leaves (u_email, leave_date, leave_reason) VALUES ('$u_email', '$leaveDate', '$leaveReason')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>swal({
                title: "การจองสำเร็จ",
                text: "ได้ทำการจองวันลาเรียบร้อยแล้ว",
                icon: "success"
            }).then(function() {
                window.location="lwork.php";
            });</script>';
            } else {
                echo "การบันทึกข้อมูลผิดพลาด: " . $conn->error;
            }
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn->close();
    }
    ?>
</body>

</html>