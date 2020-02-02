<?php require('../Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT login.noIC, login.username, login.nama, attendance.stationCode FROM login INNER JOIN attendance ON login.noIC = attendance.noIC WHERE login.username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$stationName = $row_Recordset['stationCode'];


$station = $mysqli->query("SELECT login.nama, login.role, login.username AS emel, login.noIC, attendance.stationCode FROM login INNER JOIN attendance ON attendance.noIC = login.noIC WHERE attendance.stationCode = '$stationName' ORDER BY login.nama ASC");
$row_station = mysqli_fetch_assoc($station);
$totalRows_station = mysqli_num_rows($station);
$a=1;
?>
<?php if ($totalRows_station > 0) { ?>
	<table id="example2" class="table table-hover table-responsive-xl">
                    <thead class="table-info">
                    <tr style="text-align:left">
                      <th scope="col">No</th></th>
                      <th scope="col">File Name</th></th>
                      <th scope="col">Date Backup</th>
                      <th scope="col">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:left">
                      <td><?php echo $a++;?></td>
                      <td><?php echo ucwords(strtolower($row_station['nama']));?>
                      </td>
                      <td><?php echo $row_station['noIC'];?></td>
                      <td><?php echo $row_station['role'];?></td>
                    </tr>
                    <?php } while ($row_station = mysqli_fetch_assoc($station)); ?>
                    </tbody>
                  </table>
<?php }?>
