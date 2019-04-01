<?php
include "config.php";
session_start();

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

$query = "SELECT orders.pono as orpono, customer.name as cusname, orders.finished as orfin, orders.ocost as orcost from orders inner join customer on orders.cgst = customer.gst ";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)) {
    $resarr[] = $row;
    
}
$nrows = mysqli_num_rows($result);
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
       <a href="adminupdatepay.html">Update Payment</a>
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminupdatepdts.php">Update products</a>
       <a href="adminorderrm.php">Order Raw Materials</a>
       <a href="adminwip.php">View Work in progress</a>    
       <a href="home.html">Log-out</a>
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
    <br><?php
$query = "SELECT * from orders where finished=0 order by pono desc";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result))
{
?>    
<h1 style ="text-align:  center;font-size: 22px">Work in progress</h1>
<div id="track-order">
    
            <?php		
                while($row = mysqli_fetch_assoc($result))
                {
                    $query = "SELECT * from ordered_pdts1 where pono = ".$row["pono"];
                    $res = mysqli_query($conn,$query);
                    $gst = $row['cgst'];
                    $query1= "SELECT * from customer where gst = ".$gst;
                    $result1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $cname = $row1['uname'];
                    
                    
            ?><br>
            <h4 id = "leftal"> Company name : <?php 
                                                   echo $cname ?></h4>
            
            <h4 id = "rightal"> Order cost : <?php echo $row["ocost"]; ?></h4>
            <br>
            <h4 id="leftal"> PO Number : <?php echo $row["pono"]; ?></h4>
            <h4 id = "rightal">  </h4>

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
    <br><?php
$query = "SELECT * from orders where finished=1 order by pono desc";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result))
{
?>    
<h1 style ="text-align:  center;font-size: 22px">Finished and delivered orders</h1>
<div id="track-order">
    
            <?php		
                while($row = mysqli_fetch_assoc($result))
                {
                    $query = "SELECT * from ordered_pdts1 where pono = ".$row["pono"];
                    $res = mysqli_query($conn,$query);
                    $gst = $row['cgst'];
                    $query1= "SELECT * from customer where gst = ".$gst;
                    $result1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $cname = $row1['uname'];
                    
                    
            ?><br>
            <h4 id = "leftal"> Company name : <?php 
                                                   echo $cname ?></h4>
            
            <h4 id = "rightal"> Order cost : <?php echo $row["ocost"]; ?></h4>
            <br>
            <h4 id="leftal"> PO Number : <?php echo $row["pono"]; ?></h4>
            <h4 id = "rightal">  </h4>

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
    <h2 style = "text-align:center;">No orders finished yet</h2>
<?php
}

?>

    <br>
    <br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
