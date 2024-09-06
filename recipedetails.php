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


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Use the $id variable as needed in your code
    // echo "The ID from the URL is: " . $id;
} else {
    echo "No ID found in the URL.";
}


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

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- FontAwesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.like').click(function() {
        var id = $(this).attr("title");
        var i = $(this).children(".like_icon");
        var src = i.attr("src");
        var likeCount = $(this).find(".like_count");

        if (src == "images/heart_image.jpg") {
            i.attr("src", "images/red_heart.jpg");
        } else if (src == "images/red_heart.jpg") {
            i.attr("src", "images/heart_image.jpg");
        }

        $.post("likeget.php", { data: id, how: 'c' }, function(response) {
            // Handle the response from the server
            var responseData = JSON.parse(response); // Example: Log the response to the console

            console.log("responseData",responseData);

            var message = responseData.message;
    var count = responseData.count;
            if (message === "Liked") {
                // i.attr("src", "images/red_heart.jpg");
                localStorage.setItem("Liked", "true");
            } else {
                // i.attr("src", "images/heart_image.png");
                localStorage.removeItem("Liked");
            }


            likeCount.text(count.trim());
          const Liked =  localStorage.getItem("Liked");


          console.log("response",Liked); // Example: Log the response to the console



        //   console.log("getItem",id);
            if(Liked === "true"){
                i.attr("src", "images/red_heart.jpg");
            }else{
                i.attr("src", "images/heart_image.png");
            }
        });
    });
});
</script>



    </head>
    <body >
    <?php
    include "navbar.php"
   ?>


<div class="" style="width:100%">
<?php
include_once 'connect.php';

// Fetch image names from the database
$sql = "SELECT * FROM post where id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $postId = $row['id'];
        $postname = $row['name'];
        $type = $row['type'];
        $image_name = $row['postimg'];
        $image_path = "uploads/" . $image_name;
        $description = $row['description'];
        $likeCount = $row['likecount'];
        $listItems = explode(", ", $row["step"]);

        ?>

        <div class="d-flex flex-wrap" style="margin-left:30px;padding:10px;width:1500px;margin:auto">
            <div class=" mb-3" style="width:100%;margin:auto">
                <div class="d-flex border " >
                    <div class="" style="width:70%">
                        <img class="card-img-top" src="<?php echo $image_path; ?>" alt="<?php echo $postname; ?>" height="500" width="800"><br><br>
                    </div>
                    <div style="margin-top:30px;width:100%;padding-left:20px;padding-right:20px" class="text-align-center  d-flex flex-column  align-items-center">
                     <h1 class="text-primary"><?php echo $postname ?></h1>
                     <div class="text-white mb-3 bg-success px-2 py-1 rounded">
                     <h5 ><?php echo $type ?></h5>
                     </div>

                        <?php
                        // Retrieve ingredients for the current post ID
                        $ingredientQuery = "SELECT * FROM ingredients WHERE post_id = $postId";
                        $ingredientResult = mysqli_query($conn, $ingredientQuery);

                        if (mysqli_num_rows($ingredientResult) > 0) {
                            echo "<h5 class='d-flex justify-content-start'>Ingredients</h5>";
                            echo "<ol class='list-group list-group-numbered' style='width:100%'>";
                            while ($ingredientRow = mysqli_fetch_assoc($ingredientResult)) {
                                $ingredientName = $ingredientRow['ingredient'];
                                echo "<li class='list-group-item' >$ingredientName</li>";
                            }
                            echo "</ol>";
                        }
                        ?>
                    </div>
                </div>
                <div class="card">
                <div class="card-header">
                Recipe details
  </div>
  <div class="card-body">

  <?php
                        // Retrieve ingredients for the current post ID
                        $ingredientQuery = "SELECT * FROM recipeSteps WHERE post_id = $postId";
                        $ProcessResult = mysqli_query($conn, $ingredientQuery);

                        if (mysqli_num_rows($ProcessResult) > 0) {
                            echo "<h5>Process:</h5>";
                            echo "<ol class='list-group list-group-numbered'>";
                            while ($processRow = mysqli_fetch_assoc($ProcessResult)) {
                                $processName = $processRow['process'];
                                echo "<li class='list-group-item'>$processName</li>";
                            }
                            echo "</ol>";
                        }
                        ?>
  <!-- <h5 class="card-title">  Recipe Name: <?php echo $postname ?></h5> -->
    <!-- <pack class="card-text">Type: <?php echo $type ?></pack> -->
    <p class="card-text"><?php echo $description ?></p>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->

                    <div>
                        <div class="like d-flex" title="<?php echo $postId ?>" style="height:10px;width:10px">
                            <img class="like_icon" src="images/heart_image.png"  style="height:30px;width:30px" alt="like" >
                            <span class="like_count ml-3"><?php echo $likeCount ?></span>
                        </div>
                        <div style="margin-top:30px">
                            <p>ADD Comment</p>
                            <form method="post" action="addcomment.php">
                                <input type="hidden" value="<?php echo $postId ?>" name="post_id">
                            <textarea class="form-control" name="comment"  ></textarea>
                           <button type="submit" name="submit" style="margin-top:10px" class="btn btn-primary" >Add Comment</button>
                        </form>
                        <h3>Comments:-</h3>
                        <?php
                        $post_id =  $postId;
                        $sql = "SELECT * FROM comments WHERE postid = '$post_id'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $comment_id = $row['id'];
                                $comment_userid = $row['userid'];
                                $comment_text = $row['comment'];

                                ?>

                              <div class="border" style="padding:10px;margin-bottom:10px">
                               <p><?php echo $comment_text ?></p>
                              </div>


                                <?php
                            }
                        } else {
                            echo "No comments found for this post.";
                        }

                        ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <?php
    }
}
} else {
    echo "No images found.";
}
?>

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
document.addEventListener("DOMContentLoaded", function() {
  // Attach event listener to like buttons
  var likeButtons = document.getElementsByClassName("like-button");

  Array.from(likeButtons).forEach(function(button) {
    button.addEventListener("click", function() {
      // Get post ID and user ID from data attributes
      var postId = this.getAttribute("data-post-id");
      var userId = this.getAttribute("data-user-id");

      // Make an AJAX request to the PHP script
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "like.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("post_id=" + postId + "&user_id=" + userId);

      // Handle the response
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Update the button's appearance based on the response
          if (xhr.responseText === "liked") {
            button.classList.add("liked");
          } else {
            button.classList.remove("liked");
          }
        }
      };
    });
  });
});
</script>



    </body>
</html>