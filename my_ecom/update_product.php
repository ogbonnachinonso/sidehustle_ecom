<?php
session_start();
 

require_once '../db/config.php';
require_once '../db/function.php';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../auth/login.php");
  exit;
}

   $sql = "SELECT * FROM products";
   $result = mysqli_query($link, $sql);

   $name = $category = $price = $description = $product_image = $error = "";
   

if(isset($_GET['id']) && $_GET['id']!=''){
  $id=get_safe_value($link, $_GET['id']);
  $res = mysqli_query($link, "SELECT * FROM products WHERE id='$id'");
  $row =mysqli_fetch_assoc($res);
  $category_id = $row['category_id'];
   $name = $row['name'];
   $quantity = $row['quantity'];
  $price = $row['price'];
  $description = $row['description'];
  $product_image = $row['Pimage'];
}
if(isset($_POST['submit'])){
  
   if(isset($_GET['id']) && $_GET['id']!=''){
     $id = ($_POST['id']);
     $name = $_POST['name'];
     $category_id = ($_POST['category_id']);
     $quantity = ($_POST['quantity']);
     $price = $_POST['price'];
     $description = $_POST['description'];
     $created_at = date('l dS F\, Y');
     $product_image = $_FILES['Pimage'];

     $image_name = $_FILES['Pimage']['name'];
    $image_loc = $_FILES['Pimage']['tmp_name'];
    $image_size = $_FILES['Pimage']['size'];
    $image_type = $_FILES['Pimage']['type'];
    $image_error = $_FILES['Pimage']['error'];

    $image_Ext = explode('.', $image_name);
    $image_Actual_Ext = strtolower(end($image_Ext));
   
    $allowed = array('jpg','jpeg','png','pdf');
       if(in_array($image_Actual_Ext, $allowed)){
         if($image_error === 0){
            if($image_size < 1000000){
              $image_name_new = uniqid('', true).".".$image_Actual_Ext;
              $image_destination = '../Uploads/'.$image_name_new;
              move_uploaded_file( $image_loc,"../Uploads/".$image_destination); 
            }else{
             echo "Your files is too big!";
            }
         }else{
           echo "There was an error uploading your file!";
         }
   
       }else{
         echo "You cannot upload files of this type!";
       }

      $query = "UPDATE `products` SET 
      `category_id`='$category_id', 
      `name`='$name',
      `price`='$price',
      `quantity`='$quantity',
      `description`='$description',
      `Pimage`='$image_destination',
      `created_at` = '$created_at'
     
      WHERE id='$id'
      ";
       $res = mysqli_query($link, $query);
         if($res==true){
        $_SESSION['update'] = "<div class='text-success'>Product updated successfully.</div>";
        header('location: ../auth/welcome.php');
      }else{
        $_SESSION['update'] = "<div class='text-danger'>Product update failed.</div>";
        header('location: ../auth/welcome.php');
      }  
    
 }
 
}
?>

<?php require_once '../includes/head.php';?>

<main class="login-pag" id="login" style="background-image: url(assets/img/bg.jpg)" >
<div class="container add_product">
    <div class="heading">
		<h2 class="text-center text-white">Update Product</h2>
  </div>
 
 
<form method="post" action="" class="m-auto product" enctype="multipart/form-data">
  <?php if (isset($error)) { ?>
	<p><?php echo $error; ?></p>
  <?php } ?>

        <div class="back">
                <input type="text" name="name" class="form-control " value="<?php echo $name; ?>" placeholder="Enter Product Name" >
            </div> 
                 
              <div class="back">
                <input type="number" name="price" class=" form-control" value="<?php echo $price; ?>" placeholder="Enter Product Price" >
            </div>  
            <div class="back">
                <input type="number" name="quantity" class=" form-control" value="<?php echo $quantity; ?>" placeholder="Enter Product quantity" >
            </div>  
             <div class="back">
                <input type="file" name="Pimage" class=" form-control" value="" required>
            </div> 
            <div class="back">
                <input type="text" name="category_id" class="form-control " value="<?php echo $category_id; ?>">
            </div> 
            <div class="">
                <textarea name="description" class="form-control  input" placeholder="Enter Product Description" ><?php echo $description; ?></textarea>
            </div>        
		     <div>
         <input type="hidden" name="id" value="<?php echo $id?>">
         <input type="submit" name="submit"  class="btn butt btn-block" value="Update Product">
         </div>
	 </form>
 
 </div>
 </main?
 <?php
require('foot.php');
?>