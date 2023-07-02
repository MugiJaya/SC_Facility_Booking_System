<?php
include "../connect.php";
session_start();
	

//-------------------------REGISTER CUSTOMER-------------------------//

if (isset($_POST['reg_user'])) 
{
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
  
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $company_address = mysqli_real_escape_string($conn, $_POST['company_address']);
    $company_contact_no = mysqli_real_escape_string($conn, $_POST['company_contact_no']);
    $company_email = mysqli_real_escape_string($conn, $_POST['company_email']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    $user_check_query = "select * from company where client_name= '$client_name' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if (empty($client_name)) 
    { 
	   header("Location: register_com.php?error=Full Name is required"); 
    }   
    elseif (empty($dob)) 
    { 
       header("Location: register_com.php?error=Date of Birth is required"); 
    }
    elseif (empty($gender)) 
    { 
	   header("Location: register_com.php?error=Gender is required"); 
    }
    elseif (empty($address)) 
    { 
	   header("Location: register_com.php?error=Address is required"); 
    }
    elseif (empty($contact_no)) 
    { 
	   header("Location: register_com.php?error=Phone Number is required"); 
    }
    elseif (empty($email)) 
    { 
       header("Location: register_com.php?error=Email is required"); 
    }
    elseif (empty($password_1)) 
    { 
	   header("Location: register_com.php?error=Password is required");  
    }
    elseif ($password_1 != $password_2) 
    {
	   header("Location: register_com.php?error=The two passwords do not match"); 
    }
    elseif(empty($_FILES['image']['name']))
    {
        header("Location: register_com.php?error=Image is required");
    }
    elseif (empty($company_name)) 
    { 
       header("Location: register_com.php?error=Company Name is required"); 
    }
    elseif (empty($company_address)) 
    { 
       header("Location: register_com.php?error=Email is required"); 
    }
    elseif (empty($company_contact_no)) 
    { 
       header("Location: register_com.php?error=Email is required"); 
    }
    elseif (empty($company_email)) 
    { 
       header("Location: register_com.php?error=Email is required"); 
    }
    elseif (empty($position)) 
    { 
       header("Location: register_com.php?error=Email is required"); 
    }    
    elseif ($user) 
    {
        if ($user['client_name'] === $client_name) 
        {
            header("Location: register_com.php?error=Customer already exists");
        }
        if ($user['email'] === $email) 
        {
            header("Location: register_com.php?error=Email already exists");
        }
    }
    else
    {
        $password = ($password_1);
	
        $query = "insert into company (client_name, dob, gender, address, contact_no, email, password, profile_picture, company_name, company_address, company_contact_no, company_email, position, verification_status) VALUES ('$client_name','$dob', '$gender', '$address', '$contact_no', '$email', '$password', '$file', '$company_name', '$company_address', '$company_contact_no', '$company_email', '$position', 'Pending')";
        mysqli_query($conn, $query);
        echo "<script>alert('Account has been created!\\nPlease wait for the admin\'s approval!'); window.location.href = '../login/login.php';</script>";
	}
}

?>