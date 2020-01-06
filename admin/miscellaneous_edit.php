<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Miscellaneous
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn_miscellaneous'])){
  		$id = $_POST['edit_id_miscellaneous'];

  		$query = "SELECT * FROM miscellaneous where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="payment_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Miscellaneous Name </label>
                <input type="text" name="edit_miscellaneous_name" value="<?php echo $row['miscellaneous_name']?>" class="form-control" placeholder="Enter Miscellaneous Name">
            </div>
            
            <div class="form-group" style="position: relative;">
                <label>Amount</label>
                <input type="number"  name="edit_amount" value="<?php echo $row['amount']?>"  class="form-control" step=".01" >
                
            </div>
           
            <a href ="payment.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtnMiscellaneous" class="btn btn-primary"> Update </button>
          </form>
            <?php
        }
    }
            ?>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>