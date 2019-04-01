<?php
include "config.php";
session_start();
if(!isset($_SESSION['cuname'])){
    echo "cuname unset";
    echo "cuname is ".$_SESSION['cuname'];
    ?>
    <script>
        window.alert("Login first!!");
        window.location("mainlogin.html");
    </script>
      <?php
    exit();
}
$user= $_SESSION['cuname'];
$cgst = $_SESSION['cgst'];
$qty = "";
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
        if(!empty($_POST["quantity"])) {
            $query="SELECT * FROM products WHERE pid=".$_GET["pid"];
            $result = mysqli_query($conn,$query);
		    while($row=mysqli_fetch_assoc($result)) {
			     $resultset1[] = $row;
		    }		
		    if(!empty($resultset1)){
                $productByCode = $resultset1; 
            }
	       $itemArray = array($productByCode[0]["pid"]=>array('pname'=>$productByCode[0]["pname"], 'pid'=>$productByCode[0]["pid"], 'quantity'=>$_POST["quantity"], 'pcost'=>$productByCode[0]["pcost"], 'pdesc'=>$productByCode[0]["pdesc"]));
            //echo '<pre>'; print_r($itemArray); echo '</pre>';
            
			if(!empty($_SESSION["cart_item"])) {
               if(in_array($productByCode[0]["pid"],array_column($_SESSION["cart_item"],"pid"))) {
               	    foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["pid"] == ($_SESSION["cart_item"][$k]["pid"])) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
                    
            		$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
            	}
			} else {
            	$_SESSION["cart_item"] = $itemArray;
            
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["pid"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
       <a href="gallery.html">View Gallery</a>
       <a href="trackorder.php">Track order</a>
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

<h2 style ="text-align:  center"> Welcome <?php echo $user; ?> </h2>
 <p>GST tin: <?php echo $cgst; ?> </p>   



<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="placeorder1.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:left;" width="5%">ID</th>
                <th style="text-align:left;">Name</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
            <?php		
                foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"]*$item["pcost"];
            ?>
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
                        $total_price += ($item["pcost"]*$item["quantity"]);
		      }
		            ?>

            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>	
    
     <a id="btnplace"  href="placeorderfinal.php" style="text-align: center">Place Order</a>
   
    <?php
    } else {
    ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
    }
        ?>
    </div>

    <br>

    <div id="product-grid">
	   <div class="txt-heading">Products</div>
	   <?php
            $query="SELECT * FROM products order by pid asc";
            $result = mysqli_query($conn,$query);
           
		    while($row=mysqli_fetch_assoc($result)) {
			    
                $resultset[] = $row;
                
                
		    }	
           
		    $product_array = $resultset;
	         
	        if (!empty($product_array)) { 
		      foreach($product_array as $key=>$value){
	   ?>
                 <form method="post" action="placeorder1.php?action=add&pid=<?php echo $product_array[$key]["pid"]; ?>">
                        
                         <h2 style= "margin-left: 20px" >
                             <?php echo $product_array[$key]["pid"]; ?>. 
                             <?php echo $product_array[$key]["pname"]; ?>
                         </h2>
                         <p style= "margin-left: 20px">
                             <?php echo "Rs".$product_array[$key]["pcost"]; ?> <br>
                             Quantity available: <?php echo $product_array[$key]["qtyavail"]; ?> <br><br>
                             <?php if ($product_array[$key]["qtyavail"]>0) { ?>
                                <input type="text" class="product-quantity" name="quantity"  value="1" size="2" />
                                <input type="submit" value="Add to Cart" class="btnAddAction" />
                            <?php } else { ?>
                                <input type="submit" value="No stock" class="btnAddAction" style="background-color: white; color: grey" disabled/>
                           <?php } ?>
                           
                         </p>
                </form>
            <?php
		  }
	   }
	       ?>
    </div>
    

<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
</body>
</html>
