<?php # Script mysql_connect.php

// This file contains the database access information. This file also establishes a connection to MySQL and selects the database.

// Set the database access information as constants.
define ('DB_USER','jobrooker');
define('DB_PASSWORD','bunk*eager-rarity');
define('DB_HOST','expresso');
define('DB_NAME','Compindel');

// Make the connection and then select the database.
$dbc = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) OR die('Could not connect to MySQL: ' . mysql_error());
@mysql_select_db(DB_NAME) or die('Could not select the database : ' . mysql_error());

?>
