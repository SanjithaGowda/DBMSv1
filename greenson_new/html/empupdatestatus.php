
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



$name= $_SESSION['empuname'];
$_SESSION["pono"]="";
$_SESSION["pocname"]="";
        

$query="SELECT pono FROM orders WHERE finished=0";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)) 
{
    $pendingpono[] = $row['pono'];
}
if (!$result)
{
    echo "couldn't fetch pono from order table<br>";
}
else
{
    //print_r($pendingpono);
}

$query="SELECT distinct cgst FROM orders WHERE finished=0";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)) 
{
    $pendingcgst[] = $row['cgst'];
}
if (!$result)
{
    echo "couldn't fetch cgst from order table<br>";
}
else
{
    //print_r($pendingcgst);
}

foreach($pendingcgst as $k => $v) 
{		    
    $query="SELECT * FROM customer WHERE gst = '$v'";
    $result = mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $pendingcname[] = $row['name'];
}

if ($result)
{
      //  echo "succesful<br>";
        //print_r($pendingcname);
}
else
{
        echo "couldn't fetch company names from customer table<br>";
}

if(isset($_POST["submitpono"])){
    $_SESSION["pono"]=$_POST["pono"];
    unset($_SESSION["pocname"]);
    //echo $_SESSION["pono"]."<br>";
    header("location: empupdatestatusfinal.php" );
}
else
{
    if(isset($_POST["submitcname"]))
    {
        $_SESSION["pocname"]=$_POST["cname"];
        unset($_SESSION["pono"]);
      //  echo $_SESSION["pocname"]."<br>";
        header("location: empupdatestatusfinal1.php" );
    }   
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
    select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-user-select: none;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin-left: 40%;
    margin-bottom: 2%;    
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
    }
  
input[type=submit] {
  background-color: grey;
  border: none;
  color: white;
  padding: 10px 22px;
  text-decoration: none;
  margin-left: 45%;
  cursor: pointer;
}   
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
       <a href="empviewsalary.php">View Salary</a>
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
    <br>
<h1 style ="text-align:  center; font-size: 22px">Welcome <?php echo $name; ?> ! </h1>
<br>
<h1 style ="text-align:  center; font-size: 22px">Select the invoice number of the product who's status needs to be updated </h1>
    <form action="empupdatestatus.php" method ="post">
        <select name=pono id="soflow">
       
            <option selected="selected">Choose invoice number</option>
            <?php
            foreach($pendingpono as $k => $v){
            ?>
            <option value="<?php echo ($v); ?>"><?php echo $v; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
            <input type="submit" value="update order status"  name=submitpono>
        <br>
    </form>
    <!---
    <h1 style ="text-align:  center; font-size: 32px"> OR </h1>
    
<h1 style ="text-align:  center; font-size: 22px">Select the name of the company who's order status needs to be updated </h1>
    <form action="empupdatestatus.php" method ="post" >
        <select name=cname id="soflow">
        <option selected="selected">Choose company name</option>
            <?php
            foreach($pendingcname as $k => $v){
            ?>
            <option value="<?php echo ($v); ?>"><?php echo $v; ?></option>
            <?php } ?>
            
        </select>
    <br>
        <br>
            <input type="submit" value="update order status"  name=submitcname>
        
    </form> -->

    <br>
    <br>
    <br>
    <br>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
