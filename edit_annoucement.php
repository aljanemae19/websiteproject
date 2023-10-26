<?php
// Database connection setup (replace with your own database connection code)
$host = "localhost";
$username = "root";
$password = "";
$database = "announcement_management";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the $row array
$row = array('id' => '', 'title' => '', 'content' => '');

// Handle the form submission for editing an announcement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_announcement"])) {
    $announcement_id = $_POST["announcement_id"];
    $new_title = $_POST["new_title"];
    $new_content = $_POST["new_content"];

    // Update the announcement in the database
    $update_sql = "UPDATE announcements SET title = ?, content = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt, "ssi", $new_title, $new_content, $announcement_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Announcement updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Fetch the announcement to be edited
if (isset($_GET["edit_id"])) {
    $edit_id = $_GET["edit_id"];
    $select_sql = "SELECT id, title, content FROM announcements WHERE id = $edit_id";
    $result = mysqli_query($conn, $select_sql);
    $row = mysqli_fetch_assoc($result);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Announcement</title>
</head>
<body>
    <h1>Edit Announcement</h1>
    <form method="post" action="manage_announcement.php">
        <input type="hidden" name="announcement_id" value="<?php echo $row['id']; ?>">
        <label for="new_title">Title:</label>
        <input type="text" name="new_title" value="<?php echo $row['title']; ?>" required><br>

        <label for="new_content">Content:</label>
        <textarea name="new_content" rows="5" required><?php echo $row['content']; ?></textarea><br>

        <input type="submit" name="edit_announcement" value="Update Announcement">
    </form>
</body>
</html>
