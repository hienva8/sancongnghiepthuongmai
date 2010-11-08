<?php
// Require the MXI classes
require_once ('includes/mxi/MXI.php');
?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');

// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Make a logout transaction instance
$logoutTransaction = new tNG_logoutTransaction($conn_ketnoi);
$tNGs->addTransaction($logoutTransaction);
// Register triggers
$logoutTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "GET", "KT_logout_now");
$logoutTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php");
// Add columns
// End of logout transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php 
$duongdan1 = "<a href='admin/index.php'>".administrator."</a>";
$duongdan2 = "<a href='controlpanel/index.php'>".thongtincanhan."</a>";
?>

    	<div class="mem_login">
        	<center>
           	  <h1><?php echo welcometowwwvntrade360com;?></h1>
            	<?php if(!isset($_SESSION['kt_login_id'])){ ?>
                <h2><a href="index.php?mod=register"><img src="Interface/reg_1.jpg" border="0" /></a></h2>
                <h5> <?php echo thanhvienvntrade360com; ?> </h5>
                <a href="index.php?mod=login"><?php echo dangnhap;?></a>

              <?php }?>
              <?php if(isset($_SESSION['kt_login_id'])){ ?>
              <h4> <?php echo xinchao;?>:  <span style="color:#FF0000; font:bold 12px tahoma;"><?php echo $_SESSION['kt_login_user'];?></span></h4>
             
           	 
              <?php echo check_level($duongdan1,$duongdan2);?> | <a href="<?php echo $logoutTransaction->getLogoutLink(); ?>"><?php echo thoat;?></a>
                <?php }?>
                
        	</center>   
             <div class="mem_info" align="center">
               &nbsp;Member VIP | Member </div>          
</div>
</html>