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
$sql = "SELECT * FROM car_db";
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
            <h6 class="border-bottom pb-2 mb-0">สถานะการจองรถ</h6>
            <div class="d-flex text-body-secondary pt-3">
                <!-- ตาราง แสดง Data -->
                <table class="pb-3 mb-0 small lh-sm border-bottom table table-striped">
                    <tr class="text-warning">
                        <td>ประเภทรถ</td>
                        <td>สถานะรถ</td>
                        <td>ผู้ใช้งาน</td>
                    </tr>

                    <?php foreach ($query as $data) { ?>
                        <tr class="text-light ">
                            <th><?= $data['type_car'] ?></th>
                            <th><?= $data['status_car'] ?></th>
                            <th><?= $data['users'] ?></th>
                            </th>
                        </tr>
                    <?php } ?>
                </table>
                <!-- END ตาราง แสดง data -->
            </div>

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">จองรถ</h6>
                <div class="d-flex text-body-secondary pt-3">

                    <form method="POST" action="car_ac.php">
                        <div class="mb-3">
                            <select id="type_car" name="type_car" class="text-dark">
                                <option selected disabled>---ประเภทรถ---</option>
                                <option value="1">รถกระบะ กก3523</option>
                                <option value="2">รถตู้ ขถ7846</option>
                                <option value="3">รถเก๋ง จก0943</option>
                            </select>
                            <label for="type_car">เลือกรถ</label>
                        </div>
                        <div class="mb-2">
                            <input id="date_car" type="date" name="date_car">
                            <label for="date_car">วันที่ใช้</label>
                        </div>

                        <div class="mb-2">
                            <input id="time-car1" type="time" name="time_car1">
                            <br>
                            <label>--ถึง-- เวลาที่ใช้งาน</label>
                            <br>
                            <input id="time-car2" type="time" name="time_car2">
                        </div>

                        <div class="mb-2">
                            <input id="user" type="text" name="users">
                            <label for="user">ผู้ใช้งาน</label>
                        </div>

                        <div class="mb-2">
                            <label for="status_car">จองรถ</label>
                            <input id="status_car" type="checkbox" name="status_car" value="จอง">
                        </div>

                        <div class="mb-2">
                            <label></label>
                            <input onclick="return confirm('ยืนยันการส่งคำขอ')" class="btn-sm btn btn-outline-success" type="submit" value="ส่งคำขอ">
                        </div>
                    </form>
    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/offcanvas-navbar.js"></script>
</body>

</html>