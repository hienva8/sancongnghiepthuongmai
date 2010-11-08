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

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_intro = "SELECT intro_content FROM intro WHERE intro_visible = 1";
$rs_intro = mysql_query($query_rs_intro, $ketnoi) or die(mysql_error());
$row_rs_intro = mysql_fetch_assoc($rs_intro);
$totalRows_rs_intro = mysql_num_rows($rs_intro);

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
<div id="intro1"><?php echo gioithieu;?></div>
<div id="intro2">
<p class="padding_info"><?php echo $row_rs_intro['intro_content']; ?></p>

</div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_intro);
?>
