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

//เชื่อมต่อกับ function และ สร้างตัวแปร และนำมาแสดง--------------------------
include_once('./function.php');
$objCon = connectDB();
$sql = "SELECT * FROM user";
$query = mysqli_query($objCon,$sql);
// END -------------------------



$objCon = connectDB();

// ตรวจสอบการส่งค่า email ผ่านแบบฟอร์ม

    $email = $_POST['email'];
	
	$sql = "SELECT * FROM WHERE u_email = '$email'";

    



// ปิดการเชื่อมต่อฐานข้อมูล
$objCon->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Dev woon</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class = "bg-dark"	>

	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
                        
					<br><br><br><br><br>
                       
						<!--  <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100"> -->
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Update Data User</h1>

		<form method="post" action="edit_ac.php">

			<?php foreach($query as $data) { ?>

					<?php if ($data['u_email'] == $email ) { ?>
					

								<div class="mb-3">
    								<input id="u_email" type="email" class="form-control" name="u_email" value="<?php echo $email; ?>" required="" autofocus="" placeholder=""readonly>
    								<div class="invalid-feedback">Email</div>
								</div>
								<!-- <?php echo $_POST['u_email']; ?> -->

								<div class="mb-3">
									<input id="u_passwrod" type="text" class="form-control" name="u_password" value="<?php echo $data['u_password']?>" required="" autofocus="" placeholder="<?php echo $data['u_password']?>">
									<div class="invalid-feedback">Password</div>
								</div>
                                
								<div class="mb-3">
									<input id="u_passwrod" type="name" class="form-control" name="u_name" value="<?=$data['u_name']?>" required="" autofocus="" placeholder="<?=$data['u_name']?>">
									<div class="invalid-feedback">Name</div>
								</div>

								<div class="mb-3">
									<input id="u_tel" type="text" class="form-control" name="u_tel" value="<?=$data['u_tel']?>" required="" autofocus="" placeholder="<?=$data['u_tel']?>">
									<div class="invalid-feedback">Tel</div>
								</div>
                                

							    <div class="mb-3">
									<button type="submit" class="btn btn-primary">Update</button>
									<a href="people.php" class="btn btn-danger">Cancel</a>
								</div>

			

					<?php } ?>
			<?php } ?>
			
		</form>
						
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>


</body>
</html>

