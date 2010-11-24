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
$formValidation->addField("inbox_recipient", true, "numeric", "", "", "", "Please enter a recipient name.");
$formValidation->addField("inbox_email", false, "text", "email", "", "", "");
$formValidation->addField("inbox_tel", false, "text", "phone", "", "", "");
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
$query_rs_member = "SELECT id_member, member_user FROM member";
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department ORDER BY sort ASC";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

// Make an insert transaction instance
$ins_inbox = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_inbox);
// Register triggers
$ins_inbox->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_inbox->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_inbox->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_inbox");
// Add columns
$ins_inbox->setTable("inbox");
$ins_inbox->addColumn("inbox_recipient", "NUMERIC_TYPE", "POST", "inbox_recipient");
$ins_inbox->addColumn("box_contact_department", "NUMERIC_TYPE", "POST", "box_contact_department");
$ins_inbox->addColumn("inbox_name_product", "STRING_TYPE", "POST", "inbox_name_product");
$ins_inbox->addColumn("inbox_sender", "STRING_TYPE", "POST", "inbox_sender");
$ins_inbox->addColumn("inbox_email", "STRING_TYPE", "POST", "inbox_email");
$ins_inbox->addColumn("inbox_address", "STRING_TYPE", "POST", "inbox_address");
$ins_inbox->addColumn("inbox_tel", "STRING_TYPE", "POST", "inbox_tel");
$ins_inbox->addColumn("inbox_subject", "STRING_TYPE", "POST", "inbox_subject");
$ins_inbox->addColumn("inbox_content", "STRING_TYPE", "POST", "inbox_content");
$ins_inbox->addColumn("inbox_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_inbox->addColumn("inbox_recycle_bin", "CHECKBOX_1_0_TYPE", "POST", "inbox_recycle_bin", "0");
$ins_inbox->setPrimaryKey("id_inbox", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_inbox = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_inbox);
// Register triggers
$upd_inbox->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_inbox->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_inbox->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_inbox");
// Add columns
$upd_inbox->setTable("inbox");
$upd_inbox->addColumn("inbox_recipient", "NUMERIC_TYPE", "POST", "inbox_recipient");
$upd_inbox->addColumn("box_contact_department", "NUMERIC_TYPE", "POST", "box_contact_department");
$upd_inbox->addColumn("inbox_name_product", "STRING_TYPE", "POST", "inbox_name_product");
$upd_inbox->addColumn("inbox_sender", "STRING_TYPE", "POST", "inbox_sender");
$upd_inbox->addColumn("inbox_email", "STRING_TYPE", "POST", "inbox_email");
$upd_inbox->addColumn("inbox_address", "STRING_TYPE", "POST", "inbox_address");
$upd_inbox->addColumn("inbox_tel", "STRING_TYPE", "POST", "inbox_tel");
$upd_inbox->addColumn("inbox_subject", "STRING_TYPE", "POST", "inbox_subject");
$upd_inbox->addColumn("inbox_content", "STRING_TYPE", "POST", "inbox_content");
$upd_inbox->addColumn("inbox_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_inbox->addColumn("inbox_recycle_bin", "CHECKBOX_1_0_TYPE", "POST", "inbox_recycle_bin");
$upd_inbox->setPrimaryKey("id_inbox", "NUMERIC_TYPE", "GET", "id_inbox");

// Make an instance of the transaction object
$del_inbox = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_inbox);
// Register triggers
$del_inbox->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_inbox->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_inbox");
// Add columns
$del_inbox->setTable("inbox");
$del_inbox->setPrimaryKey("id_inbox", "NUMERIC_TYPE", "GET", "id_inbox");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsinbox = $tNGs->getRecordset("inbox");
$row_rsinbox = mysql_fetch_assoc($rsinbox);
$totalRows_rsinbox = mysql_num_rows($rsinbox);
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
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_inbox'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Inbox </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsinbox > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="inbox_recipient_<?php echo $cnt1; ?>">Recipient:</label></td>
            <td><select name="inbox_recipient_<?php echo $cnt1; ?>" id="inbox_recipient_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_member['id_member']?>"<?php if (!(strcmp($row_rs_member['id_member'], $row_rsinbox['inbox_recipient']))) {echo "SELECTED";} ?>><?php echo $row_rs_member['member_user']?></option>
              <?php
} while ($row_rs_member = mysql_fetch_assoc($rs_member));
  $rows = mysql_num_rows($rs_member);
  if($rows > 0) {
      mysql_data_seek($rs_member, 0);
	  $row_rs_member = mysql_fetch_assoc($rs_member);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("inbox", "inbox_recipient", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="box_contact_department_<?php echo $cnt1; ?>">Contact department:</label></td>
            <td><select name="box_contact_department_<?php echo $cnt1; ?>" id="box_contact_department_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rsinbox['box_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
              <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("inbox", "box_contact_department", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_name_product_<?php echo $cnt1; ?>">Inbox_name_product:</label></td>
            <td><input type="text" name="inbox_name_product_<?php echo $cnt1; ?>" id="inbox_name_product_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_name_product']); ?>" size="50" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("inbox_name_product");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_name_product", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_sender_<?php echo $cnt1; ?>">Sender:</label></td>
            <td><input type="text" name="inbox_sender_<?php echo $cnt1; ?>" id="inbox_sender_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_sender']); ?>" size="40" />
                <?php echo $tNGs->displayFieldHint("inbox_sender");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_sender", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_email_<?php echo $cnt1; ?>">Email:</label></td>
            <td><input type="text" name="inbox_email_<?php echo $cnt1; ?>" id="inbox_email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_email']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("inbox_email");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_email", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_address_<?php echo $cnt1; ?>">Address:</label></td>
            <td><input type="text" name="inbox_address_<?php echo $cnt1; ?>" id="inbox_address_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_address']); ?>" size="70" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("inbox_address");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_address", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_tel_<?php echo $cnt1; ?>">Tel:</label></td>
            <td><input type="text" name="inbox_tel_<?php echo $cnt1; ?>" id="inbox_tel_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_tel']); ?>" size="20" maxlength="20" />
                <?php echo $tNGs->displayFieldHint("inbox_tel");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_tel", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_subject_<?php echo $cnt1; ?>">Subject:</label></td>
            <td><input type="text" name="inbox_subject_<?php echo $cnt1; ?>" id="inbox_subject_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_subject']); ?>" size="75" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("inbox_subject");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_subject", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_content_<?php echo $cnt1; ?>">Content:</label></td>
            <td><textarea name="inbox_content_<?php echo $cnt1; ?>" cols="70" rows="10" id="inbox_content_<?php echo $cnt1; ?>"><?php echo KT_escapeAttribute($row_rsinbox['inbox_content']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("inbox_content");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th">Date update:</td>
            <td><?php echo KT_formatDate($row_rsinbox['inbox_day_update']); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="inbox_recycle_bin_<?php echo $cnt1; ?>">Inbox_recycle:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsinbox['inbox_recycle_bin']),"1"))) {echo "checked";} ?> type="checkbox" name="inbox_recycle_bin_<?php echo $cnt1; ?>" id="inbox_recycle_bin_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("inbox", "inbox_recycle_bin", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_inbox_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsinbox['kt_pk_inbox']); ?>" />
        <?php } while ($row_rsinbox = mysql_fetch_assoc($rsinbox)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_inbox'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_inbox')" />
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
mysql_free_result($rs_member);

mysql_free_result($rs_contact_department);
?>
