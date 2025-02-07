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
    <h1 class="heading">Select Equipment</h1>
    <div class="box-container">
    <?php
        $facility_id = $_SESSION['facility_id'];
        $sql = "select e.* from equipment e where e.equipment_id not in (select equipment_id FROM equipment_reservation where evt_reservation_id = (select evt_reservation_id from event_reservation where company_id = (select company_id from company where email = '$session_id') order by evt_reservation_id desc limit 1)) and e.facility_id = '$facility_id'";
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
            <div class="icons"></div>

            <form action="equipment_information.php" method="post">
                <input type="hidden" name="equipment_id" value="<?php echo $row["equipment_id"]; ?>">
                <button class="btn" type="submit">Read More</button>
            </form>
            <br>
            <form action="equipment_description.php" method="post">
                <input type="hidden" name="equipment_id" value="<?php echo $row["equipment_id"]; ?>">
                <button class="btn" type="submit">Choose</button>
            </form>
        </div>

    </div>

    <?php
        }
    ?>
    </div>

    <div id="load-more">Load More</div><br>
    <button id="home" onclick="window.location.href='manage_equipment.php';">Manage Equipment</button>
        
    <form action="" method="post">                      
        <button id="home" type="submit" name="finish">Finish Reservation</button>
    </form>
        
    <?php
        if(isset($_POST['finish']))
        {
            echo "<script>alert('The reservation has been placed!\\nPlease wait for the admin\'s approval!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=pending_reserve.php'/>";
        }
    ?>
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
