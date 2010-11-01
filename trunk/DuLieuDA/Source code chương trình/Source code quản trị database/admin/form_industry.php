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
$formValidation->addField("industry_name", true, "text", "", "", "", "Please enter a industry name.");
$formValidation->addField("industry_name_EN", true, "text", "", "", "", "Please enter a industry name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("industry");
  $tblFldObj->addFieldName("industry_name");
  $tblFldObj->addFieldName("industry_name_EN");
  $tblFldObj->setErrorMsg("Industry name already exists.");
  return $tblFldObj->Execute();
}
//end Trigger_CheckUnique trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_industry = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_industry);
// Register triggers
$ins_industry->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_industry->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_industry->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_industry->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_industry->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$ins_industry->setTable("industry");
$ins_industry->addColumn("industry_name", "STRING_TYPE", "POST", "industry_name");
$ins_industry->addColumn("industry_name_EN", "STRING_TYPE", "POST", "industry_name_EN");
$ins_industry->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_industry->setPrimaryKey("id_industry", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_industry = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_industry);
// Register triggers
$upd_industry->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_industry->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_industry->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_industry->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$upd_industry->setTable("industry");
$upd_industry->addColumn("industry_name", "STRING_TYPE", "POST", "industry_name");
$upd_industry->addColumn("industry_name_EN", "STRING_TYPE", "POST", "industry_name_EN");
$upd_industry->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_industry->setPrimaryKey("id_industry", "NUMERIC_TYPE", "GET", "id_industry");

// Make an instance of the transaction object
$del_industry = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_industry);
// Register triggers
$del_industry->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_industry->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_industry->setTable("industry");
$del_industry->setPrimaryKey("id_industry", "NUMERIC_TYPE", "GET", "id_industry");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsindustry = $tNGs->getRecordset("industry");
$row_rsindustry = mysql_fetch_assoc($rsindustry);
$totalRows_rsindustry = mysql_num_rows($rsindustry);
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
if (@$_GET['id_industry'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Industry </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsindustry > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="industry_name_<?php echo $cnt1; ?>">Industry name:</label></td>
            <td><input type="text" name="industry_name_<?php echo $cnt1; ?>" id="industry_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsindustry['industry_name']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("industry_name");?> <?php echo $tNGs->displayFieldError("industry", "industry_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="industry_name_EN_<?php echo $cnt1; ?>">Industry name(English):</label></td>
            <td><input type="text" name="industry_name_EN_<?php echo $cnt1; ?>" id="industry_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsindustry['industry_name_EN']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("industry_name_EN");?> <?php echo $tNGs->displayFieldError("industry", "industry_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsindustry['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("industry", "day_update", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_industry_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsindustry['kt_pk_industry']); ?>" />
        <?php } while ($row_rsindustry = mysql_fetch_assoc($rsindustry)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_industry'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_industry')" />
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
