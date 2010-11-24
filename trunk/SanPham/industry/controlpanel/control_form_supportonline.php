<?php require_once('../Connections/ketnoi.php'); ?>
<?php
require_once('../inc_language.php'); 
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
$formValidation->addField("id_contact_department", true, "text", "", "", "", "vuilongchonbophanlienhe.");
$formValidation->addField("humanname_help", true, "text", "", "", "", "vuilongnhapten.");
$formValidation->addField("nickname", true, "text", "", "", "", "Please enter a email.");
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
$query_rs_contact_department = "SELECT id_contact_department, name, name_EN FROM contact_department WHERE type='member' AND visible = 1 ORDER BY sort ASC";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);
// Make an insert transaction instance
$ins_supportonline = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_supportonline);
// Register triggers
$ins_supportonline->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_supportonline->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_supportonline->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lsupport");
$ins_supportonline->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_supportonline->setTable("supportonline");
$ins_supportonline->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member","{SESSION.kt_login_id}");
$ins_supportonline->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$ins_supportonline->addColumn("humanname_help", "STRING_TYPE", "POST", "humanname_help");
$ins_supportonline->addColumn("humansex_help", "STRING_TYPE", "POST", "humansex_help");
$ins_supportonline->addColumn("tel", "STRING_TYPE", "POST", "tel");
$ins_supportonline->addColumn("nickname", "STRING_TYPE", "POST", "nickname");
$ins_supportonline->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_supportonline->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "1");
$ins_supportonline->setPrimaryKey("id_supportonline", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_supportonline = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_supportonline);
// Register triggers
$upd_supportonline->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_supportonline->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_supportonline->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lsupport");
// Add columns
$upd_supportonline->setTable("supportonline");
$upd_supportonline->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member");
$upd_supportonline->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$upd_supportonline->addColumn("humanname_help", "STRING_TYPE", "POST", "humanname_help");
$upd_supportonline->addColumn("humansex_help", "STRING_TYPE", "POST", "humansex_help");
$upd_supportonline->addColumn("tel", "STRING_TYPE", "POST", "tel");
$upd_supportonline->addColumn("nickname", "STRING_TYPE", "POST", "nickname");
$upd_supportonline->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_supportonline->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_supportonline->setPrimaryKey("id_supportonline", "NUMERIC_TYPE", "GET", "id_supportonline");

// Make an instance of the transaction object
$del_supportonline = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_supportonline);
// Register triggers
$del_supportonline->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_supportonline->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lsupport");
// Add columns
$del_supportonline->setTable("supportonline");
$del_supportonline->setPrimaryKey("id_supportonline", "NUMERIC_TYPE", "GET", "id_supportonline");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rssupportonline = $tNGs->getRecordset("supportonline");
$row_rssupportonline = mysql_fetch_assoc($rssupportonline);
$totalRows_rssupportonline = mysql_num_rows($rssupportonline);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <?php $cnt1 = 0; ?>
  <?php do { ?>
    <?php $cnt1++; ?>
    <?php 
// Show IF Conditional region1 
if (@$totalRows_rssupportonline > 1) {
?>
      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
      <?php } 
// endif Conditional region1
?>
    <table border="0" cellpadding="2" cellspacing="0" style="border:solid 1px #99CCFF;" class="KT_tngtable">
      <tr>
        <td width="100"><label for="id_contact_department_<?php echo $cnt1; ?>"><?php echo bophanlienhe;?> :</label></td>
        <td width="300"><select name="id_contact_department_<?php echo $cnt1; ?>" id="id_contact_department_<?php echo $cnt1; ?>">
          <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
          <?php 
do {  
?>
          <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rssupportonline['id_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
          <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
        </select>
            <?php echo $tNGs->displayFieldError("supportonline", "id_contact_department", $cnt1); ?> </td>
      </tr>
      <tr>
        <td width="75"><label for="humanname_help_<?php echo $cnt1; ?>"><?php echo hoten;?> :</label></td>
        <td width="300"><input type="text" name="humanname_help_<?php echo $cnt1; ?>" id="humanname_help_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupportonline['humanname_help']); ?>" size="32" maxlength="60" />
            <?php echo $tNGs->displayFieldHint("humanname_help");?> <?php echo $tNGs->displayFieldError("supportonline", "humanname_help", $cnt1); ?> </td>
      </tr>
      <tr>
        <td width="75"><label for="humansex_help_<?php echo $cnt1; ?>_1"><?php echo gioitinh;?> :</label></td>
        <td width="300"><div>
          <input <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['humansex_help']),"Mr"))) {echo "CHECKED";} ?> type="radio" name="humansex_help_<?php echo $cnt1; ?>" id="humansex_help_<?php echo $cnt1; ?>_1" value="Mr" checked="checked"/>
          <label for="humansex_help_<?php echo $cnt1; ?>_1"><?php echo ong;?></label>
        </div>
            <div>
              <input <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['humansex_help']),"Mrs/Miss"))) {echo "CHECKED";} ?> type="radio" name="humansex_help_<?php echo $cnt1; ?>" id="humansex_help_<?php echo $cnt1; ?>_2" value="Mrs/Miss" />
              <label for="humansex_help_<?php echo $cnt1; ?>_2"><?php echo ba;?></label>
            </div>
          <div>
              <input <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['humansex_help']),"Orther"))) {echo "CHECKED";} ?> type="radio" name="humansex_help_<?php echo $cnt1; ?>" id="humansex_help_<?php echo $cnt1; ?>_3" value="Orther" />
              <label for="humansex_help_<?php echo $cnt1; ?>_3"><?php echo khac;?></label>
            </div>
          <?php echo $tNGs->displayFieldError("supportonline", "humansex_help", $cnt1); ?> </td>
      </tr>
      <tr>
        <td width="75"><label for="tel_<?php echo $cnt1; ?>"><?php echo dienthoai;?> :</label></td>
        <td width="300"><input type="text" name="tel_<?php echo $cnt1; ?>" id="tel_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupportonline['tel']); ?>" size="20" maxlength="20" />
            <?php echo $tNGs->displayFieldHint("tel");?> <?php echo $tNGs->displayFieldError("supportonline", "tel", $cnt1); ?> </td>
      </tr>
      <tr>
        <td width="75"><label for="nickname_<?php echo $cnt1; ?>"><?php echo email;?> :</label></td>
        <td width="300"><input type="text" name="nickname_<?php echo $cnt1; ?>" id="nickname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupportonline['nickname']); ?>" size="30" maxlength="30" />
            <?php echo $tNGs->displayFieldHint("nickname");?> <?php echo $tNGs->displayFieldError("supportonline", "nickname", $cnt1); ?> </td>
      </tr>
      <tr>
        <td width="75"><label for="status_<?php echo $cnt1; ?>"><?php echo status;?> :</label></td>
        <td width="300"><input type="text" name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupportonline['status']); ?>" size="30" maxlength="30" />
            <?php echo $tNGs->displayFieldHint("status");?> <?php echo $tNGs->displayFieldError("supportonline", "status", $cnt1); ?> </td>
      </tr>
      <tr>
        <td width="75"><label for="visible_<?php echo $cnt1; ?>"><?php echo anhien;?> :</label></td>
        <td width="300"><input  <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
            <?php echo $tNGs->displayFieldError("supportonline", "visible", $cnt1); ?> </td>
      </tr>
      <tr>
        <td colspan="2" class="KT_bottombuttons"><?php 
      // Show IF Conditional region1
      if (@$_GET['id_supportonline'] == "") {
      ?>
              <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource(themmoi); ?>" />
              <?php 
      // else Conditional region1
      } else { ?>
              <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource(capnhat); ?>" />
              <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource(xoa); ?>" onclick="return confirm('<?php echo NXT_getResource(dongyxoa); ?>');" />
              <?php }
      // endif Conditional region1
      ?>
            <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource(huybo); ?>"onclick="hideStuff('answer1')" /></td>
      </tr>
    </table>
    <input type="hidden" name="kt_pk_supportonline_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rssupportonline['kt_pk_supportonline']); ?>" />
    <input type="hidden" name="id_member_<?php echo $cnt1; ?>" id="id_member_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupportonline['id_member']); ?>" />
    <?php } while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department)); ?>
</form>
</body>
</html>
<?php
mysql_free_result($rs_contact_department);
?>
