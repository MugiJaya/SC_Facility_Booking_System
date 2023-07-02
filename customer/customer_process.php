<?php
include "../connect.php";
session_start();
$session_id = $_SESSION['session_id'];


//---------------------------------------------------------UPDATE PROFILE---------------------------------------------------------//


if(isset($_POST['update_profile']))
{
   	$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
   	$email = mysqli_real_escape_string($conn, $_POST['email']);
   	$dob = $_POST['dob'];
   	$contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
   	$address = mysqli_real_escape_string($conn, $_POST['address']);

   	mysqli_query($conn, "update customer set customer_name='$customer_name', dob='$dob', address='$address', contact_no='$contact_no', email='$email' where email='$session_id'");

    $_SESSION['session_id'] = $email;

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
				mysqli_query($conn, "update customer set password = '$confirm_pass' where email = '$session_id'");
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
   				$image_update_query = mysqli_query($conn, "update customer set profile_picture = '$image' where email = '$session_id'");

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
    $current_time = date('Y-m-d\TH:i:s');

    $message = [];

    if (empty($reservation_start_time)) 
    {
        $message[] = 'Reservation Start Time is Required!';
    }
    if ($reservation_start_time < $current_time) 
    {
        $message[] = 'Reservation start time cannot be in the past.';
    }
    if (empty($reservation_end_time)) 
    {
        $message[] = 'Reservation End Time is Required!';
    }
    if ($reservation_end_time < $current_time) 
    {
        $message[] = 'Reservation end time cannot be in the past.';
    }
    if ($reservation_end_time < $reservation_start_time) 
    {
        $message[] = 'Reservation end time cannot be before the start time.';
    }
    $start_date = date('Y-m-d', strtotime($reservation_start_time));
    $end_date = date('Y-m-d', strtotime($reservation_end_time));
    if ($start_date !== $end_date) 
    {
        $message[] = 'Reservation start and end times should be on the same day.';
    }
    if (empty($reservation_purpose)) 
    {
        $message[] = 'Reservation Purpose is Required!';
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
        header('Location: reserve_2.php');
    }
}

if (isset($_POST['reservation_2'])) 
{
	$reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $facility_id = $_POST['facility_id'];

    $customer_id_query = mysqli_query($conn, "select customer_id from customer where email='$session_id'");
    $customer_id_row = mysqli_fetch_assoc($customer_id_query);
    $customer_id = $customer_id_row['customer_id'];

    mysqli_query($conn, "insert into booking (reservation_start_time, reservation_end_time, reservation_purpose, approval_status, facility_id, customer_id) values ('$reservation_start_time', '$reservation_end_time', '$reservation_purpose', 'Pending', '$facility_id', '$customer_id')");

    echo "<script>alert('The reservation has been placed!\\nPlease wait for the admin\'s approval!');</script>";
    echo "<meta http-equiv='refresh' content='0; url=pending_reserve.php'/>";
}

if (isset($_POST['payment'])) 
{
    $booking_id = $_POST['booking_id'];
    $price = $_POST['price'];

    mysqli_query($conn, "insert into payment (payment_amount) values ('$price')");

    mysqli_query($conn, "update booking set payment_id = (select max(payment_id) from payment) where booking_id = '$booking_id'");

    header('Location: history_reserve.php');
}

if (isset($_POST['rate'])) 
{
    $booking_id = $_POST['booking_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    mysqli_query($conn, "update booking set rating='$rating', feedback='$feedback' where booking_id = '$booking_id'");

    header('Location: history_reserve.php');
}


?>