<!-- -->
<?php
include_once 'connect.php';

if (isset($_GET['id']) && isset($_POST['delete'])) {
  $product_id = $_GET['id'];

  // Delete the product from the database
  $sql = "DELETE FROM product WHERE id = $product_id";
  $query_run = mysqli_query($conn, $sql);

  if ($query_run) {
      $_SESSION['success'] = "Product deleted successfully.";
      echo "Product deleted successfully.";

  } else {
      $_SESSION['error'] = "Error deleting product.";
      echo "Product Not deleted successfully.";

  }

  // Redirect back to the product list page after deletion
  header("Location: productlist.php");
  exit;
}


?>

<?php

session_start();
include_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["productid"];
    $userId = $_SESSION['user_id'];

        $sql = "INSERT INTO cart (productid, userid) VALUES ('$id', '$userId')";
        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
            $_SESSION['success'] = "Data posted";
            header("Location: userProfile.php");
            exit();
        } else {
            $_SESSION['error'] = "Data not posted: " . mysqli_error($conn);
            header("Location: userProfile.php");
            exit();
        }
    }


// Close the connection (optional, as it will be closed when the script ends)
// mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Product List</title>
<link rel="stylesheet" href="style.css">
<style>
  .column-gap {
    margin-left: 5rem; /* Adjust the desired gap value */
    margin-top:1rem;
  }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-gxxrTvZUCMLJLfPOrUduzG3LeKQsT0wr9CkjrbzKsMmvQzzbvxwAxh06aDfKIQs6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-2xIvttLkQP67y3O1pzGkpQiQ+wttvvNJzO1Z9pPAeflKWdwGp/yLgiYwpP6i5y6M" crossorigin="anonymous"></script>
</head>
<body>

<?php
include "adminnavbar.php"
?>

<?php
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Access the user ID
  $userId = $_SESSION['user_id'];
  // Use the user ID as needed
  // ...
} else {
  echo "user not login";
  // User is not logged in, handle the situation accordingly
}
?>

</div>
<div id="searchResults" class="  d-flex flex-wrap  " style="margin-left:10px" >

<?php
include_once 'connect.php';
    // Fetch image names from the database
    $sql = "SELECT * FROM post";
    // if($Category === "ALL"){
    // $sql = "SELECT * FROM product ";
    // }else{
    //     $sql = "SELECT * FROM product WHERE producttype = $Category";
    // }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
            $productname = $row['name'];
            $type = $row['type'];
            $image_name = $row['postimg'];
            $image_path = "uploads/" . $image_name;
            $description = $row['description']
           ?>
    <div class="  d-flex flex-wrap" style="margin-left:30px;padding:10px">
    <div class="card " style="width:300px;max-width:300px" >
    <img class="card-img-top" src="<?php echo $image_path; ?>" alt="<?php echo $productname; ?>" height="300" width="200"><br><br>
  <div class="card-body">
    <h5 class="card-title"><?php echo $productname ?></h5>
    <p class="card-text"><?php echo $description ?></p>
    <div class="d-flex " >
      <form method="post" action="">
        <input type="hidden" value="<?php echo $id ?>" name="productid">
      <!-- <button class="btn btn-primary" type="submit">Add To Cart</button> -->
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
</a>
</div>





</body>
</html>