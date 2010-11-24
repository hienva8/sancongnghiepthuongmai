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
$formValidation->addField("main_market_name", true, "text", "", "", "", "Please enter main market name.");
$formValidation->addField("main_market_name_EN", true, "text", "", "", "", "Please enter main market name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("main_market_sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_main_markets = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_main_markets);
// Register triggers
$ins_main_markets->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_main_markets->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_main_markets->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_main_markets");
$ins_main_markets->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_main_markets->setTable("main_markets");
$ins_main_markets->addColumn("main_market_name", "STRING_TYPE", "POST", "main_market_name");
$ins_main_markets->addColumn("main_market_name_EN", "STRING_TYPE", "POST", "main_market_name_EN");
$ins_main_markets->setPrimaryKey("id_main_markets", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_main_markets = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_main_markets);
// Register triggers
$upd_main_markets->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_main_markets->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_main_markets->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_main_markets");
// Add columns
$upd_main_markets->setTable("main_markets");
$upd_main_markets->addColumn("main_market_name", "STRING_TYPE", "POST", "main_market_name");
$upd_main_markets->addColumn("main_market_name_EN", "STRING_TYPE", "POST", "main_market_name_EN");
$upd_main_markets->setPrimaryKey("id_main_markets", "NUMERIC_TYPE", "GET", "id_main_markets");

// Make an instance of the transaction object
$del_main_markets = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_main_markets);
// Register triggers
$del_main_markets->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_main_markets->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_main_markets");
// Add columns
$del_main_markets->setTable("main_markets");
$del_main_markets->setPrimaryKey("id_main_markets", "NUMERIC_TYPE", "GET", "id_main_markets");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmain_markets = $tNGs->getRecordset("main_markets");
$row_rsmain_markets = mysql_fetch_assoc($rsmain_markets);
$totalRows_rsmain_markets = mysql_num_rows($rsmain_markets);
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
if (@$_GET['id_main_markets'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Main markets </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsmain_markets > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="main_market_name_<?php echo $cnt1; ?>">Market name:</label></td>
            <td><input type="text" name="main_market_name_<?php echo $cnt1; ?>" id="main_market_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmain_markets['main_market_name']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("main_market_name");?> <?php echo $tNGs->displayFieldError("main_markets", "main_market_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="main_market_name_EN_<?php echo $cnt1; ?>">Market name(English):</label></td>
            <td><input type="text" name="main_market_name_EN_<?php echo $cnt1; ?>" id="main_market_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmain_markets['main_market_name_EN']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("main_market_name_EN");?> <?php echo $tNGs->displayFieldError("main_markets", "main_market_name_EN", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_main_markets_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsmain_markets['kt_pk_main_markets']); ?>" />
        <?php } while ($row_rsmain_markets = mysql_fetch_assoc($rsmain_markets)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_main_markets'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_main_markets')" />
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
