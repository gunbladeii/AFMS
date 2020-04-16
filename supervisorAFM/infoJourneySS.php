<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $month = $_GET['month'];
    
    $login = $mysqli->query("SELECT * FROM login WHERE noIC = '$noIC'");
    $row_login = mysqli_fetch_assoc($login);
    
    $mem = $mysqli->query("SELECT date,itemCode, fail, (itemCode - fail) as success FROM infoParcel WHERE noIC = '$noIC' AND month = '$month' ORDER BY date DESC");
    $row_mem = mysqli_fetch_assoc($mem);
    $totalRows_mem = mysqli_num_rows($mem);
    
    $b=1;
?>
                  	<table id="example2" class="table table-hover table-responsive">
                    <thead>
                    <tr style="text-align:center">
                    <th colspan="6">
                    <?php echo ucwords(strtolower($row_login['nama']));?>
                    </th>
                    </tr>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Date</th>
                      <th>Received</th>
                      <th>Success</th>
                      <th>Fail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $b++;?></td>
                      <td><?php $dateM = new DateTime($row_mem['date']);echo $dateM->format('d-M-Y');?>
                      </td>
                      <td>
                      <?php if ($row_mem['itemCode'] != NULL){
                      echo '<span class="badge badge-info">'.$row_mem['itemCode'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                      <td>
                      <?php if ($row_mem['success'] != NULL){
                      echo '<span class="badge badge-success">'.$row_mem['success'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                      <td>
                      <?php if ($row_mem['fail'] != NULL){
                      echo '<span class="badge badge-warning">'.$row_mem['fail'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                    </tr>
                    <?php } while ($row_mem = mysqli_fetch_assoc($mem)); ?>
                    </tbody>
                  </table>
        
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
      "autoWidth": true,
    });
  });
</script>
</html>
