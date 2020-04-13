<?php
    /*if (isset($_POST['submit'])) {
    	$mysqli->query("INSERT INTO `login` (`noIC`, `nama`, `username`, `employeeID`, `password`, `role`, `terms`) VALUES ('$noIC', '$nama', '$username', '$employeeID', '$password', '$role', '$terms')");
    	
    	header("location:registerRider.php");
    }*/

    $formulaSalary = $mysqli->query("SELECT * FROM `formulaSalary`");
    $FS = mysqli_fetch_assoc($formulaSalary);
    
    $bankCall = $mysqli->query("SELECT employeeData.riderFacePic, employeeData.employeeStatus, employeeData.noIC, employeeData.nama, employeeData.accNum, employeeData.codeBank, bankName.bankName FROM `employeeData` INNER JOIN `bankName` ON bankName.codeBank = employeeData.codeBank WHERE `noIC` = '$noIC'");
    $BC = mysqli_fetch_assoc($bankCall);
    
    $attendanceCall = $mysqli->query("SELECT date, COUNT(date) AS attendNo, month, noIC, time, timeOut FROM `attendance` WHERE `noIC` = '$noIC' AND `month` = '$month' GROUP BY `month`,`year`");
    $AC = mysqli_fetch_assoc($attendanceCall);
    
    $timeCall = $mysqli->query("SELECT * FROM `attendance` WHERE `noIC` = '$noIC' AND `month` = '$month'");
    $TC = mysqli_fetch_assoc($timeCall);
    
    $parcelCall = $mysqli->query("SELECT SUM(itemCode - fail) AS totalParcel, month, noIC FROM `infoParcel` WHERE `noIC` = '$noIC' AND `month` = '$month' GROUP BY `month`, `year`");
    $PC = mysqli_fetch_assoc($parcelCall);
    
    /*kira basic salary*/
    $basic=$FS['basicSalary'];
    $totalAttend=$AC['attendNo'];
    $formBasicSalary= round($basic * ($totalAttend / 26),2);
    /*end kira basic salary*/
    
    /*kira basic penalty*/
    $penalty=$FS['penalty'];
    /*end kira basic penalty*/
    
    /*kira basic petrol*/
    $petrol=$FS['petrol'];
    $totalAttend=$AC['attendNo'];
    $formPetrol= round($petrol * ($totalAttend / 26),2);
    /*end kira basic petrol*/
    
    /*kira basic handphone*/
    $handphone=$FS['handphone'];
    $totalAttend=$AC['attendNo'];
    $formHandphone= round($handphone * ($totalAttend / 26),2);
    /*end kira basic handphone*/
    
    /*kira basic commision*/
    $commision=$FS['commision'];
    $totalParcel=$PC['totalParcel'];
    $formCommision1= 30 * $totalAttend;
    $formCommision2= $totalParcel - $formCommision1;
    $formCommision3= round($commision * $formCommision2,2);
    /*end kira basic commision*/
    
    /*kira basic attAllow*/
    $attAllow=$FS['attAllow'];
    $formAttAllow = 50;
    /*end kira basic commision*/
    
    /*kira basic epf*/
    $totalEarning1 = round($formBasicSalary + $formHandphone + $formPetrol + $formCommision3,2);
    $totalEarning2 = round($formBasicSalary + $formHandphone + $formPetrol + $formAttAllow + $formCommision3,2);
    $epf=round(0.11 * $totalEarning2,2);
    /*end kira basic epf*/
    
    /*eis formula*/
    require('eisTable.php');
    /*end eis formula*/
    
    /*socso formula*/
    require('socsoTable.php');
    /*end socso formula*/
    
    /*calculate total and grand total*/
    $advance = $FS['advance'];
    $totalDeduction1 = round($advance + $undel + $bagDeposit,2);
    $totalDeduction2 = round($epf + $eis + $socso + $advance + $undel + $penalty + $bagDeposit ,2);
    $grandTotal1 = round($totalEarning1 - $totalDeduction1,2);
    $grandTotal2 = round($totalEarning2 - $totalDeduction2,2);
    /*end calculate total and grand total*/
?>