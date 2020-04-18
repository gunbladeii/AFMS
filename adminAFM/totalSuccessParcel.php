<?php require('Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

date_default_timezone_set("asia/kuala_lumpur");
$date = date('Y-m-d');

$Recordset2 = $mysqli->query("SELECT SUM(itemCode) AS received, SUM(fail) AS fail, date FROM infoParcel WHERE date = '$date' GROUP BY date");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

?>
<?php 
$success = $row_Recordset2['received'] - $row_Recordset2['fail'];
if ($row_Recordset2['fail'] != NULL){echo $success.' / '.$row_Recordset2['received'];}else{echo 0;}?>

