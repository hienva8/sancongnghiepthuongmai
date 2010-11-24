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

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("contact_department");
  $tblFldObj->addFieldName("name");
  $tblFldObj->addFieldName("name_EN");
  $tblFldObj->setErrorMsg("This department name already exists.");
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
$ins_contact_department = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_contact_department);
// Register triggers
$ins_contact_department->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_contact_department->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_contact_department->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_contact_department->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_contact_department->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$ins_contact_department->setTable("contact_department");
$ins_contact_department->addColumn("name", "STRING_TYPE", "POST", "name");
$ins_contact_department->addColumn("name_EN", "STRING_TYPE", "POST", "name_EN");
$ins_contact_department->addColumn("type", "STRING_TYPE", "POST", "type");
$ins_contact_department->addColumn("day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_contact_department->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "1");
$ins_contact_department->setPrimaryKey("id_contact_department", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_contact_department = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_contact_department);
// Register triggers
$upd_contact_department->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_contact_department->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_contact_department->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_contact_department->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$upd_contact_department->setTable("contact_department");
$upd_contact_department->addColumn("name", "STRING_TYPE", "POST", "name");
$upd_contact_department->addColumn("name_EN", "STRING_TYPE", "POST", "name_EN");
$upd_contact_department->addColumn("type", "STRING_TYPE", "POST", "type");
$upd_contact_department->addColumn("day_update", "DATE_TYPE", "CURRVAL", "");
$upd_contact_department->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_contact_department->setPrimaryKey("id_contact_department", "NUMERIC_TYPE", "GET", "id_contact_department");

// Make an instance of the transaction object
$del_contact_department = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_contact_department);
// Register triggers
$del_contact_department->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_contact_department->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_contact_department->setTable("contact_department");
$del_contact_department->setPrimaryKey("id_contact_department", "NUMERIC_TYPE", "GET", "id_contact_department");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscontact_department = $tNGs->getRecordset("contact_department");
$row_rscontact_department = mysql_fetch_assoc($rscontact_department);
$totalRows_rscontact_department = mysql_num_rows($rscontact_department);
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
<?php
	echo $tNGs->getErrorMsg();
?>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_contact_department'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    <?php echo bophanlienhe;?></h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rscontact_department > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="name_<?php echo $cnt1; ?>"><?php echo tenbophanlienhe;?>:</label></td>
            <td><input type="text" name="name_<?php echo $cnt1; ?>" id="name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_department['name']); ?>" size="50" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("name");?> <?php echo $tNGs->displayFieldError("contact_department", "name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="name_EN_<?php echo $cnt1; ?>"><?php echo tenbophanlienhetienganh;?>:</label></td>
            <td><input type="text" name="name_EN_<?php echo $cnt1; ?>" id="name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact_department['name_EN']); ?>" size="50" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("name_EN");?> <?php echo $tNGs->displayFieldError("contact_department", "name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="type_<?php echo $cnt1; ?>"><?php echo loaibophanlienhe;?>:</label></td>
            <td><select name="type_<?php echo $cnt1; ?>" id="type_<?php echo $cnt1; ?>">
              <option value="admin" <?php if (!(strcmp("admin", KT_escapeAttribute($row_rscontact_department['type'])))) {echo "SELECTED";} ?>>admin</option>
              <option value="member" <?php if (!(strcmp("member", KT_escapeAttribute($row_rscontact_department['type'])))) {echo "SELECTED";} ?>>member</option>
            </select>
                <?php echo $tNGs->displayFieldError("contact_department", "type", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><?php echo ngaycapnhat;?>:</td>
            <td><?php echo KT_formatDate($row_rscontact_department['day_update']); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>"><?php echo anhien;?>:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rscontact_department['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("contact_department", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_contact_department_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscontact_department['kt_pk_contact_department']); ?>" />
        <?php } while ($row_rscontact_department = mysql_fetch_assoc($rscontact_department)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_contact_department'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_contact_department')" />
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
