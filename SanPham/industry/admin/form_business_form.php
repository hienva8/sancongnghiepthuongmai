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
$formValidation->addField("bf_name", true, "text", "", "", "", "Please enter business form name");
$formValidation->addField("bf_name_EN", true, "text", "", "", "", "Please enter business form name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("business_form");
  $tblFldObj->addFieldName("bf_name");
  $tblFldObj->addFieldName("bf_name_EN");
  $tblFldObj->setErrorMsg("This business form name already exists");
  return $tblFldObj->Execute();
}
//end Trigger_CheckUnique trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("bf_sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_business_form = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_business_form);
// Register triggers
$ins_business_form->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_business_form->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_business_form->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_business_form");
$ins_business_form->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_business_form->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$ins_business_form->setTable("business_form");
$ins_business_form->addColumn("bf_name", "STRING_TYPE", "POST", "bf_name");
$ins_business_form->addColumn("bf_name_EN", "STRING_TYPE", "POST", "bf_name_EN");
$ins_business_form->addColumn("bf_visible", "CHECKBOX_1_0_TYPE", "POST", "bf_visible", "0");
$ins_business_form->setPrimaryKey("id_business_form", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_business_form = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_business_form);
// Register triggers
$upd_business_form->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_business_form->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_business_form->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_business_form");
$upd_business_form->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$upd_business_form->setTable("business_form");
$upd_business_form->addColumn("bf_name", "STRING_TYPE", "POST", "bf_name");
$upd_business_form->addColumn("bf_name_EN", "STRING_TYPE", "POST", "bf_name_EN");
$upd_business_form->addColumn("bf_visible", "CHECKBOX_1_0_TYPE", "POST", "bf_visible");
$upd_business_form->setPrimaryKey("id_business_form", "NUMERIC_TYPE", "GET", "id_business_form");

// Make an instance of the transaction object
$del_business_form = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_business_form);
// Register triggers
$del_business_form->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_business_form->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_business_form");
// Add columns
$del_business_form->setTable("business_form");
$del_business_form->setPrimaryKey("id_business_form", "NUMERIC_TYPE", "GET", "id_business_form");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsbusiness_form = $tNGs->getRecordset("business_form");
$row_rsbusiness_form = mysql_fetch_assoc($rsbusiness_form);
$totalRows_rsbusiness_form = mysql_num_rows($rsbusiness_form);
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
if (@$_GET['id_business_form'] == "") {
?>
      <?php echo NXT_getResource(them); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource(capnhat); ?>
      <?php } 
// endif Conditional region1
?>
    <?php echo hinhthuckinhdoanh;?> </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsbusiness_form > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
                <td class="KT_th"><label for="bf_name_<?php echo $cnt1; ?>"><?php echo tenhinhthuckinhdoanhtiengviet;?> :</label></td>
            <td><input type="text" name="bf_name_<?php echo $cnt1; ?>" id="bf_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsbusiness_form['bf_name']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("bf_name");?> <?php echo $tNGs->displayFieldError("business_form", "bf_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="bf_name_EN_<?php echo $cnt1; ?>"><?php echo tenhinhthuckinhdoanhtienganh;?> :</label></td>
            <td><input type="text" name="bf_name_EN_<?php echo $cnt1; ?>" id="bf_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsbusiness_form['bf_name_EN']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("bf_name_EN");?> <?php echo $tNGs->displayFieldError("business_form", "bf_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="bf_visible_<?php echo $cnt1; ?>"><?php echo anhien;?> :</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsbusiness_form['bf_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="bf_visible_<?php echo $cnt1; ?>" id="bf_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("business_form", "bf_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_business_form_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsbusiness_form['kt_pk_business_form']); ?>" />
        <?php } while ($row_rsbusiness_form = mysql_fetch_assoc($rsbusiness_form)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_business_form'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource(themmoi); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource(copyphienban); ?>" onclick="nxt_form_insertasnew(this, 'id_business_form')" />
            </div>
            <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource(capnhat); ?>" />
            <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource(xoa); ?>" onclick="return confirm('<?php echo NXT_getResource(dongyxoa); ?>');" />
            <?php }
      // endif Conditional region1
      ?>
          <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource(huybo); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
        </div>
      </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
