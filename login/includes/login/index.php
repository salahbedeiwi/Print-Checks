<div class="col-sm-6">
	<?php
	// this is to let any one registerd and active can log in
	// they must be active 
	// redirect to the main page if logged in successfully
	// go to reset.php if they forgot password or email
	//or they can register if possible
	if(isset($_POST['login'])){
		$password = $_POST['password']; // get name
		$email = $_POST['email']; // get email
		//Validate the password
		$check_password = filter_var($password,FILTER_SANITIZE_STRING);
		//sanitize and validate the email
		$sanitize_c_Email 	=  filter_var($email,FILTER_SANITIZE_EMAIL);
		$check_email		=  filter_var($sanitize_c_Email,FILTER_VALIDATE_EMAIL);
		
		if($check_email == FALSE || empty($email)){ 
			echo "<p class='red text-center'>Enter Correct Email!</p>";
		}else if($check_password == FALSE || empty($password)){ 
			echo "<p class='red text-center'>Enter Correct password!</p>";
		}else {
			include_once $_inc_db.'connect_db.php';
			// Find if I am active . if yes, login else show error
			$getEmail = 
				mysql_query("select * from `it_team` 
					where email = '$email' and pass = '$password' and active =1 LIMIT 1");
			$num_rows = mysql_num_rows($getEmail); //counts and finds if the email is there already
			// if not active or not registered
			if($num_rows < 1){ 
				echo "<p class='red text-center showloginError' style='border: 2px solid #4c4c4c;
							padding: 10px;
							background-color: cadetblue;
							color: brown;
							margin-top: 11px;
							border-radius: 9px;'>
					Your account is on hold or you are not registered yet!
					 <br>If you recently registered, you will need to wait till we active your account (Usually 1-14 business days).<br> If urgent, contact us<br>
					 <a href='http://www.salahbedeiwi.com/index.php?contact'>Contact Us</a> or <a href='../register'>Register Now</a>.</p>";
			}else{
				// if customer available, give a session
				$_SESSION['login'] = $email; //set the session the email of the user
				//refresh in 5 seconds
				// echo "<script>setTimeout(\"location.href = 'index.php?loading&now';\",50);</script>";
				echo "<script>window.open('index.php?loading&now','_self')</script>";
				//echo "<script>setTimeout(\"location.href = 'index.php';\",5000);</script>";
			}
		}
	}
	?>
	<!-- Log In here -->
	<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>" >
	  <div class="form-group">
		<label for="" class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
		  <h1>Log In Here</h1>
		</div>
	  </div> 
	  <div class="form-group">
		<label for="email" class="col-sm-3 control-label">Email</label>
		<div class="col-sm-6">
		  <input type="email" autofocus="on" name="email" class="form-control" id="email" placeholder="Your Email" required="required">
		</div>
	  </div>
	  <div class="form-group">
		<label for="password" class="col-sm-3 control-label">Password</label>
		<div class="col-sm-6">
		  <input type="password" name="password" class="form-control" id="password" placeholder="Your password" required="required">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-3 col-sm-3">
		  <button type="submit" name="login" class="btn btn-default">Sign in</button>
		</div>
		<div class="col-sm-3">
		 <a href="./../register" class="pull-right"><button type="button" name="login" class="btn btn-default">Register</button></a>
		</div>
		
	  </div>
	   <div class="form-group">
		<label for="" class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
		  <p>
			  <a class="" title="Forgot Email" 
				href="index.php?reset&now"> Forgot Email</a> | 
			  <a class="" title="Forgot Password" 
				href="index.php?reset&now">Forgot Password</a>
		  </p>
		</div>
	  </div>
	</form>
</div>
	
	<div class="clearfix"></div>	