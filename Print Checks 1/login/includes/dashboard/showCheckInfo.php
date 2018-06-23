<div class="loader" id="loading">
	<img src="style/img/preloaders.gif" id="#loading-image" class="img-responsive center-block" alt="loading Image" />
</div>
<div id="hideAndShow">
	<ol class="pull-right todayDate">
		<?php $acctEmail = $_SESSION['login'];?>
		<?php 
			date_default_timezone_set("America/Chicago");
			$todayIs =  date("D F jS, Y g:i a");
			echo $todayIs;
		?>
	</ol>
	<ol class="breadcrumb">
	  <li><a href="index.php?index">Home</a></li>
	  <li class="active"><a href="index.php?viewAllChecks">View All Check(s)</a></li>
	  <li class="active">Print Check(s)</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<?php 
			include_once 'db/connect_db.php';
			$check_Rand_id = $_GET['chekNum'];
			$getBankAccountInfo = 
			mysql_query("select * from `your_account` where active = 1 order by id ");
			$getBankAccountInfo_num_rows = mysql_num_rows($getBankAccountInfo); //Get bank info
			// if no clients
			if($getBankAccountInfo_num_rows < 1){ 
				echo "<p>You must add an account first</p>"; //no No Account with this info.
			}else{ // if clients are registered, show table 
		?>
		<div class="col-sm-12">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">View Check(s)</h3>
					  </div>
					  <div class="modal-body aliceblue">
							  <!-- Add Comments here -->
							  <?php
								if(isset($_POST['printCheckNowBtn'])){
									// Get all data from the fileds
									$accountNumberId = $_POST['accountNumberId']; // get account Number Id
									$payee = $_POST['payee']; // get payee
									$memo = $_POST['memo']; // get memo
									$amount = $_POST['amount']; // get amount
									include_once $_inc_db.'connect_db.php';

									$updateCheckNow = mysql_query("update `create_check`
																			set 
																				bank_id = '$accountNumberId',
																				payee = '$payee',
																				memo = '$memo',
																				amount = '$amount'
																			where   
																				rand_id = '$check_Rand_id' 
									");
									if($updateCheckNow){ 
										//if done, show success message
										echo "<p class='text-center' style='color: green;border: 2px solid green;'>you have updated current check successfully!<br>";
										//increment the check number 
										//redirect to check number: so you can print/update
										echo "<script>setTimeout(\"location.href = 'index.php?chekNum=$check_Rand_id';\",1000);</script>";
										
									}else{
										echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again!</p>";
									}
								}
								?>
								<?php 
								//get check info
									include_once 'db/connect_db.php';
									$Fetch_get_check_id = "";
											$Fetch_rand_id = "";
											$Fetch_payee = "";
											$Fetch_memo = "";
											$Fetch_amount = "";
											$Fetch_check_number = "";
											$Fetch_check_status = "";
											$Fetch_bank_id = "";
									$getCurrentCheckInfo = 
										mysql_query("select * from `create_check` where rand_id = '$check_Rand_id' limit 1 ");
										while ($row = mysql_fetch_assoc($getCurrentCheckInfo)){
											$Fetch_get_check_id = $row['id'];
											$Fetch_rand_id = $row['rand_id'];
											$Fetch_payee = $row['payee'];
											$Fetch_memo = $row['memo'];
											$Fetch_amount = $row['amount'];
											$Fetch_check_number = $row['check_number'];
											$Fetch_check_status = $row['check_status'];
											$Fetch_bank_id = $row['bank_id'];
										}
								?>
							  <!-- End Comments here -->
						  <div class="form-group">
							<label for="accountNumberId" class="col-sm-4 control-label">Select Account
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Choose Your Bank: Bank Name - Type - Number">
								</span>
							</label>
							<div class="col-sm-8">
								<select class="form-control" name="accountNumberId" id="accountNumberId" required = "required">
									<?php 
									include_once 'db/connect_db.php';
									$getBankAccountInfoId = 
									mysql_query("select * from `your_account` where id = '$Fetch_get_check_id' limit 1");
									$getBankAccountInfo_num_id_rows = mysql_num_rows($getBankAccountInfoId); //Get bank info
										// if clients are registered, show table 
									while ($row = mysql_fetch_assoc($getBankAccountInfoId)){
										$Fetch_getAccountId = $row['id'];
										$Fetch_acct_type= $row['acct_type'];
										$Fetch_bank_name = $row['bank_name'];
										$Fetch_acct_number = $row['acct_number'];
										$viewBankTypeShortCut =  substr ( $Fetch_acct_type , 0 , 3 ); //first 3 letters/digits
										$viewBankNameShortCut =  substr ( $Fetch_bank_name , 0 , 3 );//first 3 letters/digits
										$viewBankAcctShortCut =  substr ( $Fetch_acct_number , -5 ); //get last 5 digits
										$Fetch_active = $row['active'];
										echo '<option value='.$Fetch_getAccountId.'>'.$viewBankNameShortCut .'. - ('.$viewBankTypeShortCut.'.) ****'.$viewBankAcctShortCut.'</option>'; //add accounts here (Name - Type - Number)
									}
									?>
									<?php 
									include_once 'db/connect_db.php';
									$getBankAccountInfoId = 
									mysql_query("select * from `your_account` where active = 1 order by id ");
									$getBankAccountInfo_num_id_rows = mysql_num_rows($getBankAccountInfoId); //Get bank info
									// if no clients
									if($getBankAccountInfo_num_id_rows < 1){ 
										echo "<option value=''>Need to add accounts</option>"; //no No Account with this info.
									}else{ // if clients are registered, show table 
										while ($row = mysql_fetch_assoc($getBankAccountInfoId)){
											$Fetch_getAccountId = $row['id'];
											$Fetch_acct_type= $row['acct_type'];
											$Fetch_bank_name = $row['bank_name'];
											$Fetch_acct_number = $row['acct_number'];
											$viewBankTypeShortCut =  substr ( $Fetch_acct_type , 0 , 3 ); //first 3 letters/digits
											$viewBankNameShortCut =  substr ( $Fetch_bank_name , 0 , 3 );//first 3 letters/digits
											$viewBankAcctShortCut =  substr ( $Fetch_acct_number , -5 ); //get last 5 digits
											$Fetch_active = $row['active'];
											echo '<option value='.$Fetch_getAccountId.'>'.$viewBankNameShortCut .'. - ('.$viewBankTypeShortCut.'.) ****'.$viewBankAcctShortCut.'</option>'; //add accounts here (Name - Type - Number)
										}
									}
									?>
								 </select>
							</div>
						  </div>
						  <div class="form-group">
							<label for="payee" class="col-sm-4 control-label">Payee
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Pay to the order of: business/personal name....">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  value="<?php echo $Fetch_payee; ?>" name="payee" placeholder="Pay to the order of..." class="form-control" id="payee" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="memo" class="col-sm-4 control-label">Memo
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Optional - Add Some Notes">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  value="<?php echo $Fetch_memo; ?>"name="memo" placeholder="Optional - Add Some Notes" class="form-control" id="memo"/>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="amount" class="col-sm-4 control-label">Amount in ($)
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Minneapolis, MN 55555">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="number" value="<?php echo $Fetch_amount; ?>"name="amount" placeholder="Amount: 120.50,100,95  'No $ sign'" class="form-control" id="amount" required = "required" step="0.01"/>
							</div>
						  </div>
					  <div class="modal-footer modelHeader">
						<button type="submit" name="printCheckNowBtn" class="btn btn-primary btn-sm">Update Check</button>
						<button type="reset" name="issueService" class="btn btn-warning btn-sm">Reset</button>
					  </div>
					</div>
				  </div>
			</div>
		</form>
		</div>
		<div class="col-sm-12">
		<form class="form-horizontal" method="" action="">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">Print Current Check</h3>
					  </div>
					  <div class="modal-body aliceblue">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>#</th>
									<th>Type</th>
									<th>Number</th>
									<th>View</th>
								  </tr>
								</thead>
								<tbody>
									  <tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									  </tr>
						</tbody>
					  </table>
				  </div>
				  </div>
			</div>
		</form>


		</div>
		<?php } //end if account is found/setup ?>

	</div>
</div>
