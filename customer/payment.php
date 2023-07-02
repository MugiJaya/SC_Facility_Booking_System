<?php  include('customer_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="payment_css.css">

</head>
<body>

<div class="container">

  <?php
  $booking_id = $_POST['booking_id'];
  $price = $_POST['price'];
  ?>

  <form action="customer_process.php" method="post">

    <div class="row">

      <div class="col">

        <h3 class="title">billing address</h3>

        <div class="inputBox">
          <span>Price :</span>
          <input type="text" value="RM <?php echo $price ?>" disabled>
        </div>
        <div class="inputBox">
          <span>email :</span>
          <input type="email" value="<?php echo $session_id ?>" disabled>
        </div>
        <div class="inputBox">
          <span>address :</span>
          <input type="text" placeholder="Address" required>
        </div>
        <div class="inputBox">
          <span>city :</span>
          <input type="text" placeholder="City" required>
        </div>

        <div class="flex">
          <div class="inputBox">
            <span>state :</span>
            <input type="text" placeholder="State" required>
          </div>
          <div class="inputBox">
            <span>Post code :</span>
            <input type="text" placeholder="Postcode" required>
          </div>
        </div>

      </div>

      <div class="col">

        <h3 class="title">payment</h3>

        <div class="inputBox">
          <span>cards accepted :</span>
          <img src="../images/index/card_img.png">
        </div>
        <div class="inputBox">
          <span>name on card :</span>
          <input type="text" placeholder="Name" required>
        </div>
        <div class="inputBox">
          <span>credit card number :</span>
          <input type="number" placeholder="1111-2222-3333-4444" required>
        </div>
        <div class="inputBox">
          <span>exp month :</span>
          <input type="text" placeholder="00/00" required>
        </div>

        <div class="flex">
          <div class="inputBox">
            <span>exp year :</span>
            <input type="number" placeholder="2022" required>
          </div>
          <div class="inputBox">
            <span>CVV :</span>
            <input type="text" placeholder="123" required>
          </div>
        </div>

      </div>

    </div>

    <input type="hidden" name="booking_id" value="<?php echo $booking_id?>">
    <input type="hidden" name="price" value="<?php echo $price?>">
    <input type="submit" value="Checkout" name="payment" class="submit-btn">

  </form>

</div>    

</body>
</html>