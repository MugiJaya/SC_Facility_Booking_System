<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$eml = $_POST['email'];
		$newpass = $_POST['password'];
		include "../connect.php";

		$sql="update company set password= '".$newpass."' where email = '".$eml."'";
		$result=mysqli_query($conn,$sql);
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Reset Password (Company)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
    	<div id="checkForm" class="border shadow p-3 rounded bg-white" style="width: 450px">

    		<h1 class="text-center p-3">Reset Password (Company)</h1>
    		<div class="mb-3">
    			<label for="email" class="form-label">Email</label>
		    	<input type="text" name="email" class="form-control" id="email">
            	<p style="display:none" id="errorUsr" class="text-danger">Please enter your email</p>
		  	</div>
		 
		  	<div class="mb-3">
		    	<label for="contact_no" class="form-label">Phone Number</label>
		    	<input type="text" name="contact_no" class="form-control" id="contact_no">
            	<p style="display:none" id="error" class="text-danger">Please provide your phone number</p>
		  	</div>

	
		 	<div class ="form-group mb-3 text-center">
		  		<button type="submit" id="submit" disabled class="btn btn-primary">Check</button>
		  	</div>
		  
          	<div class="spinner-border text-info" role="status" id="loadCheck" style="display:none">
            	<span class="visually-hidden">Checking user...</span>
          	</div>
		  
		  	<p style="display:none" id="notFound" class="text-danger">User Not Found.</p>
		  	<br> 
		  	<p align="center">Remembered your password?<a href="../login/login.php">Login Now</a></p>

        </div>
        
        <div id="changeForm" class="border shadow p-3 rounded bg-white" style="width: 450px;display:none">

		  	<h1 class="text-center p-3">Set New Password</h1>
		  	<form method="post" id="updatePassword">
		  	
		  	<div class="mb-3">
		    	<label for="password" class="form-label">Password</label>
		    	<input type="password" name="password" class="form-control" id="password">
		  	</div>
		 
		  	<div class="mb-3">
		    	<label for="confirm_password" class="form-label">Confirm Password</label>
		    	<input type="password" name="confirm_password" class="form-control" id="confirm_password">
            	<p style="display:none" id="errorPass" class="text-danger">Passwords do not match!</p>
		  	</div>

	
		 	<div class ="form-group mb-3 text-center">
		  		<button type="submit" id="passSubmit" disabled class="btn btn-primary">Change Password</button>
		  	</div>
     		
     		<br>
     		<form>
		  		<p align="center">Remembered your password?<a href="login.php">Login Now</a></p>
		  	</form>
		 </div>
	</div>

</body>

<script src="reset_password_com.js"></script>

</body>
</html>
