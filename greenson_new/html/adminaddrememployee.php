<?php
include "config.php";
session_start();
$_SESSION["admin"]=1;

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

$query = "SELECT * from employees";
$res = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/styletrackorder.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleempwelcome.css">
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#view").click(function(){
        $("table").toggle();
    });
});
</script>

    
</head>
<body>
<header>
    
    <h1> GREENSON THERMAL TECHNOLOGIES </h1>
</header>
  
<div class="topnav">
  
   <div id="mySidenav" class="sidenav"> 
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
        <a href="gallery.html">Veiw Gallery</a>
       <a href="adminwelcome.php">Admin Dashboard</a>
       <a href="adminlogout.php">Logout</a>
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
    <div id="track-order">
<button id="view" style="width: 40%; margin-left:30%">Click to view/hide details of employees</button>
    
          <table style="display:none;" class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="5%">Empid</th>
                <th style = "text-align:centre;" width="10%">Employee name</th>
                <th style="text-align:centre;" width="5%">Salary</th>
                
            </tr>	    
            <?php
                $query = "SELECT * from employees";
                $res = mysqli_query($conn,$query);

                while($r = mysqli_fetch_assoc($res))
                {
                    
            ?>       

            <tr>
                <td style="text-align:centre;"><?php echo $r["empid"]?></td>
                <td style="text-align:centre;"><?php echo $r["name"]?></td>
                <td style="text-align:centre;"><?php echo $r["bsal"]?></td>
            </tr>
            <?php
                }
                
            ?>                
        </tbody>
    </table>
    </div>

    
<div class="row">
    
    <div class="column">
        <img src="../images/admin1.jpg" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <button><a href="adminaddemp.php">Add employees</a></button>
    </div>
  
    <div class="column">
        <img src="../images/employee.png" alt="payment" style="width:60%; padding-left: 20%;" >
        <br>
        <button><a href="adminrememp.php">Remove employees</a></button>
    </div>
</div>
    
    <br>
    <br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
