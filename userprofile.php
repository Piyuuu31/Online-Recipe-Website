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
   <?php
    include "navbar.php"
   ?>
   <div class="dashboardbg">
    <div class="imagecontent">
   <h1 class="text-warning fs-1" style="font-size:80px">Learn Cook Share Cooking Made Easy</h1>
   <p class="text-white fs-4">Say Good Bye to long And Frustrating Food Blogs.</p>
   <div class="d-flex justify-content-center">
  <a class="p-2 rounded  text-white fs-4 " style="text-decoration:none;margin-top:20px;cursor:pointer;background-color:blue">Explore Dish</a>
  </div>
</div>
   </div>
   <section>
   <h1 class="text-center">Search Your Favorite Dish</h1>
   <div style="width:1500px;margin:auto">
   <form class="d-flex" role="search" method="POST" action="">
  <select style="padding:15px;font-size:20px" class="form-control me-2 bg bg-dark background-color:blue text-white" id="searchInput" type="search" name="search">
    <option class="fs-5" selected disabled>Select Type</option>
    <option value="Veg" class="fs-5">Veg</option>
    <option class="fs-5" value="NonVeg">NonVeg</option>
    <option class="fs-5" value="BreakFast">BreakFast</option>
    <option class="fs-5" value="Lunch">Lunch</option>
    <option class="fs-5" value="Dinner">Dinner</option>
    <option class="fs-5" value="Dessert">Dessert</option>
    <option class="fs-5" value="Drinks">Drinks</option>
  </select>
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
      <div class="d-flex  flex-wrap" id="searchResults">
      <?php
include_once 'connect.php';

// Fetch image names from the database based on search input
if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $sql = "SELECT * FROM post WHERE  type =  '$search' ";
} else {
  $sql = "SELECT * FROM post";
}


$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $postname = $row['name'];
        $type = $row['type'];
        $image_name = $row['postimg'];
        $image_path = "uploads/" . $image_name;
        $description = $row['description'];
        ?>
         <a class="text-decoration-none" href="recipedetails.php?id=<?php echo $id ?>">
        <div class="d-flex flex-wrap" style="margin-left:30px;padding:10px">


            <div class="card" style="width:300px;max-width:300px">
                <img class="card-img-top" src="<?php echo $image_path; ?>" alt="<?php echo $postname; ?>" height="300" width="200"><br><br>
                <div class="card-body">
                    <h4 class="card-title">Name:-<?php echo $postname ?></h4>
                    <!-- <h5 class="card-text">Description:-<?php echo $description ?></h5> -->
                    <p class="fs-5">Type:-<?php echo $type ?></p>
                    <div class="d-flex">
                        <form action="deleatepost.php" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $row['id'] ?>">
                            <!-- <button type="submit" class="btn btn-danger" name="delete">Delete</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </a>
<?php
    }
} else {
    echo "No results found.";
}
?>

</div>
</div>
   </div>
   </section>
   <footer class="bg-dark text-light py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h4>About Us</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur, ipsum ac iaculis sodales, turpis lectus consectetur lorem, at aliquet leo elit nec dolor.</p>
      </div>
      <div class="col-md-3">
        <h4>Quick Links</h4>
        <ul class="list-unstyled">
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h4>Contact</h4>
        <ul class="list-unstyled">
          <li><i class="bi bi-geo-alt-fill"></i> 123 Street, City</li>
          <li><i class="bi bi-envelope-fill"></i> info@example.com</li>
          <li><i class="bi bi-telephone-fill"></i> +1234567890</li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr>
        <p class="text-center">© 2023 Your Company. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

        <script src="" async defer></script>
    </body>
</html>