<?php
include "config.php";
$res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT pname from products where pid = '1'"));
echo "res is ".$res["pname"];
?>