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
$formValidation->addField("submenu_name", true, "text", "", "", "", "Please enter sub menu name.");
$formValidation->addField("submenu_name_EN", true, "text", "", "", "", "Please enter sub menu name.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("submenu");
  $tblFldObj->addFieldName("submenu_name");
  $tblFldObj->addFieldName("submenu_name_EN");
  $tblFldObj->setErrorMsg("Submenu name already exists");
  return $tblFldObj->Execute();
}
//end Trigger_CheckUnique trigger

// Start trigger
$formValidation1 = new tNG_FormValidation();
$formValidation1->addField("id_menu", true, "numeric", "", "", "", "Please select a menu.");
$tNGs->prepareValidation($formValidation1);
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
$query_rs_menu = "SELECT id_menu, menu_name, menu_name_EN FROM menu WHERE visible = 1";
$rs_menu = mysql_query($query_rs_menu, $ketnoi) or die(mysql_error());
$row_rs_menu = mysql_fetch_assoc($rs_menu);
$totalRows_rs_menu = mysql_num_rows($rs_menu);

// Make an insert transaction instance
$ins_submenu = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_submenu);
// Register triggers
$ins_submenu->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_submenu->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_submenu->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_submenu->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_submenu->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
$ins_submenu->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation1);
// Add columns
$ins_submenu->setTable("submenu");
$ins_submenu->addColumn("submenu_name", "STRING_TYPE", "POST", "submenu_name");
$ins_submenu->addColumn("submenu_name_EN", "STRING_TYPE", "POST", "submenu_name_EN");
$ins_submenu->addColumn("id_menu", "NUMERIC_TYPE", "POST", "id_menu");
$ins_submenu->addColumn("url", "STRING_TYPE", "POST", "url");
$ins_submenu->addColumn("outlink", "STRING_TYPE", "POST", "outlink");
$ins_submenu->addColumn("notes", "STRING_TYPE", "POST", "notes");
$ins_submenu->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$ins_submenu->addColumn("target", "STRING_TYPE", "POST", "target");
$ins_submenu->addColumn("position", "STRING_TYPE", "POST", "position");
$ins_submenu->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_submenu->setPrimaryKey("id_submenu", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_submenu = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_submenu);
// Register triggers
$upd_submenu->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_submenu->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_submenu->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_submenu->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
$upd_submenu->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation1);
// Add columns
$upd_submenu->setTable("submenu");
$upd_submenu->addColumn("submenu_name", "STRING_TYPE", "POST", "submenu_name");
$upd_submenu->addColumn("submenu_name_EN", "STRING_TYPE", "POST", "submenu_name_EN");
$upd_submenu->addColumn("id_menu", "NUMERIC_TYPE", "POST", "id_menu");
$upd_submenu->addColumn("url", "STRING_TYPE", "POST", "url");
$upd_submenu->addColumn("outlink", "STRING_TYPE", "POST", "outlink");
$upd_submenu->addColumn("notes", "STRING_TYPE", "POST", "notes");
$upd_submenu->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$upd_submenu->addColumn("target", "STRING_TYPE", "POST", "target");
$upd_submenu->addColumn("position", "STRING_TYPE", "POST", "position");
$upd_submenu->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_submenu->setPrimaryKey("id_submenu", "NUMERIC_TYPE", "GET", "id_submenu");

// Make an instance of the transaction object
$del_submenu = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_submenu);
// Register triggers
$del_submenu->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_submenu->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_submenu->setTable("submenu");
$del_submenu->setPrimaryKey("id_submenu", "NUMERIC_TYPE", "GET", "id_submenu");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rssubmenu = $tNGs->getRecordset("submenu");
$row_rssubmenu = mysql_fetch_assoc($rssubmenu);
$totalRows_rssubmenu = mysql_num_rows($rssubmenu);
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
if (@$_GET['id_submenu'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Submenu </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rssubmenu > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="submenu_name_<?php echo $cnt1; ?>">Submenu name:</label></td>
            <td><input type="text" name="submenu_name_<?php echo $cnt1; ?>" id="submenu_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssubmenu['submenu_name']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("submenu_name");?> <?php echo $tNGs->displayFieldError("submenu", "submenu_name", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="submenu_name_EN_<?php echo $cnt1; ?>">Submenu name(English):</label></td>
            <td><input type="text" name="submenu_name_EN_<?php echo $cnt1; ?>" id="submenu_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssubmenu['submenu_name_EN']); ?>" size="30" maxlength="30" />
                <?php echo $tNGs->displayFieldHint("submenu_name_EN");?> <?php echo $tNGs->displayFieldError("submenu", "submenu_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="id_menu_<?php echo $cnt1; ?>">Id_menu:</label></td>
            <td><select name="id_menu_<?php echo $cnt1; ?>" id="id_menu_<?php echo $cnt1; ?>">
                <option value="" <?php if (!(strcmp("", KT_escapeAttribute($row_rssubmenu['id_menu'])))) {echo "selected=\"selected\"";} ?>>--- Select ---</option>
<?php
do {  
?>
                <option value="<?php echo $row_rs_menu['id_menu']?>"<?php if (!(strcmp($row_rs_menu['id_menu'], KT_escapeAttribute($row_rssubmenu['id_menu'])))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_menu['menu_name']?></option>
                <?php
} while ($row_rs_menu = mysql_fetch_assoc($rs_menu));
  $rows = mysql_num_rows($rs_menu);
  if($rows > 0) {
      mysql_data_seek($rs_menu, 0);
	  $row_rs_menu = mysql_fetch_assoc($rs_menu);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("submenu", "id_menu", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="url_<?php echo $cnt1; ?>">Url:</label></td>
            <td><input type="text" name="url_<?php echo $cnt1; ?>" id="url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssubmenu['url']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("url");?> <?php echo $tNGs->displayFieldError("submenu", "url", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="outlink_<?php echo $cnt1; ?>">Outlink:</label></td>
            <td><input type="text" name="outlink_<?php echo $cnt1; ?>" id="outlink_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssubmenu['outlink']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("outlink");?> <?php echo $tNGs->displayFieldError("submenu", "outlink", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_<?php echo $cnt1; ?>">Notes:</label></td>
            <td><input type="text" name="notes_<?php echo $cnt1; ?>" id="notes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssubmenu['notes']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("notes");?> <?php echo $tNGs->displayFieldError("submenu", "notes", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_EN_<?php echo $cnt1; ?>">notes(English):</label></td>
            <td><input type="text" name="notes_EN_<?php echo $cnt1; ?>" id="notes_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssubmenu['notes_EN']); ?>" size="32" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("notes_EN");?> <?php echo $tNGs->displayFieldError("submenu", "notes_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="target_<?php echo $cnt1; ?>">Target:</label></td>
            <td><select name="target_<?php echo $cnt1; ?>" id="target_<?php echo $cnt1; ?>">
              <option value="_self" <?php if (!(strcmp("_self", KT_escapeAttribute($row_rssubmenu['target'])))) {echo "SELECTED";} ?>>_self</option>
              <option value="_blank" <?php if (!(strcmp("_blank", KT_escapeAttribute($row_rssubmenu['target'])))) {echo "SELECTED";} ?>>_blank</option>
            </select>
                <?php echo $tNGs->displayFieldError("submenu", "target", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="position_<?php echo $cnt1; ?>">Position:</label></td>
            <td><select name="position_<?php echo $cnt1; ?>" id="position_<?php echo $cnt1; ?>">
              <option value="index_top1" <?php if (!(strcmp("index_top1", KT_escapeAttribute($row_rssubmenu['position'])))) {echo "SELECTED";} ?>>index_top1</option>
              <option value="index_top2" <?php if (!(strcmp("index_top2", KT_escapeAttribute($row_rssubmenu['position'])))) {echo "SELECTED";} ?>>index_top2</option>
              <option value="index_footer" <?php if (!(strcmp("index_footer", KT_escapeAttribute($row_rssubmenu['position'])))) {echo "SELECTED";} ?>>index_footer</option>
              <option value="admin" <?php if (!(strcmp("admin", KT_escapeAttribute($row_rssubmenu['position'])))) {echo "SELECTED";} ?>>admin</option>
            </select>
                <?php echo $tNGs->displayFieldError("submenu", "position", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rssubmenu['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("submenu", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_submenu_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rssubmenu['kt_pk_submenu']); ?>" />
        <?php } while ($row_rssubmenu = mysql_fetch_assoc($rssubmenu)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_submenu'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_submenu')" />
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
mysql_free_result($rs_menu);
?>
