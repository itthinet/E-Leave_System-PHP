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
    session_start(); // เปิดใช้งาน session
    if (isset($_SESSION['user_login'])) { // ถ้าเข้าระบบอยู่
        header("location: index.php"); // redirect ไปยังหน้า index.php
        exit;
    }

    include_once("./function.php");
    $objCon = connectDB(); // เชื่อมต่อฐานข้อมูล
    $email = mysqli_real_escape_string($objCon, $_POST['email']); // รับค่า email
    $password = mysqli_real_escape_string($objCon, $_POST['password']); // รับค่า password


    $strSQL = "SELECT * FROM user WHERE u_email = '$email' AND u_password = ('$password')";
    /* $strSQL = "SELECT * FROM user WHERE u_email = '$email' AND u_password = mb5('$password')"; */

    $objQuery = mysqli_query($objCon, $strSQL);
    $row = mysqli_num_rows($objQuery);
    if ($row) {
        $res = mysqli_fetch_assoc($objQuery);
        $_SESSION['user_login'] = array(
            'id' => $res['u_id'],
            'email' => $res['u_email'],
            'level' => $res['u_level']
        );
        echo '<script>
        swal({
            title: "ยินดีต้อนรับ",
            text: " '. $res['u_email'].' ",
            icon: "success"
        }).then(function() {
            window.location="index.php";
        });
      </script>';
    } else {
        echo '<script>
        swal({
            title: "เข้าสู่ระบบไม่สำเร็จ",
            text: "username หรือ password ไม่ถูกต้อง!!",
            icon: "error"
        }).then(function() {
            window.location="singin.php";
        });
      </script>';
    }
    ?>
</body>

</html>