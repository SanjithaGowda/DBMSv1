<?php

include "config.php";
session_start();



$uname = "Admin";
if(isset($_POST["adminlogout"]))
{
    echo "logged out";
    session_destroy();
    header("Location: home.html");
}

unset($_SESSION['admin']);


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/stylecuslogin.css">
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
       <a href="home.html">Home</a>
       <a href="gallery.html">View Gallery</a>
        <a href="adminwelcome.php">Admin welcome</a>
       <a href="adminupdatepay.php">Update Payment</a>
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminupdatesupp.php">Update Supplier</a>
       <a href="adminviewcust.php">View Customers</a>
       <a href="adminupdatepdts.php">Update products</a>
       <a href="adminorderrm.php">Order Raw Materials</a>
       <a href="adminviewwip.php">View Work in progress</a> 
       <a href="adminrememp.php">Remove employee</a> 
      
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
    <br>
    <br>
    <h2 style="text-align:center"> Hello <?php echo $uname; ?> <br>
        Are you sure you want to log out? </h2>
    <br>
    <br>
    <form action="adminlogout.php" method="post">
        <div class="container">
            <button type="submit" name="adminlogout" style=" width = 40%; align-self:center;">Logout</button>
        </div>
    </form>



<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
</body>
</html>
