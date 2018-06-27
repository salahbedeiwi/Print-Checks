<?php session_start();?>
<?php $paid = "yes"; //yes or no?>
<?php if($paid == "yes"){?>
<!DOCTYPE html>
<html>
	<?php include_once "ini.php";?>
	<?php include_once $_func_include."functions.php";?>
	<?php 
		//before custom register, you must change db name on register/login files.
		//mainURLforThisSite must be setup for the right url
		
		include_once $_inc_db.'connect_db.php';
		$findIfAdminHasInsertedHisBusinessInfo = mysql_query("select * from `business_info` order by id desc");
		$findIfAdminHasInsertedHisBusinessInfo_rows = mysql_num_rows($findIfAdminHasInsertedHisBusinessInfo); //counts and finds if the email is there already
		$row = mysql_fetch_array($findIfAdminHasInsertedHisBusinessInfo);
		$inserted_business_email = $row['email'];
		$inserted_business_logo = $row['logo'];
		$inserted_business_token_id = $row['token_id'];
		//get these info from each buz owner
		$mainURLforThisSite = "http://checks.salahbedeiwi.com";//name should be given for every customer
		$mainEmailToSendEmailsOrSMS = $inserted_business_email;//email they entered manually
		// $mainBuzName = "BMS";
		$mainBuzName = "Printing Cheks Verfications"; //insert this manually for business name
		$DbName = "send_emails_and_sms"; //get db size
		$myEMAILtoReplyTo = "bedei001@umn.edu"; //my email , so they can contact me at 
		//give them sessions to be used anywhere
		$_SESSION['mainURLforThisSite'] = $mainURLforThisSite;
		$_SESSION['mainEmailToSendEmailsOrSMS'] = $mainEmailToSendEmailsOrSMS;
		$_SESSION['mainBuzName'] = $mainBuzName;
		$_SESSION['myEMAILtoReplyTo'] = $myEMAILtoReplyTo;
		$_SESSION['DbName'] = $DbName;	
	?>
<head>
	<meta charset="UTF-8">
	<?php
		$title = "Register Today | Print Custom Checks | Salah Bedeiwi";
		$keywords = "Salah Bedeiwi, Custom Checks, Print Checks, Custom dashboards, create best dashboard, cheap website, developer,Send Email, Send Blast SMS, Unlimited, Cheap prices, Send Printing Internal System Dashboard, Printing Checks System. Main dashboard for the internal system where you can manage all your checks, custom checks, print checks, multilpe accounts, logins, ...";
		$desc = "Printing Checks System. Main dashboard for the internal system where you can manage all your checks, custom checks, print checks, multilpe accounts, logins, ...";
		if(isset($_GET['home'])){ // see home page
			$title="Register Today | Print Custom Checks | Salah Bedeiwi";
			$keywords = $keywords;
			$desc = $desc;
		}else{
			$title="Register Today | Print Custom Checks | Salah Bedeiwi";
			$keywords = $keywords;
			$desc = $desc;
		}
	?>
	<?php $favIcon = "/style/img/salah bedeiwi logo.jpg" ;?>
	<title><?php echo $title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge; charset=utf-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge;" >
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="<?php echo $desc; ?>">
	<meta name="web_author" content="Name: Salah Bedeiwi, Website: salahbedeiwi.com, Facebook: www.facebook.com/salah.bedeiwi">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<meta name="copyright" content="salahbedeiwi.com">
	<meta name="subject" content="Print Custom Checks | Salah Bedeiwi">
	<meta name="language" content="ENG-US">
	<meta name="revised" content="Published on Saturday, June 27th , 2018, 12:54 pm America-Central Time">
	<meta name="Classification" content="Business">
	<meta name="author" content="Salah Bedeiwi,  bedei001@umn.edu">
	<meta name="designer" content="Salah Bedeiwi-salahbedeiwi.com -fb:www.facebook.com/salah.bedeiwi">
	<meta name="reply-to" content="bedei001@umn.edu">
	<meta name="owner" content="Salah Bedeiwi">
	<meta name="url" content="www.salahbedeiwi.com">
	<meta name="identifier-URL" content="www.salahbedeiwi.com">
	<meta name="directory" content="submission">
	<meta name="coverage" content="Worldwide">
	<meta name="distribution" content="Global">
	<link rel="shortcut icon" href="<?php echo $favIcon;?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $main_css?>bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $main_css?>font-awesome.css" />
	<link rel="stylesheet" href="<?php echo $_css?>mgt.css" />
	<script src="<?php echo $main_js?>jquery-1.11.3.min.js"></script>
	<script src="<?php echo $main_js?>bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="col-sm-12 content">
			<h1 class="text-center">Registeration Form</h1>
			<?php
				if(isset($_GET['home'])){ // see home page
					include_once $_inc_tmp.'home.php'; 
				}
				else if( isset($_GET['email']) && isset($_GET['buz_id']) && isset($_GET['unsubscribe']) ){ // customers clicks to unsubscribe email
					include_once $_inc_tmp.'email/unsubscribe.php'; 
				}else{
					include_once $_inc_tmp.'home.php'; //registeration form
				}
			?>
		</div>
	</div>  
	<script src="<?php echo $_js?>mgt.js"></script>
</body>
</html>
<?php }else {echo "Under Maintenance - Contact the Web Service Company <a href='http://www.salahbedeiwi.com?index.php?contact'
					title='contact salah bedeiwi' alt='contact salah bedeiwi'>here</a>";}?>