<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');
?>
<?php require_once("../Connections/ketnoi.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/CSS/style.css" rel="stylesheet" type="text/css"/>
<link href="../library/CSS/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style_menu_stand.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../library/js/jquery_menu.js"></script>
<script type="text/javascript" src="../library/js/script.js"></script>
<script type="text/javascript" src="../library/js/jquery.dropdown.js"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript" src="../library/js/rainbow.js"></script>
</head>

<body>
<?php
  mxi_includes_start("../banner.php");
  require(basename("../banner.php"));
  mxi_includes_end();
?>
<h1> Trang chủ đăng kí thành viên</h1>
<?php
  mxi_includes_start("login.php");
  require(basename("login.php"));
  mxi_includes_end();
?>
 <?php
  mxi_includes_start("../bottom.php");
  require(basename("../bottom.php"));
  mxi_includes_end();
?>
</body>
</html>
