<!-- -->
<?php
// Include your connection file
include_once 'connect.php';

// Fetch categories from the database

$sql = "SELECT DISTINCT  * FROM user";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching categories: " . mysqli_error($conn));
}
?>

<?php
include_once 'connect.php';

if (isset($_GET['id']) && isset($_POST['delete'])) {
  $product_id = $_GET['id'];

  // Delete the product from the database
  $sql = "DELETE FROM categorys WHERE id = $product_id";
  $query_run = mysqli_query($conn, $sql);

  if ($query_run) {
      $_SESSION['success'] = "Product deleted successfully.";
      echo "Product deleted successfully.";

  } else {
      $_SESSION['error'] = "Error deleting product.";
      echo "Product Not deleted successfully.";

  }

  // Redirect back to the product list page after deletion
  header("Location: managecategory.php");
  exit;
}


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

<div class="   d-flex justify-content-between  flex-wrap" style="width:80vw;margin: auto" >
<table class="table  table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
  <?php
                // Display the categories in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
                ?>
  </tbody>
</table>



</div>
</a>
</div>



</body>
</html>