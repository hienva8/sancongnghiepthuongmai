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
$formValidation->addField("menu_name", true, "text", "", "", "", "Please enter menu name.");
$formValidation->addField("menu_name_EN", true, "text", "", "", "", "Please enter menu name.");
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
$ins_menu = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_menu);
// Register triggers
$ins_menu->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_menu->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_menu->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_menu->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_menu->setTable("menu");
$ins_menu->addColumn("menu_name", "STRING_TYPE", "POST", "menu_name");
$ins_menu->addColumn("menu_name_EN", "STRING_TYPE", "POST", "menu_name_EN");
$ins_menu->addColumn("url", "STRING_TYPE", "POST", "url");
$ins_menu->addColumn("outlink", "STRING_TYPE", "POST", "outlink");
$ins_menu->addColumn("notes", "STRING_TYPE", "POST", "notes");
$ins_menu->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$ins_menu->addColumn("target", "STRING_TYPE", "POST", "target");
$ins_menu->addColumn("position", "STRING_TYPE", "POST", "position");
$ins_menu->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_menu->setPrimaryKey("id_menu", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_menu = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_menu);
// Register triggers
$upd_menu->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_menu->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_menu->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_menu->setTable("menu");
$upd_menu->addColumn("menu_name", "STRING_TYPE", "POST", "menu_name");
$upd_menu->addColumn("menu_name_EN", "STRING_TYPE", "POST", "menu_name_EN");
$upd_menu->addColumn("url", "STRING_TYPE", "POST", "url");
$upd_menu->addColumn("outlink", "STRING_TYPE", "POST", "outlink");
$upd_menu->addColumn("notes", "STRING_TYPE", "POST", "notes");
$upd_menu->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$upd_menu->addColumn("target", "STRING_TYPE", "POST", "target");
$upd_menu->addColumn("position", "STRING_TYPE", "POST", "position");
$upd_menu->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_menu->setPrimaryKey("id_menu", "NUMERIC_TYPE", "GET", "id_menu");

// Make an instance of the transaction object
$del_menu = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_menu);
// Register triggers
$del_menu->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_menu->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_menu->setTable("menu");
$del_menu->setPrimaryKey("id_menu", "NUMERIC_TYPE", "GET", "id_menu");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmenu = $tNGs->getRecordset("menu");
$row_rsmenu = mysql_fetch_assoc($rsmenu);
$totalRows_rsmenu = mysql_num_rows($rsmenu);
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
if (@$_GET['id_menu'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Menu </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsmenu > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="menu_name_<?php echo $cnt1; ?>">Menu name:</label></td>
            <td><input type="text" name="menu_name_<?php echo $cnt1; ?>" id="menu_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmenu['menu_name']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("menu_name");?> <?php echo $tNGs->displayFieldError("menu", "menu_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="menu_name_EN_<?php echo $cnt1; ?>">Menu name(English):</label></td>
            <td><input type="text" name="menu_name_EN_<?php echo $cnt1; ?>" id="menu_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmenu['menu_name_EN']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("menu_name_EN");?> <?php echo $tNGs->displayFieldError("menu", "menu_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="url_<?php echo $cnt1; ?>">Url:</label></td>
            <td><input type="text" name="url_<?php echo $cnt1; ?>" id="url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmenu['url']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("url");?> <?php echo $tNGs->displayFieldError("menu", "url", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="outlink_<?php echo $cnt1; ?>">Outlink:</label></td>
            <td><input type="text" name="outlink_<?php echo $cnt1; ?>" id="outlink_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmenu['outlink']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("outlink");?> <?php echo $tNGs->displayFieldError("menu", "outlink", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_<?php echo $cnt1; ?>">Notes:</label></td>
            <td><input type="text" name="notes_<?php echo $cnt1; ?>" id="notes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmenu['notes']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("notes");?> <?php echo $tNGs->displayFieldError("menu", "notes", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_EN_<?php echo $cnt1; ?>">notes(English):</label></td>
            <td><input type="text" name="notes_EN_<?php echo $cnt1; ?>" id="notes_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsmenu['notes_EN']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("notes_EN");?> <?php echo $tNGs->displayFieldError("menu", "notes_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="target_<?php echo $cnt1; ?>">Target:</label></td>
            <td><select name="target_<?php echo $cnt1; ?>" id="target_<?php echo $cnt1; ?>">
              <option value="_self" <?php if (!(strcmp("_self", KT_escapeAttribute($row_rsmenu['target'])))) {echo "SELECTED";} ?>>self</option>
              <option value="_blank" <?php if (!(strcmp("_blank", KT_escapeAttribute($row_rsmenu['target'])))) {echo "SELECTED";} ?>>blank</option>
            </select>
                <?php echo $tNGs->displayFieldError("menu", "target", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="position_<?php echo $cnt1; ?>">Position:</label></td>
            <td><select name="position_<?php echo $cnt1; ?>" id="position_<?php echo $cnt1; ?>">
              <option value="index_top1" <?php if (!(strcmp("index_top1", KT_escapeAttribute($row_rsmenu['position'])))) {echo "SELECTED";} ?>>index_top1</option>
              <option value="index_top2" <?php if (!(strcmp("index_top2", KT_escapeAttribute($row_rsmenu['position'])))) {echo "SELECTED";} ?>>index_top2</option>
              <option value="" >index_footer</option>
              <option value="admin" <?php if (!(strcmp("admin", KT_escapeAttribute($row_rsmenu['position'])))) {echo "SELECTED";} ?>>admin</option>
            </select>
                <?php echo $tNGs->displayFieldError("menu", "position", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmenu['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("menu", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_menu_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsmenu['kt_pk_menu']); ?>" />
        <?php } while ($row_rsmenu = mysql_fetch_assoc($rsmenu)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_menu'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_menu')" />
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
