<?php
include "../connect.php";
session_start();
$session_id = $_SESSION['session_id'];


/*----------------CUSTOMER---------------*/
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

/*----------------COMPANY---------------*/
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
$reservation_date = "";
$reservation_time = "";
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
$payment_date = "";
$payment_time = "";
$booking_id = 0;

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
$quantity	 = "";
$description = "";
$file = "";
$facility_id = "";
$equipment_id = 0;

/*----------------UPDATE---------------*/
$update = false;



// ------------------------------------------------------------RECORDS------------------------------------------------------------ //
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


if (isset($_GET['delete2'])) 
{
	$customer_id = $_GET['delete2'];
	mysqli_query($conn, "delete from customer where customer_id = $customer_id");
	$_SESSION['msg'] = "Deleted!"; 
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


if (isset($_GET['delete4'])) 
{
	$company_id = $_GET['delete4'];
	mysqli_query($conn, "delete from company where company_id = $company_id");
	$_SESSION['msg'] = "Deleted!"; 
	header('location: admin_company_approval.php');
}


/*------------------------------------------------------------COMPANY------------------------------------------------------------*/


if (isset($_POST['update5'])) 
{
	$booking_id = $_POST['booking_id'];
	$reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $reservation_purpose = $_POST['reservation_purpose'];
    $approval_status = $_POST['approval_status'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $payment_id = $_POST['payment_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];
    $payment_time = $_POST['payment_time'];
	
	mysqli_query($conn, "update booking set reservation_date='$reservation_date', reservation_time='$reservation_time', reservation_purpose='$reservation_purpose', approval_status='$approval_status', rating='$rating', feedback='$feedback' where booking_id=$booking_id");

	mysqli_query($conn, "update payment set payment_amount='$payment_amount', payment_date='$payment_date', payment_time='$payment_time' where payment_id=$payment_id");

	$_SESSION['msg'] = "Updated!"; 
	header('location: admin_booking.php');
}




/*------------------------------------------------------------FACILITY------------------------------------------------------------*/


if (isset($_POST['save7'])) 
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


if (isset($_POST['update7'])) 
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


if (isset($_GET['delete7'])) 
{
	$facility_id = $_GET['delete7'];
	mysqli_query($conn, "delete from facility where facility_id = $facility_id");
	$_SESSION['msg'] = "Deleted!"; 
	header('location: admin_facility.php');
}


/*------------------------------------------------------------EQUIPMENT------------------------------------------------------------*/


if (isset($_POST['save8'])) 
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


if (isset($_POST['update8'])) 
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

if (isset($_GET['delete9'])) 
{
	$equipment_id = $_GET['delete9'];
	mysqli_query($conn, "delete from equipment where equipment_id = $equipment_id");
	$_SESSION['msg'] = "Deleted!"; 
	header('location: admin_equipment.php');
}

?>