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
  <link rel="stylesheet" href="venues_information_css.css">
<style>

</style>
</head>
<body>

<div class="topnav">
  <a href="home.php">Home</a>
  <a style="background-color: #00ace6; color: white;" href="venues.php">Venues</a>
  <div class="dropdown">
    <button class="dropbtn">Reservation <i class="fa fa-caret-down"></i></button>
    <div class="dropdown-content">
      <a href="#">Reserve A Venue</a>
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


<div class="container">
  <section class="details">
    <?php
      $facility_id = $_POST['facility_id'];
      $sql = "select * from facility where facility_id = '".$facility_id."'";

      $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

      while ($row = mysqli_fetch_assoc($result)) {
    ?>
    
    <h1 class="title"><?php echo $row["facility_name"]?></h1>

    <div class="cards">
      <div class="images">
        <?php 
          echo '<img src="data:image/jpeg;base64,'.base64_encode($row['facility_image']).'"/>';
        ?>
      </div>

      <div class="caption">
        <p>
          <b>Description</b>:<br>
          <?php echo $row["description"];?>
        </p>
        <p>
          <b>Facility Type</b>:<br>
          <?php echo $row["facility_type"];?>
        </p>
        <p>
          <b>Price</b>:<br>
          <?php echo $row["price"];?>
        </p>
        <p>
          <b>Capacity</b>:<br>
          <?php echo $row["facility_capacity"]?>
        </p>
      </div>
    </div>

    <?php 
      }
    ?>
  </section>

  <a href="venues.php" class="button">Back</a>

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
