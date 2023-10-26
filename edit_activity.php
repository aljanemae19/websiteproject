<?php
// Database connection setup (replace with your own database connection code)
$host = "localhost";
$username = "root";
$password = "";
$database = "activitylog";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$activity_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Define $activity with default values
$activity = [
    'name' => '',
    'date' => '',
    'time' => '',
    'location' => '',
    'ootd' => '',
];

if ($activity_id > 0) {
    $sql = "SELECT * FROM activities WHERE id = $activity_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $activity = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Handle the form submission for updating activity details
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_activity"])) {
        $name = $_POST["name"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $location = $_POST["location"];
        $ootd = $_POST["ootd"];

        // Define $update_sql with the SQL query for updating
        $update_sql = "UPDATE activities SET name = '$name', date = '$date', time = '$time', location = '$location', ootd = '$ootd' WHERE id = $activity_id";

        // After updating the database, fetch the updated data and populate the $activity array
        if (mysqli_query($conn, $update_sql)) {
            echo "Activity updated successfully.";

            // Fetch the updated data and populate $activity
            $sql = "SELECT * FROM activities WHERE id = $activity_id";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $activity = mysqli_fetch_assoc($result);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Activity</title>
</head>
<body>
    <h1>Edit Activity</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $activity['name']; ?>" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $activity['date']; ?>" required><br>

        <label for="time">Time:</label>
        <input type="time" name="time" value="<?php echo $activity['time']; ?>" required><br>

        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo $activity['location']; ?>" required><br>

        <label for="ootd">Outfit of the Day:</label>
        <input type="text" name="ootd" value="<?php echo $activity['ootd']; ?>"><br>

        <input type="submit" name="update_activity.html" value="Update Activity">
    </form>
</body>
</html>
