<?php
include "config.php";
session_start();

if(!isset($_SESSION['admin'])){
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

          

$npname="";
$npcost="";
$npqtyavail="";
$npdesc="";
$npid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT max(pid) as pid from products"));
$npid = intval($npid["pid"])+1;
// echo $npid;
if(isset($_POST["pid"])){
  $pid = mysqli_real_escape_string($conn,$_POST["pid"]);
  if(isset($_POST["qtyavail"])){
    $qty = mysqli_real_escape_string($conn,$_POST["qtyavail"]);
    if(intval($qty) < 0){
        ?>
        <script>
        window.alert("Negative values cannot be accepted. Enter again");
        </script>
    <?php
    }
    else
    {
    $query = "SELECT qtyavail from products where pid=".$pid;
    $res = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $exqty = intval($res["qtyavail"]);
    $query = "UPDATE products set qtyavail=".($qty+$exqty)." where pid=".$pid;
    if(mysqli_query($conn,$query))
      echo "insert succesfull";      
    else
      echo "insert unsuccessful";
    }
    }
}
if(isset($_POST["insnewprod"])){
  $npname = mysqli_real_escape_string($conn,$_POST["npname"]);
  $npcost = mysqli_real_escape_string($conn,$_POST["npcost"]);
  $npqtyavail = mysqli_real_escape_string($conn,$_POST["npqtyavail"]);
  $npdesc = mysqli_real_escape_string($conn,$_POST["npdesc"]);
  $querynp = "INSERT INTO products (pid, pname, pcost, qtyavail, pdesc) VALUES ('$npid','$npname','$npcost','$npqtyavail','$npdesc')";
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
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
       <a href="adminwelcome.php">Admin welcome</a>
       <a href="adminupdatepay.php">Update Payment</a>
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminupdatesupp.php">Update Supplier</a>
       <a href="adminviewcust.php">View Customers</a>
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
$query = "SELECT * from products order by pid asc";
$result = mysqli_query($conn, $query);
// echo "qis ".$query;
if(mysqli_num_rows($result))
{
?>    
<h2 style ="text-align:  center;">List of all products</h2>
<div id="all-prod">
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="10%">Product name</th>
                <th style = "text-align:centre;" width="10%">Product description</th>
                <th style="text-align:centre;" width="5%">Quantity available</th>
                <th style="text-align:centre;" width="5%">Product cost</th>
            </tr>	    
            <?php
                while($r = mysqli_fetch_assoc($result))
                {
            ?>       
            <tr>
                <td ><?php echo $r["pname"]?></td>
                <td ><?php echo $r["pdesc"]?></td>
                <td style="text-align:centre;"><?php echo $r["qtyavail"]?></td>
                <td style="text-align:centre;"><?php echo $r["pcost"]?></td>
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
    <h2 style = "text-align:center;">No products added yet</h3>
<?php
}

?>
<div class ="all-prod dropdown">
  <form action = "" method="post">
  <?php
    $query = "SELECT pname,pid from products order by pname asc";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result))
    {
      ?>
      <select style="margin-left:40%" id = "selprod" name="pid">
      <?php
      while($row = mysqli_fetch_assoc($result)){
        ?>

        <option  value=<?php echo $row["pid"];?>><?php echo $row["pname"];?></option>
      
      <?php    
      }
      ?>
          
      </select>
      <br>
      <br>
      <input style="margin-left:45%" type="numeric" id="selprod" placeholder="Enter new quantity" name = "qtyavail" value=""><br>
      <br>
      <input type="submit" id="btnplace" value="Add Quantity">  
    <?php
    }
    else
    {
      ?>
      <div class="no-records">No products inserted yet!</div>
    <?php  
    }
    ?>
  </form>  
    </div>
<br>

<button id="btnplace" onclick="document.getElementById('id01').style.display='block'" style="float:none">Insert new product</button>
<br>
<br>
<div id="id01" class="modal">
  <!-- <p>Enter new product details</p> -->
  <span onclick="document.getElementById('id01').style.display='none'" class="close cross" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="" method="post">
    <div class="container">
      <label for="npname"><b>New product name</b></label>
      <input type="text" placeholder="Enter name" name="npname" required>
      <label for="npcost"><b>Product cost &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </b></label>
      <input type="numeric" name="npcost" required>
      <br>
      <label for="npqtyavail" ><b>Quantity available </b></label>
      <input type="numeric"  name="npqtyavail" required>      
      <br>
      <label for="npdesc"><b>Product description</b></label>
      <input type="text" name="npdesc">
      <br>
      <br>
      <br>
      <button type="submit" id="btnplace" name="insnewprod" >Insert new product</button>
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
