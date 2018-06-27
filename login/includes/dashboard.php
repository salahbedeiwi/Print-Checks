<!-- Add Header -->
<?php include_once $_inc_tmp.'header.php';?>
<div class="clearfix"></div>	
<!-- End Header -->
<div class="col-sm-12 p-clear">
	<!-- Add Navbar -->
	<div class="col-sm-3 sidebar">
		<?php include_once $_inc_tmp.'sidebar.php';?>
	</div>
	<!-- End Navbar -->
	<!-- Add All Contents -->
	<div class="col-sm-9">
		
		<?php 
			if(isset($_GET['Account'])){ // Add new Account and view accounts page
				include_once $_inc_tmp.'dashboard/Account.php'; 
			}else if( isset($_GET['setting'])){ // setting page
				include_once $_inc_tmp.'dashboard/setting.php'; 
			}else if( isset($_GET['PrintChecks'])){ // Print Checks page
				include_once $_inc_tmp.'dashboard/PrintChecks.php'; 
			}else if( isset($_GET['acctId'])){ // View Created Bank Info
				include_once $_inc_tmp.'dashboard/showBankInfo.php'; 
			}else if( isset($_GET['chekNum']) ){ // View Created Checks Info
				include_once $_inc_tmp.'dashboard/showCheckInfo.php'; 
			}else if( isset($_GET['viewAllChecks']) ){ //view All Checks
				include_once $_inc_tmp.'dashboard/viewAllChecks.php'; 
			}else{ //  main dashboard page
				include_once $_inc_tmp.'dashboard/PrintChecks.php';
			}
			
		?>
	</div>
	<div class="clearfix"></div>
	<!-- End All Contents -->	
</div>
<div class="clearfix"></div>	
<!-- Add Footer
<div class="col-sm-12 p-clear">
	<?php include_once $_inc_tmp.'footer.php';?>
 -->
</div>
<!-- End Footer -
