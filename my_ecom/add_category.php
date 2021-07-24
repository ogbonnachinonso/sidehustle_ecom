<?php
session_start();
 

require_once '../auth/config.php';
require_once '../auth/function.php';
require_once '../includes/head.php';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../auth/login.php");
  exit;
}
$category =  "";
$category_err = $cat_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
  // Validate category
  if(empty(trim($_POST["category"]))){
      $category_err = "Please enter a category.";
  } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["category"]))){
      $category_err = "category can only contain letters, numbers, and underscores.";
  } else{
      $sql = "SELECT id FROM cats WHERE category = ?";
      if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_category);
          $param_category = trim($_POST["category"]);
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $category_err = "This category is already taken.";
              } else{
                  $category = trim($_POST["category"]);
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
          mysqli_stmt_close($stmt);
      }
  }


  // Check input errors before inserting in database
   if(empty($category_err)){

      $sql = "INSERT INTO cats (category, status) VALUES ('$category', '1')";
         
      if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_category);
          $param_category = $category;
          if(mysqli_stmt_execute($stmt)){
            $_SESSION['add'] = "<div class='text-success'>Category added successfully.</div>";
              header("location: ../auth/category.php");
          } else{
            $_SESSION['add'] = "<div class='text-danger'>Oops! Something went wrong. Please try again later.</div>";
            header("location: ../auth/category.php");
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }
  }
  
  // Close connection
  mysqli_close($link);

}
?>
<main class="login-pag" id="login" style="background-image: url(assets/img/bg.jpg)" >
    <div class="container mt-5 pt-5">
        <h2 class="text-white text-center">Add Category</h2>
        <p class="text-white">Please fill in your Category.</p>

        <?php 
        if(!empty($cat_err)){
            echo '<div class="alert alert-danger">' . $cat_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label class="text-white">Category</label>
                <input type="text" name="category" class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $category; ?>">
                <span class="invalid-feedback"><?php echo $category_err; ?></span>
            </div>    
            
            <div class="form-group">
                <input type="submit" class="btn btn-warning text-white m-auto" value="Create">
            </div>
        </form>
    </div>
    </main>
    <?php require_once '../includes/foot.php';?>