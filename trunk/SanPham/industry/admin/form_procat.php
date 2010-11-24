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
$formValidation->addField("procat_name", true, "text", "", "", "", "Please enter a catalogue name.");
$formValidation->addField("procat_name_EN", true, "text", "", "", "", "Please enter a catalogue name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("procat");
  $tblFldObj->addFieldName("procat_name");
  $tblFldObj->addFieldName("procat_name_EN");
  $tblFldObj->setErrorMsg("This catalogue name already exists.");
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
$ins_procat = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_procat);
// Register triggers
$ins_procat->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_procat->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_procat->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_procat");
$ins_procat->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_procat->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$ins_procat->setTable("procat");
$ins_procat->addColumn("procat_name", "STRING_TYPE", "POST", "procat_name");
$ins_procat->addColumn("procat_name_EN", "STRING_TYPE", "POST", "procat_name_EN");
$ins_procat->addColumn("url", "STRING_TYPE", "POST", "url");
$ins_procat->addColumn("notes", "STRING_TYPE", "POST", "notes");
$ins_procat->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$ins_procat->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_procat->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_procat->setPrimaryKey("id_procat", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_procat = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_procat);
// Register triggers
$upd_procat->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_procat->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_procat->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_procat");
$upd_procat->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$upd_procat->setTable("procat");
$upd_procat->addColumn("procat_name", "STRING_TYPE", "POST", "procat_name");
$upd_procat->addColumn("procat_name_EN", "STRING_TYPE", "POST", "procat_name_EN");
$upd_procat->addColumn("url", "STRING_TYPE", "POST", "url");
$upd_procat->addColumn("notes", "STRING_TYPE", "POST", "notes");
$upd_procat->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$upd_procat->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_procat->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_procat->setPrimaryKey("id_procat", "NUMERIC_TYPE", "GET", "id_procat");

// Make an instance of the transaction object
$del_procat = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_procat);
// Register triggers
$del_procat->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_procat->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_procat");
// Add columns
$del_procat->setTable("procat");
$del_procat->setPrimaryKey("id_procat", "NUMERIC_TYPE", "GET", "id_procat");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsprocat = $tNGs->getRecordset("procat");
$row_rsprocat = mysql_fetch_assoc($rsprocat);
$totalRows_rsprocat = mysql_num_rows($rsprocat);
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
if (@$_GET['id_procat'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Procat </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsprocat > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="procat_name_<?php echo $cnt1; ?>">Catalogue name:</label></td>
            <td><input type="text" name="procat_name_<?php echo $cnt1; ?>" id="procat_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprocat['procat_name']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("procat_name");?> <?php echo $tNGs->displayFieldError("procat", "procat_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="procat_name_EN_<?php echo $cnt1; ?>">Catalogue name(English):</label></td>
            <td><input type="text" name="procat_name_EN_<?php echo $cnt1; ?>" id="procat_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprocat['procat_name_EN']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("procat_name_EN");?> <?php echo $tNGs->displayFieldError("procat", "procat_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="url_<?php echo $cnt1; ?>">Url:</label></td>
            <td><input type="text" name="url_<?php echo $cnt1; ?>" id="url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprocat['url']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("url");?> <?php echo $tNGs->displayFieldError("procat", "url", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_<?php echo $cnt1; ?>">Notes:</label></td>
            <td><input type="text" name="notes_<?php echo $cnt1; ?>" id="notes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprocat['notes']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("notes");?> <?php echo $tNGs->displayFieldError("procat", "notes", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_EN_<?php echo $cnt1; ?>">Notes(English):</label></td>
            <td><input type="text" name="notes_EN_<?php echo $cnt1; ?>" id="notes_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprocat['notes_EN']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("notes_EN");?> <?php echo $tNGs->displayFieldError("procat", "notes_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsprocat['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("procat", "day_update", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsprocat['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("procat", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_procat_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsprocat['kt_pk_procat']); ?>" />
        <?php } while ($row_rsprocat = mysql_fetch_assoc($rsprocat)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_procat'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_procat')" />
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
