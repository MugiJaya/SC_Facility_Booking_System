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
  <link rel="stylesheet" href="venues_css.css">
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
    <h1 class="heading">Select a Venue</h1>
    <div class="box-container">
    <?php
        $sql = "select * from facility where for_events = 'Yes'";
        $venues = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        while ($row = mysqli_fetch_assoc($venues)) {
    ?>

    <div class="box">
        <div class="image">
            <?php 
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['facility_image']).'"/>';
            ?>
        </div>

        <div class="content">
            <h3>
            <?php 
                echo $row["facility_name"];      
            ?>  
            </h3>
            <div class="icons"></div>

            <form action="venue_information_2.php" method="post">
                <input type="hidden" name="facility_id" value="<?php echo $row["facility_id"]; ?>">
                <button class="btn" type="submit">Read More</button>
            </form>
            <br>
            <form action="company_process.php" method="post">
                <input type="hidden" name="facility_id" value="<?php echo $row["facility_id"]; ?>">

                <?php
                $reservation_start_time = $_SESSION['reservation_start_time'];
                $reservation_end_time = $_SESSION['reservation_end_time'];
                $reservation_purpose = $_SESSION['reservation_purpose'];
                $event_type = $_SESSION['event_type'];
                $request = $_SESSION['request'];
                ?>

                <input type="hidden" name="reservation_start_time" value="<?php echo $reservation_start_time; ?>">
                <input type="hidden" name="reservation_end_time" value="<?php echo $reservation_end_time; ?>">
                <input type="hidden" name="reservation_purpose" value="<?php echo $reservation_purpose; ?>">
                <input type="hidden" name="event_type" value="<?php echo $event_type; ?>">
                <input type="hidden" name="request" value="<?php echo $request; ?>">
                
                <button class="btn" type="submit" name="reservation_2">Choose</button>
            </form>
        </div>

    </div>

    <?php
        }
    ?>
    </div>
    <div id="load-more">Load More</div><br>
</div>


<script>

let loadMoreBtn = document.querySelector('#load-more');
let currentItem = 3;

loadMoreBtn.onclick = () =>{
    let boxes = [...document.querySelectorAll('.container .box-container .box')];
    for (var i = currentItem; i < currentItem + 3; i++){
        boxes[i].style.display = 'inline-block';
    }
    currentItem += 3;

    if(currentItem >= boxes.length){
        loadMoreBtn.style.display = 'none';
    }
}

</script>

</body>
</html>
