<?php require('../Connection/iBerkat.php'); 

session_start();

$stationCode = $_GET['stationCode'];
$month = $_GET['month'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay , attendance.month, employeeData.employeeStatus FROM 

  ((attendance 

  INNER JOIN employeeData ON attendance.noIC = employeeData.noIC)
  INNER JOIN stationName ON attendance.stationCode = stationName.stationCode)

   WHERE attendance.timeOut IS NOT NULL AND employeeData.employeeStatus NOT LIKE 'dump' AND attendance.stationCode = '$stationCode' AND attendance.month = '$month' GROUP BY attendance.noIC, attendance.month ORDER BY attendance.month ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>
<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <h3><?php echo strtoupper($row_Recordset2['stationName']);?></h3>
              <h5><span class="badge badge-info">Month: <?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></h5>
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Total working days</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="modal" data-target="#viewRiderModal" data-whatever="<?php echo $row_Recordset2['noIC'];?>" data-whatever2="<?php echo $row_Recordset2['month'];?>" class="badge badge-primary" data-dismiss="collapse" role="button" aria-pressed="true"><?php echo strtoupper($row_Recordset2['nama']);?></span></td>	
                <td class="d-sm-inline-flex"><span class="badge badge-warning"><?php echo $row_Recordset2['totalDay'];?></span></td>	
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Total working days</th>
                </tr>
                </tfoot>
              </table>
<?php }else{echo '<span class="badge badge-danger">No rider/SV data were recorded</span>';}?>