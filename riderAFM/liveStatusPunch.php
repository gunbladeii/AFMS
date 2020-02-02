<?php require('../Connection/iBerkat.php'); ?>
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

$attendance = $mysqli->query("SELECT * FROM attendance WHERE date = '$date' AND noIC = '$noIC'");
$row_attendance = mysqli_fetch_assoc($attendance);
$totalRows_attendance = mysqli_num_rows($attendance);
?>

<?php if ($row_attendance['date'] != NULL || $row_attendance['timeOut'] != NULL) {echo '<span class="badge badge-success">Already punch today</span>';}else{echo '<span class="badge badge-danger">Punch Now</span>';}?>



