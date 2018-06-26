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
	  <li class="active"><a href="index.php?Account">View Account(s)</a></li>
	  <li class="active">View Bank Info</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<?php 
			include_once 'db/connect_db.php';
			//get URL info
			$getAccountId = $_GET['acctId'];
			//view bank info
			$Fetch_getAccountId = "";
			$Fetch_your_name = "";
			$Fetch_your_main_address = "";
			$Fetch_cityStateZip = "";
			$Fetch_your_phone_number = "";
			$Fetch_acct_type= "";
			$Fetch_bank_name = "";
			$Fetch_BankMainAddress = "";
			$Fetch_BankCityStateZip = "";
			$Fetch_acct_number = "";
			$Fetch_routing_number = "";
			$Fetch_bank_phone = "";
			$Fetch_active = "";
			$getBankAccountInfo = 
							mysql_query("select * from `your_account` where   id = '$getAccountId'
								order by id desc limit 1");
			$getBankAccountInfo_num_rows = mysql_num_rows($getBankAccountInfo); //Get bank info
			// if no clients
			if($getBankAccountInfo_num_rows < 1){ 
				echo "<p class='text-center' style='color: #a94442;border: 2px solid #a94442;'>No Account was found with this info.</p>"; //no No Account with this info.
			}else{ // if clients are registered, show table 
				while ($row = mysql_fetch_assoc($getBankAccountInfo)){
					$Fetch_getAccountId = $row['id'];
					$Fetch_your_name = $row['your_name'];
					$Fetch_your_main_address = $row['your_main_address'];
					$Fetch_cityStateZip = $row['cityStateZip'];
					$Fetch_your_phone_number = $row['your_phone_number'];
					$Fetch_acct_type= $row['acct_type'];
					$Fetch_bank_name = $row['bank_name'];
					$Fetch_BankMainAddress = $row['bank_main_strreet_address'];
					$Fetch_BankCityStateZip = $row['bank_cityZipCode'];
					$Fetch_acct_number = $row['acct_number'];
					$Fetch_routing_number = $row['routing_number'];
					$Fetch_bank_phone = $row['bank_phone'];
					$Fetch_active = $row['active'];
					$check_number = $row['check_number'];
		?>
		
		<div class="col-sm-12">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">View / Update My Account Info</h3>
					  </div>
					  <div class="modal-body aliceblue">
							  <!-- Update bank Info -->
							  <?php
								if(isset($_POST['updateBankAccountInfoNow'])){
									// Get all data from the fileds
									$FullName = $_POST['FullName']; // get full name
									$YourCellPhone = $_POST['YourCellPhone']; // get Cell Phone
									$YourMainAddress = $_POST['YourMainAddress']; // get Your Main Address
									$CityStateZip = $_POST['CityStateZip']; // get City State Zip
									$BankName = $_POST['BankName']; // get Bank Name
									$BankMainAddress = $_POST['BankMainAddress']; // get Your Bank Main Address
									$BankCityStateZip = $_POST['BankCityStateZip']; // get Bank City State Zip
									$BankType = $_POST['BankType']; // get Bank Type
									$BankAccountNumber = $_POST['BankAccountNumber']; // get Bank Account Number
									$RoutingNumber = $_POST['RoutingNumber']; // get Routing Number
									$BankPhoneNumber = $_POST['BankPhoneNumber']; // get Bank Phone Number
									//if everything is validated and sanitized
									include_once $_inc_db.'connect_db.php';
									//now insert the info on the table - clients
									$updateBankAccountInfo = mysql_query("update `your_account` 
																			set 
																				your_name = '$FullName',
																				your_phone_number = '$YourCellPhone',
																				your_main_address = '$YourMainAddress',
																				cityStateZip = '$CityStateZip',
																				bank_name = '$BankName',
																				bank_main_strreet_address = '$BankMainAddress',
																				bank_cityZipCode = '$BankCityStateZip',
																				acct_type = '$BankType',
																				acct_number = '$BankAccountNumber',
																				routing_number = '$RoutingNumber',
																				bank_phone = '$BankPhoneNumber'
																			where   
																				id = '$getAccountId'
																	"); //1 means is active
									if($updateBankAccountInfo){ 
										//if done, send an email
										echo "<p class='text-center' style='color: green;border: 2px solid green;'>We have updated bank information successfully!<br>";
										//echo "<script>setTimeout(\"location.href = 'index.php?acctId=$getAccountId';\",1000);</script>";
									}else{
										echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again - Bank Info Was Not Updated Yet</p>";
									}
								}
								?>
							  <!-- End Comments here -->
						  <div class="form-group">
							<label for="FullName" class="col-sm-4 control-label">Your Name
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter your full name">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" value = "<?php echo $Fetch_your_name;?>" name="FullName" placeholder="Ex: Salah Bedeiwi" class="form-control" id="FullName" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="YourCellPhone" class="col-sm-4 control-label">Your Phone
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter your Cell Phone- Only Numbers & No Spaces">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" value = "<?php echo $Fetch_your_phone_number;?>"  name="YourCellPhone" placeholder="Ex: 6126441634 - Only Numbers, no spaces" class="form-control" id="YourCellPhone" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="YourMainAddress" class="col-sm-4 control-label">Your Address
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Your Address: 123 Sample St N">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" value = "<?php echo $Fetch_your_main_address;?>"  name="YourMainAddress" placeholder="123 Sample St N" class="form-control" id="YourMainAddress" required = "required" />
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="CityStateZip" class="col-sm-4 control-label">City, State Zip
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Minneapolis, MN 55555">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" value="<?php echo $Fetch_cityStateZip;?>" name="CityStateZip" placeholder="Minneapolis, MN 55555" class="form-control" id="CityStateZip" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankName" class="col-sm-4 control-label">Bank Name
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Bank Account Name: Checking, Saving, .... etc">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text"  value="<?php echo $Fetch_bank_name;?>" name="BankName" placeholder="Ex: Wells Fargo" class="form-control" id="BankName" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankMainAddress" class="col-sm-4 control-label">Bank Main Address
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Bank Address: 123 Sample St N">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  value="<?php echo $Fetch_BankMainAddress; ?>" name="BankMainAddress" placeholder="Bank Street Address" class="form-control" id="BankMainAddress" required = "required" />
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="BankCityStateZip" class="col-sm-4 control-label">Bank City, State Zip
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Minneapolis, MN 55555">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" value="<?php echo $Fetch_BankCityStateZip; ?>" name="BankCityStateZip" placeholder="Minneapolis, MN 55555" class="form-control" id="BankCityStateZip" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankType" class="col-sm-4 control-label">Account Type
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Account Type: Ex: Checking, Saving, ...etc">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text" value = "<?php echo $Fetch_acct_type;?>" name="BankType" placeholder="Ex: Checking, Saving, ...etc" class="form-control" id="BankType" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankAccountNumber" class="col-sm-4 control-label">Account Number
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Account Number - Ex: 123456789">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text" value = "<?php echo $Fetch_acct_number;?>" name="BankAccountNumber" placeholder="Ex: 123456789" class="form-control" id="BankAccountNumber" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="RoutingNumber" class="col-sm-4 control-label">Routing Number
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Routing Number - Ex: 0911-02352">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text" value = "<?php echo $Fetch_routing_number;?>" name="RoutingNumber" placeholder="Ex: 0911-02352" class="form-control" id="RoutingNumber" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankPhoneNumber" class="col-sm-4 control-label">Bank Phone
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Bank Phone Number: 123456789">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text"  value="<?php echo $Fetch_bank_phone;?>" name="BankPhoneNumber" placeholder="Ex: 123456789" class="form-control" id="BankPhoneNumber" required = "required" />
							</div>
						  </div>
						  
					  <div class="modal-footer modelHeader">
						<button type="submit" name="updateBankAccountInfoNow" class="btn btn-primary btn-sm">Update</button>
						<button type="reset" name="issueService" class="btn btn-warning btn-sm">Reset</button>
					  </div>
					</div>
				  </div>
			</div>
		</form>


		</div>
		<!-- deactivate -->
		  <?php
			if(isset($_POST['deactiveBank'])){
				include_once $_inc_db.'connect_db.php';
				//now insert the info on the table - clients
				$deactiveBanktInfo = mysql_query("update `your_account` 
														set 
															active = 0
														where   
															id = '$getAccountId'
												"); //1 means is active
				if($deactiveBanktInfo){ 
					//if done, send an email
					echo "<p class='text-center' style='color: green;border: 2px solid green;'>We have deactivated your bank account!<br>";
					echo "<script>setTimeout(\"location.href = 'index.php?acctId=$getAccountId';\",1000);</script>";
				}else{
					echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again</p>";
				}
			}
			?>
			<!-- activate -->
		  <?php
			if(isset($_POST['activeBank'])){
				include_once $_inc_db.'connect_db.php';
				//now insert the info on the table - clients
				$activeBankInfo = mysql_query("update `your_account` 
														set 
															active = 1
														where   
															id = '$getAccountId'
												"); //1 means is active
				if($activeBankInfo){ 
					//if done, send an email
					echo "<p class='text-center' style='color: green;border: 2px solid green;'>We have activated your bank account!<br>";
					echo "<script>setTimeout(\"location.href = 'index.php?acctId=$getAccountId';\",1000);</script>";
				}else{
					echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again</p>";
				}
			}
			?>
		<div class="col-sm-12">
		<form  class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">Account Status</h3>
					  </div>
					  <div class="modal-body aliceblue">
						  <?php 
							$getBankAccountInfo = 
									mysql_query("select * from `your_account` where   id = '$getAccountId'
								order by id desc limit 1");
							$getBankAccountInfo_num_rows = mysql_num_rows($getBankAccountInfo); //Get bank info
							// if no clients
							if($getBankAccountInfo_num_rows < 1){ 
								echo "<p class='text-center' style='color: #a94442;border: 2px solid #a94442;'>No Account was added yet.</p>"; //no No Account with this info.
							}else{ // if clients are registered, show table 
							?>
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>N.</th>
									<th>Status</th>
									<th>Action</th>
									<th>Last Check</th>
								  </tr>
								</thead>
								<tbody>
							<?php 
								while ($row = mysql_fetch_assoc($getBankAccountInfo)){
										$Fetch_getAccountId = $row['id'];
										$Fetch_active = $row['active'];
										$check_number = $row['check_number'];
								?>
									  <tr>
										<td><?php echo $Fetch_getAccountId;?></td>
										<td><?php if($Fetch_active == 1) echo "<span style='color: green;'>Active</span>"; else  echo "<span style='color: red;'>Deactived</span>"?></td>
										<td>
											<?php 
												if($Fetch_active == 1) 
														echo '<button type="submit" name="deactiveBank" class="btn btn-danger btn-sm">Deactive</button>'; 
												else 
														echo '<button type="submit" name="activeBank" class="btn btn-success btn-sm">Activate</button>'; 
											?>
										</td>
										<td><?php echo $check_number;?></td>
									  </tr>
								
								<?php }
								}
							?>
						</tbody>
					  </table>
				  </div>
				  </div>
			</div>
		</form>


		</div>
<?php				}
			}?>
	</div>
</div>
