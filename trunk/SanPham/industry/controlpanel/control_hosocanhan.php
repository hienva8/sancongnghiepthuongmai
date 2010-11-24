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

$colname_rs_member_profile = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member_profile = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_profile = sprintf("SELECT id_member_profile, mbpro_id_member FROM member_profile WHERE mbpro_id_member = %s", GetSQLValueString($colname_rs_member_profile, "int"));
$rs_member_profile = mysql_query($query_rs_member_profile, $ketnoi) or die(mysql_error());
$row_rs_member_profile = mysql_fetch_assoc($rs_member_profile);
$totalRows_rs_member_profile = mysql_num_rows($rs_member_profile);

$colname_rs_member = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = sprintf("SELECT id_member, member_kind FROM member WHERE id_member = %s", GetSQLValueString($colname_rs_member, "int"));
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);
?>
<?php  
if($_SESSION['kt_login_id'])
{?>
<?php 
// Neu la thanh vien doanhnghiep va VIP
if($row_rs_member['member_kind']=='member')
{?>
<?php 
// Neu thanh vien chua co thong thong tin doanh nghiep thi goi trang them_thongtindoanhnghiep.php
?>
<?php if($_SESSION['kt_login_id']!=$row_rs_member_profile['mbpro_id_member']){ 
?>
<?php
  mxi_includes_start("control_them_hosocanhan.php");
  require(basename("control_them_hosocanhan.php"));
  mxi_includes_end();
?>
<?php }?>
<?php 
// Neu thanh vien da co thong thong tin doanh nghiep thi goi trang sua_hosocanhan.php
?>
<?php if($_SESSION['kt_login_id']==$row_rs_member_profile['mbpro_id_member']){ 
?>
<?php
  mxi_includes_start("control_sua_hosocanhan.php");
  require(basename("control_sua_hosocanhan.php"));
  mxi_includes_end();
?>
<?php }?>
<?php } else {
// Thanh vien la member
echo nangcapthanhviendecothongtindoanhnghiep;
} ///dong kiem tra loai thanh vien
?>
<?php } // dong kiem tra session thanh vien
mysql_free_result($rs_member);
mysql_free_result($rs_member_profile);
?>