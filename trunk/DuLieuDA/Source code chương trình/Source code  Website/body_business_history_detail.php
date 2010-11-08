<?php require_once('Connections/ketnoi.php'); ?>
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

$get_id_ibn_his_rs_business_history = "-1";
if (isset($_GET['ibn_his'])) {
  $get_id_ibn_his_rs_business_history = $_GET['ibn_his'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_business_history = sprintf("SELECT title, title_EN, content, content_EN, day_update FROM business_history WHERE visible = 1 AND id_business_history=%s", GetSQLValueString($get_id_ibn_his_rs_business_history, "int"));
$rs_business_history = mysql_query($query_rs_business_history, $ketnoi) or die(mysql_error());
$row_rs_business_history = mysql_fetch_assoc($rs_business_history);
$totalRows_rs_business_history = mysql_num_rows($rs_business_history);

// Require the MXI classes
require_once ('includes/mxi/MXI.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="library/CSS/style_contac.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="khung_intro">
<div id="intro1"><?php echo cauchuyendoanhnhan;?></div>
<div id="intro2">
<p class="padding_info"><div><?php echo $row_rs_business_history['title']; ?><br /></div>
<div style="margin-top:5px">
<?php echo $row_rs_business_history['content']; ?></p>
</div>

</div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_business_history);
?>