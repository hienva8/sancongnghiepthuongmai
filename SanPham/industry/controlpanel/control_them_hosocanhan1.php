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
$formValidation->addField("mbpro_id_industry", true, "numeric", "", "", "", "Vui lòng chọn lĩnh vực hoạt động.");
$tNGs->prepareValidation($formValidation);
// End trigger

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
$query_rs_authorized_capital1 = "SELECT id_capital_revenue, cr_content FROM capital_revenue ORDER BY sort ASC";
$rs_authorized_capital1 = mysql_query($query_rs_authorized_capital1, $ketnoi) or die(mysql_error());
$row_rs_authorized_capital1 = mysql_fetch_assoc($rs_authorized_capital1);
$totalRows_rs_authorized_capital1 = mysql_num_rows($rs_authorized_capital1);

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

// Make an insert transaction instance
$ins_member_profile = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_member_profile);
// Register triggers
$ins_member_profile->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_member_profile->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_member_profile->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
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

// Make an update transaction instance
$upd_member_profile = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_member_profile);
// Register triggers
$upd_member_profile->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_member_profile->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_member_profile->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_member_profile->setTable("member_profile");
$upd_member_profile->addColumn("mbpro_id_member", "NUMERIC_TYPE", "POST", "mbpro_id_member");
$upd_member_profile->addColumn("mbpro_avatar", "FILE_TYPE", "FILES", "mbpro_avatar");
$upd_member_profile->addColumn("mbpro_id_industry", "NUMERIC_TYPE", "POST", "mbpro_id_industry");
$upd_member_profile->addColumn("mbpro_year_active", "STRING_TYPE", "POST", "mbpro_year_active");
$upd_member_profile->addColumn("mbpro_authorized_capital", "STRING_TYPE", "POST", "mbpro_authorized_capital");
$upd_member_profile->addColumn("mbpro_yearly_revenue", "STRING_TYPE", "POST", "mbpro_yearly_revenue");
$upd_member_profile->addColumn("mbpro_export_rates", "STRING_TYPE", "POST", "mbpro_export_rates");
$upd_member_profile->addColumn("mbpro_import_ratio", "STRING_TYPE", "POST", "mbpro_import_ratio");
$upd_member_profile->addColumn("mbpro_main_product", "STRING_TYPE", "POST", "mbpro_main_product");
$upd_member_profile->addColumn("mbpro_main_markets_orther", "STRING_TYPE", "POST", "mbpro_main_markets_orther");
$upd_member_profile->addColumn("mbpro_shortinfo", "STRING_TYPE", "POST", "mbpro_shortinfo");
$upd_member_profile->addColumn("mbpro_info", "STRING_TYPE", "POST", "mbpro_info");
$upd_member_profile->addColumn("mbpro_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_member_profile->addColumn("mbpro_visible", "CHECKBOX_1_0_TYPE", "POST", "mbpro_visible");
$upd_member_profile->setPrimaryKey("id_member_profile", "NUMERIC_TYPE", "GET", "id_member_profile");

// Make an instance of the transaction object
$del_member_profile = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_member_profile);
// Register triggers
$del_member_profile->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_member_profile->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_member_profile->setTable("member_profile");
$del_member_profile->setPrimaryKey("id_member_profile", "NUMERIC_TYPE", "GET", "id_member_profile");

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
<script src="../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
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
if (@$_GET['id_member_profile'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Member_profile </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsmember_profile > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td><label for="mbpro_avatar_<?php echo $cnt1; ?>">Mbpro_avatar:</label></td>
            <td><input type="file" name="mbpro_avatar_<?php echo $cnt1; ?>" id="mbpro_avatar_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_avatar", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_id_industry_<?php echo $cnt1; ?>">
              <?php echo nganhgnhe;?>
            :</label></td>
            <td><select name="mbpro_id_industry_<?php echo $cnt1; ?>" id="mbpro_id_industry_<?php echo $cnt1; ?>">
              <option value=""><?php echo chon; ?></option>
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
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_id_industry", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_year_active_<?php echo $cnt1; ?>"><?php echo namhoatdong;?> :</label></td>
            <td><select name="mbpro_year_active_<?php echo $cnt1; ?>" id="mbpro_year_active_<?php echo $cnt1; ?>">
              <option value="" ><?php echo nam;?> :</option>
             <?php for($i=date('Y');$i>=1900;$i--){ ?>
        <option value="<?php echo $i;?>" <?php if (!(strcmp(1990, KT_escapeAttribute($row_rsmember_profile['mbpro_year_active'])))) {echo "SELECTED";} ?>><?php echo $i;?></option>
        <?php }?>
            </select>
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_year_active", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_authorized_capital_<?php echo $cnt1; ?>"><?php echo vondautu;?> :</label></td>
            <td><select name="mbpro_authorized_capital_<?php echo $cnt1; ?>" id="mbpro_authorized_capital_<?php echo $cnt1; ?>">
              <option value=""><?php echo chon; ?></option>
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
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_authorized_capital", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_yearly_revenue_<?php echo $cnt1; ?>"><?php echo doanhthuhangnam;?> :</label></td>
            <td><select name="mbpro_yearly_revenue_<?php echo $cnt1; ?>" id="mbpro_yearly_revenue_<?php echo $cnt1; ?>">
              <option value=""><?php echo chon; ?></option>
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
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_yearly_revenue", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_export_rates_<?php echo $cnt1; ?>"><?php echo tilexuatkhau;?> :</label></td>
            <td><select name="mbpro_export_rates_<?php echo $cnt1; ?>" id="mbpro_export_rates_<?php echo $cnt1; ?>">
              <option value=""><?php echo chon; ?></option>
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
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_export_rates", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_import_ratio_<?php echo $cnt1; ?>"><?php echo tilenhapkhau;?> :</label></td>
            <td><select name="mbpro_import_ratio_<?php echo $cnt1; ?>" id="mbpro_import_ratio_<?php echo $cnt1; ?>">
              <option value=""><?php echo chon; ?></option>
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
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_import_ratio", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_main_product_<?php echo $cnt1; ?>"><?php echo sanphamchinh;?> :</label></td>
            <td><input type="text" name="mbpro_main_product_<?php echo $cnt1; ?>" id="mbpro_main_product_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_main_product']); ?>" size="50" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("mbpro_main_product");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_main_product", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_main_markets_orther_<?php echo $cnt1; ?>"><?php echo thitruongkhac;?> :</label></td>
            <td><input type="text" name="mbpro_main_markets_orther_<?php echo $cnt1; ?>" id="mbpro_main_markets_orther_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_main_markets_orther']); ?>" size="50" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("mbpro_main_markets_orther");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_main_markets_orther", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_shortinfo_<?php echo $cnt1; ?>"><?php echo gioithieungan;?> :</label></td>
            <td><input type="text" name="mbpro_shortinfo_<?php echo $cnt1; ?>" id="mbpro_shortinfo_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_shortinfo']); ?>" size="100" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("mbpro_shortinfo");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_shortinfo", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="mbpro_info_<?php echo $cnt1; ?>"><?php echo gioithieu;?> :</label></td>
            <td><textarea name="mbpro_info_<?php echo $cnt1; ?>" id="mbpro_info_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_info']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("mbpro_info");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_info", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><?php echo ngaycapnhat;?> :</td>
            <td><?php echo KT_formatDate($row_rsmember_profile['mbpro_day_update']); ?></td>
          </tr>
          <tr>
            <td><label for="mbpro_visible_<?php echo $cnt1; ?>"><?php echo anhien;?> :</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmember_profile['mbpro_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="mbpro_visible_<?php echo $cnt1; ?>" id="mbpro_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("member_profile", "mbpro_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_member_profile_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsmember_profile['kt_pk_member_profile']); ?>" />
        <input type="hidden" name="mbpro_id_member_<?php echo $cnt1; ?>" id="mbpro_id_member_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_id_member']); ?>" />
        <?php } while ($row_rsmember_profile = mysql_fetch_assoc($rsmember_profile)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_member_profile'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo taohoso; ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
           <?php /*?> <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_member_profile')" />
            </div><?php */?>
            <input type="submit" name="KT_Update1" value="<?php echo capnhat;?>" />
            <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
            <?php }
      // endif Conditional region1
      ?>
          <?php /*?><input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" /><?php */?>
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
mysql_free_result($rs_industry);

mysql_free_result($rs_authorized_capital);

mysql_free_result($rs_authorized_capital1);

mysql_free_result($rs_import_export);

mysql_free_result($rs_import_export1);
?>
