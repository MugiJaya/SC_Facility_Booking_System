<?php  include('company_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reservation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="company_css_1.css">
  <link rel="stylesheet" href="profile_css.css">
  <link rel="stylesheet" href="venues_css.css">
<style>

.heading{
  margin-top: 60px;
  text-align: center;
  font-size: 40px;
  color:#334;
}

</style>
</head>
<body>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="venues.php">Venues</a>
  <div class="dropdown">
    <button style="background-color: #00ace6; color: white;" class="dropbtn">Reservation <i class="fa fa-caret-down"></i></button>
    <div class="dropdown-content">
      <a href="reserve_1.php">Reserve A Venue</a>
      <a href="#">Upcoming Reservations</a>
      <a href="#">Reservation History</a>
    </div>
  </div>
  <div class="topnav-right">
    <div class="dropdown">
      <button class="dropbtn">My Profile <i class="fa fa-caret-down"></i></button>
      <div class="dropdown-content">
        <a href="profile.php">Profile</a>
        <a href="../logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>


<div>
  <h1 class="heading">Reservation Information</h1>
  <div class="update-profile">
    <form method="post" action="company_process.php" enctype="multipart/form-data">

      <?php
      if(isset($message) || isset($_SESSION['message'])) {
        $message = isset($message) ? $message : $_SESSION['message'];
        unset($_SESSION['message']);
        foreach($message as $msg) {
          echo '<div class="message">'.$msg.'</div>';
        }
      }
      ?>

      <div class="flex">

         <div class="inputBox">
            <span>Reservation Start Time :</span>
            <input type="datetime-local" name="reservation_start_time" class="box">
            <span>Reservation End Time :</span>
            <input type="datetime-local" name="reservation_end_time" class="box">
            <span>Reservation Purpose :</span>
            <textarea rows="5" cols="30" class="box" name="reservation_purpose"></textarea>
          </div>

         <div class="inputBox">
            <span>Event Type :</span>
            <input type="text" name="event_type" class="box">
            <span>Request :</span>
            <textarea rows="5" cols="30" class="box" name="request"></textarea>
         </div>

      </div>

      <input type="submit" value="Choose Facility" name="reservation" class="btn">

    </form>
  </div>

</div>

</body>
</html>
