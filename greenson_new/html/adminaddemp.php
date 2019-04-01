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

$errors = array(); 

$name="";
$empid="";
$uname="";
$psw="";
$bsal="";
$image="";
$confirmpsw="";
$nameerror="";
$pswerror="";

echo "here";
if (isset($_POST['reg_emp']))
{
  echo "entered isset";
  // receive all input values from the form
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $empid = mysqli_real_escape_string($conn, $_POST['empid']);
  $uname = mysqli_real_escape_string($conn, $_POST['uname']);
  $psw = mysqli_real_escape_string($conn, $_POST['psw']);
  $bsal = mysqli_real_escape_string($conn, $_POST['bsal']);
  $confirmpsw = mysqli_real_escape_string($conn, $_POST['confirmpsw']);
  $image = "empimg/".$empid.".jpg";
  //echo $cname." ".$cgst." ".$uname." ".$psw." ".$confirmpsw." ".$email." ".$mob1." ".$mob2." ".$address;
    
  if ($psw != $confirmpsw) {
     array_push($errors, "The two passwords do not match");
     echo "The two passwords do not match";
     $pswerror="The two passwords do not match";
  }

  $user_check_query = "SELECT * FROM employees WHERE uname='$uname' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['uname'] === $uname) {
      array_push($errors, "Username already exists");
        echo "Username already exists";
        $nameerror="Username already exists";
    }
  }
    
  if (count($errors) == 0) {
      $psw = md5($psw);//encrypt the password before saving in the database    
      $query = "INSERT INTO employees(name,empid,uname,pwd,bsal,image) VALUES ('$name','$empid','$uname','$psw','$bsal','$image')";
      $result = mysqli_query($conn, $query);
      if ($result){
    ?>
<script> window.alert("added <?php echo $name; ?> succesfully")</script>
<?php
        echo "added successfully";
      }
      else
        echo "couldn't add";
  }
}
?>
 

<!DOCTYPE html> 
<html> 
<head> 
<style>
.error {color: #FF0000;}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" type="text/css" href="../css/stylecussignup.css"> 
<link rel="stylesheet" type="text/css" href="../css/stylecuswelcome.css"> 
    
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css"> 
</head> 
<body> 
<header> 
     
    <h1> GREENSON THERMAL TECHNOLOGIES </h1> 
</header> 
   
<div class="topnav"> 
   
   <div id="mySidenav" class="sidenav"> 
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
       <a href="adminwelcome.php">Admin welcome</a>
       <!-- <a href="adminupdatepay.php">Update Payment</a> -->
       <a href="adminupdatesal.php">Update Salary</a>
       <a href="adminupdatesupp.php">Update Supplier</a>
       <a href="adminviewcust.php">View Customers</a>
       <a href="adminupdatepdts.php">Update products</a>
       <a href="adminorderrm.php">Order Raw Materials</a>
       <a href="adminwip.php">View Work in progress</a> 
       <a href="adminrememp.php">Remove employee</a> 
       <a href="cuslogout.php">Log-out</a>  
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
 
<h2 style ="text-align:  center">Add Employee! </h2> 
 
<form action="adminaddemp.php" method="post"> 
   
  <div class="container"> 
    <label for="cname"><b>Employee name</b></label> 
    <input type="text" placeholder="Enter employee name" name="name"  required> 
      
    <label for="cgst"><b>Employee ID</b></label> 
    <input type="text" placeholder="Enter employee ID" name="empid"  required> 
    
      <label for="uname"><b>Username</b></label> 
    <input type="text" placeholder="Enter Username" name="uname"  required> 
    <span class="error">* <?php echo $nameerror;?><br></span>
      
    <label for="psw"><b>Password</b></label> 
    <input type="password" placeholder="Enter Password" name="psw"  required> 
    
    <label for="confirmpsw"><b>Re enter password</b></label> 
    <input type="password" placeholder="Confirm password" name="confirmpsw"  required> 
    <span class="error">* <?php echo $pswerror;?><br></span>
      
      <label for="bsal"><b>Base Salary</b></label> 
    <input type="text" placeholder="Enter base salary" name="bsal"  required> 
    
      
     <button type="submit" class="btn" name="reg_emp" >Register</button>
       <br> 
      </div> 
 
 </form> 
    <br>
    <a href="adminwelcome.php "><button style="width :26%; margin-left: 37%" >Go to Admin Dashboard</button></a>
    <br>
    <br>
 
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
  
</body> 
</html>
