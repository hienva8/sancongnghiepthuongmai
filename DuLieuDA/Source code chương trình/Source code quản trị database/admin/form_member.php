<?php require_once('../Connections/ketnoi.php'); ?><?php
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

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Could not create account.");
  $myThrowError->setField("member_password");
  $myThrowError->setFieldErrorMsg("The two passwords do not match.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("member_user", true, "text", "", "", "", "Please enter a username.");
$formValidation->addField("member_password", true, "text", "", "", "", "Please enter a password.");
$formValidation->addField("member_id_country", true, "numeric", "", "", "", "Please choose your country");
$formValidation->addField("member_name", true, "text", "", "", "", "Please enter full name.");
$formValidation->addField("member_email", true, "text", "email", "", "", "Please enter your email");
$formValidation->addField("member_address", true, "text", "", "", "", "Please enter your address.");
$formValidation->addField("member_tell", true, "text", "phone", "", "", "Please enter your phone.");
$formValidation->addField("member_kind", true, "text", "", "", "", "Please choose kind member");
$formValidation->addField("member_accesslevel", true, "numeric", "", "", "", "Please choose access level.");
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

//start Trigger_CheckOldPassword trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckOldPassword(&$tNG) {
  return Trigger_UpdatePassword_CheckOldPassword($tNG);
}
//end Trigger_CheckOldPassword trigger

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

// Make an insert transaction instance
$ins_member = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_member);
// Register triggers
$ins_member->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_member->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_member->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_member");
$ins_member->registerConditionalTrigger("{POST.member_password} != {POST.re_member_password}", "BEFORE", "Trigger_CheckPasswords", 50);
// Add columns
$ins_member->setTable("member");
$ins_member->addColumn("member_user", "STRING_TYPE", "POST", "member_user");
$ins_member->addColumn("member_password", "STRING_TYPE", "POST", "member_password");
$ins_member->addColumn("member_id_country", "NUMERIC_TYPE", "POST", "member_id_country");
$ins_member->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$ins_member->addColumn("member_sex", "STRING_TYPE", "POST", "member_sex");
$ins_member->addColumn("member_email", "STRING_TYPE", "POST", "member_email");
$ins_member->addColumn("member_address", "STRING_TYPE", "POST", "member_address");
$ins_member->addColumn("member_tell", "STRING_TYPE", "POST", "member_tell");
$ins_member->addColumn("member_fax", "STRING_TYPE", "POST", "member_fax");
$ins_member->addColumn("member_kind", "STRING_TYPE", "POST", "member_kind");
$ins_member->addColumn("member_intro", "STRING_TYPE", "POST", "member_intro");
$ins_member->addColumn("member_maillisting", "CHECKBOX_1_0_TYPE", "POST", "member_maillisting", "0");
$ins_member->addColumn("member_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_member->addColumn("member_accesslevel", "NUMERIC_TYPE", "POST", "member_accesslevel");
$ins_member->addColumn("member_active", "CHECKBOX_1_0_TYPE", "POST", "member_active", "0");
$ins_member->setPrimaryKey("id_member", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_member = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_member);
// Register triggers
$upd_member->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_member->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_member->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_member");
$upd_member->registerConditionalTrigger("{POST.member_password} != {POST.re_member_password}", "BEFORE", "Trigger_CheckPasswords", 50);
$upd_member->registerTrigger("BEFORE", "Trigger_CheckOldPassword", 60);
// Add columns
$upd_member->setTable("member");
$upd_member->addColumn("member_user", "STRING_TYPE", "POST", "member_user");
$upd_member->addColumn("member_password", "STRING_TYPE", "POST", "member_password");
$upd_member->addColumn("member_id_country", "NUMERIC_TYPE", "POST", "member_id_country");
$upd_member->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$upd_member->addColumn("member_sex", "STRING_TYPE", "POST", "member_sex");
$upd_member->addColumn("member_email", "STRING_TYPE", "POST", "member_email");
$upd_member->addColumn("member_address", "STRING_TYPE", "POST", "member_address");
$upd_member->addColumn("member_tell", "STRING_TYPE", "POST", "member_tell");
$upd_member->addColumn("member_fax", "STRING_TYPE", "POST", "member_fax");
$upd_member->addColumn("member_kind", "STRING_TYPE", "POST", "member_kind");
$upd_member->addColumn("member_intro", "STRING_TYPE", "POST", "member_intro");
$upd_member->addColumn("member_maillisting", "CHECKBOX_1_0_TYPE", "POST", "member_maillisting");
$upd_member->addColumn("member_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_member->addColumn("member_accesslevel", "NUMERIC_TYPE", "POST", "member_accesslevel");
$upd_member->addColumn("member_active", "CHECKBOX_1_0_TYPE", "POST", "member_active");
$upd_member->setPrimaryKey("id_member", "NUMERIC_TYPE", "GET", "id_member");

// Make an instance of the transaction object
$del_member = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_member);
// Register triggers
$del_member->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_member->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_member");
// Add columns
$del_member->setTable("member");
$del_member->setPrimaryKey("id_member", "NUMERIC_TYPE", "GET", "id_member");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmember = $tNGs->getRecordset("member");
$row_rsmember = mysql_fetch_assoc($rsmember);
$totalRows_rsmember = mysql_num_rows($rsmember);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?><script src="../includes/nxt/scripts/form.js" type="text/javascript"></script><script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
</head>

<body>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_member'] == "") {
?>
    <?php echo NXT_getResource("Insert_FH"); ?>
    <?php 
// else Conditional region1
} else { ?>
    <?php echo NXT_getResource("Update_FH"); ?>
    <?php } 
// endif Conditional region1
?>
    Member </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
      <?php $cnt1++; ?>
      <?php 
// Show IF Conditional region1 
if (@$totalRows_rsmember > 1) {
?>
      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
      <?php } 
// endif Conditional region1
?>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <tr>
          <td class="KT_th"><label for="member_user_<?php echo $cnt1; ?>">User name:</label></td>
          <td><input type="text" name="member_user_<?php echo $cnt1; ?>" id="member_user_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember['member_user']); ?>" size="32" maxlength="50" />
              <?php echo $tNGs->displayFieldHint("member_user");?> <?php echo $tNGs->displayFieldError("member", "member_user", $cnt1); ?> </td>
        </tr>
        <?php 
// Show IF Conditional show_old_member_password_on_update_only 
if (@$_GET['id_member'] != "") {
?>
        <tr>
          <td class="KT_th"><label for="old_member_password_<?php echo $cnt1; ?>">Old Password:</label></td>
          <td><input type="password" name="old_member_password_<?php echo $cnt1; ?>" id="old_member_password_<?php echo $cnt1; ?>" value="" size="32" maxlength="32" />
              <?php echo $tNGs->displayFieldError("member", "old_member_password", $cnt1); ?> </td>
        </tr>
        <?php } 
// endif Conditional show_old_member_password_on_update_only
?>
        <tr>
          <td class="KT_th"><label for="member_password_<?php echo $cnt1; ?>">Password:</label></td>
          <td><input type="password" name="member_password_<?php echo $cnt1; ?>" id="member_password_<?php echo $cnt1; ?>" value="" size="32" maxlength="32" />
              <?php echo $tNGs->displayFieldHint("member_password");?> <?php echo $tNGs->displayFieldError("member", "member_password", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="re_member_password_<?php echo $cnt1; ?>">Re-type Password:</label></td>
          <td><input type="password" name="re_member_password_<?php echo $cnt1; ?>" id="re_member_password_<?php echo $cnt1; ?>" value="" size="32" maxlength="32" />
          </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_id_country_<?php echo $cnt1; ?>">Country:</label></td>
          <td><select name="member_id_country_<?php echo $cnt1; ?>" id="member_id_country_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
            <?php 
do {  
?>
            <option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], $row_rsmember['member_id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name']?></option>
            <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
          </select>
              <?php echo $tNGs->displayFieldError("member", "member_id_country", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_name_<?php echo $cnt1; ?>">Full name:</label></td>
          <td><input type="text" name="member_name_<?php echo $cnt1; ?>" id="member_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember['member_name']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("member_name");?> <?php echo $tNGs->displayFieldError("member", "member_name", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_sex_<?php echo $cnt1; ?>_1">Gender:</label></td>
          <td><div>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"Mr"))) {echo "CHECKED";} ?> type="radio" name="member_sex_<?php echo $cnt1; ?>" id="member_sex_<?php echo $cnt1; ?>_1" value="Mr" />
            <label for="member_sex_<?php echo $cnt1; ?>_1">Mr</label>
          </div>
              <div>
                <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"Mrs/Miss"))) {echo "CHECKED";} ?> type="radio" name="member_sex_<?php echo $cnt1; ?>" id="member_sex_<?php echo $cnt1; ?>_2" value="Mrs/Miss" />
                <label for="member_sex_<?php echo $cnt1; ?>_2">Mrs/Miss</label>
              </div>
            <div>
                <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"Orther"))) {echo "CHECKED";} ?> type="radio" name="member_sex_<?php echo $cnt1; ?>" id="member_sex_<?php echo $cnt1; ?>_3" value="Orther" />
                <label for="member_sex_<?php echo $cnt1; ?>_3">Orther</label>
              </div>
            <?php echo $tNGs->displayFieldError("member", "member_sex", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_email_<?php echo $cnt1; ?>">Email:</label></td>
          <td><input type="text" name="member_email_<?php echo $cnt1; ?>" id="member_email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember['member_email']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("member_email");?> <?php echo $tNGs->displayFieldError("member", "member_email", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_address_<?php echo $cnt1; ?>">Address:</label></td>
          <td><input type="text" name="member_address_<?php echo $cnt1; ?>" id="member_address_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember['member_address']); ?>" size="32" maxlength="200" />
              <?php echo $tNGs->displayFieldHint("member_address");?> <?php echo $tNGs->displayFieldError("member", "member_address", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_tell_<?php echo $cnt1; ?>">Phone:</label></td>
          <td><input type="text" name="member_tell_<?php echo $cnt1; ?>" id="member_tell_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember['member_tell']); ?>" size="20" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("member_tell");?> <?php echo $tNGs->displayFieldError("member", "member_tell", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_fax_<?php echo $cnt1; ?>">Fax:</label></td>
          <td><input type="text" name="member_fax_<?php echo $cnt1; ?>" id="member_fax_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmember['member_fax']); ?>" size="20" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("member_fax");?> <?php echo $tNGs->displayFieldError("member", "member_fax", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_kind_<?php echo $cnt1; ?>">Kind:</label></td>
          <td><select name="member_kind_<?php echo $cnt1; ?>" id="member_kind_<?php echo $cnt1; ?>">
            <option value="VIP" <?php if (!(strcmp("VIP", KT_escapeAttribute($row_rsmember['member_kind'])))) {echo "SELECTED";} ?>>VIP</option>
            <option value="Business" <?php if (!(strcmp("Business", KT_escapeAttribute($row_rsmember['member_kind'])))) {echo "SELECTED";} ?>>Business</option>
            <option value="Member" <?php if (!(strcmp("Member", KT_escapeAttribute($row_rsmember['member_kind'])))) {echo "SELECTED";} ?>>Member</option>
          </select>
              <?php echo $tNGs->displayFieldError("member", "member_kind", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_intro_<?php echo $cnt1; ?>">Introduce:</label></td>
          <td><textarea name="member_intro_<?php echo $cnt1; ?>" id="member_intro_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsmember['member_intro']); ?></textarea>
              <?php echo $tNGs->displayFieldHint("member_intro");?> <?php echo $tNGs->displayFieldError("member", "member_intro", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_maillisting_<?php echo $cnt1; ?>">Accept send mail:</label></td>
          <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_maillisting']),"1"))) {echo "checked";} ?> type="checkbox" name="member_maillisting_<?php echo $cnt1; ?>" id="member_maillisting_<?php echo $cnt1; ?>" value="1" />
              <?php echo $tNGs->displayFieldError("member", "member_maillisting", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th">Day update:</td>
          <td><?php echo KT_formatDate($row_rsmember['member_day_update']); ?></td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_accesslevel_<?php echo $cnt1; ?>">Level:</label></td>
          <td><select name="member_accesslevel_<?php echo $cnt1; ?>" id="member_accesslevel_<?php echo $cnt1; ?>">
            <option value="" >--Select--</option>
            <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rsmember['member_accesslevel'])))) {echo "SELECTED";} ?>>Admin</option>
            <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rsmember['member_accesslevel'])))) {echo "SELECTED";} ?>>Member</option>
          </select>
              <?php echo $tNGs->displayFieldError("member", "member_accesslevel", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_active_<?php echo $cnt1; ?>">Active:</label></td>
          <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_active']),"1"))) {echo "checked";} ?> type="checkbox" name="member_active_<?php echo $cnt1; ?>" id="member_active_<?php echo $cnt1; ?>" value="1" />
              <?php echo $tNGs->displayFieldError("member", "member_active", $cnt1); ?> </td>
        </tr>
      </table>
      <input type="hidden" name="kt_pk_member_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsmember['kt_pk_member']); ?>" />
      <?php } while ($row_rsmember = mysql_fetch_assoc($rsmember)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_member'] == "") {
      ?>
          <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
          <?php 
      // else Conditional region1
      } else { ?>
          <div class="KT_operations">
            <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_member')" />
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
</html><?php
mysql_free_result($rs_country);
?>
