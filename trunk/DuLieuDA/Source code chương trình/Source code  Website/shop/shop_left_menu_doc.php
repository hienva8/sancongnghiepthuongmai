<?php require_once('../Connections/ketnoi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_ketnoi, $ketnoi);
$query_master1procat = "SELECT id_procat, procat_name, procat_name_EN FROM procat WHERE visible = 1 ORDER BY day_update ASC";
$master1procat = mysql_query($query_master1procat, $ketnoi) or die(mysql_error());
$row_master1procat = mysql_fetch_assoc($master1procat);
$totalRows_master1procat = mysql_num_rows($master1procat);

$get_id_member_detail2products = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_detail2products = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_detail2products = sprintf("SELECT id_products, id_member FROM products WHERE id_member=%s AND id_procat = 123456789 AND product_type!='buy' ORDER BY id_products ASC", GetSQLValueString($get_id_member_detail2products, "int"));
$detail2products = mysql_query($query_detail2products, $ketnoi) or die(mysql_error());
$row_detail2products = mysql_fetch_assoc($detail2products);
$totalRows_detail2products = mysql_num_rows($detail2products);

$get_id_member_rs_member = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_member = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = sprintf("SELECT id_member,member_kind,member_vip FROM member WHERE id_member=%s", GetSQLValueString($get_id_member_rs_member, "int"));
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="../library/js/jquery.min.js"></script>

<script type="text/javascript" src="menu/ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>
<script type="text/javascript" src="../library/js/menu_shop.js"></script>
</head>
<body>
 <div class="logo">
    	<center>
        <?php if($row_rs_member['member_vip']==1){?>
        <img src="../interface/VIP_logo.gif" />
        <?php } else{?>
        <img src="../interface/logo_freemember.gif"/>
        <?php  }?>
        </center>
    </div>
    
     <div class="business">
     <h1><?php echo danhmuc;?></h1>
       <div id="info_help">      
<div class="arrowsidemenu">

<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?imb=<?php echo $get_id_member_rs_member;?>" title="Home"><?php echo trangchu;?></a></div>
<?php if($row_rs_member['member_kind']=='business'){?>
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=compinfo&amp;imb=<?php echo $get_id_member_rs_member;?>"><?php echo thongtincongty;?></a></div>
<?php }else{ ?>
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=mbprofile&amp;imb=<?php echo $get_id_member_rs_member;?>"><?php echo hosothanhvien;?></a></div>
<?php }?>

<div class="menuheaders"><a href="javascript:void(0);"><?php echo danhmucsanpham;?> </a></div>
	<ul class="menucontents">
	<?php do{ ?>
    <?php
  if ($totalRows_master1procat>0) {
    $nested_query_detail2products = str_replace("123456789", $row_master1procat['id_procat'], $query_detail2products);
    mysql_select_db($database_ketnoi);
    $detail2products = mysql_query($nested_query_detail2products, $ketnoi) or die(mysql_error());
    $row_detail2products = mysql_fetch_assoc($detail2products);
    $totalRows_detail2products = mysql_num_rows($detail2products);
    $nested_sw = false; 
	?>
    <?php if ($totalRows_detail2products > 0) { // Show if recordset not empty ?>
      <li><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=procat&ipc=<?php echo $row_master1procat['id_procat']; ?>&imb=<?php echo $get_id_member_rs_member;?>"> &rsaquo; <?php echo $row_master1procat['procat_name']; ?>
        <?php 
    if (isset($row_detail2products) && is_array($row_detail2products)) {
?>
        (<?php echo $totalRows_detail2products ?> )
<?php
    }
  }
?>
              </a></li>
      <?php } // Show if recordset not empty ?>
<?php } while ($row_master1procat = mysql_fetch_assoc($master1procat)); ?>
	</ul>
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=product&imb=<?php echo $get_id_member_rs_member;?>"><?php echo sanpham;?></a></div>
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=buy&imb=<?php echo $get_id_member_rs_member;?>"><?php echo chaomua;?></a></div>
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=sell&imb=<?php echo $get_id_member_rs_member;?>"><?php echo chaoban;?></a></div>
	
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=service&imb=<?php echo $get_id_member_rs_member;?>"><?php echo dichvu;?></a></div>
<div><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=contact&imb=<?php echo $get_id_member_rs_member;?>"><?php echo lienhe;?> - <?php echo thongtinlienhe;?></a></div>
</div>
</div>
<center><img src="../interface/khung_2_1.jpg" />
</center>
</div>
</body>

</html>
<?php
mysql_free_result($master1procat);

mysql_free_result($detail2products);

mysql_free_result($rs_member);
?>