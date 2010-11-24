<?php require_once("../Connections/ketnoi.php");?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');
require_once('../inc_language.php');
require_once('../library/functions/functions.php');
require_once('../inc_language.php');
require_once('viet_search.php');
// Include Multiple Static Pages
$mxiObj = new MXI_Includes("mod");
$mxiObj->IncludeStatic("", "buy_info_homepage.php", "", "", "");
$mxiObj->IncludeStatic("psc1", "buy_info_homepage1.php", "", "", "");
$mxiObj->IncludeStatic("psc2", "buy_info_homepage2.php", "", "", "");
$mxiObj->IncludeStatic("psc3", "buy_info_homepage3.php", "", "", "");
$mxiObj->IncludeStatic("psc4", "buy_info_homepage4.php", "", "", "");
// End Include Multiple Static Pages
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $mxiObj->getTitle(); ?></title>
<link href="../library/CSS/style.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style_buy_sale.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style-slide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../library/js/jquery_menu.js"></script>
<script type="text/javascript" src="../library/js/script.js"></script>
<script type="text/javascript" src="../library/js/jquery.js"></script>
<script type="text/javascript" src="../library/js/jcarousellite.js"></script>
<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
</head>

<body>


<?php
  mxi_includes_start("../banner.php");
  require(basename("../banner.php"));
  mxi_includes_end();
?>
 <?php
  mxi_includes_start("search_info.php");
  require(basename("search_info.php"));
  mxi_includes_end();
?>
 <?php
  mxi_includes_start("../bottom.php");
  require(basename("../bottom.php"));
  mxi_includes_end();
?>
</body>
</html>
