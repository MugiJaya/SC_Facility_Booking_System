<?php  include('admin_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
//fetch the record to update 
if (isset($_GET['edit'])) {
    $eqp_reservation_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "select eqprsv.*, ersv.evt_reservation_id, ersv.reservation_time, ersv.reservation_start_time, ersv.reservation_end_time, ersv.reservation_purpose, ersv.event_type, ersv.request, com.company_id, com.company_name, com.client_name, fac.facility_image, fac.facility_id, fac.facility_name, eqp.equipment_image, eqp.equipment_id, eqp.equipment_name, eqp.eqiupment_type, eqp.quantity, eqp.description from equipment_reservation eqprsv inner join event_reservation ersv on eqprsv.evt_reservation_id = ersv.evt_reservation_id inner join company com on ersv.company_id = com.company_id inner join facility fac on ersv.facility_id = fac.facility_id inner join equipment eqp on eqprsv.equipment_id = eqp.equipment_id where eqp_reservation_id = $eqp_reservation_id");
    if (count($record) == 1 ) 
    {
      $n = mysqli_fetch_array($record);

      $reservation_quantity = $n['reservation_quantity'];
      $reservation_description = $n['reservation_description'];
      $evt_reservation_id = $n['evt_reservation_id'];
      $reservation_time = $n['reservation_time'];
      $reservation_start_time = $n['reservation_start_time'];
      $reservation_end_time = $n['reservation_end_time'];
      $reservation_purpose = $n['reservation_purpose'];
      $event_type = $n['event_type'];
      $request = $n['request'];
      $company_id = $n['company_id'];
      $company_name = $n['company_name'];
      $client_name = $n['client_name'];
      $facility_id = $n['facility_id'];
      $facility_name = $n['facility_name'];
      $equipment_id = $n['equipment_id'];
      $equipment_name = $n['equipment_name'];
      $eqiupment_type = $n['quantity'];
      $quantity = $n['quantity'];
      $description = $n['description'];
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin / Equipment Reservation</title>
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
  <button style="color: ivory; background-color: cornflowerblue;" class="dropdown-btn">Equipment 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_equipment.php">Equipment Information</a>
    <a class="active" href="admin_equipment_reservation.php">Reservation Information</a>
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
        <label>Equipment Reservation ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="eqp_reservation_id" value="<?php echo $eqp_reservation_id; ?>" readonly>
      </td>
      <td>
        <label>Reservation Quantity:</label><br>
        <input class="input2" type="text" name="reservation_quantity" value="<?php echo $reservation_quantity; ?>">
      </td>
      <td>
        <label>Reservation Description:</label><br>
        <input class="input2" type="text" name="reservation_description" value="<?php echo $reservation_description; ?>">
      </td>
      <td>
        <label>Event Reservation ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="evt_reservation_id" value="<?php echo $evt_reservation_id; ?>" readonly>
      </td>
    </tr>
    <tr>
      <td>
        <label>Reservation Time:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="reservation_time" value="<?php echo $reservation_time; ?>" readonly>
      </td>
      <td>
        <label>Reservation Start Time:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="datetime-local" name="reservation_start_time" value="<?php echo $reservation_start_time; ?>" readonly>
      </td> 
      <td>
        <label>Reservation End Time:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="datetime-local" name="reservation_end_time" value="<?php echo $reservation_end_time; ?>" readonly>
      </td>
      <td>
        <label>Reservation Purpose:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="reservation_purpose" value="<?php echo $reservation_purpose; ?>" readonly>
      </td> 
    </tr>
    <tr>
      <td>
        <label>Event Type:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="event_type" value="<?php echo $event_type; ?>" readonly>
      </td> 
      <td>
        <label>Request:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="request" value="<?php echo $request; ?>" readonly>
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
      <td>
        <label>Equipment ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="equipment_id" value="<?php echo $equipment_id; ?>" readonly>
      </td>
    </tr>
    <tr>
      <td>
        <label>Equipment Name:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="equipment_name" value="<?php echo $equipment_name; ?>" readonly>
      </td>     
      <td>
        <label>Equipment Type:</label><br>
        <input style="background-color: #e6e6e6;" style="background-color: #e6e6e6;" class="input2" type="text" name="eqiupment_type" value="<?php echo $eqiupment_type; ?>" readonly>
      </td>
      <td>
        <label>Quantity:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="quantity" value="<?php echo $quantity; ?>" readonly>
      </td>
      <td>
        <label>Description:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="description" value="<?php echo $description; ?>" readonly>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <?php if ($update == true): ?>
        <button class="btn" type="submit" name="update11" >Update</button>
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
$query = "select eqprsv.*, ersv.evt_reservation_id, ersv.reservation_time, ersv.reservation_start_time, ersv.reservation_end_time, ersv.reservation_purpose, ersv.event_type, ersv.request, com.company_id, com.company_name, com.client_name, fac.facility_image, fac.facility_id, fac.facility_name, eqp.equipment_image, eqp.equipment_id, eqp.equipment_name, eqp.eqiupment_type, eqp.quantity, eqp.description from equipment_reservation eqprsv inner join event_reservation ersv on eqprsv.evt_reservation_id = ersv.evt_reservation_id inner join company com on ersv.company_id = com.company_id inner join facility fac on ersv.facility_id = fac.facility_id inner join equipment eqp on eqprsv.equipment_id = eqp.equipment_id";
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
      <th>Equipment Reservation ID</th>
      <th>Reservation Quantity</th>
      <th>Reservation Description</th>
      <th>Event Reservation ID</th>
      <th>Reservation Time</th>
      <th>Reservation Start Time</th>
      <th>Reservation End Time</th>
      <th>Reservation Purpose</th>
      <th>Event Type</th>
      <th>Request</th>
      <th>Company ID</th>
      <th>Company Name</th>
      <th>Client Name</th>
      <th>Facility Image</th>
      <th>Facility ID</th>
      <th>Facility Name</th>
      <th>Equipment Image</th>
      <th>Equipment ID</th>
      <th>Equipment Name</th>
      <th>Equipment Type</th>
      <th>Quantity</th>
      <th>Description</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th id='no'>#</th>
      <th id='in'>Equipment Reservation ID</th>
      <th id='in'>Reservation Quantity</th>
      <th id='in'>Reservation Description</th>
      <th id='in'>Event Reservation ID</th>
      <th id='in'>Reservation Time</th>
      <th id='in'>Reservation Start Time</th>
      <th id='in'>Reservation End Time</th>
      <th id='in'>Reservation Purpose</th>
      <th id='in'>Event Type</th>
      <th id='in'>Request</th>
      <th id='in'>Company ID</th>
      <th id='in'>Company Name</th>
      <th id='in'>Client Name</th>
      <th id='in'>Facility Image</th>
      <th id='in'>Facility ID</th>
      <th id='in'>Facility Name</th>
      <th id='no'>Equipment Image</th>
      <th id='in'>Equipment ID</th>
      <th id='in'>Equipment Name</th>
      <th id='in'>Equipment Type</th>
      <th id='in'>Quantity</th>
      <th id='in'>Description</th>
    </tr>
  </tfoot>
  <tbody>
    <?php while($row = mysqli_fetch_array($search_result)):?>    
    <tr class="breakrow" onclick="location.href='admin_equipment_reservation.php?edit=<?php echo $row['eqp_reservation_id']; ?>'">
      <td>
        <a title="Edit" href="admin_equipment_reservation.php?edit=<?php echo $row['eqp_reservation_id']; ?>" class="edit_btn" >✏️</a>
      </td>
      <td><?php echo $row['eqp_reservation_id'];?></td>
      <td><?php echo $row['reservation_quantity'];?></td>
      <td><?php echo $row['reservation_description'];?></td>
      <td><?php echo $row['evt_reservation_id'];?></td>                
      <td><?php echo $row['reservation_time'];?></td>
      <td><?php echo $row['reservation_start_time'];?></td>
      <td><?php echo $row['reservation_end_time'];?></td>
      <td><?php echo $row['reservation_purpose'];?></td>
      <td><?php echo $row['event_type'];?></td>
      <td><?php echo $row['request'];?></td>
      <td><?php echo $row['company_id'];?></td>
      <td><?php echo $row['company_name'];?></td>
      <td><?php echo $row['client_name'];?></td>
      <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['facility_image'] ).'" height="150" width="150" class="img-thumnail" />' ?></td>
      <td><?php echo $row['facility_id'];?></td>
      <td><?php echo $row['facility_name'];?></td>
      <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['equipment_image'] ).'" height="150" width="150" class="img-thumnail" />' ?></td>
      <td><?php echo $row['equipment_id'];?></td>
      <td><?php echo $row['equipment_name'];?></td>                  
      <td><?php echo $row['eqiupment_type'];?></td>
      <td><?php echo $row['quantity'];?></td>
      <td><?php echo $row['description'];?></td>
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
