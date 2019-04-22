
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

$newsal="0";
$newot="0";
$empid="";
$ot="";
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


if(isset($_POST["emprem"])){
    $name=$_POST["emprem"];
    echo $name;
    $query = "SELECT * FROM employees WHERE name = '$name'";
    $result = mysqli_query($conn,$query);
    if ($result)
    {
        //echo "successfulLY RETRIVED EMP DATA";
    }
    else
    {
        echo "failed";
    }
    $emp = mysqli_fetch_assoc($result);
    $bsal = $emp['bsal'];
    $empid = $emp['empid'];
    $ot  = $emp['ot'];
    $image = $emp['image'];
    $_SESSION['empidinadmin']=$empid;
   
}

if(isset($_POST["updatesal"])){
    
    $ot=$ot+$newot;
    $newsal = mysqli_real_escape_string($conn, $_POST['newsal']);
    $newot = mysqli_real_escape_string($conn, $_POST['newot']);
    $empid=$_SESSION['empidinadmin'];
    $query = "UPDATE employees SET bsal='$newsal',ot='$newot' WHERE empid='$empid' ";
    $result=mysqli_query($conn,$query);
    //echo $result." is the result <br>";
    
    //echo $query." is the query <br>";
    if($result)
    {
        //echo "succuss";
        header("location:adminempdetails.php");
            
    ?>
        <script>
            window.alert("Details updated salary = <?php echo $newsal; ?> and OT = <?php echo ot; ?>")
        </script>

    <?php
    }
    else
    {
        echo "couldn't update";
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
input[type=number] {
  padding: 10px 22px;
  text-decoration: none;
  cursor: pointer;
}  
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styletrackorder.css">
<link rel="stylesheet" type="text/css" href="../css/stylecuswelcome.css">
<link rel="stylesheet" type="text/css" href="../css/basiclayout.css">
<link rel="stylesheet" type="text/css" href="../css/stylecuslogin.css">
<link rel="stylesheet" type="text/css" href="../css/stylemainlogin.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#view").click(function(){
        $("table").toggle();
    });
});
</script>
    
<script src="jquery-1.7.1.min.js"></script>
<script>
function selectChange(val) {
    //Set the value of action in action attribute of form element.
    //Submit the form
    $('#myForm').submit();
}
</script>
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
<div id="track-order">
<button id="view" style="width: 40%; margin-left:30%">Click to view/hide details of employees</button>
    
          <table style="display:none;" class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:centre;" width="5%">Empid</th>
                <th style = "text-align:centre;" width="10%">Employee name</th>
                <th style="text-align:centre;" width="5%">Salary</th>
                
            </tr>	    
            <?php
                $query = "SELECT * from employees";
                $res = mysqli_query($conn,$query);

                while($r = mysqli_fetch_assoc($res))
                {
                    
            ?>       

            <tr>
                <td style="text-align:centre;"><?php echo $r["empid"]?></td>
                <td style="text-align:centre;"><?php echo $r["name"]?></td>
                <td style="text-align:centre;"><?php echo $r["bsal"]?></td>
            </tr>
            <?php
                }
                
            ?>                
        </tbody>
    </table>
    </div>

    <br>
  
<h1 style ="text-align:  center; font-size: 22px">Select the name of the employee to update salary </h1>
    <br>
    <form style="border: 0px" action="adminupdatesal.php" method ="post">
        <select name=emprem id="soflow" onchange="this.form.submit()">
       
            <option selected="selected">Choose name </option>
            <?php
            foreach($empname as $k => $v){
            ?>
            
            <option value="<?php echo ($v); ?>"><?php echo $v; ?></option>
            <?php } ?>
        </select>
        <br>
    </form>

    <?php    if(isset($_POST["emprem"])){ ?>

    <div class="imgcontainer" >
        
    <img src="<?php echo $image; ?>" alt="Avatar" class="avatar" width="7%" height="40%">
  </div>
<div class="container">
    
    <p style="text-align: center; font-size:20px;">
        <b>Employee ID: &nbsp; </b> <?php echo $empid; ?><br>
        <b>Base salary: &nbsp; </b> Rs. <?php echo $bsal; ?><br>
        <b>OT hours: &nbsp; </b> <?php echo $ot; ?> hrs <br>
        <b>Total Salary: &nbsp;</b> Rs.<?php echo $bsal+($ot*100);?> 
    </p>
    </div>
    
    <form id="salform" style="border: 0px;"  action="adminupdatesal.php" method="post"> 
   
        <div style="margin-left: 20%" class="row">
            <div class="column">
                <div class="container"> 
                    <label for="cname"><b>New Salary</b></label> 
                    <input type="number" placeholder="Enter Salary in Rs" name="newsal"  value="0"> 
                </div>
            </div>
  
            <div class="column">
                <div class="container"> 
                    <label for="cname"><b>OverTime in hrs</b></label> 
                    <input type="number" placeholder="Enter overtime" name="newot"  value="0"> 
                </div>    
            </div>
        </div>
        <br>      
        <br>
            <input type="submit" value="Update"  name=updatesal>
        <br>
    </form>
       <?php
} ?>
    <br>
    <br>
    <br>
<footer style="background-color: black;"> <center><a href="home.html" style="color: white">Home | </a><a href="gallery.html" style="color: white">Gallery | </a><a href="products.html" style="color: white">Products | </a><a href="home.html" style="color: white">About us |</a><a href="home.html" style="color: white">Contact us  </a><br>Developed by <br><a href="https://www.linkedin.com/in/sanjitha-gowda-94113b142/" style="color: white">Sanjitha Gowda</a>, <a href = "https://www.linkedin.com/in/tppreetham7/" style = "color:white"> Preetham T P</a><br></center></footer>

</body>
</html>