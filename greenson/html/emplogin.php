<?php
session_start();
include("config.php");
$error="";
$uname="";
$psw = "";
if(isset($_POST["reg_emp"])){
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    //echo "usernam eis ".$uname;
    $psw = mysqli_real_escape_string($conn, $_POST['psw']);
    $emp_chk_query = "SELECT * FROM employees WHERE uname='$uname'";
    $result = mysqli_query($conn,$emp_chk_query);
    $emp = mysqli_fetch_assoc($result);
    //echo "DISP NOW"." ".count($result);
    //echo $emp['username']." ".$emp['password'];
    if($emp['uname']){
        $pwd_orig = $emp['pwd'];
        if(md5($psw) == $pwd_orig){
            $_SESSION['emp']=$uname;
            echo "header not set";
           //header("Location: cuswelcome.php");
        }
        else{
            $error = "Password entered is invalid.";
        }
    }
    else{
        $error = "Username does not exist.";
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
       <a href="gallery.html">Veiw Gallery</a>
       <a href="#">Place an order</a>
       <a href="#">Track order</a>
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

<h2 style ="text-align:  center">Employee Login </h2>

<form action="emplogin.php" method="post">
  <div class="imgcontainer">
    <img src="../images/img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit" name = "reg_emp" >Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <br>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div>
      

 </form>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
