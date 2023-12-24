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
$sql = "SELECT * FROM leaves";
$query = mysqli_query($objCon,$sql);
// END -------------------------



$objCon = connectDB();

// ตรวจสอบการส่งค่า email ผ่านแบบฟอร์ม

    $ide = $_POST['id'];
	
    $sql = "SELECT * FROM WHERE id = '$ide'";

    

// ปิดการเชื่อมต่อฐานข้อมูล
$objCon->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev woon</title>
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
                        
					<br>
                       
						<!--  <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100"> -->
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-2 card-title fw-bold mb-4">จัดการคำขอ</h1>

		<form method="post" action="status_ac.php">

			<?php foreach($query as $data) { ?>

					<?php if ($data['id'] == $ide ) { ?>
					
						<h6 class="fs-5 card-title mb-2" style="display:none;">ID</h6>
								<div class="mb-3">
    								<input id="id" style="display:none;" type="int" class="form-control" name="id" value="<?php echo $ide; ?>" required="" autofocus="" placeholder=""readonly>
    								<div class="invalid-feedback">ID</div>
								</div>
						<h6 class="fs-5 card-title mb-2">Email</h6>
								<div class="mb-3">
    								<input id="u_email" type="email" class="form-control" name="u_email" value="<?php echo $data['u_email']?>" required="" autofocus="" placeholder=""readonly>
    								<div class="invalid-feedback">Email</div>
								</div>
								<!-- <?php echo $_POST['user_email']; ?> -->
						<h6 class="fs-5 card-title mb-2">วันที่ขอลา</h6>
								<div class="mb-3">
									<input id="leave_date" type="text" class="form-control" name="leave_date" value="<?php echo $data['leave_date']?>" required="" autofocus="" placeholder="<?php echo $data['leave_date']?>"readonly>
									<div class="invalid-feedback">วันที่ลา</div>
								</div>
                        <h6 class="fs-5 card-title mb-2">เหตุผลในการลา</h6>
								<div class="mb-3">
									<input id="leave_reason" type="text" class="form-control" name="leave_reason" value="<?=$data['leave_reason']?>" required="" autofocus="" placeholder="<?=$data['leave_reason']?>"readonly>
									<div class="invalid-feedback">เหตุผลการลา</div>
								</div>
						<h6 class="fs-5 card-title mb-2">ความเห็นสำหรับคำขอ</h6>
								<div class="mb-3">
									<input id="status_reason" type="text" class="form-control" name="status_reason" value="" required="" autofocus="" placeholder="<?=$data['status_reason']?>">
									<div class="invalid-feedback">ลงความเห็น</div>
								</div>
						<h6 class="fs-5 card-title mb-2">สถานะคำขอ</h6>
                                
								<div class="mb-3">
									<div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="status_a" id="approve" value="อนุมัติ">
											<label class="form-check-label" for="approve">อนุมัติ</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="status_a" id="reject" value="ไม่อนุมัติ">
											<label class="form-check-label" for="reject">ไม่อนุมัติ</label>
										</div>
									</div>
								</div>



							    <div class="mb-3">
									<button type="submit" class="btn btn-primary">ตกลง</button>
									<a href="admin_lwork.php" class="btn btn-danger">ยกเลิก</a>
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

