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
  <title>Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="company_css_1.css">
  <link rel="stylesheet" href="profile_css.css">
<style>

</style>
</head>
<body>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="venues.php">Venues</a>
  <div class="dropdown">
    <button class="dropbtn">Reservation <i class="fa fa-caret-down"></i></button>
    <div class="dropdown-content">
      <a href="reserve_1.php">Reserve A Venue</a>
      <a href="#">Upcoming Reservations</a>
      <a href="#">Reservation History</a>
    </div>
  </div>
  <div class="topnav-right">
    <div class="dropdown">
      <button style="background-color: #00ace6; color: white;" class="dropbtn">My Profile <i class="fa fa-caret-down"></i></button>
      <div class="dropdown-content">
        <a href="profile.php">Profile</a>
        <a href="../logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<div>
  
  <div class="update-profile">

    <?php
    $update ="select * from company WHERE email = '$session_id'";
    $select = mysqli_query($conn, $update) or die(mysqli_error($conn));
      
    if(mysqli_num_rows($select) > 0){
      $fetch = mysqli_fetch_assoc($select);
    }
    ?>

    <form method="post" action="company_process.php" enctype="multipart/form-data">

      <?php
      if($fetch['profile_picture'] == ''){
        echo '<img src="../images/profile_pictures/profile_picture_test.jpg">';
      }
      else{
        echo '<img src="data:image/jpeg;base64,'.base64_encode($fetch['profile_picture']).'" />';
      }
      if(isset($message) || isset($_SESSION['message'])) {
        $message = isset($message) ? $message : $_SESSION['message'];
        unset($_SESSION['message']);
        foreach($message as $msg) {
          echo '<div class="message">'.$msg.'</div>';
        }
      }
      ?>

      <div class="flex">
         <div class="inputBox">
            <span>Client Name :</span>
            <input type="text" name="client_name" value="<?php echo $fetch['client_name']; ?>" class="box">
            <span>Email :</span>
            <input type="email" name="email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Date of Birth :</span>
            <input type="date" name="dob" value="<?php echo $fetch['dob']; ?>" class="box">
            <span>Contact Number :</span>
            <input type="text" name="contact_no" value="<?php echo $fetch['contact_no']; ?>" class="box">
            <span>Update Your Pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            <span>Address :</span>
            <textarea rows="5" cols="30" class="box" name="address"><?php echo $fetch['address']?></textarea>
          </div>
          <div class="inputBox">
            <span>Company Name :</span>
            <input type="text" name="company_name" value="<?php echo $fetch['company_name']; ?>" class="box">
            <span>Company Email :</span>
            <input type="email" name="company_email" value="<?php echo $fetch['company_email']; ?>" class="box">
            <span>Company Contact Number :</span>
            <input type="text" name="company_contact_no" value="<?php echo $fetch['company_contact_no']; ?>" class="box">
            <span>Position :</span>
            <input type="text" name="position" value="<?php echo $fetch['position']; ?>" class="box">
            <span>Company Address :</span>
            <textarea rows="5" cols="30" class="box" name="company_address"><?php echo $fetch['company_address']?></textarea>
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>Old Password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>New Password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>Confirm Password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
    </form>
  </div>

</div>

</body>
</html>
