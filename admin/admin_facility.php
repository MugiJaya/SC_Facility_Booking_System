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
  <title>Admin / Facility</title>
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
  </div>
  <!-- ------------------ Facility ------------------ -->
  <button style="color: ivory; background-color: cornflowerblue;" class="dropdown-btn">Facility 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a class="active" href="admin_facility.php">Facility Information</a>
    <a href="admin_add_facility.php">Add Facility</a>
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


<div class="input-group">
<table id="table1">

  <form method="post" action="admin_process.php" enctype="multipart/form-data">
    <tr>
      <td>
        <label>Facility ID:</label><br>
        <input style="background-color: #e6e6e6;" class="input2" type="text" name="facility_id" value="<?php echo $facility_id; ?>" readonly>
      </td>
      <td>
        <label>Facility Name:</label><br>
        <input class="input2" type="text" name="facility_name" value="<?php echo $facility_name; ?>">
      </td>     
      <td>
        <label>Facility Type:</label><br>
        <input class="input2" type="text" name="facility_type" value="<?php echo $facility_type; ?>">
      </td> 
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
      <td>
        <label>Description:</label><br>
        <input class="input2" type="text" name="description" value="<?php echo $description; ?>">
      </td>  
      <td>
        <label>Price:</label><br>
        <input class="input2" type="text" name="price" value="<?php echo $price; ?>">
      </td>
      <td>
        <label>Facility Image:</label><br>
        <input class="input2" type="file" name="image" id="image" value="<?php echo $file; ?>">
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
$query = "select * from facility";
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
      <th>Facility Image</th>
      <th>Facility ID</th>
      <th>Facility Name</th>
      <th>Facility Type</th>
      <th>Facility Capacity</th>
      <th>For Events?</th>
      <th>Description</th>
      <th>Price</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th id='no'>#</th>
      <th id='no'>Facility Image</th>
      <th id='in'>Facility ID</th>
      <th id='in'>Facility Name</th>
      <th id='in'>Facility Type</th>
      <th id='in'>Facility Capacity</th>
      <th id='in'>For Events?</th>
      <th id='in'>Description</th>
      <th id='in'>Price</th>
    </tr>
  </tfoot>
  <tbody>
    <?php while($row = mysqli_fetch_array($search_result)):?>    
    <tr class="breakrow" onclick="location.href='admin_facility.php?edit=<?php echo $row['facility_id']; ?>'">
      <td>
        <a title="Edit" href="admin_facility.php?edit=<?php echo $row['facility_id']; ?>" class="edit_btn" >✏️</a>
        <a title="Delete" href="#" class="del_btn" onclick="confirmDelete(<?php echo $row['facility_id']; ?>)">❌</a>
      </td>
      <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['facility_image'] ).'" height="150" width="150" class="img-thumnail" />' ?></td>
      <td><?php echo $row['facility_id'];?></td>
      <td><?php echo $row['facility_name'];?></td>                  
      <td><?php echo $row['facility_type'];?></td>
      <td><?php echo $row['facility_capacity'];?></td>
      <td><?php echo $row['for_events'];?></td>
      <td><?php echo $row['description'];?></td>
      <td><?php echo $row['price'];?></td>
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
function confirmDelete(facilityId) {
  let text = "Do you want to delete facility with ID = " + facilityId + "?\nClick OK to confirm.";
  if (confirm(text)) {
    location.href = "admin_process.php?delete7=" + facilityId;
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
