<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

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

$colname_rs_info_contact = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_info_contact = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_info_contact = sprintf("SELECT id_contact_information FROM contact_information WHERE ct_info_id_member = %s", GetSQLValueString($colname_rs_info_contact, "int"));
$rs_info_contact = mysql_query($query_rs_info_contact, $ketnoi) or die(mysql_error());
$row_rs_info_contact = mysql_fetch_assoc($rs_info_contact);
$totalRows_rs_info_contact = mysql_num_rows($rs_info_contact);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php if($totalRows_rs_info_contact>0){?>
<?php
  mxi_includes_start("control_sua_thongtinlienhe.php");
  require(basename("control_sua_thongtinlienhe.php"));
  mxi_includes_end();
?>
<?php }else{?>
<?php
  mxi_includes_start("control_them_thongtinlienhe.php");
  require(basename("control_them_thongtinlienhe.php"));
  mxi_includes_end();
?>
<?php }?>
</body>
</html>
<?php
mysql_free_result($rs_info_contact);
?>
