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
		$characters = '0123456789'; //no &, so when searching by $_GET[], IT DOESN'T CONFUSE IT
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
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
?>
<?php 
//convertNumbersToCurrencyWords
function convertNumbersToCurrencyWords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = $rettxt." Dollar(s)";

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." Cent(s) Only"; 
} 
return $rettxt;} 
?>