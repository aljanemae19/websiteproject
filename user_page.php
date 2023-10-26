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

// Handle the form submission for adding an activity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_activity"])) {
    $name = $_POST["name"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $location = $_POST["location"];
    $ootd = $_POST["ootd"];

    // Insert data into the database (replace with your own SQL query)
    $sql = "INSERT INTO activities (name, date, time, location, ootd) VALUES ('$name', '$date', '$time', '$location', '$ootd')";

    if (mysqli_query($conn, $sql)) {
        echo "Activity added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_status"])) {
    $status = $_POST["status"];

    // Update the activity status in the databas

    if (mysqli_query($conn, $update_sql)) {
        echo "Activity status updated successfully.";
    } else {
        echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch all activities in ascending order by date
$sql = "SELECT * FROM activities ORDER BY date ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <link rel="stylesheet" type="text/css" href="user.css">

</head>
<body>
    <h1>Manage Life Activities</h1>
     <!-- Logout Link -->
     <a href="index.html">Logout</a>


    <!-- Add Activity Form -->
    <h2>Add Activity</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <label for "time">Time:</label>
        <input type="time" name="time" required><br>

        <label for="location">Location:</label>
        <input type="text" name="location" required><br>

        <label for="ootd">Outfit of the Day:</label>
        <input type="text" name="ootd"><br>

        <input type="submit" name="add_activity" value="Add Activity">
    </form>

    <!-- All Activities -->
    <h2>All Activities (Ascending by Date)</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>Outfit of the Day</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='editable'>" . $row['name'] . "</td>";
            echo "<td class='editable'>" . $row['date'] . "</td>";
            echo "<td class='editable'>" . $row['time'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['ootd'] . "</td>";
            echo "<td>";
            echo "<a href='edit_activity.php'>Edit</a> | ";
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<select name='status'>";
            echo "<option value='cancel'>Cancel</option>";
            echo "<option value='done'>Done</option>";
            echo "<option value='remarks'>Remarks</option>";
            echo "</select>";
            echo "<input type='submit' name='update_status' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
