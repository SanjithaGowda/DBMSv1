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
echo $user;
echo $empid;
$query = "select * from employees where empid = '$empid'";
$result = mysqli_query($conn,$query);
if ($result)
{
    echo "successful";
}
else
{
    echo "failed";
}
$emp = mysqli_fetch_assoc($result);
$bsal = $emp['bsal'];
$name = $emp['name'];
$ot  = $emp['ot'];
$image = $emp['image']
?>
    
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleempwelcome.css">
<link rel="stylesheet" type="text/css" href="../css/stylecuslogin.css">
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
       <a href="empwelcome.php">Dashboard</a>
       <a href="empupdatestatus.php">Update order status</a>
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
<h1 style ="text-align:  center">Welcome <?php echo $name; ?> ! </h1>
    <div class="imgcontainer">
        
    <img src="<?php echo $image; ?>" alt="Avatar" class="avatar" width="7%" height="40%">
  </div>
<div class="container">
    
    <p style="text-align: center; font-size:20px;">
        <b>Employee ID: &nbsp; </b> <?php echo $empid; ?><br>
        <b>base salary: &nbsp; </b> Rs. <?php echo $bsal; ?><br>
        <b>OT hours: &nbsp; </b> <?php echo $ot; ?> hrs <br>
        <b>Salary: &nbsp;</b> Rs.<?php echo $bsal+($ot*100);?> 
    </p>
    <br>
    
    <a href="empupdatestatus.php"><button>Go to Update status</button></a>
    <br>
    <br>
    </div>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
