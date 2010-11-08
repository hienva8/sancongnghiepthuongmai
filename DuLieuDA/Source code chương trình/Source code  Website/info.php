<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<div id="info">
  <?php
  mxi_includes_start("info_left.php");
  require(basename("info_left.php"));
  mxi_includes_end();
?>
	<div id="middle">
    	<div id="slide">
 <?php
  mxi_includes_start("info_mid1_slide_advertisement.php");
  require(basename("info_mid1_slide_advertisement.php"));
  mxi_includes_end();
?>
		</div>

<?php
  mxi_includes_start("info_mid2_buy_sell.php");
  require(basename("info_mid2_buy_sell.php"));
  mxi_includes_end();
?>
<?php
  mxi_includes_start("info_mid3_products.php");
  require(basename("info_mid3_products.php"));
  mxi_includes_end();
?>
<?php
  mxi_includes_start("info_mid4_business.php");
  require(basename("info_mid4_business.php"));
  mxi_includes_end();
?>
</div>
 <?php
  mxi_includes_start("info_right.php");
  require(basename("info_right.php"));
  mxi_includes_end();
?>
</div>
</body>
</html>
