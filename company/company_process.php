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


//---------------------------------------------------------RESERVATION---------------------------------------------------------//


if (isset($_POST['reservation'])) 
{
    $reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $event_type = $_POST['event_type'];
    $request = $_POST['request'];

    $message = [];

    if (empty($reservation_start_time)) 
    {
        $message[] = 'Reservation Start Time is Required!';
    }
    if (empty($reservation_end_time)) 
    {
        $message[] = 'Reservation End Time is Required!';
    }
    if (empty($reservation_purpose)) 
    {
        $message[] = 'Reservation Purpose is Required!';
    }
    if (empty($event_type)) 
    {
        $message[] = 'Event Type is Required!';
    }
    if (empty($request)) 
    {
        $message[] = 'Request is Required!';
    }
    if (!empty($message)) 
    {
        $_SESSION['message'] = $message;
        header('Location: reserve_1.php');
    } 
    else 
    {
    	$_SESSION['reservation_start_time'] = $reservation_start_time;
        $_SESSION['reservation_end_time'] = $reservation_end_time;
        $_SESSION['reservation_purpose'] = $reservation_purpose;
        $_SESSION['event_type'] = $event_type;
        $_SESSION['request'] = $request;
        header('Location: reserve_2.php');
    }
}

if (isset($_POST['reservation_2'])) 
{
	$reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $event_type = $_POST['event_type'];
    $request = $_POST['request'];
    $facility_id = $_POST['facility_id'];

    $company_id_query = mysqli_query($conn, "select company_id from company where email='$session_id'");
    $company_id_row = mysqli_fetch_assoc($company_id_query);
    $company_id = $company_id_row['company_id'];

    mysqli_query($conn, "insert into event_reservation (reservation_start_time, reservation_end_time, reservation_purpose, event_type, request, facility_id, company_id) values ('$reservation_start_time', '$reservation_end_time', '$reservation_purpose', '$event_type', '$request', '$facility_id', '$company_id')");

    $_SESSION['facility_id'] = $facility_id;
    header('Location: reserve_3.php');
}

if (isset($_POST['reservation_3'])) 
{
	$reservation_description = $_POST['reservation_description'];
    $reservation_quantity = $_POST['reservation_quantity'];
    $evt_reservation_id = $_POST['evt_reservation_id'];
    $equipment_id = $_POST['equipment_id'];

    if(empty($reservation_description))
    {
        echo "<script>alert('Please fill up description!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=reserve_3.php'/>";
    }
    else
    {
    	mysqli_query($conn, "insert into equipment_reservation (reservation_description, reservation_quantity, evt_reservation_id, equipment_id) values ('$reservation_description', '$reservation_quantity', '$evt_reservation_id', '$equipment_id')");

    	header('Location: reserve_3.php');
    }
}

if (isset($_POST['remove'])) 
{
	$eqp_reservation_id = $_POST['eqp_reservation_id'];

    mysqli_query($conn, "delete from equipment_reservation where eqp_reservation_id = '$eqp_reservation_id'");

    header('Location: manage_equipment.php');
}


?>