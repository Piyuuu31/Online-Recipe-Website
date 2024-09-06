<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    .card {
  margin-top: 20px;
}
    .card-header {
    background-color: #007bff;
    color: white;
  }

  .form-control {
    border-radius: 0;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
  }
  </style>
  <link href="style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
    include "navbar.php"
   ?>
<?php
// Destroy the session
session_destroy();
// Include the external connection file
require_once 'connect.php';
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the username and password from the form
  $username = $_POST['email'];
  $password = $_POST['password'];

  // Query the database for the user with the given username and password
  $query = "SELECT * FROM admin WHERE email='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  // If the query returns a row, the login is successful
  if (mysqli_num_rows($result) == 1) {
    // Set the session variable to the username
    session_start();
    $_SESSION['username'] = $username;
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    $_SESSION['user_id'] = $user_id;
    // Redirect the user to the profile page
    header('Location: adminprofile.php');
    exit();
  } else {
    // If the query returns no rows, the login is unsuccessful
    $error = "Invalid username or password";

  }
}
?>
   <div class="d-flex justify-content-center align-items-center" style="height:80vh">
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Admin Login</div>
          <div class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
                <label class="form-check-label" for="remember-me">Remember me</label>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>