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

$sql_performance = $mysqli->query("SELECT infoParcel.date AS date, infoParcel.stationCode, SUM(infoParcel.itemCode) AS totalParcel,SUM(infoParcel.fail) AS fail,SUM(infoParcel.itemCode - infoParcel.fail) AS success,(SUM(infoParcel.itemCode - infoParcel.fail))/(SUM(infoParcel.itemCode))*100 AS perSuccess,stationName.name AS stationName, COUNT(infoParcel.date) AS totalDay , infoParcel.month FROM infoParcel INNER JOIN stationName ON infoParcel.stationCode = stationName.stationCode WHERE infoParcel.itemCode IS NOT NULL GROUP BY infoParcel.stationCode, infoParcel.month, infoParcel.year ORDER BY stationName, infoParcel.month, infoParcel.year DESC");
$performance = mysqli_fetch_assoc($sql_performance);
$totalRows_attend = mysqli_num_rows($sql_performance);

$fail = $performance['fail'];
$success = $performance['success'];
$parcel = $performance['totalParcel'];
$perSuccess = round(($success/$parcel)*100,2);
$a=1;
?>
<?php if (!empty($performance)) { ?>
  <table id="example1" class="table table-hover table-responsive-sm">
                    <thead class="table-primary">
                    <tr style="text-align:center">
                      <th scope="col">No</th>
                      <th scope="col">Station</th>
                      <th scope="col">Month</th>
                      <th scope="col">Year</th>
                      <th scope="col">Parcel</th>
                      <th scope="col">Success</th>
                      <th scope="col">Undel</th>
                      <th scope="col">(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#infoJourney"
                          data-whatever="<?php echo $performance['noIC'];?>"  
                          data-whatever2="<?php echo $performance['month'];?>"><span class="badge badge-secondary"><?php echo $performance['stationName'];?></span></a>
                      </td>
                      <td><span class="badge badge-info"><?php $date=date_create($performance['date']);echo date_format($date,"F");?></span></td>
                      <td><span class="badge badge-info"><?php $year=date_create($performance['date']);echo date_format($year,"Y");?></span></td>
                      <td><span class="badge badge-warning"><?php echo $performance['totalParcel'];?></span></td>
                      <td><span class="badge badge-success"><?php echo $performance['success'];?></span></td>
                      <td><span class="badge badge-danger"><?php echo $performance['fail'];?></span></td>
                       <td><?php 
                      if ($performance['perSuccess'] > 50)
                      {
                          echo '<span class="badge badge-success"><i class="fas fa-caret-up"></i> '.round($performance['perSuccess'],2).' %</span>';
                      }
                      else if ($performance['perSuccess'] < 50)
                      {
                          echo '<span class="badge badge-danger"><i class="fas fa-caret-down"></i> '.round($performance['perSuccess'],2).' %</span>';
                      }
                      ?></td>
                    </tr>
                    <?php } while ($performance = mysqli_fetch_assoc($sql_performance)); ?>
                    </tbody>
                  </table>
<?php }else{echo '<div class="badge badge-warning">Your rider did not update any parcel record yet</div>';}?>
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