<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("company_name", true, "text", "", "", "", "Vui lòng nhập tên công ty.");
$formValidation->addField("company_id_country", true, "numeric", "", "", "", "Vui lòng chọn quốc gia.");
$formValidation->addField("company_address", true, "text", "", "", "", "Vui lòng nhập địa chỉ công ty.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_Default_ManyToMany trigger
//remove this line if you want to edit the code by hand 
function Trigger_Default_ManyToMany(&$tNG) {
  $mtm = new tNG_ManyToMany($tNG);
  $mtm->setTable("main_markets_company");
  $mtm->setPkName("id_company");
  $mtm->setFkName("id_main_markets");
  $mtm->setFkReference("mtm");
  return $mtm->Execute();
}
//end Trigger_Default_ManyToMany trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("company_logo");
  $uploadObj->setDbFieldName("company_logo");
  $uploadObj->setFolder("../uploads/logo/{SESSION.kt_login_id}/");
  $uploadObj->setResize("true", 81, 0);
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, bmp");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

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
$query_rs_country = "SELECT id_country, country_name FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_industry = "SELECT id_industry, industry_name FROM industry ORDER BY sort ASC";
$rs_industry = mysql_query($query_rs_industry, $ketnoi) or die(mysql_error());
$row_rs_industry = mysql_fetch_assoc($rs_industry);
$totalRows_rs_industry = mysql_num_rows($rs_industry);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_capital_revenue = "SELECT id_capital_revenue, cr_content FROM capital_revenue ORDER BY sort ASC";
$rs_capital_revenue = mysql_query($query_rs_capital_revenue, $ketnoi) or die(mysql_error());
$row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue);
$totalRows_rs_capital_revenue = mysql_num_rows($rs_capital_revenue);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_capital_revenue1 = "SELECT id_capital_revenue, cr_content FROM capital_revenue ORDER BY sort ASC";
$rs_capital_revenue1 = mysql_query($query_rs_capital_revenue1, $ketnoi) or die(mysql_error());
$row_rs_capital_revenue1 = mysql_fetch_assoc($rs_capital_revenue1);
$totalRows_rs_capital_revenue1 = mysql_num_rows($rs_capital_revenue1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export = "SELECT id_import_export, content FROM import_export ORDER BY sort ASC";
$rs_import_export = mysql_query($query_rs_import_export, $ketnoi) or die(mysql_error());
$row_rs_import_export = mysql_fetch_assoc($rs_import_export);
$totalRows_rs_import_export = mysql_num_rows($rs_import_export);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export1 = "SELECT id_import_export, content FROM import_export ORDER BY sort ASC";
$rs_import_export1 = mysql_query($query_rs_import_export1, $ketnoi) or die(mysql_error());
$row_rs_import_export1 = mysql_fetch_assoc($rs_import_export1);
$totalRows_rs_import_export1 = mysql_num_rows($rs_import_export1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rsmain_markets = "SELECT main_markets.id_main_markets, main_markets.main_market_name, main_markets_company.id_company FROM main_markets LEFT JOIN main_markets_company ON (main_markets_company.id_main_markets=main_markets.id_main_markets AND main_markets_company.id_company=0123456789)";
$rsmain_markets = mysql_query($query_rsmain_markets, $ketnoi) or die(mysql_error());
$row_rsmain_markets = mysql_fetch_assoc($rsmain_markets);
$totalRows_rsmain_markets = mysql_num_rows($rsmain_markets);

// Make an update transaction instance
$upd_company = new tNG_update($conn_ketnoi);
$tNGs->addTransaction($upd_company);
// Register triggers
$upd_company->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_company->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_company->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=fbsn");
$upd_company->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$upd_company->registerTrigger("AFTER", "Trigger_Default_ManyToMany", 50);
// Add columns
$upd_company->setTable("company");
$upd_company->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$upd_company->addColumn("company_logo", "FILE_TYPE", "FILES", "company_logo");
$upd_company->addColumn("company_id_country", "NUMERIC_TYPE", "POST", "company_id_country");
$upd_company->addColumn("company_postcode", "NUMERIC_TYPE", "POST", "company_postcode");
$upd_company->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$upd_company->addColumn("company_tell", "STRING_TYPE", "POST", "company_tell");
//$upd_company->addColumn("company_mobile", "STRING_TYPE", "POST", "company_mobile");
$upd_company->addColumn("company_email", "STRING_TYPE", "POST", "company_email");
$upd_company->addColumn("company_fax", "STRING_TYPE", "POST", "company_fax");
$upd_company->addColumn("company_website", "STRING_TYPE", "POST", "company_website");
$upd_company->addColumn("company_id_industry", "NUMERIC_TYPE", "POST", "company_id_industry");
$upd_company->addColumn("company_name_represent", "STRING_TYPE", "POST", "company_name_represent");
$upd_company->addColumn("company_mansex_represent", "STRING_TYPE", "POST", "company_mansex_represent");
$upd_company->addColumn("company_manstatus_represent", "STRING_TYPE", "POST", "company_manstatus_represent");
$upd_company->addColumn("company_number_employees", "STRING_TYPE", "POST", "company_number_employees");
$upd_company->addColumn("company_year_foundation", "STRING_TYPE", "POST", "company_year_foundation");
$upd_company->addColumn("company_authorized_capital", "STRING_TYPE", "POST", "company_authorized_capital");
$upd_company->addColumn("company_yearly_revenue", "STRING_TYPE", "POST", "company_yearly_revenue");
$upd_company->addColumn("company_export_rates", "STRING_TYPE", "POST", "company_export_rates");
$upd_company->addColumn("company_import_ratio", "STRING_TYPE", "POST", "company_import_ratio");
$upd_company->addColumn("company_main_product", "STRING_TYPE", "POST", "company_main_product");
$upd_company->addColumn("company_main_markets_orther", "STRING_TYPE", "POST", "company_main_markets_orther");
$upd_company->addColumn("company_shortinfo", "STRING_TYPE", "POST", "company_shortinfo");
$upd_company->addColumn("company_info", "STRING_TYPE", "POST", "company_info");
$upd_company->addColumn("company_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_company->setPrimaryKey("company_id_member", "NUMERIC_TYPE", "SESSION", "kt_login_id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscompany = $tNGs->getRecordset("company");
$row_rscompany = mysql_fetch_assoc($rscompany);
$totalRows_rscompany = mysql_num_rows($rscompany);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script type="text/javascript" src="../Editor/scripts/innovaeditor.js"></script>
</head>

<body>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td><label for="company_name"><?php echo tencongty;?>:</label></td>
      <td><input type="text" name="company_name" id="company_name" value="<?php echo KT_escapeAttribute($row_rscompany['company_name']); ?>" size="50" />
          <?php echo $tNGs->displayFieldHint("company_name");?> <?php echo $tNGs->displayFieldError("company", "company_name"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_logo"><?php echo logo;?>:</label></td>
      <td><input type="file" name="company_logo" id="company_logo" size="32" />
         <img src="<?php echo "../uploads/logo/".$_SESSION['kt_login_id']."/".$row_rscompany['company_logo'];?>" align="right" />
          <?php echo $tNGs->displayFieldError("company", "company_logo"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_id_country"><?php echo quocgia;?>:</label></td>
      <td><select name="company_id_country" id="company_id_country">
      <option value=""><?php echo tatcaquocgia;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], $row_rscompany['company_id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name']?></option>
        <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_id_country"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_postcode"><?php echo mabuudien;?>:</label></td>
      <td><input type="text" name="company_postcode" id="company_postcode" value="<?php echo KT_escapeAttribute($row_rscompany['company_postcode']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_postcode");?> <?php echo $tNGs->displayFieldError("company", "company_postcode"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_address"><?php echo diachi;?>:</label></td>
      <td><input type="text" name="company_address" id="company_address" value="<?php echo KT_escapeAttribute($row_rscompany['company_address']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_address");?> <?php echo $tNGs->displayFieldError("company", "company_address"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_tell"><?php echo dienthoai;?>:</label></td>
      <td><input type="text" name="company_tell" id="company_tell" value="<?php echo KT_escapeAttribute($row_rscompany['company_tell']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_tell");?> <?php echo $tNGs->displayFieldError("company", "company_tell"); ?> </td>
    </tr>
    <?php /*?><tr>
      <td><label for="company_mobile"><?php echo didong;?>:</label></td>
      <td><input type="text" name="company_mobile" id="company_mobile" value="<?php echo KT_escapeAttribute($row_rscompany['company_mobile']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_mobile");?> <?php echo $tNGs->displayFieldError("company", "company_mobile"); ?> </td>
    </tr><?php */?>
    <tr>
      <td><label for="company_email"><?php echo email;?>:</label></td>
      <td><input type="text" name="company_email" id="company_email" value="<?php echo KT_escapeAttribute($row_rscompany['company_email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_email");?> <?php echo $tNGs->displayFieldError("company", "company_email"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_fax"><?php echo fax;?>:</label></td>
      <td><input type="text" name="company_fax" id="company_fax" value="<?php echo KT_escapeAttribute($row_rscompany['company_fax']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_fax");?> <?php echo $tNGs->displayFieldError("company", "company_fax"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_website"><?php echo website;?>:</label></td>
      <td><input type="text" name="company_website" id="company_website" value="<?php echo KT_escapeAttribute($row_rscompany['company_website']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_website");?> <?php echo $tNGs->displayFieldError("company", "company_website"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_id_industry"><?php echo nganhcongnghiep;?>:</label></td>
      <td><select name="company_id_industry" id="company_id_industry">
      <option value=""><?php echo tatcanganhcongnghiep;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_industry['id_industry']?>"<?php if (!(strcmp($row_rs_industry['id_industry'], $row_rscompany['company_id_industry']))) {echo "SELECTED";} ?>><?php echo $row_rs_industry['industry_name']?></option>
        <?php
} while ($row_rs_industry = mysql_fetch_assoc($rs_industry));
  $rows = mysql_num_rows($rs_industry);
  if($rows > 0) {
      mysql_data_seek($rs_industry, 0);
	  $row_rs_industry = mysql_fetch_assoc($rs_industry);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_id_industry"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_name_represent"><?php echo nguoidaidien;?>:</label></td>
      <td><input type="text" name="company_name_represent" id="company_name_represent" value="<?php echo KT_escapeAttribute($row_rscompany['company_name_represent']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("company_name_represent");?> <?php echo $tNGs->displayFieldError("company", "company_name_represent"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_mansex_represent_1"><?php echo gioitinh;?>:</label></td>
      <td><div>
        <input <?php if (!(strcmp(KT_escapeAttribute($row_rscompany['company_mansex_represent']),"Mr"))) {echo "CHECKED";} ?> type="radio" name="company_mansex_represent" id="company_mansex_represent_1" value="Mr" />
        <label for="company_mansex_represent_1">Mr</label>
      
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rscompany['company_mansex_represent']),"Mrs/Miss"))) {echo "CHECKED";} ?> type="radio" name="company_mansex_represent" id="company_mansex_represent_2" value="Mrs/Miss" />
            <label for="company_mansex_represent_2">Mrs/Miss</label>
         
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rscompany['company_mansex_represent']),"Orther"))) {echo "CHECKED";} ?> type="radio" name="company_mansex_represent" id="company_mansex_represent_3" value="Orther" />
            <label for="company_mansex_represent_3">Orther</label>
          </div>
        <?php echo $tNGs->displayFieldError("company", "company_mansex_represent"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_manstatus_represent"><?php echo chucvu;?>:</label></td>
      <td><select name="company_manstatus_represent" id="company_manstatus_represent">
        <option value="" >Chọn...</option>
        <option value="T&#7893;ng Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Tổng Giám đốc", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Tổng Giám đốc</option>
        <option value="Ph&oacute; T&#7893;ng Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Phó Tổng Giám đốc", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Phó Tổng Giám đốc</option>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_manstatus_represent"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_number_employees"><?php echo nhanvien;?>:</label></td>
      <td><select name="company_number_employees" id="company_number_employees">
        <option value="" >Chọn...</option>
        <option value="D&#432;&#7899;i 50 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Dưới 50 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Dưới 50 nhân viên</option>
        <option value="T&#7915; 50 - 100 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Từ 50 - 100 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Từ 50 - 100 nhân viên</option>
        <option value="T&#7915; 100 - 500 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Từ 100 - 500 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Từ 100 - 500 nhân viên</option>
        <option value="T&#7915; 500 -1.000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Từ 500 -1.000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Từ 500 -1.000 nhân viên</option>
        <option value="" >Từ 1.000 -5.000 nhân viên</option>
        <option value="Tr&ecirc;n 5.000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Trên 5.000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Trên 5.000 nhân viên</option>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_number_employees"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_year_foundation"><?php echo namthanhlap;?>:</label></td>
      <td><select name="company_year_foundation" id="company_year_foundation">
        <option value="" ><?php echo nam;?>...</option>
         <?php for($i=1900;$i<=date('Y');$i++){ ?>
        <option value="<?php echo $i;?>" <?php if (!(strcmp($i, KT_escapeAttribute($row_rscompany['company_year_foundation'])))) {echo "SELECTED";} ?>><?php echo $i;?></option>
        <?php }?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_year_foundation"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_authorized_capital"><?php echo vondieule;?>:</label></td>
      <td><select name="company_authorized_capital" id="company_authorized_capital">
      <option value=""><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_capital_revenue['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_capital_revenue['id_capital_revenue'], $row_rscompany['company_authorized_capital']))) {echo "SELECTED";} ?>><?php echo $row_rs_capital_revenue['cr_content']?></option>
        <?php
} while ($row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue));
  $rows = mysql_num_rows($rs_capital_revenue);
  if($rows > 0) {
      mysql_data_seek($rs_capital_revenue, 0);
	  $row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_authorized_capital"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_yearly_revenue"><?php echo doanhthuhangnam;?>:</label></td>
      <td><select name="company_yearly_revenue" id="company_yearly_revenue">
      <option value=""><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_capital_revenue1['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_capital_revenue1['id_capital_revenue'], $row_rscompany['company_yearly_revenue']))) {echo "SELECTED";} ?>><?php echo $row_rs_capital_revenue1['cr_content']?></option>
        <?php
} while ($row_rs_capital_revenue1 = mysql_fetch_assoc($rs_capital_revenue1));
  $rows = mysql_num_rows($rs_capital_revenue1);
  if($rows > 0) {
      mysql_data_seek($rs_capital_revenue1, 0);
	  $row_rs_capital_revenue1 = mysql_fetch_assoc($rs_capital_revenue1);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_yearly_revenue"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_export_rates"><?php echo tilexuatkhau;?>:</label></td>
      <td><select name="company_export_rates" id="company_export_rates">
      <option value=""><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rscompany['company_export_rates']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export['content']?></option>
        <?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_export_rates"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_import_ratio"><?php echo tilenhapkhau;?>:</label></td>
      <td><select name="company_import_ratio" id="company_import_ratio">
      <option value=""><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_import_export1['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export1['id_import_export'], $row_rscompany['company_import_ratio']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export1['content']?></option>
        <?php
} while ($row_rs_import_export1 = mysql_fetch_assoc($rs_import_export1));
  $rows = mysql_num_rows($rs_import_export1);
  if($rows > 0) {
      mysql_data_seek($rs_import_export1, 0);
	  $row_rs_import_export1 = mysql_fetch_assoc($rs_import_export1);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("company", "company_import_ratio"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_main_product"><?php echo sanphamchinh;?>:</label></td>
      <td><input type="text" name="company_main_product" id="company_main_product" value="<?php echo KT_escapeAttribute($row_rscompany['company_main_product']); ?>" size="50" />
          <?php echo $tNGs->displayFieldHint("company_main_product");?> <?php echo $tNGs->displayFieldError("company", "company_main_product"); ?> </td>
    </tr>
    <tr>
	<td><label><?php echo thitruongchinh;?>:</label></td>
	<td>
		<table border="0" class="KT_mtm">
			<tr>
<?php
  $cnt1 = 0;
?>
<?php
  if ($totalRows_rscompany>0) {
    $nested_query_rsmain_markets = str_replace("123456789", $row_rscompany['company_id_member'], $query_rsmain_markets);
    mysql_select_db($database_ketnoi);
    $rsmain_markets = mysql_query($nested_query_rsmain_markets, $ketnoi) or die(mysql_error());
    $row_rsmain_markets = mysql_fetch_assoc($rsmain_markets);
    $totalRows_rsmain_markets = mysql_num_rows($rsmain_markets);
    $nested_sw = false;
    if (isset($row_rsmain_markets) && is_array($row_rsmain_markets)) {
      do { //Nested repeat
?>

				<td>
					<input id="mtm_<?php echo $row_rsmain_markets['id_main_markets']; ?>" name="mtm_<?php echo $row_rsmain_markets['id_main_markets']; ?>" type="checkbox" value="1" <?php if ($row_rsmain_markets['id_company'] != "") {?> checked<?php }?> />
				</td>
				<td>
					<label for="mtm_<?php echo $row_rsmain_markets['id_main_markets']; ?>"><?php echo $row_rsmain_markets['main_market_name']; ?></label>
				</td>
<?php
	$cnt1++;
	if ($cnt1%4 == 0) {
		echo "</tr><tr>";
	}
?>
<?php
      } while ($row_rsmain_markets = mysql_fetch_assoc($rsmain_markets)); //Nested move next
    }
  }
?>
	
			</tr>
		</table>
	</td>
</tr>
    <tr>
      <td><label for="company_main_markets_orther"><?php echo thitruongkhac;?>:</label></td>
      <td><input type="text" name="company_main_markets_orther" id="company_main_markets_orther" value="<?php echo KT_escapeAttribute($row_rscompany['company_main_markets_orther']); ?>" size="50" />
          <?php echo $tNGs->displayFieldHint("company_main_markets_orther");?> <?php echo $tNGs->displayFieldError("company", "company_main_markets_orther"); ?> </td>
    </tr>
    <tr>
      <td><label for="company_shortinfo"><?php echo gioithieungan;?>:</label></td>
      <td><input type="text" name="company_shortinfo" id="company_shortinfo" value="<?php echo KT_escapeAttribute($row_rscompany['company_shortinfo']); ?>" size="100" />
          <?php echo $tNGs->displayFieldHint("company_shortinfo");?> <?php echo $tNGs->displayFieldError("company", "company_shortinfo"); ?> </td>
    </tr>
    <tr>
      <td colspan="2"><label for="company_info"><?php echo gioithieu;?>:</label></td>
    </tr>
      <tr>
      <td colspan="2"><textarea name="company_info" id="company_info" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rscompany['company_info']); ?></textarea>
      <script>
    var oEdit1 = new InnovaEditor("oEdit1");

    /***************************************************
      SETTING EDITOR DIMENSION (WIDTH x HEIGHT)
    ***************************************************/

    oEdit1.width=735;//You can also use %, for example: oEdit1.width="100%"
    oEdit1.height=350;


    /***************************************************
      SHOWING DISABLED BUTTONS
    ***************************************************/

    oEdit1.btnPrint=true;
    oEdit1.btnPasteText=true;
    oEdit1.btnFlash=true;
    oEdit1.btnMedia=true;
    oEdit1.btnLTR=true;
    oEdit1.btnRTL=true;
    oEdit1.btnSpellCheck=true;
    oEdit1.btnStrikethrough=true;
    oEdit1.btnSuperscript=true;
    oEdit1.btnSubscript=true;
    oEdit1.btnClearAll=true;
    oEdit1.btnSave=true;
    oEdit1.btnStyles=true; //Show "Styles/Style Selection" button

    /***************************************************
      APPLYING STYLESHEET
      (Using external css file)
    ***************************************************/

    oEdit1.css="style/test.css"; //Specify external css file here

    /***************************************************
      APPLYING STYLESHEET
      (Using predefined style rules)
    ***************************************************/
    /*
    oEdit1.arrStyle = [["BODY",false,"","font-family:Verdana,Arial,Helvetica;font-size:x-small;"],
          [".ScreenText",true,"Screen Text","font-family:Tahoma;"],
          [".ImportantWords",true,"Important Words","font-weight:bold;"],
          [".Highlight",true,"Highlight","font-family:Arial;color:red;"]];

    If you'd like to set the default writing to "Right to Left", you can use:

    oEdit1.arrStyle = [["BODY",false,"","direction:rtl;unicode-bidi:bidi-override;"]];
    */


    /***************************************************
      ENABLE ASSET MANAGER ADD-ON
    ***************************************************/

    oEdit1.cmdAssetManager = "modalDialogShow('../Editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
    //Use relative to root path (starts with "/")

    /***************************************************
      ADDING YOUR CUSTOM LINK LOOKUP
    ***************************************************/

    oEdit1.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.

    /***************************************************
      ADDING YOUR CUSTOM CONTENT LOOKUP
    ***************************************************/

    oEdit1.cmdCustomObject = "modelessDialogShow('objects.htm',365,270)"; //Command to open your custom content lookup page.

    /***************************************************
      USING CUSTOM TAG INSERTION FEATURE
    ***************************************************/

    oEdit1.arrCustomTag=[["First Name","{%first_name%}"],
        ["Last Name","{%last_name%}"],
        ["Email","{%email%}"]];//Define custom tag selection

    /***************************************************
      SETTING COLOR PICKER's CUSTOM COLOR SELECTION
    ***************************************************/

    oEdit1.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors

    /***************************************************
      SETTING EDITING MODE

      Possible values:
        - "HTMLBody" (default)
        - "XHTMLBody"
        - "HTML"
        - "XHTML"
    ***************************************************/

    oEdit1.mode="XHTMLBody";


    oEdit1.REPLACE("company_info");
          </script>
          <?php echo $tNGs->displayFieldHint("company_info");?> <?php echo $tNGs->displayFieldError("company", "company_info"); ?> </td>
    </tr>
    <tr>
      <td><?php echo ngaythamgia;?>:</td>
      <td><?php echo KT_formatDate($row_rscompany['company_day_update']); ?></td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Update1" id="KT_Update1" value="<?php echo capnhat;?>" />
      </td>
    </tr>
  
</table>
</form>
</body>
</html>
<?php
mysql_free_result($rs_country);

mysql_free_result($rs_industry);

mysql_free_result($rs_capital_revenue);

mysql_free_result($rs_capital_revenue1);

mysql_free_result($rs_import_export);

mysql_free_result($rs_import_export1);

mysql_free_result($rsmain_markets);
?>
