<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student Requirement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="student_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Student Name </label>
                <input type="hidden" name="student_id" class="form-control" value="<?php  echo $_SESSION["sid"]; ?>" placeholder="Enter Student Name">
                <input type="text" name="student_name" class="form-control" value="<?php  echo $_SESSION["sname"]; ?>" placeholder="Enter Student Name" disabled="">
                  
              
            </div>
            <div class="form-group">
                <label> Student Type </label>
                <input type="text" name="student_type" class="form-control" value="<?php  echo $_SESSION["stype"]; ?>" placeholder="Enter Student Type" disabled="">
                
              
            </div>
            <div class="form-group">
                <label>Requirements</label><br>
                 <?php
         
      
     
      //retrieve records
  
    $stype = "";
      $stype = $_SESSION["stype"];
       $sid = "";
      $sid = $_SESSION["sid"];
   //$_POST['course_description'] = "gago";
    $query = "SELECT * from requirement where type =  '$stype'";
  
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $rid = "";
      $rid = $row['id'];

       $query1 = "SELECT * from student_requirement where requirement_id =  '$rid' and student_id =  '$sid'";
  
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
   
      ?>

                <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="" checked>&nbsp;<?php  echo $row['requirement_name']; ?> <br>


                  <?php 
                
              } else {
                ?>
 <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="">&nbsp;<?php  echo $row['requirement_name']; ?> <br>
                <?php
              }
            }
                ?>
            </div>
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Student Requirement
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="student_requirement.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Student Name" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['student_description'] = "gago";
    $query = "SELECT * FROM student where first_name like  '$search_params%' or middle_name like  '$search_params%' or last_name like  '$search_params%' ";
  } else {
    $query = "SELECT * FROM student";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

    
  </div>

  <div class="card-body">

<?php
  	if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
  		echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['success'].' </h2> ';
  		unset($_SESSION['success']);
  	}

	if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
  		echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['status'].' </h2> ';
  		unset($_SESSION['status']);
  	}

  	?>
    <div class="table-responsive">
    	
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Student Full Name </th>
             <th> Type </th>
              <th>VIEW </th>
            <th>UPDATE </th>
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
     			?>
     			<tr>
            <td> <span id="fullname"><?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; 
            ?></span></td>
             <td> <span id="type"><?php  echo $row['type']; 
             $_SESSION["sname"] = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['suffix']; 
             ?></span></td>
           <td>
                <form action="student_requirement_edit.php" method="POST">
                    <input type="hidden" name="view_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="view_stype" value="<?php echo $row['type']; ?>">
                   <button type="submit" name="view_btn" class="btn btn-primary"> VIEW</button>
                
                </form>
            </td>
            <td>
                <form action="student_requirement_edit.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                  <input type="hidden" name="edit_stype" value="<?php echo $row['type']; ?>">
                  <button type="submit" name="edit_btn" class="btn btn-success"> UPDATE</button>
                </form>
            </td>
          </tr>
     		<?php }
     	} else {
     	echo "No Record Found";
     }

     	?>
          
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>