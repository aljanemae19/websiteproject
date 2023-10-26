<?php

// Create connection
function getConnection()
{
    //echo "this is a test";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "website";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Close connection
function closeConnection()
{
    //echo "this is  test number 2";
    $conn->close();
}
?>