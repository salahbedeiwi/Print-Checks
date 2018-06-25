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
	  <li class="active"><a href="index.php?viewAllChecks">View All Check(s)</a></li>
	  <li class="active">Print Check(s)</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<?php 
			include_once 'db/connect_db.php';
			$check_Rand_id = $_GET['chekNum'];
			$getBankAccountInfo = 
			mysql_query("select * from `create_check` where rand_id = '$check_Rand_id' order by id ");
			$getBankAccountInfo_num_rows = mysql_num_rows($getBankAccountInfo); //Get bank info
			// if no clients
			if($getBankAccountInfo_num_rows < 1){ 
				echo "<p   class='text-center' style='color: #a94442;border: 2px solid #a94442;'>No Check exists! - <a href='index.php?viewAllChecks'>View All Checks</a></p>"; //no No Account with this info.
			}else{ // if clients are registered, show table 
		?>
		<div class="col-sm-12">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">View Check(s)</h3>
					  </div>
					  <div class="modal-body aliceblue">
							  <!-- Add Comments here -->
							  <?php
								if(isset($_POST['UpdateCheckInfoNow'])){
									include_once $_inc_db.'connect_db.php';
									// Get all data from the fileds
									$AccountIdIs = $_POST['AccountIdIs']; // get account Number Id
									$payee = $_POST['payee']; // get payee
									$memo = $_POST['memo']; // get memo
									$amount = $_POST['amount']; // get amount

									$updateCheckNow = mysql_query("update `create_check` 
																			set  
																				bank_id = $AccountIdIs,
																				payee = '$payee',
																				memo = '$memo',
																				amount = '$amount'
																			where   
																				rand_id = '$check_Rand_id' ");
									if($updateCheckNow){ 
										//if done, show success message
										echo "<p class='text-center' style='color: green;border: 2px solid green;'>you have updated current check successfully!<br>";
										//increment the check number 
										//redirect to check number: so you can print/update
										echo "<script>setTimeout(\"location.href = 'index.php?chekNum=$check_Rand_id';\",1000);</script>";
										
									}else{
										echo "<p  class='text-center' style='color: #a94442;border: 2px solid #a94442;'>Something went wrong! Try again!</p>";
									}
								}
								?>
								<?php 
								//get check info
									include_once 'db/connect_db.php';
									$getCurrentCheckInfo = 
										mysql_query("select * from `create_check` where rand_id = '$check_Rand_id' limit 1");
										$row = mysql_fetch_assoc($getCurrentCheckInfo);
											$Fetch_get_check_id = $row['id'];
											$Fetch_rand_id = $row['rand_id'];
											$Fetch_payee = $row['payee'];
											$Fetch_memo = $row['memo'];
											$Fetch_amount = $row['amount'];
											$Fetch_check_number = $row['check_number'];
											$Fetch_check_status = $row['check_status'];
											$Fetch_bank_id = $row['bank_id'];

								?>
							  <!-- End Comments here -->
						  <div class="form-group">
							<label for="AccountIdIs" class="col-sm-4 control-label">Select Account
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Choose Your Bank: Bank Name - Type - Number">
								</span>
							</label>
							<div class="col-sm-8">
								<select class="form-control" name="AccountIdIs" id="AccountIdIs" required = "required">
									<?php 
									include_once 'db/connect_db.php';
									$getBankAccountInfoId = 
									mysql_query("select * from `your_account` where id = $Fetch_bank_id");
										// if clients are registered, show table 
									$row = mysql_fetch_assoc($getBankAccountInfoId);
										$AccountId = $row['id'];
										$acct_type= $row['acct_type'];
										$_bank_name = $row['bank_name'];
										$_acct_number = $row['acct_number'];
										$viewacct_type =  substr ( $acct_type , 0 , 3 ); //first 3 letters/digits
										$BankNameShortCut =  substr ( $_bank_name , 0 , 3 );//first 3 letters/digits
										$BankAcctShortCut =  substr ( $_acct_number , -5 ); //get last 5 digits
										echo '<option value='.$AccountId.'>'.$BankNameShortCut .'. - ('.$viewacct_type.'.) ****'.$BankAcctShortCut.'</option>'; //add accounts here (Name - Type - Number)
									?>
									<?php 
									$getBankAccountInfoId_2 = 
									mysql_query("select * from `your_account` where active = 1 order by id desc"); 
										while ($row = mysql_fetch_assoc($getBankAccountInfoId_2)){
											$Fetch_getAccountId = $row['id'];
											$Fetch_acct_type= $row['acct_type'];
											$Fetch_bank_name = $row['bank_name'];
											$Fetch_acct_number = $row['acct_number'];
											$viewBankTypeShortCut =  substr ( $Fetch_acct_type , 0 , 3 ); //first 3 letters/digits
											$viewBankNameShortCut =  substr ( $Fetch_bank_name , 0 , 3 );//first 3 letters/digits
											$viewBankAcctShortCut =  substr ( $Fetch_acct_number , -5 ); //get last 5 digits
											$Fetch_active = $row['active'];
											echo '<option value='.$Fetch_getAccountId.'>'.$viewBankNameShortCut .'. - ('.$viewBankTypeShortCut.'.) ****'.$viewBankAcctShortCut.'</option>'; //add accounts here (Name - Type - Number)
										}
									?>
								 </select>
							</div>
						  </div>
						  <div class="form-group">
							<label for="payee" class="col-sm-4 control-label">Payee
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Pay to the order of: business/personal name....">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  value="<?php echo $Fetch_payee; ?>" name="payee" placeholder="Pay to the order of..." class="form-control" id="payee" required = "required" />
							</div>
						  </div>
						  <div class="form-group">
							<label for="memo" class="col-sm-4 control-label">Memo
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Optional - Add Some Notes">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="text"  value="<?php echo $Fetch_memo; ?>"name="memo" placeholder="Optional - Add Some Notes" class="form-control" id="memo"/>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="amount" class="col-sm-4 control-label">Amount in ($)
								<span class="glyphicon glyphicon-info-sign red-tooltip" aria-hidden="true"   data-toggle="tooltip"
										data-placement="right" 
											title="Minneapolis, MN 55555">
								</span>
							</label>
							<div class="col-sm-8">
								<input type="number" value="<?php echo sprintf("%.2f", $Fetch_amount); ?>"name="amount" placeholder="Amount: 120.50,100,95  'No $ sign'" class="form-control" id="amount" required = "required" step="0.01"/>
							</div>
						  </div>
					  <div class="modal-footer modelHeader">
						<button type="submit" name="UpdateCheckInfoNow" class="btn btn-primary btn-sm">Update Check</button>
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
				$deactiveBanktInfo = mysql_query("update `create_check` 
														set 
															check_status = 0
														where 
														rand_id = '$check_Rand_id' limit 1
												"); //0 means voided
				if($deactiveBanktInfo){ 
					//if done, send an email
					echo "<p class='text-center' style='color: green;border: 2px solid green;'>We have voided your current check!<br>";
					echo "<script>setTimeout(\"location.href = 'index.php?chekNum=$check_Rand_id';\",1000);</script>";
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
				$activeBankInfo = mysql_query("update `create_check` 
														set 
															check_status = 1
														where rand_id = '$check_Rand_id' limit 1
												"); //1 means is active
				if($activeBankInfo){ 
					//if done, send an email
					echo "<p class='text-center' style='color: green;border: 2px solid green;'>We have validated your current check!<br>";
					echo "<script>setTimeout(\"location.href = 'index.php?chekNum=$check_Rand_id';\",1000);</script>";
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
						<h3 class="modal-title" id="myModalLabel">Check Status</h3>
					  </div>
					  <div class="modal-body aliceblue">
						  <?php 
							$getCurrentCheckStatu = 
									mysql_query("select * from `create_check` where rand_id = '$check_Rand_id' limit 1");
							$getCurrentCheckStatu_rows = mysql_num_rows($getCurrentCheckStatu); //Get bank info
							// if no clients
							if($getCurrentCheckStatu_rows < 1){ 
								echo "<p class='text-center' style='color: #a94442;border: 2px solid #a94442;'>This Check isn't existing on your system.</p>"; //no No Account with this info.
							}else{ // if clients are registered, show table 
							?>
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>N.</th>
									<th>Id</th>
									<th>Status</th>
									<th>Check #</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tbody>
							<?php 
								while ($row = mysql_fetch_assoc($getCurrentCheckStatu)){
										$Fetch_get_check_id = $row['id'];
										$Fetch_rand_id = $row['rand_id'];
										$Fetch_payee = $row['payee'];
										$Fetch_memo = $row['memo'];
										$Fetch_amount = $row['amount'];
										$Fetch_check_number = $row['check_number'];
										$Fetch_check_status = $row['check_status'];
										$Fetch_bank_id = $row['bank_id'];
								?>
									  <tr>
										<td><?php echo $Fetch_get_check_id;?></td>
										<td><?php echo $Fetch_rand_id;?></td>
										<td><?php if($Fetch_check_status == 1) echo "<span style='color: green;'>Valid</span>"; else  echo "<span style='color: red;'>Voided</span>"?></td>
										<td><?php echo $Fetch_check_number;?></td>
										<td>
											<?php 
												if($Fetch_check_status == 1) 
														echo '<button type="submit" name="deactiveBank" class="btn btn-danger btn-sm">Void Check</button>'; 
												else 
														echo '<button type="submit" name="activeBank" class="btn btn-success btn-sm">Validate Check</button>'; 
											?>
										</td>
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
		<div class="col-sm-12">
		<form class="form-horizontal" method="" action="">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">Print Current Check</h3>
					  </div>
					  <div class="modal-body aliceblue">
							<!-- First Top: Check Details -->
							<div class="col-sm-12">
								<div class="col-sm-10"></div>
								<div class="col-sm-2">5005</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="col-sm-8">
									<address>
										123 Sample St<br>
										Spring Lake Park, MN, 55432
									</address>
								</div>
								<div class="col-sm-4">Date: __10/12/2018__</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="col-sm-9">
									Pay to the order of: __________________________
								</div>
								<div class="col-sm-3">Amount: $9924.32</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="col-sm-12">
									<?php 
										//$n = number_format($Fetch_amount,2); //make sure it is in a double format
										$n =  sprintf("%.2f", $Fetch_amount); //make sure it is in a double format, say 1.25
										$whole = floor($Fetch_amount);      // 1
										$fraction = $n - $whole; // .25
										$getCents = substr($fraction, 2);  // remove the decimal point
									?>
									Total:  <span id="AddConvertedNumber"></span>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="col-sm-8">
									Note: ______________________
								</div>
								<div class="col-sm-4">Signature: __________</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="col-sm-3">
									123546985
								</div>
								<div class="col-sm-3">
									123546985
								</div>
								<div class="col-sm-3">
									5004
								</div>
							</div>
							<div class="clearfix"></div>
				  </div>
				  </div>
			</div>
		</form>
<script>
	//convert numbers to words.
//--->number to word > start

    var root = typeof self == 'object' && self.self === self && self ||
        typeof global == 'object' && global.global === global && global ||
        this;
 

	// Simplified https://gist.github.com/marlun78/885eb0021e980c6ce0fb
	function isFinite(value) {
	    return !(typeof value !== 'number' || value !== value || value === Infinity || value === -Infinity);
	}

 
	var ENDS_WITH_DOUBLE_ZERO_PATTERN = /(hundred|thousand|(m|b|tr|quadr)illion)$/;
	var ENDS_WITH_TEEN_PATTERN = /teen$/;
	var ENDS_WITH_Y_PATTERN = /y$/;
	var ENDS_WITH_ZERO_THROUGH_TWELVE_PATTERN = /(zero|one|two|three|four|five|six|seven|eight|nine|ten|eleven|twelve)$/;
	var ordinalLessThanThirteen = {
	    zero: 'zeroth',
	    one: 'first',
	    two: 'second',
	    three: 'third',
	    four: 'fourth',
	    five: 'fifth',
	    six: 'sixth',
	    seven: 'seventh',
	    eight: 'eighth',
	    nine: 'ninth',
	    ten: 'tenth',
	    eleven: 'eleventh',
	    twelve: 'twelfth'
	};

	/**
	 * Converts a number-word into an ordinal number-word.
	 * @example makeOrdinal('one') => 'first'
	 * @param {string} words
	 * @returns {string}
	 */
	function makeOrdinal(words) {
	    // Ends with *00 (100, 1000, etc.) or *teen (13, 14, 15, 16, 17, 18, 19)
	    if (ENDS_WITH_DOUBLE_ZERO_PATTERN.test(words) || ENDS_WITH_TEEN_PATTERN.test(words)) {
	        return words + 'th';
	    }
	    // Ends with *y (20, 30, 40, 50, 60, 70, 80, 90)
	    else if (ENDS_WITH_Y_PATTERN.test(words)) {
	        return words.replace(ENDS_WITH_Y_PATTERN, 'ieth');
	    }
	    // Ends with one through twelve
	    else if (ENDS_WITH_ZERO_THROUGH_TWELVE_PATTERN.test(words)) {
	        return words.replace(ENDS_WITH_ZERO_THROUGH_TWELVE_PATTERN, replaceWithOrdinalVariant);
	    }
	    return words;
	}

	function replaceWithOrdinalVariant(match, numberWord) {
	    return ordinalLessThanThirteen[numberWord];
	}

 
	/**
	 * Converts an integer into a string with an ordinal postfix.
	 * If number is decimal, the decimals will be removed.
	 * @example toOrdinal(12) => '12th'
	 * @param {number|string} number
	 * @returns {string}
	 */
	function toOrdinal(number) {
	    var num = parseInt(number, 10);
	    if (!isFinite(num)) throw new TypeError('Not a finite number: ' + number + ' (' + typeof number + ')');
	    var str = String(num);
	    var lastTwoDigits = num % 100;
	    var betweenElevenAndThirteen = lastTwoDigits >= 11 && lastTwoDigits <= 13;
	    var lastChar = str.charAt(str.length - 1);
	    return str + (betweenElevenAndThirteen ? 'th'
	            : lastChar === '1' ? 'st'
	            : lastChar === '2' ? 'nd'
	            : lastChar === '3' ? 'rd'
	            : 'th');
	}

 
	var TEN = 10;
	var ONE_HUNDRED = 100;
	var ONE_THOUSAND = 1000;
	var ONE_MILLION = 1000000;
	var ONE_BILLION = 1000000000;           //         1.000.000.000 (9)
	var ONE_TRILLION = 1000000000000;       //     1.000.000.000.000 (12)
	var ONE_QUADRILLION = 1000000000000000; // 1.000.000.000.000.000 (15)
	var MAX = 9007199254740992;             // 9.007.199.254.740.992 (15)

	var LESS_THAN_TWENTY = [
	    'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten',
	    'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
	];

	var TENTHS_LESS_THAN_HUNDRED = [
	    'zero', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
	];

	/**
	 * Converts an integer into words.
	 * If number is decimal, the decimals will be removed.
	 * @example toWords(12) => 'twelve'
	 * @param {number|string} number
	 * @param {boolean} [asOrdinal] - Deprecated, use toWordsOrdinal() instead!
	 * @returns {string}
	 */
	function toWords(number, asOrdinal) {
	    var words;
	    var num = parseInt(number, 10);
	    if (!isFinite(num)) throw new TypeError('Not a finite number: ' + number + ' (' + typeof number + ')');
	    words = generateWords(num);
	    return asOrdinal ? makeOrdinal(words) : words;
	}

	function generateWords(number) {
	    var remainder, word,
	        words = arguments[1];

	    // We’re done
	    if (number === 0) {
	        return !words ? 'zero' : words.join(' ').replace(/,$/, '');
	    }
	    // First run
	    if (!words) {
	        words = [];
	    }
	    // If negative, prepend “minus”
	    if (number < 0) {
	        words.push('minus');
	        number = Math.abs(number);
	    }

	    if (number < 20) {
	        remainder = 0;
	        word = LESS_THAN_TWENTY[number];

	    } else if (number < ONE_HUNDRED) {
	        remainder = number % TEN;
	        word = TENTHS_LESS_THAN_HUNDRED[Math.floor(number / TEN)];
	        // In case of remainder, we need to handle it here to be able to add the “-”
	        if (remainder) {
	            word += '-' + LESS_THAN_TWENTY[remainder];
	            remainder = 0;
	        }

	    } else if (number < ONE_THOUSAND) {
	        remainder = number % ONE_HUNDRED;
	        word = generateWords(Math.floor(number / ONE_HUNDRED)) + ' hundred';

	    } else if (number < ONE_MILLION) {
	        remainder = number % ONE_THOUSAND;
	        word = generateWords(Math.floor(number / ONE_THOUSAND)) + ' thousand,';

	    } else if (number < ONE_BILLION) {
	        remainder = number % ONE_MILLION;
	        word = generateWords(Math.floor(number / ONE_MILLION)) + ' million,';

	    } else if (number < ONE_TRILLION) {
	        remainder = number % ONE_BILLION;
	        word = generateWords(Math.floor(number / ONE_BILLION)) + ' billion,';

	    } else if (number < ONE_QUADRILLION) {
	        remainder = number % ONE_TRILLION;
	        word = generateWords(Math.floor(number / ONE_TRILLION)) + ' trillion,';

	    } else if (number <= MAX) {
	        remainder = number % ONE_QUADRILLION;
	        word = generateWords(Math.floor(number / ONE_QUADRILLION)) +
	        ' quadrillion,';
	    }

	    words.push(word);
	    return generateWords(remainder, words);
	}

	/**
	 * Converts a number into ordinal words.
	 * @example toWordsOrdinal(12) => 'twelfth'
	 * @param {number|string} number
	 * @returns {string}
	 */
	function toWordsOrdinal(number) {
	    var words = toWords(number);
	    return makeOrdinal(words);
	}



    var numberToWords = {
        toOrdinal: toOrdinal,
        toWords: toWords,
        toWordsOrdinal: toWordsOrdinal
    };

    if (typeof exports != 'undefined') {
        if (typeof module != 'undefined' && module.exports) {
            exports = module.exports = numberToWords;
        }
        exports.numberToWords = numberToWords;
    } else {
        root.numberToWords = numberToWords;
    }

//--->number to word > end
	
	// var num_to_words = toWords(<?php echo 152.25; ?>);
	var cents = "";
	if( (<?php echo $n;?> + "").split(".")[1] == undefined ){
		cents = "00";
	}else{
		cents = (<?php echo $n;?> + "").split(".")[1];
	}
	document.getElementById("AddConvertedNumber").innerHTML = toWords(<?php echo $whole; ?>) + " Dollars and ***" + cents + "/100*** Cents Only.";
</script>


		</div>
		<?php } //end if account is found/setup ?>

	</div>
</div>
