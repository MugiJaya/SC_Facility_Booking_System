<?php
include "../connect.php";
session_start();
$session_id = $_SESSION['session_id'];


/*----------------Customer---------------*/
$customer_name = "";
$dob = "";
$gender = "";
$address = "";
$contact_no = "";
$email = "";
$password = "";
$verification_status = "";
$admin_id = "";
$customer_id = 0;

/*----------------Company---------------*/
$client_name = "";
$dob = "";
$gender = "";
$address = "";
$contact_no = "";
$email = "";
$password = "";
$company_name = "";
$company_address = "";
$company_contact_no	 = "";
$company_email = "";
$position = "";
$verification_status = "";
$admin_id = "";
$company_id = 0;

/*----------------Booking---------------*/
$reservation_time = "";
$reservation_start_time = "";
$reservation_end_time = "";
$reservation_purpose = "";
$approval_status = "";
$rating = "";
$feedback = "";
$customer_id = "";
$customer_name = "";
$facility_id = "";
$facility_name = "";
$payment_id = "";
$payment_amount = "";
$payment_time = "";
$booking_id = 0;

/*----------------Event Reservation---------------*/
$reservation_time = "";
$reservation_start_time = "";
$reservation_end_time = "";
$reservation_purpose = "";
$approval_status = "";
$rating = "";
$event_type = "";
$request = "";
$feedback = "";
$company_id = "";
$company_name = "";
$client_name = "";
$facility_id = "";
$facility_name = "";
$payment_id = "";
$payment_amount = "";
$payment_time = "";
$evt_reservation_id = 0;

/*----------------Facility---------------*/
$facility_name = "";
$facility_type = "";
$facility_capacity	 = "";
$for_events = "";
$description = "";
$price = "";
$file = "";
$facility_id = 0;

/*----------------Equipment---------------*/
$equipment_name = "";
$eqiupment_type = "";
$quantity = "";
$description = "";
$file = "";
$facility_id = "";
$facility_name = "";
$equipment_id = 0;

/*----------------Equipment Reservation---------------*/

$evt_reservation_id = "";
$reservation_time = "";
$reservation_start_time = "";
$reservation_end_time = "";
$reservation_purpose = "";
$event_type = "";
$request = "";
$company_id = "";
$company_name = "";
$client_name = "";
$facility_id	 = "";
$facility_name = "";
$equipment_id = "";
$equipment_name = "";
$eqiupment_type = "";
$quantity = "";
$description = "";
$reservation_quantity = "";
$reservation_description = "";
$eqp_reservation_id = 0;

/*----------------UPDATE---------------*/
$update = false;



// ----------------------------------------------------------- RECORDS ----------------------------------------------------------- //
/*------------------------------------------------------------CUSTOMER------------------------------------------------------------*/


if (isset($_POST['update'])) 
{
	$customer_id = $_POST['customer_id'];
	$customer_name = $_POST['customer_name'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$verification_status = $_POST['verification_status'];
	$admin_id = $_POST['admin_id'];
	
	mysqli_query($conn, "update customer set customer_name='$customer_name', dob='$dob', gender='$gender', address='$address', contact_no='$contact_no', email='$email', password='$password', verification_status='$verification_status', admin_id='$admin_id' where customer_id=$customer_id");

	mysqli_query($conn, "update customer set admin_id = (select admin_id from admin where email = '$session_id') where customer_id = $customer_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_customer.php');
}


if (isset($_POST['update2'])) 
{
	$customer_id = $_POST['customer_id'];
	$customer_name = $_POST['customer_name'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$verification_status = $_POST['verification_status'];
	$admin_id = $_POST['admin_id'];
	
	mysqli_query($conn, "update customer set customer_name='$customer_name', dob='$dob', gender='$gender', address='$address', contact_no='$contact_no', email='$email', password='$password', verification_status='$verification_status', admin_id='$admin_id' where customer_id=$customer_id");

	mysqli_query($conn, "update customer set admin_id = (select admin_id from admin where email = '$session_id') where customer_id = $customer_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_customer_approval.php');
}


/*------------------------------------------------------------COMPANY------------------------------------------------------------*/


if (isset($_POST['update3'])) 
{
	$company_id = $_POST['company_id'];
	$client_name = $_POST['client_name'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$company_name = $_POST['company_name'];
	$company_address = $_POST['company_address'];
	$company_contact_no = $_POST['company_contact_no'];
	$company_email = $_POST['company_email'];
	$position = $_POST['position'];
	$verification_status = $_POST['verification_status'];
	$admin_id = $_POST['admin_id'];
	
	mysqli_query($conn, "update company set client_name='$client_name', dob='$dob', gender='$gender', address='$address', contact_no='$contact_no', email='$email', password='$password', company_name='$company_name', company_address='$company_address', company_contact_no='$company_contact_no', company_email='$company_email', position='$position', verification_status='$verification_status', admin_id='$admin_id' where company_id=$company_id");

	mysqli_query($conn, "update company set admin_id = (select admin_id from admin where email = '$session_id') where company_id = $company_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_company.php');
}


if (isset($_POST['update4'])) 
{
	$company_id = $_POST['company_id'];
	$client_name = $_POST['client_name'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$company_name = $_POST['company_name'];
	$company_address = $_POST['company_address'];
	$company_contact_no = $_POST['company_contact_no'];
	$company_email = $_POST['company_email'];
	$position = $_POST['position'];
	$verification_status = $_POST['verification_status'];
	$admin_id = $_POST['admin_id'];
	
	mysqli_query($conn, "update company set client_name='$client_name', dob='$dob', gender='$gender', address='$address', contact_no='$contact_no', email='$email', password='$password', company_name='$company_name', company_address='$company_address', company_contact_no='$company_contact_no', company_email='$company_email', position='$position', verification_status='$verification_status', admin_id='$admin_id' where company_id=$company_id");

	mysqli_query($conn, "update company set admin_id = (select admin_id from admin where email = '$session_id') where company_id = $company_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_company_approval.php');
}


/*------------------------------------------------------------BOOKING------------------------------------------------------------*/


if (isset($_POST['update5'])) 
{
	$booking_id = $_POST['booking_id'];
    $reservation_time = $_POST['reservation_time'];
    $reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $approval_status = $_POST['approval_status'];
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $payment_id = $_POST['payment_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_time = $_POST['payment_time'];
	
	mysqli_query($conn, "update booking set reservation_time='$reservation_time', reservation_start_time='$reservation_start_time', reservation_end_time='$reservation_end_time', reservation_purpose='$reservation_purpose', approval_status='$approval_status' where booking_id=$booking_id");

	mysqli_query($conn, "update payment set payment_amount='$payment_amount', payment_time='$payment_time' where payment_id=$payment_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_booking.php');
}


if (isset($_POST['update6'])) 
{
	$booking_id = $_POST['booking_id'];
    $reservation_time = $_POST['reservation_time'];
    $reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $approval_status = $_POST['approval_status'];
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $payment_id = $_POST['payment_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_time = $_POST['payment_time'];
	
	mysqli_query($conn, "update booking set reservation_time='$reservation_time', reservation_start_time='$reservation_start_time', reservation_end_time='$reservation_end_time', reservation_purpose='$reservation_purpose', approval_status='$approval_status' where booking_id=$booking_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_booking_approval.php');
}


if (isset($_POST['update7'])) 
{
	$evt_reservation_id = $_POST['evt_reservation_id'];
    $reservation_time = $_POST['reservation_time'];
    $reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $event_type = $_POST['event_type'];
    $request = $_POST['request'];
    $approval_status = $_POST['approval_status'];
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $client_name = $_POST['client_name'];
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $payment_id = $_POST['payment_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_time = $_POST['payment_time'];
	
	mysqli_query($conn, "update event_reservation set reservation_time='$reservation_time', reservation_start_time='$reservation_start_time', reservation_end_time='$reservation_end_time', reservation_purpose='$reservation_purpose', event_type='$event_type', request='$request', approval_status='$approval_status' where evt_reservation_id=$evt_reservation_id");

	mysqli_query($conn, "update payment set payment_amount='$payment_amount', payment_time='$payment_time' where payment_id=$payment_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_event.php');
}


if (isset($_POST['update8'])) 
{
	$evt_reservation_id = $_POST['evt_reservation_id'];
    $reservation_time = $_POST['reservation_time'];
    $reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $event_type = $_POST['event_type'];
    $request = $_POST['request'];
    $approval_status = $_POST['approval_status'];
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $client_name = $_POST['client_name'];
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $payment_id = $_POST['payment_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_time = $_POST['payment_time'];
	
	mysqli_query($conn, "update event_reservation set reservation_time='$reservation_time', reservation_start_time='$reservation_start_time', reservation_end_time='$reservation_end_time', reservation_purpose='$reservation_purpose', event_type='$event_type', request='$request', approval_status='$approval_status' where evt_reservation_id=$evt_reservation_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_event_approval.php');
}


/*------------------------------------------------------------FACILITY------------------------------------------------------------*/


if (isset($_POST['save9'])) 
{
	$facility_name = $_POST['facility_name'];
	$facility_type = $_POST['facility_type'];
	$facility_capacity = $_POST['facility_capacity'];
	$for_events = $_POST['for_events'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

	mysqli_query($conn, "insert into facility (facility_name, facility_type, facility_capacity, for_events, description, price, facility_image) values ('$facility_name', '$facility_type', '$facility_capacity', '$for_events', '$description', '$price', '$file')");

	$_SESSION['msg'] = "Saved"; 
	header('location: admin_add_facility.php');
}


if (isset($_POST['update9'])) 
{
	if(empty($_FILES['image']['name']))
	{
		$facility_id = $_POST['facility_id'];
		$facility_name = $_POST['facility_name'];
		$facility_type = $_POST['facility_type'];
		$facility_capacity = $_POST['facility_capacity'];
		$for_events = $_POST['for_events'];
		$description = $_POST['description'];
		$price = $_POST['price'];
	
		mysqli_query($conn, "update facility set facility_name='$facility_name', facility_type='$facility_type', facility_capacity='$facility_capacity', for_events='$for_events', description='$description', price='$price' where facility_id=$facility_id");

		$_SESSION['msg'] = "Updated!"; 
		header('location: admin_facility.php');
	}
	else
	{
		$facility_id = $_POST['facility_id'];
		$facility_name = $_POST['facility_name'];
		$facility_type = $_POST['facility_type'];
		$facility_capacity = $_POST['facility_capacity'];
		$for_events = $_POST['for_events'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	
		mysqli_query($conn, "update facility set facility_name='$facility_name', facility_type='$facility_type', facility_capacity='$facility_capacity', for_events='$for_events', description='$description', price='$price', facility_image='$file' where facility_id=$facility_id");

		$_SESSION['msg'] = "Updated!"; 
		header('location: admin_facility.php');
	}
}


/*------------------------------------------------------------EQUIPMENT------------------------------------------------------------*/


if (isset($_POST['save10'])) 
{
	$equipment_name = $_POST['equipment_name'];
	$eqiupment_type = $_POST['eqiupment_type'];
	$quantity = $_POST['quantity'];
	$description = $_POST['description'];
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	$facility_id = $_POST['facility_id'];

	mysqli_query($conn, "insert into equipment (equipment_name, eqiupment_type, quantity, description, equipment_image, facility_id) values ('$equipment_name', '$eqiupment_type', '$quantity', '$description', '$file', '$facility_id')");

	$_SESSION['msg'] = "Saved"; 
	header('location: admin_add_equipment.php');
}


if (isset($_POST['update10'])) 
{
	if(empty($_FILES['image']['name']))
	{
		$equipment_id = $_POST['equipment_id'];
		$equipment_name = $_POST['equipment_name'];
		$eqiupment_type = $_POST['eqiupment_type'];
		$quantity = $_POST['quantity'];
		$description = $_POST['description'];
		$facility_id = $_POST['facility_id'];
	
		mysqli_query($conn, "update equipment set equipment_name='$equipment_name', eqiupment_type='$eqiupment_type', quantity='$quantity', description='$description', facility_id='$facility_id' where equipment_id=$equipment_id");

		$_SESSION['msg'] = "Updated!"; 
		header('location: admin_equipment.php');
	}
	else
	{
		$equipment_id = $_POST['equipment_id'];
		$equipment_name = $_POST['equipment_name'];
		$eqiupment_type = $_POST['eqiupment_type'];
		$quantity = $_POST['quantity'];
		$description = $_POST['description'];
		$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		$facility_id = $_POST['facility_id'];
	
		mysqli_query($conn, "update equipment set equipment_name='$equipment_name', eqiupment_type='$eqiupment_type', quantity='$quantity', description='$description', equipment_image='$file', facility_id='$facility_id' where equipment_id=$equipment_id");

		$_SESSION['msg'] = "Updated!"; 
		header('location: admin_equipment.php');
	}
}


/*---------------------------------------------------------EQUIPMENT RESERVATION---------------------------------------------------------*/


if (isset($_POST['update11'])) 
{
	$eqp_reservation_id = $_POST['eqp_reservation_id'];
    $reservation_quantity = $_POST['reservation_quantity'];
    $reservation_description = $_POST['reservation_description'];
	$evt_reservation_id = $_POST['evt_reservation_id'];
    $reservation_time = $_POST['reservation_time'];
    $reservation_start_time = $_POST['reservation_start_time'];
    $reservation_end_time = $_POST['reservation_end_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $event_type = $_POST['event_type'];
    $request = $_POST['request'];
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $client_name = $_POST['client_name'];
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $equipment_id = $_POST['equipment_id'];
    $equipment_name = $_POST['equipment_name'];
    $eqiupment_type = $_POST['eqiupment_type'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
	
	mysqli_query($conn, "update equipment_reservation set reservation_quantity='$reservation_quantity', reservation_description='$reservation_description' where eqp_reservation_id=$eqp_reservation_id");

	/*
	mysqli_query($conn, "update event_reservation set reservation_reservation_time='$reservation_time', reservation_start_time='$reservation_start_time', reservation_end_time='$reservation_end_time', reservation_purpose='$reservation_purpose', event_type='$event_type', request='$request' where evt_reservation_id=$evt_reservation_id");

	mysqli_query($conn, "update company set company_name='$company_name', client_name='$client_name' where company_id=$company_id");

	mysqli_query($conn, "update facility set facility_name='$facility_name' where facility_id=$facility_id");

	mysqli_query($conn, "update equipment set equipment_name='$equipment_name', eqiupment_type='$eqiupment_type', quantity='$quantity', description='$description' where equipment_id=$equipment_id");
	*/

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_equipment_reservation.php');
}


?>