<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

  <div class="" style="width:100vw">
    <div class="row">
      <div class="col-md-12">
      <?php
    include "adminnavbar.php"
   ?>
      </div>
    </div>
    <div class="row">
    <div class="card col column-gap mt-3">
<a href="userdetails.php" class="text-decoration-none text-black">

<div class="d-flex justify-content-center p-4">
    <img src="images/th.jpg" style="height:200px">
    </div>
    <h1 class="text-center text-">User List</h1>
</a>

<a href="postdetails.php" class="text-decoration-none text-black">

<div class="d-flex justify-content-center p-4">
    <img src="images/OIPcategory.jpg" style="height:200px">
    </div>
    <h1 class="text-center text-">Post List</h1>
</a>
</div>
    </div>


  </div>
</body>
</html>