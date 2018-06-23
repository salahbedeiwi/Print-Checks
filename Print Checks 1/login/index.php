<?php session_start();?>
<?php $paid = "yes"; //yes or no?>
<?php if($paid == "yes"){?>
<!DOCTYPE html>
<html>
	<?php include_once "ini.php";?>
	<?php include_once $_func_include."functions.php";?>
	<?php $_SESSION['id'] = 1; //enter the buziness id on here ?>
	<?php $buz_id = $_SESSION['id'];?>
	<?php 
		//get clients info, so you can send emails, sub and unsubscribe
		include_once $_inc_db.'connect_db.php';
		$getClientInfo = mysql_query("select * from `clients` where id = $buz_id and active =1 LIMIT 1");
		$num_rows = mysql_num_rows($getClientInfo); //counts and finds if the email is there already
		// if found
		if($num_rows <= 0){ 
			echo "<p class='red text-center' style='border:2px solid maroon;padding:10px'>No Client is Active for this Service!</p>";
		}else{
			//get all the info
			while ($row = mysql_fetch_assoc($getClientInfo)){
				$id = $row['id'];
				$name = $row['name'];
				$buz_name = $row['buz_name'];
				$buz_email = $row['email'];
				$work_phone = $row['work_phone'];
				$cell_phone = $row['cell_phone'];
				$pass = $row['pass'];
				$service_type = $row['service_type'];
				$registered_on = $row['registered_on'];
				$ip = $row['ip'];
				$rand_id = $row['rand_id'];
				$websiteName = $row['websiteName'];
				$street = $row['street'];
				$apt_or_suite_buildNum = $row['apt_or_suite_buildNum'];
				$city = $row['city'];
				$state = $row['state'];
				$zip = $row['zip'];
				$paid = $row['paid'];
				$active = $row['active'];
			}
		}
	?>
<head>
	<meta charset="UTF-8">
	<?php
		$title = "Subscribe today program is for latest specials by phone or email, birthday specials or mailers";
		$keywords = "";
		$desc = "";
		if(isset($_GET['home'])){ // see home page
			$title="Subscribe today program is for latest specials by phone or email, birthday specials or mailers";
			$keywords = "";
			$desc = "";
		}else if( isset($_GET['email']) && isset($_GET['buz_id'])  && isset($_GET['unsubscribe']) ){ // When customers clicks to unsubscribes
			$title="Unsubscribe By email| Salah Bedeiwi Software Site";
			$keywords = "";
			$desc = "";
		}else{
			$title="Subscribe today program is for latest specials by phone or email, birthday specials or mailers";
			$keywords = "";
			$desc = "";
		}
	?>
	<title><?php echo $title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="<?php echo $desc; ?>">
	<meta name="web_author" content="Name: Salah Bedeiwi. Website: salahbedeiwi.com. Facebook: www.facebook.com/salah.bedeiwi">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<meta name="copyright" content="salahbedeiwi.com">
	<meta name="subject" content="Subscribe today program is for latest specials by phone or email, birthday specials or mailers">
	<meta name="language" content="ENG-US">
	<meta name="revised" content="Published on Saturday, May 6th , 2017, 12:54 pm America-Central Time | Last Update on ">
	<meta name="Classification" content="Business">
	<meta name="author" content="Salah Bedeiwi,  bedei001@umn.edu">
	<meta name="designer" content="Salah Bedeiwi-salahbedeiwi.com -fb:www.facebook.com/salah.bedeiwi">
	<meta name="reply-to" content="bedei001@umn.edu">
	<meta name="owner" content="Salah Bedeiwi">
	<meta name="url" content="www.salahbedeiwi.com/subscribe">
	<meta name="identifier-URL" content="www.salahbedeiwi.com/subscribe">
	<meta name="directory" content="submission">
	<meta name="coverage" content="Worldwide">
	<meta name="distribution" content="Global">
	<link rel="shortcut icon" href="style/img/salah bedeiwi logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $main_css?>bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $main_css?>font-awesome.css" />
	<link rel="stylesheet" href="<?php echo $_css?>mgt.css" />
	<script src="<?php echo $main_js?>jquery-1.11.3.min.js"></script>
	<script src="<?php echo $main_js?>bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid p-clear">
		<div class="col-sm-12 content p-clear">
			
			<?php
				if(isset($_GET['home'])){ // see home page [login or go to dashboard.php]
					include_once $_inc_tmp.'home.php'; 
				}
				else if( isset($_GET['reset']) && isset($_GET['now'])){ // reset password
					include_once $_inc_tmp.'login/reset.php'; 
				}else if( isset($_GET['logout']) && isset($_GET['now'])){ // logout
					include_once $_inc_tmp.'logout.php';
				}else if( isset($_GET['loading']) && isset($_GET['now'])){ // loading page
					include_once $_inc_tmp.'loading.php';
				}else{
					include_once $_inc_tmp.'home.php';
				}
			?>
		</div>
	</div>  
	<script src="<?php echo $_js?>mgt.js"></script>
</body>
</html>
<?php }else {echo "Under Maintenance - Contact the Web Service Company <a href='http://www.salahbedeiwi.com'
					title='contact salah bedeiwi' alt='contact saalah bedeiwi'>here</a>";}?>