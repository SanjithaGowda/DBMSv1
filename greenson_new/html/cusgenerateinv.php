<?php 

include "config.php";
session_start();
 /*$itemArray = array($productByCode[0]["pid"]=>array('pname'=>$productByCode[0]["pname"], 'pid'=>$productByCode[0]["pid"], 'quantity'=>$_POST["quantity"], 'pcost'=>$productByCode[0]["pcost"], 'pdesc'=>$productByCode[0]["pdesc"]));*/
$user= $_SESSION['cuname'];
$cgst = $_SESSION['cgst'];
$cartitems = $_SESSION['cart_item_final'];
$pono = $_SESSION["pono"];
    
if(!isset($_SESSION['cuname'])){
    ?>
    <script>
        window.alert("Login first!!");
        window.location.href="mainlogin.html";
    </script>
      <?php
    //exit();
}

$query = "select * from customer where gst = '$cgst'";
$result = mysqli_query($conn,$query);
if (!$result)
{
    //echo "successful";
}
$cus = mysqli_fetch_assoc($result);
$address = $cus['address'];
$pageWidth = 210;
$pageHeight = 287;


?>

<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{

// Page header
function Header()
{
   
  $margin = 10;
  $this->Rect( $margin, $margin ,190 , 279);
    $this->SetFont('Arial','B',18);
    $this->Cell(80);
    $this->Cell(30,10,'Greenson Thermal Technologies',0,1,'C');
    $this->Cell(0,10,'Invoice',0,1,'C');    
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


  
// Instanciation of inherited class

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$margin = 10;
$pdf->Rect( $margin, 35 , $pageWidth - 90 , 30);
$pdf->Rect( $pageWidth - 80, 35 , 70, 30);

$pdf->SetFont('Times','B',16);
$pdf->Cell(120,10,$user,0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,"Invoice number : ".$pono,0,1);
$pdf->Cell(120,10,"GST Tin: ".$cgst,0,0);
$pdf->Cell(0,10,"Date: ".date("Y/m/d"),0,1);
$pdf->Cell(120,10,$address,0,1);

$pdf->Cell(0,10,"Order Details",0,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(120,10,"Product Name and Description",1,0);
$pdf->Cell(23,10,"Quantity",1,0);
$pdf->Cell(23,10,"Unit Price",1,0);
$pdf->Cell(24,10,"Price",1,1);
$pdf->SetFont('Times','',12);
$id=1;
$total_price=0;
foreach ($_SESSION["cart_item_final"] as $item){
        $item_price = $item["quantity"]*$item["pcost"];
        $pdf->Cell(120,10,$id.". ".$item["pname"],1,0);
        $pdf->Cell(23,10,$item["quantity"],1,0);
        $pdf->Cell(23,10,$item["pcost"],1,0);
        $pdf->Cell(24,10,$item_price,1,1);
        $id++;
        $total_price += ($item["pcost"]*$item["quantity"]);
}
$pdf->Ln(10);
$pdf->SetFont('Times','B',12);
$pdf->Cell(120,10,"Total Price ",1,0);
$pdf->Cell(0,10,$total_price,1,1);

/*
            <tr>
                        <td><?php echo $item["pid"]; ?></td>
                        <td><?php echo $item["pname"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?php echo "Rs ".$item["pcost"]; ?></td>
                        <td  style="text-align:right;"><?php echo "Rs ".$item_price; ?></td>
                        
                        <td style="text-align:center;"><a href="placeorder1.php?action=remove&pid=<?php echo $item["pid"]; ?>" class="btnRemoveAction"> Remove </a></td>
                    </tr>
                    <?php
                        $total_quantity += $item["quantity"];
                        
		      }
		            ?>

*/
$pdf->Output();
?>
