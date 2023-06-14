<?php  include('admin_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
//fetch the record to update 
if (isset($_GET['edit'])) {
    $facility_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "select * from facility where facility_id = $facility_id");
    if (count($record) == 1 ) 
    {
      $n = mysqli_fetch_array($record);

      $facility_name = $n['facility_name'];
      $facility_type = $n['facility_type'];
      $facility_capacity = $n['facility_capacity'];
      $for_events = $n['for_events'];
      $description = $n['description'];
      $price = $n['price'];
      $file = $n['file'];
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin / Add Facility</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="admin_css_2.css">

  <style type="text/css">

    .main {
      margin-left: 200px; 
      height: 97vh;  
      overflow-x: auto;
    }

    .top {
      position: fixed;
      left: 0;
      right: 0;
      height: 100%;    
      top: 0;
      margin-left: 150px;
      background-color: lavender;
      overflow-y: auto;
    }

  </style>

</head>


<body>

<div class="sidenav">
  <center>
  <font color="white">Bukit Jalil Sports Complex</font>
  <br><br>
  <b class="welcome">Welcome : <i><?php echo $session_id; ?></i></b>
  </center>
  <br><br>
  <!-- ------------------ Customer ------------------ -->
  <button class="dropdown-btn">Customer 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_customer.php">Customer Information</a>
    <a href="admin_customer_approval.php">Account Approval</a>
  </div>
  <!-- ------------------ Company ------------------ -->
  <button class="dropdown-btn">Company 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_company.php">Company Information</a>
    <a href="admin_company_approval.php">Account Approval</a>
  </div>
  <!-- ------------------ Booking ------------------ -->
  <button class="dropdown-btn">Booking 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_booking.php">Booking Information</a>
    <a href="admin_booking_approval.php">Booking Approval</a>
  </div>
  <!-- ------------------ Facility ------------------ -->
  <button style="color: ivory; background-color: cornflowerblue;" class="dropdown-btn">Facility 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_facility.php">Facility Information</a>
    <a class="active" href="admin_add_facility.php">Add Facility</a>
  </div>
  <!-- ------------------ Equipment ------------------ -->
  <button class="dropdown-btn">Equipment 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_equipment.php">Equipment Information</a>
    <a href="admin_add_equipment.php">Add Equipment</a>
  </div>
  <!-- ------------------ Report ------------------ -->
  <button class="dropdown-btn">Report 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_report.php">Report</a>
  </div>
  <!-- ------------------ Logout ------------------ -->
  <br><br>
  <a href="../logout.php">Logout</a>
</div>


<div class="top">

<?php if (isset($_SESSION['msg'])): ?>
  <div class="msg">
    <?php 
      echo $_SESSION['msg']; 
      unset($_SESSION['msg']);
    ?>
  </div>
<?php endif ?>

<h2 style="margin-left: 40px;">Add A New Facility</h2>


<div class="input-group">
<table id="table1">

  <form method="post" action="admin_process.php" enctype="multipart/form-data">
    <tr>
      <td>
        <!-- Facility ID -->
        <input type="hidden" name="facility_id" value="<?php echo $facility_id; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Facility Name:</label><br>
        <input class="input2" type="text" name="facility_name" value="<?php echo $facility_name; ?>">
      </td>
    </tr>
    <tr>     
      <td>
        <label>Facility Type:</label><br>
        <input class="input2" type="text" name="facility_type" value="<?php echo $facility_type; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Facility Capacity:</label><br>
        <input class="input2" type="text" name="facility_capacity" value="<?php echo $facility_capacity; ?>">
      </td> 
    </tr>
    <tr>
      <td>
        <label>For Events?:</label><br>
        <input class="input2" type="text" name="for_events" value="<?php echo $for_events; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Description:</label><br>
        <textarea class="input2" name="description" rows="5"><?php echo $description; ?></textarea>
      </td>
    </tr>
    <tr>  
      <td>
        <label>Price:</label><br>
        <input class="input2" type="text" name="price" value="<?php echo $price; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Facility Image:</label><br>
        <input class="input2" type="file" name="image" id="image" value="<?php echo $file; ?>">
      </td>
    </tr>  
    <tr>
      <td colspan="3">
        <button class="btn" type="submit" name="save7" id="save7" >Save</button>
      </td> 
    </tr>
  </form>

</table>
</div>


<script type="text/javascript">


/* ____SIDENAV____ */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}


/* ____IMAGE____ */
 $(document).ready(function(){  
      $('#save3').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });


</script>

</div>


</body>
</html> 
