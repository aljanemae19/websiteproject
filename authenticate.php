<?php

include_once("include/DBUtil.php");

$conn = getConnection();

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * from users where email = '".$email."' and password = '".$password."' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row["email"] == $email && $row["password"]== $password){
    
    if($row["role"] == "admin"){
        header("Location: NiceAdmin/index.html"); // Redirect to the admin index page
    }
    elseif($row["role"] == "staff"){
        header("Location: user_page.php");
    }
    else{
        header("Location: index.html");
    }

}
else {
    header("Location: index.html");
}

closeConnection();
?>
