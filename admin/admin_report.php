<?php  include('admin_process.php');
//redirecting to login page
if(!isset($_SESSION['session_id']))
{
  header("location: ../login/login.php"); 
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
      height: 100%;    
      top: 0;
      margin-left: 150px;
      background-color: lavender;
      overflow-y: auto;
    }

    #venue_chart {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    }

    #customer_chart {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    }

    #company_chart {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
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
  <button class="dropdown-btn">Equipment 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_equipment.php">Equipment Information</a>
    <a href="admin_equipment_reservation.php">Reservation Information</a>
    <a href="admin_add_equipment.php">Add Equipment</a>
  </div>
  <!-- ------------------ Report ------------------ -->
  <button style="color: ivory; background-color: cornflowerblue;" class="dropdown-btn">Report 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a class="active" href="admin_report.php">Report</a>
  </div>
  <!-- ------------------ Logout ------------------ -->
  <br><br>
  <a href="../logout.php">Logout</a>
</div>


<div class="top">

<h1 style="text-align: center;">Venue Report:</h1>
<canvas id="venue_chart"></canvas>

<h1 style="text-align: center;">Customer Report:</h1>
<canvas id="customer_chart"></canvas>

<h1 style="text-align: center;">Company Report:</h1>
<canvas id="company_chart"></canvas>

<?php
/* ________________________________VENUE_CHART________________________________ */
$query = "SELECT DISTINCT f.facility_name, COUNT(er.facility_id) + COUNT(b.facility_id) AS combined_rank FROM facility f LEFT JOIN event_reservation er ON f.facility_id = er.facility_id LEFT JOIN booking b ON f.facility_id = b.facility_id GROUP BY f.facility_name ORDER BY combined_rank DESC LIMIT 10";
$result = mysqli_query($conn, $query);

$facilityNames = array();
$combinedRanks = array();

while ($row = mysqli_fetch_assoc($result)) {
  $facilityNames[] = $row['facility_name'];
  $combinedRanks[] = $row['combined_rank'];
}

/* ________________________________CUSTOMER_CHART________________________________ */
$query_2 = "SELECT c.customer_name, COUNT(b.booking_id) AS rank FROM customer c LEFT JOIN booking b ON c.customer_id = b.customer_id GROUP BY c.customer_name ORDER BY rank DESC LIMIT 20";
$result_2 = mysqli_query($conn, $query_2);

$customerNames = array();
$customerRanks = array();

while ($row = mysqli_fetch_assoc($result_2)) {
  $customerNames[] = $row['customer_name'];
  $customerRanks[] = $row['rank'];
}

/* ________________________________COMPANY_CHART________________________________ */
$query_3 = "SELECT CONCAT('Client: ', c.client_name, '<br>Company: ', c.company_name) AS client, COUNT(er.evt_reservation_id) AS rank FROM company c LEFT JOIN event_reservation er ON c.company_id = er.company_id GROUP BY c.client_name ORDER BY rank DESC LIMIT 20";
$result_3 = mysqli_query($conn, $query_3);

$clientCompanyNames = array();
$clientRanks = array();

while ($row = mysqli_fetch_assoc($result_3)) {
  $clientCompanyNames[] = $row['client'];
  $clientRanks[] = $row['rank'];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0"></script>
<script>
/* ________________VENUE_CHART________________ */
function generateRandomVenueColor() {
  var r = Math.floor(Math.random() * 256);
  var g = Math.floor(Math.random() * 256);
  var b = Math.floor(Math.random() * 256);
  var alpha = 0.2;

  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

var venueBackgroundColors = [];
var venueBorderColors = [];

for (var i = 0; i < 10; i++) {
  var backgroundColor = generateRandomVenueColor();
  var borderColor = backgroundColor.replace(/[^,]+(?=\))/, '1');

  venueBackgroundColors.push(backgroundColor);
  venueBorderColors.push(borderColor);
}

var venueCtx = document.getElementById('venue_chart').getContext('2d');
var venueChart = new Chart(venueCtx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($facilityNames); ?>,
    datasets: [{
      label: 'Total Reservations',
      data: <?php echo json_encode($combinedRanks); ?>,
      backgroundColor: venueBackgroundColors,
      borderColor: venueBorderColors,
      borderWidth: 2
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    layout: {
      padding: {
        left: 50,
        right: 50,
        top: 0,
        bottom: 50
      }
    }
  }
});
/* ________________END________________ */


/* ________________CUSTOMER_CHART________________ */
function generateRandomCustomerColor() {
  var r = Math.floor(Math.random() * 256);
  var g = Math.floor(Math.random() * 256);
  var b = Math.floor(Math.random() * 256);
  var alpha = 0.2;

  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

var customerBackgroundColors = [];
var customerBorderColors = [];

for (var i = 0; i < 10; i++) {
  var backgroundColor = generateRandomCustomerColor();
  var borderColor = backgroundColor.replace(/[^,]+(?=\))/, '1');

  customerBackgroundColors.push(backgroundColor);
  customerBorderColors.push(borderColor);
}

var customerCtx = document.getElementById('customer_chart').getContext('2d');
var customerChart = new Chart(customerCtx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($customerNames); ?>,
    datasets: [{
      label: 'Total Bookings',
      data: <?php echo json_encode($customerRanks); ?>,
      backgroundColor: customerBackgroundColors,
      borderColor: customerBorderColors,
      borderWidth: 2
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    layout: {
      padding: {
        left: 50,
        right: 50,
        top: 0,
        bottom: 50
      }
    }
  }
});
/* ________________END________________ */


/* ________________COMPANY_CHART________________ */
function generateRandomCompanyColor() {
  var r = Math.floor(Math.random() * 256);
  var g = Math.floor(Math.random() * 256);
  var b = Math.floor(Math.random() * 256);
  var alpha = 0.2;

  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

var companyBackgroundColors = [];
var companyBorderColors = [];

for (var i = 0; i < 10; i++) {
  var backgroundColor = generateRandomCompanyColor();
  var borderColor = backgroundColor.replace(/[^,]+(?=\))/, '1');

  companyBackgroundColors.push(backgroundColor);
  companyBorderColors.push(borderColor);
}

var companyCtx = document.getElementById('company_chart').getContext('2d');
var companyChart = new Chart(companyCtx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($clientCompanyNames); ?>,
    datasets: [{
      label: 'Total Reservations',
      data: <?php echo json_encode($clientRanks); ?>,
      backgroundColor: companyBackgroundColors,
      borderColor: companyBorderColors,
      borderWidth: 2
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    layout: {
      padding: {
        left: 50,
        right: 50,
        top: 0,
        bottom: 50
      }
    }
  }
});
/* ________________END________________ */
</script>


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
</script>


</div>


</body>
</html> 
