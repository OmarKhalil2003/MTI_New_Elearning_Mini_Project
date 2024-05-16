<?php
// Start the session to enable session variables
session_start();

// Display errors for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$host = "localhost";
$user = "root";
$pass = "";
$db = "ct_project";

// Connect to the database
$data = mysqli_connect($host, $user, $pass, $db);

// Check if the connection was successful
if ($data === false) {
    die("connection error");
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve username and password from the POST data
    $name = mysqli_real_escape_string($data, $_POST['username']);
    $passs = mysqli_real_escape_string($data, $_POST['password']);
    
    // Query to check if the user exists in the database
    $sql = "SELECT * FROM user WHERE email='" . $name . "' AND password='" . $passs . "'";
    $result = mysqli_query($data, $sql);

    // Check if the query was successful
    if ($result === false) {
        die("query error");
    }

    // Check if any rows were returned by the query
    if (mysqli_num_rows($result) > 0) {
        // Fetch the first row from the result set
        $row = mysqli_fetch_array($result);
        
        // Check the user's usertype and redirect accordingly
        if ($row["usertype"] == "cs") {
            header("location:Home1.html");
            exit();
        } elseif ($row["usertype"] == "mid") {
            header("location:Home2.html");
            exit();
        }
    } else {
        // If no rows were returned, display an error message
        echo "Username or password doesn't match";
    }
}