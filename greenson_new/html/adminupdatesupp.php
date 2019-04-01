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
$nsname="";
$nsaddr="";
$nsgst="";
$nsgst = mysqli_fetch_assoc(mysqli_query($conn,"SELECT max(sgst) as sgst from supplier"));
$nsgst = intval($nsgst["sgst"])+1;
// echo $npid;
$nsgst = "0".$nsgst;
if(isset($_POST["insnewsupp"])){
  $nsname = mysqli_real_escape_string($conn,$_POST["nsname"]);
  $nsaddr = mysqli_real_escape_string($conn,$_POST["nsaddr"]);
  $querynp = "INSERT INTO supplier (sgst, sname, saddr) VALUES ('$nsgst','$nsname','$nsaddr')";
  if(mysqli_query($conn,$querynp))
    echo "insert succesfull";      
  else
    echo "insert unsuccessful"; 
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/updatesupplier.css">
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
       <a href="adminupdatepay.php">Update Payment</a>
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminviewcust.php">View Customers</a>
       <a href="adminupdatepdts.php">Update products</a>
       <a href="adminorderrm.php">Order Raw Materials</a>
       <a href="adminwip.php">View Work in progress</a> 
       <a href="adminrememp.php">Remove employee</a> 
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

<h2 style ="text-align:  center"> Welcome ADMIN </h2>

<?php
$query = "SELECT * from supplier order by sgst asc";
$result = mysqli_query($conn, $query);
// echo "qis ".$query;
if(mysqli_num_rows($result))
{
?>    
<h2 style ="text-align:  center;">List of all suppliers</h2>
<div id="all-supp">
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="5%">Supplier GST</th>
                <th style = "text-align:centre;" width="10%">Supplier name</th>
                <th style="text-align:centre;" width="10%">Supplier address</th>
            </tr>	    
            <?php
                while($r = mysqli_fetch_assoc($result))
                {
            ?>       
            <tr>
                <td style="text-align:centre;"><?php echo $r["sgst"]?></td>
                <td ><?php echo $r["sname"]?></td>
                <td ><?php echo $r["saddr"]?></td>
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
    <h2 style = "text-align:center;">No suppliers added yet</h3>
<?php
}

?>

<button id="btnplace" onclick="document.getElementById('id01').style.display='block'" style="float:none">Insert new supplier</button>
<br>
<br>
<div id="id01" class="modal">
  <!-- <p>Enter new product details</p> -->
  <span onclick="document.getElementById('id01').style.display='none'" class="close cross" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="" method="post">
    <div class="container">
      <!-- <label for="nsgst"><b>New supplier GST</b></label>
      <input type="text" placeholder="Enter gst" name="nsgst" required> -->
      <label for="nsname"><b>New supplier name </b></label>
      <input type="text" name="nsname" required>
      <label for="nsaddr" ><b>Address </b></label>
      <input type="text"  name="nsaddr" required>      
      <br>
      <br>
      <br>
      <button type="submit" id="btnplace" name="insnewsupp" >Insert new supplier</button>
  </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<br>
<br>
<br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
</body>
</html>
