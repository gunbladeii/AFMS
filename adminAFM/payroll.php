<?php require('Connection/iBerkat.php');

session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}


$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);
$a=1;
$d=1;
$e=2;

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('d-m-Y');
$year = date('Y');
$month = date('m');

/*
    $bankQuery = $mysqli->query("SELECT employeeData.noIC, employeeData.stationCode, employeeData.nama, employeeData.codeBank, bankName.bankName, COUNT(attendance.timeOut) AS totalAttend, SUM(infoParcel.itemCode) AS totalParcel, SUM(infoParcel.fail) AS totalFail, SUM(infoParcel.itemCode - infoParcel.fail) AS totalSuccess, attendance.month, attendance.year FROM

     (((employeeData 
					INNER JOIN bankName ON employeeData.codeBank = bankName.codeBank) 
					INNER JOIN infoParcel ON employeeData.noIC = infoParcel.noIC)
					INNER JOIN attendance ON employeeData.noIC = attendance.noIC)			
					WHERE attendance.year='2019' AND attendance.month ='12' GROUP BY infoParcel.noIC,infoParcel.month, infoParcel.year ORDER BY employeeData.nama ASC")
*/
$downloadExcell = $_SERVER['PHP_SELF'];

	if (isset($_POST["download"]))
	{
	$sql = $mysqli->query("SELECT testSalary.role,testSalary.noIC, employeeData.stationCode, employeeData.nama, employeeData.emel,employeeData.codeBank, employeeData.accNum, bankName.bankName, testSalary.totalAttend, testSalary.receieved AS totalParcel, testSalary.fail AS totalFail, testSalary.totalParcel AS totalSuccess, testSalary.month, testSalary.year, employeeData.employeeStatus, testSalary.operationDay,testSalary.avgDel,testSalary.minDel,testSalary.delComm,testSalary.comFee,testSalary.petrol, testSalary.handphone, testSalary.attAllow, testSalary.comission, testSalary.advanced FROM

     (((employeeData 
					INNER JOIN bankName ON employeeData.codeBank = bankName.codeBank) 
					INNER JOIN attendance ON employeeData.noIC = attendance.noIC)
          INNER JOIN testSalary ON employeeData.noIC = testSalary.noIC)			
					WHERE testSalary.year='$year' AND testSalary.month ='$month' AND employeeData.employeeStatus NOT LIKE 'dump' GROUP BY testSalary.noIC,testSalary.month, testSalary.year ORDER BY employeeData.nama ASC"); 					

	if (mysqli_num_rows($sql) > 0)
		{
		$output .='
			<table class="table" border="1">
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>IC</th>
					<th>Poslaju Branch</th>
					<th>PIC/Rider</th>
					<th>Total Parcel (Success)</th>
					<th>Comm</th>
					<th>Fuel</th>
					<th>Phone</th>
					<th>Bank Name</th>
          <th>Bank Code</th>
          <th>Account No</th>
          <th>Branch Operating Days</th>
          <th>No. of Days</th>
          <th>Advance Working Days 1 -15th</th>
          <th>Average Delivery Per Day</th>
          <th>Min Delivery Requirement</th>
          <th>Delivery For Comission</th>
          <th>Commission / Fees</th>
          <th>Fuel</th>
          <th>Phone</th>
          <th>Fix Comission (SV)</th>
          <th>OT</th>
          <th>Delivery Comission</th>
          <th>Refund Bag Deposit</th>
          <th>Attendance</th>
					<th>Gross</th>
					<th>Bag Deposit (RM)</th>
					<th>Advance 15th</th>
          <th>Penalty</th>
          <th>Incomplete POD</th>
          <th>Over Payment</th>
          <th>NOPAY Leave</th>
          <th>EPF Employee</th>
          <th>SOCSO Employee</th>
          <th>EIS Employee</th>
          <th>Total</th>
          <th>EPF Employer</th>
          <th>Socso Employer</th>
          <th>EIS Employer</th>
          <th>HRDF Employer</th>
          <th>Month</th>
          <th>Remarks</th>
					
					
				</tr>		
			';
		while($row = mysqli_fetch_assoc($sql))
			{
			$output .='
				<tr>
					<td>'.$d++.'</td>
					<td>'.ucwords(strtolower($row["nama"])).'</td>
					<td>'.str_replace(' ', '', $row["noIC"]).'</td>
          <td>'.$row["stationCode"].'</td>
          <td>'.$row["role"].'</td>
          <td>'.$row["totalSuccess"].'</td>
          <td>1.50</td>
          <td>100.00</td>
          <td>50.00</td>
          <td>'.$row["bankName"].'</td>
          <td>'.$row["codeBank"].'</td>
          <td>'.str_replace(' ', '', $row["accNum"]).'</td>
          <td>'.$row['operationDay'].'</td>
          <td>'.$row['totalAttend'].'</td>
          <td>=N'.$e.'-O'.$e.'</td>
          <td>=+G'.$e.'-O'.$e.'</td>
          <td>=+(O'.$e.'*30)</td>
          <td>=+G'.$e.'-R'.$e.'</td>
          <td>=ROUND((G'.$e.'*H'.$e.'),2)</td>
          <td>=+ROUND(O'.$e.'/26*I'.$e.',2)</td>
          <td>=+ROUND(O'.$e.'/26*J'.$e.',2)</td>
          <td>'.if($row["role"]=="SS"){echo 2000;}else{echo 0;}.'</td>
          <td>'.if($row["role"]=="SS"){echo "=ROUND((11.5*14.43)+(0*19.23),2)";}else{echo 0;}.'</td>
          <td>'.if($row["role"]=="rider"){echo "=ROUND(((0*9.52)+(0*12.7)),2)";}else{echo 0;}.'</td>
          <td>'.$row['attAllow'].'</td>
          <td>=SUM(T'.$e.':AA'.$e.')</td>
          <td></td>
          <td>=VLOOKUP(D2,"D:\Users\acer\Desktop\Payroll\Advance\16. Apr2020\[APRIL 2020 ADVANCE POS LAJU.xlsx]Summary ADV APRIL 2020"!$D:$N,11,FALSE)</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>=LOOKUP(AR2,"EPF table"!$B$9:$C$754,"EPF table"!$E$9:$E$754)</td>
          <td>=LOOKUP(AS2,"socso table"!$B$9:$C$54,"socso table"!$E$9:$E$54)</td>
          <td>=LOOKUP(AT2,"eis table"!$B$9:$C$54,"eis table"!$E$9:$E$54)</td>
          <td>=AB2-AC2-AD2-AE2-AG2-AH2-AI2-AJ2-AK2-AF2</td>
          <td>=LOOKUP(AR2,"EPF table"!$B$9:$C$754,"EPF table"!$D$9:$D$754)</td>
          <td>=LOOKUP(AS2,"socso table"!$B$9:$C$54,"socso table"!$D$9:$D$54)</td>
          <td>=LOOKUP(AS2,"eis table"!$B$9:$C$54,"eis table"!$D$9:$D$54)</td>
          <td>=+ROUND(AU'.$e.'*0.01,2)</td>
					<td>'.$date.'</td>
          <td></td>
					
				</tr>			
				';		
			}
		$output .='</table>';
		header("Content-Type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=excell_giro_ach_".$date.".xls");
		echo $output;
			
		}
	exit;
	}
	
	//download advance payment
	if (isset($_POST["advanced"]))
	{
	$sql = $mysqli->query("SELECT infoParcel.noIC, employeeData.stationCode, employeeData.nama, employeeData.emel,employeeData.codeBank, employeeData.accNum, bankName.bankName, COUNT(attendance.timeOut) AS totalAttend, SUM(infoParcel.itemCode) AS totalParcel, SUM(infoParcel.fail) AS totalFail, SUM(infoParcel.itemCode - infoParcel.fail) AS totalSuccess, infoParcel.month, infoParcel.year,employeeData.employeeStatus FROM

     (((employeeData 
					INNER JOIN bankName ON employeeData.codeBank = bankName.codeBank) 
					INNER JOIN infoParcel ON employeeData.noIC = infoParcel.noIC)
					INNER JOIN attendance ON employeeData.noIC = attendance.noIC)			
					WHERE infoParcel.year='$year' AND employeeData.employeeStatus NOT LIKE 'dump' AND infoParcel.month ='$month' GROUP BY infoParcel.noIC,infoParcel.month, infoParcel.year ORDER BY employeeData.nama ASC"); 					

	if (mysqli_num_rows($sql) > 0)
		{
		$output .='
			<table class="table" border="1">
				<tr>
					<th>No.</th>
					<th>Record Type</th>
					<th>Invoice Ref.</th>
					<th>Invoice Date</th>
					<th>Invoice Description</th>
					<th>Payee Bank Code</th>
					<th>Payee Account</th>
					<th>Amount</th>
					<th>Email Address</th>
					<th>Customer Ref.(Opt)</th>
					<th>Payment Description(Opt)</th>
					<th>ID. Type</th>
					<th>ID. No.(IC No)</th>
					
					
				</tr>		
			';
		while($row = mysqli_fetch_assoc($sql))
			{
			$output .='
				<tr>
					<td>'.$d++.'</td>
					<td>P</td>
					<td>xxxx-xxxx-xxxx</td>
					<td>'.$date.'</td>
					<td>'.ucwords(strtolower($row["nama"])).'</td>
					<td>'.$row["codeBank"].'</td>
					<td>'.str_replace(' ', '', $row["accNum"]).'</td>
					<td>400</td>
					<td>'.$row['emel'].'</td>
					<td></td>
					<td>Donation</td>
					<td>01</td>
					<td>'.str_replace(' ', '', $row["noIC"]).'</td>
				</tr>			
				';		
			}
		$output .='</table>';
		header("Content-Type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=excell_giro_ach_".$date.".xls");
		echo $output;
			
		}
	exit;
	}

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AFMS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Ahmad Taba
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Parcel damage during delivery...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Ali Ahmad
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Noted..ASAP</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user6-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Mohd Abu
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Balakong Hub succesfull delivered</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Exit -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="../logout.php">
          <i class="far fa-times-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/altus logo.png" alt="altus Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">AFMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="nav-icon fas fa-users-cog"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row_Recordset['nama'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 AFMS Dashboard
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <!--<li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>-->
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Rider Payroll
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="attendance.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                e-Attendance
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
              <span class="badge badge-success navbar-badge">New</span>
            </a>
            <!--<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>-->
          </li>
          <li class="nav-item has-treeview">
            <a href="pod.php" class="nav-link">
              <i class="nav-icon fas fa-flag-checkered"></i>
              <p>
                e-POD
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
              <span class="badge badge-success navbar-badge">New</span>
            </a>
            <!--<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>-->
          </li>
          
          <li class="nav-item has-treeview">
          <a href="registerRider.php" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Registration Form
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
          <a href="setting.php" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Control Panel
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
          <!--
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Tables</p>
                </a>
              </li>
            </ul>
          </li>-->
          <!--
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <!--
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
            -->
            <!--
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/login.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/register.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
            </ul>
          </li>
          -->
          <!--
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
            </ul>
          </li>-->
          <!--
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
          -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payroll Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Staff Payroll</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Click Station Name for Payment Voucher/Payslip</h5>
              <div class="card-description col-12">
                  <form action="<?php echo $downloadExcell; ?>" role="form" method="POST" class="well form-horizontal" name="download" class="download" enctype="multipart/form-data">
              		  			
				      <button type="submit" name='download' value="Export to excel" class="badge badge-warning" id="buttonExcell"><i class="nav-icon fas fa-upload"></i> Eksport Excel Giro Ach</button>
                      <input type="hidden" name="MM_download" value="download">
                  </form>
                  <form action="<?php echo $downloadExcell; ?>" role="form" method="POST" class="well form-horizontal" name="advanced" class="advanced" enctype="multipart/form-data">
              		  			
				      <button type="submit" name='advanced' value="Export to excel" class="badge badge-success" id="buttonExcell"><i class="nav-icon fas fa-upload"></i> Eksport Excel Giro Ach (Advanced Payment)</button>
                  </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
            <div id='show'></div>
            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
   <!--parcelModal-->
<div class="modal fade" id="viewRiderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">View Rider Payment Voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="dash"></div>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- end / parcelModal-->

   <!--parcelModal-->
<div class="modal fade" id="viewStationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">List of Rider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="dash2"></div>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- end / parcelModal-->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
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
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
				$('#show').load('viewPayroll.php')
		});
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $('#viewRiderModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var recipient2 = button.data('whatever2') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'noIC=' + recipient + '&' + 'month=' + recipient2;

            $.ajax({
                type: "GET",
                url: "liveViewPayroll2.php",
                data: dataString, 
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>
<script>
    
    $('#viewStationModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient3 = button.data('whatever3') // Extract info from data-* attributes
          var recipient4 = button.data('whatever4') // Extract info from data-* attributes
          var modal = $(this);
          var dataString2 = 'stationCode=' + recipient3 + '&' + 'month=' + recipient4;

            $.ajax({
                type: "GET",
                url: "liveViewPayroll.php",
                data: dataString2, 
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash2').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>
</body>
</html>
