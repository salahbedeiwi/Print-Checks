<div class="col-sm-12 registerForm">
	<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>" >
		<div class="col-md-6 mr">
		<?php
		if(isset($_POST['registerNow'])){
			
			// Get all data from the fileds
			$BusinessName = $_POST['BusinessName']; // get Business Name
			$BusinessAddress = $_POST['BusinessAddress']; // get Business Address
			$unit = $_POST['unit']; // get unit
			$City = $_POST['City']; // get City
			$State = $_POST['State']; // get State
			$Zip = $_POST['Zip']; // get Zip
			// $url = $_POST['url']; // get url
			$workPhone = $_POST['workPhone']; // get work Phone
			$fullname = $_POST['fullname']; // get name
			$Phone = $_POST['Phone']; // get Phone
			$Email = $_POST['Email']; // get Email
			$password = $_POST['password']; // get password
			$agreeTerms = $_POST['agreeTerms']; // get agree Terms to make sure it is checked
			//$Provider = $_POST['Provider']; // GET Provider name
			
			// Validate and sanitize all fields
			$check_BusinessName = filter_var($BusinessName,FILTER_SANITIZE_STRING);
			$check_BusinessAddress = filter_var($BusinessAddress,FILTER_SANITIZE_STRING);
			// $check_unit = filter_var($unit,FILTER_SANITIZE_STRING);
			$check_City = filter_var($City,FILTER_SANITIZE_STRING);
			$check_State = filter_var($State,FILTER_SANITIZE_STRING);
			$check_Zip = filter_var($Zip,FILTER_SANITIZE_NUMBER_INT);
			//$check_url = filter_var($url,FILTER_SANITIZE_URL);
			$check_workPhone = filter_var($workPhone,FILTER_SANITIZE_NUMBER_INT);
			$validate_workPhone = filter_var($check_workPhone,FILTER_VALIDATE_INT);
			$check_name = filter_var($fullname,FILTER_SANITIZE_STRING);
			$check_Phone = filter_var($Phone,FILTER_SANITIZE_NUMBER_INT);
			$validate_check_Phone = filter_var($check_Phone,FILTER_VALIDATE_INT);
			$sanitize_c_Email 	=  filter_var($Email,FILTER_SANITIZE_EMAIL);
			$check_email		=  filter_var($sanitize_c_Email,FILTER_VALIDATE_EMAIL);
			$check_password = filter_var($password,FILTER_SANITIZE_STRING);
			//$check_Service = filter_var($Provider,FILTER_SANITIZE_STRING);
			
			// validate all inputs
			if($check_BusinessName == FALSE || empty($BusinessName)){ 
				echo "<p class='red text-center'>Enter correct Business Name!</p>";
			}else if($check_BusinessAddress == FALSE || empty($BusinessAddress)){ 
				echo "<p class='red text-center'>Enter correct Business Address!</p>";
			}else if($check_City == FALSE || empty($City)){ 
				echo "<p class='red text-center'>Enter correct city!</p>";
			}else if($check_State == FALSE || empty($State)){ 
				echo "<p class='red text-center'>Enter correct state!</p>";
			}else if($check_Zip == FALSE || empty($Zip) || !is_numeric($Zip)){ 
				echo "<p class='red text-center'>Enter correct zip code!</p>";
			}
			// else if($check_url == FALSE || empty($url)){ 
				// echo "<p class='red text-center'>Enter correct and full URL!</p>";
			// }
			else if($check_workPhone == FALSE || empty($workPhone) || !is_numeric($workPhone)){ 
				echo "<p class='red text-center'>Enter correct work phone!</p>";
			}else if($check_name == FALSE || empty($fullname)){ 
				echo "<p class='red text-center'>Enter your correct name!</p>";
			}else if($check_Phone == FALSE || empty($Phone) || !is_numeric($Phone)){ 
				echo "<p class='red text-center'>Enter correct phone!</p>";
			}else if($check_email == FALSE || empty($Email)){ 
				echo "<p class='red text-center'>Enter correct email!</p>";
			}else if($check_password == FALSE || empty($password)){ 
				echo "<p class='red text-center'>Enter correct password!</p>";
			}
			// else if($check_Service == FALSE || empty($Provider)){ 
				// echo "<p class='red text-center'>Choose correct provider!</p>";
			// } 
			else { 
				//if everything is validated and sanitized
				include_once $_inc_db.'connect_db.php';
				
				$ip = getIp(); // get the ip address
				$rand_id = generateRandomNumber($length = 7); // Create random id for owners
				$findIfClientNewNumberIsFound = mysql_query("select  *  from `it_team` where rand_id = '$rand_id'") or die("Error: Generating an admin number -> ".mysql_error());
				$findIfClientNewNumberIsFound_num_rows = mysql_num_rows($findIfClientNewNumberIsFound); //counts and finds if the email is there already
				if($findIfClientNewNumberIsFound_num_rows < 1){ //if rand_id is not found, then generate it
					$rand_id = $rand_id;
				}else{ //if found, generate another number
					$rand_id = generateRandomNumber($length = 7);
				}
				// check wheather the email/customer does exist or has been registered
				$getEmail = mysql_query("select * from `it_team` where email = '$Email' ") or die("Error: looking for the same email -> ".mysql_error());
				$num_rows = mysql_num_rows($getEmail); //counts and finds if the email is there already
				// if found
				if($num_rows > 0){ 
					echo "<p class='red text-center' style='border: 2px solid #e41212;
						padding: 10px;
						background-color: #ffffff;
						color: #e41212;'>We found your email registered on our system! <br>
						If you feel this was by mistake, contact 
						<a href='http://www.salahbedeiwi.com/index.php?contact'>Us</a>!</p>";
				}else{// if a new admin
					//now insert the info on the table - clients
					//get current date and time not the server
					$insertAdmin = mysql_query("insert into `it_team` values (
								'',
								'$fullname',
								'$BusinessName',
								'$Email',
								'$workPhone',
								'$Phone',
								'$password',
								'admin',
								NOW(),
								'$ip',
								'$rand_id',
								'$mainURLforThisSite',
								'$BusinessAddress',
								'$unit',
								'$City',
								'$State',
								'$Zip',
								'yes',
								0
							)") or die("Error number: ".mysql_errno()." <br>Error: Inserting info into the table -> <br>".mysql_error() );
					//make sure it is not active => enter 0 at the end, so i can activate the admin later on track dashboard					
					//Send Email to the Customer! And Thank Them.
					//Send Me Email to Verify & Activate the customer!
					//send them the login information
					if(isset($insertAdmin)){
						//now send to the new client/business owner greeting
						$sub = "$BusinessName - Printing Checks Registeration";
						//from business owner to the new customer: 
						$headers  = "MIME-Version: 1.0"."\r\n";
						$headers .= "Content-type:text/html;charset:UTF-8"."\r\n";
						$headers .= "From: <$myEMAILtoReplyTo>"."\r\n" ; // this is the buz owner email to send customers and reply back - which is me (developer)
						//Email to the employee
						$userMessage  = 
							"<html>
								<body>
									
									<p>Thanks $fullname for registering your '$BusinessName' with us to print custom checks</p>
									<p>We have recieved your information and will get back as soon as possible</p>
									<p>Once we confirm your identities, you will be able to log in and enjoy your business</p>
									<p>To Log in on your account 
										Click on
										<a href='$mainURLforThisSite/login/index.php'>Log in</a> . Note: this is not might be active to login right away. Wait till you gain an access/activated by the development team. This may take time from 1-14 business days. If urgent, contact us.
									</p>
									<p>New Account Info:</p>
									<p>Email:$Email</p>
									<p>Pass:$password</p>
									<p>Admin Id:$rand_id</p>
									<p>We encourage your to keep your information confidential</p>
									<p style='font-weight:bolder;font-size:1.2em;'>Next Step</p>
									<p>You will be confirmed after we verify and setup your business.</p>
									<p>Once it is confirmed, you'll recieve an email to start login in your account</p>
									<p>Have a question? contact 
										<a href='http://www.salahbedeiwi.com/index.php?contact'>Us</a>! 
									</p>
									
									<br><br></br>
									<p>-System Adminstrator</p>
									<p style='margin-top:75px;float:right' >
									This Service is developed and running by <a href='http://www.salahbedeiwi.com'>Salah Bedeiwi</a><sup>&reg; Get Help Today</sup>. All Right Reserved!</p>
								</body>
							</html>";
						mail($Email, $sub, $userMessage, $headers); // to, subject, message, from: send to the client
						//now send me (developer) an email to verify and confirm the new admin: must set up the right domain name
						$sub1 = "Confirm and Verify new admin for Printing Custom Checks System - $BusinessName";
						//from business cliet to the IT Team: 
						$headers1  = "MIME-Version: 1.0"."\r\n";
						$headers1 .= "Content-type:text/html;charset:UTF-8"."\r\n";
						$headers1 .= "From: <$Email>"."\r\n" ; //from client to me/ IT Team
						//Email to IT Team
						$userMessage1  = 
							"<html>
								<body>
									<p>$BusinessName has registered today with you for Printing Custom Checks System</p>
									<p>To verify and confirm the business
										go to the databases, it_team table and active customer access ( change 0 [no active] to 1 [active] ).
									</p>
									<p>Main Login: <a href='$mainURLforThisSite/login/index.php'>here</a></p>
									<p>Email:$Email</p>
									<p>Pass:$password</p>
									<p>Admin Id:$rand_id</p>
									<p>Business Name:$BusinessName</p>
									<p>Phone:$Phone</p>
									<p>We encourage your to keep your information confidential</p>
									<p style='font-weight:bolder;font-size:1.2em;'>Next Step</p>
									<p>You will be confirmed after we verify and setup your business.</p>
									<p>Once it is confirmed, you'll recieve an email to start login in your account</p>
									
									<br><br></br>
									<p>-System Adminstrator</p>
									<p style='margin-top:75px;float:right' >
									This Service is developed and running by <a href='http://www.salahbedeiwi.com'>Salah Bedeiwi</a><sup>&reg; Get Help Today</sup>. All Right Reserved!</p>
								</body>
							</html>";
						mail($myEMAILtoReplyTo, $sub1, $userMessage1, $headers1); // to, subject, message, from: send to the client
						echo "<p class='green text-center' style='    border: 2px solid #0a6159;padding: 10px;background-color: #ffffff;color: #4c1919;'>
								Thanks For Subscribing Today! <br>
								Please check your email for login Info and verification!
							</p>";
					}else{
							echo "<p class='red text-center' style='    border: 2px solid #0a6159;padding: 10px;background-color: red;color: red;'>
										Somehow you will not recieve an email for verification this time! but don't worry, you have subscribed successfully! Contact us for any queries!
									</p>";
							echo "Error Message: ".mysql_error();
					}
					//refresh in 10 seconds: let the user redirected to the main login screen
					echo "<script>setTimeout(\"location.href = '../login/index.php';\",10000);</script>";
					}
				}
			}
		?>
		<!-- Subscribe by email -->
		<h2>About Your Business</h2>
		<hr>
			  <div class="form-group">
				<label for="BusinessName" class="col-sm-4 control-label">Business Name
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Your Business Name">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="BusinessName" class="form-control" id="BusinessName" placeholder="Your Business Name" required="required" autofocus>
				</div>
			  </div>
			  <!--<div class="form-group">
				  <label for="url" class="col-sm-4 control-label">
				  Website 
						<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Ex: http://www.domain.com.
								Or https://www.domain.com.
								If none  Enter: http://www.salahbedeiwi.com ">
								
					    </span>
				  </label>
				  <div class="col-sm-7">
					  <input type="url" name="url" class="form-control" id="url" placeholder="Your Website URL"  required="required">
				  </div>
			  </div>
			  -->
			  <div class="form-group">
				<label for="workPhone" class="col-sm-4 control-label">Work Phone
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="123 456 7890">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="workPhone" class="form-control" id="workPhone" placeholder="Your Work Phone"  required="required">
				</div>
			  </div>
			  <h2>Address</h2><hr>
			  <div class="form-group">
				<label for="BusinessAddress" class="col-sm-4 control-label">Business Address
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="123 Street Ave">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="BusinessAddress" class="form-control" id="BusinessAddress" placeholder="Your Business Address" required="required">
				</div>
			  </div>
			  <div class="form-group">
				<label for="unit" class="col-sm-4 control-label">Unit/Suite
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Suite 1234, if none enter 0">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="unit" placeholder="Unit/Suite, enter 0 if none" class="form-control" id="unit" required="required">
				</div>
			  </div>
			  <div class="form-group">
				<label for="City" class="col-sm-4 control-label">City
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Minneapolis">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="City" class="form-control" id="City" placeholder="Your City" required="required">
				</div>
			  </div>
			  <div class="form-group">
				<label for="State" class="col-sm-4 control-label">State
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Minnesota or Mn">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="State" class="form-control" id="State" placeholder="Your State" required="required">
				</div>
			  </div>
			  <div class="form-group">
				<label for="Zip" class="col-sm-4 control-label">Zip
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="12345">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="Zip" class="form-control" id="Zip" placeholder="Your Zip" required="required">
				</div>
			  </div>
		</div>
		<div class="col-md-6">
			<!-- Subscribe by phone -->
			<h2>About You</h2><hr>
			  <div class="form-group">
				<label for="fullname" class="col-sm-4 control-label">Full Name
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Salah Bedeiwi">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Your Name" required="required">
				</div>
			  </div>
			  <div class="form-group">
				<label for="Phone" class="col-sm-4 control-label">Phone Number
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="012 345 6789">
					</span>
				</label>
				<div class="col-sm-7">
				  <input type="text" name="Phone" class="form-control" id="Phone" placeholder="111 111 1111" required="required">
				</div>
			  </div>
			  <h2>Log In Info</h2>
			  <hr>
			  <div class="form-group">
				  <label for="Email" class="col-sm-4 control-label">Email Address
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Ex: yourEmail@domain.com">
					</span>
				  </label>
				  <div class="col-sm-7">
					  <input type="email" name="Email" class="form-control" id="Email" placeholder="Your Email" required="required">
				  </div>
			  </div>
			  <div class="form-group">
				  <label for="password" class="col-sm-4 control-label">Password
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Better to choose a strong password">
					</span>
				  </label>
				  <div class="col-sm-7">
					  <input type="password" name="password" class="form-control" id="password" placeholder="Your password" required="required">
				  </div>
			  </div>
			  <!--<h2>Carrier plan</h2>
			  <hr>
			  <div class="form-group">
				<label for="Provider" class="col-sm-4 control-label">Carrier Provider
					<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
							data-placement="right" 
								title="Choose your Carrier Provider, so you can reset your passwords, recieve notifications and so on!">
					</span>
				</label>
				<div class="col-sm-7">
				    <select name="Provider" class="form-control" id="Provider" required="required">
						<option value="">--Select--</option>
						<option value="vtext.com">Verizon Wireless</option>
						<option value="vmobl.com">Virgin Mobile</option>
						<option value="sms.alltelwireless.com">Alltel</option>
						<option value="txt.att.net">ATT</option>
						<option value="sms.myboostmobile.com">Boost Mobile</option>
						<option value="text.republicwireless.com">Republic Wireless</option>
						<option value="messaging.sprintpcs.com">Sprint</option>
						<option value="tmomail.net">T-Mobile</option>
						<option value="email.uscc.net">U.S. Cellular</option>
						<option value="tmomail.net">Simple Mobile</option>
					</select>
				</div>
			  </div>
			  -->
			  <div class="form-group">
				<div class="col-sm-offset-4 col-sm-10">
				  <div class="checkbox">
					<label>
					  <input name="agreeTerms" type="checkbox" required="required"> Agree to the terms and Conditions
					</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-4">
				  <button type="submit" name="registerNow" class="btn btn-default">Register Now</button>
				</div>
				<div class="col-sm-offset-2 col-sm-4">
				  <a href="../login"><button type="button" name="registerNow" class="btn btn-default">Login</button></a>
				</div>
			  </div>
		</div>
	</form>
	<div class="clearfix"></div>
</div>
