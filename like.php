<?php
include_once 'connect.php';

// Retrieve post ID and user ID from the AJAX request
$postId = $_POST['post_id'];
$userId = $_POST['user_id'];

// Check if the user has already liked the post
$checkQuery = "SELECT * FROM likes WHERE post_id = $postId AND user_id = $userId";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // User has already liked the post, so we need to remove the like
    $deleteQuery = "DELETE FROM likes WHERE post_id = $postId AND user_id = $userId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "unliked";
    } else {
        echo "error";
    }
} else {
    // User has not liked the post, so we need to add the like
    $insertQuery = "INSERT INTO likes (post_id, user_id) VALUES ($postId, $userId)";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo "liked";
    } else {
        echo "error";
    }
}

// Get the updated count of likes for the post
$likeCountQuery = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = $postId";
$likeCountResult = mysqli_query($conn, $likeCountQuery);

if (mysqli_num_rows($likeCountResult) > 0) {
    $likeCountRow = mysqli_fetch_assoc($likeCountResult);
    $likeCount = $likeCountRow['like_count'];

    // Return the updated like count as the response
    echo $likeCount;
} else {
    echo "0";
}
?>
