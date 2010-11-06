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

$get_id_member_rs_company = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_company = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_company = sprintf("SELECT id_company, company_id_country, company_id_industry, company_name, company_logo, company_address, company_tell, company_name_represent, company_mansex_represent, company_manstatus_represent, company_number_employees, company_year_foundation, company_authorized_capital, company_yearly_revenue, company_export_rates, company_import_ratio, company_main_product, company_main_markets_orther, company_info, company_day_update,country_name,industry_name FROM ((company AS cp LEFT JOIN country ON company_id_country=id_country)LEFT JOIN industry ON company_id_industry=id_industry) WHERE company_id_member = %s", GetSQLValueString($get_id_member_rs_company, "int"));
$rs_company = mysql_query($query_rs_company, $ketnoi) or die(mysql_error());
$row_rs_company = mysql_fetch_assoc($rs_company);
$totalRows_rs_company = mysql_num_rows($rs_company);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/css/style_shop.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="info_company">
	<div id="info_title"><?php echo thongtincongty;?></div>
    <fieldset class="fieldset_khung"><legend><?php echo hosocongty;?>
    </legend>
	<div id="info1">
    <label class="info1_1"><?php echo tencongty;?> :</label>
    <label class="info1_1"><?php echo namthanhlap;?> :</label>
    <label class="info1_1"><?php echo quocgia;?> :</label>
    <label class="info1_1"><?php echo diachi;?> :</label>
    <label class="info1_1"><?php echo nguoidaidien;?> :</label>
    <label class="info1_1"><?php echo chucvu;?> :</label>
    <label class="info1_1"><?php echo sonhanvien;?> :</label>
    <label class="info1_1"><?php echo vondautu;?> :</label>
    <label class="info1_1"><?php echo doanhthuhangnam;?> :</label>
    <label class="info1_1"><?php echo tilexuatkhau;?> :</label>
    <label class="info1_1"><?php echo tilenhapkhau;?> :</label>
    <label class="info1_1"><?php echo sanphamchinh;?> :</label>
    <label class="info1_1"><?php echo thitruongchinh;?> :</label>
    <label class="info1_1"><?php echo linhvuchoatdong;?> :</label>
    <label class="info1_1"><?php echo loaihinhkinhdoanh;?> :</label>
    </div>
    <div id="info2">
    <label class="text-uppercase"><?php echo $row_rs_company['company_name']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_year_foundation']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['country_name']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_address']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_mansex_represent']; ?> <?php echo nguoidaidien;?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_manstatus_represent']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_number_employees']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_authorized_capital']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_yearly_revenue']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_export_rates']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_import_ratio']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_main_product']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['company_main_markets_orther']; ?></label>
    <label class="info1_1"><?php echo $row_rs_company['industry_name']; ?></label>
    <label class="info1_1"><?php echo loaihinhkinhdoanh;?></label>
    </div>
    </fieldset>
</div>
<fieldset class="fieldset_khung"><legend><?php echo gioithieu;?>
    </legend>
<div id="info_intro"><?php echo $row_rs_company['company_info']; ?></div>
</fieldset>
</body>
</html>
<?php
mysql_free_result($rs_company);
?>