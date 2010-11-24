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
$query_master1menu = "SELECT * FROM menu ORDER BY menu_name";
$master1menu = mysql_query($query_master1menu, $ketnoi) or die(mysql_error());
$row_master1menu = mysql_fetch_assoc($master1menu);
$totalRows_master1menu = mysql_num_rows($master1menu);

mysql_select_db($database_ketnoi, $ketnoi);
$query_detail2submenu = "SELECT * FROM submenu WHERE id_menu=123456789 ORDER BY submenu_name";
$detail2submenu = mysql_query($query_detail2submenu, $ketnoi) or die(mysql_error());
$row_detail2submenu = mysql_fetch_assoc($detail2submenu);
$totalRows_detail2submenu = mysql_num_rows($detail2submenu);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <?php do { ?>
    <tr>
      <td><b><?php echo $row_master1menu['menu_name']; ?></b></td>
    </tr>
    <?php
  if ($totalRows_master1menu>0) {
    $nested_query_detail2submenu = str_replace("123456789", $row_master1menu['id_menu'], $query_detail2submenu);
    mysql_select_db($database_ketnoi);
    $detail2submenu = mysql_query($nested_query_detail2submenu, $ketnoi) or die(mysql_error());
    $row_detail2submenu = mysql_fetch_assoc($detail2submenu);
    $totalRows_detail2submenu = mysql_num_rows($detail2submenu);
    $nested_sw = false;
    if (isset($row_detail2submenu) && is_array($row_detail2submenu)) {
      do { //Nested repeat
?>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_detail2submenu['submenu_name']; ?></td>
      </tr>
      <?php
      } while ($row_detail2submenu = mysql_fetch_assoc($detail2submenu)); //Nested move next
    }
  }
?>
    <?php } while ($row_master1menu = mysql_fetch_assoc($master1menu)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($master1menu);

mysql_free_result($detail2submenu);
?>
