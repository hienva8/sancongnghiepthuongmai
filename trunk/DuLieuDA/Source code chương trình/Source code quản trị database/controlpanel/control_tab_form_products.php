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
<title>Spacegallery</title>
    <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/spacegallery.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/eye.js"></script>
    <script type="text/javascript" src="js/layout.js"></script>
</head>
<body>
<?php 
$currentPage = $_SERVER["PHP_SELF"];
$get_id_products = $_GET['id_products'];
?>
    <div class="wrapper">
        <h1><?php echo sanpham;?></h1>
        <ul class="navigationTabs">
            <li><a href="<?php echo $currentPage; ?>?mod=fp<?php if(isset($get_id_products)){?>&amp;id_products=<?php echo $get_id_products;?><?php }?>#vn" rel="vn">Tiếng Việt</a></li>
           <?php /*?> <li><a href="<?php echo $currentPage; ?>?mod=fp<?php if(isset($get_id_products)){?>&amp;id_products=<?php echo $get_id_products;?><?php }?>&amp;f=en#en" rel="en">English</a></li><?php */?>
        </ul>
        <div class="tabsContent">
      
            <div class="tab">
             <?php if(!isset($_GET['f'])){?> <?php
  mxi_includes_start("control_form_products.php");
  require(basename("control_form_products.php"));
  mxi_includes_end();
?>
<?php } ?>
</div>
            <div class="tab">
			 <?php if(isset($_GET['f'])){?>
			 <?php
  mxi_includes_start("control_form_products_EN.php");
  require(basename("control_form_products_EN.php"));
  mxi_includes_end();
?>
<?php } ?>        
          </div>
      </div>
    </div>
</body>
</html>
