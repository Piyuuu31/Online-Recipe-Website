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

<!DOCTYPE html>
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
    <body style="background:grey">
    <?php
    include "navbar.php"
   ?>


        <div style="width:80%;margin:auto;height:70vh;" class="d-flex align-items-center justify-content-around">
       <div>
       <div class="card" style="width: 30rem;">
       <img  class="card-img-top" src="uploads/<?php echo $profileImage; ?>" alt="Profile Image">
  <div class="card-body">
    <h5 class="card-title"><?php echo $name ?></h5>
    <p class="card-text"><?php echo $profiledescription?></p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Edit Profile</button>
    <a type="button" href="userlogin.php" class="btn btn-danger" >Log Out</a>

  </div>
</div>
</div>
       </div>
       <div class="bg-white" style="padding:30px;">
       <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Posts</a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createpostmodel">
 Create Post
</button>




<div class="modal fade" id="createpostmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="postsave.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Recipe Image</label>
    <input type="file" name="productimg" class="form-control" id="recipient-name">
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Recipe Name</label>
    <input type="text" name="postname" class="form-control" id="recipient-name">
  </div>
  <div class="mb-3">
    <label for="message-text" class="col-form-label">Description</label>
    <textarea class="form-control" name="productdescription" id="message-text"></textarea>
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Recipe Type</label>
    <select name="posttype" class="form-control " id="searchInput" type="search">
    <option class="fs-5" selected disabled>Select Type</option>
    <option value="Veg" class="fs-5">Veg</option>
    <option class="fs-5" value="NonVeg">NonVeg</option>
    <option class="fs-5" value="BreakFast">BreakFast</option>
    <option class="fs-5" value="Lunch">Lunch</option>
    <option class="fs-5" value="Dinner">Dinner</option>
    <option class="fs-5" value="Dessert">Dessert</option>
    <option class="fs-5" value="Drinks">Drinks</option>
  </select>
  </div>

  <label for="steps">Instructions:</label>
        <ol id="steps">
            <li><textarea name="step[]" class="form-control" required></textarea></li>
        </ol>
        <button type="button" id="add-step">Add Step</button>
  <div id="ingredients-container">
    <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Ingredients</label>
      <input type="text" name="ingredients[]" class="form-control" id="recipient-name">
    </div>
  </div>

  <button type="button" class="btn btn-primary" id="add-ingredient">Add Ingredient</button>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" id="submit" name="submit" class="btn btn-primary">Upaload Recipe</button>
  </div>
</form>

  </div>
</nav>

<div class="d-flex  flex-wrap">
<?php
include_once 'connect.php';
$user_id = $_SESSION['user_id'];

    // Fetch image names from the database
    $sql = "SELECT * FROM post WHERE userid = $user_id";
    // if($Category === "ALL"){
    // $sql = "SELECT * FROM product ";
    // }else{
    //     $sql = "SELECT * FROM product WHERE producttype = $Category";
    // }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
            $postname = $row['name'];
            $type = $row['type'];
            $image_name = $row['postimg'];
            $image_path = "uploads/" . $image_name;
            $description = $row['description']
           ?>
    <div class="  d-flex flex-wrap" style="margin-left:30px;padding:10px">
    <div class="card " style="width:300px;max-width:300px" >
    <img class="card-img-top" src="<?php echo $image_path; ?>" alt="<?php echo $postname; ?>" height="300" width="200"><br><br>
  <div class="card-body">
    <h4 class="card-title">Name:-<?php echo $postname ?></h4>
    <!-- <h5 class="card-text">Description:-<?php echo $description ?></h5> -->
    <p class="card-text ">Type:-<?php echo $type ?></p>

    <div class="d-flex " >
      <!-- <form method="post" action="">
        <input type="hidden" value="<?php echo $id ?>" name="productid">
      <button class="btn btn-primary" type="submit">Add To Cart</button>
      </form> -->
      <form action="deleatepost.php" method="POST">
      <input type="hidden"  name="post_id" value="<?php echo  $row['id'] ?>">
      <button type="submit" class="btn btn-danger" name="delete">Delete</button>
    </form>


    </div>

  </div>

</div>
  </div>

    <?php
        }
    } else {
        echo "No images found.";
    }
    ?>

</div>
       </div>
       </div>

       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $sessionId ?>" class="form-control" id="recipient-name">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name</label>
            <input type="text" name="name" value="<?php echo $name ?>" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea class="form-control" name="profiledescription" value="<?php echo $profiledescription ?>" id="message-text"></textarea>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">ProfilePicture</label>
            <input required type="file" name="image" class="form-control" id="image">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      var ingredientIndex = 1;

      $('#add-ingredient').click(function() {
        var ingredientRow = '<div class="ingredient-row">';
        ingredientRow += '<input class="form-control mb-3" type="text" name="ingredients[]" placeholder="Ingredient" required>';
        ingredientRow += '</div>';

        $('#ingredients-container').append(ingredientRow);
        ingredientIndex++;

        console.log("ingredientIndex",ingredientIndex);
      });
    });
  </script>

<script>
        document.getElementById("add-step").addEventListener("click", function() {
            var stepsList = document.getElementById("steps");
            var stepNumber = stepsList.getElementsByTagName("li").length + 1;
            var newStep = document.createElement("li");
            newStep.innerHTML = '<textarea class="form-control mt-3" name="step[]" required></textarea>';
            stepsList.appendChild(newStep);
        });
    </script>


    </body>
</html>