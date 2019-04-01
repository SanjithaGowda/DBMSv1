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
$query="SELECT paymentbal FROM customer WHERE gst = '$cgst';";
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
//echo $row['paymentbal']." is before comparing <br> ";
if($row['paymentbal']==NULL)
{
    $paymentbal=0;
}
else
{
    $paymentbal = ($row['paymentbal']);
}
    if (!mysqli_query($conn, $query))
        echo "couldnt get paymentbal";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleplaceorder.css">
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css">

  
<title>Greenson Thermal Technologies</title>
    <style>
    
    input[type=submit] {
  background-color: grey;
  border: none;
  color: white;
  padding: 10px 22px;
  text-decoration: none;
  margin-left: 48%;
  cursor: pointer;
   }   
input[type=number] {
  background-color: white;
   border-style: solid;
border-color: black;
  color: black;
  padding: 10px 22px;
  text-decoration: none;
  margin-right: 5%;
  cursor: pointer;
    margin-left: 45%;
}   
    </style>
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
       <a href="custrackorder.php">Track order</a>
       <a href="placeorder1.php">Place order</a>
       <a href="cuslogout.php">Logout</a>
        
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
<br>

<h1 style ="text-align:  center; font-size: 22px">Your payment balance is <br> <?php echo $paymentbal ?></h1>
<?php
if ($paymentbal>0)
    { ?>
        <form method="post" action="cusupdatepayment.php">
               <br>
            <br>
            <input type="number" class="product-quantity" name="quantity" min="1" max="<?php echo $paymentbal ?>" value="<?php echo $paymentbal ?>"  />
            <br>
            <br>
            <input type="submit" value="Pay"  name="pay" />
            <?php } ?>
        </form>
            <?php
		      if (isset($_POST['pay']))
              {
                  $payed=$_POST['quantity'];
                  $paymentbal=$paymentbal-$payed;
                  $query = "update customer set paymentbal = '$paymentbal' where gst = '$cgst'; ";        
                  if (!mysqli_query($conn, $query))
                        echo "couldnt update paymentbal";
                  else
                  { ?>
                      <script>window.alert("payment successful")</script>
                         <?php header("location:cusupdatepayment.php") ?>
                
                        
                <?php }
                  
              }
            ?>
    <br>
    <a id="btnplace"  href="placeorder1.php" style="text-align: center; float: left">Place another Order</a>
    <br>
    <br>
    <br>
    <a id="btnplace"  href="custrackorder.php" style="text-align: center; float: left">Track your Order</a><br>
    <br>
    
    <br>
<br>
    <br>

<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
</body>
</html>
