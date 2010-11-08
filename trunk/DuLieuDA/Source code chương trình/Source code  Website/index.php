<?php
// Require the MXI classes
require_once ('includes/mxi/MXI.php');

// Include Multiple Static Pages
$mxiObj = new MXI_Includes("mod");
$mxiObj->IncludeStatic("", "info.php", "", "", "");
$mxiObj->IncludeStatic("contact", "contact.php", "", "", "");
$mxiObj->IncludeStatic("contactok", "contact/contactok.php", "", "", "");
$mxiObj->IncludeStatic("intro", "body_intro.php", "", "", "");
$mxiObj->IncludeStatic("register", "register.php", "", "", "");
$mxiObj->IncludeStatic("register_success", "register/register_success.php", "", "", "");
$mxiObj->IncludeStatic("forgot_password", "forgot_password.php", "", "", "");
$mxiObj->IncludeStatic("question", "question_answer.php", "", "", "");
$mxiObj->IncludeStatic("question_detail", "question_answer.php", "", "", "");
$mxiObj->IncludeStatic("login", "body_login.php", "", "", "");
$mxiObj->IncludeStatic("business_history", "body_business_history_detail.php", "", "", "");

// End Include Multiple Static Pages
?><?php require_once("Connections/ketnoi.php");?>
<?php
// Require the MXI classes
require_once('inc_language.php'); 
require_once ('includes/mxi/MXI.php');
require_once('library/functions/functions.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $mxiObj->getTitle(); ?></title>
<link href="library/CSS/style.css" rel="stylesheet" type="text/css"/>
<link href="library/CSS/style_menu.css" rel="stylesheet" type="text/css" />
<link href="library/CSS/style_contac.css" rel="stylesheet" type="text/css"/>
<link href="library/CSS/style_menu_stand.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="library/css/dddropdownpanel.css" />

<script type="text/javascript" src="library/js/dddropdownpanel.js"></script>
<script type="text/javascript" src="library/js/jquery_menu.js"></script>
<script type="text/javascript" src="library/js/script.js"></script>
<script type="text/javascript" src="library/js/jquery.dropdown.js"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript" src="library/js/rainbow.js"></script>
<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
</head>

<body>
<?php
  mxi_includes_start("banner.php");
  require(basename("banner.php"));
  mxi_includes_end();
?>
<?php
  $incFileName = $mxiObj->getCurrentInclude();
  if ($incFileName !== null)  {
    mxi_includes_start($incFileName);
    require(basename($incFileName)); // require the page content
    mxi_includes_end();
}
?>
 <?php
  mxi_includes_start("bottom.php");
  require(basename("bottom.php"));
  mxi_includes_end();
?>

<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
