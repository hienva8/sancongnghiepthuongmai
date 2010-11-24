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

$session_member_rs_thongtinlienhe = "-1";
if (isset($_GET['imb'])) {
  $session_member_rs_thongtinlienhe = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_thongtinlienhe = sprintf("SELECT *,name,position_name FROM contact_information,contact_department,position WHERE ct_info_id_member = %s AND ct_info_department=id_contact_department AND ct_info_position=id_position", GetSQLValueString($session_member_rs_thongtinlienhe, "int"));
$rs_thongtinlienhe = mysql_query($query_rs_thongtinlienhe, $ketnoi) or die(mysql_error());
$row_rs_thongtinlienhe = mysql_fetch_assoc($rs_thongtinlienhe);
$totalRows_rs_thongtinlienhe = mysql_num_rows($rs_thongtinlienhe);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/css/style_shop.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="info_company">
	<fieldset class="fieldset_khung"><legend><?php echo thongtinlienhe;?></legend>
  <div id="info1">
    <label><?php echo tencongty;?> :</label>
    <label><?php echo nguoilienhe;?> :</label>
    <label><?php echo bophanlienhe;?> :</label>
    <label><?php echo chucvu;?> :</label>
    <label><?php echo diachi;?> :</label>
    <label><?php echo email;?> :</label>
    <label><?php echo dienthoai;?> :</label>
    <label><?php echo fax;?> :</label>
    <label><?php echo didong;?> :</label>
    <label><?php echo website;?> :</label>
    </div>
    <div id="info2">
    <label class="text-uppercase"><?php echo $row_rs_thongtinlienhe['ct_info_company']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_fullname']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['name']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['position_name']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_address']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_email']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_tel']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_fax']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_mobile']; ?></label>
    <label><?php echo $row_rs_thongtinlienhe['ct_info_website']; ?></label>
    </div>
    </fieldset>
</div>
</body>
</html>
<?php
mysql_free_result($rs_thongtinlienhe);
?>
