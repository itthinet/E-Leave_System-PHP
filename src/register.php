<?php
session_start(); // เปิดใช้งาน session
if (isset($_SESSION['user_login'])) { // ถ้าเข้าระบบอยู่
    header("location: index.php"); // redirect ไปยังหน้า index.php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Dev woon</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/style.css" rel="stylesheet">
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
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
							
					<form method="post" action="register_ac.php"> <!-- เชื่อมมม connect -->
					
						<div class="mb-3">

								<div class="mb-3">
									<input id="u_email" type="email" class="form-control" name="u_email" value="" required="" autofocus="" placeholder="Email">
									<div class="invalid-feedback">Email is invalid</div>
								</div>

								<div class="mb-3">
									<input id="u_passwrod" type="password" class="form-control" name="u_password" value="" required="" autofocus="" placeholder="Password">
									<div class="invalid-feedback">Password</div>
								</div>
                                

    	                        <div class="mb-3">
									<input id="confirm_password" type="password" class="form-control" name="confirm_password" required value="" required="" autofocus="" placeholder="Confirm Password">
									<div class="invalid-feedback">Confirm Passwrod</div></div>
	
								<div class="mb-3">
									<input id="u_passwrod" type="name" class="form-control" name="u_name" value="" required="" autofocus="" placeholder="Name">
									<div class="invalid-feedback">Name</div>
								</div>

								<div class="mb-3">
									<input id="u_tel" type="tel" class="form-control" name="u_tel" value="" required="" autofocus="" placeholder="Phone Number">
									<div class="invalid-feedback">Tel</div>
								</div>
                                

							    <div class="mb-3">
									<button type="submit" class="btn btn-primary">Register</button>
								</div>

								<div class="mb-3">
                   					<label for="u_level" class="form-label">Level</label>
                   					<select id="u_level" name="u_level" class="form-select">
                      				<option value="user">ผู้ใช้ทั่วไป</option>
                        			</select>
								</div>
					</form>



						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Back to Login Peng <a href="singin.php" class="text-dark">Login</a>
							</div>
						</div>

						
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>


</body>
</html>

