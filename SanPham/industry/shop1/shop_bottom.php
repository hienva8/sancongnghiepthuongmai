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

$get_id_member_rs = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs = sprintf("SELECT company_name, company_name_EN, company_address, company_address_EN, company_tell, company_email, company_fax, company_website FROM company WHERE company_id_member=%s AND company_visible = 1", GetSQLValueString($get_id_member_rs, "int"));
$rs = mysql_query($query_rs, $ketnoi) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<div style="clear:both;">
<div id="shop_menu_bot">
    	<?php echo $row_rs['company_name']; ?>
  </ul>                                                            
</div>
<div id="private_shop">
	<h1>
	  <table width="400" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="60">Địa chỉ:</td>
    <td><?php echo $row_rs['company_address']; ?></td>
  </tr>
  <tr>
    <td width="60">Điện thoại:</td>
    <td><?php echo $row_rs['company_tell']; ?></td>
  </tr>
  <tr>
    <td width="60">Email:</td>
    <td><?php echo $row_rs['company_email']; ?></td>
  </tr>
  <tr>
    <td width="60">Fax:</td>
    <td><?php echo $row_rs['company_fax']; ?></td>
  </tr>
  <tr>
    <td width="60">Website:</td>
    <td><?php echo $row_rs['company_website']; ?></td>
  </tr>
</table>
</h1>
</div>
<div id="coppyright">
	<h1>Copyright Notice © 2010 by Vn-Trade360.com</h1>
</div>
</div>
<?php
mysql_free_result($rs);
?>
