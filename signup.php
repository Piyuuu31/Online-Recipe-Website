

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<?php
// Include the connection file
// session_start();

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "INSERT INTO user (name, email, password) VALUES ('$username', '$email', '$password')";

      $query_run = mysqli_query($conn, $sql);

      if ($query_run) {
          $_SESSION['success'] = "Resister SuccessFully ";
          header("Location: signup.php");
          exit();
      } else {
          $_SESSION['error'] = " not Resister: " . mysqli_error($conn);
          header("Location: signup.php");
          echo  mysqli_error($conn);
          exit();
      }
  }


// Close the connection (optional, as it will be closed when the script ends)
// mysqli_close($conn);
?>
   <div style="width:700px;margin:auto;margin-top:10%;padding:20px" class="border">
<form class="" method="post">
<?php if (isset($_SESSION['status'])) {
  echo "<p>" . $_SESSION['status'] . "</p>";
  unset($_SESSION['status']);
} ?>
<?php if (isset($_SESSION['success'])) {
  echo "<p>" . $_SESSION['success'] . "</p>";
  unset($_SESSION['success']);
} ?>
<?php if (isset($_SESSION['error'])) {
  echo "<p>" . $_SESSION['error'] . "</p>";
  unset($_SESSION['error']);
} ?>
<div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <p class="text-center mb-0">Already have a account? <a href="userlogin.php">Login Here</a></p>

</form>
</div>
</div>

        <script src="" async defer></script>
    </body>
</html>