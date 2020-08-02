<?php require('../Connection/iBerkat.php'); 

session_start();

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("
  SELECT employeeData.employeeStatus,login.noIC,login.role,login.nama,attendance.year, attendance.stationCode, stationName.name AS stationName, attendance.month, attendance.year 
  FROM (((attendance 
  INNER JOIN stationName ON attendance.stationCode = stationName.stationCode)
  INNER JOIN login ON attendance.noIC = login.noIC)
  INNER JOIN employeeData ON attendance.noIC = employeeData.noIC)
  WHERE login.role NOT LIKE 'administrator' AND employeeData.employeeStatus NOT LIKE 'dump'
  GROUP BY attendance.noIC, attendance.month, attendance.year 
  ORDER BY attendance.stationCode, attendance.month, attendance.year ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$Recordset7 = $mysqli->query("SELECT *,MONTHNAME(date) AS monthName FROM infoParcel GROUP BY role,month,year ORDER BY monthName ASC");
$row_Recordset7 = mysqli_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysqli_num_rows($Recordset7);

$z=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
             <div class="table-responsive">
                   <table id="example7" class="table m-0 table-hover table-sm">
                    <thead>
                    <tr>
                      <th><div class="badge badge-info">No.</div></th>
                      <th><div class="badge badge-info">Commission</div></th>
                      <th><div class="badge badge-info">Role</div></th>
                      <th><div class="badge badge-info">Month</div></th>
                      <th><div class="badge badge-info">Year</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr>
                      <td><?php echo $z++;?></td>
                      <td><?php if(!empty($row_Recordset7['commision'])){echo '<div class="badge badge-success">'.$row_Recordset7['commision'].'</div>';}else{echo '<div class="badge badge-warning">Commission not set yet</div>';}?></td>
                      <td><?php if($row_Recordset7['role'] == 'ss'){echo 'Supervisors';}else{echo ucfirst($row_Recordset7['role']);}?></td>
                      <td><?php echo $row_Recordset7['monthName'];?></td>
                      <td><?php echo $row_Recordset7['year'];?></td>
                    </tr>
                    <?php }while ($row_Recordset7 = mysqli_fetch_assoc($Recordset7))?>
                    </tbody>
                  </table> 
                </div> 
             
<?php }?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example7").DataTable()({
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
