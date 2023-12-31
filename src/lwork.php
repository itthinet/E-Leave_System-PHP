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
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <title>"W_P ONE"</title>

  <!--LINK-->
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../js/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <!-- SWEET Aleart -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- SWEET Aleart -->

  <!-- CDN FROM Bootstrap WEB -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- CDN FROM Bootstrap WEB -->

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!--LINK-->

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="../css/offcanvas-navbar.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">

  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Profile_One</a>
      <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <?php if ($user['level'] == 'administrator') { // แสดงลิงค์ไปยังหน้าผู้ดูแลระบบเมื่อผู้ใช้เป็นแอดมิน 
          ?>
            <a href="admin.php" class="me-2 btn btn-warning">ผู้ดูแลระบบ</a>
          <?php } ?>
          <a href="logout_ac.php" class="btn btn-danger">ออกจากระบบ</a>
        </form>
      </div>
    </div>
  </nav>

  <div class="nav-scroller bg-body shadow-sm">
    <nav class="nav" aria-label="Secondary navigation">
      <a class="nav-link active" aria-current="page" href="index.php">ประกาศจากบริษัท</a>
      <a class="nav-link" href="lwork.php">จองวันลา</a>
      <a class="nav-link" href="car.php">จองรถ</a>
      <a class="nav-link" href="#">แจ้งซ่อม</a>
    </nav>
  </div>

  <main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-0">สถานะการจองวันลาของฉัน</h6>
      <div class="d-flex text-body-secondary pt-3">

        <table class="pb-3 mb-0 small lh-sm border-bottom table table-striped">
          <tr class="text-warning h8">
            <td hidden>Email</td>
            <td>วันลาที่จอง</td>
            <td>เหตุผลที่ลา</td>
            <td hidden>ความเห็นหัวหน้า</td>
            <td>สถานะคำขอ</td>
          </tr>

          <?php foreach ($query as $data) { ?>
            <?php if ($user['email'] == $data['u_email']) { ?>
              <tr class="text-light ">
                <th hidden><?= $data['u_email'] ?></th>
                <th><?= $data['leave_date'] ?></th>
                <th><?= $data['leave_reason'] ?></th>
                <th hidden><?= $data['status_reason'] ?></th>
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

      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">จองวันลา</h6>
        <div class="d-flex text-body-secondary pt-3">

          <div>
            <form method="POST" action="lwork_ac.php">
              <div class="pb-3 mb-0 small lh-sm border-bottom">

                <div hidden>Email
                  <input type="text" name="u_email" value="<?php echo $user['email']; ?>" readonly>
                </div>

                <div class="mb-2">วันที่ลางาน
                  <input type="date" id="leave_date" name="leave_date" required>
                </div>

                <div class="mb-2">ประเภทการลา
                  <select id="leave_reason" name="leave_reason" required>
                    <option selected disabled>เลือกประเภท</option>
                    <option value="ลาป่วย">ลาป่วย</option>
                    <option value="ลาพักร้อน">ลาพักร้อน</option>
                    <option value="ลากิจ">ลากิจ</option>
                  </select>
                </div>

                <div class="mb-2">
                  <input onclick="return confirm('ยืนยันการส่งคำขอ')" class="btn btn-outline-success btn-sm" type="submit" value="ส่งคำขอ">
                </div>

            </form>

          </div>
  </main>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/offcanvas-navbar.js"></script>
</body>

</html>