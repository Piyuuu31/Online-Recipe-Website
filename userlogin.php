<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>UserLogin</title>
<style>
  body{
    background-image:url("images/resistebg.jpg");
    background-size:cover
  }
</style>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-gxxrTvZUCMLJLfPOrUduzG3LeKQsT0wr9CkjrbzKsMmvQzzbvxwAxh06aDfKIQs6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-2xIvttLkQP67y3O1pzGkpQiQ+wttvvNJzO1Z9pPAeflKWdwGp/yLgiYwpP6i5y6M" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light z-3 shadow" >
  <div class="container-fluid bg-light" style="width:1500px;height:80px">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between "  id="navbarTogglerDemo01">
        <div>
      <a class="navbar-brand fs-2 fw-semibold" href="dashboard.php">Recipe Project</a>
      </div>
      <div>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fs-5 fw-semibold" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 fw-semibold" href="userlogin.php">Login</a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link fs-5 fw-semibold" aria-current="page" href="userprofile.php">Home</a> -->
          <a class="nav-link fs-5 fw-semibold" aria-current="page" href="adminlogin.php">Admin Login</a>
        </li>
        <li class="nav-item">
          <a href="signup.php" class="nav-link fs-5 fw-semibold border bg-primary text-white rounded " style="cursor:pointer">Sign Up</a>
        </li>
      </ul>
      </div>
    </div>
  </div>
</nav>



<div class="loginbg d-flex justify-content-center align-items-center" style="height:100vh">
<?php

session_start();


// Unset all of the session variables
$_SESSION = array();

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
  $query = "SELECT * FROM user WHERE email='$username' AND password='$password'";
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
    header('Location: userprofile.php');
    exit();
  } else {
    // If the query returns no rows, the login is unsuccessful
    $error = "Invalid username or password";

  }
}
?>



<div class="container  ">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-lg">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Login As User</h3>
          <span class="text-red">
          <?php if (!empty($error)): ?>
            <p class="text-center" style="color: red;textAlign:center"><?php echo $error; ?></p> <!-- Display the error message -->
        <?php endif; ?></span>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="user-login">
              <form action="" method="post">
                <div class="form-floating mb-3">

                  <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                  <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Login as User</button>
              </form>
            </div>
            <div class="tab-pane fade" id="admin-login">
              <form>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="adminEmail" placeholder="admin@example.com" required>
                  <label for="adminEmail">Email address</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="adminPassword" placeholder="Password" required>
                  <label for="adminPassword">Password</label>
                </div>
                <button type="submit" class="btn btn-danger w-100 mb-3">Login as Admin</button>
              </form>
            </div>
          </div>
          <hr>
          <p class="text-center mb-0">Don't have an account? <a href="resister.php">Sign up</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

</div>


</body>
</html>