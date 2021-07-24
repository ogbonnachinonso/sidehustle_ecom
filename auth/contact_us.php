<?php
// Initialize the session
session_start();
require('config.php');
require('function.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_GET['type']) && $_GET['type']!=''){
  $type=get_safe_value($link, $_GET['type']);
   
  if($type=='delete'){
    $id = get_safe_value($link, $_GET['id']);
    $delete_sql = "DELETE FROM contact_us  where id='$id' ";
    mysqli_query($link, $delete_sql );
  }
}

$sql = "SELECT * FROM contact_us ";
  $result = mysqli_query($link, $sql);


?>
<?php
require('top.php');
?>

<div class="wrapper mt-5 cat">

  <div class="row">
    <div class="col-12 col-m-12 col-sm-12">
      <div class="card">
        <div class="card-header ">
          <h3 class="mr-5 ">
            Contact Dashboard
          </h3>
          
          
          <a href="" ><i class="fas fa-ellipsis-h"></i></a>
          
        </div>
  
        <div class="card-content">
          <table>
            <thead>
              <tr>
              <th>#</th>
              <th>Id</th>
			       <th>Name</th>
             <th>Email</th>
             <th>Number</th>
             <th>Message</th>
             <th>Date</th>
              <th><button type="button" class="btn btn-outline-white    btn-rounded btn-sm px-2"><a href="" class="fas fa-pencil-alt mt-0"></a><i></i> </button></th>
              </tr>
            </thead>
            <tbody>
            <?php

           $i = 1;  
           while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
            <td> <?php echo $i; ?> </td>
			      	<td><?php echo $row['id']; ?> </td>
              <td><?php echo $row['name']; ?> </td>
              <td><?php echo $row['email']; ?> </td>
              <td><?php echo $row['phone']; ?> </td>
              <td><?php echo $row['comment']; ?> </td>
              <td><?php echo $row['created_at']; ?> </td>
               <td>
                  <a href="?type=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>&nbsp;
                </td>
              </tr>
            
       <?php $i++; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
   
    <?php
  require('footer.php');
  ?>