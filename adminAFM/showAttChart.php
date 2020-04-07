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

$attend = $mysqli->query("SELECT attendance.date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay ,(COUNT(attendance.date)/(26 * (SELECT COUNT(employeeData.noIC) FROM employeeData)))*100 AS percentAtt, attendance.month, attendance.year 

FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode

GROUP BY attendance.stationCode, attendance.month, attendance.year ORDER BY stationName.name, attendance.month, attendance.year DESC");
$row_attend = mysqli_fetch_assoc($attend);
$totalRows_attend = mysqli_num_rows($attend);
$a=1;
?>
<?php if (!empty($row_attend)) { ?>
	<table id="example1" class="table table-hover table-responsive-sm">
                    <thead class="table-warning">
                    <tr style="text-align:center">
                      <th scope="col">No</th>
                      <th scope="col">Station</th>
                      <th scope="col">Month</th>
                      <th scope="col">Year</th>
                      <th scope="col">Performance</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#infoJourney"
                          data-whatever="<?php echo $row_attend['noIC'];?>"  
                          data-whatever2="<?php echo $row_attend['month'];?>"><span class="badge badge-info"><?php echo ucwords(strtolower($row_attend['stationName']));?></span></a>
                      </td>
                      <td><span class="badge badge-warning"><?php $date=date_create($row_attend['date']);echo date_format($date,"F");?></span></td>
                      <td><span class="badge badge-warning"><?php $year=date_create($row_attend['date']);echo date_format($year,"Y");?></span></td>
                      <td><?php 
                      if ($row_attend['percentAtt'] > 50)
                      {
                          echo '<span class="badge badge-success"><i class="fas fa-caret-up"></i> '.round($row_attend['percentAtt'],2).' %</span>';
                      }
                      else if ($row_attend['percentAtt'] < 50)
                      {
                          echo '<span class="badge badge-danger"><i class="fas fa-caret-down"></i> '.round($row_attend['percentAtt'],2).' %</span>';
                      }
                      ?></td>
                    </tr>
                    <?php } while ($row_attend = mysqli_fetch_assoc($attend)); ?>
                    </tbody>
                  </table>
<?php }else{echo '<div class="badge badge-warning">No data</div>';}?>
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