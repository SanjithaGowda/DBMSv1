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

          


$nrname="";
$nrcost="";
$nrqtyavail="";
$nrsgst="";
$msgtoshow="";
$nrid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT max(rid) as rid from rawmaterials"));
$nrid = intval($nrid["rid"])+1;
// echo $nrid;
if(isset($_POST["rid"])){
  $rid = mysqli_real_escape_string($conn,$_POST["rid"]);
  if(isset($_POST["rqtyavail"])){
    $qty = intval(mysqli_real_escape_string($conn,$_POST["rqtyavail"]));
    if(intval($qty) < 0){
        ?>
        <script>
            window.alert("Negative values cannot be accepted. Enter again");
        </script>    
    <?php
    }
    else
    {
    $query = "SELECT * from rawmaterials where rid=".$rid;
    $res1 = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $exqty = intval($res1["rqtyavail"]);
    $query = "UPDATE rawmaterials set rqtyavail=".($qty+$exqty)." where rid=".$rid;
    $qty = $qty+$exqty;
    if(mysqli_query($conn,$query))
      echo "insert succesfull";      
    else
      echo "insert unsuccessful";
    $query = "SELECT sname,saddr,rname from rawmaterials,supplier where rawmaterials.sgst=supplier.sgst and rid=".$rid;
    $res2 = mysqli_fetch_assoc(mysqli_query($conn, $query));  
    $msgtoshow = "Ordered raw material ".$res2["rname"]." of quantity ".($qty-$exqty)."<br> from supplier ".$res2["sname"]." located at ".$res2["saddr"];
    // echo $msgtoshow;
    }
    }
}
if(isset($_POST["insnewrm"])){
  $nrname = mysqli_real_escape_string($conn,$_POST["nrname"]);
  $nrcost = mysqli_real_escape_string($conn,$_POST["nrcost"]);
  $nrqtyavail = mysqli_real_escape_string($conn,$_POST["nrqtyavail"]);
  $nrsgst = mysqli_real_escape_string($conn,$_POST["nrsgst"]);
  $querynr = "INSERT INTO rawmaterials (rid, rname, rcost, rqtyavail, sgst) VALUES ('$nrid','$nrname','$nrcost','$nrqtyavail','$nrsgst')";
  echo $querynr;
  if(mysqli_query($conn,$querynr))
    echo "insert succesfull";      
  else
    echo "insert unsuccessful"; 
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/updateprod.css">
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
       <a href="adminwelcome.php">Admin welcome</a>
       <a href="adminupdatepay.php">Update Payment</a>
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminupdatesupp.php">Update Supplier</a>
       <a href="adminviewcust.php">View Customers</a>
       <a href="adminupdatepdts.php">Update products</a>
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
$query = "SELECT * from rawmaterials order by rid asc";
$result = mysqli_query($conn, $query);
// echo "qis ".$query;
if(mysqli_num_rows($result))
{
?>    
<h2 style ="text-align:  center;">List of all raw materials</h2>
<div id="all-prod">
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="10%">Raw material name</th>
                <th style = "text-align:centre;" width="5%">Supplier's GST</th>
                <th style="text-align:centre;" width="5%">Quantity available</th>
                <th style="text-align:centre;" width="5%">Raw material cost</th>
            </tr>	    
            <?php
                while($r = mysqli_fetch_assoc($result))
                {
            ?>       
            <tr>
                <td ><?php echo $r["rname"]?></td>
                <td style="text-align:centre;"><?php echo $r["sgst"]?></td>
                <td style="text-align:centre;"><?php echo $r["rqtyavail"]?></td>
                <td style="text-align:centre;"><?php echo $r["rcost"]?></td>
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
    <h2 style = "text-align:center;">No raw materials present yet</h3>
<?php
}

?>
    <h2 style="text-align: center" > <?php echo $msgtoshow;?></h2>
<div class ="all-prod dropdown"  >
  <form action = "" method="post">
  <?php
    $query = "SELECT rname,rid from rawmaterials order by rname asc";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result))
    {
      ?>
      <div style="margin-left:44%">
      <select id = "selprod" name="rid">
      <?php
      while($row = mysqli_fetch_assoc($result)){
        ?>

        <option value=<?php echo $row["rid"];?>> <?php echo $row["rname"];?></option>
      <?php    
      }
      ?>
      </select>
      <br>
      <br>
      <input type="numeric" id="selprod" placeholder="Enter new quantity" name = "rqtyavail" value="">
      <br>
      <br>
      </div>
      <input type="submit" id="btnplace" value="Add Quantity"> 
      
      <br>
    <?php
    }
    else
    {
      ?>
      <div class="no-records">No raw materials present</div>
    <?php  
    }
    ?>
  </form>  
</div>
<button id="btnplace" onclick="document.getElementById('id01').style.display='block'" style="float:none">Insert new raw material</button>
<br>
<br>
<a href="adminupdatesupp.php"><button id="btnplace">Insert new supplier</button></a>
<div id="id01" class="modal">
  <!-- <p>Enter new product details</p> -->
  <span onclick="document.getElementById('id01').style.display='none'" class="close cross" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="" method="post">
    <div class="container">
      <label for="nrname"><b>New raw material name</b></label>
      <input type="text" placeholder="Enter name" name="nrname" required>
      <label for="npcost"><b>Raw material cost </b></label>
      <input type="numeric" name="nrcost" required>
      <br>
      <label for="nrqtyavail" ><b>Quantity available </b></label>
      <input type="numeric"  name="nrqtyavail" required>      
      <br>
      <label for="nrsgst"><b>Supplier's GST <?php
                                            $q = "SELECT min(sgst) as min,max(sgst) as max FROM supplier";
                                            $res3 = mysqli_fetch_assoc(mysqli_query($conn, $q));
                                            echo "( in the range of ".$res3["min"]." to ".$res3["max"]." )";?></b></label>
      <input type="text" name="nrsgst">
      <br>
      <br>
      <br>
      <button type="submit" id="btnplace" name="insnewrm" >Insert new raw material</button>
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
