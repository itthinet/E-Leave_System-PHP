<?php
session_start();
if (!isset($_SESSION['user_login'])) { // Check ถ้าไม่ได้เข้าระบบอยู่
    header("location: singin.php"); // redirect ไปยังหน้า singin.php
    exit;
}

// เชื่อมต่อกับฐานข้อมูล
function connectDB()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "eazy_db";

    // สร้างการเชื่อมต่อฐานข้อมูล
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }

    // คืนค่าการเชื่อมต่อฐานข้อมูล
    return $conn;
}


// ตรวจสอบการส่งคำขอ POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากแบบฟอร์ม
    $type_car = $_POST["type_car"];
    $date_car = $_POST["date_car"];
    $time_car1 = $_POST["time_car1"];
    $time_car2 = $_POST["time_car2"];
    $status_car = $_POST["status_car"];
    $users = $_POST["users"];

    // เชื่อมต่อกับฐานข้อมูล
    $conn = connectDB();

    $sql = "SELECT * FROM car_db WHERE type_car = '$type_car'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $updateSql = "UPDATE 
        car_db 
        SET 
        date_car = '$date_car', 
        time_car1 = '$time_car1', 
        time_car2 = '$time_car2', 
        status_car = '$status_car', 
        users = '$users' 
        WHERE 
        type_car = '$type_car'";
        if ($conn->query($updateSql) === TRUE) {
            // อัปเดตสำเร็จ
            echo '<script>alert("Data updated successfully");window.location="car.php";</script>';
        } else {
            // อัปเดตไม่สำเร็จ
            echo '<script>alert("Error");window.location="car.php";</script>' . $conn->error;
        }
    } else {
        // ไม่พบแถวที่ต้องการอัปเดต
        echo "No rows found for the provided car: $type_car";
    }


    /*     // ตรวจสอบว่าวันลาที่ผู้ใช้ต้องการจองซ้ำกับข้อมูลที่มีอยู่ในฐานข้อมูลหรือไม่
    $sql = "SELECT * FROM car_db WHERE status_car = '$status_car'";

    if($data['status_car'] === "ไม่ว่าง") {
        echo '<script>alert("ไม่สามารทำการจองได้เนื่องจากรถ ไม่ว่าง")</script>';
    } else {
        $sql = "UPDATE car_db SET status_car = ? WHERE status_car";
    }

    $result = $conn->query($sql);
    
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("ได้ทำการจองเรียบร้อยแล้ว");window.location="car.php";</scrip>';
        } else {
            echo "การบันทึกข้อมูลผิดพลาด: " . $conn->error;
        } */


    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}
