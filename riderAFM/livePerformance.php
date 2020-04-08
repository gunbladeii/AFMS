<?php require('../Connection/iBerkat.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$noIC = $row_Recordset['noIC'];

$query_parcel2 = $mysqli->query("SELECT *,(itemCode - fail) AS success, (itemCode - fail)/itemCode * 100 AS percent FROM infoParcel WHERE noIC = '$noIC' ORDER BY date DESC LIMIT 10");
$mem2 = mysqli_fetch_assoc($query_parcel2);
$totalRows_parcel2 = mysqli_num_rows($query_parcel2);

$a=1;
?>
<div class="col-sm-12">
<?php if (!empty($mem2['date'])){?>
            <div class="table-responsive">
                  <table id="example2" class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Date</th>
                      <th>Total Parcel</th>
                      <th>Success</th>
                      <th>Undel</th>
                      <th>(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr style="text-align:center">
                      <td><a href="#"><?php echo $a++;?></a></td>
                      <td><?php $dateM = new DateTime($mem2['date']);
                                echo $dateM->format('d/m/y').'</br>('.$dateM->format('D').')';?></td>
                      <td><?php if (!empty($mem2['itemCode'])){echo '<span class="badge badge-info">'.$mem2['itemCode'].'</span>';}else{echo '<span class="badge badge-info">No data</span>';}?></td>
                      <td><?php if (!empty($mem2['success'])&& $mem2['fail'] != NULL){echo '<span class="badge badge-success">'.$mem2['success'].'</span>';}else{echo '<span class="badge badge-success">No data</span>';}?></td>
                      <td><?php if (!empty($mem2['fail'])){echo '<span class="badge badge-danger">'.$mem2['fail'].'</span>';}else{echo '<span class="badge badge-danger">No data</span>';}?></td>
                       <td><span class="badge badge-warning"><?php echo round($mem2['percent'],2).'%';?></span></td>
                    </tr>
                    <?php } while ($mem2 = mysqli_fetch_assoc($query_parcel2)); ?>
                    </tbody>
                  </table>
                </div>
<?php } else {echo '<div><span class="badge badge-danger">No data yet</span></div>';}?>
</div>
<!-- DataTables -->
<script src="../adminAFM/plugins/datatables/jquery.dataTables.js"></script>
<script src="../adminAFM/plugins/datatables/dataTables.bootstrap4.js"></script>
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