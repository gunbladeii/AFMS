<?php require('../Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$year = date('Y');


$Recordset = $mysqli->query("SELECT * FROM employeeData WHERE emel = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);
$stationCode = $row_Recordset['stationCode'];


$joiner = $mysqli->query("SELECT SUM(itemCode) AS totalGet, SUM(fail) AS totalFail FROM infoParcel WHERE role = 'rider' AND stationCode = '$stationCode' AND year = '$year' GROUP BY stationCode,month");
$row_joiner = mysqli_fetch_assoc($joiner);
$totalRows_joiner = mysqli_num_rows($joiner);

$station=$row_joiner['stationCode'];

$a=1;
?>

<?php if ($totalRows_joiner != NULL) { ?>
	
        <canvas id="myChart" style="height: 250px;"></canvas>
        
<?php }else {echo '<button type="button" class="btn btn-danger btn-block btn-flat" data-toggle="modal" data-target="#modal-success"><i class="fas fa-exclamation-triangle"></i> No rider available right now!</button>';}?>

           
