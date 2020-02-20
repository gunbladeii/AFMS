<?php require('../Connection/iBerkat.php'); 

session_start();

$stationCode = $_GET['stationCode'];
$month = $_GET['month'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay , attendance.month FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.timeOut IS NOT NULL AND attendance.stationCode = '$stationCode' AND attendance.month = '$month' GROUP BY attendance.noIC, attendance.month ORDER BY attendance.month ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>
<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Station</th>
                  <th>Month</th>
                  <th>Total working days</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr style="text-align:center">
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="modal" data-target="#viewRiderModal" data-whatever="<?php echo $row_Recordset2['noIC'];?>" data-whatever2="<?php echo $row_Recordset2['month'];?>" class="badge badge-primary" role="button" aria-pressed="true"><?php echo ucwords($row_Recordset2['nama']);?></span></td>	
	            <td><?php echo $row_Recordset2['stationName'];?></td>
	            <td><span class="badge badge-info"><?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></td>
                <td class="d-sm-inline-flex"><span class="badge badge-warning"><?php echo $row_Recordset2['totalDay'];?></span></td>	
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Station</th>
                  <th>Month</th>
                  <th>Total working days</th>
                </tr>
                </tfoot>
              </table>
<?php }?>