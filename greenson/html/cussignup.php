<?php
include "config.php";
session_start();
$user= $_SESSION['cuname'];
$cgst= $_SESSION['cgst'];

?>
    
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/stylemainlogin.css">
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css">
</head>
<body>
<header>
    
    <h1> GREENSON THERMAL TECHNOLOGIES </h1>
</header>
  
<div class="topnav">
  
   <div id="mySidenav" class="sidenav">
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
       <a href="home.html">Contact us</a>
       <a href="gallery.html">Veiw Gallery</a>
       <a href="placeorder1.php">Place an order</a>
       <a href="trackorder.php">Track order</a>
       <a href="updatepayment.php">Update Payment</a>    
       <a href="cuslogout.php">Log-out</a>
<!--on logout send to home -->        
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

<h2 style ="text-align:  center">Welcome <?php echo $user; ?> </h2>
<h2 style ="text-align:  center"> gst <?php echo $cgst; ?></h2>    
<p style="text-align: center">Chose the option below for the required operations to be performed</p>
    <br>
<div class="row">
    <div class="column">
        <img src="../images/track_order_delivery_search-512.png" alt="Snow" style="width:60%; padding-left: 20%; ">
        <br>
        <button href ="#">Track your order </button>
    </div>
  
    <div class="column">
        <img src="../images/placeorder.png" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <button><a href="placeorder1.php">Place Order</a></button>
    </div>
  
    <div class="column">
        <img src="../images/payment.png" alt="payment" style="width:60%; padding-left: 20%;" >
        <br>
        <button href ="#">Update Payment </button>
    </div>
</div>
  
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
