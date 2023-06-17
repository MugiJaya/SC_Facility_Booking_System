<?php  include('admin_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
}
//fetch the record to update 
if (isset($_GET['edit'])) {
    $equipment_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "select eqp.*, fac.facility_name from equipment eqp inner join facility fac on eqp.facility_id = fac.facility_id where eqp.equipment_id = $equipment_id");
    if (count($record) == 1 ) 
    {
      $n = mysqli_fetch_array($record);

      $equipment_name = $n['equipment_name'];
      $eqiupment_type = $n['eqiupment_type'];
      $quantity = $n['quantity'];
      $description = $n['description'];
      $file = $n['file'];
      $facility_id = $n['facility_id'];
      $facility_name = $n['facility_name'];
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin / Equipment</title>
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
      height: 25%;    
      top: 0;
      margin-left: 150px;
      background-color: lavender;
      overflow-y: auto;
    }
  
    .bottom {
      position: fixed;
      left: 0;
      right: 0;
      height: 75%;
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
    <a class="active" href="admin_equipment.php">Equipment Information</a>
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
        <label>Equipment ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="equipment_id" value="<?php echo $equipment_id; ?>" readonly>
      </td>
      <td>
        <label>Equipment Name:</label><br>
        <input class="input2" type="text" name="equipment_name" value="<?php echo $equipment_name; ?>">
      </td>     
      <td>
        <label>Equipment Type:</label><br>
        <input class="input2" type="text" name="eqiupment_type" value="<?php echo $eqiupment_type; ?>">
      </td>
      <td>
        <label>Quantity:</label><br>
        <input class="input2" type="text" name="quantity" value="<?php echo $quantity; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Description:</label><br>
        <input class="input2" type="text" name="description" value="<?php echo $description; ?>">
      </td>
      <td>
        <label>Equipment Image:</label><br>
        <input class="input2" type="file" name="image" id="image" value="<?php echo $file; ?>">
      </td>
      <td>
        <label>Facility:</label><br>
        <select class="input2" name="facility_id">
        <option value="<?php echo $facility_name;?>" hidden><?php echo $facility_name; ?></option>
        <option value="">--- Select ---</option>
        <?php 
        $sql = mysqli_query($conn, "select * from facility");
        while ($facility_id = $sql->fetch_assoc())
        {
        ?>
          <option value="<?php echo $facility_id['facility_id'];?>"><?php echo $facility_id['facility_name'];?></option>
        <?php
        }
        ?>
        </select>
      </td>
    </tr> 
    <tr>
      <td colspan="4">
        <?php if ($update == true): ?>
        <button class="btn" type="submit" name="update10" >Update</button>
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
$query = "select eqp.*, fac.facility_name from equipment eqp inner join facility fac on eqp.facility_id = fac.facility_id";
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
      <th>Equipment Image</th>
      <th>Equipment ID</th>
      <th>Equipment Name</th>
      <th>Equipment Type</th>
      <th>Quantity</th>
      <th>Description</th>
      <th>Facility ID</th>
      <th>Facility Name</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th id='no'>#</th>
      <th id='no'>Equipment Image</th>
      <th id='in'>Equipment ID</th>
      <th id='in'>Equipment Name</th>
      <th id='in'>Equipment Type</th>
      <th id='in'>Quantity</th>
      <th id='in'>Description</th>
      <th id='in'>Facility ID</th>
      <th id='in'>Facility Name</th>
    </tr>
  </tfoot>
  <tbody>
    <?php while($row = mysqli_fetch_array($search_result)):?>    
    <tr class="breakrow" onclick="location.href='admin_equipment.php?edit=<?php echo $row['equipment_id']; ?>'">
      <td>
        <a title="Edit" href="admin_equipment.php?edit=<?php echo $row['equipment_id']; ?>" class="edit_btn" >✏️</a>
        <a title="Delete" href="#" class="del_btn" onclick="confirmDelete(<?php echo $row['equipment_id']; ?>)">❌</a>
      </td>
      <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['equipment_image'] ).'" height="150" width="150" class="img-thumnail" />' ?></td>
      <td><?php echo $row['equipment_id'];?></td>
      <td><?php echo $row['equipment_name'];?></td>                  
      <td><?php echo $row['eqiupment_type'];?></td>
      <td><?php echo $row['quantity'];?></td>
      <td><?php echo $row['description'];?></td>
      <td><?php echo $row['facility_id'];?></td>
      <td><?php echo $row['facility_name'];?></td>
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


/* ____DELETE BUTTON____ */
function confirmDelete(equipmentId) {
  let text = "Do you want to delete equipment with ID = " + equipmentId + "?\nClick OK to confirm.";
  if (confirm(text)) {
    location.href = "admin_process.php?delete10=" + equipmentId;
  }
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
