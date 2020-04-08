<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $date = $_GET['date'];
    
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
    	$nama = $_POST['nama'];
    	$noIC2 = $_POST['noIC'];
    	$stationCode = $_POST['stationCode'];
    	$success = $_POST['success'];
    	$fail = $_POST['fail'];
    	$date2 = $_POST['date'];
    	$mysqli->query("UPDATE `infoParcel` SET `fail` ='$fail' WHERE `noIC` ='$noIC2' AND `date`='$date2'");
    	header("location:profileRider.php");
    }

    $members = $mysqli->query("SELECT * FROM `infoParcel` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $mem = mysqli_fetch_assoc($members);

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>
</head>
<body>
<?php if ($mem['itemCode'] != NULL){?>
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
			<input type="text" class="form-control" id="noIC" name="noIC" value="<?php echo $mem['noIC'];?>" readonly="true"/>

		</div>
		<div class="form-group">
		    <label for="id">Name</label>
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo ucwords(strtolower($mem['nama']));?>"/>
		</div>
	
	
	       <input type="hidden" class="form-control" id="stationCode" name="stationCode" value="<?php echo $mem['stationCode'];?>" readonly="true"/>
			<input type="hidden" class="form-control" id="date" name="date" value="<?php echo $date;?>" readonly="true"/>
			<input type="hidden" class="form-control" id="success" name="success" value="totalSuccess()" readonly="true"/>
			
		<div class="form-group">
      <label for="email">Total Item Not Delivered</label>
			<input type="number" class="form-control" id="fail" name="fail" value="<?php echo $mem['fail'];?>" />
		</div>
		
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Update Data Parcel" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
	<?php }?>
	<?php if ($mem['itemCode'] == NULL){?>
	   <div class="modal-footer">
			<input type="button" class="btn btn-secondary" value="Waiting confirmation parcel list from supervisor!" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	<?php }?>
</body>
</html>
