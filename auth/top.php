
	<!DOCTYPE html>
  <html lang="en">
  
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <title>My Ecom site</title>
  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">  
     <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
     <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
     <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
     <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
     <link href="assets/vendor/aos/aos.css" rel="stylesheet">

      <link rel="stylesheet" href="assets/style.css">
  
  </head>
  
  <body>
  
    <div class="d-flex" id="wrapper">
  
      <!-- Sidebar -->
      <div class=" border-right info" id="sidebar-wrapper">
        <div class="sidebar-heading infoo">
          <div class="logo">
            <a href="">
              <h1 class="mt-5 text-white">SideHustle</h1>
            </a>
          </div> 
           </div>
        <div class="list-group list-group-flush infoo">
          <div>
            <a href="welcome.php" class="list-group-item list-group-item-action infoo">Home</a>
          </div>
          <div>
            <a href="category.php" class="list-group-item list-group-item-action infoo">Category</a>
          </div>
          <div>
            <a href="contact_us.php" class="list-group-item list-group-item-action infoo">Contact_Us</a>
          </div>
          
          <div>
          <a href="reset-password.php" class="list-group-item list-group-item-action infoo">Reset Password</a>
          </div>
          <div>
            <a href="logout.php" class="list-group-item list-group-item-action infoo ">Logout</a>
          </div>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->
  
      <!-- Page Content -->
      <div id="page-content-wrapper">
  
        <nav class="navbar navbar-expand-lg navbar-dark   border-bottom">
          <button class="btn infoo" id="menu-toggle">Menu</button>
  
          <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 ">
              <li class="nav-item">
                <a class="nav-link js-scroll activ" href="../my_ecom/index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll" href="../my_ecom/phone.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll" href="../my_ecom/add_contact.php">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll text-success" href="">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></a></li>
              <li class="nav-item">
              <a href="logout.php" class="nav-link js-scroll ">Logout</a>
              </li>
            </ul>
          </div>
        </nav>
        