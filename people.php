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
$query = mysqli_query($objCon,$sql);
// END -------------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin woon</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/style.css" rel="stylesheet">




</head>

<body class = "bg-dark">


<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top py-2 mb-2 justify-content-md-between border-bottom" >
  <div class="container-fluid">
    <a class="navbar-brand text-warning" href = "admin.php" xmlns="http://www.w3.org/2000/svg">Administrator By.Dev woon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Link</a>
        </li>
      </ul>
      <form class="d-flex" >
      <?php if ($user['level'] == 'administrator') { // แสดงลิงค์ไปยังหน้าผู้ดูแลระบบเมื่อผู้ใช้เป็นแอดมิน ?>
                <a href="index.php" class="btn btn-primary me-2">กลับสู่หน้าผู้ใช้งาน</a>
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
                <a class="nav-link active text-light" aria-current="page" href="admin.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home text-light align-text-bottom" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                  Admin
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users text-light align-text-bottom" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                  People
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="total_user.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2 text-light align-text-bottom" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                  Total User
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light"  href="admin_lwork.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather text-light feather-layers align-text-bottom" aria-hidden="true"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                  Leave
                </a>
              </li>
            </ul>
        </nav>
    
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">People</h1> 
          </div>
            

          <form method="post" action="people_ac.php"> <!-- เชื่อมมม connect -->
					
						<div class="mb-3 text-light container-fluid">

            <h1 class="h2">ADD USER</h1> 

								<div class="mb-3">
									<input id="u_email" type="email" class="form-control w-50" name="u_email" value="" required="" autofocus="" placeholder="Email">
									<div class="invalid-feedback">Email is invalid</div>
								</div>

								<div class="mb-3">
									<input id="u_passwrod" type="password" class="form-control w-50" name="u_password" value="" required="" autofocus="" placeholder="Password">
									<div class="invalid-feedback">Password</div>
								</div>
                                

    <!--                        <div class="mb-3">
									<input id="c_passwrod" type="password" class="form-control" name="c_password" value="" required="" autofocus="" placeholder="Confirm Password">
									<div class="invalid-feedback">Confirm Passwrod</div></div>
	-->⁡
                                

							    <div class="mb-3">
									<button type="submit" class="btn btn-primary" onclick="return confirm('ยืนยันการADD USER')">ADD</button>
								</div>

								<div class="mb-3 w-25">
                   	<label for="u_level" class="form-label">Level</label>
                   	<select id="u_level" name="u_level" class="form-select">
                    <option value="user">ผู้ใช้ทั่วไป</option>
                    <option value="administrator">ผู้ดูแลระบบ</option></select>
								</div>
					</form>


<!-- ตาราง แสดง database -->


<div>
<table class = "mx-1 table table-dark table-striped">
  <tr class = "text-warning h5">
    <td>Email</td>
    <td>Password</td>
    <td>Level</td>
    <td>Delete</td>
    <td>Edit</td>
  </tr>
  <?php foreach($query as $data) {?>
    <tr class = "text-light ">
      <th><?=$data['u_email']?></th>
      <th><?php echo $data['u_password']?></th>
      <th><?=$data['u_level']?></th>
      <th>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="email" value="<?= $data['u_email'] ?>">
                        <button type="submit" name="delete" onclick="return confirm('ยืนยันการลบ')" class="btn-sm btn btn-outline-danger mx-2 mb-1">Delete</button>
                    </form>
      </th>
      <th>
                    <form action="edit.php" method="post">
                        <input type="hidden" name="email" value="<?= $data['u_email'] ?>">
                        <button type="submit" name="edit" class="btn-sm btn btn-outline-info mx-2 mb-1">Edit</button>
                    </form>
      </th>
    </tr>
    <?php } ?>
</table>
          </div>  
          <!-- END ตาราง แสดง database -->


 <!-- <div class="container">
        <div class="bg-light p-5 rounded mt-3">
            <h1>สวัสดี <?php echo $user['email']; ?></h1>
     <h2>ระดับผู้ใช้ <?php echo $user['level']; ?></h2> 
        </div>
    </div>  -->
  
</body>
</html>