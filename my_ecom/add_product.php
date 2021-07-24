<?php
session_start();
 

require_once "../db/config.php";
require_once "../db/function.php";


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../auth/login.php");
  exit;
}
   $sql = "SELECT * FROM products";
   $result = mysqli_query($link, $sql);

   $name = $category_id = $price = $description = $product_image = $quantity = "";
   $name_err = $category_err = $price_err = $description_err = $image_err = $quantity_err = "";
   
if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST"){
     $created_at = date('l dS F\, Y');
     $name = $_POST['name'];
     $user = $_POST['user_id'];
     $category_id = $_POST['category_id'];
     $price = $_POST['price'];
     $quantity = $_POST['quantity'];
     $description = $_POST['description'];
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
             $_SESSION['add'] = "<div class='text-danger'>Your files is too big!</div>";
             header('location: ../auth/welcome.php');
            }
         }else{
           $_SESSION['add'] = "<div class='text-danger'>There was an error uploading your file!</div>";
           header('location: ../auth/welcome.php');
         }
   
       }else{
         $_SESSION['add'] = "<div class='text-danger'>You cannot upload files of this type!.</div>";
         header('location: ../auth/welcome.php');
       }

       

     $query = " INSERT INTO `products`(`category_id`, `name`, `price`, `quantity`, `Pimage`, `description`, `status`, `created_at`,`user_id`) VALUES ('$category_id','$name','$price','$quantity','$image_destination','$description','1','$created_at','$user')";

        if(mysqli_query($link, $query)){
        $_SESSION['add'] = "<div class='text-success'>Product added successfully.</div>";
        header('location: ../auth/welcome.php');
      }else{
        $_SESSION['add'] = "<div class='text-danger'>Product failed to add.</div>";
        header('location: ../auth/welcome.php');
   } 
  
  
  }  


?>

<?php require_once '../includes/head.php';?>
<main class="login-pag" id="login" style="background-image: url(assets/img/bg.jpg)" >
<div class="container add_product">
    <div class="heading">
		<h2 class="text-center text-white">Add Product</h2>
  </div>
 
 
	<form method="POST" action="add_product.php" class="m-auto product" enctype="multipart/form-data">
        
        <div class="back">
                <input type="text" name="name" class="form-control " value="<?php echo $name; ?>" placeholder="Enter Product Name" <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>>
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div> 
                 
              <div class="back">
                <input type="number" name="price" class=" form-control" value="<?php echo $price; ?>" placeholder="Enter Product Price" <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>>
                <span class="invalid-feedback"><?php echo $price_err; ?></span>
            </div>  
            <div class="back">
                <input type="number" name="quantity" class=" form-control" value="<?php echo $quantity; ?>" placeholder="Enter Product quantity" <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>>
                <span class="invalid-feedback"><?php echo $quantity_err; ?></span>
            </div>   
             <div class="back">
                <input type="file" name="Pimage" class=" form-control" value="" required>
                
            </div> 
            <div class="">
            <select name="category_id" class="form-control input mb-3" required>
              <option selected >Select Product Category</option>
              <option value="phone" >Phones</option>
              <option value="Laptop">Laptops</option>
              <option value="Shoe" >Shoes</option>
              <option value="cloth" >Cloths</option>
              <option value="bag">Bags</option>
            </select>
            </div>
            <div class="">
                <textarea name="description" class="form-control  input" placeholder="Enter Product Description" cols="20" rows="6" <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>><?php echo $description; ?></textarea><span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>        
		     <div>
         <input type="submit" name="submit"  class="btn butt btn-block" value="Add Product">
         </div>
	 </form>
 
 </div>
 </main?
 
<?php require_once '../includes/foot.php';?>
