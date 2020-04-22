<?php require('../Connection/iBerkat.php'); 

session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.year, attendance.stationCode, stationName.name AS stationName, attendance.month, attendance.date, attendance.time, attendance.timeOut, COUNT(attendance.stationCode) AS totalUnclock FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.timeOut IS NULL AND attendance.date = '$date' GROUP BY attendance.stationCode ORDER BY attendance.stationCode ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <table id="example3" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Station</th>
                  <th>Code</th>
                  <th>Total<p class="h6">unclock-out</p></th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="modal" data-target="#" data-whatever3="<?php echo $row_Recordset2['stationCode'];?>" class="badge badge-primary" role="button" aria-pressed="true"><?php echo strtoupper($row_Recordset2['stationName']);?></span></td>
	            <td><span class="badge badge-info"><?php echo $row_Recordset2['stationCode'];?></span></td>
	             <td><span class="badge badge-info"><?php echo $row_Recordset2['totalUnclock'];?></span></td>
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Station</th>
                  <th>Code</th>
                  <th>Total<p class="h6">unclock-out</p></th>
                </tr>
                </tfoot>
              </table>
<?php }?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example3").DataTable();
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