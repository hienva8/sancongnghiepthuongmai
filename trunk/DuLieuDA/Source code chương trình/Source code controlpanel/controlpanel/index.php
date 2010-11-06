<?php require_once('../Connections/ketnoi.php'); ?><?php
require_once('../Connections/ketnoi.php');
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');
require_once("../library/functions/functions.php");
// Include Multiple Static Pages
$mxiObj = new MXI_Includes("mod");
$mxiObj->IncludeStatic("", "control_homepage.php", "", "", "");
$mxiObj->IncludeStatic("lp", "control_list_products.php", "", "", "");
$mxiObj->IncludeStatic("fp", "control_tab_form_products.php", "", "", "");
$mxiObj->IncludeStatic("delp", "control_list_delete.php", "", "", "");
$mxiObj->IncludeStatic("ls", "control_list_products.php", "", "", "");
$mxiObj->IncludeStatic("fs", "control_tab_form_products.php", "", "", "");
$mxiObj->IncludeStatic("dels", "control_list_delete.php", "", "", "");
$mxiObj->IncludeStatic("lb", "control_list_products.php", "", "", "");
$mxiObj->IncludeStatic("fb", "control_tab_form_products.php", "", "", "");
$mxiObj->IncludeStatic("delb", "control_list_delete.php", "", "", "");
$mxiObj->IncludeStatic("lsv", "control_list_services.php", "", "", "");
$mxiObj->IncludeStatic("fsv", "control_tab_form_services.php", "", "", "");
$mxiObj->IncludeStatic("delsv", "control_list_delete.php", "", "", "");
$mxiObj->IncludeStatic("facc", "control_tab_thongtintaikhoan.php", "", "", "");
$mxiObj->IncludeStatic("fbsn", "control_tab_thongtindoanhnghiep.php", "", "", "");
$mxiObj->IncludeStatic("fpw", "control_doimatkhau.php", "", "", "");
$mxiObj->IncludeStatic("fct_info", "control_tab_thongtinlienhe.php", "", "", "");
$mxiObj->IncludeStatic("libx", "control_list_inbox.php", "", "", "");
$mxiObj->IncludeStatic("ibx_detail", "control_inbox_detail.php", "", "", "");
$mxiObj->IncludeStatic("lbx_sentdetail", "control_inbox_send_detail.php", "", "", "");
$mxiObj->IncludeStatic("libxdel", "control_list_inboxdel.php", "", "", "");
$mxiObj->IncludeStatic("libxsent", "control_list_inboxsent.php", "", "", "");
$mxiObj->IncludeStatic("fcomposemail", "control_form_composemail.php", "", "", "");
$mxiObj->IncludeStatic("ibxdel", "control_inbox_del.php", "", "", "");
$mxiObj->IncludeStatic("fmbprofile", "control_tab_hosocanhan.php", "", "", "");
$mxiObj->IncludeStatic("lsupport", "control_list_supportonline.php", "", "", "");
$mxiObj->IncludeStatic("sendmailok", "control_sendmailok.php", "", "", "");
$mxiObj->IncludeStatic("", ".php", "", "", "");
// End Include Multiple Static Pages
?><?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');
?><?php
// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);
?><?php
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../library/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../library/css/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../library/css/style_menu_stand.css" rel="stylesheet" type="text/css" />
<link href="../library/css/style_controlpanel.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../library/js/jquery_menu.js"></script>
<script type="text/javascript" src="../library/js/script.js"></script>
<script type="text/javascript" src="../library/js/jquery.dropdown.js"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<title><?php echo $mxiObj->getTitle(); ?></title>
<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
<link rel="stylesheet" type="text/css" href="../library/css/dddropdownpanel.css" />

<script type="text/javascript" src="../library/js/dddropdownpanel.js"></script>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="../library/css/sdmenu.css" />
	<script type="text/javascript" src="../library/js/sdmenu.js"></script>
    <script type="text/javascript" src="../library/js/rainbow.js"></script>
	<script type="text/javascript">
	// <![CDATA[ Hieu ung cho menu left
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
	</script>
  </head>
  <body>
 <div id="controlpanel_contain">
<?php
  mxi_includes_start("control_left.php");
  require(basename("control_left.php"));
  mxi_includes_end();
?>
<?php
  mxi_includes_start("control_content.php");
  require(basename("control_content.php"));
  mxi_includes_end();
?>
</div>
</body>
</html>