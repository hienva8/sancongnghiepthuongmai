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
$formValidation->addField("mbpro_id_industry", true, "numeric", "", "", "", "Vui lòng chọn lĩnh vực hoạt động.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("mbpro_avatar");
  $uploadObj->setDbFieldName("mbpro_avatar");
  $uploadObj->setFolder("../uploads/avatar/{SESSION.kt_login_id}/");
  $uploadObj->setResize("true", 100, 0);
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
$query_rs_industry = "SELECT id_industry, industry_name FROM industry ORDER BY sort ASC";
$rs_industry = mysql_query($query_rs_industry, $ketnoi) or die(mysql_error());
$row_rs_industry = mysql_fetch_assoc($rs_industry);
$totalRows_rs_industry = mysql_num_rows($rs_industry);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_authorized_capital = "SELECT id_capital_revenue, cr_content FROM capital_revenue ORDER BY sort ASC";
$rs_authorized_capital = mysql_query($query_rs_authorized_capital, $ketnoi) or die(mysql_error());
$row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital);
$totalRows_rs_authorized_capital = mysql_num_rows($rs_authorized_capital);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export = "SELECT id_import_export, content FROM import_export ORDER BY sort ASC";
$rs_import_export = mysql_query($query_rs_import_export, $ketnoi) or die(mysql_error());
$row_rs_import_export = mysql_fetch_assoc($rs_import_export);
$totalRows_rs_import_export = mysql_num_rows($rs_import_export);

$colname_rs_member1 = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member1 = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member1 = sprintf("SELECT id_member, member_id_country, member_name, member_sex, member_email, member_address, member_tell, member_fax,country_name FROM member,country WHERE id_member = %s AND member_id_country=id_country", GetSQLValueString($colname_rs_member1, "int"));
$rs_member1 = mysql_query($query_rs_member1, $ketnoi) or die(mysql_error());
$row_rs_member1 = mysql_fetch_assoc($rs_member1);
$totalRows_rs_member1 = mysql_num_rows($rs_member1);

// Make an insert transaction instance
$ins_member_profile = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_member_profile);
// Register triggers
$ins_member_profile->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_member_profile->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_member_profile->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=mbprofile");
$ins_member_profile->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_member_profile->setTable("member_profile");
$ins_member_profile->addColumn("mbpro_id_member", "NUMERIC_TYPE", "POST", "mbpro_id_member", "{SESSION.kt_login_id}");
$ins_member_profile->addColumn("mbpro_avatar", "FILE_TYPE", "FILES", "mbpro_avatar");
$ins_member_profile->addColumn("mbpro_id_industry", "NUMERIC_TYPE", "POST", "mbpro_id_industry");
$ins_member_profile->addColumn("mbpro_year_active", "STRING_TYPE", "POST", "mbpro_year_active");
$ins_member_profile->addColumn("mbpro_authorized_capital", "STRING_TYPE", "POST", "mbpro_authorized_capital");
$ins_member_profile->addColumn("mbpro_yearly_revenue", "STRING_TYPE", "POST", "mbpro_yearly_revenue");
$ins_member_profile->addColumn("mbpro_export_rates", "STRING_TYPE", "POST", "mbpro_export_rates");
$ins_member_profile->addColumn("mbpro_import_ratio", "STRING_TYPE", "POST", "mbpro_import_ratio");
$ins_member_profile->addColumn("mbpro_main_product", "STRING_TYPE", "POST", "mbpro_main_product");
$ins_member_profile->addColumn("mbpro_main_markets_orther", "STRING_TYPE", "POST", "mbpro_main_markets_orther");
$ins_member_profile->addColumn("mbpro_shortinfo", "STRING_TYPE", "POST", "mbpro_shortinfo");
$ins_member_profile->addColumn("mbpro_info", "STRING_TYPE", "POST", "mbpro_info");
$ins_member_profile->addColumn("mbpro_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_member_profile->addColumn("mbpro_visible", "CHECKBOX_1_0_TYPE", "POST", "mbpro_visible", "1");
$ins_member_profile->setPrimaryKey("id_member_profile", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmember_profile = $tNGs->getRecordset("member_profile");
$row_rsmember_profile = mysql_fetch_assoc($rsmember_profile);
$totalRows_rsmember_profile = mysql_num_rows($rsmember_profile);
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
</head>

<body>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
  <tr>
      <td><label><?php echo hoten;?> :</label></td>
    <td><?php echo $row_rs_member1['member_name']; ?></td>
    </tr>
    <tr>
      <td><label><?php echo quoctich;?> :</label></td>
    <td><?php echo $row_rs_member1['country_name']; ?></td>
    </tr>
    <tr>
      <td><label><?php echo gioitinh;?> :</label></td>
    <td><?php echo $row_rs_member1['member_sex']; ?></td>
    </tr>
    <tr>
      <td><label><?php echo diachi;?> :</label></td>
    <td><?php echo $row_rs_member1['member_address']; ?></td>
    </tr>
     <tr>
      <td><label><?php echo email;?> :</label></td>
    <td><?php echo $row_rs_member1['member_email']; ?></td>
    </tr>
    <tr>
      <td><label><?php echo dienthoai;?> :</label></td>
    <td><?php echo $row_rs_member1['member_tell']; ?></td>
    </tr>
    <tr>
      <td><label><?php echo fax;?> :</label></td>
    <td><?php echo $row_rs_member1['member_fax']; ?></td>
    </tr>   
    <tr>
      <td><label for="mbpro_avatar"><?php echo hinhdaidien;?> :</label></td>
    <td><input type="file" name="mbpro_avatar" id="mbpro_avatar" size="32" />
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_avatar"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_id_industry">
        <?php echo congnghiep;?>
        :</label></td>
      <td><select name="mbpro_id_industry" id="mbpro_id_industry">
      <option value="" ><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_industry['id_industry']?>"<?php if (!(strcmp($row_rs_industry['id_industry'], $row_rsmember_profile['mbpro_id_industry']))) {echo "SELECTED";} ?>><?php echo $row_rs_industry['industry_name']?></option>
        <?php
} while ($row_rs_industry = mysql_fetch_assoc($rs_industry));
  $rows = mysql_num_rows($rs_industry);
  if($rows > 0) {
      mysql_data_seek($rs_industry, 0);
	  $row_rs_industry = mysql_fetch_assoc($rs_industry);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_id_industry"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_year_active"><?php echo namhoatdong;?> :</label></td>
      <td><select name="mbpro_year_active" id="mbpro_year_active">
        <option value="" ><?php echo nam;?>...</option>
        <?php for($i=date('Y');$i>=1900;$i--){ ?>
        <option value="<?php echo $i;?>" <?php if (!(strcmp($i, KT_escapeAttribute($row_rsmember_profile['mbpro_year_active'])))) {echo "SELECTED";} ?>><?php echo $i;?></option>
        <?php }?>

      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_year_active"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_authorized_capital"><?php echo vondautu;?> :</label></td>
      <td><select name="mbpro_authorized_capital" id="mbpro_authorized_capital">
      <option value="" ><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_authorized_capital['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_authorized_capital['id_capital_revenue'], $row_rsmember_profile['mbpro_authorized_capital']))) {echo "SELECTED";} ?>><?php echo $row_rs_authorized_capital['cr_content']?></option>
        <?php
} while ($row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital));
  $rows = mysql_num_rows($rs_authorized_capital);
  if($rows > 0) {
      mysql_data_seek($rs_authorized_capital, 0);
	  $row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_authorized_capital"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_yearly_revenue"><?php echo doanhthuhangnam;?> :</label></td>
      <td><select name="mbpro_yearly_revenue" id="mbpro_yearly_revenue">
      <option value="" ><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_authorized_capital['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_authorized_capital['id_capital_revenue'], $row_rsmember_profile['mbpro_yearly_revenue']))) {echo "SELECTED";} ?>><?php echo $row_rs_authorized_capital['cr_content']?></option>
        <?php
} while ($row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital));
  $rows = mysql_num_rows($rs_authorized_capital);
  if($rows > 0) {
      mysql_data_seek($rs_authorized_capital, 0);
	  $row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_yearly_revenue"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_export_rates"><?php echo tilexuatkhau;?> :</label></td>
      <td><select name="mbpro_export_rates" id="mbpro_export_rates">
      <option value="" ><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rsmember_profile['mbpro_export_rates']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export['content']?></option>
        <?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_export_rates"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_import_ratio"><?php echo tilenhapkhau;?> :</label></td>
      <td><select name="mbpro_import_ratio" id="mbpro_import_ratio">
      <option value="" ><?php echo chon;?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rsmember_profile['mbpro_import_ratio']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export['content']?></option>
        <?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_import_ratio"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_main_product"><?php echo sanphamchinh;?> :</label></td>
    <td><input name="mbpro_main_product" type="text" id="mbpro_main_product" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_main_product']); ?>" size="50" maxlength="255" />
          <?php echo $tNGs->displayFieldHint("mbpro_main_product");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_main_product"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_main_markets_orther"><?php echo thitruongkhac;?> :</label></td>
    <td><input name="mbpro_main_markets_orther" type="text" id="mbpro_main_markets_orther" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_main_markets_orther']); ?>" size="50" maxlength="255" />
          <?php echo $tNGs->displayFieldHint("mbpro_main_markets_orther");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_main_markets_orther"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_shortinfo"><?php echo gioithieungan;?> :</label></td>
    <td><input name="mbpro_shortinfo" type="text" id="mbpro_shortinfo" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_shortinfo']); ?>" size="100" maxlength="255" />
          <?php echo $tNGs->displayFieldHint("mbpro_shortinfo");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_shortinfo"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_info"><?php echo gioithieu;?> :</label></td>
    <td><textarea name="mbpro_info" cols="70" rows="10" id="mbpro_info"><?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_info']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("mbpro_info");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_info"); ?> </td>
    </tr>
    <tr>
      <td><label for="mbpro_day_update"><?php echo ngaycapnhat;?> :</label></td>
    <td><?php echo KT_formatDate($row_rsmember_profile['mbpro_day_update']); ?></td>
    </tr>
    <tr>
      <td><label for="mbpro_visible"><?php echo anhien;?> :</label></td>
    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmember_profile['mbpro_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="mbpro_visible" id="mbpro_visible" value="1" />
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_visible"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo taohoso;?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="mbpro_id_member" id="mbpro_id_member" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_id_member']); ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($rs_industry);

mysql_free_result($rs_authorized_capital);

mysql_free_result($rs_import_export);

mysql_free_result($rs_member1);
?>
