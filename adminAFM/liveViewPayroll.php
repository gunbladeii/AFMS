<?php require('../Connection/iBerkat.php'); 

session_start();

$noIC = $_GET['noIC'];
$month = $_GET['month'];
$year = $_GET['year'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT * FROM 

  ((testSalary 

  INNER JOIN employeeData ON testSalary.noIC = employeeData.noIC)
  INNER JOIN stationName ON testSalary.stationCode = stationName.stationCode)

   WHERE testSalary.timeOut IS NOT NULL AND employeeData.employeeStatus NOT LIKE 'dump' AND testSalary.noIC = '$noIC' AND testSalary.month = '$month' AND testSalary.year = '$year' GROUP BY testSalary.noIC, testSalary.month, testSalary.year ORDER BY testSalary.month,testSalary.year ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>
<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <h3><?php echo strtoupper($row_Recordset2['stationName']);?></h3>
              <h5><span class="badge badge-info">Month: <?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></h5>
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Total working days</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="modal" data-target="#viewRiderModal" data-whatever="<?php echo $row_Recordset2['noIC'];?>" data-whatever2="<?php echo $row_Recordset2['month'];?>" class="badge badge-primary" data-dismiss="modal" role="button" aria-pressed="true"><?php echo strtoupper($row_Recordset2['nama']);?></span></td>	
                <td class="d-sm-inline-flex"><span class="badge badge-warning"><?php echo $row_Recordset2['totalDay'];?></span></td>	
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Total working days</th>
                </tr>
                </tfoot>
              </table>
<?php }else{echo '<span class="badge badge-danger">No rider/SV data were recorded</span>';}?>