<?php require_once('../../Connections/ketnoi.php'); ?>
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

$get_id_svcat_rs_svcat = "-1";
if (isset($_GET['isvc'])) {
  $get_id_svcat_rs_svcat = $_GET['isvc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_svcat = sprintf("SELECT id_services_categories, svcat_name FROM services_categories WHERE id_services_categories = %s", GetSQLValueString($get_id_svcat_rs_svcat, "int"));
$rs_svcat = mysql_query($query_rs_svcat, $ketnoi) or die(mysql_error());
$row_rs_svcat = mysql_fetch_assoc($rs_svcat);
$totalRows_rs_svcat = mysql_num_rows($rs_svcat);
?>
<?php require_once("../../Connections/ketnoi.php"); ?>


<div class="bor_1">
        	<img src="../../Interface/home-1.jpg" width="16" height="16" />&nbsp;<span class="st_1"><a href="../../index.php"><?php echo trangchu;?></a>&nbsp;&raquo;&nbsp;<a href="index.php"><?php echo dichvu;?></a>&nbsp;&raquo;&nbsp;<?php echo $row_rs_svcat['svcat_name']; ?></span></div>
<?php
mysql_free_result($rs_svcat);
?>
