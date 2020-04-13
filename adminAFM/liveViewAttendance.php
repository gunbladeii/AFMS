<?php require('../Connection/iBerkat.php'); 

session_start();

$noIC = $_GET['noIC'];
$month = $_GET['month'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, attendance.time, attendance.timeOut AS totalDay , attendance.month, employeeData.employeeStatus FROM 

  ((attendance 

  INNER JOIN employeeData ON attendance.noIC = employeeData.noIC)
  INNER JOIN stationName ON attendance.stationCode = stationName.stationCode)

   WHERE attendance.timeOut IS NOT NULL AND employeeData.employeeStatus NOT LIKE 'dump' AND attendance.noIC = '$noIC' ORDER BY attendance.date ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>id</th>
                  <th>Date</th>
                  <th>Clock-in</th>
                  <th>Clock-out</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr style="text-align:center">
                <td><?php echo $a++;?></td>	
                <td> <span data-toggle="modal" data-target="#viewRiderModal" data-whatever="<?php echo $row_Recordset2['id'];?>" class="badge badge-primary" role="button" aria-pressed="true"><?php echo ucwords($row_Recordset2['id']);?></span></td> 

	              <td><?php echo $row_Recordset2['date'];?></td>	
	              <td><?php echo $row_Recordset2['time'];?></td>
	              <td><span class="badge badge-info"><?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></td>
                <td class="d-sm-inline-flex"><span class="badge badge-warning"><?php echo $row_Recordset2['totalDay'];?></span></td>	
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>id</th>
                  <th>Date</th>
                  <th>Clock-in</th>
                  <th>Clock-out</th>
                </tr>
                </tfoot>
              </table>
<?php }?>