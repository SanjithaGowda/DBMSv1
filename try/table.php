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
	
/*to select to a database*/	
	$dbname = "testdb";
	
	$dbselected = mysql_select_db($dbname, $dbconnected);

	if ($dbselected)
		echo "db connected okay <br/>";
	else
		echo "db connection failed <br/>";

/*create tcomapny table*/

	$tableName = "tCompany";	

	$tableField = array(
					'preName',
					'Name',
					'RegType',
					'StreetA',			
					'StreetB',			
					'StreetC',			
					'Town',			
					'County',			
					'Postcode',			
					'COUNTRY'				
		);
	$numFields = sizeof($tableField);
		
	echo '$numFields : '.$numFields.'<br />';

	$createTable_SQL = "
				CREATE TABLE testdb.".$tableName." (
				ID INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				preName VARCHAR( 50 ) ,
				Name VARCHAR( 250 ) NOT NULL,
				RegType VARCHAR( 50 )  NULL,
				
				StreetA VARCHAR( 150 )  NULL,
				StreetB VARCHAR( 150 )  NULL,
				StreetC VARCHAR( 150 )  NULL,
				Town VARCHAR( 150 )  NULL,
				County VARCHAR( 150 )  NULL,
				Postcode VARCHAR( 50 )  NULL,
				
				COUNTRY VARCHAR( 250 ) NOT NULL
	)";
	
	
	if (mysql_query($createTable_SQL))  {	
		echo "'CREATE ".$tableName."' -  Successful.";
	} else {
		echo "'CREATE ".$tableName."' - Failed.";
	}
	
	$tableName = "tPerson";	
	$tableField = array(
					'Salutation',
					'FirstName',
					'LastName',
					'CompanyID'
	);
	$numFields = sizeof($tableField);
			
	$createTable_SQL =  "CREATE TABLE testdb.".$tableName." (
								ID INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
								Salutation VARCHAR( 20 ) , 
								FirstName VARCHAR( 50 ) , 
								LastName VARCHAR( 50 ) NOT NULL, 
								CompanyID INT ( 11 ) NOT NULL 
	)";
	
	if (mysql_query($createTable_SQL))  {	
		echo "'CREATE ".$tableName."' -  Successful.";
	} else {
		echo "'CREATE ".$tableName."' - Failed.";
	}
	
?>
	
		
	