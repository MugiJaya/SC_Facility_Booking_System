<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Select Account</title>
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
		<form id="border" class="border shadow p-3 rounded" style="width: 450px;">
			<h1 class="text-center p-3">Choose Account Type</h1>
			
			<br>
		  	<div class="col-md-12 text-center">
		  		<a class="btn btn-primary" style="padding: 10px;" href="register_cus.php";>👨‍💼 Customer</a>
		  		&nbsp;&nbsp;&nbsp;&nbsp;
		  		<a class="btn btn-primary" style="padding: 10px;" href="register_com.php";>🏢 Company</a>
		  	</div>

		  	<br><br>
		  	<div class="col-md-12 text-center">
		  		<p align="center">Already a member?<a href="../login/login.php">Sign in</a></p>
		  	</div>

		 </form>
	</div>

</body>

</html>
