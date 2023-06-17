<?php  include('admin_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
//fetch the record to update 
if (isset($_GET['edit'])) {
    $evt_reservation_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "select ersv.*, com.*, fac.*, pay.* from event_reservation ersv inner join company com on ersv.company_id = com.company_id inner join facility fac on ersv.facility_id = fac.facility_id left join payment pay on ersv.payment_id = pay.payment_id where evt_reservation_id = $evt_reservation_id");
    if (count($record) == 1 ) 
    {
      $n = mysqli_fetch_array($record);

      $reservation_time = $n['reservation_time'];
      $reservation_start_time = $n['reservation_start_time'];
      $reservation_end_time = $n['reservation_end_time'];
      $reservation_purpose = $n['reservation_purpose'];
      $event_type = $n['event_type'];
      $request = $n['request'];
      $approval_status = $n['approval_status'];
      $rating = $n['rating'];
      $feedback = $n['feedback'];
      $company_id = $n['company_id'];
      $company_name = $n['company_name'];
      $client_name = $n['client_name'];
      $facility_id = $n['facility_id'];
      $facility_name = $n['facility_name'];
      $payment_id = $n['payment_id'];
      $payment_amount = $n['payment_amount'];
      $payment_date = $n['payment_date'];
      $payment_time = $n['payment_time'];
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin / Event</title>
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
      height: 40%;    
      top: 0;
      margin-left: 150px;
      background-color: lavender;
      overflow-y: auto;
    }
  
    .bottom {
      position: fixed;
      left: 0;
      right: 0;
      height: 60%;
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
  <button class="dropdown-btn">Company 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_company.php">Company Information</a>
    <a href="admin_company_approval.php">Account Approval</a>
  </div>
  <!-- ------------------ Booking ------------------ -->
  <button style="color: ivory; background-color: cornflowerblue;" class="dropdown-btn">Booking 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_booking.php">Booking Information</a>
    <a href="admin_booking_approval.php">Booking Approval</a>
    <a class="active" href="admin_event.php">Event Reservation Information</a>
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
        <label>Event Reservation ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="evt_reservation_id" value="<?php echo $evt_reservation_id; ?>" readonly>
      </td>
      <td>
        <label>Reservation Time:</label><br>
        <input class="input2" type="text" name="reservation_time" value="<?php echo $reservation_time; ?>">
      </td>
      <td>
        <label>Reservation Start Time:</label><br>
        <input class="input2" type="datetime-local" name="reservation_start_time" value="<?php echo $reservation_start_time; ?>">
      </td> 
      <td>
        <label>Reservation End Time:</label><br>
        <input class="input2" type="datetime-local" name="reservation_end_time" value="<?php echo $reservation_end_time; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Reservation Purpose:</label><br>
        <input class="input2" type="text" name="reservation_purpose" value="<?php echo $reservation_purpose; ?>">
      </td>
      <td>
        <label>Event Type:</label><br>
        <input class="input2" type="text" name="event_type" value="<?php echo $event_type; ?>">
      </td> 
      <td>
        <label>Request:</label><br>
        <input class="input2" type="text" name="request" value="<?php echo $request; ?>">
      </td> 
      <td>
        <label>Approval Status:</label><br>
        <select class="input2" name="approval_status"> 
          <option value="<?php echo $approval_status;?>" hidden><?php echo $approval_status; ?></option>
          <option value="">--- No Value ---</option>
          <option value="Approved">Approved</option>
          <option value="Declined">Declined</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Rating:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="rating" value="<?php echo $rating; ?>" readonly>
      </td>  
      <td>
        <label>Feedback:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="feedback" value="<?php echo $feedback; ?>" readonly>
      </td>
      <td>
        <label>Company ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="company_id" value="<?php echo $company_id; ?>" readonly>
      </td>
      <td>
        <label>Company Name:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="company_name" value="<?php echo $company_name; ?>" readonly>
      </td>
    </tr>
    <tr>
      <td>
        <label>Client Name:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="client_name" value="<?php echo $client_name; ?>" readonly>
      </td>
      <td>
        <label>Facility ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="facility_id" value="<?php echo $facility_id; ?>" readonly>
      </td>
      <td>
        <label>Facility Name:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="facility_name" value="<?php echo $facility_name; ?>" readonly>
      </td>
    </tr>
    <tr>
      <td>
        <label>Payment ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="payment_id" value="<?php echo $payment_id; ?>" readonly>
      </td> 
      <td>
        <label>Payment Amount:</label><br>
        <input class="input2" type="text" name="payment_amount" value="<?php echo $payment_amount; ?>">
      </td>  
      <td>
        <label>Payment Date:</label><br>
        <input class="input2" type="date" name="payment_date" value="<?php echo $payment_date; ?>">
      </td>
      <td>
        <label>Payment Time:</label><br>
        <input class="input2" type="text" name="payment_time" value="<?php echo $payment_time; ?>">
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <?php if ($update == true): ?>
        <button class="btn" type="submit" name="update7" >Update</button>
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
$query = "select ersv.*, com.*, fac.*, pay.* from event_reservation ersv inner join company com on ersv.company_id = com.company_id inner join facility fac on ersv.facility_id = fac.facility_id left join payment pay on ersv.payment_id = pay.payment_id where ersv.approval_status = 'Approved'";
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
      <th>Event Reservation ID</th>
      <th>Reservation Time</th>
      <th>Reservation Start Time</th>
      <th>Reservation End Time</th>
      <th>Reservation Purpose</th>
      <th>Event Type</th>
      <th>Request</th>
      <th>Approval Status</th>
      <th>Rating</th>
      <th>Feedback</th>
      <th>Company ID</th>
      <th>Company Name</th>
      <th>Client Name</th>
      <th>Facility ID</th>
      <th>Facility Name</th>
      <th>Payment ID</th>
      <th>Payment Amount</th>
      <th>Payment Date</th>
      <th>Payment Time</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th id='no'>#</th>
      <th id='in'>Event Reservation ID</th>
      <th id='in'>Reservation Time</th>
      <th id='in'>Reservation Start Time</th>
      <th id='in'>Reservation End Time</th>
      <th id='in'>Reservation Purpose</th>
      <th id='in'>Event Type</th>
      <th id='in'>Request</th>
      <th id='in'>Approval Status</th>
      <th id='in'>Rating</th>
      <th id='in'>Feedback</th>
      <th id='in'>Company ID</th>
      <th id='in'>Company Name</th>
      <th id='in'>Client Name</th>
      <th id='in'>Facility ID</th>
      <th id='in'>Facility Name</th>
      <th id='in'>Payment ID</th>
      <th id='in'>Payment Amount</th>
      <th id='in'>Payment Date</th>
      <th id='in'>Payment Time</th>
    </tr>
  </tfoot>
  <tbody>
    <?php while($row = mysqli_fetch_array($search_result)):?>    
    <tr class="breakrow" onclick="location.href='admin_event.php?edit=<?php echo $row['evt_reservation_id']; ?>'">
      <td>
        <a title="Edit" href="admin_event.php?edit=<?php echo $row['evt_reservation_id']; ?>" class="edit_btn" >✏️</a>
      </td>
      <td><?php echo $row['evt_reservation_id'];?></td>
      <td><?php echo $row['reservation_time'];?></td>
      <td><?php echo $row['reservation_start_time'];?></td>
      <td><?php echo $row['reservation_end_time'];?></td>
      <td><?php echo $row['reservation_purpose'];?></td>
      <td><?php echo $row['event_type'];?></td>
      <td><?php echo $row['request'];?></td>
      <td><?php echo $row['approval_status'];?></td>
      <td><?php echo $row['rating'];?></td>
      <td><?php echo $row['feedback'];?></td>
      <td><?php echo $row['company_id'];?></td>
      <td><?php echo $row['company_name'];?></td>
      <td><?php echo $row['client_name'];?></td>
      <td><?php echo $row['facility_id'];?></td>
      <td><?php echo $row['facility_name'];?></td>
      <td><?php echo $row['payment_id'];?></td>
      <td><?php echo $row['payment_amount'];?></td>
      <td><?php echo $row['payment_date'];?></td>
      <td><?php echo $row['payment_time'];?></td>
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
