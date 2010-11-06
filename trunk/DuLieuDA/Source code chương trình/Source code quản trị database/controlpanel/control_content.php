<?php require_once('../Connections/ketnoi.php'); ?><?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/css/style_controlpanel.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="content">
<div class="background_img_red" id="controlpanel_top">
	<div id="controlpanel_title"><img src="../interface/collapsed.gif" /> <a href="index.php"><?php echo trangcanhan;?></a> <?php contropanel_title(); ?></div>
	<div id="controlpanel_welcome"><?php echo xinchao;?>  <span style="font:bold 12px Arial, tahoma; color:#0033CC"><?php echo $_SESSION['kt_login_user'];?></span>
	  <?php
  mxi_includes_start("../logout.php");
  require(basename("../logout.php"));
  mxi_includes_end();
?></div>
</div>
    
<?php
  $incFileName = $mxiObj->getCurrentInclude();
  if ($incFileName !== null)  {
    mxi_includes_start($incFileName);
    require(basename($incFileName)); // require the page content
    mxi_includes_end();
}
?>
  </div>
</body>
</html>