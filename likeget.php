<?php

require_once 'connect.php';

if (isset($_POST['how']) && $_POST['how'] == 'c') {
    session_start();
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['data'];
    $sql1 = "SELECT * FROM likes WHERE userid = '$user_id' AND postid = '$post_id'";
    $res = $conn->query($sql1);
    if ($res->num_rows == 0) {
        $sql2 = "UPDATE `post` SET `likecount` = `likecount` + 1 WHERE id = '$post_id'";
        if($conn->query($sql2)){
            $sql3="INSERT INTO `likes`(postid,userid) VALUES ('$post_id',$user_id)";
            if($conn->query($sql3)){
                $countQuery = "SELECT likecount FROM post WHERE id = '$post_id'";
                $countResult = $conn->query($countQuery);
                $countRow = $countResult->fetch_assoc();
                $likeCount = $countRow['likecount'];
                $response = array(
                    'message' => 'Liked',
                    'count' => $likeCount
                ); // Return the updated like count // Return the updated like count
                echo json_encode($response);
            }
        }
    }else if($res->num_rows==1){
        $sql2 = "UPDATE `post` SET `likecount` = `likecount` - 1 WHERE id = '$post_id'  ";
       if($conn->query($sql2)){
        $sql3 ="DELETE FROM `likes` WHERE postid='$post_id' and userid='$user_id'";
        if($conn->query($sql3)){
            if($conn->query($sql3)){
                $countQuery = "SELECT likecount FROM post WHERE id = '$post_id'";
                $countResult = $conn->query($countQuery);
                $countRow = $countResult->fetch_assoc();
                $likeCount = $countRow['likecount'];
                $response = array(
                    'message' => 'Disliked',
                    'count' => $likeCount
                ); // Return the updated like count
                // echo "Liked";
                echo json_encode($response);

            }
        }
       }
    }
}

?>
