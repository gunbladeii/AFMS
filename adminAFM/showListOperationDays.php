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

$Recordset3 = $mysqli->query("SELECT infoParcel.stationCode,infoParcel.month,infoParcel.year,infoParcel.operationDay,stationName.name AS name FROM infoParcel INNER JOIN stationName ON stationName.stationCode = infoParcel.stationCode GROUP BY stationCode,month,year ORDER BY month, year DESC");
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysqli_num_rows($Recordset3);

$b=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
             //
             <div class="table-responsive">
                   <table id="example6" class="table m-0 table-hover table-sm">
                    <thead>
                    <tr>
                      <th><div class="badge badge-info">No.</div></th>
                      <th><div class="badge badge-info">Station Code</div></th>
                      <th><div class="badge badge-info">Station Name</div></th>
                      <th><div class="badge badge-info">Month</div></th>
                       <th><div class="badge badge-info">Year</div></th>
                      <th><div class="badge badge-info">Operation Days</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr>
                      <td><?php echo $b++;?></td>
                      <td><?php echo $row_Recordset3['stationCode'];?></td>
                      <td><?php echo $row_Recordset3['name'];?></td>
                      <td><?php $month_name = date("F", mktime(0, 0, 0, $row_Recordset3['month'], 10));
                            echo $month_name."\n";?></td>
                      <td><?php echo $row_Recordset3['year'];?></td>
                      <td><?php echo $row_Recordset3['operationDay'];?></td>
                    </tr>
                    <?php }while ($row_Recordset3 = mysqli_fetch_assoc($Recordset3))?>
                    </tbody>
                  </table> 
                </div>
             
<?php }?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example6").DataTable()({
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
