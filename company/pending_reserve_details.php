<?php  include('company_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
?>

<!DOCTYPE html>
<html>
  <title>Pending Reservations</title>
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
  $pending_reservation_detail = "select * from event_reservation where evt_reservation_id = '".$evt_reservation_id."'";
  $result = mysqli_query($conn,$pending_reservation_detail) or die(mysqli_error($conn));
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

  <div class="cards">
    <div class="caption">
      
      <p class="description">
        <b>Start Date:</b>
        <?php echo $row["start_date"];?>
      </p>
      
      <p class="duration_stay">
        <b>End Date:</b>
        <?php echo $row["end_date"]?>
      </p>
                
      <p class="duration">
        <b>Duration Stay:</b>
        <?php echo $row["duration"]?>
      </p>
                
      <p class="accomodation">
        <b>Accomdation:</b>
        <?php echo $row["accommodation"]?>
      </p>
               
      <p class="description">
        <b>Description:</b>
        <?php echo $row["description"]?>
      </p>

    </div>
  </div>
  
  <?php 
    }
  ?>
</section>


<section class="details">
  <h1 class="trip">Trip Itinerary</h1>
  <hr>
    
  <?php
  $sql = "select DISTINCT spot_name, s.image, i.description FROM trip t, travel_itinerary i, travel_spot s, theme m WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND t.tripID = '$tripID'";
  $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

  <div class="cards">
    <div class="images">
      <?php
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
      ?>
    </div>

    <div class="caption">
      <p class="description">
        <b><h2><?php echo $row["spot_name"];?></h2></b>
      </p>
      
      <p class="description">
        <b>Description</b>:<br>
        <?php echo $row["description"];?>
      </p><br>
    </div>
  </div>

  <?php 
    }
  ?>
</section>


<div class="details"><h1 class="related">Your Tripmates</h1><hr></div>
<section class="container">
  <?php
  $trip = "SELECT name, u.image FROM trip t, trip_joining j, users u WHERE t.tripID = j.tripID AND j.username = u.username AND t.tripID = '$tripID'";
  $result = mysqli_query($conn,$trip) or die(mysqli_error($conn));
  ?>

  <div class="box-container">
    <?php
    while ($row = mysqli_fetch_assoc($result))
    {
    ?>

    <div class="box">

      <div class="image">
        <?php 
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
        ?>
      </div>

      <div class="content">
        <h3>
          <?php 
          echo $row["name"];
          ?>
        </h3>
      </div>

    </div>
  </div>

    <?php
    }
    ?>
</section>
        
<section class="details">
  <h1 class="spotname">Trip Leader</h1>
  <hr>
  <?php
  $leader = "SELECT u.image,name, email, average_rate FROM trip t, users u WHERE t.username = u.username AND t.tripID = '".$tripID."'";
  $result1 = mysqli_query($conn,$leader) or die(mysqli_error($conn));
  while ($row = mysqli_fetch_assoc($result1)) {
  ?>

  <div class="cards">
    <div class="images">
      <?php 
      echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
      ?>
    </div>

    <div class="caption">
      <p class="name">
        <b>Name</b> :
        <?php echo $row["name"];?>
      </p>
      
      <p class="rating">
        <b>Email</b> :
        <?php echo $row["email"]?>
      </p>
                
      <p class="feedback">
        <b>Rating</b> :
        <?php echo $row["average_rate"]?> / 5.0
      </p>
    </div>
  </div>

  <?php 
    }
  ?>
</section>


<section class="details">
        
        <h1 class="trip">Transportation</h1>
    <hr>
    
        <?php
      $transport = "SELECT trans_type, r.description, carPlateNo FROM trip t, transportation_trip r, transportation a WHERE t.tripID = r.tripID AND r.transportationID = a.transportationID AND t.tripID = '".$tripID."'";

      $result = mysqli_query($conn,$transport) or die(mysqli_error($conn));

      while ($row = mysqli_fetch_assoc($result)) {
    
    ?>

    <div class="cards">

      <div class="caption">
                <p class="description">

                <b><h2><?php echo $row["trans_type"];?></h2></b>

                </p>
        <p class="description">

          <b>Description</b><br>
          <?php echo $row["description"];?>

        </p><br>
                <p class="duration_stay">
                    <b>Car Plate Number:</b><br>
                    <?php echo $row["carPlateNo"]?>
                </p>
      </div>
    </div>

  <?php 
    }

  ?>
  </section>

    <div>
    <a style="text-decoration: none;" id="back" href="editTrip.php?tripID=<?php echo $tripID?>"> Edit Details</a>
    </div>
    
    <div id="back"><a href="myTrip.php">Back</a></div>

</body>
</html>
