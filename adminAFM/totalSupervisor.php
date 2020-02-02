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

$Recordset2 = $mysqli->query("SELECT count(role) AS supervisor, role FROM login WHERE role = 'ss'");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

?>
<?php 
if ($row_Recordset2['role'] != NULL){echo $row_Recordset2['supervisor'];}else{echo '0';}?>

