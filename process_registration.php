<?php
include_once("include/DBUtil.php");

$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$age = $_POST['age'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];
$gender = $_POST['gender'];


$sql = "INSERT INTO users ( firstname, lastname, age, email, password, role, gender) 
VALUES ('".$firstname."', '".$lastname."', '".$age."', '".$email."', '".$password."', '".$role."', '".$gender."')";

  if ($conn->query($sql) === TRUE) {

 header("Location: register.html");
  exit();
 } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

closeConnection();

?>
