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
	  <li class="active"><a href="index.php?Account">Account(s)</a></li>
	  <li class="active">Add/View Account(s)</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<?php 
			include_once 'db/connect_db.php';
		?>
		<div class="col-sm-12">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">Add New Account</h3>
					  </div>
					  <div class="modal-body aliceblue">
							  <!-- Add Comments here -->
							  <?php
								if(isset($_POST['addNewAccount'])){
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
									$addNewAccoutNow = mysql_query("insert into `your_account` 
																			values( '','$FullName','$YourMainAddress','$CityStateZip', '$YourCellPhone',
																				'$BankType', '$BankName','$BankMainAddress','$BankCityStateZip','$BankAccountNumber',  '$RoutingNumber','$BankPhoneNumber', 1, 5000) "); //1 means is active, default check starts at 5000
									if($addNewAccoutNow){ 
										//if done, show success message
										echo "<p class='text-center' style='color: green;border: 2px solid green;'>you have added new bank account successfully!<br>";
									}else{
										echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again!</p>";
									}
								}
								?>
							  <!-- End Comments here -->
						  <div class="form-group">
							<label for="FullName" class="col-sm-4 control-label">Business Name
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Employee full name">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" name="FullName" placeholder="Ex: Salah Bedeiwi" class="form-control" id="FullName" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="YourCellPhone" class="col-sm-4 control-label">Business Phone
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Cell Phone to add employee - Only Numbers & No Spaces">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  name="YourCellPhone" placeholder="Ex: 6126441634 - Only Numbers, no spaces" class="form-control" id="YourCellPhone" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="YourMainAddress" class="col-sm-4 control-label">Business Address
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Your Address: 123 Sample St N">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  name="YourMainAddress" placeholder="123 Sample St N" class="form-control" id="YourMainAddress" required = "required" />
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="CityStateZip" class="col-sm-4 control-label">Business City, State Zip
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Minneapolis, MN 55555">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text" name="CityStateZip" placeholder="Minneapolis, MN 55555" class="form-control" id="CityStateZip" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankName" class="col-sm-4 control-label">Bank Account Name
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Bank Account Number">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text"  name="BankName" placeholder="Ex: Wells Fargo" class="form-control" id="BankName" />
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
								<input type="text"  name="BankMainAddress" placeholder="Bank Street Address" class="form-control" id="BankMainAddress" required = "required" />
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
								<input type="text" name="BankCityStateZip" placeholder="Minneapolis, MN 55555" class="form-control" id="BankCityStateZip" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankType" class="col-sm-4 control-label">Bank Account Type
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Zip Code: Ex: 11111, only numbers, no spaces">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text"  name="BankType" placeholder="Ex: 55443, only numbers, no spaces" class="form-control" id="BankType" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankAccountNumber" class="col-sm-4 control-label">Bank Account Number
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Zip Code: Ex: 11111, only numbers, no spaces">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text" name="BankAccountNumber" placeholder="Ex: 55443, only numbers, no spaces" class="form-control" id="BankAccountNumber" />
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
							  <input type="text"  name="RoutingNumber" placeholder="Ex: 0911-02352" class="form-control" id="RoutingNumber" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="BankPhoneNumber" class="col-sm-4 control-label">Bank Phone Number
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Bank Phone Number: 123456789">
								</span>
							</label>
							<div class="col-sm-8">
							  <input type="text"  name="BankPhoneNumber" placeholder="Ex: 123456789" class="form-control" id="BankPhoneNumber" required = "required" />
							</div>
						  </div>
						  
					  <div class="modal-footer modelHeader">
						<button type="submit" name="addNewAccount" class="btn btn-primary btn-sm">Add Account</button>
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
						<h3 class="modal-title" id="myModalLabel">View Account(s)</h3>
					  </div>
					  <div class="modal-body aliceblue">
						  <?php 
							$getBankAccountInfo = 
									mysql_query("select * from `your_account` order by id ");
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
									<th>Type</th>
									<th>Number</th>
									<th>View</th>
								  </tr>
								</thead>
								<tbody>
							<?php 
								while ($row = mysql_fetch_assoc($getBankAccountInfo)){
										$Fetch_getAccountId = $row['id'];
										$Fetch_acct_type= $row['acct_type'];
										$Fetch_bank_name = $row['bank_name'];
										$Fetch_acct_number = $row['acct_number'];
										$Fetch_active = $row['active'];
								?>
									  <tr>
										<td><?php echo $Fetch_getAccountId;?></td>
										<td><?php echo $Fetch_acct_type;?></td>
										<td><?php echo $Fetch_acct_number;?></td>
										<td><a href="index.php?acctId=<?php echo $Fetch_getAccountId;?>"><button type="button" class="btn btn-primary btn-sm">View</button></a></td>
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
	</div>
</div>
