<?php require('../Connection/iBerkat.php'); 

session_start();

$stationCode = $_GET['stationCode'];

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.nama, attendance.year, attendance.stationCode, stationName.name AS stationName, attendance.month, attendance.date, attendance.time, attendance.timeOut FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.timeOut IS NULL AND attendance.date = '$date' AND attendance.stationCode = '$stationCode' ORDER BY attendance.stationCode ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>    
              
              <h3><span class="badge badge-primary"><?php echo strtoupper($row_Recordset2['stationName']);?></span></h3>
              <table id="example6" class="table table-hover table-responsive">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Status</th>

                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
                <td><span class="badge badge-primary"><?php echo strtoupper($row_Recordset2['nama']);?></span></td>
                <td><?php echo $date;?></td>	
	              <td><span class="badge badge-danger">Unclock-out</span></td>
	              
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
<?php }else{echo '<span class="badge badge-danger">No attendance were recorded</span>';}?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example6").DataTable();
  });
</script>