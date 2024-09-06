<?php
include "connect.php";

// Delete post if the delete button is clicked
if (isset($_POST['delete'])) {
  $postId = $_POST['post_id'];

  echo $postId;

  // Start a database transaction
  mysqli_begin_transaction($conn);

  try {
    // Delete the post from the 'post' table
    $deletePostSql = "DELETE FROM post WHERE id = '$postId'";
    mysqli_query($conn, $deletePostSql);

    // Delete the related ingredients from the 'ingredients' table
    $deleteIngredientsSql = "DELETE FROM ingredients WHERE post_id = '$postId'";
    mysqli_query($conn, $deleteIngredientsSql);

    // Commit the transaction
    mysqli_commit($conn);

    $_SESSION['success'] = "Post deleted successfully";
    header("Location: profile.php");
    echo "delete ";
    exit();
  } catch (Exception $e) {
    // Rollback the transaction in case of any error
    mysqli_rollback($conn);
    $_SESSION['error'] = "Error deleting post: " . mysqli_error($conn);
    header("Location: profile.php");
    echo "not delete ";

    exit();
  }
}

?>
