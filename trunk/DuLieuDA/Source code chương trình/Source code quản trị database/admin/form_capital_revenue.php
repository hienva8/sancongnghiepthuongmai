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
$ins_capital_revenue = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_capital_revenue);
// Register triggers
$ins_capital_revenue->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_capital_revenue->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_capital_revenue->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_capital_revenue->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_capital_revenue->setTable("capital_revenue");
$ins_capital_revenue->addColumn("cr_content", "STRING_TYPE", "POST", "cr_content");
$ins_capital_revenue->addColumn("cr_content_EN", "STRING_TYPE", "POST", "cr_content_EN");
$ins_capital_revenue->setPrimaryKey("id_capital_revenue", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_capital_revenue = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_capital_revenue);
// Register triggers
$upd_capital_revenue->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_capital_revenue->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_capital_revenue->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_capital_revenue->setTable("capital_revenue");
$upd_capital_revenue->addColumn("cr_content", "STRING_TYPE", "POST", "cr_content");
$upd_capital_revenue->addColumn("cr_content_EN", "STRING_TYPE", "POST", "cr_content_EN");
$upd_capital_revenue->setPrimaryKey("id_capital_revenue", "NUMERIC_TYPE", "GET", "id_capital_revenue");

// Make an instance of the transaction object
$del_capital_revenue = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_capital_revenue);
// Register triggers
$del_capital_revenue->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_capital_revenue->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_capital_revenue->setTable("capital_revenue");
$del_capital_revenue->setPrimaryKey("id_capital_revenue", "NUMERIC_TYPE", "GET", "id_capital_revenue");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscapital_revenue = $tNGs->getRecordset("capital_revenue");
$row_rscapital_revenue = mysql_fetch_assoc($rscapital_revenue);
$totalRows_rscapital_revenue = mysql_num_rows($rscapital_revenue);
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
if (@$_GET['id_capital_revenue'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Capital_revenue </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rscapital_revenue > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="cr_content_<?php echo $cnt1; ?>">Content:</label></td>
            <td><input type="text" name="cr_content_<?php echo $cnt1; ?>" id="cr_content_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscapital_revenue['cr_content']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("cr_content");?> <?php echo $tNGs->displayFieldError("capital_revenue", "cr_content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="cr_content_EN_<?php echo $cnt1; ?>">Content(English):</label></td>
            <td><input type="text" name="cr_content_EN_<?php echo $cnt1; ?>" id="cr_content_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscapital_revenue['cr_content_EN']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("cr_content_EN");?> <?php echo $tNGs->displayFieldError("capital_revenue", "cr_content_EN", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_capital_revenue_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscapital_revenue['kt_pk_capital_revenue']); ?>" />
        <?php } while ($row_rscapital_revenue = mysql_fetch_assoc($rscapital_revenue)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_capital_revenue'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_capital_revenue')" />
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
