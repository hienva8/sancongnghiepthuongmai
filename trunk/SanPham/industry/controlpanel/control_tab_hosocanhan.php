<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');
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
        <h1><?php echo hosocanhan;?></h1>
        <ul class="navigationTabs">
            <li><a href="<?php echo $currentPage; ?>?mod=fmbprofile#vn" rel="vn"><?php echo tiengviet;?></a></li>
            <?php /*?><li><a href="<?php echo $currentPage; ?>?mod=fmbprofile&amp;f=en#en" rel="en"><?php echo tienganh;?></a></li><?php */?>
        </ul>
        <div class="tabsContent">
      
            <div class="tab">
             <?php if(!isset($_GET['f'])){?> <?php
  mxi_includes_start("control_sua_hosocanhan.php");
  require(basename("control_sua_hosocanhan.php"));
  mxi_includes_end();
?>
<?php } ?>
</div>
            <?php /*?><div class="tab">
			 <?php if(isset($_GET['f'])){?>
			 <?php
  mxi_includes_start("control_sua_hosocanhan_EN.php");
  require(basename("control_sua_hosocanhan_EN.php"));
  mxi_includes_end();
?>
<?php } ?>        
          </div><?php */?>
      </div>
    </div>
</body>
</html>