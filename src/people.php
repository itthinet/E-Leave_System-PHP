<?php
session_start();
if (!isset($_SESSION['user_login'])) { // Check ถ้าไม่ได้เข้าระบบอยู่
  header("location: singin.php"); // redirect ไปยังหน้า singin.php
  exit;
}
// check level user -----------------------------------------------
$user = $_SESSION['user_login'];
if ($user['level'] != 'administrator') {
  echo '<script>alert("สำหรับผู้ดูแลระบบเท่านั้น");window.location="index.php";</script>';
  exit;
}
//end check level user -----------------------------------------------


//เชื่อมต่อกับ function และ สร้างตัวแปร และนำมาแสดง--------------------------
include_once('./function.php');
$objCon = connectDB();
$sql = "SELECT * FROM user";
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
            <a href="index.php" class="me-2 btn btn-primary">ผู้ใช้งาน</a>
          <?php } ?>
          <a href="logout_ac.php" class="btn btn-danger">ออกจากระบบ</a>
        </form>
      </div>
    </div>
  </nav>

  <div class="nav-scroller bg-body shadow-sm">
    <nav class="nav" aria-label="Secondary navigation">
      <a class="nav-link active" aria-current="page" href="admin.php">หน้าแรก</a>
      <a class="nav-link" href="people.php">People</a>
      <a class="nav-link" href="total_user.php">Total User</a>
      <a class="nav-link" href="admin_lwork.php">Leave</a>
    </nav>
  </div>

  <main class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-sm">
      <img class="me-3" src="./pt/w_logo.png" alt="" width="70" height="70">
      <div class="lh-1">
        <h1 class="h6 mb-1 lh-1">W_P Co,Ltd</h1>
        <small>Admin Profile One</small>
      </div>
    </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-2">เพิ่มผู้ใช้งาน</h6>
      <form method="post" action="people_ac.php"> <!-- เชื่อมมม connect -->
        <div class="mb-2">
          <input id="u_email" type="email" class="form-control w-50" name="u_email" value="" required="" autofocus="" placeholder="Email">
          <div class="invalid-feedback">Email is invalid</div>
        </div>

        <div>
          <input id="u_passwrod" type="password" class="form-control w-50" name="u_password" value="" required="" autofocus="" placeholder="Password">
          <div class="invalid-feedback">Password</div>
        </div>
        ⁡
        <div class="pb-3 mb-2 small lh-sm border-bottom">
          <button type="submit" class="btn btn-primary" onclick="return confirm('ยืนยันการADD USER')">ADD</button>
        </div>

        <div>
          <label for="u_level" class="form-label">LEVEL</label>
          <br>
          <select id="u_level" name="u_level" class="">
            <option value="user">ผู้ใช้ทั่วไป</option>
            <option value="administrator">ผู้ดูแลระบบ</option>
          </select>
        </div>
      </form>
    </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-2">ตาราง USER</h6>
        <!-- ตาราง แสดง database -->
        <table class="pb-3 mb-0 small lh-sm border-bottom table table-striped">
          <tr class="pb-3 mb-0 small lh-sm table-striped">
            <td class="w-25" >Email</td>
            <td class="w-25 text-center">Name</td>
            <td class="text-center" hidden>Password</td>
            <td >Level</td>
            <td class="text-center">Delete</td>
            <td class="text-center">Edit</td>
          </tr>
          <?php foreach ($query as $data) { ?>
            <tr class="pb-3 mb-0 small lh-sm table-striped">
              <th ><?= $data['u_email'] ?></th>
              <th class="text-center"><?= $data['u_name'] ?></th>
              <th class="text-center" hidden><?php echo $data['u_password'] ?></th>
              <th ><?= $data['u_level'] ?></th>
              <th class="text-center">
                <form action="delete.php" method="post">
                  <input type="hidden" name="email" value="<?= $data['u_email'] ?>">
                  <button type="submit" name="delete" onclick="return confirm('ยืนยันการลบ')" class="btn-sm btn btn-outline-danger mx-2 mb-1">Delete</button>
                </form>
              </th>
              <th class="text-center">
                <form action="edit.php" method="post">
                  <input type="hidden" name="email" value="<?= $data['u_email'] ?>">
                  <button type="submit" name="edit" class="btn btn-outline-info btn-sm mx-2 mb-1">Edit</button>
                </form>
              </th>
            </tr>
          <?php } ?>
        </table>
    </div>

  </main>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/offcanvas-navbar.js"></script>
</body>

</html>

