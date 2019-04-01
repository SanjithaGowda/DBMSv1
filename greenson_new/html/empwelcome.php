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
    exit();
}
    
$user= $_SESSION['empuname'];
$empid= $_SESSION['empid'];

?>
    
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleempwelcome.css">
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
       <a href="mainlogin.html">Main Login</a>
       <a href="emplogout.php">Logout</a>
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
<p style="text-align: center">Chose the option below for the required operations to be performed</p>
    <br>
<div class="row">
    
    <div class="column">
        <img src="../images/track_order_delivery_search-512.png" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <a href="empupdatestatus.php"><button>Update Status</button></a>
    </div>
  
    <div class="column">
        <img src="../images/payment.png" alt="payment" style="width:60%; padding-left: 20%;" >
        <br>
        <a href="empviewsalary.php"><button>View Salary</button></a>
    </div>
</div>
  
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
