<?php require_once('../../Connections/ketnoi.php'); ?>
<?php require_once('../../library/functions/functions.php'); 
require_once('../../inc_language.php');
?>
<?php
// Require the MXI classes
require_once ('../../includes/mxi/MXI.php');

// Include Multiple Static Pages
$mxiObj = new MXI_Includes("mod");
$mxiObj->IncludeStatic("", "shop_homepage_product.php", "", "", "");
$mxiObj->IncludeStatic("procat", "../shop_procat.php", "", "", "");
$mxiObj->IncludeStatic("product", "../shop_product.php", "", "", "");
$mxiObj->IncludeStatic("detail", "../shop_product_detail.php", "", "", "");
$mxiObj->IncludeStatic("buy", "../shop_buy.php", "", "", "");
$mxiObj->IncludeStatic("sell", "../shop_sell.php", "", "", "");
$mxiObj->IncludeStatic("service", "../shop_service.php", "", "", "");
$mxiObj->IncludeStatic("svdetail", "../shop_service_detail.php", "", "", "");
$mxiObj->IncludeStatic("contact", "../shop_contact.php", "", "", "");
$mxiObj->IncludeStatic("contactok", "../shop_contactok.php", "", "", "");
$mxiObj->IncludeStatic("compinfo", "../shop_info_company.php", "", "", "");
// End Include Multiple Static Pages
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $mxiObj->getTitle(); ?></title>
<link href="../../library/css/style_shop.css" rel="stylesheet" type="text/css" />
<link href="../../library/css/style.css" rel="stylesheet" type="text/css" />
<link href="../../library/css/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../../library/css/style_buy_sale.css" rel="stylesheet" type="text/css" />
<link href="../../library/css/style_menu_shop.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../library/js/jquery_menu.js"></script>
<script type="text/javascript" src="../../library/js/script.js"></script>
<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
</head>

<body>
<?php
  mxi_includes_start("../../banner.php");
  require(basename("../../banner.php"));
  mxi_includes_end();
?>
<div id="shop_info">
<?php
  mxi_includes_start("shop_left.php");
  require(basename("shop_left.php"));
  mxi_includes_end();
?>
<?php
  mxi_includes_start("shop_homepage.php");
  require(basename("shop_homepage.php"));
  mxi_includes_end();
?>

</div>
<?php
  mxi_includes_start("../shop_bottom.php");
  require(basename("../shop_bottom.php"));
  mxi_includes_end();
?>
</body>
</html>
