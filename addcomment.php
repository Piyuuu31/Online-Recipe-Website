<?php

require_once 'connect.php';

if (isset($_POST['submit'])) {
    session_start();
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    // Insert the comment into the database
    $sql = "INSERT INTO comments (userid, postid, comment) VALUES ('$user_id', '$post_id', '$comment')";
    if ($conn->query($sql)) {
        echo "Comment added successfully.";
        header("Location: recipedetails.php?id='$post_id'");
    } else {
        echo "Error adding comment: " . $conn->error;
        header("Location: recipedetails.php");

    }
}

?>
