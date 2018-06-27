<br>
<div class="text-center">
<a class="" title="Back to Log in" 
	href="index.php"><button class="btn btn-success">Log In</button></a>
</div>
<div class="clearfix"></div>				

<div class="col-sm-6 mr">
		<?php
		//retrieve password when client enters an email
		// send email to the client
		if(isset($_POST['RetrievePassword'])){
			$email = $_POST['Email']; // get email
			//sanitize and validate the email
			$sanitize_c_Email 	=  filter_var($email,FILTER_SANITIZE_EMAIL);
			$check_email		=  filter_var($sanitize_c_Email,FILTER_VALIDATE_EMAIL);
			
			if($check_email == FALSE || empty($email)){ 
				echo "<p class='red text-center error'>Enter Correct Email!</p>";
			}else {
				include_once $_inc_db.'connect_db.php';
				$getEmail = 
				mysql_query("select * from `clients` 
					where email = '$email' and active =1 LIMIT 1");
				$num_rows = mysql_num_rows($getEmail); //counts and finds if the email is there already
				// if not active or not registered
				if($num_rows < 1){ 
					echo "<p class='red text-center' style='border:2px solid maroon;padding:10px'>
						Your account is on hold or you are not Registered !<br>
						 <a href='http://www.salahbedeiwi.com/index.php?contact'>Contact Us</a> or <a href='../register'>Register Now</a>
						 Thanks</p>";
				}else{
					//get the customer info from db, so you can send it to them
					$row = mysql_fetch_assoc($getEmail);
					$clientName = $row['name']; //get customer name
					$clientEmail = $row['email']; //email
					$clientPass = $row['pass']; //pass
					$memberId = $row['rand_id'];//get member rand id which is the member id
					// send email to the clients with password and login info
					$sub = 'Retrieve Password for Blast Emails';
					//from business owner to the new customer: 
					$headers  = "MIME-Version: 1.0"."\r\n";
					$headers .= "Content-type:text/html;charset:UTF-8"."\r\n";
					$headers .= 'From: <$buz_email>'."\r\n" ; // this is the buz owner email to send customers and reply back
					//msg to the employee
					$userMessage  = 
						"<html>
							<body>
								
								<p>Dear $clientName!</p>
								<p>Please use these info below for login into your account for email subscription</p>
								<ul>
									<li>Name:$clientName</li>
									<li>Email:$clientEmail</li>
									<li>pass:$clientPass</li>
									<li>Member Id:$memberId</li>
								</ul>
								<br><br></br>
								<p>-System Adminstrator</p>
								<p style='margin-top:75px;float:right' >
								This Service is developed and running by <a href='http://www.salahbedeiwi.com'>Salah Bedeiwi</a><sup>&reg; Get Help Today</sup>. All Right Reserved  &copy;!</p>
							</body>
						</html>";
					mail($email, $sub, $userMessage, $headers); // to, subject, message, from
					echo "<p style='border:2px solid green;padding:10px'>Thanks <spam style='color:maroon'>$clientName</spam>! Please Check your email</p>";
					echo "<script>setTimeout(\"location.href = 'index.php?loading&now';\",5000);</script>";
				}
			}
		}
		?>
		<!-- Log In here -->
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>" >
		  <div class="form-group">
			<label for="" class="col-sm-3 control-label"></label>
			<div class="col-sm-9">
              <h1>Forget Password</h1>
			</div>
		  </div>
		  <div class="form-group">
			<label for="Email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-6">
			  <input type="email" name="Email" class="form-control" id="Email" placeholder="Your Email" required="required">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-3 col-sm-10">
			  <button type="submit" name="RetrievePassword" class="btn btn-default">Send To Email</button>
			</div>
		  </div>
		</form>
	</div>
<div class="col-sm-6">
		<?php
		if(isset($_POST['retrieveEmailFromPhone'])){
			$Phone = $_POST['Phone']; // get Phone
			$Pass = $_POST['Password']; // get Password
			$City = $_POST['City']; // get City
			//sanitize and validate the email
			$check_Phone = filter_var($Phone,FILTER_SANITIZE_STRING);
			$check_Pass = filter_var($Pass,FILTER_SANITIZE_STRING);
			$check_City = filter_var($City,FILTER_SANITIZE_STRING);
			
			if($check_Phone == FALSE || empty($Phone)){ 
				echo "<p class='red text-center error'>Enter Correct Name!</p>";
			}else if($check_Pass == FALSE || empty($Pass)){ 
				echo "<p class='red text-center error'>Enter Correct PASSWORD!</p>";
			}else if($check_City == FALSE || empty($City)){ 
				echo "<p class='red text-center error'>Enter Correct City!</p>";
			} else {
				include_once $_inc_db.'connect_db.php';
				$getEmail = 
				mysql_query("select * from `clients` 
					where cell_phone = '$Phone' and pass = '$Pass' and city ='$City' and active =1 LIMIT 1");
				$num_rows = mysql_num_rows($getEmail); //counts and finds if the email is there already
				// if not active or not registered
				if($num_rows < 1){ 
					echo "<p class='red text-center' style='border:2px solid maroon;padding:10px'>
						Your account is on hold or you are not Registered !<br>
						 <a href='http://www.salahbedeiwi.com/index.php?contact'>Contact Us</a> or <a href='../register'>Register Now</a>
						 Thanks</p>";
				}else{
					//get the customer info from db, so you can send it to them
					$row = mysql_fetch_assoc($getEmail);
					$clientName = $row['name']; //get customer name
					$clientEmail = $row['email']; //email
					$clientPass = $row['pass']; //pass
					$memberId = $row['rand_id'];//get member rand id which is the member id
					echo "<p style='border:2px solid green;padding:10px'>Thanks <spam style='color:maroon'>$clientName</spam>
					! Your email is <spam style='color:maroon'>$clientEmail</spam></p>";
					echo "<script>setTimeout(\"location.href = 'index.php?loading&now';\",60000);</script>";
				}
			}
		}
		?>
		<!-- Log In here -->
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>" >
		  <div class="form-group">
			<label for="" class="col-sm-3 control-label"></label>
			<div class="col-sm-9">
              <h1>Forget Email</h1>
			</div>
		  </div>
		  <div class="form-group">
			<label for="Phone" class="col-sm-3 control-label">Phone</label>
			<div class="col-sm-6">
			  <input type="text" name="Phone" class="form-control" id="Phone" placeholder="Phone: 1111111111" required="required">
			</div>
		  </div>
		  <div class="form-group">
			<label for="City" class="col-sm-3 control-label">City</label>
			<div class="col-sm-6">
			  <input type="text" name="City" class="form-control" id="Phone" placeholder="Business City" required="required">
			</div>
		  </div>
		  <div class="form-group">
			<label for="Password" class="col-sm-3 control-label">Password</label>
			<div class="col-sm-6">
			  <input type="Password" name="Password" class="form-control" id="Password" placeholder="Your Password" required="required">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-3 col-sm-10">
			  <button type="submit" name="retrieveEmailFromPhone" class="btn btn-default">Retrieve here</button>
			</div>
		  </div>
		</form>
	</div>	
	<div class="clearfix"></div>
	<hr>
	<div class="text-center">
		<label>If you forget both email and password! Please 
			<a href='http://www.salahbedeiwi.com/index.php?contact'>Contact Us</a>
		</label><br>
		<label>If you forget your password! Please enter your email and check your email
		</label><br>
		<label>To get your email right away! Please enter your Phone, City and password</label><br>
	</div>
	