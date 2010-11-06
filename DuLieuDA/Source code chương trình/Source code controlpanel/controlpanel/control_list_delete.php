<?php require_once('../Connections/ketnoi.php'); ?><?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);


?>
<?php
require_once("../library/functions/functions.php");
?>
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

$colname_rs_products = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_products = $_SESSION['kt_login_id'];
}
$ip_rs_products = "-1";
if (isset($_GET['ip'])) {
  $ip_rs_products = $_GET['ip'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_products, product_image_illustrate FROM products WHERE id_member = %s AND id_products=%s", GetSQLValueString($colname_rs_products, "int"),GetSQLValueString($ip_rs_products, "int"));
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

$colname_rs_services = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_services = $_SESSION['kt_login_id'];
}
$isv_rs_services = "-1";
if (isset($_GET['isv'])) {
  $isv_rs_services = $_GET['isv'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_services = sprintf("SELECT id_services, image_illustrate FROM services WHERE id_member = %s AND id_services=%s", GetSQLValueString($colname_rs_services, "int"),GetSQLValueString($isv_rs_services, "int"));
$rs_services = mysql_query($query_rs_services, $ketnoi) or die(mysql_error());
$row_rs_services = mysql_fetch_assoc($rs_services);
$totalRows_rs_services = mysql_num_rows($rs_services);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
///////////////khai bao bien
$get_ip = $_GET['ip'];
$table = "products";
$id_products = "id_products";
$imb = $_SESSION['kt_login_id'];
$hinh = $row_rs_products['product_image_illustrate'];
$filename = "../uploads/products/$imb/$get_ip/$hinh";

$get_isv = $_GET['isv'];
$table_sv = "services";
$id_service = "id_services";
$hinh_sv = $row_rs_services['image_illustrate'];
$filename_sv = "../uploads/services/$imb/$get_ip/$hinh_sv";

/////////////////////XOA SAN PHAM
if($get_ip && $table && $id_products && $imb)
{ deleteRS($get_ip,$table,$id_products,$imb);
}


if($imb && $get_ip)
{
	delfile($filename);
}
////////////////////XOA DICH VU
if($get_isv && $table_sv && $id_service && $imb)
{ deleteRS($get_isv,$table_sv,$id_service,$imb);
}


if($imb && $get_isv)
{
	delfile($filename_sv);
}
////////////////////XOA HO TRO TRUC TUYEN
$get_isupport 		= $_GET['isupport'];
$table_sp 			= "supportonline";
$id_supportonline 	= "id_supportonline";
if($get_isupport && $table_sp && id_supportonline && $imb)
{ deleteRS($get_isupport,$table_sp,$id_supportonline,$imb);
}
?>
</body>
</html>
<?php
mysql_free_result($rs_products);

mysql_free_result($rs_services);
?>
