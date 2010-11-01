<?php require_once('../Connections/ketnoi.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

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
$formValidation->addField("prosubcat2_name", true, "text", "", "", "", "Please enter a sub catalogue name.");
$formValidation->addField("prosubcat2_name_EN", true, "text", "", "", "", "Please enter a sub catalogue name.");
$formValidation->addField("id_procat", true, "numeric", "", "", "", "Please choose a catalogue name.");
$formValidation->addField("id_prosubcat1", true, "numeric", "", "", "", "Please choose a sub catalogue name.");
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

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_procat = "SELECT id_procat, procat_name FROM procat ORDER BY sort ASC";
$rs_procat = mysql_query($query_rs_procat, $ketnoi) or die(mysql_error());
$row_rs_procat = mysql_fetch_assoc($rs_procat);
$totalRows_rs_procat = mysql_num_rows($rs_procat);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat1 = "SELECT id_prosubcat1, id_procat, prosubcat1_name FROM prosubcat1 ORDER BY sort ASC";
$rs_prosubcat1 = mysql_query($query_rs_prosubcat1, $ketnoi) or die(mysql_error());
$row_rs_prosubcat1 = mysql_fetch_assoc($rs_prosubcat1);
$totalRows_rs_prosubcat1 = mysql_num_rows($rs_prosubcat1);

// Make an insert transaction instance
$ins_prosubcat2 = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_prosubcat2);
// Register triggers
$ins_prosubcat2->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_prosubcat2->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_prosubcat2->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_prosubcat2");
$ins_prosubcat2->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_prosubcat2->setTable("prosubcat2");
$ins_prosubcat2->addColumn("prosubcat2_name", "STRING_TYPE", "POST", "prosubcat2_name");
$ins_prosubcat2->addColumn("prosubcat2_name_EN", "STRING_TYPE", "POST", "prosubcat2_name_EN");
$ins_prosubcat2->addColumn("url", "STRING_TYPE", "POST", "url");
$ins_prosubcat2->addColumn("notes", "STRING_TYPE", "POST", "notes");
$ins_prosubcat2->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$ins_prosubcat2->addColumn("id_procat", "NUMERIC_TYPE", "POST", "id_procat");
$ins_prosubcat2->addColumn("id_prosubcat1", "NUMERIC_TYPE", "POST", "id_prosubcat1");
$ins_prosubcat2->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_prosubcat2->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_prosubcat2->setPrimaryKey("id_prosubcat2", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_prosubcat2 = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_prosubcat2);
// Register triggers
$upd_prosubcat2->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_prosubcat2->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_prosubcat2->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_prosubcat2");
// Add columns
$upd_prosubcat2->setTable("prosubcat2");
$upd_prosubcat2->addColumn("prosubcat2_name", "STRING_TYPE", "POST", "prosubcat2_name");
$upd_prosubcat2->addColumn("prosubcat2_name_EN", "STRING_TYPE", "POST", "prosubcat2_name_EN");
$upd_prosubcat2->addColumn("url", "STRING_TYPE", "POST", "url");
$upd_prosubcat2->addColumn("notes", "STRING_TYPE", "POST", "notes");
$upd_prosubcat2->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$upd_prosubcat2->addColumn("id_procat", "NUMERIC_TYPE", "POST", "id_procat");
$upd_prosubcat2->addColumn("id_prosubcat1", "NUMERIC_TYPE", "POST", "id_prosubcat1");
$upd_prosubcat2->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_prosubcat2->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_prosubcat2->setPrimaryKey("id_prosubcat2", "NUMERIC_TYPE", "GET", "id_prosubcat2");

// Make an instance of the transaction object
$del_prosubcat2 = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_prosubcat2);
// Register triggers
$del_prosubcat2->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_prosubcat2->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_prosubcat2");
// Add columns
$del_prosubcat2->setTable("prosubcat2");
$del_prosubcat2->setPrimaryKey("id_prosubcat2", "NUMERIC_TYPE", "GET", "id_prosubcat2");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsprosubcat2 = $tNGs->getRecordset("prosubcat2");
$row_rsprosubcat2 = mysql_fetch_assoc($rsprosubcat2);
$totalRows_rsprosubcat2 = mysql_num_rows($rsprosubcat2);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
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
<script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/JSRecordset.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/DependentDropdown.js"></script>
<?php
//begin JSRecordset
$jsObject_rs_prosubcat1 = new WDG_JsRecordset("rs_prosubcat1");
echo $jsObject_rs_prosubcat1->getOutput();
//end JSRecordset
?>
</head>

<body>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_prosubcat2'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Sub catalogue2</h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsprosubcat2 > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="prosubcat2_name_<?php echo $cnt1; ?>">Sub catalogue2:</label></td>
            <td><input type="text" name="prosubcat2_name_<?php echo $cnt1; ?>" id="prosubcat2_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat2['prosubcat2_name']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("prosubcat2_name");?> <?php echo $tNGs->displayFieldError("prosubcat2", "prosubcat2_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="prosubcat2_name_EN_<?php echo $cnt1; ?>">Sub catalogue2(English):</label></td>
            <td><input type="text" name="prosubcat2_name_EN_<?php echo $cnt1; ?>" id="prosubcat2_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat2['prosubcat2_name_EN']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("prosubcat2_name_EN");?> <?php echo $tNGs->displayFieldError("prosubcat2", "prosubcat2_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="url_<?php echo $cnt1; ?>">Url:</label></td>
            <td><input type="text" name="url_<?php echo $cnt1; ?>" id="url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat2['url']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("url");?> <?php echo $tNGs->displayFieldError("prosubcat2", "url", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_<?php echo $cnt1; ?>">Notes:</label></td>
            <td><input type="text" name="notes_<?php echo $cnt1; ?>" id="notes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat2['notes']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("notes");?> <?php echo $tNGs->displayFieldError("prosubcat2", "notes", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_EN_<?php echo $cnt1; ?>">Notes(English):</label></td>
            <td><input type="text" name="notes_EN_<?php echo $cnt1; ?>" id="notes_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat2['notes_EN']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("notes_EN");?> <?php echo $tNGs->displayFieldError("prosubcat2", "notes_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="id_procat_<?php echo $cnt1; ?>">Catalogue:</label></td>
            <td><select name="id_procat_<?php echo $cnt1; ?>" id="id_procat_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_procat['id_procat']?>"<?php if (!(strcmp($row_rs_procat['id_procat'], $row_rsprosubcat2['id_procat']))) {echo "SELECTED";} ?>><?php echo $row_rs_procat['procat_name']?></option>
              <?php
} while ($row_rs_procat = mysql_fetch_assoc($rs_procat));
  $rows = mysql_num_rows($rs_procat);
  if($rows > 0) {
      mysql_data_seek($rs_procat, 0);
	  $row_rs_procat = mysql_fetch_assoc($rs_procat);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("prosubcat2", "id_procat", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="id_prosubcat1_<?php echo $cnt1; ?>">Sub catalogue1:</label></td>
            <td><select name="id_prosubcat1_<?php echo $cnt1; ?>" id="id_prosubcat1_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat1" wdg:displayfield="prosubcat1_name" wdg:valuefield="id_prosubcat1" wdg:fkey="id_procat" wdg:triggerobject="id_procat_<?php echo $cnt1; ?>" wdg:selected="">
              <option value="" <?php if (!(strcmp("", $row_rsprosubcat2['id_prosubcat1']))) {echo "selected=\"selected\"";} ?>><?php echo NXT_getResource("Select one..."); ?></option>
            </select>
                <?php echo $tNGs->displayFieldError("prosubcat2", "id_prosubcat1", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day update:</label></td>
            <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsprosubcat2['day_update']); ?>" size="10" maxlength="22" />
                <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("prosubcat2", "day_update", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsprosubcat2['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("prosubcat2", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_prosubcat2_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsprosubcat2['kt_pk_prosubcat2']); ?>" />
        <?php } while ($row_rsprosubcat2 = mysql_fetch_assoc($rsprosubcat2)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_prosubcat2'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_prosubcat2')" />
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
<?php
mysql_free_result($rs_procat);

mysql_free_result($rs_prosubcat1);
?>
