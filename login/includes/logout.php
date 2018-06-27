<?php 
	// session_start();
	session_unset();
	session_destroy();
	// echo "<script>window.open('index.php','_self')</script>";
	// echo "<script>setTimeout(\"location.href = 'index.php?loading&now';\",50);</script>";
	echo "<script>window.open('index.php?loading&now','_self')</script>";
?>