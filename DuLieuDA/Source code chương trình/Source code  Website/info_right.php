<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="right">
 <?php
  mxi_includes_start("info_right_welcome.php");
  require(basename("info_right_welcome.php"));
  mxi_includes_end();
?>
 <?php
  mxi_includes_start("info_right_business.php");
  require(basename("info_right_business.php"));
  mxi_includes_end();
?>
 <?php
  mxi_includes_start("info_right_count.php");
  require(basename("info_right_count.php"));
  mxi_includes_end();
?>
</div>
</body>
</html>
