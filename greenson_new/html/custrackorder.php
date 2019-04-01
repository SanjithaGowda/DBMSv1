<?php
include "config.php";
session_start();


if(!isset($_SESSION['cuname'])){
    ?>
    <script>
        window.alert("Login first!!");
               window.location.href="mainlogin.html";
    </script>
      <?php
    exit();
}


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
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styletrackorder.css">
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
       <a href="placeorder1.php">Place order</a>
       <a href="updatepayment.php">Update Payment</a>
       <a href="mainlogin.html">Logout</a>
        
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
<p style="text-align:center">GST tin: <?php echo $cgst; ?> </p>   
<?php
$query = "SELECT * from orders where cgst =".$cgst." and finished=0 order by pono desc";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result))
{
?>    
<h2 style ="text-align:  center;">Orders Placed</h2>
<div id="track-order">
    
            <?php		
                while($row = mysqli_fetch_assoc($result))
                {
                    $query = "SELECT * from ordered_pdts1 where pono = ".$row["pono"];
                    $res = mysqli_query($conn,$query);
            ?>
            <br>
            <h4 id="leftal"> PO Number : <?php echo $row["pono"]; ?></h4>
            <h4 id = "rightal"> Order cost : <?php echo $row["ocost"]; ?></h4>
            <br>
            <h4 id = "leftal"> Finish status : <?php 
                                                    if($row["finished"]==0)
                                                        echo "not finished"; ?></h4>
            <h4 id = "rightal"> Driver mob : <?php echo $row["driverno"]; ?></h4>

        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="5%">PID</th>
                <th style = "text-align:centre;" width="10%">Product name</th>
                <th style="text-align:centre;" width="10%">Quantity</th>
                <th style="text-align:centre;" width="5%">Finish status</th>
            </tr>	    
            <?php
                while($r = mysqli_fetch_assoc($res))
                {
                    $pquery = "SELECT pname from products where pid = ".$r["pid"]." limit 1";
                    $pres = mysqli_query($conn,$pquery);
                    $pres = mysqli_fetch_assoc($pres);
            ?>       

            <tr>
                <td style="text-align:centre;"><?php echo $r["pid"]?></td>
                <td><?php echo $pres["pname"]?></td>
                <td style="text-align:centre;"><?php echo $r["qty"]?></td>
                <td ><?php echo $r["finstage"]?></td>
            </tr>
            <?php
                }
                
            ?>                
        </tbody>
    </table>
    <?php
                }
    ?>            
</div>    
<?php    
}
else
{
    ?>
    <h2 style = "text-align:center;">No orders placed yet</h2>
<?php
}

?>

<br>
<a id="btnplace"  href="placeorder1.php" style="text-align: center">Place New Order</a>
<br>

<br>
<br>
<a id="btnplace"  href="cusupdatepayment.php" style="text-align: center">Update Payment</a>
<br>
    <br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
</body>
</html>
