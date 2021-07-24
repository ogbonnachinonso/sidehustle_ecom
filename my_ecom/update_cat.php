<?php
session_start();
 

require_once '../db/config.php';
require_once '../db/function.php';
require_once '../includes/head.php';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../auth/login.php");
  exit;
}
$category =  "";
$category_err = "";

if(isset($_GET['id']) && $_GET['id']!=''){
  $id=get_safe_value($link, $_GET['id']);
  $res = mysqli_query($link, "SELECT * FROM cats WHERE id='$id'");
  $row =mysqli_fetch_assoc($res);
  $category = $row['category'];
}

if(isset($_POST['submit'])){
  
  if(isset($_GET['id']) && $_GET['id']!=''){
     $id = ($_POST['id']);
     $category = ($_POST['category']);
      $query =  "UPDATE `cats` SET 
      `category`='$category' 
      WHERE id='$id'
      ";
       $res = mysqli_query($link, $query);
         if($res==true){
        $_SESSION['update'] = "<div class='text-success'>Category updated successfully.</div>";
        header('location: ../auth/category.php');
      }else{
        $_SESSION['update'] = "<div class='text-danger'>Category update failed.</div>";
       header('location: update_cat.php');
      }  
    
 }
 
}


?>
<main class="login-pag" id="login" style="background-image: url(assets/img/bg.jpg)" >
    <div class="container mt-5 pt-5">
        <h2 class="text-white text-center">Update Category</h2>
        <p class="text-white">Please fill in your Category.</p>

        <?php 
        if(!empty($cat_err)){
            echo '<div class="alert alert-danger">' . $cat_err . '</div>';
        }        
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label class="text-white">Category</label>
                <input type="text" name="category" class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $category; ?>">
                <span class="invalid-feedback"><?php echo $category_err; ?></span>
            </div>    
            
            <div class="form-group">
               <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="submit" class="btn btn-warning text-white m-auto" value="update">
            </div>
        </form>
    </div>
    </main>
    <?php require_once '../includes/foot.php';?>