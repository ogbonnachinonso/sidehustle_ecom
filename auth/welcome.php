<?php
// Initialize the session
session_start();

require_once "../db/config.php";
require_once "../db/function.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_GET['type']) && $_GET['type']!=''){
  $type=get_safe_value($link, $_GET['type']);
   if($type=='status'){
    $operation=get_safe_value($link, $_GET['operation']);
    $id = get_safe_value($link, $_GET['id']);
      if($operation =='active'){
      $status='1';
     }else{
      $status='0';
    }
    $update_status_sql = "UPDATE products SET status='$status' where id='$id' ";
    mysqli_query($link, $update_status_sql);
  }
  if($type=='delete'){
    $id = get_safe_value($link, $_GET['id']);
    $delete_sql = "DELETE FROM products  where id='$id' ";
    
    mysqli_query($link, $delete_sql );
  }
}



$query = "SELECT * FROM `products` WHERE 1  ";
   $res = mysqli_query($link, $query);

?>
<?php
require_once "top.php";
?>

<div class="wrapper mt-5">
<div>
  <a href="../my_ecom/add_product.php" class="btn btn-primary" >Add Product</a>     
</div>

<?php
     if(isset($_SESSION['add'])){
       echo $_SESSION['add'];
       unset($_SESSION['add']);
    }
     if(isset($_SESSION['delete'])){
       echo $_SESSION['delete'];
       unset($_SESSION['delete']);
    }

    if(isset($_SESSION['update'])){
      echo $_SESSION['update'];
       unset($_SESSION['update']);
    }
    ?>
  <div class="row">
    <div class="col-12 col-m-12 col-sm-12">
      <div class="card">
        <div class="card-header  ">
          <h3 class="mr-5">
            Product Dashboard
          </h3>
          <a href="../my_ecom/add_product.php" ><i class="fas fa-ellipsis-h"></i></a>
          
        </div>
    
        <div class="card-content m-auto">
          <table>
            <thead>
              <tr>
              <th>#</th>
              <th>ID</th>
			       <th>CATEGORY</th>
              <th>NAME</th>
             <th>PRICE</th>
             <th>IMAGE</th>
             <th>QUANTITY</th>
              <th>DATE</th>
             <th>STATUS</th>
			
                <th><button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><a href=""
                      class="fas fa-pencil-alt mt-0"></a>
                    <i></i> </button></th>
                    <th><button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><a href=""
                      class="fas fa-pencil-alt mt-0"></a>
                    <i></i> </button></th>
              </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
             while ($row = mysqli_fetch_assoc($res)){ ?> 
           
            <tr>
            <td><?php echo $i; ?> </td>
            <td><?php echo $row['id']; ?> </td>
            <td><?php echo $row['category_id']; ?> </td>
            <td><?php echo $row['name']; ?> </td>
            <td><?php echo $row['price']; ?> </td>
            <td><?php echo"<img src=".$row['Pimage']." class='img card-img'>";?></td>
            <td><?php echo $row['quantity']; ?> </td>
            <td><?php echo $row['created_at']; ?> </td>
            <td>
              <?php 
               if($row['status'] == 1){
                echo "<a href='?type=status&operation=deactive&id=".$row['id']."' class='btn btn-success'>Active</a>&nbsp;";
               }else{
                echo "<a href='?type=status&operation=active&id=".$row['id']."' class='btn btn-warning'>Deactive</a>&nbsp;";
               }
              ?> 
              </td>
              <td>
                  <i class='btn-success'></i>
                  <a href="../my_ecom/update_product.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                  </td>
                  <td>
                  <a href="?type=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
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
 require_once "../my_ecom/foot.php";
  ?>