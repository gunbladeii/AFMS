<?php require('../Connection/iBerkat.php'); 

session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$station = $mysqli->query("SELECT employeeData.id, login.nama, login.role, login.username AS emel, login.noIC, employeeData.stationCode, employeeData.employeeStatus, stationName.name, login.password FROM ((employeeData 
    
    INNER JOIN login ON employeeData.noIC = login.noIC)
    INNER JOIN stationName ON employeeData.stationCode = stationName.stationCode)
    
    WHERE login.role NOT LIKE 'administrator' AND employeeData.employeeStatus NOT LIKE 'dump'");
$row_station = mysqli_fetch_assoc($station);
$totalRows_station = mysqli_num_rows($station);

$stationC = $mysqli->query("SELECT * FROM login INNER JOIN employeeData ON employeeData.stationCode = stationName.stationCode");
$row_stationC = mysqli_fetch_assoc($stationC);
$totalRows_stationC = mysqli_num_rows($stationC);

$stationName = $row_stationC['name'];

$a=1;

?>
<?php if ($totalRows_station > 0) { ?>
    <h6 class="badge badge-warning">Click rider's name for edit record.</h6>
	<table id="example1" class="table table-hover table-responsive">
                    <thead class="table-info">
                    <tr style="text-align:left">
                      <th scope="col">No</th></th>
                      <th scope="col">Name</th></th>
                      <th scope="col">IC Number</th>
                      <th scope="col">Emel/Username</th>
                      <th scope="col">Password</th>
                      <th scope="col">Role</th>
                      <th scope="col">Station</th>
                      <th scope="col">Code</th>
                      <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:left">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal" data-target="#editStaffModal" data-whatever1="<?php echo $row_station['id'];?>" class="badge badge-light" role="button" aria-pressed="true"><?php echo ucwords(strtolower($row_station['nama']));?></a>
                      </td>
                      <td><?php echo $row_station['noIC'];?></td>
                      <td><?php echo $row_station['emel'];?></td>
                      <td><?php echo $row_station['password'];?></td>
                      <td><?php if($row_station['role'] =='rider'){echo '<h6>Rider</h6>';}elseif($row_station['role'] =='ss'){echo '<h6>Station Supervisor</h6>';}elseif($row_station['role'] =='dump'){echo '<h6>Re-assign</h6>';}else{echo 'Administrator';}?></td>
                      <td><?php echo $row_station['name'];?></td>
                      <td><?php echo $row_station['stationCode'];?></td>
                      <td>
                          <a data-toggle="modal" data-target="#deleteStaffModal" data-whatever2="<?php echo $row_station['noIC'];?>" class="badge badge-danger" role="button" aria-pressed="true" style="color:white">Del</a></td>
                    </tr>
                    <?php } while ($row_station = mysqli_fetch_assoc($station)); ?>
                    </tbody>
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
