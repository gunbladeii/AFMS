$( document ).ready(function() {
    
               /*totalEarnings Group*/
               var fees = parseFloat($('#fees').text()) || 0;
               var petrol = parseFloat($('#petrol').text()) || 0;
               var handphone = parseFloat($('#handphone').text()) || 0;
               var comission = parseFloat($('#comission').text()) || 0;
               var others = parseFloat($('#others').text()) || 0;
               var refund = parseFloat($('#refund').text()) || 0;
               var attAllow = parseFloat($('#attAllow').text()) || 0;
               var overtime = parseFloat($('#overtime').text()) || 0;
               $('#totalEarning').text(fees + petrol + handphone + comission + others + refund + attAllow + overtime);
               
               /*totalDeductions Group*/
               var epf = parseFloat($('#epf').text()) || 0;
               var penalty = parseFloat($('#penalty').text()) || 0;
               var advance = parseFloat($('#advance').text()) || 0;
               var bagDeposit = parseFloat($('#bagDeposit').text()) || 0;
               var incompletePOD = parseFloat($('#incompletePOD').text()) || 0;
               var socso = parseFloat($('#socso').text()) || 0;
               var eis = parseFloat($('#eis').text()) || 0;
               $('#totalDeduction').text(penalty + advance + bagDeposit + incompletePOD + epf + socso + eis);
               
               /*calculate grand total*/
               var totalEarning = parseFloat($('#totalEarning').text()) || 0;
               var totalDeduction = parseFloat($('#totalDeduction').text()) || 0;
               var grandTotal = $('#grandTotal').text(totalEarning - totalDeduction);
               $('#grandTotal').text(totalEarning - totalDeduction);
               
               /*calculate totalSuccess*/
               var itemCode = parseFloat($('#itemCode').value()) || 0;
               var fail = parseFloat($('#fail').value().onchange) || 0;
               $('#success').value(itemCode - fail);
               
});