<?php session_start();?>
<?php
    require('conn.php');
    $id = $_GET['id'];
    $id2 = $_POST['id'];
    	 
    if (isset($_POST['delete'])) {
    	$mysqli->query("UPDATE `employeeData` SET `employeeStatus` = 'dump' WHERE `id` = '$id2'");
    	
    	header("location:registerRider.php");
    }
    
?>
  

     <form method="post" action="deleteStaff.php" role="form">
        <h4>Are you sure to delete this record?</h4>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
			<input type="submit" class="btn btn-danger" name="delete" value="Delete"/>&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
      </form>

