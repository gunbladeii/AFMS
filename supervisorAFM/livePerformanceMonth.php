<?php require('conn.php'); ?>
<?php
session_start();
$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM employeeData WHERE emel = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$station = $row_Recordset['stationCode'];

$attend = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay , attendance.month FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.stationCode = '$station' GROUP BY attendance.noIC, attendance.month, attendance.year ORDER BY attendance.month, attendance.nama DESC");
$row_attend = mysqli_fetch_assoc($attend);
$totalRows_attend = mysqli_num_rows($attend);


$a=1;
?>
<?php if (!empty($row_attend)) { ?>
	<table id="example2" class="table table-hover table-responsive">
                    <thead class="table-warning">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Month</th>
                      <th scope="col">Total Attend</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr>
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#infoJourney"
                          data-whatever="<?php echo $row_attend['noIC'];?>"  
                          data-whatever2="<?php echo $row_attend['month'];?>"><span class="badge badge-info"><?php echo ucwords(strtolower($row_attend['nama']));?></span></a>
                      </td>
                      <td><span class="badge badge-warning"><?php $date=date_create($row_attend['date']);echo date_format($date,"F");?></span></td>
                      <td><span class="badge badge-success"><?php echo $row_attend['totalDay'];?></span></td>
                    </tr>
                    <?php } while ($row_attend = mysqli_fetch_assoc($attend)); ?>
                    </tbody>
                  </table>
<?php }?>
