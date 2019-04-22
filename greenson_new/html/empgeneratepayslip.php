<?php 
include "config.php";
session_start();

if(!isset($_SESSION['empuname'])){
    ?>
    <script>
        window.alert("Login first!!");
        window.location.href="mainlogin.html";
    </script>
      <?php
    //exit();
}

$user= $_SESSION['empuname'];
$empid= $_SESSION['empid'];
$query = "select * from employees where empid = '$empid'";
$result = mysqli_query($conn,$query);
if (!$result)
{
    echo "successful";
}
$emp = mysqli_fetch_assoc($result);
$bsal = $emp['bsal'];
$name = $emp['name'];
$ot  = $emp['ot'];
$image = $emp['image']
?>
<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{

// Page header
function Header()
{
   
  $margin = 10;
  $this->Rect( 10, 10 , 190 , 279);
    $this->SetFont('Arial','B',18);
    $this->Cell(80);
    $this->Cell(30,10,'Greenson Thermal Technologies',0,1,'C');
    $this->Cell(0,10,'Pay Slip',0,1,'C');    
    $this->Ln(5);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Not for official purposes',0,0,'C');
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',16);
$pdf->Cell(0,10,'Employee Name:   '.$name,0,0,'C');
$pdf->Image($image,80,55,50);
$pdf->Ln(100);
$pdf->SetFont('Times','',14);
$pdf->Cell(0,10,'Your salary Details are as follows',0,1,'C');
$tsal=$bsal+($ot*100);
$pdf->SetFont('Times','',14);
$pdf->Ln(5);
$pdf->Cell(100,10,'Employee Name:',1,0);
$pdf->Cell(90,10,$name,1,1);
$pdf->Cell(100,10,'Employee ID:',1,0);
$pdf->Cell(90,10,$empid,1,1);
$pdf->Cell(100,10,'Base Salary:',1,0);
$pdf->Cell(90,10,$bsal,1,1);
$pdf->Cell(100,10,'OT hours:',1,0);
$pdf->Cell(90,10,$ot,1,1);
$pdf->Ln(10);
$pdf->SetFont('Times','B',16);
$pdf->Rect(75,200,60,10);
$pdf->Cell(0,10,'Total salary: '. $tsal,0,1,'C');
$pdf->Output();
?>
