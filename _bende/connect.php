<?php
$hostname = "uhlu.nl";
$username = "uhlu_data";
$password = "uhluchickssql";
$dbname = "uhlu_data";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");

$selected = mysql_select_db($dbname,$dbhandle) 
  or die("Could not select item ".$dbname);
?>