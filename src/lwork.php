<?php
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
  header("location: singin.php"); // redirect ไปยังหน้า singin.php
  exit;
}

$user = $_SESSION['user_login'];


//เชื่อมต่อกับ function และ สร้างตัวแปร และนำมาแสดง--------------------------
include_once('./function.php');
$objCon = connectDB();
$sql = "SELECT * FROM leaves";
$query = mysqli_query($objCon, $sql);
// END -------------------------



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOOK a LEAVE</title>
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-dark">


  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top py-2 mb-2 justify-content-md-between border-bottom">
    <div class="container-fluid">
      <a class="navbar-brand text-info" href="#">Dev itt</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
        <form class="form-inline d-flex ms-auto justify-content-end">
          <?php if ($user['level'] == 'administrator') { // แสดงลิงค์ไปยังหน้าผู้ดูแลระบบเมื่อผู้ใช้เป็นแอดมิน 
          ?>
            <a href="admin.php" class="btn btn-warning me-2">หน้าสำหรับผู้ดูแลระบบ</a>
          <?php } ?>
          <a href="logout_ac.php" class="btn btn-danger">ออกจากระบบ</a>
        </form>
      </div>
    </div>
  </nav>


  <div class="container-fluid py-2 mb-2">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active text-light" aria-current="page" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home text-light align-text-bottom" aria-hidden="true">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Home
              </a>
            </li>


            <?php
/*
            <li class="nav-item">
              <a class="nav-link text-light" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file text-light align-text-bottom" aria-hidden="true">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                *
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart text-light align-text-bottom" aria-hidden="true">
                  <circle cx="9" cy="21" r="1"></circle>
                  <circle cx="20" cy="21" r="1"></circle>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                *
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users text-light align-text-bottom" aria-hidden="true">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                *
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2 text-light align-text-bottom" aria-hidden="true">
                  <line x1="18" y1="20" x2="18" y2="10"></line>
                  <line x1="12" y1="20" x2="12" y2="4"></line>
                  <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                *
              </a>
            </li>
*/
            ?>


            <li class="nav-item">
              <a class="nav-link text-light " href="lwork.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather text-light feather-layers align-text-bottom" aria-hidden="true">
                  <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                  <polyline points="2 17 12 22 22 17"></polyline>
                  <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
                จองวันลา
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link text-light " href="car.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather text-light feather-layers align-text-bottom" aria-hidden="true">
                  <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                  <polyline points="2 17 12 22 22 17"></polyline>
                  <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
                จองรถ
              </a>
            </li>
            
          </ul>
      </nav>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 text-info">Leave Booking System</h1>
        </div>




        <!-- ตาราง แสดง Data -->
        <div class="text-light container-fluid">
          <h3>สถานะการจองวันลาของฉัน</h3>

          <div>
            <table class="mx-1 table table-dark table-striped">
              <tr class="text-warning h5">
                <td>Email</td>
                <td>วันลาที่จอง</td>
                <td>เหตุผลที่ลา</td>
                <td>ความเห็นหัวหน้า</td>
                <td>สถานะคำขอ</td>
              </tr>


              <?php foreach ($query as $data) { ?>
                <?php if ($user['email'] == $data['u_email']) { ?>
                  <tr class="text-light ">
                    <th><?= $data['u_email'] ?></th>
                    <th><?= $data['leave_date'] ?></th>
                    <th><?= $data['leave_reason'] ?></th>
                    <th><?= $data['status_reason'] ?></th>
                    <th><?php
                        if ($data['status_a'] == 'อนุมัติ') {
                          echo '<span style="color: green;">อนุมัติ</span>';
                        } elseif ($data['status_a'] == 'ไม่อนุมัติ') {
                          echo '<span style="color: red;">ไม่อนุมัติ</span>';
                        } else {
                          echo $data['status_a'];
                        }

                        ?></th>
                    </th>
                  </tr>

                <?php } ?>
              <?php } ?>
            </table>
          </div>
          <!-- END ตาราง แสดง data -->





          <div class="text-light container-fluid">
            <h3>จองวันลา</h3>
            <form method="POST" action="lwork_ac.php">
              <div>
                <form method="POST" action="lwork_ac.php">
                  <table class="mx-1 table table-dark table-striped">
                    <tr class="text-warning h5">
                      <td>Email</td>
                      <td>วันที่ต้องการลา</td>
                      <td>เหตุผลการลา</td>
                      <td>ส่งคำขอ</td>
                    </tr>

                    <tr class="text-light ">
                      <th><input type="text" name="u_email" value="<?php echo $user['email']; ?>" readonly></th>
                      <th><input type="date" id="leave_date" name="leave_date" required><br></th>
                      <th><textarea id="leave_reason" name="leave_reason" required></textarea></th>
                      <th><input onclick="return confirm('ยืนยันการส่งคำขอ')" class="btn-sm btn btn-outline-success mx-2 mb-1" type="submit" value="ส่งคำขอ"></th>
                      </th>
                    </tr>
                  </table>
                </form>
              </div>
          </div>







          <script src="js/login.js"></script>
</body>

</html>