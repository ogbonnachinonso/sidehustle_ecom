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

<div id="hero" class="intro route bg-image d-flex align-items-center" style="background-image: url(assets/img/bkg.jpg)">
<div class="overlay-itro"></div>
  <div class="container-fluid" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-8 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h2>Welcome to Eldee E-commerce, we hope to make your experience worthwhile. Feel free to explore our pages.</h2>
        <div><a href="" class="btn-get-started scrollto">Order Now</a></div>
      </div>
      
      <div class="col-xl-4 col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
        <img src="assets/img/shoesz.jpg" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
  </div>

<section id="work" class="gallery-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Our Products
            </h3>
            <p class="subtitle-a px-4 title-ss">
              Feel free to explore our product list and also look through the categories.
            </p>
            <div class="line-m"></div>
          </div>
        </div>
      </div>
      <div class="row">
<?php 
while ($row = mysqli_fetch_assoc($result)){?>



        <div class="col-md-3">
          <div class="work-box">
          
              <div class="work-img">
              <img src="<?php echo $row['Pimage']; ?>" class='img img-fluid card-img'>
              </div>
            </a>
            <div class="work-content">
                <div class="col-sm-12">
                  <p class="w-title mt-2">Name:<?php echo $row['name']; ?></p>
                  <p class="w-title">Price:<i>&#8358;</i> <?php echo $row['price']; ?></p>
                </div>
                <div class="col-sm-12  ">
                  <div class="w-like ">
                    <a href="" class="btn btn-secondary text-white mt-4 mb-3 ">Order Now</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      
     <?php 
     }
             ?>  


        </div>
      </div>
      
  </section>

<?php
require_once '../includes/foot.php';
?>