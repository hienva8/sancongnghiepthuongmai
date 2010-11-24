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
$formValidation->addField("methods_name", true, "text", "", "", "", "Please enter a payment method name.");
$formValidation->addField("methods_name_EN", true, "text", "", "", "", "Please enter a payment method name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_payment_methods = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_payment_methods);
// Register triggers
$ins_payment_methods->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_payment_methods->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_payment_methods->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_payment_methods");
$ins_payment_methods->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_payment_methods->setTable("payment_methods");
$ins_payment_methods->addColumn("methods_name", "STRING_TYPE", "POST", "methods_name");
$ins_payment_methods->addColumn("methods_name_EN", "STRING_TYPE", "POST", "methods_name_EN");
$ins_payment_methods->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_payment_methods->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_payment_methods->setPrimaryKey("id_payment_methods", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_payment_methods = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_payment_methods);
// Register triggers
$upd_payment_methods->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_payment_methods->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_payment_methods->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_payment_methods");
// Add columns
$upd_payment_methods->setTable("payment_methods");
$upd_payment_methods->addColumn("methods_name", "STRING_TYPE", "POST", "methods_name");
$upd_payment_methods->addColumn("methods_name_EN", "STRING_TYPE", "POST", "methods_name_EN");
$upd_payment_methods->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_payment_methods->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_payment_methods->setPrimaryKey("id_payment_methods", "NUMERIC_TYPE", "GET", "id_payment_methods");

// Make an instance of the transaction object
$del_payment_methods = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_payment_methods);
// Register triggers
$del_payment_methods->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_payment_methods->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_payment_methods");
// Add columns
$del_payment_methods->setTable("payment_methods");
$del_payment_methods->setPrimaryKey("id_payment_methods", "NUMERIC_TYPE", "GET", "id_payment_methods");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rspayment_methods = $tNGs->getRecordset("payment_methods");
$row_rspayment_methods = mysql_fetch_assoc($rspayment_methods);
$totalRows_rspayment_methods = mysql_num_rows($rspayment_methods);
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
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_payment_methods'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Payment methods </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rspayment_methods > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="methods_name_<?php echo $cnt1; ?>">Payment methods name:</label></td>
            <td><input type="text" name="methods_name_<?php echo $cnt1; ?>" id="methods_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rspayment_methods['methods_name']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("methods_name");?> <?php echo $tNGs->displayFieldError("payment_methods", "methods_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="methods_name_EN_<?php echo $cnt1; ?>">Payment methods name(English):</label></td>
            <td><input type="text" name="methods_name_EN_<?php echo $cnt1; ?>" id="methods_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rspayment_methods['methods_name_EN']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("methods_name_EN");?> <?php echo $tNGs->displayFieldError("payment_methods", "methods_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day_update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rspayment_methods['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("payment_methods", "day_update", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rspayment_methods['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("payment_methods", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_payment_methods_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rspayment_methods['kt_pk_payment_methods']); ?>" />
        <?php } while ($row_rspayment_methods = mysql_fetch_assoc($rspayment_methods)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_payment_methods'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_payment_methods')" />
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
