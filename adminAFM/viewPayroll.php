<?php require('../Connection/iBerkat.php'); 

session_start();

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.year, attendance.stationCode, stationName.name AS stationName, attendance.month FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.timeOut IS NOT NULL GROUP BY attendance.stationCode, attendance.month, attendance.year ORDER BY attendance.month ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <table id="example1" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Station</th>
                  <th>Month</th>
                  <th>Year</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="collapse" data-target="#viewStationModal" data-whatever3="<?php echo $row_Recordset2['stationCode'];?>" data-whatever4="<?php echo $row_Recordset2['month'];?>" class="badge badge-primary" role="button" aria-pressed="true" aria-expanded="false" aria-controls="collapseExample"><?php echo $row_Recordset2['stationName'];?></span></td>
	            <td><span class="badge badge-info"><?php $monthNum  = $row_Recordset2['month'];echo $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));?></span></td>
	             <td><span class="badge badge-info"><?php $year=date_create($row_Recordset2['year']);echo date_format($year,"Y");?></span></td>
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Station</th>
                  <th>Month</th>
                   <th>Year</th>
                </tr>
                </tfoot>
              </table>
<?php }?>
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