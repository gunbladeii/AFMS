<?php require_once('../Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$station=$row_Recordset['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$noIC = $row_Recordset['noIC'];
$parcel = $mysqli->query("SELECT * FROM infoParcel WHERE date = '$date' AND noIC = '$noIC'");
$row_parcel = mysqli_fetch_assoc($parcel);
$totalRows_parcel = mysqli_num_rows($parcel);
?>

<?php if ($row_parcel['itemCode'] != NULL) {echo '<span class="badge badge-success">Total Received: '.$row_parcel['itemCode'].' parcel</span>';}else{echo '<span class="badge badge-danger">Waiting Confirmation</span>';}?>
