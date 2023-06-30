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
  <link rel="stylesheet" href="venue_information_css.css">
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
<form action="company_process.php" method="post">

  <section class="details">
    <?php
      $equipment_id = $_POST['equipment_id'];
      $sql = "select * from equipment where equipment_id = '".$equipment_id."'";

      $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

      while ($row = mysqli_fetch_assoc($result)) {
    ?>
    
    <h1 class="title"><?php echo $row["equipment_name"]?></h1>

    <div class="cards">
      <div class="images">
        <?php 
          echo '<img src="data:image/jpeg;base64,'.base64_encode($row['equipment_image']).'"/>';
        ?>
      </div>

      <div class="caption">
        <p>
          <b>Description</b>:<br>
          <textarea rows="3" cols="50" name="reservation_description" style="font-size: 15px;"></textarea>
        </p>
        <p>
          <b>Quantity</b>:<br>
          <select name="reservation_quantity">
            <?php
              $maxQuantity = $row["quantity"];
              for ($i = 1; $i <= $maxQuantity; $i++) {
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
        </p>
        <?php
        $sql = "select evt_reservation_id from event_reservation where company_id = (select company_id from company where email = '$session_id') order by evt_reservation_id desc limit 1;";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <input type="hidden" name="evt_reservation_id" value="<?php echo $row['evt_reservation_id']; ?>">
        <?php
        }
        ?>
        <input type="hidden" name="equipment_id" value="<?php echo $equipment_id; ?>">
      </div>
    </div>

    <?php 
      }
    ?>
  </section>

  <button class="button" type="submit" name="reservation_3">Next</button>
  <a href="reserve_3.php" class="button">Back</a>

</form>
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
