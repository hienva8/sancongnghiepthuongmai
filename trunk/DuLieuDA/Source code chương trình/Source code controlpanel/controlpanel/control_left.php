<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);


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

$colname_rs_member = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = sprintf("SELECT id_member, member_kind FROM member WHERE id_member = %s", GetSQLValueString($colname_rs_member, "int"));
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);
?><div style="float: left" id="my_menu" class="sdmenu">
      <div>
        <span><?php echo hopthu;?></span>
        <a href="index.php?mod=libx"><?php echo hopthu;?></a>
        <a href="index.php?mod=libxsent"><?php echo thudagui;?></a>
        <a href="index.php?mod=libxdel"><?php echo thudaxoa;?></a>
        <a href="index.php?mod=fcomposemail"><?php echo soanthu;?></a></div>
      <div>
        <span><?php echo quanlysanpham;?></span>
        <a href="index.php?mod=lp"><?php echo sanpham;?></a>
        <a href="index.php?mod=fp"><?php echo themsanpham;?></a>
         <a href="index.php?mod=ls"><?php echo chaoban;?></a>
        <a href="index.php?mod=fs"><?php echo dangchaoban;?></a>  </div>
      <div>
        <span><?php echo quanlychaomua;?></span>
        <a href="index.php?mod=lb"><?php echo chaomua;?></a>
        <a href="index.php?mod=fb"><?php echo dangchaomua;?></a>
        </div>
      <div>
        <span><?php echo quanlydichvu;?></span>
        <a href="index.php?mod=lsv"><?php echo dichvu;?></a>
        <a href="index.php?mod=fsv"><?php echo dangdichvu;?></a>
      </div>
      <div  class="collapsed">
        <span><?php echo quanlytaikhoan;?></span>
        <a href="index.php?mod=facc"><?php echo thongtintaikhoan;?></a>
        <?php if($row_rs_member['member_kind']=='member') {?>
        <a href="index.php?mod=fmbprofile"><?php echo hosocanhan;?></a>
        <?php } else {?>
        <a href="index.php?mod=fbsn"><?php echo thongtindoanhnghiep;?></a>
        <?php }?>
        <a href="index.php?mod=fct_info"><?php echo thongtinlienhe;?></a>
        <a href="index.php?mod=fpw"><?php echo doimatkhau;?></a>
  	  </div>
      <div  class="collapsed">
        <span><?php echo quanlykhac;?></span>
        <a href="index.php?mod=lsupport"><?php echo hotrotructuyen;?></a>
      </div>
  </div>
<?php
mysql_free_result($rs_member);
?>
