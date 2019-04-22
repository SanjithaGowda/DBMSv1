<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salmgmtv3";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!($conn)) {
    echo "not connected ";
}


?>