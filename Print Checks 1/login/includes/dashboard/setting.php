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
	  <li class="active"><a href="index.php?setting">Setting</a></li>
	  <li class="active">View My Info</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<?php 
			include_once 'db/connect_db.php';
			//view employee info
			$Fetch_employee_id = ''; // get employee full name
			$Fetch_employee_namee = ''; // get employee full name
			$Fetch_employee_email =''; // get  Employee Email
			$Fetch_employee_cell_phone = ''; // get Employee Cell Phone
			$Fetch_employee_provider = ''; // get provider
			$Fetch_employee_service_type = ''; // get provider
			$Fetch_employee_token_id = ''; // get provider
			$Fetch_employee_pass = ''; // get provider
			$Fetch_employee_street = ''; // get provider
			$Fetch_employee_apt_or_suite_buildNum = ''; // get provider
			$Fetch_employee_city = ''; // get provider
			$Fetch_employee_state = ''; // get provider
			$Fetch_employee_zip = ''; // get provider
			$Fetch_paid = ''; // get provider
			$Fetch_active = ''; // get provider
			$registeredDate = ''; // get provider
			$ip = "";
			//get URL info
			$getEmployeesDetails = 
							mysql_query("select * from `it_team` where   email = '$acctEmail'
								order by id desc limit 1");
			$getEmployeesDetails_num_rows = mysql_num_rows($getEmployeesDetails); //Get clients info
			// if no clients
			if($getEmployeesDetails_num_rows < 1){ 
				echo "<p>No Employee with this info.</p>"; //no starred clients 
			}else{ // if clients are registered, show table 
				while ($row = mysql_fetch_assoc($getEmployeesDetails)){
					$Fetch_employee_id = $row['id'];
					$Fetch_employee_namee = $row['name'];
					$Fetch_employee_email = $row['email'];
					$Fetch_employee_cell_phone = $row['cell_phone'];
					// $Fetch_employee_provider = $row['provider'];
					$Fetch_employee_service_type = $row['service_type'];
					$Fetch_employee_pass = $row['pass'];
					$Fetch_employee_token_id = $row['rand_id'];
					$Fetch_employee_street = $row['street'];
					$Fetch_employee_apt_or_suite_buildNum = $row['apt_or_suite_buildNum'];
					$Fetch_employee_city = $row['city'];
					$Fetch_employee_state = $row['state'];
					$Fetch_employee_zip = $row['zip'];
					$Fetch_paid = $row['paid'];
					$Fetch_active = $row['active'];
					$Fetch_registered_on = $row['registered_on'];
					$time = strtotime($Fetch_registered_on);
					$registeredDate = date("D F jS, Y", $time);
					$ip = $row['ip'];
				}
			}
		
		?>
		<div class="col-sm-6">
		<form class="form-horizontal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">View My Info</h3>
					  </div>
					  <div class="modal-body aliceblue">
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Full Name
							</label>
							<div class="col-sm-9">
								<label class="col-sm-12   control-label cadetblue1 "><?php echo $Fetch_employee_namee;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">ID/Token ID
							</label>
							<div class="col-sm-9">
								<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_id." / ".$Fetch_employee_token_id;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Email
							</label>
							<div class="col-sm-9">
									<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_email;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Cell Phone
							</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_cell_phone;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">IP
							</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php echo $ip;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Sign As
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="You must choose employee type! Owner, Employee, Installer, Printer, Web Developer">
								</span> 
							</label>
							<div class="col-sm-9">
									<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_service_type;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Street
							</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_street;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Suite/Apt/Ext
							</label>
							<div class="col-sm-9">
									<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_apt_or_suite_buildNum;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">City
							</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_city;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">State
							</label>
							<div class="col-sm-9">
									<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_state;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Zip
							</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php echo $Fetch_employee_zip;?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Active
							</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php if($Fetch_active == 1) echo "Active"; else echo "Not Active";?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label for="" class="col-sm-3 control-label">Registered On</label>
							<div class="col-sm-9">
										<label class="col-sm-12    control-label cadetblue1 "><?php echo $registeredDate;?></label>
							</div>
						  </div>
					</div>
				  </div>
			</div>
		</form>


		</div>
		<div class="col-sm-6">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">Update My Info</h3>
					  </div>
					  <div class="modal-body aliceblue">
							  <!-- Add Comments here -->
							  <?php
								if(isset($_POST['updateNewEmployeeInfo'])){
									// Get all data from the fileds
									$EmployeeFullName = $_POST['EmployeeFullName']; // get employee full name
									$EmployeeEmail = $_POST['EmployeeEmail']; // get  Employee Email
									$EmployeeCellPhone = $_POST['EmployeeCellPhone']; // get Employee Cell Phone
									$EmployeePass = $_POST['EmployeePass']; // get Employee Pass
									$StreetAddress = $_POST['StreetAddress']; // get Street Address
									$SuiteAddress = $_POST['SuiteAddress']; // get Suite Address
									$CityAddress = $_POST['CityAddress']; // get City Address
									$StateAddress = $_POST['StateAddress']; // get State Address
									$ZipAddress = $_POST['ZipAddress']; // get Zip Address
									//if everything is validated and sanitized
									include_once $_inc_db.'connect_db.php';
									//now insert the info on the table - clients
									$updateNewEmploee = mysql_query("update `it_team` 
																			set 
																				name = '$EmployeeFullName',
																				email = '$EmployeeEmail',
																				cell_phone = '$EmployeeCellPhone',
																				pass = '$EmployeePass',
																				street = '$StreetAddress',
																				apt_or_suite_buildNum = '$SuiteAddress',
																				city = '$CityAddress',
																				state = '$StateAddress',
																				zip = '$ZipAddress'
																			where   
																				email = '$acctEmail'
																	"); //1 means is active
									if($updateNewEmploee){ 
										//if done, send an email
										echo "<p class='text-center' style='color: azure;border: 2px solid green;'>you have updated employee information successfully!<br>";
										echo "<script>setTimeout(\"location.href = 'index.php?setting';\",3000);</script>";
									}else{
										echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>>Something went wrong! Try again - Employee Not Added Yet</p>";
									}
								}
								?>
							  <!-- End Comments here -->
						  <div class="form-group">
							<label for="EmployeeFullName" class="col-sm-3 control-label">Full Name
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Employee full name">
								</span>
							</label>
							<div class="col-sm-9">
								<input type="text" value = "<?php echo $Fetch_employee_namee;?>" name="EmployeeFullName" placeholder="Ex: Salah Bedeiwi" class="form-control" id="EmployeeFullName" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="EmployeeEmail" class="col-sm-3 control-label">Email
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Employee Email">
								</span>
							</label>
							<div class="col-sm-9">
								<input type="email" value = "<?php echo $Fetch_employee_email;?>"  name="EmployeeEmail" placeholder="Ex: Salah_Bedeiwi@gmail.com" class="form-control" id="EmployeeEmail" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="EmployeeCellPhone" class="col-sm-3 control-label">Cell Phone
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Cell Phone to add employee - Only Numbers & No Spaces">
								</span>
							</label>
							<div class="col-sm-9">
								<input type="text" value = "<?php echo $Fetch_employee_cell_phone;?>"  name="EmployeeCellPhone" placeholder="Ex: 6126441634 - Only Numbers, no spaces" class="form-control" id="EmployeeCellPhone" required = "required" />
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="EmployeePass" class="col-sm-3 control-label">Password
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Create a good and strong password: Strong Pass Includes letters, 1-9 and $#*^%">
								</span>
							</label>
							<div class="col-sm-9">
								<input type="password" value="<?php echo $Fetch_employee_pass;?>" name="EmployeePass" placeholder="Strong Pass: letters, 1-9 and $#*^%" class="form-control" id="EmployeePass" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="StreetAddress" class="col-sm-3 control-label">Street
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Street Address">
								</span>
							</label>
							<div class="col-sm-9">
							  <input type="text"  value="<?php echo $Fetch_employee_street;?>" name="StreetAddress" placeholder="Ex: 123 Salah St NE" class="form-control" id="StreetAddress" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="SuiteAddress" class="col-sm-3 control-label">Suite/Apt/Ext
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Suite/Apt/Ext Numbers: Ex: Suite #124, Apt#405, ...">
								</span>
							</label>
							<div class="col-sm-9">
							  <input type="text"  value="<?php echo $Fetch_employee_apt_or_suite_buildNum;?>" name="SuiteAddress" placeholder="Ex: Suite #124, Apt#405, ..." class="form-control" id="SuiteAddress" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="CityAddress" class="col-sm-3 control-label">City
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter City Name: Ex: Minneapolis, Cairo, Casablanca">
								</span>
							</label>
							<div class="col-sm-9">
							  <input type="text"  value="<?php echo $Fetch_employee_city;?>" name="CityAddress" placeholder="Ex: Cairo" class="form-control" id="CityAddress" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="StateAddress" class="col-sm-3 control-label">State
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter State Name: Ex: Egypt, Minnesota">
								</span>
							</label>
							<div class="col-sm-9">
							  <input type="text"  value="<?php echo $Fetch_employee_state;?>" name="StateAddress" placeholder="Ex: Egypt, Minnesota" class="form-control" id="StateAddress" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="ZipAddress" class="col-sm-3 control-label">Zip
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Enter Zip Code: Ex: 11111, only numbers, no spaces">
								</span>
							</label>
							<div class="col-sm-9">
							  <input type="text" value = "<?php echo $Fetch_employee_zip;?>" name="ZipAddress" placeholder="Ex: 55443, only numbers, no spaces" class="form-control" id="ZipAddress" />
							</div>
						  </div>
					  <div class="modal-footer modelHeader">
						<button type="submit" name="updateNewEmployeeInfo" class="btn btn-primary">Save</button>
						<button type="reset" name="issueService" class="btn btn-warning">Reset</button>
					  </div>
					</div>
				  </div>
			</div>
		</form>


		</div>
	</div>
</div>
