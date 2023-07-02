<?php
include "../connect.php";
session_start();
	

//-------------------------REGISTER CUSTOMER-------------------------//

if (isset($_POST['reg_user'])) 
{
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
  
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    $user_check_query = "select * from customer where customer_name= '$customer_name' or email='$email' limit 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if(empty($customer_name)) 
    { 
	   header("Location: register_cus.php?error=Full Name is required"); 
    }   
    elseif(empty($dob)) 
    { 
       header("Location: register_cus.php?error=Date of Birth is required"); 
    }
    elseif(empty($gender)) 
    { 
	   header("Location: register_cus.php?error=Gender is required"); 
    }
    elseif(empty($address)) 
    { 
	   header("Location: register_cus.php?error=Address is required"); 
    }
    elseif(empty($contact_no)) 
    { 
	   header("Location: register_cus.php?error=Phone Number is required"); 
    }
    elseif(empty($email)) 
    { 
       header("Location: register_cus.php?error=Email is required"); 
    }
    elseif(empty($password_1)) 
    { 
	   header("Location: register_cus.php?error=Password is required");  
    }
    elseif($password_1 != $password_2) 
    {
	   header("Location: register_cus.php?error=The two passwords do not match"); 
    }
    elseif(empty($_FILES['image']['name']))
    {
        header("Location: register_cus.php?error=Image is required");
    }
    elseif($user) 
    {
        if ($user['customer_name'] === $customer_name) 
        {
            header("Location: register_cus.php?error=Customer already exists");
        }
        if ($user['email'] === $email) 
        {
            header("Location: register_cus.php?error=Email already exists");
        }
    }
    else
    {
        $password = ($password_1);
	
        $query = "insert into customer (customer_name, dob, gender, address, contact_no, email, password, profile_picture, verification_status) VALUES ('$customer_name','$dob', '$gender', '$address', '$contact_no', '$email', '$password', '$file', 'Pending')";
        mysqli_query($conn, $query);
        echo "<script>alert('Account has been created!\\nPlease wait for the admin\'s approval!'); window.location.href = '../login/login.php';</script>";
	}
}

?>