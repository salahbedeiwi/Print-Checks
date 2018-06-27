<?php
	//connect to new user
	$host_name = "localhost";
	$host_user = "root";
	$host_pass = "";
	$host_db   = "print_checks"; //db name
	
	$connect = @mysql_connect($host_name,$host_user,$host_pass) 
					or exit("Error1: Sorry you need to settup the user connection to the database. contact salahbedeiwi.com for this subscription<br>");
	//check for connection
	if(isset($connect)){ //if connected
		sleep(2); //delay the load for 3 seconds
		//echo "<p>Great, You have entered the right credintials for the users<br>";
		//echo "<p>Now check the databases</p> <br>";
		mysql_query('SET CHARACTER SET utf8'); //so you can write and read arabic in db and website
		mysql_query("SET NAMES utf8");; //so you can write and read arabic in db and website
		if(isset($host_db)){
			$connect_db = @mysql_select_db($host_db) 
								or exit("Database does not exist <br>");
			//echo "<p>And Great, Your databases does exist</p> <br>";
		}
	}else{ //if not connected
		echo "</p>Error2:, There is a problem connecting to the database</p> <br>";
	}
?>