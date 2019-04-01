<?php
include "config.php";
session_start();
$tpay=0;
$sgst="";
$curpay=0;
$amtballeft=0;

if(!isset($_SESSION['admin'])){
    echo "cuname unset";
    echo "cuname is ".$_SESSION['cuname'];
    ?>
    <script>
        window.alert("Login first!!");
                window.location.href="mainlogin.html";
     </script>
      <?php
    exit();
}

          


if(isset($_GET["action"])){
if($_GET["action"]=="pay") {
        $tpay = floatval(mysqli_real_escape_string($conn,$_GET["tpay"]));
        $sgst = mysqli_real_escape_string($conn,$_GET["sgst"]);
        $curpay = floatval(mysqli_real_escape_string($conn,$_POST["curpayment"]));
        if($curpay > $tpay){
            ?>    
            <script>
                window.alert("Amount paid is exceeding balance amount. Fill amount less than balance amount.");
            </script>
            <?php
        }
        else{
            $amtballeft = $tpay-$curpay;
            $qu = "UPDATE supplier set total_payment =".$amtballeft." where sgst = '$sgst'";
            if(mysqli_query($conn,$qu))
                echo "updated bal";
            else
                echo "not updated";    
        }
    }
}    
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleadminpaydets.css">
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
       <a href="adminwelcome.php">Admin welcome</a>
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminupdatepdts.php">Update products</a>
       <a href="adminupdatesupp.php">Update Supplier</a>
       <a href="adminviewcust.php">View Customers</a>
       <a href="adminorderrm.php">Order Raw Materials</a>
       <a href="adminwip.php">View Work in progress</a> 
       <a href="adminrememp.php">Remove employee</a> 
       <a href="home.html">Log-out</a>
        
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

<h2 style ="text-align:  center"> Welcome ADMIN </h2>

<?php
$query = "SELECT gst,uname, name,paymentbal from customer order by gst asc";
$result = mysqli_query($conn, $query);
// echo "qis ".$query;
if(mysqli_num_rows($result))
{
?>    
<h2 style ="text-align:  center;">Amount to be paid by customers</h2>
<div id="all-cust">
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="5%">Customer GST</th>
                <th style = "text-align:centre;" width="10%">User name</th>
                <th style="text-align:centre;" width="10%">Name</th>
                <th style="text-align:centre;" width="5%">Payment balance</th>
            </tr>	    
            <?php
                while($row = mysqli_fetch_assoc($result))
                {
            ?>       
            <tr>
                <td style="text-align:centre;"><?php echo $row["gst"]?></td>
                <td style="text-align:centre;"><?php echo $row["uname"]?></td>
                <td style="text-align:centre;"><?php echo $row["name"]?></td>
                <td style="text-align:centre;"><?php echo $row["paymentbal"]?></td>
            </tr>
            <?php
                }
            ?>                
        </tbody>
    </table>          
</div>    
<br>
<br>
<?php    
}
else
{
    ?>
    <div class="no-records">No customers added yet</div>
<?php
}

?>

<div id="supplier-grid">
	   <div class="txt-heading">List of all suppliers</div>
	   <?php
            $query="SELECT * FROM supplier order by sgst asc";
            $result = mysqli_query($conn,$query);
           
		    while($row=mysqli_fetch_assoc($result)) {
			    
                $resultset[] = $row; 
		    }	 
		    $supply_array = $resultset;
	         
	        if (!empty($supply_array)) { 
		      foreach($supply_array as $key=>$value){
	   ?>
                 <form method="post" action="adminupdatepay.php?action=pay&sgst=<?php echo $supply_array[$key]["sgst"]; ?>&tpay=<?php echo $supply_array[$key]["total_payment"]; ?>">
                        
                         <h2 style= "margin-left: 20px" >
                             <?php echo $supply_array[$key]["sgst"]; ?>. 
                             <?php echo $supply_array[$key]["sname"]; ?>
                         </h2>
                         <p style= "margin-left: 20px">
                            <?php echo $supply_array[$key]["saddr"]; ?>
                             Total balance : <?php echo $supply_array[$key]["total_payment"]; ?> <br><br>
                             <?php if ($supply_array[$key]["total_payment"]>0) { ?>
                                <input type="text" class="supplier-amt" name="curpayment"  value="0" size="5" />
                                <input type="submit" value="Pay amount" class="btnAddAction" />
                            <?php } else { ?>
                                <input type="submit" value="No balance" class="btnAddAction" style="background-color: white; color: grey" disabled/>
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
