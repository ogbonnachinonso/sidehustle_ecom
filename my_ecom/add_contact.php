<?php
session_start();
 

require_once '../db/config.php';
 require_once '../includes/head.php';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../auth/login.php");
  exit;
}
$name =  $email = $phone = $comment = "";
$name_err = $email_err = $phone_err = $comment_err = $cat_err = $msg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $created_at = date('l dS F\, Y');
  // Validate name
   if(empty(trim($_POST["name"]))){
      $name_err = "Please enter a name.";
     } elseif(!preg_match("/^[a-zA-Z ]*$/", trim($_POST["name"]))){
      $name_err = "name can only contain letters.";
    } else{
      $sql = "SELECT id FROM contact_us WHERE name = ?";
      if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_name);
          $param_name = trim($_POST["name"]);
          if(mysqli_stmt_execute($stmt)){
              /* store result */
              mysqli_stmt_store_result($stmt);
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $name_err = "This name is already taken.";
              } else{
                  $name = trim($_POST["name"]);
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
          // Close statement
          mysqli_stmt_close($stmt);
      }
    }
    // Validate email
     if(empty(trim($_POST["email"]))){
     $email_err = "Please enter an email.";
    } elseif(var_dump(!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        
        $email_err = "Invalid email format.";
        
    } else{
    $sql = "SELECT id FROM contact_us WHERE email = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = trim($_POST["email"]);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                $email_err = "This email is already taken.";
            } else{
                $email = trim($_POST["email"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
}
// Validate phone
if(empty(trim($_POST["phone"]))){
    $phone_err = "Please enter a phone number.";
} elseif(!preg_match('/^[0-9+]+$/', trim($_POST["phone"]))){
    $phone_err = "phone number can only contain numbers.";
} else{
    $sql = "SELECT id FROM contact_us WHERE phone = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_phone);
        $param_phone = trim($_POST["phone"]);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                $phone_err = "This phone number is already taken.";
            } else{
                $phone = trim($_POST["phone"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}
// Validate comment
if(empty(trim($_POST["comment"]))){
    $comment_err = "Please enter a Message.";
} elseif(!preg_match("/^[a-zA-Z ]*$/", trim($_POST["comment"]))){
    $comment_err = "Message can only contain letters, numbers, and underscores.";
} else{
    $sql = "SELECT id FROM contact_us WHERE comment = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_comment);
        $param_comment = trim($_POST["comment"]);

        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                $comment_err = "This comment is already taken.";
            } else{
                $comment = trim($_POST["comment"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
}
  // Check input errors before inserting in database
  if(empty($name_err) && empty($email_err) && empty($phone_err)&& empty($comment_err)){

    //   $sql = " INSERT INTO contact_us (name, email, phone, comment,) VALUES (?,?,?,?) ";
      $sql = " INSERT INTO `contact_us`(`name`, `email`, `phone`, `comment`, `created_at`) VALUES ('$name','$email','$phone','$comment','$created_at')";

      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssss", $param_name,$param_email,$param_phone, $param_comment);
          
          // Set parameters
          $param_name = $name;
          $param_email = $email;
          $param_phone = $phone;
          $param_comment = $comment;
    
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Redirect to name page
            
              header("location: add_contact.php?Message sent successfully");
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }
  }
  
  // Close connection
  mysqli_close($link);

}

?>
<main class="login-pag bg-image intro route" id="login hero" style="background-image: url(assets/img/bg.jpg);" >
    <div class="container mt-5 pt-5">
        <h2 class="text-white text-center">Contact Us</h2>
        <p class="text-white">Please fill the Messge Box.</p>

        <?php 
        if(!empty($cat_err)){
            echo '<div class="alert alert-danger">' . $cat_err . '</div>';
        }  
              
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label class="text-white">Name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>    
            <div class="form-group">
                <label class="text-white">Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label class="text-white">Phone Number</label>
                <input type="text" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
            </div>  
            <div class="form-group">
                <label class="text-white">Comment</label>
                <textarea type="text" name="comment" class="form-control <?php echo (!empty($comment_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter your Message" ><?php echo $comment; ?></textarea>
               
                <span class="invalid-feedback"><?php echo $comment_err; ?></span>
            </div>      
            <div class="form-group">
                <input type="submit" class="btn btn-warning text-white m-auto" value="Send Message">
            </div>
        </form>
    </div>
    </main>
    <?php require_once '../includes/foot.php';?>