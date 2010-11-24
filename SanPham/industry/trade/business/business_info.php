<div id="info">
  <div class="right">
	<?php
  	mxi_includes_start("../../info_right_welcome.php");
  	require(basename("../../info_right_welcome.php"));
  	mxi_includes_end();
	?>
     <?php
  	mxi_includes_start("../public/supportonline.php");
  	require(basename("../public/supportonline.php"));
  	mxi_includes_end();
	?>
      <?php
  	mxi_includes_start("business_left_advertisement.php");
  	require(basename("business_left_advertisement.php"));
  	mxi_includes_end();
	?>
	
  </div>
  	<div class="right-center">
	
 	<?php
  $incFileName = $mxiObj->getCurrentInclude();
  if ($incFileName !== null)  {
    mxi_includes_start($incFileName);
    require(basename($incFileName)); // require the page content
    mxi_includes_end();
}
?>
</div>
</div>