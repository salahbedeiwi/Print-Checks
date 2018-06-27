<?php
//detect the user ip address: http://www.phpf1.com/tutorial/get-ip-address.html
	function getIp() {
			$ip = $_SERVER['REMOTE_ADDR']; //
		 
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		 
			return $ip;
	}
	//generate random id
	function generateRandomString($length = 7) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //no &, so when searching by $_GET[], IT DOESN'T CONFUSE IT
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	//generate only employees numbers
	//generate random id
	function generateRandomNumber($length = 6) {
		$characters = '0123456789'; //no &, so when searching by $_GET[], IT DOESN'T CONFUSE IT
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	//get any file size:
	//ex: echo format_size(filesize("style/img/uploadProjectFile/salah bedeiwi quotes 2.jpg");
	function format_size($size) { //pass the whole file location 
		  $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
		  if ($size == 0) { return('n/a'); } else {
		  return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
	}
	//get directory size
	function folderSize($n)
	{
		$size = 0;
		foreach (glob(rtrim($n, '/').'/*', GLOB_NOSORT) as $each) {
			$size += is_file($each) ? filesize($each) : folderSize($each);
		}
		return $size;
	}
	/*ex:
	$dir1 = "style/img/uploadFiles";
	$dir2 = "style/img/uploadProjectFile";
	$uploadedFileSizes = format_size( folderSize($dir1) );
	$uploadedProjectSizes = format_size( folderSize($dir2) );
	*/
	function convertToRealHours($number){
		$getHoursBrk = floor($number/60); //get the hours
		$getMinutesbrk = ceil($number%60); //get the minutes
		$defineTime = "Pm";
		if($getHoursBrk < 12){
			$defineTime = 'Am';
		}
		if($getHoursBrk > 12){ //so does not count for 12, because if it is 12:00 pm will show as am, that's why greater than 12
			$getHoursBrk = $getHoursBrk - 12;
		}
		if($getMinutesbrk < 10){
			$getMinutesbrk = '0'.$getMinutesbrk;
		}
		if($getHoursBrk < 10){
			$getHoursBrk = '0'.$getHoursBrk;
		}
		$finalBrkHours = $getHoursBrk.":".$getMinutesbrk." ".$defineTime;
		return $finalBrkHours;
	}
	function convertToRealHoursTotal($number){
		$getHoursBrk = floor($number/60); //get the hours
		$getMinutesbrk = ceil($number%60); //get the minutes
		if($getMinutesbrk < 10){
			$getMinutesbrk = '0'.$getMinutesbrk;
		}
		// if($getHoursBrk >= 12){
			// $getHoursBrk = $getHoursBrk - 12;
		// }
		if($getHoursBrk < 10){
			$getHoursBrk = '0'.$getHoursBrk;
		}
		$finalBrkHours = $getHoursBrk.":".$getMinutesbrk;
		return $finalBrkHours;
	}
	
	// this is used when owner changes the timesheet for employees
	function convertRealTimeToMinutes($inp){
		//mixed sscanf ( string $str , string $format [, mixed &$... ] )
		sscanf($inp, "%d:%d", $hours, $minutes);
		$time_hours = $hours * 60;
		$time_minutes = $minutes;
		$totalStarting = $time_hours + $time_minutes;
		return $totalStarting;
	}
	function convertToRealHoursTotalForEditing($number){
		$getHoursBrk = floor($number/60); //get the hours
		$getMinutesbrk = ceil($number%60); //get the minutes
		$finalBrkHours = $getHoursBrk.":".$getMinutesbrk;
		return $finalBrkHours;
	}
	//calculate hourly rate with the amount of hours
	function hourlyCharge($hr,$min){
		$getHours = floor($min/60); //get the hours
		$getMinutes = ceil($min%60); //get the minutes
		$total = ($hr*$getHours)+($hr*$getMinutes/100);
		return floatval($total);
	}
	//Calc the total price of the fed tax
	function fedTax($finalPrice,$fedTax){
		return $finalPrice * $fedTax / 100;
	}
	//Calc the total price of the state and local tax
	function stateTax($finalPrice,$stateTax){
		return $finalPrice * $stateTax / 100;
	}
	//Calc the total price of the ssn tax
	function ssn($finalPrice,$ssn){
		return $finalPrice * $ssn / 100;
	}
	//Calc the total price of the medical tax
	function medical($finalPrice,$medical){
		return $finalPrice * $medical / 100;
	}
	//add all taxes together
	function addAllTaxes($finalPrice,$fedTax,$stateTax,$ssn,$medical){
		$fedTax = $finalPrice * $fedTax / 100;
		$stateTax = $finalPrice * $stateTax / 100;
		$ssn = $finalPrice * $ssn / 100;
		$medical = $finalPrice * $medical / 100;
		$total = $fedTax + $stateTax + $ssn + $medical;
		return $total;
	}
	//get final price after taxes
	function finalPriceAfterTax($finalPrice,$totalTax){
		return $finalPrice-$totalTax;
	}
	//delete attachment file for the files pages
	function deleteAttachFile($fileId,$fileTokenId,$tableName,$findRow,$middleLocation){
	$getFileInfo = 
		mysql_query("select * from `$tableName` where
			file_id = '$fileId' and
			file_token_id = '$fileTokenId'  limit 1");
		$rowgetrowFileInfo = mysql_fetch_assoc($getFileInfo);
			$lookingFor = $rowgetrowFileInfo[$findRow];//get what you are searching for!
			$fileToDelete = "style/img/uploadFiles/$fileTokenId$middleLocation$lookingFor";
		if(!unlink($fileToDelete)){ //delete it
			echo "Something went wrong!";
		}else{ //clear the value on the attachment
			$updateNow = mysql_query("
					update `$tableName` 
						set  $findRow = '' 
					 where
						file_id = '$fileId' and file_token_id = '$fileTokenId'  limit 1
					");
			if($updateNow){
				//if success, display good
				echo "Successfully done!";
				// echo '
					// <div class="loader" id="loading">
						// <img src="style/img/sending-contact-info.gif" id="#loading-image" class="img-responsive center-block" alt="loading Image" />
					// </div>';
					echo "<script>setTimeout(\"location.href = 'index.php?viewFiles&file_id=$fileId&file_token_id=$fileTokenId';\",1000);</script>"; //should go to projects
			}else{
				//display sorry try again image
				// echo '
					// <div class="loader" id="loading">
						// <img src="style/img/sorry.gif" id="#loading-image" class="img-responsive center-block" alt="loading Image" />
					// </div>';
					// echo "<script>setTimeout(\"location.href = 'index.php?files';\",1000);</script>"; //should go to projects
				echo mysql_errno()."Something went wrong!".mysql_error();
			}
		}
	}
	//get db size:
	function dbSize($dbName){
		mysql_select_db($dbName);  
		$q = mysql_query("SHOW TABLE STATUS");  
		$size = 0;  
		while($row = mysql_fetch_array($q)) {  
			$size += $row["Data_length"] + $row["Index_length"];  
		}
		// $decimals = 2;  
		// $mbytes = number_format($size/(1024*1024),$decimals);
		// echo $mbytes;
		return $size; //you can use  format_size($size); //the above function
	}

?>