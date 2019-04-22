
<?php
include "config.php";
session_start();
    

          

$query="SELECT name FROM employees";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)) 
{
    $empname[] = $row['name'];
}
if (!$result)
{
    echo "couldn't fetch names from employees table<br>";
}
else
{
   // print_r($empname);
}


if(isset($_POST["rememp"])){
    $name=$_POST["emprem"];
    echo $name;
    $query = "DELETE FROM employees WHERE name = '$name'";
    $result = mysqli_query($conn,$query);
    if ($result)
    {
        ?>
        <script>
            window.alert("Successfully removed <?php echo $name ?>!")
        </script>
       
       <?php 
    }
    else
    {
        echo "couldn't delete";
    }
    //header("location: empupdatestatusfinal.php" );
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
        <a href="gallery.html">Veiw Gallery</a>
       <a href="adminwelcome.php">Admin Dashboard</a>
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
    <br>
<h1 style ="text-align:  center; font-size: 22px">Welcome Admin! </h1>
<br>
<h1 style ="text-align:  center; font-size: 22px">Select the name of the employee to be removed </h1>
    <form action="adminrememp.php" method ="post">
        <select name=emprem id="soflow">
       
            <option selected="selected">Choose name </option>
            <?php
            foreach($empname as $k => $v){
            ?>
            <option value="<?php echo ($v); ?>"><?php echo $v; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
            <input type="submit" value="Remove employee"  name=rememp>
        <br>
    </form>
    <br>
    <a href="adminwelcome.php "><button style="width :26%; margin-left: 37%" >Go to Admin Dashboard</button></a>
    <br>
    <br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>
