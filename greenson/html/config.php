<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salmgmtv3";

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


class DBController{
    function runQuery($query) {
		$result = mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}

?>