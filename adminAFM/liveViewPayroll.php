<?php require('../Connection/iBerkat.php'); 

session_start();

$noIC = $_GET['noIC'];
$month = $_GET['month'];
$year = $_GET['year'];
$noICedit = $_POST['noICedit'];
$ot = $_POST['ot'];
$refundBag = $_POST['refundBag'];
$bagDeposit = $_POST['bagDeposit'];
$penalty = $_POST['penalty'];
$incompletePOD = $_POST['incompletePOD'];
$overPayment = $_POST['overPayment'];
$nopayLeave = $_POST['nopayLeave'];


$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT * FROM 

  (((testSalary 

  INNER JOIN employeeData ON testSalary.noIC = employeeData.noIC)
  INNER JOIN stationName ON testSalary.stationCode = stationName.stationCode)
  INNER JOIN infoParcel ON testSalary.noIC = infoParcel.noIC)

   WHERE testSalary.noIC = '$noIC' AND testSalary.month = '$month' AND testSalary.year = '$year' 
   GROUP BY testSalary.noIC, testSalary.month, testSalary.year ORDER BY testSalary.month,testSalary.year ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

if (isset($_POST['submit'])) {
      $mysqli->query("UPDATE `infoParcel` SET `ot` = '$ot', `refundBag` = '$refundBag', `bagDeposit` = '$bagDeposit', `penalty` = '$penalty', `incompletePOD` ='$incompletePOD', `overPayment`= '$overPayment',`nopayLeave`= '$nopayLeave' WHERE `noICedit` = '$noICedit'");
      
      header("location:payroll.php");
    }

?>
<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <h3><?php echo strtoupper($row_Recordset2['stationName']);?></h3>
              <h5><span class="badge badge-info">Month: <?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></h5>
              <h5><span class="badge badge-info"><?php echo ucwords(strtolower($row_Recordset2['nama']));?></span></h5>
              <h5><span class="badge badge-primary"><?php echo ucwords(strtolower($row_Recordset2['name']));?></span></h5>
              <h5><span class="badge badge-warning"><?php if($row_Recordset2['role'] =='rider'){echo 'Rider';}elseif($row_Recordset2['role'] =='ss'){echo 'Station Supervisor';}elseif($row_Recordset2['role'] =='Temp Riders'){echo 'Temp Riders';}elseif($row_Recordset2['role'] =='Senior Courier'){echo 'Senior Courier';}elseif($row_Recordset2['role'] =='dump'){echo 'Re-assign';}else{echo 'Administrator';}?></span></h5>
              <form action="payroll.php" method="post" name="prosesDaftar" enctype="multipart/form-data">
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <th style="text-align: center" colspan="3">
                  <span class="badge badge-success">Earning</span>
                </th>
                <tr>
                  <th>No.</th>
                  <th>Item</th>
                  <th>Info</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1.</td> 
                    <td>Operation Day</td>
                    <td><?php echo $row_Recordset2['operationDay'];?></td> 
                </tr>
                <tr>
                    <td>2.</td> 
                    <td>Total Attend</td>
                    <td><?php echo $row_Recordset2['totalAttend'];?></td> 
                </tr>
                <tr>
                    <td>3.</td>	
    	              <td>Delivery Commission</td>
                    <td><?php echo round($row_Recordset2['delComm'],2);?></td>	
	              </tr>
                <tr>
                    <td>4.</td> 
                    <td>Comm/Fee</td>
                    <td><?php echo round($row_Recordset2['comFee'],2);?></td> 
                </tr>
                <tr>
                    <td>5.</td> 
                    <td>Fuel</td>
                    <td><?php echo round($row_Recordset2['petrol'],2);?></td> 
                </tr>
                <tr>
                    <td>6.</td> 
                    <td>Phone</td>
                    <td><?php echo round($row_Recordset2['handphone'],2);?></td> 
                </tr>
                <tr>
                    <td>7.</td> 
                    <td>Fix Commission</td>
                    <td><?php echo round($row_Recordset2['comission'],2);?></td> 
                </tr>
                <tr>
                    <td>8.</td> 
                    <td>Overtime</td>
                    <td><input type="number" name="ot" value="<?php echo round($row_Recordset2['ot'],2);?>"></td> 
                </tr>
                <tr>
                    <td>9.</td> 
                    <td>Refund Bag</td>
                    <td><input type="number" name="refundBag" value="<?php echo $row_Recordset2['refundBag'];?>"></td> 
                </tr>
                <tr>
                    <td>10.</td> 
                    <td>Attendance</td>
                    <td><?php echo round($row_Recordset2['attAllow'],2);?></td> 
                </tr>
                </tbody>

                <thead>
                <th style="text-align: center" colspan="3">
                  <span class="badge badge-danger">Deduction</span>
                </th>
                <tr>
                  <th>No.</th>
                  <th>Item</th>
                  <th>Info</th>
                </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>1.</td> 
                    <td>Bag Deposit</td>
                    <td><input type="number" name="bagDeposit" value="<?php echo $row_Recordset2['bagDeposit'];?>"></td> 
                  </tr>

                  <tr>
                    <td>2.</td> 
                    <td>Penalty</td>
                    <td><input type="number" name="penalty" value="<?php echo $row_Recordset2['penalty'];?>"></td> 
                  </tr>

                  <tr>
                    <td>3.</td> 
                    <td>Incomplete POD</td>
                    <td><input type="number" name="incompletePOD" value="<?php echo $row_Recordset2['incompletePOD'];?>"></td> 
                  </tr>

                  <tr>
                    <td>4.</td> 
                    <td>Over Payment</td>
                    <td><input type="number" name="overPayment" value="<?php echo $row_Recordset2['overPayment'];?>"></td> 
                  </tr>

                  <tr>
                    <td>4.</td> 
                    <td>No Pay Leave</td>
                    <td><input type="number" name="nopayLeave" value="<?php echo $row_Recordset2['nopayLeave'];?>"></td> 
                  </tr>
                </tbody>
              </table>
              <input type="hidden" name="noICedit" value="<?php echo $row_Recordset2['noIC'];?>">
              <div class="card-footer clearfix">
                <button type="submit" name="submit" class="btn btn-sm btn-secondary float-right">Update</button>
              </div>
            </form>
<?php }else{echo '<span class="badge badge-danger">No rider/SV data were recorded</span>';}?>