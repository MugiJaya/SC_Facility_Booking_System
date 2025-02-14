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

<div>
  <section class="container" id="c1">

  <h1 class="related">Upcoming Events</h1>
  <hr>
  <?php
  $upcoming_events = "select * from booking as b join customer as c on b.customer_id = c.customer_id join facility as f on b.facility_id = f.facility_id where c.email = '$session_id' and b.approval_status = 'Approved' and b.reservation_start_time > NOW() and b.payment_id is not NULL;";
  $result = mysqli_query($conn,$upcoming_events) or die(mysqli_error($conn));
  if(mysqli_num_rows($result) > 0){
  ?>

  <div class="box-container" id="box-container">
  <?php
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

    <div class="box" id="box">
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
        <p>
        <?php 
          echo $row["reservation_purpose"]; 
        ?>
        </p>

        <form action="upcoming_reserve_details.php" method="post">
          <input type="hidden" name="booking_id" value="<?php echo $row["booking_id"]; ?>">           
          <button class="btn" type="submit">View Details</button>
        </form>

        <div class="icons">
          <span><i class="fa fa-calendar"></i><?php echo $row["reservation_start_time"]?></span>
          <span><i class="fa fa-tag"></i><?php echo $row["price"]?></span>
          <span><i class="fa fa-user"></i><?php echo $row["facility_capacity"];?> </span>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

  </div>
  <div class="btn-load" id="load-more"> Load More </div><br>
  </div>

  <script>
    let loadMoreBtn = document.querySelector('#load-more');
    let currentItem = 3;

    loadMoreBtn.onclick = () =>{
      let boxes = [...document.querySelectorAll('#c1 #box-container #box')];
      for (var i = currentItem; i < currentItem + 3; i++)
      {
        boxes[i].style.display = 'inline-block';
      }
      currentItem += 3;

      if(currentItem >= boxes.length)
      {
        loadMoreBtn.style.display = 'none';
      }
    }
  </script>

  <?php  
    }
    else
    {
  ?>
  
  <h2 style="text-align: center;">--No Record Found--</h2>

  <?php
    }
  ?>

  </section>

  <section class="container" id="c0">

  <h1 class="related">Past Events</h1>
  <hr>
  <?php
  $past_events = "select * from booking as b join customer as c on b.customer_id = c.customer_id join facility as f on b.facility_id = f.facility_id where c.email = '$session_id' and b.approval_status = 'Approved' and b.reservation_start_time < NOW() and b.payment_id is not NULL;";
  $result = mysqli_query($conn,$past_events) or die(mysqli_error($conn));
        
  if(mysqli_num_rows($result) >0)
  {
  ?>

  <div class="box-container" id="box-container">
  <?php
  while ($row = mysqli_fetch_assoc($result)) {
  ?>

    <div class="box" id="box">
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
        <p>
        <?php 
          echo $row["reservation_purpose"]; 
        ?>
        </p>

        <?php
        if ($row["rating"] === null) {
        ?>
        <form action="rating.php" method="post">
          <input type="hidden" name="booking_id" value="<?php echo $row["booking_id"]; ?>">           
          <button class="btn" type="submit">Rate</button>
        </form>
        <br>
        <?php
        }
        ?>

        <form action="past_reserve_details.php" method="post">
          <input type="hidden" name="booking_id" value="<?php echo $row["booking_id"]; ?>">           
          <button class="btn" type="submit">View Details</button>
        </form>

        <div class="icons">
          <span><i class="fa fa-calendar"></i><?php echo $row["reservation_start_time"]?></span>
          <span><i class="fa fa-star"></i><?php echo $row["rating"]?></span>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

  </div>
  <div class="btn-load" id="load-more"> Load More </div><br>
  </div>

  <script>
    let loadMoreBtn = document.querySelector('#load-more');
    let currentItem = 3;

    loadMoreBtn.onclick = () =>{
      let boxes = [...document.querySelectorAll('#c1 #box-container #box')];
      for (var i = currentItem; i < currentItem + 3; i++)
      {
        boxes[i].style.display = 'inline-block';
      }
      currentItem += 3;

      if(currentItem >= boxes.length)
      {
        loadMoreBtn.style.display = 'none';
      }
    }
  </script>

  <?php  
    }
    else
    {
  ?>
  
  <h2 style="text-align: center;">--No Record Found--</h2>

  <?php
    }
  ?>

  </section>
</div>

</body>
</html>
