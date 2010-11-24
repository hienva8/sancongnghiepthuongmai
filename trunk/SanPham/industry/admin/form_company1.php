<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("company_name", true, "text", "", "", "", "Please enter company name.");
$formValidation->addField("company_tell", false, "text", "phone", "", "", "");
$formValidation->addField("company_mobile", false, "text", "phone", "", "", "");
$formValidation->addField("company_email", false, "text", "email", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/logo/");
  $deleteObj->setDbFieldName("company_logo");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("company_logo");
  $uploadObj->setDbFieldName("company_logo");
  $uploadObj->setFolder("../uploads/logo/");
  $uploadObj->setResize("true", 81, 0);
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, gif, bmp");
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
$query_rs_country = "SELECT id_country, country_name, country_name_EN FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_industry = "SELECT id_industry, industry_name, industry_name_EN FROM industry ORDER BY sort ASC";
$rs_industry = mysql_query($query_rs_industry, $ketnoi) or die(mysql_error());
$row_rs_industry = mysql_fetch_assoc($rs_industry);
$totalRows_rs_industry = mysql_num_rows($rs_industry);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_capital_revenue = "SELECT id_capital_revenue, cr_content, cr_content_EN FROM capital_revenue ORDER BY sort ASC";
$rs_capital_revenue = mysql_query($query_rs_capital_revenue, $ketnoi) or die(mysql_error());
$row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue);
$totalRows_rs_capital_revenue = mysql_num_rows($rs_capital_revenue);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_capital_revenue1 = "SELECT id_capital_revenue, cr_content, cr_content_EN FROM capital_revenue ORDER BY sort ASC";
$rs_capital_revenue1 = mysql_query($query_rs_capital_revenue1, $ketnoi) or die(mysql_error());
$row_rs_capital_revenue1 = mysql_fetch_assoc($rs_capital_revenue1);
$totalRows_rs_capital_revenue1 = mysql_num_rows($rs_capital_revenue1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export1 = "SELECT id_import_export, content, content_EN FROM import_export ORDER BY sort ASC";
$rs_import_export1 = mysql_query($query_rs_import_export1, $ketnoi) or die(mysql_error());
$row_rs_import_export1 = mysql_fetch_assoc($rs_import_export1);
$totalRows_rs_import_export1 = mysql_num_rows($rs_import_export1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export = "SELECT id_import_export, content, content_EN FROM import_export ORDER BY sort ASC";
$rs_import_export = mysql_query($query_rs_import_export, $ketnoi) or die(mysql_error());
$row_rs_import_export = mysql_fetch_assoc($rs_import_export);
$totalRows_rs_import_export = mysql_num_rows($rs_import_export);

// Make an insert transaction instance
$ins_company = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_company);
// Register triggers
$ins_company->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_company->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_company->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_company->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_company->setTable("company");
$ins_company->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$ins_company->addColumn("company_name_EN", "STRING_TYPE", "POST", "company_name_EN");
$ins_company->addColumn("company_id_country", "NUMERIC_TYPE", "POST", "company_id_country");
$ins_company->addColumn("company_postcode", "NUMERIC_TYPE", "POST", "company_postcode");
$ins_company->addColumn("company_logo", "FILE_TYPE", "FILES", "company_logo");
$ins_company->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$ins_company->addColumn("company_address_EN", "STRING_TYPE", "POST", "company_address_EN");
$ins_company->addColumn("company_tell", "STRING_TYPE", "POST", "company_tell");
$ins_company->addColumn("company_mobile", "STRING_TYPE", "POST", "company_mobile");
$ins_company->addColumn("company_email", "STRING_TYPE", "POST", "company_email");
$ins_company->addColumn("company_fax", "STRING_TYPE", "POST", "company_fax");
$ins_company->addColumn("company_website", "STRING_TYPE", "POST", "company_website");
$ins_company->addColumn("company_id_industry", "NUMERIC_TYPE", "POST", "company_id_industry");
$ins_company->addColumn("company_name_represent", "STRING_TYPE", "POST", "company_name_represent");
$ins_company->addColumn("company_mansex_represent", "NUMERIC_TYPE", "POST", "company_mansex_represent");
$ins_company->addColumn("company_manstatus_represent", "STRING_TYPE", "POST", "company_manstatus_represent");
$ins_company->addColumn("company_manstatus_represent_EN", "STRING_TYPE", "POST", "company_manstatus_represent_EN");
$ins_company->addColumn("company_number_employees", "STRING_TYPE", "POST", "company_number_employees");
$ins_company->addColumn("company_number_employees_EN", "STRING_TYPE", "POST", "company_number_employees_EN");
$ins_company->addColumn("company_year_foundation", "STRING_TYPE", "POST", "company_year_foundation");
$ins_company->addColumn("company_authorized_capital", "STRING_TYPE", "POST", "company_authorized_capital");
$ins_company->addColumn("company_yearly_revenue", "STRING_TYPE", "POST", "company_yearly_revenue");
$ins_company->addColumn("company_export_rates", "STRING_TYPE", "POST", "company_export_rates");
$ins_company->addColumn("company_import_ratio", "STRING_TYPE", "POST", "company_import_ratio");
$ins_company->addColumn("company_main_product", "STRING_TYPE", "POST", "company_main_product");
$ins_company->addColumn("company_main_product_EN", "STRING_TYPE", "POST", "company_main_product_EN");
$ins_company->addColumn("company_main_markets_orther", "STRING_TYPE", "POST", "company_main_markets_orther");
$ins_company->addColumn("company_shortinfo", "STRING_TYPE", "POST", "company_shortinfo");
$ins_company->addColumn("company_shortinfo_EN", "STRING_TYPE", "POST", "company_shortinfo_EN");
$ins_company->addColumn("company_info", "STRING_TYPE", "POST", "company_info");
$ins_company->addColumn("company_info_EN", "STRING_TYPE", "POST", "company_info_EN");
$ins_company->addColumn("company_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_company->addColumn("company_visible", "CHECKBOX_1_0_TYPE", "POST", "company_visible", "0");
$ins_company->setPrimaryKey("id_company", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_company = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_company);
// Register triggers
$upd_company->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_company->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_company->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_company->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_company->setTable("company");
$upd_company->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$upd_company->addColumn("company_name_EN", "STRING_TYPE", "POST", "company_name_EN");
$upd_company->addColumn("company_id_country", "NUMERIC_TYPE", "POST", "company_id_country");
$upd_company->addColumn("company_postcode", "NUMERIC_TYPE", "POST", "company_postcode");
$upd_company->addColumn("company_logo", "FILE_TYPE", "FILES", "company_logo");
$upd_company->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$upd_company->addColumn("company_address_EN", "STRING_TYPE", "POST", "company_address_EN");
$upd_company->addColumn("company_tell", "STRING_TYPE", "POST", "company_tell");
$upd_company->addColumn("company_mobile", "STRING_TYPE", "POST", "company_mobile");
$upd_company->addColumn("company_email", "STRING_TYPE", "POST", "company_email");
$upd_company->addColumn("company_fax", "STRING_TYPE", "POST", "company_fax");
$upd_company->addColumn("company_website", "STRING_TYPE", "POST", "company_website");
$upd_company->addColumn("company_id_industry", "NUMERIC_TYPE", "POST", "company_id_industry");
$upd_company->addColumn("company_name_represent", "STRING_TYPE", "POST", "company_name_represent");
$upd_company->addColumn("company_mansex_represent", "NUMERIC_TYPE", "POST", "company_mansex_represent");
$upd_company->addColumn("company_manstatus_represent", "STRING_TYPE", "POST", "company_manstatus_represent");
$upd_company->addColumn("company_manstatus_represent_EN", "STRING_TYPE", "POST", "company_manstatus_represent_EN");
$upd_company->addColumn("company_number_employees", "STRING_TYPE", "POST", "company_number_employees");
$upd_company->addColumn("company_number_employees_EN", "STRING_TYPE", "POST", "company_number_employees_EN");
$upd_company->addColumn("company_year_foundation", "STRING_TYPE", "POST", "company_year_foundation");
$upd_company->addColumn("company_authorized_capital", "STRING_TYPE", "POST", "company_authorized_capital");
$upd_company->addColumn("company_yearly_revenue", "STRING_TYPE", "POST", "company_yearly_revenue");
$upd_company->addColumn("company_export_rates", "STRING_TYPE", "POST", "company_export_rates");
$upd_company->addColumn("company_import_ratio", "STRING_TYPE", "POST", "company_import_ratio");
$upd_company->addColumn("company_main_product", "STRING_TYPE", "POST", "company_main_product");
$upd_company->addColumn("company_main_product_EN", "STRING_TYPE", "POST", "company_main_product_EN");
$upd_company->addColumn("company_main_markets_orther", "STRING_TYPE", "POST", "company_main_markets_orther");
$upd_company->addColumn("company_shortinfo", "STRING_TYPE", "POST", "company_shortinfo");
$upd_company->addColumn("company_shortinfo_EN", "STRING_TYPE", "POST", "company_shortinfo_EN");
$upd_company->addColumn("company_info", "STRING_TYPE", "POST", "company_info");
$upd_company->addColumn("company_info_EN", "STRING_TYPE", "POST", "company_info_EN");
$upd_company->addColumn("company_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_company->addColumn("company_visible", "CHECKBOX_1_0_TYPE", "POST", "company_visible");
$upd_company->setPrimaryKey("id_company", "NUMERIC_TYPE", "GET", "id_company");

// Make an instance of the transaction object
$del_company = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_company);
// Register triggers
$del_company->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_company->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$del_company->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_company->setTable("company");
$del_company->setPrimaryKey("id_company", "NUMERIC_TYPE", "GET", "id_company");

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
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script src="../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_company'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Company </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rscompany > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="company_name_<?php echo $cnt1; ?>">Company name:</label></td>
            <td><input type="text" name="company_name_<?php echo $cnt1; ?>" id="company_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_name']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("company_name");?> <?php echo $tNGs->displayFieldError("company", "company_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_name_EN_<?php echo $cnt1; ?>">company name(English):</label></td>
            <td><input type="text" name="company_name_EN_<?php echo $cnt1; ?>" id="company_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_name_EN']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("company_name_EN");?> <?php echo $tNGs->displayFieldError("company", "company_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_id_country_<?php echo $cnt1; ?>">Country:</label></td>
            <td><select name="company_id_country_<?php echo $cnt1; ?>" id="company_id_country_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
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
                <?php echo $tNGs->displayFieldError("company", "company_id_country", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_postcode_<?php echo $cnt1; ?>">Postcode:</label></td>
            <td><input type="text" name="company_postcode_<?php echo $cnt1; ?>" id="company_postcode_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_postcode']); ?>" size="7" />
                <?php echo $tNGs->displayFieldHint("company_postcode");?> <?php echo $tNGs->displayFieldError("company", "company_postcode", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_logo_<?php echo $cnt1; ?>">Logo:</label></td>
            <td><input type="file" name="company_logo_<?php echo $cnt1; ?>" id="company_logo_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("company", "company_logo", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_address_<?php echo $cnt1; ?>">Address:</label></td>
            <td><input type="text" name="company_address_<?php echo $cnt1; ?>" id="company_address_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_address']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("company_address");?> <?php echo $tNGs->displayFieldError("company", "company_address", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_address_EN_<?php echo $cnt1; ?>">Address(English):</label></td>
            <td><input type="text" name="company_address_EN_<?php echo $cnt1; ?>" id="company_address_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_address_EN']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("company_address_EN");?> <?php echo $tNGs->displayFieldError("company", "company_address_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_tell_<?php echo $cnt1; ?>">Tell:</label></td>
            <td><input type="text" name="company_tell_<?php echo $cnt1; ?>" id="company_tell_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_tell']); ?>" size="20" maxlength="20" />
                <?php echo $tNGs->displayFieldHint("company_tell");?> <?php echo $tNGs->displayFieldError("company", "company_tell", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_mobile_<?php echo $cnt1; ?>">Mobile:</label></td>
            <td><input type="text" name="company_mobile_<?php echo $cnt1; ?>" id="company_mobile_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_mobile']); ?>" size="20" maxlength="20" />
                <?php echo $tNGs->displayFieldHint("company_mobile");?> <?php echo $tNGs->displayFieldError("company", "company_mobile", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_email_<?php echo $cnt1; ?>">Email:</label></td>
            <td><input type="text" name="company_email_<?php echo $cnt1; ?>" id="company_email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_email']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("company_email");?> <?php echo $tNGs->displayFieldError("company", "company_email", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_fax_<?php echo $cnt1; ?>">Fax:</label></td>
            <td><input type="text" name="company_fax_<?php echo $cnt1; ?>" id="company_fax_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_fax']); ?>" size="20" maxlength="20" />
                <?php echo $tNGs->displayFieldHint("company_fax");?> <?php echo $tNGs->displayFieldError("company", "company_fax", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_website_<?php echo $cnt1; ?>">Website:</label></td>
            <td><input type="text" name="company_website_<?php echo $cnt1; ?>" id="company_website_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_website']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("company_website");?> <?php echo $tNGs->displayFieldError("company", "company_website", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_id_industry_<?php echo $cnt1; ?>">Categories industry:</label></td>
            <td><select name="company_id_industry_<?php echo $cnt1; ?>" id="company_id_industry_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
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
                <?php echo $tNGs->displayFieldError("company", "company_id_industry", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_name_represent_<?php echo $cnt1; ?>">Represent name:</label></td>
            <td><input type="text" name="company_name_represent_<?php echo $cnt1; ?>" id="company_name_represent_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_name_represent']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("company_name_represent");?> <?php echo $tNGs->displayFieldError("company", "company_name_represent", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_mansex_represent_<?php echo $cnt1; ?>">Mansex represent:</label></td>
            <td><select name="company_mansex_represent_<?php echo $cnt1; ?>" id="company_mansex_represent_<?php echo $cnt1; ?>">
              <option value="Mr" <?php if (!(strcmp("Mr", KT_escapeAttribute($row_rscompany['company_mansex_represent'])))) {echo "SELECTED";} ?>>Mr</option>
              <option value="Mrs/Miss" <?php if (!(strcmp("Mrs/Miss", KT_escapeAttribute($row_rscompany['company_mansex_represent'])))) {echo "SELECTED";} ?>>Mrs/Miss</option>
              <option value="Orther" <?php if (!(strcmp("Orther", KT_escapeAttribute($row_rscompany['company_mansex_represent'])))) {echo "SELECTED";} ?>>Orther</option>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_mansex_represent", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_manstatus_represent_<?php echo $cnt1; ?>">Manstatus represent:</label></td>
            <td><select name="company_manstatus_represent_<?php echo $cnt1; ?>" id="company_manstatus_represent_<?php echo $cnt1; ?>">
              <option value="" >-- chọn --</option>
              <option value="Ch&#7911; t&#7883;ch H&#272;QT" <?php if (!(strcmp("Chủ tịch HĐQT", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Chủ tịch HĐQT</option>
              <option value="T&#7893;ng Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Tổng Giám đốc", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Tổng Giám đốc</option>
              <option value="Ph&oacute; t&#7893;ng Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Phó tổng Giám đốc", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Phó tổng Giám đốc</option>
              <option value="Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Giám đốc", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Giám đốc</option>
              <option value="Ph&oacute; Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Phó Giám đốc", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Phó Giám đốc</option>
              <option value="Gi&aacute;m &#273;&#7889;c &#273;i&#7873;u h&agrave;nh" <?php if (!(strcmp("Giám đốc điều hành", KT_escapeAttribute($row_rscompany['company_manstatus_represent'])))) {echo "SELECTED";} ?>>Giám đốc điều hành</option>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_manstatus_represent", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_manstatus_represent_EN_<?php echo $cnt1; ?>">Manstatus represent(English):</label></td>
            <td><select name="company_manstatus_represent_EN_<?php echo $cnt1; ?>" id="company_manstatus_represent_EN_<?php echo $cnt1; ?>">
              <option value="" >--select--</option>
              <option value="Chairman/President" <?php if (!(strcmp("Chairman/President", KT_escapeAttribute($row_rscompany['company_manstatus_represent_EN'])))) {echo "SELECTED";} ?>>Chairman/President</option>
              <option value="General Director" <?php if (!(strcmp("General Director", KT_escapeAttribute($row_rscompany['company_manstatus_represent_EN'])))) {echo "SELECTED";} ?>>General Director</option>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_manstatus_represent_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_number_employees_<?php echo $cnt1; ?>">Employees:</label></td>
            <td><select name="company_number_employees_<?php echo $cnt1; ?>" id="company_number_employees_<?php echo $cnt1; ?>">
              <option value="" >--chọn--</option>
              <option value="D&#432;&#7899;i 50 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Dưới 50 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Dưới 50 nhân viên</option>
              <option value="50 - 100 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("50 - 100 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>50 - 100 nhân viên</option>
              <option value="100 - 500 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("100 - 500 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>100 - 500 nhân viên</option>
              <option value="500 - 1000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("500 - 1000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>500 - 1000 nhân viên</option>
              <option value="1000 - 2000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("1000 - 2000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>1000 - 2000 nhân viên</option>
              <option value="2000 - 3000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("2000 - 3000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>2000 - 3000 nhân viên</option>
              <option value="3000 - 4000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("3000 - 4000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>3000 - 4000 nhân viên</option>
              <option value="4000 -5000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("4000 -5000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>4000 -5000 nhân viên</option>
              <option value="Tr&ecirc;n 5000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Trên 5000 nhân viên", KT_escapeAttribute($row_rscompany['company_number_employees'])))) {echo "SELECTED";} ?>>Trên 5000 nhân viên</option>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_number_employees", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_number_employees_EN_<?php echo $cnt1; ?>">Employees(English):</label></td>
            <td><select name="company_number_employees_EN_<?php echo $cnt1; ?>" id="company_number_employees_EN_<?php echo $cnt1; ?>">
              <option value="" >--select--</option>
              <option value="Under 50 member" <?php if (!(strcmp("Under 50 member", KT_escapeAttribute($row_rscompany['company_number_employees_EN'])))) {echo "SELECTED";} ?>>Under 50 member</option>
              <option value="" ></option>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_number_employees_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_year_foundation_<?php echo $cnt1; ?>">Year foundation:</label></td>
            <td><input type="text" name="company_year_foundation_<?php echo $cnt1; ?>" id="company_year_foundation_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_year_foundation']); ?>" size="10" maxlength="10" />
                <?php echo $tNGs->displayFieldHint("company_year_foundation");?> <?php echo $tNGs->displayFieldError("company", "company_year_foundation", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_authorized_capital_<?php echo $cnt1; ?>">Authorized capital:</label></td>
            <td><select name="company_authorized_capital_<?php echo $cnt1; ?>" id="company_authorized_capital_<?php echo $cnt1; ?>">
              <option value="" <?php if (!(strcmp("", $row_rscompany['company_authorized_capital']))) {echo "selected=\"selected\"";} ?>><?php echo NXT_getResource("Select one..."); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_capital_revenue['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_capital_revenue['id_capital_revenue'], $row_rscompany['company_authorized_capital']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_capital_revenue['cr_content']?></option>
<?php
} while ($row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue));
  $rows = mysql_num_rows($rs_capital_revenue);
  if($rows > 0) {
      mysql_data_seek($rs_capital_revenue, 0);
	  $row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_authorized_capital", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_yearly_revenue_<?php echo $cnt1; ?>">Yearly revenue:</label></td>
            <td><select name="company_yearly_revenue_<?php echo $cnt1; ?>" id="company_yearly_revenue_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_capital_revenue['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_capital_revenue['id_capital_revenue'], $row_rscompany['company_yearly_revenue']))) {echo "SELECTED";} ?>><?php echo $row_rs_capital_revenue['cr_content']?></option>
              <?php
} while ($row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue));
  $rows = mysql_num_rows($rs_capital_revenue);
  if($rows > 0) {
      mysql_data_seek($rs_capital_revenue, 0);
	  $row_rs_capital_revenue = mysql_fetch_assoc($rs_capital_revenue);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_yearly_revenue", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_export_rates_<?php echo $cnt1; ?>">Export rates:</label></td>
            <td><select name="company_export_rates_<?php echo $cnt1; ?>" id="company_export_rates_<?php echo $cnt1; ?>">
              <option value="" <?php if (!(strcmp("", $row_rscompany['company_export_rates']))) {echo "selected=\"selected\"";} ?>><?php echo NXT_getResource("Select one..."); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rscompany['company_export_rates']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_import_export['content']?></option>
<?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_export_rates", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_import_ratio_<?php echo $cnt1; ?>">Import ratio:</label></td>
            <td><select name="company_import_ratio_<?php echo $cnt1; ?>" id="company_import_ratio_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rscompany['company_import_ratio']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export['content']?></option>
              <?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("company", "company_import_ratio", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_main_product_<?php echo $cnt1; ?>">Main product:</label></td>
            <td><input type="text" name="company_main_product_<?php echo $cnt1; ?>" id="company_main_product_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_main_product']); ?>" size="32" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("company_main_product");?> <?php echo $tNGs->displayFieldError("company", "company_main_product", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_main_product_EN_<?php echo $cnt1; ?>">Main product(English):</label></td>
            <td><input type="text" name="company_main_product_EN_<?php echo $cnt1; ?>" id="company_main_product_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_main_product_EN']); ?>" size="32" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("company_main_product_EN");?> <?php echo $tNGs->displayFieldError("company", "company_main_product_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_main_markets_orther_<?php echo $cnt1; ?>">Main markets orther:</label></td>
            <td><input type="text" name="company_main_markets_orther_<?php echo $cnt1; ?>" id="company_main_markets_orther_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_main_markets_orther']); ?>" size="32" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("company_main_markets_orther");?> <?php echo $tNGs->displayFieldError("company", "company_main_markets_orther", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_shortinfo_<?php echo $cnt1; ?>">Short introduce:</label></td>
            <td><input type="text" name="company_shortinfo_<?php echo $cnt1; ?>" id="company_shortinfo_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_shortinfo']); ?>" size="32" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("company_shortinfo");?> <?php echo $tNGs->displayFieldError("company", "company_shortinfo", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_shortinfo_EN_<?php echo $cnt1; ?>">Short introduce(English):</label></td>
            <td><input type="text" name="company_shortinfo_EN_<?php echo $cnt1; ?>" id="company_shortinfo_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscompany['company_shortinfo_EN']); ?>" size="32" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("company_shortinfo_EN");?> <?php echo $tNGs->displayFieldError("company", "company_shortinfo_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_info_<?php echo $cnt1; ?>">Introduce:</label></td>
            <td><textarea name="company_info_<?php echo $cnt1; ?>" id="company_info_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rscompany['company_info']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("company_info");?> <?php echo $tNGs->displayFieldError("company", "company_info", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_info_EN_<?php echo $cnt1; ?>">Introduce(English):</label></td>
            <td><textarea name="company_info_EN_<?php echo $cnt1; ?>" id="company_info_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rscompany['company_info_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("company_info_EN");?> <?php echo $tNGs->displayFieldError("company", "company_info_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th">Day update:</td>
            <td><?php echo KT_formatDate($row_rscompany['company_day_update']); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="company_visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rscompany['company_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="company_visible_<?php echo $cnt1; ?>" id="company_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("company", "company_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_company_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscompany['kt_pk_company']); ?>" />
        <?php } while ($row_rscompany = mysql_fetch_assoc($rscompany)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_company'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_company')" />
            </div>
            <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
            <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
            <?php }
      // endif Conditional region1
      ?>
          <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
        </div>
      </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_country);

mysql_free_result($rs_industry);

mysql_free_result($rs_capital_revenue);

mysql_free_result($rs_capital_revenue1);

mysql_free_result($rs_import_export1);

mysql_free_result($rs_import_export);
?>
