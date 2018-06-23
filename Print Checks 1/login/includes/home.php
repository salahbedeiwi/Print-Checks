<?php 
	$buz_id; //buz id
	$buz_email; //buz email
	$buz_name; //buz name
?>
<div class="col-sm-12 dashboardPage p-clear">
	<?php 
		//if IT Team logged in show this
		if(isset($_SESSION['login'])){ //give this session only for the IT Team
			include_once $_inc_tmp.'dashboard.php';  
		}else if(isset($_SESSION['login']) && isset($_SESSION['service_professional']) 
					&& isset($_SESSION['active']) &&isset($_SESSION['paid'])){//for all the clinets
			//for the clinets, make sure there is a session login, paid, active, and service type
			include_once $_inc_tmp.'clientDashboard.php';  
		}else{ //if open the page and no session LogIn
			include_once $_inc_tmp.'login/index.php'; 
		}
	?>
</div>
<!-- Add Copyright -->
<div class="clearfix"></div><br><br>	
<div class="col-sm-12 p-clear">
	<?php include_once $_inc_tmp.'copyright.php';?>
</div>
