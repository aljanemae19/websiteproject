<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Gender Distribution Pie Chart</title>
  <!-- Include Google Charts API -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<!-- Create a container div for the pie chart -->
<div id="genderPieChart" style="width: 400px; height: 300px;"></div>

<?php
// Replace with your actual database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "website";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve gender data
$sql = "SELECT gender, COUNT(*) AS count FROM users GROUP BY gender";

$result = $conn->query($sql);

// Create an array to store the data
$data = [['Gender', 'Count']];

while ($row = $result->fetch_assoc()) {
    $data[] = [$row['gender'], (int)$row['count']];
} 

// Convert data array to JSON format
$jsonData = json_encode($data);
?>

<script>
  // Load the Google Charts API
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback function to run when the API is loaded
  google.charts.setOnLoadCallback(drawChart);

  // Callback function to draw the pie chart
  function drawChart() {
    // Create a data table object
    var data = google.visualization.arrayToDataTable(<?php echo $jsonData; ?>);

    // Customize the pie chart options
    var options = {
      title: 'Gender Distribution',
      is3D: true, // Enable 3D effect
    };

    // Create a new pie chart and attach it to the container div
    var chart = new google.visualization.PieChart(document.getElementById('genderPieChart'));

    // Draw the chart with the data and options
    chart.draw(data, options);
  }
</script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Activity Log Bar Graph</title>
  <!-- Include Google Charts API -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<!-- Create a container div for the bar graph -->
<div id="activityBarChart" style="width: 800px; height: 400px;"></div>

<?php
// Replace with your actual database connection credentials
$activityServername = "localhost";
$activityUsername = "root";
$activityPassword = "";
$activityDatabase = "activitylog";

// Create a connection to the activitylog database
$activityConn = new mysqli($activityServername, $activityUsername, $activityPassword, $activityDatabase);

// Check the connection
if ($activityConn->connect_error) {
    die("Connection failed: " . $activityConn->connect_error);
}

// Create an array to store the data
$activities = [['Month', 'Activity Count']];

// SQL query to retrieve activity data for each month
$activitySql = "SELECT DATE_FORMAT(date, '%M') AS month, COUNT(*) AS activityCount FROM activities WHERE YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";

$activityResult = $activityConn->query($activitySql);

while ($activityRow = $activityResult->fetch_assoc()) {
    $month = $activityRow['month'];
    $activityCount = (int)$activityRow['activityCount'];

    $activities[] = [$month, $activityCount];
}

// Convert data array to JSON format
$activityJsonData = json_encode($activities);
?>

<script>
  // Load the Google Charts API
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback function to run when the API is loaded
  google.charts.setOnLoadCallback(drawChart);

  // Callback function to draw the bar graph
  function drawChart() {
    // Create a data table object
    var data = google.visualization.arrayToDataTable(<?php echo $activityJsonData; ?>);

    // Customize the bar graph options
    var options = {
      title: 'Activity Log Over Time (<?php echo date('Y'); ?>)',
      hAxis: { title: 'Month' },
      vAxis: { title: 'Activity Count' },
    };

    // Create a new bar graph and attach it to the container div
    var chart = new google.visualization.ColumnChart(document.getElementById('activityBarChart'));

    // Draw the chart with the data and options
    chart.draw(data, options);
  }
</script>
</body>
</html>
