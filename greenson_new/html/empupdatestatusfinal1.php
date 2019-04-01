
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

if (isset($_SESSION['pocname']))
{
    echo "pocname";
    $cname = $_SESSION['pocname'];
    $query= "Select * from customer where name='$cname'";
    $result = mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $cgst=$row['gst'];
    if ($result)
    {
        echo "cgst of the company".$cgst."<br>";
    }
    
    $query= "Select * from orders where cgst='$cgst' and finished='0'";
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result)) {
		    $productpono = $row['pono'];
            $query="SELECT * FROM ordered_pdts1 WHERE pono='$productpono'";
            $result = mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($result)) 
            {
                $pendingpid[] = $row['pid'];
            }        
    }
    
    
    foreach($pendingpid as $k => $v) 
    {		    
        $query="SELECT * FROM products WHERE pid = '$v'";
        $result = mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
		    $product_array[] = $row;
        }		
        echo "<pre>"; print_r($product_array); echo "</pre>";
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
  margin-right: 5%;
  cursor: pointer;
    float: right;
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
<h1 style ="text-align:  center; font-size: 22px">Welcome <?php echo $name; ?> ! </h1>
<br>
<h1 style ="text-align:  center; font-size: 22px">invoice number : company name :<?php echo $cname; ?>  </h1>
    <?php
    if (!empty($product_array)) 
    { 
		      foreach($product_array as $key=>$value){
	   ?>
                <form method="post" action="empupdatestatusfinal.php">
                    <h2 style= "margin-left: 20px" >
                        <?php echo $product_array[$key]["pname"]; ?>
                    </h2>
                    <p style= "margin-left: 20px">
                        <?php echo "<b>Product ID : </b>".$product_array[$key]["pid"]."<br>"; ?> 
                        <?php 
                        $pidreq=$product_array[$key]["pid"];
                        $chkstatus_query = "SELECT * FROM ordered_pdts1 WHERE pono='$pono' and pid = $pidreq";
                        $result = mysqli_query($conn,$chkstatus_query);
                        $emp = mysqli_fetch_assoc($result);
                        $status= $emp['finstage'];
                        ?>   
                        <br>
                        <select name=status id="soflow">
                            <option selected="selected"><?php echo $status; ?></option>
                            <option value="accepted">Accepted</option>
                            <option value="manufacturing">Manufacturing</option>
                            <option value="delivered">Delivered</option>
                            <option value="recieved">Recieved</option>
                        </select>
                        <?php $val='updatestatus'.$pidreq; ?>
                        <input type="submit" value="Update Status"  name="<?php echo $val; ?>" >
                        <br>
                    </p>
                    
                </form>
    
            <?php
                  $val='updatestatus'.$pidreq;
                  if (isset($_POST[$val])) 
                  {
                    $statusreq = $_POST['status'];
                    $query="update ordered_pdts1 set finstage='$statusreq' where pono='$pono' and pid='$pidreq'";
                    $result = mysqli_query($conn,$query);
                      if(!$result)
                      {
                          echo "not successful";
                      }
                      
                  }
                  $chkstatus_query = "SELECT * FROM ordered_pdts1 WHERE pono='$pono' and pid = $pidreq";
                        $result = mysqli_query($conn,$chkstatus_query);
                        $emp = mysqli_fetch_assoc($result);
                        if ($result)
                        {
                            echo "<br> &nbsp; &nbsp; <b>Current status : </b>".$emp['finstage']."<br>";
                        }
                        else
                        {
                            echo "failed to take finstage from ordered status";
                        }
    
                    
                ?>
                  <br>
                    <hr style="width = 70%; margin-left=15%">
                    <br>
    <?php
		  }
    } ?>
                
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
