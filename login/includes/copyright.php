<footer class="header text-center p-clear copyright">
<?php function auto_copyright($year = 'auto'){ ?>
   <?php if(intval($year) == 'auto'){ $year = date('Y'); } ?>
   <?php if(intval($year) == date('Y')){ echo intval($year); } ?>
   <?php if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); } ?>
   <?php if(intval($year) > date('Y')){ echo date('Y'); } ?>
<?php } ?>
	<P class="lh-50 pl-10">All Right Reserved&copy; <?php auto_copyright(); //2017?> - By: <a target="_blank" href="http://www.salahbedeiwi.com" title="Salah Bedeiwi">Salah Bedeiwi</a></P>
</footer>