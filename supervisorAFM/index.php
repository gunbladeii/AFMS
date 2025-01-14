<?php require('../Connection/iBerkat.php'); ?>
<?php
session_start();
if ($_SESSION['role'] != 'ss' && $_SESSION['role'] != 'Senior Courier')
{
      header('Location:../index.php');
}

?>
<?php 
 
$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}

$Recordset = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.riderFacePic, login.username FROM login INNER JOIN employeeData ON employeeData.noIC = login.noIC WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);


$joiner = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.emel, stationName.name AS stationName, stationName.stationCode FROM employeeData INNER JOIN stationName ON employeeData.stationCode = stationName.stationCode WHERE emel = '$colname_Recordset'");
$row_joiner = mysqli_fetch_assoc($joiner);
$totalRows_joiner = mysqli_num_rows($joiner);

$station=$row_joiner['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$month = date('m');

$Recordset3 = $mysqli->query("SELECT name FROM stationName WHERE stationCode = '$station' ");
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysqli_num_rows($Recordset3);
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AFMS | SUPERVISOR PAGE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../adminAFM/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../adminAFM/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../adminAFM/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../adminAFM/plugins/toastr/toastr.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../adminAFM/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../adminAFM/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminAFM/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../adminAFM/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../adminAFM/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../adminAFM/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- chart.js plugin -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  
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
              <img src="../adminAFM/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Ahmad Taba
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Please check your payroll for this month</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminAFM/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="../adminAFM/dist/img/user6-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Mohd Abu
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Mr. Sabu attend for emergency call</p>
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
            <i class="fas fa-users mr-2"></i> 8 confirmation jobs
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
      <img src="../adminAFM/dist/img/altus logo.png" alt="altus Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">AFMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($row_Recordset['riderFacePic']);?>" style="max-width:100%"/>
        </div>
        <div class="info">
          <a href="index.php" class="badge badge-primary text-wrap" style="color:white;width: 6rem;"><?php echo ucwords($row_Recordset['nama']);?></a>
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
                 -SUPERVISOR SECTION-
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
            </ul>
          </li>
          <li class="nav-item">
            <a href="register.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Rider Registration
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="riderPerformance.php" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Rider Performance
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="backup.php" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Data Backup
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="payroll.php?noIC=<?php echo $row_joiner['noIC']?>&month=<?php echo $month?>" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                e-Payroll
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Generate Report
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome <?php echo ucwords(strtolower($row_Recordset['nama']));?></h1>
            <span class="badge badge-primary">Today is <?php $dateM = new DateTime($date);echo $dateM->format('l').' ('.$dateM->format('d-M-Y').')';?></span>
            <h6><span class="badge badge-success"><?php echo ucwords(strtolower($row_joiner['stationName']));?> Station</span></h6>
            <h6><span class="badge badge-warning">Your IP address: <?php print $_SERVER['REMOTE_ADDR'];?></span></h6>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">SUPERVISOR Section</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
     <div class="modal fade" id="parcelModal">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Add item parcel to rider</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="dash">
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
      <div class="modal fade" id="parcelModalSS">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Add item parcel to rider</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="dash2">
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
          <div class="row">
        <!-- row -->
        
        <div class="col-12 col-sm-6 col-md-4">
        <div id="show2"></div>
        </div>
        <!-- /.col -->
        
        <div class="col-12 col-sm-6 col-md-4">
        <div id="show3"></div>
        </div>
        <!-- /.col -->
        
        <div class="col-12 col-sm-6 col-md-4">
        <div id="show4"></div>
        </div>
        <!-- /.col -->
        
        </div>
        <!-- /.row -->
        
        <div class="row">
            
        <div class="col-12 col-sm-6 col-md-6">
        <a href="attendance.php">
        <div class="info-box bg-light">
         <span class="info-box-icon bg-gradient-warning"><i class="fas fa-user-clock"></i></span>
           <div class="info-box-content">
             <span class="info-box-text">e-Attendance</span>
             <span class="info-box-number"><div id="show5"></div></span>
         <!-- The progress section is optional -->
         <div class="progress">
         <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 0%"></div>
         </div>
         <span class="progress-description"><div id="show6"></div></span>
        </div>
        <!-- /.info-box-content -->
        </div></a>
        <!-- /.info-box -->
       </div>
       <!-- /.col -->
       
       <div class="col-12 col-sm-6 col-md-6">
        <a data-toggle="modal" data-target="#parcelModalSS" data-whatever3="<?php echo $row_joiner['noIC'];?>" data-whatever4="<?php echo $date;?>">
        <div class="info-box bg-light">
         <span class="info-box-icon bg-gradient-primary"><i class="fas fa-clipboard"></i></span>
           <div class="info-box-content">
             <span class="info-box-text">Parcel Record (SS)</span>
             <span class="info-box-number badge badge-warning">Click here for update</span>
         <!-- The progress section is optional -->
         <div class="progress">
         <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 0%"></div>
         </div>
         <span class="progress-description"><div id="show7"></div></span>
        </div>
        <!-- /.info-box-content -->
        </div></a>
        <!-- /.info-box -->
       </div>
       <!-- /.col -->
            
            
        </div>
        <!-- /.row -->
         
        <div class="row">
          <div class="col-md-12">
            <div class="row">
        <div class="col-md-6">
           <!-- TABLE: list of rider -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Rider Attendance Status</h3>
                <h2 class="card-title" style="font-size:14px;">(As of <?php echo $date.' '.$time;?>)</h2>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                    <div id="show"></div>
                  </div>
                <!-- /.table-responsive -->
              </div>
              </div>
              </div>
              
            <div class="col-md-6"> 
              <!-- TABLE: parcel delivery rider -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Parcel Delivery Status</h3>
                <h2 class="card-title" style="font-size:14px;">(As of <?php echo $date.' '.$time;?>)</h2>
              <!-- /.card-body -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <div id="parcel"></div>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="https://iberkat.my/AFM">AFM Sdn. Bhd</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0-beta.1
    </div>
  </footer>

  
</div>
<!-- ./wrapper -->     

<!-- jQuery -->
<script src="../adminAFM/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../adminAFM/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../adminAFM/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="../adminAFM/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../adminAFM/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../adminAFM/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../adminAFM/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="../adminAFM/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../adminAFM/plugins/moment/moment.min.js"></script>
<script src="../adminAFM/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../adminAFM/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../adminAFM/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../adminAFM/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="../adminAFM/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../adminAFM/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../adminAFM/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../adminAFM/dist/js/demo.js"></script>
<!-- jQuery Mapael -->
<script src="../adminAFM/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../adminAFM/plugins/raphael/raphael.min.js"></script>
<script src="../adminAFM/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../adminAFM/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<script type="text/javascript" src="//s.trackingmore.com/plugins/v1/buttonCurrent.js"></script>
<!-- SweetAlert2 -->
<script src="../adminAFM/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../adminAFM/plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="../adminAFM/plugins/datatables/jquery.dataTables.js"></script>
<script src="../adminAFM/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Live DataTables -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/api/row().show().js"></script>
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
			setInterval(function () {
				$('#show').load('liveAttendance.php')
				$('#parcel').load('liveParcel.php')
				$('#attStat').load('attStat.php')
				$('#parcelStat').load('parcelStat.php')
				$('#show2').load('totalRider.php')
				$('#show3').load('totalSuccess.php')
				$('#show4').load('totalFail.php')
				$('#show5').load('../riderAFM/liveStatusPunch.php')
				$('#show6').load('../riderAFM/liveAttendStatus.php')
				$('#show7').load('../riderAFM/liveReceive.php')
				$('#showPerformance').load('livePerformanceMonth.php')
			}, 3000);
		});
</script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $('#parcelModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var recipient2 = button.data('whatever2') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'noIC=' + recipient + '&' + 'date=' + recipient2;

            $.ajax({
                type: "GET",
                url: "editdata.php",
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
    $('#parcelModalSS').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient3 = button.data('whatever3') // Extract info from data-* attributes
          var recipient4 = button.data('whatever4') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'noIC=' + recipient3 + '&' + 'date=' + recipient4;

            $.ajax({
                type: "GET",
                url: "editdataSS.php",
                data: dataString,
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
