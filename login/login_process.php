<?php
session_start();
include "../connect.php";

	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role']))
	{
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);
		$role = test_input($_POST['role']);

		if(empty($email)){
			header("Location: login.php?error=Email is Required");
		}
		elseif(empty($password)) 
		{
			header("Location: login.php?error=Password is Required");
		}
		elseif($role !='admin' && $role !='customer' && $role !='company')
		{
			header("Location: login.php?error=User Role is Required");
		}
		else
		{
			switch ($role) 
			{
				//-------------------------------ADMIN-------------------------------//
				case 'admin':
				$sql = "select * from admin where email = '".$email."' and password = '".$password."'";

				$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

				if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					if($row['email'] === $email && $row['password'] === $password)
					{
						$_SESSION['session_id'] = $row['email'];

						header("Location: ../admin/admin_customer.php");							
					}
				}
				else
				{
					header("Location: login.php?error=Incorrect Username and Password");
				}
				break;

				//-------------------------------CUSTOMER-------------------------------//
				case 'customer':
				$sql = "select * from customer where email = '".$email."' and password = '".$password."' and verification_status = 'Approved'";

				$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

				if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					if($row['email'] === $email && $row['password'] === $password)
					{
						$_SESSION['session_id'] = $row['email'];

						header("Location: ../customer/home.php");
					}
					else
					{
						header("Location: login.php?error=Your Account has been banned");
					}
				}
				else
				{
					header("Location: login.php?error=Incorrect Username and Password");
				}
				break;

				//-------------------------------COMPANY-------------------------------//
				case 'company':
				$sql = "select * from company where email = '".$email."' and password = '".$password."' and verification_status = 'Approved'";

				$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

				if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					if($row['email'] === $email && $row['password'] === $password)
					{
						$_SESSION['session_id'] = $row['email'];

						header("Location: ../company/home.php");
					}
					else
					{
						header("Location: login.php?error=Your Account has been banned");
					}
				}
				else
				{
					header("Location: login.php?error=Incorrect Username and Password");
				}
				break;
			}

		}
	}
	else
	{
		header("Location: login.php");
	}

?>