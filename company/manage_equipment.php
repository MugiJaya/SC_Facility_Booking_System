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
  <link rel="stylesheet" href="manage_equipment_css.css">
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


<div class="container">
    <h1 class="heading">Select Equipment</h1>
    <div class="box-container">
    <?php
        $facility_id = $_SESSION['facility_id'];
        $sql = "select e.*, er.* from equipment e join equipment_reservation er on e.equipment_id = er.equipment_id where e.facility_id = '$facility_id' and er.evt_reservation_id = (select evt_reservation_id from event_reservation where company_id = (select company_id from company where email = '$session_id') order by evt_reservation_id desc limit 1)";
        $venues = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        while ($row = mysqli_fetch_assoc($venues)) {
    ?>

    <div class="box">
        <div class="image">
            <?php 
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['equipment_image']).'"/>';
            ?>
        </div>

        <div class="content">
            <h3>
            <?php 
                echo $row["equipment_name"];      
            ?>  
            </h3>
            <p>
                <span>Description:</span>
                <?php echo $row["reservation_description"]; ?>
            </p>
            <p>
                <span>Quantity:</span>
                <?php echo $row["reservation_quantity"]; ?>
            </p>
            <div class="icons"></div>

            <form method="post" action="company_process.php">
                <input type="hidden" name="eqp_reservation_id" value="<?php echo $row["eqp_reservation_id"]; ?>">                
                <button class="btn" type="submit" name="remove">Remove</button>
            </form>
        </div>

    </div>

    <?php
        }
    ?>
    </div>

    <button id="home" onclick="window.location.href='reserve_3.php';">Back</button>

</div>



</body>
</html>
