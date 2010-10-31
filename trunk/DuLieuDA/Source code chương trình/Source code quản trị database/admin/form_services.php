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

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/services/{SESSION.kt_login_id}/");
  $deleteObj->setDbFieldName("image_illustrate");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("image_illustrate");
  $uploadObj->setDbFieldName("image_illustrate");
  $uploadObj->setFolder("../uploads/services/{SESSION.kt_login_id}/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, gif, bmp");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_services = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_services);
// Register triggers
$ins_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_services->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_services");
$ins_services->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_services->setTable("services");
$ins_services->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_services->addColumn("title_EN", "STRING_TYPE", "POST", "title_EN");
$ins_services->addColumn("image_illustrate", "FILE_TYPE", "FILES", "image_illustrate");
$ins_services->addColumn("short_describe", "STRING_TYPE", "POST", "short_describe");
$ins_services->addColumn("short_describe_EN", "STRING_TYPE", "POST", "short_describe_EN");
$ins_services->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_services->addColumn("content_EN", "STRING_TYPE", "POST", "content_EN");
$ins_services->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member", "{SESSION.kt_login_id}");
$ins_services->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_services->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_services->setPrimaryKey("id_services", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_services = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_services);
// Register triggers
$upd_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_services->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_services");
$upd_services->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_services->setTable("services");
$upd_services->addColumn("title", "STRING_TYPE", "POST", "title");
$upd_services->addColumn("title_EN", "STRING_TYPE", "POST", "title_EN");
$upd_services->addColumn("image_illustrate", "FILE_TYPE", "FILES", "image_illustrate");
$upd_services->addColumn("short_describe", "STRING_TYPE", "POST", "short_describe");
$upd_services->addColumn("short_describe_EN", "STRING_TYPE", "POST", "short_describe_EN");
$upd_services->addColumn("content", "STRING_TYPE", "POST", "content");
$upd_services->addColumn("content_EN", "STRING_TYPE", "POST", "content_EN");
$upd_services->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member");
$upd_services->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_services->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_services->setPrimaryKey("id_services", "NUMERIC_TYPE", "GET", "id_services");

// Make an instance of the transaction object
$del_services = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_services);
// Register triggers
$del_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_services");
$del_services->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_services->setTable("services");
$del_services->setPrimaryKey("id_services", "NUMERIC_TYPE", "GET", "id_services");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsservices = $tNGs->getRecordset("services");
$row_rsservices = mysql_fetch_assoc($rsservices);
$totalRows_rsservices = mysql_num_rows($rsservices);
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
if (@$_GET['id_services'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Services </h1>
  <div class="KT_tngform">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" enctype="multipart/form-data" id="form1">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsservices > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="title_<?php echo $cnt1; ?>">Title:</label></td>
            <td><input type="text" name="title_<?php echo $cnt1; ?>" id="title_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['title']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("services", "title", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="title_EN_<?php echo $cnt1; ?>">Titile(English)</label></td>
            <td><input type="text" name="title_EN_<?php echo $cnt1; ?>" id="title_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['title_EN']); ?>" size="32" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("title_EN");?> <?php echo $tNGs->displayFieldError("services", "title_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="image_illustrate_<?php echo $cnt1; ?>">Image illustrate:</label></td>
            <td><input type="file" name="image_illustrate_<?php echo $cnt1; ?>" id="image_illustrate_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("services", "image_illustrate", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="short_describe_<?php echo $cnt1; ?>">Short describe:</label></td>
            <td><textarea name="short_describe_<?php echo $cnt1; ?>" id="short_describe_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsservices['short_describe']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("short_describe");?> <?php echo $tNGs->displayFieldError("services", "short_describe", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="short_describe_EN_<?php echo $cnt1; ?>">short describe(English):</label></td>
            <td><textarea name="short_describe_EN_<?php echo $cnt1; ?>" id="short_describe_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsservices['short_describe_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("short_describe_EN");?> <?php echo $tNGs->displayFieldError("services", "short_describe_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="content_<?php echo $cnt1; ?>">Content:</label></td>
            <td><textarea name="content_<?php echo $cnt1; ?>" id="content_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsservices['content']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("services", "content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="content_EN_<?php echo $cnt1; ?>">content(English):</label></td>
            <td><textarea name="content_EN_<?php echo $cnt1; ?>" id="content_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsservices['content_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("content_EN");?> <?php echo $tNGs->displayFieldError("services", "content_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day_update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsservices['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("services", "day_update", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsservices['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("services", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_services_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsservices['kt_pk_services']); ?>" />
        <input type="hidden" name="id_member_<?php echo $cnt1; ?>" id="id_member_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['id_member']); ?>" />
        <?php } while ($row_rsservices = mysql_fetch_assoc($rsservices)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_services'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_services')" />
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
