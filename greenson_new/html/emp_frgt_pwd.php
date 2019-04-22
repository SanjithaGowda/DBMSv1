<?php
session_start();
include("config.php");
$error="";
$fpemail="";
if(isset($_POST["fp_emp"])){
    $fpemail = mysqli_real_escape_string($conn, $_POST['fpemail']);
    $emp_chk_query = "SELECT * FROM employees WHERE email='$fpemail'";
    $result = mysqli_query($conn,$emp_chk_query);
    $emp = mysqli_fetch_assoc($result);
    if($emp["email"]){
        $uniqstr = $emp["pwd"];
        $resetPassLink = "http://localhost/greenson_new/html/emp_reset_pwd.php?key=".$uniqstr;
        $to = $emp['email'];
        $subject = "Password Update Request";
        $mailContent = 'Dear '.$emp['name'].', 
        <br/>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
        <br/>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
        <br/><br/>Regards,
        <br/>Greenson Thermal Technologies';
        //set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //additional headers
        $headers .= 'From: Greenson TTL<preethamanw@gmail.com>' . "\r\n";
        //send email
        mail($to,$subject,$mailContent,$headers);
        ?>
        <script>
        window.alert("Mail has been sent to the email id for password change.");
        </script>
    <?php
    }
    else{
        $error = "Email id not registered. Enter again";
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

<h2 style ="text-align:  center">Forgot password for Employee </h2>

<form action="" method="post">
 

  <div class="container">
    <label for="fpemail"><b>Email id</b></label>
    <input type="text" placeholder="Enter registered Email id" name="fpemail" required >        
    <button type="submit" name = "fp_emp" >Forgot password</button>
    <br>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div>
      

 </form>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>