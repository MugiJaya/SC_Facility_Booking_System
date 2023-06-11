<?php include ('register_com_process.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register (Company)</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
	body{
		background-color: lightblue;
		background-image: url("../images/index/bukit_jalil.jpg");
		background-repeat: no repeat;
		background-attachment: fixed;
		background-size: cover;	
		opacity: 0.9;
	}

	#border{
		background-color: white;
	}

</style>

<body>
	<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
		<form id="border" class="border shadow p-3 rounded" action="register_com_process.php" method="post" style="width: 450px;" enctype="multipart/form-data">

		<h1 class="text-center p-3">Bukit Jalil Sports Complex</h1>
		  
		<?php if (isset($_GET['error'])) { ?>
		<div class="alert alert-warning" role="alert">
			<?=$_GET['error']?>
		</div>
		<?php } ?>
		  
		<div class="mb-3">
			<label for="client_name" class="form-label">Full Name</label>
		    <input type="text" name="client_name" class="form-control" id="client_name">
		</div>
		
		<div class="mb-0">
			<label class="form-label">Select Date Birth</label>
			<p><input type="date" name="dob" class="form-control" /></p>
		</div>

		<div class="mb-0">
			<label class="form-label">Select Gender</label>
			<select class="form-select mb-3" name="gender">
		  		<option selected>-- Select Gender --</option>
		  		<option value="M">Male</option>
		  		<option value="F">Female</option>
			</select>  	
		</div>

		<div class="mb-3">
		    <label for="address" class="form-label">Address</label>
		    <input type="text" name="address" class="form-control" id="address">
		</div>

		<div class="mb-3">
		    <label for="contact_no" class="form-label">Phone Number </label>
		    <input type="text" name="contact_no" placeholder="e.g. 0123456789" class="form-control" id="contact_no">
		</div>

		<div class="mb-3">
		    <label for="email" class="form-label">Email</label>
		    <input type="text" name="email" placeholder="e.g. name@email.com" class="form-control" id="email">
		</div>

		<div class="mb-3">
			<label>Password</label>
			<input type="password" name="password_1" class="form-control">
		</div>
		  
		<div class="mb-3">
			<label>Confirm Password</label>
			<input type="password" name="password_2" class="form-control">
		</div>
		
		<div class="mb-3">
		    <label class="form-label">Profile Picture</label>
		    <input type="file" class="form-control" name="image">
		</div>

		<div class="mb-3">
			<label for="company_name" class="form-label">Company Name</label>
		    <input type="text" name="company_name" class="form-control" id="company_name">
		</div>

		<div class="mb-3">
		    <label for="company_address" class="form-label">Company Address</label>
		    <input type="text" name="company_address" class="form-control" id="company_address">
		</div>
		
		<div class="mb-3">
		    <label for="company_contact_no" class="form-label">Company Phone Number </label>
		    <input type="text" name="company_contact_no" placeholder="e.g. 0122223333" class="form-control" id="company_contact_no">
		</div>

		<div class="mb-3">
		    <label for="company_email" class="form-label">Company Email</label>
		    <input type="text" name="company_email" placeholder="e.g. company@email.com" class="form-control" id="company_email">
		</div>

		<div class="mb-3">
			<label for="position" class="form-label">Position</label>
		    <input type="text" name="position" class="form-control" id="position">
		</div>

		<div class="col-md-12 text-center">
			<button type="submit" class="btn btn-primary" name="reg_user">Register</button>
		</div>
			
		<p>
			<div class="col-md-12 text-center">Already a member?<a href="../login/login.php">Sign in</a></div>
		</p>

		</form>
	</div>
</body>
</html>