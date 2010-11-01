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
$formValidation->addField("rates_content", true, "text", "", "", "", "Please enter rates content.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("rates_sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_rates = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_rates);
// Register triggers
$ins_rates->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_rates->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_rates->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_rates");
$ins_rates->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_rates->setTable("rates");
$ins_rates->addColumn("rates_content", "STRING_TYPE", "POST", "rates_content");
$ins_rates->setPrimaryKey("id_rates", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_rates = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_rates);
// Register triggers
$upd_rates->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_rates->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_rates->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_rates");
// Add columns
$upd_rates->setTable("rates");
$upd_rates->addColumn("rates_content", "STRING_TYPE", "POST", "rates_content");
$upd_rates->setPrimaryKey("id_rates", "NUMERIC_TYPE", "GET", "id_rates");

// Make an instance of the transaction object
$del_rates = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_rates);
// Register triggers
$del_rates->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_rates->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_rates");
// Add columns
$del_rates->setTable("rates");
$del_rates->setPrimaryKey("id_rates", "NUMERIC_TYPE", "GET", "id_rates");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsrates = $tNGs->getRecordset("rates");
$row_rsrates = mysql_fetch_assoc($rsrates);
$totalRows_rsrates = mysql_num_rows($rsrates);
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
if (@$_GET['id_rates'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Rates </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsrates > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="rates_content_<?php echo $cnt1; ?>">Rates_content:</label></td>
            <td><input type="text" name="rates_content_<?php echo $cnt1; ?>" id="rates_content_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsrates['rates_content']); ?>" size="10" maxlength="10" />
                <?php echo $tNGs->displayFieldHint("rates_content");?> <?php echo $tNGs->displayFieldError("rates", "rates_content", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_rates_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsrates['kt_pk_rates']); ?>" />
        <?php } while ($row_rsrates = mysql_fetch_assoc($rsrates)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_rates'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_rates')" />
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
