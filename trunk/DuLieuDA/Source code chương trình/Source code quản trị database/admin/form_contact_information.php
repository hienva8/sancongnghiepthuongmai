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
$formValidation->addField("ct_info_fullname", true, "text", "", "", "", "Please enter a valid value.");
$formValidation->addField("ct_info_email", false, "text", "email", "", "", "");
$formValidation->addField("ct_info_tel", false, "text", "phone", "", "", "");
$formValidation->addField("ct_info_mobile", false, "text", "phone", "", "", "");
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
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_position = "SELECT id_position, position_name FROM `position` ORDER BY sort ASC";
$rs_position = mysql_query($query_rs_position, $ketnoi) or die(mysql_error());
$row_rs_position = mysql_fetch_assoc($rs_position);
$totalRows_rs_position = mysql_num_rows($rs_position);

// Make an insert transaction instance
$ins_contact_information = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_contact_information);
// Register triggers
$ins_contact_information->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_contact_information->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_contact_information->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_contact_information");
// Add columns
$ins_contact_information->setTable("contact_information");
$ins_contact_information->addColumn("ct_info_fullname", "STRING_TYPE", "POST", "ct_info_fullname");
$ins_contact_information->addColumn("ct_info_company", "STRING_TYPE", "POST", "ct_info_company");
$ins_contact_information->addColumn("ct_info_department", "NUMERIC_TYPE", "POST", "ct_info_department");
$ins_contact_information->addColumn("ct_info_position", "NUMERIC_TYPE", "POST", "ct_info_position");
$ins_contact_information->addColumn("ct_info_email", "STRING_TYPE", "POST", "ct_info_email");
$ins_contact_information->addColumn("ct_info_address", "STRING_TYPE", "POST", "ct_info_address");
$ins_contact_information->addColumn("ct_info_tel", "STRING_TYPE", "POST", "ct_info_tel");
$ins_contact_information->addColumn("ct_info_mobile", "STRING_TYPE", "POST", "ct_info_mobile");
$ins_contact_information->addColumn("ct_info_fax", "STRING_TYPE", "POST", "ct_info_fax");
$ins_contact_information->setPrimaryKey("id_contact_information", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_contact_information = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_contact_information);
// Register triggers
$upd_contact_information->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_contact_information->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_contact_information->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_contact_information");
// Add columns
$upd_contact_information->setTable("contact_information");
$upd_contact_information->addColumn("ct_info_fullname", "STRING_TYPE", "POST", "ct_info_fullname");
$upd_contact_information->addColumn("ct_info_company", "STRING_TYPE", "POST", "ct_info_company");
$upd_contact_information->addColumn("ct_info_department", "NUMERIC_TYPE", "POST", "ct_info_department");
$upd_contact_information->addColumn("ct_info_position", "NUMERIC_TYPE", "POST", "ct_info_position");
$upd_contact_information->addColumn("ct_info_email", "STRING_TYPE", "POST", "ct_info_email");
$upd_contact_information->addColumn("ct_info_address", "STRING_TYPE", "POST", "ct_info_address");
$upd_contact_information->addColumn("ct_info_tel", "STRING_TYPE", "POST", "ct_info_tel");
$upd_contact_information->addColumn("ct_info_mobile", "STRING_TYPE", "POST", "ct_info_mobile");
$upd_contact_information->addColumn("ct_info_fax", "STRING_TYPE", "POST", "ct_info_fax");
$upd_contact_information->setPrimaryKey("id_contact_information", "NUMERIC_TYPE", "GET", "id_contact_information");

// Make an instance of the transaction object
$del_contact_information = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_contact_information);
// Register triggers
$del_contact_information->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_contact_information->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_contact_information");
// Add columns
$del_contact_information->setTable("contact_information");
$del_contact_information->setPrimaryKey("id_contact_information", "NUMERIC_TYPE", "GET", "id_contact_information");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscontact_information = $tNGs->getRecordset("contact_information");
$row_rscontact_information = mysql_fetch_assoc($rscontact_information);
$totalRows_rscontact_information = mysql_num_rows($rscontact_information);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?><script src="../includes/nxt/scripts/form.js" type="text/javascript"></script><script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
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
if (@$_GET['id_contact_information'] == "") {
?>
    <?php echo NXT_getResource("Insert_FH"); ?>
    <?php 
// else Conditional region1
} else { ?>
    <?php echo NXT_getResource("Update_FH"); ?>
    <?php } 
// endif Conditional region1
?>
    Contact_information </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
      <?php $cnt1++; ?>
      <?php 
// Show IF Conditional region1 
if (@$totalRows_rscontact_information > 1) {
?>
      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
      <?php } 
// endif Conditional region1
?>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <tr>
          <td class="KT_th"><label for="ct_info_fullname_<?php echo $cnt1; ?>">Full name:</label></td>
          <td><input type="text" name="ct_info_fullname_<?php echo $cnt1; ?>" id="ct_info_fullname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_fullname']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("ct_info_fullname");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_fullname", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_company_<?php echo $cnt1; ?>">Company name:</label></td>
          <td><input type="text" name="ct_info_company_<?php echo $cnt1; ?>" id="ct_info_company_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_company']); ?>" size="32" />
            <?php echo $tNGs->displayFieldHint("ct_info_company");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_company", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_department_<?php echo $cnt1; ?>">Contact department:</label></td>
          <td><select name="ct_info_department_<?php echo $cnt1; ?>" id="ct_info_department_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
            <?php 
do {  
?>
            <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rscontact_information['ct_info_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
            <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
          </select>
              <?php echo $tNGs->displayFieldError("contact_information", "ct_info_department", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_position_<?php echo $cnt1; ?>">Position:</label></td>
          <td><select name="ct_info_position_<?php echo $cnt1; ?>" id="ct_info_position_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
            <?php 
do {  
?>
            <option value="<?php echo $row_rs_position['id_position']?>"<?php if (!(strcmp($row_rs_position['id_position'], $row_rscontact_information['ct_info_position']))) {echo "SELECTED";} ?>><?php echo $row_rs_position['position_name']?></option>
            <?php
} while ($row_rs_position = mysql_fetch_assoc($rs_position));
  $rows = mysql_num_rows($rs_position);
  if($rows > 0) {
      mysql_data_seek($rs_position, 0);
	  $row_rs_position = mysql_fetch_assoc($rs_position);
  }
?>
          </select>
              <?php echo $tNGs->displayFieldError("contact_information", "ct_info_position", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_email_<?php echo $cnt1; ?>">Email:</label></td>
          <td><input type="text" name="ct_info_email_<?php echo $cnt1; ?>" id="ct_info_email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_email']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("ct_info_email");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_email", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_address_<?php echo $cnt1; ?>">Address:</label></td>
          <td><input type="text" name="ct_info_address_<?php echo $cnt1; ?>" id="ct_info_address_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_address']); ?>" size="32" maxlength="200" />
              <?php echo $tNGs->displayFieldHint("ct_info_address");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_address", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_tel_<?php echo $cnt1; ?>">Tel:</label></td>
          <td><input type="text" name="ct_info_tel_<?php echo $cnt1; ?>" id="ct_info_tel_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_tel']); ?>" size="20" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("ct_info_tel");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_tel", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_mobile_<?php echo $cnt1; ?>">Mobile:</label></td>
          <td><input type="text" name="ct_info_mobile_<?php echo $cnt1; ?>" id="ct_info_mobile_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_mobile']); ?>" size="20" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("ct_info_mobile");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_mobile", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="ct_info_fax_<?php echo $cnt1; ?>">Fax:</label></td>
          <td><input type="text" name="ct_info_fax_<?php echo $cnt1; ?>" id="ct_info_fax_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_fax']); ?>" size="20" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("ct_info_fax");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_fax", $cnt1); ?> </td>
        </tr>
      </table>
      <input type="hidden" name="kt_pk_contact_information_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscontact_information['kt_pk_contact_information']); ?>" />
      <?php } while ($row_rscontact_information = mysql_fetch_assoc($rscontact_information)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_contact_information'] == "") {
      ?>
          <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
          <?php 
      // else Conditional region1
      } else { ?>
          <div class="KT_operations">
            <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_contact_information')" />
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
mysql_free_result($rs_contact_department);

mysql_free_result($rs_position);
?>
