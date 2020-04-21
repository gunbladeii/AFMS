<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $noIC2 = $_POST['noIC'];
    	 
    if (isset($_POST['delete'])) {
    	$mysqli->query("UPDATE `employeeData` SET `employeeStatus` = 'dump' WHERE `noIC` = '$noIC2'");
        $mysqli->query("UPDATE `login` SET `role` = 'dump' WHERE `noIC` = '$noIC2'");
    	
    	header("location:registerRider.php");
    }
    
?>
  

     <form method="post" action="deleteStaff.php" role="form">
        <h4>Are you sure to delete this record?</h4>
        <div class="modal-footer">
            <input type="hidden" name="noIC" value="<?php echo $noIC;?>"/>
			<input type="submit" class="btn btn-danger" name="delete" value="Delete"/>&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
      </form>

