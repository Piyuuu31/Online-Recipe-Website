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
        <link rel="stylesheet" href="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
     <body>
        <?php
       if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
        // session_start();
        ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light z-3 shadow" >
  <div class="container-fluid bg-light" style="width:1500px;height:80px">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between "  id="navbarTogglerDemo01">
        <div>
        <?php if(isset($_SESSION['username'])): ?>
      <a class="navbar-brand fs-2 fw-semibold" href="userprofile.php">Recipe Project</a>
      <?php else: ?>
      <a class="navbar-brand fs-2 fw-semibold" href="dashboard.php">Recipe Project</a>
      <?php endif; ?>
      </div>
      <div>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <?php if(isset($_SESSION['username'])): ?>
          <a class="nav-link fs-5 fw-semibold" aria-current="page" href="userprofile.php">Home</a>
          <?php else: ?>
          <a class="nav-link fs-5 fw-semibold" aria-current="page" href="dashboard.php">Home</a>
          <?php endif; ?>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link fs-5 fw-semibold" aria-current="page" href="contactus.php">Contact Us</a>
        </li> -->
        <?php if(isset($_SESSION['username'])): ?>
            <li class="nav-item">

          <a class="nav-link fs-5 fw-semibold" href="profile.php">User Profile</a>
        </li>
    <?php else: ?>
        <li class="nav-item">
          <a class="nav-link fs-5 fw-semibold" href="userlogin.php">Login</a>
        </li>
        <li class="nav-item">
        <?php if(isset($_SESSION['username'])): ?>
          <!-- <a class="nav-link fs-5 fw-semibold" aria-current="page" href="userprofile.php">Home</a> -->
          <?php else: ?>
          <a class="nav-link fs-5 fw-semibold" aria-current="page" href="adminlogin.php">Admin Login</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <a href="signup.php" class="nav-link fs-5 fw-semibold border bg-primary text-white rounded " style="cursor:pointer">Sign Up</a>
        </li>
        <?php endif; ?>
      </ul>
      </div>
    </div>
  </div>
</nav>

<!-- <script>
    $(document).ready(function() {
        $('#logoutBtn').click(function() {
            // Send an AJAX request to the PHP script to handle logout
            $.ajax({
                url: 'logout.php',
                type: 'POST',
                success: function(response) {
                    // Redirect to the login page or any other desired page
                    window.location.href = 'login.php';
                },
                error: function() {
                    // Handle error
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script> -->
    </body>
</html>


