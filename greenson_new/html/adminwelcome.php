<?php
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

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/stylemainlogin.css">
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
       <a href="adminlogout.php">Logout</a>
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
<p style="text-align: center">Chose the option below for the required operations to be performed</p>
    <br>
<div class="row">
    <div class="column">
        <img src="../images/prodnserimg.jpg" alt="Snow" style="width:60%; padding-left: 20%; ">
        <br>
        <a href="adminupdatepdts.php"><button>Update Products</button></a>
    </div>
  
    <div class="column">
        <img src="../images/placeorder.png" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <a href="adminorderrm.php"><button>Order Raw Materials</button></a>
    </div>
  
    <div class="column">
        <img src="../images/payment.png" alt="payment" style="width:60%; padding-left: 20%;" >
        <br>
        <a href ="adminupdatesal.php"><button>Update Salary </button></a>
    </div>
</div>
  <div class="row">
    <div class="column">
  <img src="../images/supplier.png" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <a href="adminupdatesupp.php"><button>Update Suppliers</button></a>
      </div>
  
    <div class="column">
        <img src="../images/employee.png" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <a href="adminaddrememployee.php"><button>Add/Remove employees</button></a>
    </div>
  
    <div class="column">
        <img src="../images/track_order_delivery_search-512.png" alt="payment" style="width:60%; padding-left: 20%;" >
        <br>
        <a href ="adminupdatesal.php"><button>View Work In Progress </button></a>
    </div>
</div>
  <div class="row">
    <div class="column">
    </div>
  
    <div class="column">
        <img src="../images/customer1.png" alt="place order" style="width:60%; padding-left: 20%; ">
        <br>
        <a href="adminviewcust.php"><button>View customers</button></a>
    </div>

</div>
  
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
