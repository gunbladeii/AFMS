<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $date = $_GET['date'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
    	$nama = $_POST['nama'];
    	$noIC = $_POST['noIC'];
    	$stationCode = $_POST['stationCode'];
    	$itemCode = $_POST['itemCode'];
    	$date = $_POST['date'];
    	$fail = $_POST['fail'];
    	$mysqli->query("UPDATE `infoParcel` SET `stationCode`='$stationCode', `nama`='$nama', `itemCode` ='$itemCode', `date`='$date', `fail`='$fail' WHERE `noIC` ='$noIC' AND `date`='$date'");
    	header("location:index.php");
    }

    $members = $mysqli->query("SELECT * FROM `attendance` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $mem = mysqli_fetch_assoc($members);
    
    $parcel2 = $mysqli->query("SELECT * FROM `infoParcel` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $parcel = mysqli_fetch_assoc($parcel2);

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>
</head>
<body>
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
		<div class="form-group">
			<input type="hidden" class="form-control" id="stationCode" name="stationCode" value="<?php echo $mem['stationCode'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<input type="hidden" class="form-control" id="date" name="date" value="<?php echo $mem['date'];?>" readonly="true"/>

		</div>
		<div class="form-group">
      <label for="email">Total Item</label>
			<input type="number" class="form-control" id="itemCode" name="itemCode" value="<?php echo $parcel['itemCode'];?>"/>
		</div>
		
		<div class="form-group">
		    <label for="email">Total Undel (Supervisor Verification)</label>
			<input type="text" class="form-control" id="fail" name="fail" value="<?php echo $mem['fail'];?>" />

		</div>
		
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Add Parcel" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>
