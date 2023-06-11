<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
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
		<form id="border" class="border shadow p-3 rounded" action="login_process.php" method="post" style="width: 450px;">
			<h1 class="text-center p-3">Bukit Jalil Sports Complex</h1>
	
		  	<!--ERROR MSG-->
		  
		  	<?php if (isset($_GET['error'])) { ?>
		  	<div class="alert alert-warning" role="alert">
		  	<?=$_GET['error']?>
		  	</div>
		  	<?php } ?>

		  	<!--ERROR MSG-->
		  
		  	<div class="mb-3">
		  		<label for="email" class="form-label">Email</label>
		  		<input type="text" name="email" class="form-control" id="email">
		  	</div>
		 
		  	<div class="mb-3">
		    	<label for="password" class="form-label">Password</label>
		    	<input type="password" name="password" class="form-control" id="password">	   
		  	</div>

		  	<div class="mb-0">
				<label class="form-label">Select User Role:</label>		  	
		  	</div>
		  
		  	<select class="form-select mb-3" name="role">
		  		<option selected>-- Select Role --</option>
		  		<option value="admin">Admin</option>
		  		<option value="customer">Customer</option>
		  		<option value="company">Company</option>
		  	</select>

		  	<div class="col-md-12 text-center">
		  		<button type="submit" class="btn btn-primary">Login</button>
		  	</div>

		 	<br> 
		 	<p align="center">Forget password?<a href="reset_password_acc_type.php";>Reset Now</a></p>
		  	<p align="center">Do not have an Account?<a href="../register/register_acc_type.php";>Register Now</a></p>

		 </form>
	</div>

</body>

</html>
