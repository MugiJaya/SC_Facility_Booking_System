<?php  include('company_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
?>

<!DOCTYPE html>
<html>
  <title>Reservations Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="company_css_1.css">
  <link rel="stylesheet" href="reserve_details_css.css">
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


<section class="reservation">
  <h1 class="reservation_details">Reservation Details</h1>
  <hr>

  <?php
  $reservation_id = $_POST['evt_reservation_id'];
  $pending_reservation_detail = "select * from event_reservation where evt_reservation_id = '$reservation_id'";
  $result = mysqli_query($conn,$pending_reservation_detail) or die(mysqli_error($conn));
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

  <div class="cards">
    <div class="caption">
      
      <p>
        <b>Reservation Start Time:</b>
        <?php echo $row["reservation_start_time"];?>
      </p>
      
      <p>
        <b>Reservation End Time:</b>
        <?php echo $row["reservation_end_time"]?>
      </p>
                
      <p>
        <b>Reservation Purpose:</b>
        <?php echo $row["reservation_purpose"]?>
      </p>
                
      <p>
        <b>Event Type:</b>
        <?php echo $row["event_type"]?>
      </p>
               
      <p>
        <b>Request:</b>
        <?php echo $row["request"]?>
      </p>

    </div>
  </div>
  
  <?php 
    }
  ?>
</section>


<section class="details">
  <h1 class="reserve">Venue</h1>
  <hr>
    
  <?php
  $reservation_id = $_POST['evt_reservation_id'];
  $venues = "select * from event_reservation as er join facility as f on er.facility_id = f.facility_id where er.evt_reservation_id = '$reservation_id'";
  $result = mysqli_query($conn,$venues) or die(mysqli_error($conn));
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

  <div class="cards">
    <div class="images">
      <?php
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['facility_image']).'"/>';
      ?>
    </div>

    <div class="caption">
      <p>
        <b><h2><?php echo $row["facility_name"];?></h2></b>
        <br>
      </p>
      
      <p>
        <b>Description</b>:<br>
        <?php echo $row["description"];?>
        <br>
      </p>

      <p>
        <b>Facility Type</b>:<br>
        <?php echo $row["facility_type"];?>
        <br>
      </p>

      <p>
        <b>Facility Capacity</b>:<br>
        <?php echo $row["facility_capacity"];?>
        <br>
      </p>

      <p>
        <b>Price</b>:<br>
        <?php echo $row["price"];?>
        <br>
      </p>
    </div>
  </div>

  <?php 
    }
  ?>
</section>


<section class="details">
  <h1 class="reserve">Equipment</h1>
  <hr>
  <?php
  $reservation_id = $_POST['evt_reservation_id'];
  $equipment = "select e.equipment_name, e.eqiupment_type, e.equipment_image, e.description, er.reservation_quantity, er.reservation_description from equipment as e join equipment_reservation as er on e.equipment_id = er.equipment_id join event_reservation as evr on evr.evt_reservation_id = er.evt_reservation_id where evr.evt_reservation_id = '$reservation_id'";
  $result = mysqli_query($conn,$equipment) or die(mysqli_error($conn));
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

  <div class="cards">

    <div class="images">
      <?php
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['equipment_image']).'"/>';
      ?>
    </div>

    <div class="caption">

      <p>
        <b><h2><?php echo $row["equipment_name"];?></h2></b>
        <br>
      </p>
        
      <p>
        <b>Eqiupment Type</b>:<br>
        <?php echo $row["eqiupment_type"];?>
        <br>
      </p>

      <p>
        <b>Eqiupment Description</b>:<br>
        <?php echo $row["description"];?>
        <br>
      </p>

      <p>
        <b>Reservation Quantity</b>:<br>
        <?php echo $row["reservation_quantity"];?>
        <br>
      </p>

      <p>
        <b>Reservation Description</b>:<br>
        <?php echo $row["reservation_description"];?>
        <br>
      </p>

    </div>
  </div>

  <?php 
    }
  ?>
</section>
    
<div id="back"><a href="history_reserve.php">Back</a></div>

</body>
</html>
