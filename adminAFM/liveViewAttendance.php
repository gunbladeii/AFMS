<?php require('../Connection/iBerkat.php'); 

session_start();

$noIC = $_GET['noIC'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.id, attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, attendance.time, attendance.timeOut, attendance.month, employeeData.employeeStatus FROM 

  ((attendance 

  INNER JOIN employeeData ON attendance.noIC = employeeData.noIC)
  INNER JOIN stationName ON attendance.stationCode = stationName.stationCode)

   WHERE attendance.timeOut IS NOT NULL AND employeeData.employeeStatus NOT LIKE 'dump' AND attendance.noIC = '$noIC' ORDER BY date DESC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>    
              <h3><?php echo strtoupper($row_Recordset2['nama']);?></h3>
              <h5><span class="badge badge-primary"><?php echo strtoupper($row_Recordset2['stationName']);?></span></h5>
              <table id="example1" class="table table-hover table-responsive-xl">
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
                <td><?php echo $row_Recordset2['timeOut'];?></td>
	              
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
<?php }else{echo '<span class="badge badge-danger">No attendance were recorded</span>';}?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>