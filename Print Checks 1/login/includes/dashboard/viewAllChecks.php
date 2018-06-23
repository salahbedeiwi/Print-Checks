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
	  <li class="active"><a href="index.php?PrintChecks">Add New Checks(s)</a></li>
	  <li class="active">View All Checks</li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	<div class="col-sm-12">
		<div class="col-sm-12">
		<form  class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					  <div class="modal-header modelHeader">
						<h3 class="modal-title" id="myModalLabel">View All Checks</h3>
					  </div>
					  <div class="modal-body aliceblue">
						  <?php 
							include_once 'db/connect_db.php';
							?>
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>#</th>
									<th>Check #</th>
									<th>Payee</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tbody>
							<?php 
								$getCurrentCheckInfo = 
								mysql_query("select * from `create_check` order by id desc");
								while ($row = mysql_fetch_assoc($getCurrentCheckInfo)){
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
										<td><?php echo $Fetch_check_number;?></td>
										<td><?php echo $Fetch_payee;?></td>
										<td>$<?php echo $Fetch_amount;?></td>
										<td><?php if($Fetch_check_status == 1) echo "<span style='color: green;'>Valid</span>"; else  echo "<span style='color: red;'>Voided</span>"?></td>
										<td> <a href="index.php?chekNum=<?php echo $Fetch_rand_id;?>"><button type="button" name="deactiveBank" class="btn btn-success btn-sm">View</button></a></td>
									  </tr>
								
								<?php }
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
