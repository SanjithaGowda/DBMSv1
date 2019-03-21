<?php
include "config.php";
session_start();

// initializing variables
$errors = array(); 


$cname="";
$cgst="";
$uname="";
$psw="";
$confirmpsw="";
$email="";
$mob1="";
$mob2="";
$address="";
$nameerror="";
$pswerror="";
$emailerror="";
$moberror = "";

// REGISTER USER
if (isset($_POST['reg_user'])) {
echo "entered isset";
  // receive all input values from the form
  $cname = mysqli_real_escape_string($conn, $_POST['cname']);
  $cgst = mysqli_real_escape_string($conn, $_POST['cgst']);
  $uname = mysqli_real_escape_string($conn, $_POST['uname']);
  $psw = mysqli_real_escape_string($conn, $_POST['psw']);
  $confirmpsw = mysqli_real_escape_string($conn, $_POST['confirmpsw']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $mob1 = mysqli_real_escape_string($conn, $_POST['mob1']);
  $mob2 = mysqli_real_escape_string($conn, $_POST['mob2']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  //echo $cname." ".$cgst." ".$uname." ".$psw." ".$confirmpsw." ".$email." ".$mob1." ".$mob2." ".$address;

    
    // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
 if ($psw != $confirmpsw) {
    array_push($errors, "The two passwords do not match");
     echo "The two passwords do not match";
     $pswerror="The two passwords do not match";
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM customer WHERE uname='$uname' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['uname'] === $uname) {
      array_push($errors, "Username already exists");
        echo "Username already exists";
        $nameerror="Username already exists";
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
        echo "email already exists";
        $emailerror="email already exists";
    }
      
    if ($user['mob1'] === $mob1) {
      array_push($errors, "mobile already exists");
        echo "mobile already exists";
        $moberror="mobile number already exists";
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
      $password = md5($psw);//encrypt the password before saving in the database

      $query = "INSERT INTO customer (address, email, gst,mob1,mob2,name,pwd,uname) 
                VALUES('$address', '$email', '$cgst','$mob1','$mob2','$cname','$password','$uname')";
      mysqli_query($conn, $query);
     $_SESSION['cuname'] = $uname;
  	$_SESSION['cgst'] = $cgst;
  	
      header("Location: cuswelcome.php");

   
   }
} ?>
 

<!DOCTYPE html> 
<html> 
<head> 
<style>
.error {color: #FF0000;}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" type="text/css" href="../css/stylecussignup.css"> 
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css"> 
</head> 
<body> 
<header> 
     
    <h1> GREENSON THERMAL TECHNOLOGIES </h1> 
</header> 
   
<div class="topnav"> 
   
   <div id="mySidenav" class="sidenav"> 
       <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
       <a href="home.html">Home</a>  
       <a href="gallery.html">Veiw Gallery</a> 
       <a href="home.html">Contact us</a> 
       <a href="mainlogin.html">Login</a> 
<!-- on logout send to home--> 
         
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
 
<h2 style ="text-align:  center">Customer Signup </h2> 
 
<form action="cussignup.php" method="post"> 
   
  <div class="container"> 
    <label for="cname"><b>Company name</b></label> 
    <input type="text" placeholder="Enter company name" name="cname" value="<?php echo $cname; ?>" required> 
      
    <label for="cgst"><b>Company GST</b></label> 
    <input type="text" placeholder="Enter gst number" name="cgst" value="<?php echo $cgst; ?>" required> 
 
    <label for="cgst"><b>Company address</b></label> 
    <input type="text" placeholder="Enter address" name="address" value="<?php echo $address; ?>" required> 

    
      <label for="uname"><b>Username</b></label> 
    <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $uname; ?>" required> 
    <span class="error">* <?php echo $nameerror;?><br></span>
      
    <label for="psw"><b>Password</b></label> 
    <input type="password" placeholder="Enter Password" name="psw"  required> 
    
    <label for="confirmpsw"><b>Re enter password</b></label> 
    <input type="password" placeholder="Confirm password" name="confirmpsw"  required> 
    <span class="error">* <?php echo $pswerror;?><br></span>
      
    <label for="email"><b>E-mail</b></label> 
    <input type="text" placeholder="Enter email" name="email" value="<?php echo $email; ?>" required> 
     <span class="error">* <?php echo $emailerror;?><br></span>
      
    <label for="mob1"><b>mobile number</b></label> 
    <input type="text" placeholder="Enter mobile number" name="mob1" value="<?php echo $mob1; ?>" required> 
     <span class="error">* <?php echo $moberror;?><br></span>
    
      <label for="mob2"><b>alternative mobile number </b></label> 
    <input type="text" placeholder="Enter Username" name="mob2" value ="<?php echo $mob2; ?>" > 
         
     <a href="cuslogin.php"><button type="submit" class="btn" name="reg_user" >Register</button></a> 
    <label> 
      <input type="checkbox" checked="checked" name="remember"> Remember me 
    </label> 
   <br> 
      </div> 
 
 </form> 
 
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>
  
</body> 
</html>
