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
$formValidation->addField("svcat_name", true, "text", "", "", "", "Please enter title.");
$formValidation->addField("svcat_name_EN", true, "text", "", "", "", "Please enter title.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("svcat_sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_services_categories = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_services_categories);
// Register triggers
$ins_services_categories->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_services_categories->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_services_categories->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_services_categories");
$ins_services_categories->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_services_categories->setTable("services_categories");
$ins_services_categories->addColumn("svcat_name", "STRING_TYPE", "POST", "svcat_name");
$ins_services_categories->addColumn("svcat_name_EN", "STRING_TYPE", "POST", "svcat_name_EN");
$ins_services_categories->addColumn("svcat_url", "STRING_TYPE", "POST", "svcat_url");
$ins_services_categories->addColumn("svcat_notes", "STRING_TYPE", "POST", "svcat_notes");
$ins_services_categories->addColumn("svcat_notes_EN", "STRING_TYPE", "POST", "svcat_notes_EN");
$ins_services_categories->addColumn("svcat_day_update", "DATE_TYPE", "POST", "svcat_day_update", "{NOW_DT}");
$ins_services_categories->addColumn("svcat_visible", "CHECKBOX_1_0_TYPE", "POST", "svcat_visible", "0");
$ins_services_categories->setPrimaryKey("id_services_categories", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_services_categories = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_services_categories);
// Register triggers
$upd_services_categories->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_services_categories->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_services_categories->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_services_categories");
// Add columns
$upd_services_categories->setTable("services_categories");
$upd_services_categories->addColumn("svcat_name", "STRING_TYPE", "POST", "svcat_name");
$upd_services_categories->addColumn("svcat_name_EN", "STRING_TYPE", "POST", "svcat_name_EN");
$upd_services_categories->addColumn("svcat_url", "STRING_TYPE", "POST", "svcat_url");
$upd_services_categories->addColumn("svcat_notes", "STRING_TYPE", "POST", "svcat_notes");
$upd_services_categories->addColumn("svcat_notes_EN", "STRING_TYPE", "POST", "svcat_notes_EN");
$upd_services_categories->addColumn("svcat_day_update", "DATE_TYPE", "POST", "svcat_day_update");
$upd_services_categories->addColumn("svcat_visible", "CHECKBOX_1_0_TYPE", "POST", "svcat_visible");
$upd_services_categories->setPrimaryKey("id_services_categories", "NUMERIC_TYPE", "GET", "id_services_categories");

// Make an instance of the transaction object
$del_services_categories = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_services_categories);
// Register triggers
$del_services_categories->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_services_categories->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_services_categories");
// Add columns
$del_services_categories->setTable("services_categories");
$del_services_categories->setPrimaryKey("id_services_categories", "NUMERIC_TYPE", "GET", "id_services_categories");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsservices_categories = $tNGs->getRecordset("services_categories");
$row_rsservices_categories = mysql_fetch_assoc($rsservices_categories);
$totalRows_rsservices_categories = mysql_num_rows($rsservices_categories);
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
if (@$_GET['id_services_categories'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Services categories </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsservices_categories > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="svcat_name_<?php echo $cnt1; ?>">Title:</label></td>
            <td><input type="text" name="svcat_name_<?php echo $cnt1; ?>" id="svcat_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices_categories['svcat_name']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("svcat_name");?> <?php echo $tNGs->displayFieldError("services_categories", "svcat_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="svcat_name_EN_<?php echo $cnt1; ?>">Title(English):</label></td>
            <td><input type="text" name="svcat_name_EN_<?php echo $cnt1; ?>" id="svcat_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices_categories['svcat_name_EN']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("svcat_name_EN");?> <?php echo $tNGs->displayFieldError("services_categories", "svcat_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="svcat_url_<?php echo $cnt1; ?>">Url:</label></td>
            <td><input type="text" name="svcat_url_<?php echo $cnt1; ?>" id="svcat_url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices_categories['svcat_url']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("svcat_url");?> <?php echo $tNGs->displayFieldError("services_categories", "svcat_url", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="svcat_notes_<?php echo $cnt1; ?>">Notes:</label></td>
            <td><input type="text" name="svcat_notes_<?php echo $cnt1; ?>" id="svcat_notes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices_categories['svcat_notes']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("svcat_notes");?> <?php echo $tNGs->displayFieldError("services_categories", "svcat_notes", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="svcat_notes_EN_<?php echo $cnt1; ?>">Notes(English):</label></td>
            <td><input type="text" name="svcat_notes_EN_<?php echo $cnt1; ?>" id="svcat_notes_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices_categories['svcat_notes_EN']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("svcat_notes_EN");?> <?php echo $tNGs->displayFieldError("services_categories", "svcat_notes_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="svcat_day_update_<?php echo $cnt1; ?>">Day update:</label></td>
            <td><input type="text" name="svcat_day_update_<?php echo $cnt1; ?>" id="svcat_day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsservices_categories['svcat_day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("svcat_day_update");?> <?php echo $tNGs->displayFieldError("services_categories", "svcat_day_update", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="svcat_visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsservices_categories['svcat_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="svcat_visible_<?php echo $cnt1; ?>" id="svcat_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("services_categories", "svcat_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_services_categories_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsservices_categories['kt_pk_services_categories']); ?>" />
        <?php } while ($row_rsservices_categories = mysql_fetch_assoc($rsservices_categories)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_services_categories'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_services_categories')" />
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
