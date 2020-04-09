<?php require('../Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT employeeData.id,login.noIC, login.username, login.password,login.nama, employeeData.stationCode FROM login INNER JOIN employeeData ON login.noIC = employeeData.noIC WHERE login.username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$stationName = $row_Recordset['stationCode'];


$station = $mysqli->query("SELECT login.nama, login.role, login.username AS emel, login.noIC, employeeData.stationCode FROM login INNER JOIN employeeData ON employeeData.noIC = login.noIC WHERE employeeData.stationCode = '$stationName' ORDER BY login.nama ASC");
$row_station = mysqli_fetch_assoc($station);
$totalRows_station = mysqli_num_rows($station);
$a=1;
?>
<?php if ($totalRows_station > 0) { ?>
    <h6 class="badge badge-warning">Click rider's name for edit record.</h6>
	<table id="example2" class="table table-hover table-responsive-xl">
                    <thead class="table-info">
                    <tr style="text-align:left">
                      <th scope="col">No</th></th>
                      <th scope="col">Name</th></th>
                      <th scope="col">IC Number</th>
                      <th scope="col">Emel/Username</th>
                      <th scope="col">Password</th>
                      <th scope="col">Role</th>
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
                      <td><?php echo $row_station['role'];?></td>
                    </tr>
                    <?php } while ($row_station = mysqli_fetch_assoc($station)); ?>
                    </tbody>
                  </table>
<?php }?>
