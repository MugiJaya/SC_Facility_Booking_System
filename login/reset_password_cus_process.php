<?php
    include "../connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];

    $sql="select * from customer where email= '".$email."' AND contact_no = '".$contact_no."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);

    if(mysqli_num_rows($result) > 0) {
        http_response_code(200);
    }
    else{
        http_response_code(400);
    }

};


?>