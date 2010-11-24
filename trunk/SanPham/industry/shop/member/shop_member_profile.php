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

$get_id_member_rs_company = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_company = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_company = sprintf("SELECT id_member_profile, mbpro_avatar, mbpro_year_active, mbpro_authorized_capital, mbpro_yearly_revenue, mbpro_export_rates, mbpro_import_ratio, mbpro_main_product, mbpro_main_markets_orther, mbpro_shortinfo, mbpro_info, mbpro_day_update,member_name,member_sex,member_email,member_address,member_tell,member_fax,country_name,industry_name FROM member_profile,member,country,industry WHERE mbpro_id_member=%s AND  mbpro_visible =1  AND mbpro_id_member=id_member AND member_id_country=id_country AND mbpro_id_industry=id_industry", GetSQLValueString($get_id_member_rs_company, "date"));
$rs_company = mysql_query($query_rs_company, $ketnoi) or die(mysql_error());
$row_rs_company = mysql_fetch_assoc($rs_company);
$totalRows_rs_company = mysql_num_rows($rs_company);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../library/css/style_shop.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="info_company">
	<div id="info_title"><?php echo hosothanhvien;?></div>
    <fieldset class="fieldset_khung"><legend><?php echo thongtinthanhvien;?>
    </legend>
	<div id="info1">
    <label class="info1_1"><?php echo hoten;?> :</label>
    <label class="info1_1"><?php echo quoctich;?> :</label>
    <label class="info1_1"><?php echo gioitinh;?> :</label>
    <label class="info1_1"><?php echo diachi;?> :</label>
    <label class="info1_1"><?php echo email;?> :</label>
    <label class="info1_1"><?php echo dienthoai;?> :</label>
    <label class="info1_1"><?php echo fax;?> :</label>
    <label class="info1_1"><?php echo namhoatdong;?> :</label>
    <label class="info1_1"><?php echo congnghiep;?> :</label>
    <label class="info1_1"><?php echo vondautu;?> :</label>
    <label class="info1_1"><?php echo doanhthuhangnam;?> :</label>
    <label class="info1_1"><?php echo tilexuatkhau;?> :</label>
    <label class="info1_1"><?php echo tilenhapkhau;?> :</label>
    <label class="info1_1"><?php echo sanphamchinh;?> :</label>
    <label class="info1_1"><?php echo thitruongchinh;?> :</label>
    <label class="info1_1"><?php echo loaihinhkinhdoanh;?> :</label>
    </div>
    <div id="info2">
    <label class="text-uppercase"><?php echo $row_rs_company['member_name']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['country_name']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['member_sex']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['member_address']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['member_email']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['member_tell']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['member_fax']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_year_active']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['industry_name']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_authorized_capital']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_yearly_revenue']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_export_rates']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_import_ratio']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_main_product']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['mbpro_main_markets_orther']; ?></label>
    <label class="info1_1"><?php echo loaihinhkinhdoanh;?></label>
    </div>
    </fieldset>
</div>
<fieldset class="fieldset_khung"><legend><?php echo gioithieu;?>
    </legend>
<div id="info_intro"><?php echo $row_rs_company['mbpro_info']; ?></div>
</fieldset>
</body>
</html>
<?php
mysql_free_result($rs_company);
?>