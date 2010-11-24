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

$get_id_member_rs_compay = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_compay = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_compay = sprintf("SELECT company_name, company_name_EN, company_logo, company_shortinfo, company_shortinfo_EN,company_logo,company_id_member FROM company WHERE company_id_member=%s AND company_visible = 1", GetSQLValueString($get_id_member_rs_compay, "int"));
$rs_compay = mysql_query($query_rs_compay, $ketnoi) or die(mysql_error());
$row_rs_compay = mysql_fetch_assoc($rs_compay);
$totalRows_rs_compay = mysql_num_rows($rs_compay);
?><link href="../../library/css/style_shop.css" rel="stylesheet" type="text/css" />

<div class="com_1">
        	<div id="logo-com"><center><img src="../../uploads/logo/<?php echo $row_rs_compay['company_id_member']; ?>/<?php echo $row_rs_compay['company_logo']; ?>" />
        	</center></div>
  <div id="com-2">
            	<center><h1 class="text-uppercase"><?php echo $row_rs_compay['company_name']; ?></h1></center>
                <label><?php echo $row_rs_compay['company_shortinfo']; ?>
</label>
            </div>
            <div id="end"><img src="../../interface/fshadow_bottom.gif" width="731" /></div>        	
</div>
<?php
mysql_free_result($rs_compay);
?>
