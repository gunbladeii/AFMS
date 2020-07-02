<?php require('../Connection/iBerkat.php'); 

session_start();

$stationCode = $_GET['stationCode'];
$month = $_GET['month'];
$year = $_GET['year'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT infoParcel.id, infoParcel.nama, infoParcel.noIC, infoParcel.date AS date, infoParcel.stationCode, stationName.name AS stationName, infoParcel.itemCode, infoParcel.fail, infoParcel.year, infoParcel.month, employeeData.employeeStatus, infoParcel.fail, (infoParcel.itemCode - infoParcel.fail) AS success FROM 

  ((infoParcel 

  INNER JOIN employeeData ON infoParcel.noIC = employeeData.noIC)
  INNER JOIN stationName ON infoParcel.stationCode = stationName.stationCode)

   WHERE infoParcel.itemCode IS NOT NULL AND employeeData.employeeStatus NOT LIKE 'dump' AND infoParcel.stationCode = '$stationCode' AND infoParcel.month = '$month' AND infoParcel.year = '$year'  GROUP BY infoParcel.stationCode, infoParcel.date ORDER BY date DESC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>    
              <h5><span class="badge badge-primary"><?php echo strtoupper($row_Recordset2['stationName']);?></span></h5>
              <table id="examplePerf" class="table table-hover table-responsive">
                <thead>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>id</th>
                  <th>Date</th>
                  <th>Parcel Received</th>
                  <th>Success</th>
                  <th>Undel</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr style="text-align:center">
                <td><?php echo $a++;?></td>	
                <td> <span data-toggle="modal" data-target="#viewRiderModal" data-whatever="<?php echo $row_Recordset2['id'];?>" class="badge badge-primary" data-dismiss="modal" role="button" aria-pressed="true"><?php echo ucwords($row_Recordset2['id']);?></span></td> 

	              <td><?php echo $row_Recordset2['date'];?></td>	
	              <td><span class="badge badge-info"><?php echo $row_Recordset2['itemCode'];?></span></td>
                <td><span class="badge badge-success"><?php echo $row_Recordset2['success'];?></span></td>
                <td><span class="badge badge-danger"><?php echo $row_Recordset2['fail'];?></span></td>
	              
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr style="text-align:center">
                  <th>No.</th>
                  <th>id</th>
                  <th>Date</th>
                  <th>Parcel Received</th>
                  <th>Success</th>
                  <th>Undel</th>
                </tr>
                </tfoot>
              </table>
<?php }else{echo '<span class="badge badge-danger">No infoParcel were recorded</span>';}?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#examplePerf").DataTable();
  });
</script>