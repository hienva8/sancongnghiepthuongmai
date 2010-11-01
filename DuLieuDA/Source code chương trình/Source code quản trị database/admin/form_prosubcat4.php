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
$formValidation->addField("prosubcat4_name", true, "text", "", "", "", "Please enter a sub catalogue name.");
$formValidation->addField("prosubcat4_name_EN", true, "text", "", "", "", "Please enter a sub catalogue name.");
$formValidation->addField("id_procat", true, "numeric", "", "", "", "Please choose a Catalogue.");
$formValidation->addField("id_prosubcat1", true, "numeric", "", "", "", "Please choose a Sub catalogue.");
$formValidation->addField("id_prosubcat2", true, "numeric", "", "", "", "Please choose a Sub catalogue.");
$formValidation->addField("id_prosubcat3", true, "numeric", "", "", "", "Please choose a Sub catalogue.");
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

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat2 = "SELECT id_prosubcat2, id_procat, id_prosubcat1, prosubcat2_name FROM prosubcat2 ORDER BY sort ASC";
$rs_prosubcat2 = mysql_query($query_rs_prosubcat2, $ketnoi) or die(mysql_error());
$row_rs_prosubcat2 = mysql_fetch_assoc($rs_prosubcat2);
$totalRows_rs_prosubcat2 = mysql_num_rows($rs_prosubcat2);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat3 = "SELECT id_prosubcat3, id_procat, id_prosubcat1, id_prosubcat2, prosubcat3_name FROM prosubcat3 ORDER BY sort ASC";
$rs_prosubcat3 = mysql_query($query_rs_prosubcat3, $ketnoi) or die(mysql_error());
$row_rs_prosubcat3 = mysql_fetch_assoc($rs_prosubcat3);
$totalRows_rs_prosubcat3 = mysql_num_rows($rs_prosubcat3);

// Make an insert transaction instance
$ins_prosubcat4 = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_prosubcat4);
// Register triggers
$ins_prosubcat4->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_prosubcat4->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_prosubcat4->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_prosubcat4");
$ins_prosubcat4->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_prosubcat4->setTable("prosubcat4");
$ins_prosubcat4->addColumn("prosubcat4_name", "STRING_TYPE", "POST", "prosubcat4_name");
$ins_prosubcat4->addColumn("prosubcat4_name_EN", "STRING_TYPE", "POST", "prosubcat4_name_EN");
$ins_prosubcat4->addColumn("url", "STRING_TYPE", "POST", "url");
$ins_prosubcat4->addColumn("notes", "STRING_TYPE", "POST", "notes");
$ins_prosubcat4->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$ins_prosubcat4->addColumn("id_procat", "NUMERIC_TYPE", "POST", "id_procat");
$ins_prosubcat4->addColumn("id_prosubcat1", "NUMERIC_TYPE", "POST", "id_prosubcat1");
$ins_prosubcat4->addColumn("id_prosubcat2", "NUMERIC_TYPE", "POST", "id_prosubcat2");
$ins_prosubcat4->addColumn("id_prosubcat3", "NUMERIC_TYPE", "POST", "id_prosubcat3");
$ins_prosubcat4->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_prosubcat4->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_prosubcat4->setPrimaryKey("id_prosubcat4", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_prosubcat4 = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_prosubcat4);
// Register triggers
$upd_prosubcat4->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_prosubcat4->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_prosubcat4->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_prosubcat4");
// Add columns
$upd_prosubcat4->setTable("prosubcat4");
$upd_prosubcat4->addColumn("prosubcat4_name", "STRING_TYPE", "POST", "prosubcat4_name");
$upd_prosubcat4->addColumn("prosubcat4_name_EN", "STRING_TYPE", "POST", "prosubcat4_name_EN");
$upd_prosubcat4->addColumn("url", "STRING_TYPE", "POST", "url");
$upd_prosubcat4->addColumn("notes", "STRING_TYPE", "POST", "notes");
$upd_prosubcat4->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$upd_prosubcat4->addColumn("id_procat", "NUMERIC_TYPE", "POST", "id_procat");
$upd_prosubcat4->addColumn("id_prosubcat1", "NUMERIC_TYPE", "POST", "id_prosubcat1");
$upd_prosubcat4->addColumn("id_prosubcat2", "NUMERIC_TYPE", "POST", "id_prosubcat2");
$upd_prosubcat4->addColumn("id_prosubcat3", "NUMERIC_TYPE", "POST", "id_prosubcat3");
$upd_prosubcat4->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_prosubcat4->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_prosubcat4->setPrimaryKey("id_prosubcat4", "NUMERIC_TYPE", "GET", "id_prosubcat4");

// Make an instance of the transaction object
$del_prosubcat4 = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_prosubcat4);
// Register triggers
$del_prosubcat4->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_prosubcat4->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_prosubcat4");
// Add columns
$del_prosubcat4->setTable("prosubcat4");
$del_prosubcat4->setPrimaryKey("id_prosubcat4", "NUMERIC_TYPE", "GET", "id_prosubcat4");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsprosubcat4 = $tNGs->getRecordset("prosubcat4");
$row_rsprosubcat4 = mysql_fetch_assoc($rsprosubcat4);
$totalRows_rsprosubcat4 = mysql_num_rows($rsprosubcat4);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?><script src="../includes/nxt/scripts/form.js" type="text/javascript"></script><script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script><script type="text/javascript">
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
<?php
//begin JSRecordset
$jsObject_rs_prosubcat2 = new WDG_JsRecordset("rs_prosubcat2");
echo $jsObject_rs_prosubcat2->getOutput();
//end JSRecordset
?>
<?php
//begin JSRecordset
$jsObject_rs_prosubcat3 = new WDG_JsRecordset("rs_prosubcat3");
echo $jsObject_rs_prosubcat3->getOutput();
//end JSRecordset
?>
</head>

<body>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_prosubcat4'] == "") {
?>
    <?php echo NXT_getResource("Insert_FH"); ?>
    <?php 
// else Conditional region1
} else { ?>
    <?php echo NXT_getResource("Update_FH"); ?>
    <?php } 
// endif Conditional region1
?>
    Sub catalogue4 </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
      <?php $cnt1++; ?>
      <?php 
// Show IF Conditional region1 
if (@$totalRows_rsprosubcat4 > 1) {
?>
      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
      <?php } 
// endif Conditional region1
?>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <tr>
          <td class="KT_th"><label for="prosubcat4_name_<?php echo $cnt1; ?>">Sub catalogue4:</label></td>
          <td><input type="text" name="prosubcat4_name_<?php echo $cnt1; ?>" id="prosubcat4_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat4['prosubcat4_name']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("prosubcat4_name");?> <?php echo $tNGs->displayFieldError("prosubcat4", "prosubcat4_name", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="prosubcat4_name_EN_<?php echo $cnt1; ?>">Sub catalogue4(English):</label></td>
          <td><input type="text" name="prosubcat4_name_EN_<?php echo $cnt1; ?>" id="prosubcat4_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat4['prosubcat4_name_EN']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("prosubcat4_name_EN");?> <?php echo $tNGs->displayFieldError("prosubcat4", "prosubcat4_name_EN", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="url_<?php echo $cnt1; ?>">Url:</label></td>
          <td><input type="text" name="url_<?php echo $cnt1; ?>" id="url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat4['url']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("url");?> <?php echo $tNGs->displayFieldError("prosubcat4", "url", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="notes_<?php echo $cnt1; ?>">Notes:</label></td>
          <td><input type="text" name="notes_<?php echo $cnt1; ?>" id="notes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat4['notes']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("notes");?> <?php echo $tNGs->displayFieldError("prosubcat4", "notes", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="notes_EN_<?php echo $cnt1; ?>">Notes(English):</label></td>
          <td><input type="text" name="notes_EN_<?php echo $cnt1; ?>" id="notes_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsprosubcat4['notes_EN']); ?>" size="32" maxlength="60" />
              <?php echo $tNGs->displayFieldHint("notes_EN");?> <?php echo $tNGs->displayFieldError("prosubcat4", "notes_EN", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="id_procat_<?php echo $cnt1; ?>">Catalogue:</label></td>
          <td><select name="id_procat_<?php echo $cnt1; ?>" id="id_procat_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
            <?php 
do {  
?>
            <option value="<?php echo $row_rs_procat['id_procat']?>"<?php if (!(strcmp($row_rs_procat['id_procat'], $row_rsprosubcat4['id_procat']))) {echo "SELECTED";} ?>><?php echo $row_rs_procat['procat_name']?></option>
            <?php
} while ($row_rs_procat = mysql_fetch_assoc($rs_procat));
  $rows = mysql_num_rows($rs_procat);
  if($rows > 0) {
      mysql_data_seek($rs_procat, 0);
	  $row_rs_procat = mysql_fetch_assoc($rs_procat);
  }
?>
          </select>
              <?php echo $tNGs->displayFieldError("prosubcat4", "id_procat", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="id_prosubcat1_<?php echo $cnt1; ?>">Sub catalogue1:</label></td>
          <td><select name="id_prosubcat1_<?php echo $cnt1; ?>" id="id_prosubcat1_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat1" wdg:displayfield="prosubcat1_name" wdg:valuefield="id_prosubcat1" wdg:fkey="id_procat" wdg:triggerobject="id_procat_<?php echo $cnt1; ?>" wdg:selected="<?php echo $row_rsprosubcat4['id_prosubcat1'] ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
          </select>
              <?php echo $tNGs->displayFieldError("prosubcat4", "id_prosubcat1", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="id_prosubcat2_<?php echo $cnt1; ?>">Sub catalogue2:</label></td>
          <td><select name="id_prosubcat2_<?php echo $cnt1; ?>" id="id_prosubcat2_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat2" wdg:displayfield="prosubcat2_name" wdg:valuefield="id_prosubcat2" wdg:fkey="id_prosubcat1" wdg:triggerobject="id_prosubcat1_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
          </select>
              <?php echo $tNGs->displayFieldError("prosubcat4", "id_prosubcat2", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="id_prosubcat3_<?php echo $cnt1; ?>">Sub catalogue3:</label></td>
          <td><select name="id_prosubcat3_<?php echo $cnt1; ?>" id="id_prosubcat3_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat3" wdg:displayfield="prosubcat3_name" wdg:valuefield="id_prosubcat3" wdg:fkey="id_prosubcat2" wdg:triggerobject="id_prosubcat2_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
          </select>
              <?php echo $tNGs->displayFieldError("prosubcat4", "id_prosubcat3", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>">Day_update:</label></td>
          <td><input type="text" name="day_update_<?php echo $cnt1; ?>" id="day_update_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsprosubcat4['day_update']); ?>" size="10" maxlength="22" />
              <?php echo $tNGs->displayFieldHint("day_update");?> <?php echo $tNGs->displayFieldError("prosubcat4", "day_update", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
          <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsprosubcat4['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
              <?php echo $tNGs->displayFieldError("prosubcat4", "visible", $cnt1); ?> </td>
        </tr>
      </table>
      <input type="hidden" name="kt_pk_prosubcat4_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsprosubcat4['kt_pk_prosubcat4']); ?>" />
      <?php } while ($row_rsprosubcat4 = mysql_fetch_assoc($rsprosubcat4)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_prosubcat4'] == "") {
      ?>
          <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
          <?php 
      // else Conditional region1
      } else { ?>
          <div class="KT_operations">
            <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_prosubcat4')" />
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

mysql_free_result($rs_prosubcat2);

mysql_free_result($rs_prosubcat3);
?>
