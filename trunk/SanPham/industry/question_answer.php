<?php
// Require the MXI classes
require_once ('includes/mxi/MXI.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="library/CSS/style_contac.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="khung_ask">
<div id="ask1"><?php echo trangchu;?>&nbsp;&raquo;&nbsp;<a href="index.php?mod=question"><?php echo hoidap;?></a></div>
<div id="ask2">
<div id="ask2_1">
<?php if($_GET['mod']=='question'){?>
<?php
  mxi_includes_start("ask/question_list.php");
  require(basename("ask/question_list.php"));
  mxi_includes_end();
?>
<?php }?>
<?php if($_GET['mod']=='question_detail'){?>
<?php
  mxi_includes_start("ask/question_detail.php");
  require(basename("ask/question_detail.php"));
  mxi_includes_end();
?>
<?php }?>
</div>
<div id="ask2_2"> 
<?php
  mxi_includes_start("ask/ask_advertisement.php");
  require(basename("ask/ask_advertisement.php"));
  mxi_includes_end();
?>

</div>
</div>

</div>
</body>
</html>
