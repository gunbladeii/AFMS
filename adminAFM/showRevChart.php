<?php require('conn.php'); ?>
<?php
session_start();
$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT *,COUNT(noIC) AS totalRider FROM login WHERE role NOT LIKE 'administrator'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$station = $row_Recordset['stationCode'];

$attend = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay , attendance.month FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode GROUP BY attendance.stationCode, attendance.month, attendance.year ORDER BY attendance.month, attendance.nama DESC");
$row_attend = mysqli_fetch_assoc($attend);
$totalRows_attend = mysqli_num_rows($attend);

$attendFor = $row_attend['totalDay'];
$attendFor2 = $row_Recordset['totalRider'];
$attendTo = 26*$attendFor2;
$attendFinal = round(($attendFor/$attendTo)*100,2);
$a=1;
?>
<?php if (!empty($row_attend)) { ?>
	<table id="example4" class="table table-hover table-responsive-sm">
                    <thead class="table-success">
                    <tr style="text-align:center">
                      <th scope="col">No</th>
                      <th scope="col">Month</th>
                      <th scope="col">Revenue</th>
                      <th scope="col">Cost</th>
                      <th scope="col">Profit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php //do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#infoJourney"
                          data-whatever="<?php echo $row_attend['noIC'];?>"  
                          data-whatever2="<?php echo $row_attend['month'];?>"><span class="badge badge-info">In Progress</span></a>
                      </td>
                      <td><span class="badge badge-warning">In Progress</span></td>
                      <td><span class="badge badge-success">In Progress</span></td>
                      <td><span class="badge badge-success">In Progress</span></td>
                    </tr>
                    <?php // } while ($row_attend = mysqli_fetch_assoc($attend)); ?>
                    </tbody>
                  </table>
<?php }else{echo '<div class="badge badge-warning">No data</div>';}?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>