<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salmgmtv2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn) {
    echo "connected ";
}
else
{
    echo "not connected";
}// Check connection
?>