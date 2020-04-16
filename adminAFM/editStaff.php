<?php session_start();?>
<?php
    require('conn.php');
    $id = $_GET['id'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');
       /*insert into table login and employeeData*/
         $noIC = $_POST['noIC'];
    	 $nama = $_POST['nama'];
    	 $username = $_POST['username'];/*emel instead*/
    	 
       /*insert into table login*/
    	$employeeID = $_POST['employeeID'];
    	$password = $_POST['password'];
    	$role = $_POST['role'];
    	$terms = $_POST['terms'];
    	
       /*insert into table employeeData*/
    	$sex = $_POST['sex'];
    	$dob = $_POST['dob'];
    	$pob = $_POST['pob'];
    	$nationality = $_POST['nationality'];
    	$race = $_POST['race'];
    	$religion = $_POST['religion'];
    	$marriage = $_POST['marriage'];
    	$childrenNo = $_POST['childrenNo'];
    	$address = $_POST['address'];
    	$noTel = $_POST['noTel'];
    	$lesenNo = $_POST['lesenNo'];
    	$lesenExp = $_POST['lesenExp'];
    	$noPlate = $_POST['noPlate'];
    	$roadtaxNo = $_POST['roadtaxNo'];
    	$vehicleModel = $_POST['vehicleModel'];
    	$vehicleYear = $_POST['vehicleYear'];
    	$pdrmRecordNo = $_POST['pdrmRecordNo'];
    	$caseNo = $_POST['caseNo'];
    	$employeeStatus = $_POST['employeeStatus'];
    	$stationCode = $_POST['stationCode'];
    	$accNum = $_POST['accNum'];
    	$codeBank = $_POST['codeBank'];
    	
    if (isset($_POST['submit'])) {
        $DLPic = addslashes(file_get_contents($_FILES["DLPic"]["tmp_name"]));
    	$riderFaceMotorPic = addslashes(file_get_contents($_FILES["riderFaceMotorPic"]["tmp_name"]));
    	$riderFacePic = addslashes(file_get_contents($_FILES["riderFacePic"]["tmp_name"]));
    	
    	/*add pictue*/
    	
    	$mysqli->query("UPDATE `employeeData` SET `nama` = '$nama', `emel` = '$username', `sex` = '$sex', `dob` = '$dob', `pob`= '$pob', `nationality` = '$nationality', `race` = '$race', `religion` = '$religion', `marriage` = '$marriage', `childrenNo` = '$childrenNo', `address` = '$address', `noTel` = '$noTel', `lesenNo`= '$lesenNo', `lesenExp` = '$lesenExp', `noPlate` ='$noPlate', `roadtaxNo` = '$roadtaxNo', `vehicleModel` = '$vehicleModel', `vehicleYear` = '$vehicleYear', `pdrmRecordNo` = '$pdrmRecordNo', `caseNo` ='$caseNo', `employeeStatus` = '$employeeStatus', `stationCode` = '$stationCode', `accNum` = '$accNum', `codeBank` ='$codeBank', `DLPic` ='$DLPic', `riderFacePic` ='$riderFacePic', `riderFaceMotorPic` = '$riderFaceMotorPic' WHERE `noIC` = '$noIC'");
    	
    	header("location:registerRider.php");
    }
    
    if (isset($_POST['submit'])) {
    	$mysqli->query("UPDATE `login` SET `nama` = '$nama', `username` = '$username', `employeeID` = '$employeeID', `password` = '$password', `role` ='$role', `terms`= '$terms' WHERE `noIC` = '$noIC'");
    	
    	header("location:registerRider.php");
    }
    
    $employeeData = $mysqli->query("SELECT * FROM `employeeData` INNER JOIN `login` ON employeeData.noIC = login.noIC WHERE employeeData.id = '$id'");
    $ED = mysqli_fetch_assoc($employeeData);
    
    $stationCall2 = $mysqli->query("SELECT employeeData.stationCode, stationName.name, employeeData.id, bankName.bankName, employeeData.codeBank FROM ((`employeeData` 
      INNER JOIN `stationName` ON employeeData.stationCode = stationName.stationCode)
      INNER JOIN `bankName` ON employeeData.codeBank = bankName.codeBank) 
      WHERE employeeData.id = '$id'");
    $SC2 = mysqli_fetch_assoc($stationCall2);
    
    $stationCall = $mysqli->query("SELECT * FROM `stationName`");
    $SC = mysqli_fetch_assoc($stationCall);
    
    $stateCall = $mysqli->query("SELECT * FROM `state`");
    $STC = mysqli_fetch_assoc($stateCall);
    
    $bankCall = $mysqli->query("SELECT * FROM `bankName`");
    $BC = mysqli_fetch_assoc($bankCall);
    
    $countryCall = $mysqli->query("SELECT * FROM `countryList`");
    $CC = mysqli_fetch_assoc($countryCall);
    
    $religionCall = $mysqli->query("SELECT * FROM `religion`");
    $RGC = mysqli_fetch_assoc($religionCall);
    
    $raceCall = $mysqli->query("SELECT * FROM `race`");
    $RC = mysqli_fetch_assoc($raceCall);
    
?>
  

<form method="post" action="editStaff.php" role="form" enctype="multipart/form-data">
      
      <div href="#" class="input-group mb-3">
      <img src="data:image/jpeg;base64,<?php echo base64_encode($ED['riderFacePic']);?>" class="brand-image img-circle elevation-5"
           style="opacity: .8">
      </div>

       <button type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#home">Login Registration (Edit)</button>
       <!--BEGIN CLASS tab-pane-->
        <div id="home" class="collapse">
        <h3></h3>
        <div class="form-group">
          <div class="input-group mb-3">
          <input type="text" name="employeeID" class="form-control" placeholder="Employee ID" id="validationDefault01" value="<?php echo $ED['employeeID'];?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-id-card-alt"></span>
          </div>
         </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="nama" id="validationDefault02" value="<?php echo ucfirst($ED['nama']);?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
          </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3"> 
          <input type="email" name="username" class="form-control" placeholder="Email" id="validationDefault03" value="<?php echo $ED['emel'];?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-envelope"></span>
          </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3"> 
          <input type="password" name="password" class="form-control" placeholder="Password" id="validationDefault04" value="<?php echo $ED['password'];?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3">
          <input type="text" name="noIC" class="form-control" placeholder="IC Number" data-inputmask="'mask': ['999999999999']" data-mask id="validationDefault05" value="<?php echo $ED['noIC'];?>" required>
          <div class="input-group-append input-group-text">
              <span class="fas fa-id-card"></span>
          </div>
         </div>
        </div>
        
        <div class="form-group">
         <div class="input-group mb-3">
                    <select name="role" class="custom-select browser-default" required>
                      <option value="">Choose role</option>
                      <?php do {  ?>
                      <option value="<?php echo $ED['role']?>" selected><?php echo ucfirst($ED['role'])?></option>
                      <option value="ss">Station Supervisor</option>
                      <option value="rider">Rider</option>
                      <?php } while ($ED = mysqli_fetch_assoc($employeeData)); $rows = mysqli_num_rows($employeeData);
                      if($rows > 0) {mysqli_data_seek($employeeData, 0);$ED = mysqli_fetch_assoc($employeeData);} ?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-user"></span>
                   </div>
            </div>
        </div>
       </div><h3></h3>
       <!--end class tab-pane -->
       
       <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#menu1">Rider Information (Edit)</button>
       <!--BEGIN CLASS tab-pane-->
        <div id="menu1" class="collapse">
        <h3></h3>
        <div class="form-group">
         <div class="input-group mb-3">
                    <select name="sex" class="custom-select browser-default" required>
                      
                      <option value="">Sex</option>
                      <?php do{?>
                      <option value="<?php echo $ED['sex']?>" selected><?php echo $ED['sex']?></option>
                      <option value="female">Women</option>
                      <?php } while ($ED = mysqli_fetch_assoc($employeeData)); $rows = mysqli_num_rows($employeeData);
                      if($rows > 0) {mysqli_data_seek($employeeData, 0);$ED = mysqli_fetch_assoc($employeeData);} ?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-user"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
            <label>Date of birth:</label>
            <div class="input-group mb-3">
                <input type='text' class="form-control" name="dob" placeholder="Date of birth(dd/mm/yyyy)" data-inputmask="'mask':['99-99-9999']" data-mask id="validationDefault06" value="<?php echo $ED['dob'];?>" required/>
                <div class="input-group-append input-group-text">
                    <span class="fas fa-calendar">
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <input type='text' class="form-control" name="pob" placeholder="Place of birth" id="validationDefault07" value="<?php echo $ED['pob'];?>" required/>
                <div class="input-group-append input-group-text">
                    <span class="fas fa-hospital">
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="nationality" class="custom-select browser-default" required>
                      <option value="">Choose your country</option>
                      <option value="<?php echo $ED['nationality']?>" selected><?php echo $ED['nationality']?></option>
                      <?php do{?>
                      <option value="<?php echo $CC['country'];?>"><?php echo $CC['country'];?></option>
                      <?php }while ($CC = mysqli_fetch_assoc($countryCall))?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="far fa-flag"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="race" class="custom-select browser-default" required>
                      <option value="">Choose your race</option>
                      <option value="<?php echo $ED['race']?>" selected><?php echo ucfirst($ED['race'])?></option>
                      <?php do{?>
                      <option value="<?php echo $RC['raceName'];?>"><?php echo ucwords($RC['raceName']);?></option>
                      <?php }while ($RC = mysqli_fetch_assoc($raceCall))?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-user-friends"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="religion" class="custom-select browser-default" required>
                      <option value="">Choose your religion</option>
                      <option value="<?php echo $ED['religion']?>" selected><?php echo ucfirst($ED['religion'])?></option>
                      <?php do{?>
                      <option value="<?php echo $RGC['religionName'];?>"><?php echo ucwords($RGC['religionName']);?></option>
                      <?php }while ($RGC = mysqli_fetch_assoc($religionCall))?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-praying-hands"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="marriage" class="custom-select browser-default" required>
                      <option value="">Marriage</option>
                      <?php do {?>
                      <option value="<?php echo $ED['marriage']?>" selected><?php echo $ED['marriage']?></option>
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                      <?php } while ($ED = mysqli_fetch_assoc($employeeData)); $rows = mysqli_num_rows($employeeData);
                      if($rows > 0) {mysqli_data_seek($employeeData, 0);$ED = mysqli_fetch_assoc($employeeData);} ?>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-ring"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <input type='number' class="form-control" name="childrenNo" placeholder="No of Children (if any)" value="<?php echo $ED['childenNo'];?>"/>
                <div class="input-group-append input-group-text">
                    <span class="fas fa-child">
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <input type='text' class="form-control" name="address" placeholder="Address" id="validationDefault08" value="<?php echo $ED['address']?>" required/>
                <div class="input-group-append input-group-text">
                    <span class="fas fa-home">
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="noTel" class="form-control" placeholder="Phone Number" data-inputmask="'mask': ['999-9999999 [99] [9]']" data-mask id="validationDefault09" value="<?php echo $ED['noTel']?>" required/>
              <div class="input-group-append input-group-text">
                <span class="fas fa-phone"></span>
              </div>
          </div>
        </div>
        
        
        
        </div><h3></h3> 
        <!--end class tab-pane -->
        
        <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#menu2">Vehicle Info (Edit)</button>
        <!--BEGIN CLASS tab-pane-->
        <div id="menu2" class="collapse">
        <h3></h3>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="lesenNo" class="form-control" placeholder="License Number" data-inputmask="'mask': ['999999999999']" data-mask id="validationDefault10" value="<?php echo $ED['lesenNo']?>" required>
              <div class="input-group-append input-group-text">
                <span class="far fa-id-badge"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
            <label>License exp date:</label>
            <div class="input-group mb-3">
                <input type='text' class="form-control" name="lesenExp" placeholder="License Exp(dd-mm-yyyy)" data-inputmask="'mask': ['99-99-9999']" data-mask id="validationDefault11" value="<?php echo $ED['lesenExp']?>" required>
                <div class="input-group-append input-group-text">
                    <span class="fas fa-calendar">
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="noPlate" class="form-control" placeholder="Plate Number" id="validationDefault12" value="<?php echo $ED['noPlate']?>" required>
              <div class="input-group-append input-group-text">
                <span class="far fa-id-badge"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="roadtaxNo" class="form-control" placeholder="Road Tax Number" value="<?php echo $ED['roadtaxNo']?>" required>
              <div class="input-group-append input-group-text">
                <span class="far fa-id-badge"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="vehicleModel" class="form-control" placeholder="Vehicle Model" id="validationDefault14" value="<?php echo $ED['vehicleModel']?>" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-motorcycle"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <label>Vehicle Year:</label>
           <div class="input-group mb-3">
              <input type="text" name="vehicleYear" class="form-control" placeholder="Vehicle Year" data-inputmask="'mask': ['9999']" data-mask id="validationDefault15" value="<?php echo $ED['vehicleYear']?>" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-calendar"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <label>IC picture front and back:</label>        
           <div class="input-group mb-3">
               <input type="file" name="DLPic" id="image" class="form-control" accept=".pdf" id="validationDefault16" >
              <div class="input-group-append input-group-text">
                <span class="far fa-copy"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <label>User Picture:</label>
           <div class="input-group mb-3">
              <input type="file" name="riderFacePic" id="image2" class="form-control" accept=".pdf" id="validationDefault17">
              <div class="input-group-append input-group-text">
                <span class="fas fa-portrait"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <label>Motorcycle Picture:</label>
           <div class="input-group mb-3">
              <input type="file" name="riderFaceMotorPic" id="image3" class="form-control" accept=".pdf" id="validationDefault18">
              <div class="input-group-append input-group-text">
                <span class="fas fa-image"></span>
              </div>
          </div>
        </div>
        
        </div><h3></h3> 
        <!--end class tab-pane -->
        
        <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#menu3">Account Bank Detail (Edit)</button>
        <!--BEGIN CLASS tab-pane-->
        <div id="menu3" class="collapse">
        <h3></h3> 
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="codeBank" class="custom-select browser-default" required>
                      <option value="">Choose your bank</option>
                      <option value="<?php echo $SC2['codeBank'];?>" selected><?php echo ucwords($SC2['bankName']);?></option>
                      <?php do{?>
                      <option value="<?php echo $BC['codeBank'];?>"><?php echo ucwords($BC['bankName']);?></option>
                      <?php }while ($BC = mysqli_fetch_assoc($bankCall))?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-money-check-alt"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="accNum" class="form-control" placeholder="Account Number" data-inputmask="'mask': ['9999 9999 9999 [9999]']" data-mask id="validationDefault19" value="<?php echo $ED['accNum']?>" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-money-check-alt"></span>
              </div>
          </div>
        </div>
        </div><h3></h3> 
        <!--end class tab-pane -->
        
        <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#menu4">Criminal Record (Edit)</button>
        <!--BEGIN CLASS tab-pane-->
        <div id="menu4" class="collapse">
        <h3></h3> 
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="pdrmRecordNo" class="form-control" placeholder="PDRM Record Number" data-inputmask="'mask': ['9999 9999 9999 [9999]']" data-mask value="<?php echo $ED['pdrmRecordNo']?>" >
              <div class="input-group-append input-group-text">
                <span class="fas fa-file-archive"></span>
              </div>
          </div>
        </div>
        
        <div class="form-group">
           <div class="input-group mb-3">
              <input type="text" name="caseNo" class="form-control" placeholder="Case Number" data-inputmask="'mask': ['9999 9999 9999 [9999]']" value="<?php echo $ED['caseNo']?>" data-mask>
              <div class="input-group-append input-group-text">
                <span class="fas fa-file-archive"></span>
              </div>
          </div>
        </div>
        
        </div><h3></h3> 
        <!--end class tab-pane -->
        
        <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#menu5">Others (Edit)</button>
        <!--BEGIN CLASS tab-pane-->
        <div id="menu5" class="collapse">
        <h3></h3> 
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="employeeStatus" class="custom-select browser-default" required>
                    
                      <option value="">Employee Status</option>
                      
                      <option value="<?php echo $ED['employeeStatus']?>" selected><?php if ($ED['employeeStatus'] == 'temp'){echo 'Temporary';}else{echo 'Permanent';}?></option>
                      <option value="temp">Temporary</option>
                      <option value="permanent">Permanent</option>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-sign-in-alt"></span>
                   </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="stationCode" class="custom-select browser-default" required>
                      <option value="">Choose station</option>
                      <option value="<?php echo $SC2['stationCode']?>" selected><?php echo $SC2['name']?></option>
                      <?php do{?>
                      <option value="<?php echo $SC['stationCode'];?>"><?php echo ucwords($SC['name']);?></option>
                      <?php }while ($SC = mysqli_fetch_assoc($stationCall))?>
                    </select>
                    <div class="input-group-append input-group-text">
                      <span class="fas fa-map-marked-alt"></span>
                   </div>
            </div>
        </div>
        
        </div><h3></h3> 
        <!--end class tab-pane -->
        
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
