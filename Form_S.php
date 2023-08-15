<?php
session_start();
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "";

    $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
    $mnth = $_SESSION['mth'];
    $yr = $_SESSION['yr'];
    
    $sql="SELECT * FROM emp_leave WHERE l_month = ? AND l_year = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt,"ss",$mnth,$yr);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    //$rs=mysqli_fetch_assoc($resultData);
    require('.\fpdf\fpdf.php');
  
    class PDF extends FPDF {
    
        // Page header
        function Header() {
            // Add logo to page
            $this->Image('image1.png',0,-20,75);
            
            // Set font family to Arial bold 
            $this->SetFont('Arial','B',20);
            
            // Move to the right
            $this->Cell(63);
            
            // Header
            $this->Cell(160,12,'AHMED BROS, SINGARATHOPPU, TRICHY -620002     FORM S',0,0,'C');

            // Line break
            $this->Ln(20);
        }
    
        // Page footer
        function Footer() {
            
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            
            // Page number
            $this->Cell(0,10,'1',0,0,'C');
        }
    }

    // Instantiation of FPDF class
    $pdf = new PDF('L','mm','A4');
    // Define alias for number of pages
    $pdf->AddPage();    
    $pdf->SetFont('Times','',11);
    
    $pdf->Cell(35,10,'Employee ID',1,0,'C');
    $pdf->Cell(50,10,'Employee Name',1,0,'C');
    $pdf->Cell(20,10,'Month',1,0,'C');
    $pdf->Cell(20,10,'Year',1,0,'C');
    $pdf->Cell(25,10,'Total Days',1,0,'C');
    $pdf->Cell(30,10,'No of Week Off',1,0,'C');
    $pdf->Cell(30,10,'Days Present',1,0,'C');
    $pdf->Cell(35,10,'Week Off Availed',1,0,'C');
    $pdf->Cell(35,10,'Addt. Leave Availed',1,0,'C');
    $pdf->Ln(11);
    foreach ($resultData as $row){

        $sql="SELECT empname FROM emp_personal_details WHERE empid = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt,"i",$row['empid']);
        mysqli_stmt_execute($stmt);
        $rsd=mysqli_stmt_get_result($stmt);
        $rs=mysqli_fetch_assoc($rsd);

        $pdf->Cell(35,10,$row['empid'].'',1,0);
        $pdf->Cell(50,10,$rs['empname'],1,0);
        $pdf->Cell(20,10,$mnth.'',1,0);
        $pdf->Cell(20,10,$yr.'',1,0);
        $pdf->Cell(25,10,$row['total_days'].'',1,0);
        $pdf->Cell(30,10,'4',1,0);
        $pdf->Cell(30,10,$row['worked_days'].'',1,0);
        $pdf->Cell(35,10,$row['weekoff'].'',1,0);
        $pdf->Cell(35,10,$row['c_leave'].'',1,0);
        $pdf->Ln(9.8);
    }

    $pdf->Output();
?>