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
$formValidation->addField("title", true, "text", "", "", "", "Please enter title content.");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$ins_footer = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_footer);
// Register triggers
$ins_footer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_footer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_footer->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_footer");
// Add columns
$ins_footer->setTable("footer");
$ins_footer->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_footer->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_footer->addColumn("content_EN", "STRING_TYPE", "POST", "content_EN");
$ins_footer->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_footer->setPrimaryKey("id_footer", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_footer = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_footer);
// Register triggers
$upd_footer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_footer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_footer->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_footer");
// Add columns
$upd_footer->setTable("footer");
$upd_footer->addColumn("title", "STRING_TYPE", "POST", "title");
$upd_footer->addColumn("content", "STRING_TYPE", "POST", "content");
$upd_footer->addColumn("content_EN", "STRING_TYPE", "POST", "content_EN");
$upd_footer->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_footer->setPrimaryKey("id_footer", "NUMERIC_TYPE", "GET", "id_footer");

// Make an instance of the transaction object
$del_footer = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_footer);
// Register triggers
$del_footer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_footer->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_footer");
// Add columns
$del_footer->setTable("footer");
$del_footer->setPrimaryKey("id_footer", "NUMERIC_TYPE", "GET", "id_footer");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsfooter = $tNGs->getRecordset("footer");
$row_rsfooter = mysql_fetch_assoc($rsfooter);
$totalRows_rsfooter = mysql_num_rows($rsfooter);
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
if (@$_GET['id_footer'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Content footer</h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsfooter > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="title_<?php echo $cnt1; ?>">Title:</label></td>
            <td><input type="text" name="title_<?php echo $cnt1; ?>" id="title_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsfooter['title']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("footer", "title", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="content_<?php echo $cnt1; ?>">Content:</label></td>
            <td><textarea name="content_<?php echo $cnt1; ?>" id="content_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsfooter['content']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("footer", "content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="content_EN_<?php echo $cnt1; ?>">content(English):</label></td>
            <td><textarea name="content_EN_<?php echo $cnt1; ?>" id="content_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsfooter['content_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("content_EN");?> <?php echo $tNGs->displayFieldError("footer", "content_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsfooter['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("footer", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_footer_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsfooter['kt_pk_footer']); ?>" />
        <?php } while ($row_rsfooter = mysql_fetch_assoc($rsfooter)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_footer'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_footer')" />
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
