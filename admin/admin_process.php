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

/*----------------Facility---------------*/
$facility_name = "";
$facility_type = "";
$facility_capacity	 = "";
$for_events = "";
$description = "";
$price = "";
$file = "";
$facility_id = 0;

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


?>