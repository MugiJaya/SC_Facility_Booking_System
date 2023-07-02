<?php  include('admin_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
//fetch the record to update 
if (isset($_GET['edit'])) {
    $company_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "select * from company where company_id = $company_id");
    if (count($record) == 1 ) 
    {
      $n = mysqli_fetch_array($record);

      $client_name = $n['client_name'];
      $dob = $n['dob'];
      $gender = $n['gender'];
      $address = $n['address'];
      $contact_no = $n['contact_no'];
      $email = $n['email'];
      $password = $n['password'];
      $company_name = $n['company_name'];
      $company_address = $n['company_address'];
      $company_contact_no = $n['company_contact_no'];
      $company_email = $n['company_email'];
      $position = $n['position'];
      $verification_status = $n['verification_status'];
      $admin_id = $n['admin_id'];
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin / Company</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="admin_css_1.css">

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
      height: 35%;    
      top: 0;
      margin-left: 150px;
      background-color: lavender;
      overflow-y: auto;
    }
  
    .bottom {
      position: fixed;
      left: 0;
      right: 0;
      height: 65%;
      bottom: 0;
      margin-left: 150px;
      background-color: lavender;
      overflow-x: auto;
      border: solid #2E2525;
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
  <button style="color: ivory; background-color: cornflowerblue;" class="dropdown-btn">Company 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a class="active" href="admin_company.php">Company Information</a>
    <a href="admin_company_approval.php">Account Approval</a>
  </div>
  <!-- ------------------ Booking ------------------ -->
  <button class="dropdown-btn">Booking 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_booking.php">Booking Information</a>
    <a href="admin_booking_approval.php">Booking Approval</a>
    <a href="admin_event.php">Event Reservation Information</a>
    <a href="admin_event_approval.php">Event Reservation Approval</a>
  </div>
  <!-- ------------------ Facility ------------------ -->
  <button class="dropdown-btn">Facility 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_facility.php">Facility Information</a>
    <a href="admin_add_facility.php">Add Facility</a>
  </div>
  <!-- ------------------ Equipment ------------------ -->
  <button class="dropdown-btn">Equipment 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_equipment.php">Equipment Information</a>
    <a href="admin_equipment_reservation.php">Reservation Information</a>
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


<div class="input-group">
<table id="table1">

  <form method="post" action="admin_process.php" enctype="multipart/form-data">
    <tr>
      <td>
        <label>Company ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="company_id" value="<?php echo $company_id; ?>" readonly>
      </td>
      <td>
        <label>Client Name:</label><br>
        <input class="input2" type="text" name="client_name" value="<?php echo $client_name; ?>">
      </td>     
      <td>
        <label>Date of Birth:</label><br>
        <input class="input2" type="date" name="dob" value="<?php echo $dob; ?>">
      </td> 
      <td>
        <label>Gender:</label><br>
        <select class="input2" name="gender"> 
          <option value="<?php echo $gender;?>" hidden><?php echo $gender; ?></option>
          <option value="">--- No Value ---</option>
          <option value="M">M</option>
          <option value="F">F</option>
        </select>
      </td> 
    </tr>
    <tr>
      <td>
        <label>Address:</label><br>
        <input class="input2" type="text" name="address" value="<?php echo $address; ?>">
      </td> 
      <td>
        <label>Contact No.:</label><br>
        <input class="input2" type="text" name="contact_no" value="<?php echo $contact_no; ?>">
      </td>  
      <td>
        <label>Email:</label><br>
        <input class="input2" type="text" name="email" value="<?php echo $email; ?>">
      </td>
      <td>
        <label>Password:</label><br>
        <input class="input2" type="text" name="password" value="<?php echo $password; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Company Name:</label><br>
        <input class="input2" type="text" name="company_name" value="<?php echo $company_name; ?>">
      </td>
      <td>
        <label>Company Address:</label><br>
        <input class="input2" type="text" name="company_address" value="<?php echo $company_address; ?>">
      </td>
      <td>
        <label>Company Contact No.:</label><br>
        <input class="input2" type="text" name="company_contact_no" value="<?php echo $company_contact_no; ?>">
      </td>
      <td>
        <label>Company Email:</label><br>
        <input class="input2" type="text" name="company_email" value="<?php echo $company_email; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Position:</label><br>
        <input class="input2" type="text" name="position" value="<?php echo $position; ?>">
      </td>
      <td>
        <label>Verification Status:</label><br>
        <select class="input2" name="verification_status"> 
          <option value="<?php echo $verification_status;?>" hidden><?php echo $verification_status; ?></option>
          <option value="">--- No Value ---</option>
          <option value="Approved">Approved</option>
          <option value="Pending">Pending</option>
          <option value="Declined">Declined</option>
        </select>
      </td>
      <td>
        <label>Admin ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="admin_id" value="<?php echo $admin_id; ?>" readonly>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <?php if ($update == true): ?>
        <button class="btn" type="submit" name="update3" >Update</button>
        <?php else: ?>
        <p></p>
        <?php endif ?>
      </td>  
    </tr>
  </form>

</table>
</div>
<br>


<?php
$query = "select * from company where verification_status = 'Approved'";
$search_result = filterTable($query);

// function to connect and execute the query
function filterTable($query)
{
    $conn = mysqli_connect("localhost", "root", "", "sports_complex");
    $filter_Result = mysqli_query($conn, $query);
    return $filter_Result;
}
?>


<br>
</div>
<div class="bottom">


<table name="item" id="table2" class="display" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>#</th>
      <th>Profile Picture</th>
      <th>Customer ID</th>
      <th>Customer Name</th>
      <th>DOB</th>
      <th>Gender</th>
      <th>Address</th>
      <th>Contact No.</th>
      <th>Email</th>
      <th>Password</th>
      <th>Company Name</th>
      <th>Company Address</th>
      <th>Company Contact No.</th>
      <th>Company Email</th>
      <th>Position</th>
      <th>Verification Status</th>
      <th>Admin ID</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th id='no'>#</th>
      <th id='no'>Profile Picture</th>
      <th id='in'>Customer ID</th>
      <th id='in'>Customer Name</th>
      <th id='in'>DOB</th>
      <th id='in'>Gender</th>
      <th id='in'>Address</th>
      <th id='in'>Contact No.</th>
      <th id='in'>Email</th>
      <th id='in'>Password</th>
      <th id='in'>Company Name</th>
      <th id='in'>Company Address</th>
      <th id='in'>Company Contact No.</th>
      <th id='in'>Company Email</th>
      <th id='in'>Position</th>
      <th id='in'>Verification Status</th>
      <th id='in'>Admin ID</th>
    </tr>
  </tfoot>
  <tbody>
    <?php while($row = mysqli_fetch_array($search_result)):?>    
    <tr class="breakrow" onclick="location.href='admin_company.php?edit=<?php echo $row['company_id']; ?>'">
      <td>
        <a title="Edit" href="admin_company.php?edit=<?php echo $row['company_id']; ?>" class="edit_btn" >✏️</a>
      </td>
      <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['profile_picture'] ).'" height="150" width="150" class="img-thumnail" />' ?></td>
      <td><?php echo $row['company_id'];?></td>
      <td><?php echo $row['client_name'];?></td>                  
      <td><?php echo $row['dob'];?></td>
      <td><?php echo $row['gender'];?></td>
      <td><?php echo $row['address'];?></td>
      <td><?php echo $row['contact_no'];?></td>
      <td><?php echo $row['email'];?></td>
      <td><?php echo $row['password'];?></td>
      <td><?php echo $row['company_name'];?></td>
      <td><?php echo $row['company_address'];?></td>
      <td><?php echo $row['company_contact_no'];?></td>
      <td><?php echo $row['company_email'];?></td>
      <td><?php echo $row['position'];?></td>
      <td><?php echo $row['verification_status'];?></td>
      <td><?php echo $row['admin_id'];?></td>
    </tr>   
    <?php endwhile;?>
  </tbody>
</table>


<br>


<link rel = "stylesheet" type = "text/css" href = "https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
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


/* ____TABLE____ */
$(document).ready(function() {
    $('#table2').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="font-size:10px; height:15px; min-width:50px;"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option style="font-size:10px;" value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
        });
    var table =  $('#table2').DataTable();
    $('#table2 tfoot #in').each(function () {
        var title = $('#table2 thead th').eq($(this).index()).text();
        $(this).html('<input type="text">');
    });
    var table =  $('#table2').DataTable();
    $('#table2 tfoot #no').each(function () {
        var title = $('#table2 thead th').eq($(this).index()).text();
        $(this).html('<input type="text" style="visibility: hidden;">');
    });
    table.columns().eq(0).each(function (colIdx) {
        $('input', table.column(colIdx).footer()).on('keyup change', function () {
            table.column(colIdx)
                .search(this.value)
                .draw();
        });
    });
} );


</script>

</div>


</body>
</html> 
