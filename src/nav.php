<?php
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
  header("location: singin.php"); // redirect ไปยังหน้า singin.php
  exit;
}

$user = $_SESSION['user_login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top py-2 mb-2 justify-content-md-between border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand text-info" href="index.php">Dev itt</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)"></a>
                    </li>
                </ul>
                <form class="d-flex">
                    <?php if ($user['level'] == 'administrator') { // แสดงลิงค์ไปยังหน้าผู้ดูแลระบบเมื่อผู้ใช้เป็นแอดมิน 
                    ?>
                        <a href="admin.php" class="btn btn-warning me-2">หน้าสำหรับผู้ดูแลระบบ</a>
                    <?php } ?>
                    <a href="logout_ac.php" class="btn btn-danger">ออกจากระบบ</a>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>