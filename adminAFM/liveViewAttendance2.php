<?php session_start();?>
<?php
    require('conn.php');
    $id = $_GET['id'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');
    
  $Recordset2 = $mysqli->query("SELECT attendance.id, attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, attendance.time, attendance.timeOut, attendance.month, employeeData.employeeStatus FROM 

  ((attendance 

  INNER JOIN employeeData ON attendance.noIC = employeeData.noIC)
  INNER JOIN stationName ON attendance.stationCode = stationName.stationCode)

   WHERE attendance.timeOut IS NOT NULL AND employeeData.employeeStatus NOT LIKE 'dump' AND attendance.id = '$id' ORDER BY date DESC");
$ED = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

?>

<!--start if employeeStatus!='temp'-->

<form method="post" action="liveViewAttendance2.php" role="form" enctype="multipart/form-data">

       <!--BEGIN CLASS tab-pane-->
        <div class="form-group">
          <div class="input-group mb-3">
          <input type="text" name="id" class="form-control" id="validationDefault01" value="<?php echo $ED['id'];?>" readonly>
          <div class="input-group-append input-group-text">
              <span class="fas fa-id-card-alt"></span>
          </div>
         </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama" id="validationDefault02" value="<?php echo ucfirst($ED['nama']);?>" readonly>
          <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
          </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3"> 
          <input type="text" name="date" class="form-control" id="validationDefault03" value="<?php echo $ED['date'];?>" readonly>
          <div class="input-group-append input-group-text">
              <span class="fas fa-calendar-alt"></span>
          </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3"> 
          <input type="text" name="time" class="form-control" placeholder="Clock-In(HH:MM:SS)" id="validationDefault04" value="<?php echo $ED['time'];?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-user-clock"></span>
          </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3"> 
          <input type="text" name="timeOut" class="form-control" placeholder="Clock-Out(HH:MM:SS)" id="validationDefault04" value="<?php echo $ED['timeOut'];?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-user-clock"></span>
          </div>
          </div>
        </div>
        
        <input type="hidden" name="terms" value="agree"/>
        <div class="modal-footer">
         <input type="submit" class="btn btn-primary" name="submit" value="Edit User Record"/>&nbsp;
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
<script>  
$(document).ready(function(){  
      $('#submit').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
           
           var image_name2 = $('#image2').val();  
           if(image_name2 == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image2').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image2').val('');  
                     return false;  
                }  
           } 
           
           var image_name3 = $('#image3').val();  
           if(image_name3 == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image3').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image3').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
  $(function() {
     'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
   }, false); 
      
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });  
      
      
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 10000
    });

    $('#swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Registration Succesfull.Thank you'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('#toastrDefaultSuccess').click(function() {
      toastr.success('Registration Succesfull.Thank you.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });

</script>