<?php
include "config.php";
session_start();
$user= $_SESSION['cuname'];
$cgst = $_SESSION['cgst'];
$cartitems = $_SESSION['cart_item'];
$finished  = "not finished";
$query = "INSERT INTO orders (cgst, finished) 
                VALUES('$cgst', '$finished')";
if (mysqli_query($conn, $query))
    echo "order placed succesfully";
else
    echo "order couldn't be placed";
echo "New record has id: " . mysqli_insert_id($conn); 

foreach ($cartitems as $item)
{
    $pono = mysqli_insert_id($conn);
    $finstage = "processing";
    $qty = $item["quantity"];
    $pid = $item["pid"];
    $query = "INSERT INTO ordered_pdts1 (pono,pid,qty,finstage) VALUES ('$pono','$pid','$qty','$finstage')";
    if (mysqli_query($conn, $query))
        echo "order placed succesfully for pid = ".$pid;
    else
        echo "order couldn't be placed for pid = ".$pid;

}
unset($_SESSION['cart_item']);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/stylecuslogin.css">
<link rel="stylesheet" type="text/css" href="../css/styleplaceorder.css">
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css">

  
<title>Greenson Thermal Technologies</title>
</head>
<body>
<header>
    
    <h1> GREENSON THERMAL TECHNOLOGIES </h1>
</header>

<div class="topnav">
  
   <div id="mySidenav" class="sidenav">
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
       <a href="home.html">Home</a>
       <a href="gallery.html">Veiw Gallery</a>
       <a href="placeorder1.php">Reveiw order</a>
       <a href="updatepayment.php">Update Payment</a>
       <a href="cuslogout.php">Logout</a>
        
    </div>

   <span style="cursor:pointer" onclick="openNav()"><div id="open"> Menu </div></span>

    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "10%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>
    

</div>

<h2 style ="text-align:  center"> Welcome <?php echo $user; ?> <br>
    <br>Your order has been successfully placed !
    <br> No more changes can be made !
    <br> PO number = <?php echo $pono; ?>
    <br> Order details</h2>   



<div id="shopping-cart">
<?php
if(!empty($cartitems)){
    $total_quantity = 0;
    $total_price = 0;
?>	
    <table style="width:60%" class="tbl-cart" cellpadding="10" cellspacing="1" align="center">
        <tbody>
            <tr>
                <th style="text-align:left;" width="5%">ID</th>
                <th style="text-align:left;">Name</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                
            </tr>	
            <?php		
                foreach ($cartitems as $item){
                    $item_price = $item["quantity"]*$item["pcost"];
            ?>
                    <tr>
                        <td><?php echo $item["pid"]; ?></td>
                        <td><?php echo $item["pname"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?php echo "Rs ".$item["pcost"]; ?></td>
                        <td  style="text-align:right;"><?php echo "Rs ".$item_price; ?></td>
                        
                    </tr>
                    <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["pcost"]*$item["quantity"]);
		      }
		            ?>

            <tr>
                <td colspan="2" align="left">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td></td>
                <td align="right" colspan="1"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                
            </tr>
        </tbody>
    </table>		
    <?php
}else {
    ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
    }
        ?>
    </div>

  <br>
    <a id="btnplace"  href="placeorder1.php" style="text-align: center; float: left">Place another Order</a>
    <br>
    <br>
    <a id="btnplace"  href="trackorder.php" style="text-align: center; float: left">Track your Order</a><br>
    <br>
       
    
<br>
    <br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
</body>
</html>