<?php require('conn.php'); ?>
<?php
session_start();
$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}
//

$month = $_POST['month'];
$year = $_POST['year'];
$b=1;
$downloadExcell = $_SERVER['PHP_SELF'];
/*download overtime SV*/
  if (isset($_POST["performance"]))
  {
  $sql2 = $mysqli->query("SELECT employeeData.employeeStatus, MONTHNAME(testSalary.date) AS monthName, testSalary.month, testSalary.year, testSalary.stationCode, SUM(testSalary.totalParcel) AS totalParcel, SUM(testSalary.fail) AS fail, SUM(testSalary.receieved) AS receieved, stationName.name AS stationName FROM 

    ((testSalary
    INNER JOIN stationName ON testSalary.stationCode = stationName.stationCode)
    INNER JOIN employeeData ON testSalary.noIC = employeeData.noIC)


    WHERE testSalary.year='$year' AND testSalary.month ='$month' AND employeeData.employeeStatus NOT LIKE 'dump' GROUP BY testSalary.stationCode, testSalary.month, testSalary.year ORDER BY testSalary.stationCode, testSalary.month, testSalary.year ASC");          

  if (mysqli_num_rows($sql2) > 0)
    {
    $output .='
      <table class="table" border="1">
        <tr>
          <th>No.</th>
          <th>Station Code</th>
          <th>Station Name</th>
          <th>Total Received</th>
          <th>Success</th>
          <th>Undel</th>
          <th>Month</th>
          <th>Year</th>
          <th>Remark</th>
          
          
        </tr>   
      ';
    while($row2 = mysqli_fetch_assoc($sql2))
      {
      $output .='
        <tr>
          <td>'.$b++.'</td>
          <td>'.$row2["stationCode"].'</td>
          <td>'.$row2["stationName"].'</td>
          <td>'.$row2["receieved"].'</td>
          <td>'.$row2["totalParcel"].'</td>
          <td>'.$row2["fail"].'</td>
          <td>'.$row2["monthName"].'</td>
          <td>'.$row2["year"].'</td>
          <td></td>
          
        </tr>     
        ';    
      }
    $output .='</table>';
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=excell_performance_".$date.".xls");
    echo $output;
      
    }
  exit;
  }
//

$Recordset = $mysqli->query("SELECT *,COUNT(noIC) AS totalRider FROM login WHERE role NOT LIKE 'administrator'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$Recordset2 = $mysqli->query("SELECT * FROM yearReg");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$station = $row_Recordset['stationCode'];

$sql_performance = $mysqli->query("SELECT infoParcel.month,infoParcel.year,infoParcel.date AS date, infoParcel.stationCode, SUM(infoParcel.itemCode) AS totalParcel,SUM(infoParcel.fail) AS fail,SUM(infoParcel.itemCode - infoParcel.fail) AS success,(SUM(infoParcel.itemCode - infoParcel.fail))/(SUM(infoParcel.itemCode))*100 AS perSuccess,stationName.name AS stationName, COUNT(infoParcel.date) AS totalDay , infoParcel.month FROM infoParcel INNER JOIN stationName ON infoParcel.stationCode = stationName.stationCode WHERE infoParcel.itemCode IS NOT NULL GROUP BY infoParcel.stationCode, infoParcel.month, infoParcel.year ORDER BY stationName, infoParcel.month, infoParcel.year DESC");
$performance = mysqli_fetch_assoc($sql_performance);
$totalRows_attend = mysqli_num_rows($sql_performance);

$fail = $performance['fail'];
$success = $performance['success'];
$parcel = $performance['totalParcel'];
$perSuccess = round(($success/$parcel)*100,2);
$a=1;
?>
                    <div class="table-responsive">
                    <form action="<?php echo $downloadExcell; ?>" role="form" method="POST" class="well form-horizontal" name="download" class="download" enctype="multipart/form-data">
                         <table class="table m-0">
                          <thead>
                            <tr>
                              <th>
                                Download performance by month (excel)
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                               <div class="input-group mb-3">
                                     <select name="month" class="custom-select browser-default" required>
                                        <option value="" selected>Pick Month</option>
                                        <option value="01" >January</option>
                                        <option value="02" >Febuary</option>
                                        <option value="03" >March</option>
                                        <option value="04" >April</option>
                                        <option value="05" >May</option>
                                        <option value="06" >June</option>
                                        <option value="07" >July</option>
                                        <option value="08" >August</option>
                                        <option value="09" >September</option>
                                        <option value="10" >October</option>
                                        <option value="11" >November</option>
                                        <option value="12" >Disember</option>
                                     </select>
                                          <div class="input-group-append input-group-text">
                                            <span class="fas fa-calendar-alt"></span>
                                          </div>
                               </div>

                               <div class="input-group mb-3">
                                     <select name="year" class="custom-select browser-default" required>
                                        <option value="" selected>Pick Year</option>
                                     <?php do { ?>
                                        <option value="<?php echo $row_Recordset2['year']?>"><?php echo $row_Recordset2['year']?></option>
                                     <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); ?>
                                     </select>
                                          <div class="input-group-append input-group-text">
                                            <span class="fas fa-calendar-alt"></span>
                                          </div>
                               </div>

                            </td>
                          </tr>
                          </tbody>
                        </table> 
                         <div class="card-footer clearfix">
                         <button type="submit" name='performance' value="Export to excel" class="badge badge-warning" id="buttonExcell"><i class="nav-icon fas fa-upload"></i>Export Excel</button>
                         </div>
                  </form>
                  </div>


<?php if (!empty($performance)) { ?>
  <table id="example3" class="table table-hover table-responsive-sm">
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
                          data-target="#performanceModal"
                          data-whatever="<?php echo $performance['stationCode'];?>"  
                          data-whatever2="<?php echo $performance['month'];?>"
                          data-whatever3="<?php echo $performance['year'];?>"><span class="badge badge-secondary"><?php echo $performance['stationName'];?></span></a>
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
    $("#example3").DataTable();
  });
</script>