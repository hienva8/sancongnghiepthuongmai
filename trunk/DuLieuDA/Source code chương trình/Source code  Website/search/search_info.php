<div id="info">
  <div class="right">
	<?php
  	mxi_includes_start("../info_right_welcome.php");
  	require(basename("../info_right_welcome.php"));
  	mxi_includes_end();
	?>
     <?php
  	mxi_includes_start("../trade/public/supportonline.php");
  	require(basename("../trade/public/supportonline.php"));
  	mxi_includes_end();
	?>
      <?php
  	mxi_includes_start("search_left_advertisement.php");
  	require(basename("search_left_advertisement.php"));
  	mxi_includes_end();
	?>
	
  </div>
  
  	<?php
  		mxi_includes_start("search_result.php");
  		require(basename("search_result.php"));
  		mxi_includes_end();
	?>
</div>