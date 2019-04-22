<?php
session_start();
include("config.php");
$error="";

$uniqkey = mysqli_real_escape_string($conn,$_GET['key']);
if(isset($_POST["cust_reset_pwd"])){
    $npwd = mysqli_real_escape_string($conn, $_POST['npwd']);
    $cnpwd = mysqli_real_escape_string($conn, $_POST['cnpwd']);
    if($npwd!=$cnpwd){
        $error = "Passwords do not match!";
    }
    else{
        $rp_chk_query = "SELECT * FROM customer WHERE pwd='$uniqkey'";
        $result = mysqli_query($conn,$rp_chk_query);
        $emp = mysqli_fetch_assoc($result);
        $gst = $emp['gst'];
        if($emp['pwd']){  
           // $password = md5($psw);//encrypt the password before saving in the database
            $password = password_hash($npwd,PASSWORD_BCRYPT);
            $change_query = "UPDATE customer set pwd='$password' where gst='$gst'";
            mysqli_query($conn,$change_query);
            ?>

            <script>
            window.alert("Password updated successfully. Kindly login again");
            window.location = "cuslogin.php";
            </script>

    <?php        
                    }
        else{
            $error = "Invalid customer";
        }
   
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleemplogin.css">
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
       <a href="gallery.html">View Gallery</a>
       <a href="#contact">Contact us</a>
       <a href="mainsignup.html">Create account</a> 
       <a href="mainlogin.html">Login</a> 
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

<h2 style ="text-align:  center">Password updation for Customer </h2>

<form action="" method="post">
  <div class="container">
    <label for="npwd"><b>Enter new Password</b></label>
    <input type="password" placeholder="Enter Password" name="npwd" required >

    <label for="cnpwd"><b>Confirm new Password</b></label>
    <input type="password" placeholder="Enter Password" name="cnpwd" required>
        
    <button type="submit" name = "cust_reset_pwd" >Change Password</button>
    <!-- <p><a href="emp_frgt_pwd.php" style="text-decoration:none">Forgot password?</a></p> -->
    <br>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div>
      

 </form>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>