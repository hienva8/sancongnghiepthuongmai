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
$formValidation->addField("country_name", true, "text", "", "", "", "Please enter a country name.");
$formValidation->addField("country_name_EN", true, "text", "", "", "", "Please enter a country name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("country");
  $tblFldObj->addFieldName("country_name");
  $tblFldObj->addFieldName("country_name_EN");
  $tblFldObj->setErrorMsg("Country name already exists");
  return $tblFldObj->Execute();
}
//end Trigger_CheckUnique trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/country_flag/");
  $deleteObj->setDbFieldName("country_image_illustrate");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("country_image_illustrate");
  $uploadObj->setDbFieldName("country_image_illustrate");
  $uploadObj->setFolder("../uploads/country_flag/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, gif, bmp");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_country = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_country);
// Register triggers
$ins_country->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_country->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_country->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_country");
$ins_country->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_country->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
$ins_country->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_country->setTable("country");
$ins_country->addColumn("country_name", "STRING_TYPE", "POST", "country_name");
$ins_country->addColumn("country_name_EN", "STRING_TYPE", "POST", "country_name_EN");
$ins_country->addColumn("country_image_illustrate", "FILE_TYPE", "FILES", "country_image_illustrate");
$ins_country->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_country->setPrimaryKey("id_country", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_country = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_country);
// Register triggers
$upd_country->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_country->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_country->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_country");
$upd_country->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
$upd_country->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_country->setTable("country");
$upd_country->addColumn("country_name", "STRING_TYPE", "POST", "country_name");
$upd_country->addColumn("country_name_EN", "STRING_TYPE", "POST", "country_name_EN");
$upd_country->addColumn("country_image_illustrate", "FILE_TYPE", "FILES", "country_image_illustrate");
$upd_country->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_country->setPrimaryKey("id_country", "NUMERIC_TYPE", "GET", "id_country");

// Make an instance of the transaction object
$del_country = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_country);
// Register triggers
$del_country->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_country->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_country");
$del_country->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_country->setTable("country");
$del_country->setPrimaryKey("id_country", "NUMERIC_TYPE", "GET", "id_country");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscountry = $tNGs->getRecordset("country");
$row_rscountry = mysql_fetch_assoc($rscountry);
$totalRows_rscountry = mysql_num_rows($rscountry);
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
if (@$_GET['id_country'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Country </h1>
  <div class="KT_tngform">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" enctype="multipart/form-data" id="form1">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rscountry > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="country_name_<?php echo $cnt1; ?>">Country name:</label></td>
            <td><input type="text" name="country_name_<?php echo $cnt1; ?>" id="country_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscountry['country_name']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("country_name");?> <?php echo $tNGs->displayFieldError("country", "country_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="country_name_EN_<?php echo $cnt1; ?>">Country name(English):</label></td>
            <td><input type="text" name="country_name_EN_<?php echo $cnt1; ?>" id="country_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscountry['country_name_EN']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("country_name_EN");?> <?php echo $tNGs->displayFieldError("country", "country_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="country_image_illustrate_<?php echo $cnt1; ?>">image illustrate:</label></td>
            <td><input type="file" name="country_image_illustrate_<?php echo $cnt1; ?>" id="country_image_illustrate_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("country", "country_image_illustrate", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rscountry['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("country", "day_update", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_country_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscountry['kt_pk_country']); ?>" />
        <?php } while ($row_rscountry = mysql_fetch_assoc($rscountry)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_country'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_country')" />
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
<?php
	echo $tNGs->getErrorMsg();
?></body>
</html>
