<?php
session_start();

// Include your database connection file
require_once 'connect.php';

// Retrieve the session ID from the session storage
$sessionId = $_SESSION['user_id'];

// Execute the query using the session ID
$sql = "SELECT * FROM user WHERE id = '$sessionId'";
$result = $conn->query($sql);

// Check if the query returned any results
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $name = $row['name'];
    $email = $row['email'];
    $profileImage = $row['profile_image'];
    $profiledescription = $row['profiledescription'];

    // If the profile image column is empty, use a default image
    if (empty($profileImage)) {
        $profileImage = 'deafalyt.jpg'; // Replace with your default image filename
    }
} else {
    // Redirect to login page or handle the scenario when user details are not found
    header('Location: profile.php');
    exit();
}



// Close the database connection (if necessary, depending on your connection file)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $userId = $_POST['id'];
  $username = $_POST["name"];
  $profiledescription = $_POST['profiledescription'];

  // Handle file upload
  $image_name = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];

  if (file_exists("uploads/" . $image_name)) {
      $_SESSION['status'] = "Image Already Exist " . $image_name;
      header('Location: profile.php');
      exit();
  } else {
      // Move the uploaded file to the target location
      move_uploaded_file($image_tmp_name, "uploads/" . $image_name);

      // Insert data into the database
      $sql = "UPDATE user SET name='$username', profile_image='$image_name', profiledescription='$profiledescription' WHERE id='$userId'";
      $query_run = mysqli_query($conn, $sql);

      if ($query_run) {
          $_SESSION['success'] = "Data posted";
          header("Location: profile.php");
          exit();
      } else {
          $_SESSION['error'] = "Data not posted: " . mysqli_error($conn);
          header("Location: profile.php");
          // echo mysqli_error($conn);
          exit();
      }
  }
}  // Retrieve form data
?>