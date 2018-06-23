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
	  <li class="active"><a href="index.php?PrintChecks">Print Check(s)</a></li>
	  <li class="active">Print Check(s)</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<div class="col-sm-12">
		<?php 
			include_once 'db/connect_db.php';
			$getBankAccountInfo = 
			mysql_query("select * from `your_account` where active = 1 order by id ");
			$getBankAccountInfo_num_rows = mysql_num_rows($getBankAccountInfo); //Get bank info
			// if no clients
			if($getBankAccountInfo_num_rows < 1){ 
				echo "<p>You must add an account first</p>"; //no No Account with this info.
			}else{ // if clients are registered, show table 
		?>
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">Print Check(s)</h3>
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
									//get check number first, then add checking info.
									$getIdInfo = mysql_query("select * from `your_account` where id = '$accountNumberId' limit 1");

									$rowCheck = mysql_fetch_assoc($getIdInfo);
										$Fetch_check_number = $rowCheck['check_number']; //get the check number
										$addOneToCheckNumber = $Fetch_check_number + 1 ;
										function getRandIdNow($length = 7) {
											$characters = '0123456789'; //no &, so when searching by $_GET[], IT DOESN'T CONFUSE IT
											$charactersLength = strlen($characters);
											$randomString = '';
											for ($i = 0; $i < $length; $i++) {
												$randomString .= $characters[rand(0, $charactersLength - 1)];
											}
											return $randomString;
										};
									$rand_check_id = getRandIdNow(7);
									$addNewAccoutNow = mysql_query("insert into `create_check` 
																			values( '','$rand_check_id','$payee','$memo','$amount', '$Fetch_check_number',1,$accountNumberId) "); //1 means check is active, 0 is voided check
									if($addNewAccoutNow){ 
										//if done, show success message
										echo "<p class='text-center' style='color: green;border: 2px solid green;'>you have created new check successfully!<br>";
										//increment the check number 
										$updateCheckNumber = mysql_query("update `your_account` set check_number = '$addOneToCheckNumber' where id = '$accountNumberId' limit 1");
										
										//redirect to check number: so you can print/update
										echo "<script>setTimeout(\"location.href = 'index.php?chekNum=$rand_check_id';\",1000);</script>";
										
									}else{
										echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again!</p>";
									}
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
									<option value="" selected>Select An Account</option>
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
								<input type="text"  name="payee" placeholder="Pay to the order of..." class="form-control" id="payee" required = "required" />
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
								<input type="text"  name="memo" placeholder="Optional - Add Some Notes" class="form-control" id="memo"/>
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
								<input type="number" name="amount" placeholder="Amount: 120.50,100,95  'No $ sign'" class="form-control" id="amount" required = "required" step="0.01"/>
							</div>
						  </div>
					  <div class="modal-footer modelHeader">
						<button type="submit" name="printCheckNowBtn" class="btn btn-primary btn-sm">Create Check</button>
						<button type="reset" name="issueService" class="btn btn-warning btn-sm">Reset</button>
					  </div>
					</div>
				  </div>
			</div>
		</form>
		
		<?php } //end if account is found/setup ?>

		</div>
	</div>
</div>
