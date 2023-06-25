<?php
include "../connect.php";
session_start();
$session_id = $_SESSION['session_id'];


//---------------------------------------------------------UPDATE PROFILE---------------------------------------------------------//


if(isset($_POST['update_profile']))
{
   	$client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
   	$email = mysqli_real_escape_string($conn, $_POST['email']);
   	$dob = $_POST['dob'];
   	$contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
   	$address = mysqli_real_escape_string($conn, $_POST['address']);
   
   	$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
   	$company_email = mysqli_real_escape_string($conn, $_POST['company_email']);
   	$company_contact_no = mysqli_real_escape_string($conn, $_POST['company_contact_no']);
   	$position = mysqli_real_escape_string($conn, $_POST['position']);
   	$company_address = mysqli_real_escape_string($conn, $_POST['company_address']);

   	mysqli_query($conn, "update company set client_name='$client_name', dob='$dob', address='$address', contact_no='$contact_no', email='$email', company_name='$company_name', company_address='$company_address', company_contact_no='$company_contact_no', company_email='$company_email', position='$position' where email='$session_id'");

   	$old_pass = $_POST['old_pass'];
   	$update_pass = mysqli_real_escape_string($conn, $_POST['update_pass']);
   	$new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
   	$confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_pass']);
	
	if(!empty($update_pass)){
		if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
			if($update_pass != $old_pass){
				$message[] = 'old password not matched!';
			}
			elseif($new_pass != $confirm_pass){
				$message[] = 'confirm password not matched!';
			}
			else{
				mysqli_query($conn, "update company set password = '$confirm_pass' where email = '$session_id'");
				$message[] = 'password updated successfully!';
			}
		}
	}

	$update_image = $_FILES['update_image']['name'];
   	$update_image_size = $_FILES['update_image']['size'];
   	$update_image_tmp_name = $_FILES['update_image']['tmp_name'];

   	if(!empty($update_image)){
   		if($update_image_size > 4000000000){
   			$message[] = 'image is too large';
   		}
   		else{
   			$img_ex = pathinfo($update_image, PATHINFO_EXTENSION);
   			$img_ex_lc = strtolower($img_ex);

   			$allowed_exs = array("jpg", "jpeg", "png");

   			if(in_array($img_ex_lc,$allowed_exs)){
   				$image = addslashes(file_get_contents($update_image_tmp_name));
   				$image_update_query = mysqli_query($conn, "update company set profile_picture = '$image' where email = '$session_id'");

   				$message[] = 'image updated succssfully!';
   			}
   			else{
   				$message[] = 'Not a supported file type';
   			}
   		}
   	}
   	$_SESSION['message'] = $message;

   	header('location: profile.php');
}


?>