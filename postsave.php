<?php
session_start();
include "connect.php";

$user_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $postname = $_POST["postname"];
  $productdescription = $_POST["productdescription"];
  $posttype = $_POST["posttype"];
  $ingredients = $_POST['ingredients'];
  $recipeSteps = $_POST["step"];

  $recipeStepsString = json_encode($recipeSteps);

  // $recipeStepsString = implode(",", $recipeSteps);

  // Handle file upload
  $image_name = $_FILES['productimg']['name'];
  $image_tmp_name = $_FILES['productimg']['tmp_name'];

  // Check if the image already exists
  if (file_exists("uploads/" . $image_name)) {
    $_SESSION['status'] = "Image Already Exists: " . $image_name;
    header('Location: profile.php');
    exit();
  } else {
    // Move the uploaded file to the target location
    move_uploaded_file($image_tmp_name, "uploads/" . $image_name);

    // Start a database transaction
    mysqli_begin_transaction($conn);

    // Insert data into the database
    $sql = "INSERT INTO post (name, type, description, postimg,userid,step) VALUES ('$postname', '$posttype', '$productdescription', '$image_name',$user_id,'$recipeStepsString')";
    echo $sql;
    $query_run = mysqli_query($conn, $sql);

    // Retrieve the auto-generated post ID
    $postId = mysqli_insert_id($conn);

    // Insert the ingredients into the database
    for ($i = 0; $i < count($ingredients); $i++) {
      $ingredient = $ingredients[$i];

      $sql = "INSERT INTO ingredients (post_id, ingredient) VALUES ('$postId', '$ingredient')";
      mysqli_query($conn, $sql);
    }

    for ($i = 0; $i < count($recipeSteps); $i++) {
      $recipeStep = $recipeSteps[$i];

      $sql = "INSERT INTO recipeSteps (post_id, process) VALUES ('$postId', '$recipeStep')";
      mysqli_query($conn, $sql);
    }

    // Commit the transaction
    mysqli_commit($conn);
    echo  $recipeStepS;

    if ($query_run) {
      $_SESSION['success'] = "Data posted";
      header("Location: profile.php");
      echo "stored";
      exit();
    } else {
      $_SESSION['error'] = "Data not posted: " . mysqli_error($conn);
      header("Location: profile.php");
      echo " Not stored";
      echo mysqli_error($conn);

      exit();
    }
  }
}
?>
