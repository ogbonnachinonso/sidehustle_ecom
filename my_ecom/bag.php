<?php
// Initialize the session
session_start();

require_once "../db/config.php";
require_once "../db/function.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: auth/login.php");
    exit;
}
      $sql = "SELECT * FROM `products` WHERE 1  ";
      $result = mysqli_query($link, $sql);


require_once "../includes/head.php";
?>

<div id="hero shoes" class="intro route bg-image  align-items-center" style="background-image: url(assets/img/bkg.jpg)">
<div class="overlay-itro"></div>

<section id="work" class="gallery-mf sect-pt4 route align-items-center">
    <div class="container ">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box mmp">
            <h3 class="title-a text-white ">
              Our Bags
            </h3>
            <p class="subtitle-a px-4 title-ss text-white">
              Feel free to explore our product list and also look through the categories.
            </p>
            <div class="line-m"></div>
          </div>
        </div>
      </div>
      <div class="row">
<?php 
  
while ($row = mysqli_fetch_assoc($result)){ ?> 
    <?php $check_page = $row['category_id']; 
    if($check_page === 'bag'){?> 
        <div class="col-md-4 ">
          <div class="work-box card">
            
              <div class="work-img">
              <img src="<?php echo $row['Pimage']; ?>" class='img img-fluid card-img'>
              </div>
            </a>
            <div class="work-content">
            
                <div class="col-sm-12">
                  <p class="w-title mt-2 ">Name: <?php echo $row['name']; ?></p>
                <p class="w-title">Price: <i>&#8358;</i> <?php echo $row['price'];?></p>
                </div>
                <div class="col-sm-12 ">
                  <div class="w-like ">
                    <a href="/book" class="btn btn-secondary text-white mt-4 mb-3 ">Order Now</a>
                  </div>
                </div>
             
            </div>
          </div>
        </div>
        
        <?php }?>
     <?php }   ?>
        </div>
      </div>
    

  </section>
  </div>
<?php require_once '../includes/foot.php';?>