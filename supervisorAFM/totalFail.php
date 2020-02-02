<?php require('../Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);


$joiner = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.emel, stationName.name AS stationName, stationName.stationCode FROM employeeData INNER JOIN stationName ON employeeData.stationCode = stationName.stationCode WHERE emel = '$colname_Recordset'");
$row_joiner = mysqli_fetch_assoc($joiner);
$totalRows_joiner = mysqli_num_rows($joiner);

$station=$row_joiner['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');

$joiner2 = $mysqli->query("SELECT date,stationCode,SUM(fail) AS fail, (SUM(fail)/SUM(itemCode)) AS perFail FROM infoParcel WHERE stationCode = '$station' AND date = '$date' GROUP BY stationCode, date");
$row_joiner2 = mysqli_fetch_assoc($joiner2);
$totalRows_joiner2 = mysqli_num_rows($joiner2);

$attend = $mysqli->query("SELECT *, COUNT(time) AS totalAttend FROM attendance WHERE stationCode = '$station' AND date = '$date'");
$row_attend = mysqli_fetch_assoc($attend);
$totalRows_attend = mysqli_num_rows($attend);

$perFail2 = $row_joiner2['perFail'];
$perFail = round($perFail2*100,2);
?>
       
       <div class="info-box bg-light">
         <span class="info-box-icon bg-gradient-warning"><i class="far fa-window-close"></i></span>
           <div class="info-box-content">
             <span class="info-box-text">Undel</span>
             <span class="info-box-number"><?php if (!empty($row_joiner2['fail'])){echo $row_joiner2['fail'];}else{echo '<span class="badge badge-danger">No data yet</span>';}?></span>
         <!-- The progress section is optional -->
         <div class="progress">
         <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: <?php echo $perFail;?>%"></div>
         </div>
         <span class="progress-description">
         <?php echo $perFail;?>% parcel undel
         </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
       