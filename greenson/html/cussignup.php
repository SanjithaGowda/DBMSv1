<?php include('register.php') ?>

<!DOCTYPE html>
<html>
<head>
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
       <a href="gallery.html">Veiw Gallery</a>
       <a href="#">Place an order</a>
       <a href="#">Track order</a>
       <a href="#contact">Contact us</a>
       <a href="home.html">Home</a> 
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

      <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $uname; ?>" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw"  required>
      
    <label for="confirmpsw"><b>Re enter password</b></label>
    <input type="text" placeholder="Confirm password" name="confirmpsw"  required>
      
    <label for="email"><b>E-mail</b></label>
    <input type="text" placeholder="Enter email" name="email" value="<?php echo $email; ?>" required>
    
    <label for="mob1"><b>mobile number</b></label>
    <input type="text" placeholder="Enter mobile number" name="mob1" value="<?php echo $mob1; ?>" required>
    
    <label for="mob2"><b>alternative mobile number </b></label>
    <input type="text" placeholder="Enter Username" name="mob2" value ="<?php echo $mob2; ?>" >
        
    <button type="submit" href="cuslogin.html">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
   <br>
      </div>

 </form>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a><br></center></footer>
  
</body>
</html>
