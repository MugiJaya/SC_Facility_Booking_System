<?php  include('customer_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
?>

<!DOCTYPE html>
<html>
  <title>Reservation History</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="customer_css_1.css">
  <link rel="stylesheet" href="rating_css.css">
<style>

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


<h1 style="text-align: center; margin-top: 50px;">Feedback</h1>
    
<section class="rating">

<div class="cards">

  <div class="caption">
    <?php
    $booking_id = $_POST['booking_id'];
    $pending_rating = "select * from booking where booking_id = '$booking_id'";
    $result = mysqli_query($conn,$pending_rating) or die(mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <form action="customer_process.php" method="POST">

      <label>Score:</label><br>
      <select name="rating">
        <option value="⭐">⭐</option>
        <option value="⭐⭐">⭐⭐</option>
        <option value="⭐⭐⭐">⭐⭐⭐</option>
        <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
        <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
      </select>
      <br><br>

      <label>Feedback:</label><br>
      <textarea rows="5" cols="100" name="feedback" placeholder="Feedback"></textarea>
      <br><br>

      <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
      <button type="submit" name="rate" class="btn">Submit</button>

    </form>
    <?php 
    }
    ?>
  </div>

</div>
</section>

<div id="back"><a href="history_reserve.php">Back</a></div>
<br><br>

</body>
</html>
