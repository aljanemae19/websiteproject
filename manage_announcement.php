<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "announcement_management";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_announcement'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $insert_query = "INSERT INTO announcements (title, content) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            // Announcement added successfully
            header("Location: manage_announcements.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    if (isset($_POST['edit_announcement'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $update_query = "UPDATE announcements SET title = ?, content = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssi", $title, $content, $id);

        if ($stmt->execute()) {
            // Announcement updated successfully
            header("Location: manage");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    if (isset($_POST['delete_announcement'])) {
        $id = $_POST['id'];

        $delete_query = "DELETE FROM announcements WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Announcement deleted successfully
            header("Location: manage_announcements.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Fetch existing announcements
$announcements = [];
$select_query = "SELECT id, title, content FROM announcements";
$result = $conn->query($select_query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            background-color: #0073e6;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }

        h2 {
            margin-top: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #0073e6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        strong {
            display: block;
            font-size: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Manage Announcements</h1>

    <h2>Add Announcement</h2>
    <form method="POST" action="add_announcement.html">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <input type="submit" name="add_announcement" value="Add Announcement">
    </form>

    <h2>Edit or Delete Announcements</h2>
    <ul>
        <?php foreach ($announcements as $announcement) : ?>
            <li>
                <strong><?php echo $announcement['title']; ?></strong><br>
                <?php echo $announcement['content']; ?><br>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $announcement['id']; ?>">
                    <input type="text" name="title" placeholder="New Title" required>
                    <textarea name="content" placeholder="New Content" required></textarea>
                    <input type="submit" name="edit_announcement" value="Edit">
                    <input type="submit" name="delete_announcement" value="Delete">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
