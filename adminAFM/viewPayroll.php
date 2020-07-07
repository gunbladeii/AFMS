<?php require('../Connection/iBerkat.php'); 

session_start();

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("
  SELECT login.noIC,login.role,login.nama,attendance.year, attendance.stationCode, stationName.name AS stationName, attendance.month, attendance.year 
  FROM ((attendance 
  INNER JOIN stationName ON attendance.stationCode = stationName.stationCode)
  INNER JOIN login ON attendance.noIC = login.noIC)
  WHERE login.role NOT LIKE 'administrator' AND employeeData.employeeStatus NOT LIKE 'dump'
  GROUP BY attendance.noIC, attendance.month, attendance.year 
  ORDER BY attendance.stationCode, attendance.month, attendance.year ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <table id="example1" class="table table-hover table-responsive-sm">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Station Code</th>
                  <th>Station Name</th>
                  <th>Month</th>
                  <th>Year</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <button type="button" data-toggle="modal" data-target="#viewStationModal" data-whatever3="<?php echo $row_Recordset2['noIC'];?>" data-whatever4="<?php echo $row_Recordset2['month'];?>" data-whatever5="<?php echo $row_Recordset2['year'];?>" class="badge badge-primary" aria-pressed="true" aria-expanded="false" aria-controls="collapseExample" data-dismiss="collapse"><?php echo ucwords(strtolower($row_Recordset2['nama']));?></button></td>

              <td><span class="badge badge-info"><?php if($row_Recordset2['role'] =='rider'){echo 'Rider';}elseif($row_Recordset2['role'] =='ss'){echo 'Station Supervisor';}elseif($row_Recordset2['role'] =='Temp Riders'){echo 'Temp Riders';}elseif($row_Recordset2['role'] =='Senior Courier'){echo 'Senior Courier';}elseif($row_Recordset2['role'] =='dump'){echo 'Re-assign';}else{echo 'Administrator';}?></span></td>

              <td><span class="badge badge-info"><?php echo $row_Recordset2['stationCode'];?></span></td>
              <td><span class="badge badge-info"><?php echo $row_Recordset2['stationName'];?></span></td>
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
    $("#example1").DataTable()({
      "keys": true
    });
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