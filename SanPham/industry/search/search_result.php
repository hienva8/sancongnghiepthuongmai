<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
// Show IF Conditional region1 
if (@$_GET['key3'] == "all" )  {
?>
  <?php
  mxi_includes_start("search_result1.php");
  require(basename("search_result1.php"));
  mxi_includes_end();
?>
<?php }?>
<?php if (@$_GET['key3'] != "all" ) {
  mxi_includes_start("search_result2.php");
  require(basename("search_result2.php"));
  mxi_includes_end();
?>
<?php } ?>

</body>
</html>
