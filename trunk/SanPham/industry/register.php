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
<div class="khung_contact">
<div id="contact1"><?php echo dangkithanhvien;?></div>
<div><?php echo ghichu();?> </div>
<div id="contact2">
<div id="contact2_1"><?php
  mxi_includes_start("register/register_form.php");
  require(basename("register/register_form.php"));
  mxi_includes_end();
?>
</div>
<div id="contact2_2"> 
<h1>VnTrade360.Com</h1>
<div id="contact2_2_1">
<label><?php echo diachilienhe;?></label><br />
<label><?php echo Hotline;?></label><br />
<label><?php echo email;?></label>
</div>
<div id="contact2_2_2">
<label>: <?php echo diachiadmin;?></label><br />
<label>: 01675-584-174</label><br />
<label>: 12110515@yahoo.com</label>
</div>
</div>
</div>

</div>
</body>
</html>
