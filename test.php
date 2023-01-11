<?php 
ob_start();
include 'config.php';

require_once 'dompdf/autoload.inc.php'; 
require 'vendor/autoload.php';
use Dompdf\Dompdf; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['excelsheetattendance'])) {
  $firstrangeexcel = $_POST['firstrangeexcel'];
  $secondrangexcel = $_POST['secondrangeexcel'];
  if (empty($firstrangeexcel) || $firstrangeexcel == null || $firstrangeexcel == '' || empty($secondrangexcel) || $secondrangexcel == null || $secondrangexcel == '') {
    ?>
    <div class="alert alert-danger" role="alert">
    Hold On <br> Please Choose A Starting Date & Ending Date
    </div>
    <?php
  } else {
    $spreadsheet = new Spreadsheet();
  $Excel_writer = new Xlsx($spreadsheet);
  
  $spreadsheet->setActiveSheetIndex(0);
  $activeSheet = $spreadsheet->getActiveSheet();
  
  $activeSheet->setCellValue('A1', 'Name');
  $activeSheet->setCellValue('B1', 'Company');
  $activeSheet->setCellValue('C1', 'Department');
  $activeSheet->setCellValue('D1', 'Check In Timestamp');
  $activeSheet->setCellValue('E1', 'In');
  $activeSheet->setCellValue('F1', 'Check Out Timestamp');
  $activeSheet->setCellValue('G1', 'Out');
  $activeSheet->setCellValue('H1', 'Latitude');
  $activeSheet->setCellValue('I1', 'Longitue');
  $activeSheet->setCellValue('J1', 'Check In Remarks');
  $activeSheet->setCellValue('K1', 'Check Out Remarks');
  $activeSheet->setCellValue('L1', 'Good Name');
  $activeSheet->setCellValue('M1', 'Check in Time');
  $activeSheet->setCellValue('N1', 'Checkout Time');
  $activeSheet->setCellValue('O1', 'Working Hours');



  
  $activeSheet->getStyle('A1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('B1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('C1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('D1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('E1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('F1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('G1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('I1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('J1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('K1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('L1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('M1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('N1')->getAlignment()->setWrapText(true);$activeSheet->getStyle('O1')->getAlignment()->setWrapText(true);
  
  $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);$spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
  
  $spreadsheet->getActiveSheet()->getStyle("A1:O1")->getFont()->setSize(14);
  
  $query = $connect->query("SELECT employees.*, attendance.* FROM employees INNER JOIN attendance ON employees.Email = attendance.Email_Address where DATE(attendance.CheckIn_Timestamp) BETWEEN date('$firstrangeexcel') AND date('$secondrangexcel') ORDER BY `attendance`.`CheckIn_Timestamp` ASC");
  if($query->num_rows > 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {       
      
      if($row['checkin_time'] == null || empty($row['checkin_time'])){
        $difference = 0;
      }else if($row['checkout_time'] == null || empty($row['checkout_time'])){
        $difference = 'User Not Signed Out';
      }else{

        //start time like this - 09:42:28am
        //end time like this - 05:06:33pm

        $intime = strtotime($row['checkin_time']);
        $outtime = strtotime($row['checkout_time']);
        $difference = round((abs($outtime - $intime)) / 3600,2);

        // then output - 7.4 hours 
        // but actual output should - 7 hours 24 min
  
      }

      
      $activeSheet->setCellValue('A'.$i , $row['Name']);
      $activeSheet->setCellValue('B'.$i , $row['Company']);
      $activeSheet->setCellValue('C'.$i , $row['Department']);
      $activeSheet->setCellValue('D'.$i , $row['CheckIn_Timestamp']);
      $activeSheet->setCellValue('E'.$i , $row['Check_In']);
      $activeSheet->setCellValue('F'.$i , $row['CheckOut_Timestamp']);
      $activeSheet->setCellValue('G'.$i , $row['Check_Out']);
      $activeSheet->setCellValue('H'.$i , $row['Latitude']);
      $activeSheet->setCellValue('I'.$i , $row['Longitude']);
      $activeSheet->setCellValue('J'.$i , $row['In_Remarks']);
      $activeSheet->setCellValue('K'.$i , $row['Out_Remark']);
      $activeSheet->setCellValue('L'.$i , $row['Good_Name']);
      $activeSheet->setCellValue('M'.$i , $row['checkin_time']);
      $activeSheet->setCellValue('N'.$i , $row['checkout_time']);
      $activeSheet->setCellValue('O'.$i , $difference);
      
      $i++;
    }
    $filename = '[HR SYSTEM] - Attendance Data - '.date('Y-m-d').'.xlsx';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');
    die;
  }
  }
}

$dompdf = new Dompdf(array('isPhpEnabled' => true ));
if (isset($_POST['pdfgenerateattendance'])) {
  
  $firstrange = $_POST['firstrange'];
  $secondrange  = $_POST['secondrange'];
  $empemail = $_POST['firstname'];
  if($_POST['firstrange']==null || empty($_POST['firstrange'])){
    ?>
    <script>
    alert("Please Select A From Date");
    </script>
    <?php
  }
  else if($_POST['secondrange']==null || empty($_POST['secondrange'])){
    ?>
    <script>
    alert("Please Select A To Date");
    </script>
    <?php
  }
  else{
    $pdfquery = "SELECT * FROM employees WHERE Email='$empemail'";
    $resultpdf = mysqli_query($connect,$pdfquery);
    while($prow = mysqli_fetch_assoc($resultpdf)){ 
      $mydate = strtotime($firstrange);
      $newfrange = date('F jS Y', $mydate);
      $mydate2 = strtotime($secondrange);
      $newsrange = date('F jS Y', $mydate2);
      
      $html =  '<div class="footer">
      <div style="text-align: center;">Private & Confidential | Property of Prudential Group</a></div>
      </div>
      <h1 style="background-color:lightblue; width:100%; padding-top:10px; padding-bottom:15px; padding-left:15px; border-radius:10px;">'. $prow['Title'].'. '.$prow['Name'] . '</h1>
      <hr>
      <table style="width: 100%; padding-top:10px; padding-bottom:10px;" border="0">
      
      <thead>
      <tr>
      <th align="left">Company - '.$prow['Company'].'</th>
      <th align="left">Supervisor - '.$prow['HOD_Email'].'</th>
      </tr>
      </thead>
      
      <thead>
      <tr>
      <th align="left">Department - '.$prow['Department'].'</th>
      <th align="left">Designation - '.$prow['Designation'].'</th>
      </tr>
      </thead>
      
      <thead>
      <tr>
      <th align="left">EPF No - '.$prow['EPF'].'</th>
      <th align="left">Date of Joining - '.$prow['Joined_Date'].'</th>
      </tr>
      </thead>
      
      <thead>
      <tr>
      <th align="left">Employment Type - '.$prow['Employement_Type'].'</th>
      </tr>
      </thead>
      </table>
      
      <hr>
      <br>
      <label>Filtered Date Range<br>From - '.$newfrange.'   To - '.$newsrange.'</label>
      
      <table width="100%" style="width: 100%; text-align: center; font-size: 14px;">
      <thead>
      <tr>
      <th style="border:solid 1px; border-left:0px; border-right:0px; border-top:0px; padding:5px; text-align:center;"><strong>Date</strong></th>
      <th style="border:solid 1px; border-left:0px; border-right:0px; border-top:0px; padding:5px;"><strong>Time</strong></th>
      <th style="border:solid 1px; border-left:0px; border-right:0px; border-top:0px; padding:5px;"><strong>In / Out</strong></th>
      </tr>
      </thead>
      <br>
      <tbody>';
      
      // Query from mysql 
      $pdfquery = "SELECT employees.*,attendance.* FROM attendance LEFT JOIN employees ON employees.Email = attendance.Email_Address WHERE attendance.Date_Log BETWEEN '$firstrange' AND attendance.Date_Log BETWEEN '$secondrange' AND attendance.Email_Address='$empemail' AND employees.Email='$empemail'";
      $resultpdf = mysqli_query($connect,$pdfquery);
      while($prow = mysqli_fetch_assoc($resultpdf)){
        @$date = $prow['Date_Log'];
        @$time = $prow['Time_Log'];
        @$inout = $prow['IN_OUT'];
        
        $html .= '<tr style="border:solid 1px;">
        <td style="border:solid 1px; border-left:0px; border-top:0px; text-align:center; padding:5px;">'.$date.' </td>
        <td style="border:solid 1px; border-left:0px; border-top:0px; text-align:center; padding:5px; text-align:center;">'.$time.' </td>
        <td style="border:solid 1px; border-left:0px; border-top:0px; text-align:center; padding:5px; text-align:center;">'.$inout.' </td>
        </tr>
        ';
      }
    }
    $html .= '</table>';  
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); 
    $dompdf->render(); 
    $dompdf->stream($prow['Name'].' Leave Data (HR - Prudential)',array('Attachment'=>0));
  }
}
?>
<!doctype html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/98f54b486b.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>






</style>
</head>
<body>
<?php include 'headermain.php'; ?>


<div class="row" style="width: 100%;">
<div class="col-md-12 text-center">
<form action="" method="post">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalexcelattendance">Attendance Excel Sheet</button>
</form>
</div>
</div>

<!-- Attendance Excel Modal -->
<div class="modal fade" id="modalexcelattendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Attedance Excel Report</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form method="post">

<div class="row" style="width:100%;">
<div class="col-md-6 mt-2 mb-2">
<label>From</label>
<input type="date" name="firstrangeexcel" class="form-control">
</div>
<div class="col-md-6 mt-2 mb-2">
<label>To</label>
<input type="date" name="secondrangeexcel" class="form-control">
</div>
<input type="hidden" name="firstname" id="empemai">
<div class="col-md-12 mt-2">
<button type="submit" name="excelsheetattendance" class="btn btn-primary w-100">Generate</button>

</div>
</div>

</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- END -->

<div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Name</td>  
                                    <td>Company</td>
                                    <td>Department</td>
                                    <td>In Timestamp</td>  
                                    <td>Out Timestamp</td>
                                    <td>In Remarks</td>  
                                    <td>Out Remarks</td>  
                                    <!-- <td>Action</td>   -->
                                     

                               </tr>  
                          </thead>  
                        
                          <?php  
                          $query ="SELECT e.`Name` AS ename,e.`Company` AS ecom,e.`Department` AS e_dept, a.`CheckIn_Timestamp` AS cin,a.`CheckOut_Timestamp` AS cout,a.`In_Remarks` AS inremark,a.`Out_Remark` AS outremark FROM `attendance` a JOIN `employees` e ON a.`Email_Address`=e.`Email`  ORDER BY a.`CheckIn_Timestamp` DESC";  
                          $result = mysqli_query($connect, $query);
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["ename"].'</td>  
                                    <td>'.$row["ecom"].'</td>  
                                    <td>'.$row["e_dept"].'</td>  
                                    <td>'.$row["cin"].'</td>  
                                    <td>'.$row["cout"].'</td>  
                                    <td>'.$row["inremark"].'</td>  
                                    <td>'.$row["outremark"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div> 
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModallocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">User's Location</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    
    <form action="" id="profileForm">
    <div class="row" style="width: 100%;">
    <div class="col-md-6">
    <input type="text" name="latitude" id="userlat" class="form-control">
    </div>
    <div class="col-md-6">
    <input type="text" name="longgitu" id="userlong" class="form-control">
    </div>
    </div>
    </form>
    
    <div id="map" class="mt-3"></div>
    
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKObOxhF0vL6DxHDZGMOcUZ6DU5Iy77IM&callback=initMap&libraries=&v=weekly"
    async
    ></script>
    
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
    </html>

<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 
 </script>  