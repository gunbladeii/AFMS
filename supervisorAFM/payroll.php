<?php session_start();
require('conn.php');
    $noIC = $_GET['noIC'];
    $month = $_GET['month'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');
    
    
    require('../adminAFM/salaryAlgorithm.php');
    
$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}


$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AFMS | Rider Payment</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../adminAFM/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminAFM/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">

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
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
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
      <img src="../adminAFM/dist/img/altus logo.png" alt="altus Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">AFMS Rider</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
         
       
        <div class="info">
          <a href="#" class="badge badge-primary text-wrap" style="color:white;width: 6rem;"> <i class="nav-icon fas fa-user"></i> <?php echo ucwords(strtolower($row_Recordset['nama']));?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                 Home
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>
                Payslip (Supervisor)
               <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>January</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>February</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Mac</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>April</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>May</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>June</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>July</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>August</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>September</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>October</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>November</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Disember</p>
                </a>
              </li>
            </ul>
          </li>
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
            <h1>Payslip (Supervisor)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Payslip (Supervisor)</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-ship"></i> Altus Freight Management Sdn. Bhd.
                    <small class="float-right">Date: <?php echo date ("d/m/Y")?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>AFM, Sdn. Bhd.</strong><br>
                    Ovul Damansara<br>
                    53200, Kuala Lumpur<br>
                    Phone: (60) 123-5432<br>
                    Email: afm@afm.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo ucwords(strtolower($row_Recordset['nama']));?></strong><br>
                    Email: <?php echo $row_Recordset['username']?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Payslip (Supervisor) #007612</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> <?php echo date ("d/m/Y")?><br>
                  <b>Account:</b> 12345678901234<br>
                  <b>Bank:</b> Maybank Bhd
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Earning</th>
                      <th>(RM)</th>
                      <th>No</th>
                      <th>Deduction</th>
                      <th>(RM)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Basic Salary</td>
                      <td><?php echo $formBasicSalary;?></td>
                      <td>1</td>
                      <td>Penalty</td>
                      <td><?php echo $penalty;?></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Petrol</td>
                      <td><?php echo $formPetrol;?></td>
                      <td>2</td>
                      <td>Advance</td>
                      <td><?php echo $FS['advance'];?></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Handphone</td>
                      <td><?php echo $formHandphone;?></td>
                      <td>3</td>
                      <td>KWSP(EPF)</td>
                      <td><?php echo $epf;?></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Comission</td>
                      <td><?php if($formCommision3 > 0){echo $formCommision3;}else{echo 0;};?></td>
                      <td>4</td>
                      <td>Socso</td>
                      <td><?php echo $socso;?></td>
                    </tr>
                     <tr>
                      <td>5</td>
                      <td>O/T</td>
                      <td></td>
                      <td>5</td>
                      <td>EiS</td>
                      <td><?php echo $eis;?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
           
                  <p class="lead">Amount Due <?php echo date ("d/m/Y")?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Earning:</th>
                        <td>RM<?php echo $totalEarning2;?></td>
                      </tr>
                      <tr>
                        <th style="width:50%">Deduction:</th>
                        <td>RM<?php echo $totalDeduction2;?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>RM<?php echo $grandTotal2;?></td>
                      </tr>
                    </table>
                  </div>
            
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" target="_blank" class="btn btn-primary float-right"><i class="fas fa-print"></i> Print</a>
                  <!--<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Voucher
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </button>-->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- jQuery -->
<script src="../adminAFM/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../adminAFM/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../adminAFM/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../adminAFM/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../adminAFM/dist/js/demo.js"></script>
</body>
</html>
