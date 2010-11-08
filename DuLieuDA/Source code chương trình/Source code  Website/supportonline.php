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
$query_rs_support = "SELECT id_supportonline, supportonline.id_contact_department, humanname_help, supportonline.tel, nickname, status,contact_department.name FROM supportonline LEFT JOIN contact_department ON contact_department.id_contact_department=supportonline.id_contact_department WHERE id_member is null AND supportonline.visible = 1 ORDER BY supportonline.sort ASC";
$rs_support = mysql_query($query_rs_support, $ketnoi) or die(mysql_error());
$row_rs_support = mysql_fetch_assoc($rs_support);
$totalRows_rs_support = mysql_num_rows($rs_support);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<div id="help">
       	  <center><h2><?php echo hotrotructuyen;?></h2></center>
           <?php if ($totalRows_rs_support > 0) { // Show if recordset not empty ?>
            <?php do { ?>
        <div id="info_help">
            <p style="padding:7px 0px 5px 45px;"><a href="ymsgr:sendIM?<?php echo $row_rs_support['nickname']; ?>&amp;m=<?php echo lienhequangcao;?> http://vntrade360.com" title="<?php echo lienhequangcao;?>"> <img src="http://mail.opi.yahoo.com/online?u=<?php echo $row_rs_support['nickname']; ?>&amp;m=g&amp;t=2" alt="<?php echo $row_rs_support['status']; ?>" vspace="1" border="0" /></a></p>
            <center>
              <p class="style_help_2"><?php echo $row_rs_support['name']; ?></p>
              </center>
            <center>
              </center>
          </div>
        <?php } while ($row_rs_support = mysql_fetch_assoc($rs_support)); ?>
         <?php } // Show if recordset not empty ?>
        <center><img src="Interface/khung_2.jpg" height="15" align="left" width="190"/>
            </center>
        </div>
</body>
</html>
<?php
mysql_free_result($rs_support);
?>