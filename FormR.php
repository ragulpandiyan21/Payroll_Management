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
    
    $sql="SELECT * FROM emp_salary WHERE salmonth = ? AND salyear = ?;";
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
            $this->Image('image1.png',10,8,10);
            
            // Set font family to Arial bold 
            $this->SetFont('Arial','B',20);
            
            // Move to the right
            $this->Cell(63);
            
            // Header
            $this->Cell(275,12,'AHMED BROS, SINGARATHOPPU, TRICHY -620002         FORM R',0,0,'C');

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
    $pdf = new PDF('L','mm','A3');
    // Define alias for number of pages
    $pdf->AddPage();    
    $pdf->SetFont('Times','',11);
    $pdf->SetLeftMargin(10);
    
    $pdf->Cell(20,10,'EID',1,0,'C');
    $pdf->Cell(45,10,'Employee Name',1,0,'C');
    //$pdf->Cell(13,10,'Month',1,0,'C');
    //$pdf->Cell(13,10,'Year',1,0,'C');
    $pdf->Cell(25,10,'Basic',1,0,'C');
    $pdf->Cell(25,10,'HRA',1,0,'C');
    $pdf->Cell(25,10,'DA',1,0,'C');
    $pdf->Cell(15,10,'OT',1,0,'C');
    $pdf->Cell(15,10,'PF%',1,0,'C');
    $pdf->Cell(25,10,'PF',1,0,'C');
    $pdf->Cell(15,10,'PF%',1,0,'C');
    $pdf->Cell(25,10,'PF',1,0,'C');
    $pdf->Cell(15,10,'ESI%',1,0,'C');
    $pdf->Cell(25,10,'ESI',1,0,'C');
    $pdf->Cell(15,10,'ESI%',1,0,'C');
    $pdf->Cell(25,10,'ESI',1,0,'C');
    $pdf->Cell(30,10,'GROSS',1,0,'C');
    $pdf->Cell(30,10,'DEDUCTION',1,0,'C');
    $pdf->Cell(30,10,'TAKE HOME',1,0,'C');
    $pdf->Ln(11);
    foreach ($resultData as $row){

        $sql="SELECT empname FROM emp_personal_details WHERE empid = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt,"i",$row['empid']);
        mysqli_stmt_execute($stmt);
        $rsd=mysqli_stmt_get_result($stmt);
        $rs=mysqli_fetch_assoc($rsd);

        $pdf->Cell(20,10,$row["empid"],1,0);
        $pdf->Cell(45,10,$rs["empname"],1,0,'C');
        // $pdf->Cell(13,10,$mnth,1,0,'C');
        // $pdf->Cell(13,10,$yr,1,0,'C');
        $pdf->Cell(25,10,$row["basic"],1,0,'C');
        $pdf->Cell(25,10,$row["hra"],1,0,'C');
        $pdf->Cell(25,10,$row["da"],1,0,'C');
        $pdf->Cell(15,10,$row["ot"],1,0,'C');
        $pdf->Cell(15,10,'12%',1,0,'C');
        $pdf->Cell(25,10,$row["emp_pf"],1,0,'C');
        $pdf->Cell(15,10,'12%',1,0,'C');
        $pdf->Cell(25,10,$row["empr_pf"],1,0,'C');
        $pdf->Cell(15,10,'0.75%',1,0,'C');
        $pdf->Cell(25,10,$row["emp_esi"],1,0,'C');
        $pdf->Cell(15,10,'1.75%',1,0,'C');
        $pdf->Cell(25,10,$row["empr_esi"],1,0,'C');
        $pdf->Cell(30,10,$row["gross_sal"],1,0,'C');
        $pdf->Cell(30,10,$row["deduction"],1,0,'C');
        $pdf->Cell(30,10,$row["net_sal"],1,0,'C');
        $pdf->Ln(9.8);
    }

    $pdf->Output();

?>