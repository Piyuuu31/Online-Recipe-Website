
<?php
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "foodrecipe"; // Replace with your MySQL database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if ($conn) {
// echo "Connected successfully";
}
else{
    die("Connection failed: " . mysqli_connect_error());
}

?>

