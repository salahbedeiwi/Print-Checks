<header class="header">
	<a class="pull-right pr-10" title="Log Out Now" 
			href="index.php?logout&now"> <button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button></a>
	<p class="pull-right pr-10">
	<?php 
		$userEmail = $_SESSION['login'];
		include_once 'db/connect_db.php';
		$userLoggedInInfo = 
		mysql_query("select * from `it_team` where email = '$userEmail' limit 1");
		$row = mysql_fetch_assoc($userLoggedInInfo);
		$userNameIs = $row['name'];
	?>
	<?php echo $userNameIs;?></p>
	<h2 class="lh-50 mt-neg-20 pl-10">Print Checks</h2>
</header>