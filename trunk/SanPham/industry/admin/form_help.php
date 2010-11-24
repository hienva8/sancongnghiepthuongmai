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
$formValidation->addField("title", true, "text", "", "", "", "Please enter title.");
$formValidation->addField("title_EN", true, "text", "", "", "", "Please enter title.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("help");
  $tblFldObj->addFieldName("title");
  $tblFldObj->addFieldName("title_EN");
  $tblFldObj->setErrorMsg("This title already exists.");
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
$ins_help = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_help);
// Register triggers
$ins_help->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_help->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_help->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_help");
$ins_help->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_help->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$ins_help->setTable("help");
$ins_help->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_help->addColumn("title_EN", "STRING_TYPE", "POST", "title_EN");
$ins_help->addColumn("short_describe", "STRING_TYPE", "POST", "short_describe");
$ins_help->addColumn("short_describe_EN", "STRING_TYPE", "POST", "short_describe_EN");
$ins_help->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_help->addColumn("content_EN", "STRING_TYPE", "POST", "content_EN");
$ins_help->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_help->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_help->setPrimaryKey("id_help", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_help = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_help);
// Register triggers
$upd_help->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_help->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_help->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_help");
$upd_help->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$upd_help->setTable("help");
$upd_help->addColumn("title", "STRING_TYPE", "POST", "title");
$upd_help->addColumn("title_EN", "STRING_TYPE", "POST", "title_EN");
$upd_help->addColumn("short_describe", "STRING_TYPE", "POST", "short_describe");
$upd_help->addColumn("short_describe_EN", "STRING_TYPE", "POST", "short_describe_EN");
$upd_help->addColumn("content", "STRING_TYPE", "POST", "content");
$upd_help->addColumn("content_EN", "STRING_TYPE", "POST", "content_EN");
$upd_help->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_help->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_help->setPrimaryKey("id_help", "NUMERIC_TYPE", "GET", "id_help");

// Make an instance of the transaction object
$del_help = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_help);
// Register triggers
$del_help->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_help->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_help");
// Add columns
$del_help->setTable("help");
$del_help->setPrimaryKey("id_help", "NUMERIC_TYPE", "GET", "id_help");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rshelp = $tNGs->getRecordset("help");
$row_rshelp = mysql_fetch_assoc($rshelp);
$totalRows_rshelp = mysql_num_rows($rshelp);
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
if (@$_GET['id_help'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Help </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rshelp > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="title_<?php echo $cnt1; ?>">Title:</label></td>
            <td><input type="text" name="title_<?php echo $cnt1; ?>" id="title_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshelp['title']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("help", "title", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="title_EN_<?php echo $cnt1; ?>">Title(English):</label></td>
            <td><input type="text" name="title_EN_<?php echo $cnt1; ?>" id="title_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshelp['title_EN']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("title_EN");?> <?php echo $tNGs->displayFieldError("help", "title_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="short_describe_<?php echo $cnt1; ?>">Short describe:</label></td>
            <td><textarea name="short_describe_<?php echo $cnt1; ?>" id="short_describe_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rshelp['short_describe']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("short_describe");?> <?php echo $tNGs->displayFieldError("help", "short_describe", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="short_describe_EN_<?php echo $cnt1; ?>">Short describe(English):</label></td>
            <td><textarea name="short_describe_EN_<?php echo $cnt1; ?>" id="short_describe_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rshelp['short_describe_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("short_describe_EN");?> <?php echo $tNGs->displayFieldError("help", "short_describe_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="content_<?php echo $cnt1; ?>">Content:</label></td>
            <td><textarea name="content_<?php echo $cnt1; ?>" id="content_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rshelp['content']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("help", "content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="content_EN_<?php echo $cnt1; ?>">Content(English):</label></td>
            <td><textarea name="content_EN_<?php echo $cnt1; ?>" id="content_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rshelp['content_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("content_EN");?> <?php echo $tNGs->displayFieldError("help", "content_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rshelp['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("help", "day_update", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rshelp['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("help", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_help_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rshelp['kt_pk_help']); ?>" />
        <?php } while ($row_rshelp = mysql_fetch_assoc($rshelp)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_help'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_help')" />
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
