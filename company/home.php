<?php  include('company_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
?>

<!DOCTYPE html>
<html>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="company_css_1.css">
  <link rel="stylesheet" href="home_css.css">
<style>

</style>
</head>
<body>

<div class="topnav">
  <a style="background-color: #00ace6; color: white;" href="home.php">Home</a>
  <a href="venues.php">Venues</a>
  <div class="dropdown">
    <button class="dropbtn">Reservation <i class="fa fa-caret-down"></i></button>
    <div class="dropdown-content">
      <a href="reserve_1.php">Reserve A Venue</a>
      <a href="pending_reserve.php">Pending Reservations</a>
      <a href="history_reserve.php">Reservation History</a>
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


<div class="container">
  <div class="box-container">
    
    <div class="box">
      <div class="image">
        <img src="../images/index/venues.jpg">
      </div>
      <div class="content">
        <h3>Venues</h3>
        <div class="icons"></div>
        <button onclick="window.location.href='venues.php';" class="btn">Go to page</button>
      </div>
    </div>

    <div class="box">
      <div class="image">
        <img src="../images/index/bukit_jalil.jpg">
      </div>
      <div class="content">
        <h3>Reserve A Venue</h3>
        <div class="icons"></div>
        <button onclick="window.location.href='reserve_1.php';" class="btn">Go to page</button>
      </div>
    </div>

    <div class="box">
      <div class="image">
        <img src="../images/index/pending_reservations.jpg">
      </div>
      <div class="content">
        <h3>Pending Reservations</h3>
        <div class="icons"></div>
        <button onclick="window.location.href='pending_reserve.php';" class="btn">Go to page</button>
      </div>
    </div>

    <div class="box">
      <div class="image">
        <img src="../images/index/reservation_history.jpg">
      </div>
      <div class="content">
        <h3>Reservation History</h3>
        <div class="icons"></div>
        <button onclick="window.location.href='history_reserve.php';" class="btn">Go to page</button>
      </div>
    </div>

  </div>
</div>


</body>
</html>
