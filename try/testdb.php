<?php

/*to connect to mysql : compulsory */

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbconnected = mysql_connect($hostname,$username,$password);
	
	if ($dbconnected) {
		echo "mysql  connectd ok <br/>";
	}
	else {
		echo "mysql connection failed<br/>";
	}
	
/*creates a database*/

	$dbname = "test1db";
	if (mysql_query("CREATE DATABASE $dbname")) {
		echo "'create database ".$dbname."' -successful <br/>";
	} else{
			echo "'create database ".$dbname."' -failed <br/>";
	}

/*selects a database that exists */
	
	$dbselected = mysql_select_db($dbname, $dbconnected);

		if ($dbselected)
			echo "db connected okay <br/>";
		else
			echo "db connection failed <br/>";

/*deletes a database*/

	$drop_SQL = "DROP DATABASE ".$dbname;

	if(mysql_query($drop_SQL)){
			echo "'Drop database ".$dbname."' -successful<br/>";
	} else{
			echo "'Drop database ".$dbname."' -failed<br/>";
	}

?>