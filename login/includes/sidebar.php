    <?php $active = "active";?>
    <?php $deactive = "";?>
	<div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Dashboard</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if(isset($_GET['Account'])){echo $active;}else{echo $deactive;}?>">
				<a href="index.php?Account"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Account</a>
			</li> 
            <li class="<?php if(isset($_GET['PrintChecks'])){echo $active;}else{echo $deactive;}?>">
				<a href="index.php?PrintChecks"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Create Checks</a>
			</li>
			<li class="<?php if(isset($_GET['viewAllChecks'])){echo $active;}else{echo $deactive;}?>">
				<a href="index.php?viewAllChecks"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Checks</a>
			</li>
            <li class="<?php if(isset($_GET['setting'])){echo $active;}else{echo $deactive;}?>">
				<a href="index.php?setting"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Setting</a>
			</li>
            <li class="<?php if(isset($_GET['logout']) && isset($_GET['now'])){echo $active;}else{echo $deactive;}?>">
				<a href="index.php?logout&now"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a>
			</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
