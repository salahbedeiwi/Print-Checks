<div class="loader" id="loading">
	<img src="style/img/preloaders.gif" id="#loading-image" class="img-responsive center-block" alt="loading Image" />
</div>
<div id="hideAndShow">
	<ol class="pull-right todayDate">
		<?php 
			date_default_timezone_set("America/Chicago");
			$todayIs =  date("D F jS, Y g:i a");
			echo $todayIs;
		?>
	</ol>
	<ol class="breadcrumb">
	  <li><a href="index.php">Home</a></li>
	  <li class="active">Dashboard</a></li>
	</ol>	
	<div class="clearfix"></div>
	<!-- Start real content here -->
	Welcome to main page <br>dashboard page
	<!-- End real content here -->
</div>