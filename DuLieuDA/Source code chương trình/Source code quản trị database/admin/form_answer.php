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
$formValidation->addField("answer_id_question", false, "numeric", "int", "", "", "vuilongchoncauhoi.");
$formValidation->addField("answer_id_member", true, "numeric", "", "", "", "");
$formValidation->addField("answer_content", true, "text", "", "", "", "Vui lòng nhập nội dung.");
$tNGs->prepareValidation($formValidation);
// End trigger

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
$query_rs_question = "SELECT id_question, question_title FROM question WHERE question_visible = 1 ORDER BY question_day_update DESC";
$rs_question = mysql_query($query_rs_question, $ketnoi) or die(mysql_error());
$row_rs_question = mysql_fetch_assoc($rs_question);
$totalRows_rs_question = mysql_num_rows($rs_question);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = "SELECT id_member, member_user FROM member WHERE member_active = 1 ORDER BY member_user ASC";
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);

$NxTMasterId_rsquestion1 = "-1";
if (isset($_GET['NxT_id_question'])) {
  $NxTMasterId_rsquestion1 = $_GET['NxT_id_question'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rsquestion1 = sprintf("SELECT id_question, question_title FROM question WHERE id_question = %s", GetSQLValueString($NxTMasterId_rsquestion1, "int"));
$rsquestion1 = mysql_query($query_rsquestion1, $ketnoi) or die(mysql_error());
$row_rsquestion1 = mysql_fetch_assoc($rsquestion1);
$totalRows_rsquestion1 = mysql_num_rows($rsquestion1);

// Make an insert transaction instance
$ins_answer = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_answer);
// Register triggers
$ins_answer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_answer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_answer->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_answer->setTable("answer");
$ins_answer->addColumn("answer_id_question", "NUMERIC_TYPE", "GET", "NxT_id_question");
$ins_answer->addColumn("answer_id_member", "NUMERIC_TYPE", "POST", "answer_id_member");
$ins_answer->addColumn("answer_content", "STRING_TYPE", "POST", "answer_content");
$ins_answer->addColumn("answer_day_update", "DATE_TYPE", "POST", "answer_day_update", "{NOW_DT}");
$ins_answer->addColumn("answer_visible", "CHECKBOX_1_0_TYPE", "POST", "answer_visible", "0");
$ins_answer->setPrimaryKey("id_answer", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_answer = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_answer);
// Register triggers
$upd_answer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_answer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_answer->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_answer->setTable("answer");
$upd_answer->addColumn("answer_id_member", "NUMERIC_TYPE", "POST", "answer_id_member");
$upd_answer->addColumn("answer_content", "STRING_TYPE", "POST", "answer_content");
$upd_answer->addColumn("answer_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$upd_answer->addColumn("answer_visible", "CHECKBOX_1_0_TYPE", "POST", "answer_visible");
$upd_answer->setPrimaryKey("id_answer", "NUMERIC_TYPE", "GET", "id_answer");

// Make an instance of the transaction object
$del_answer = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_answer);
// Register triggers
$del_answer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_answer->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_answer->setTable("answer");
$del_answer->setPrimaryKey("id_answer", "NUMERIC_TYPE", "GET", "id_answer");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsanswer = $tNGs->getRecordset("answer");
$row_rsanswer = mysql_fetch_assoc($rsanswer);
$totalRows_rsanswer = mysql_num_rows($rsanswer);
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
if (@$_GET['id_answer'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Answer </h1>
  <div class="KT_tngform">
    <?php 
// Show IF Conditional region5 
if (isset($_GET['NxT_id_question'])) {
?>
      <div>
        <?php 
// Show IF Conditional region4 
if (!isset($_GET['id_answer'])) {
?>
          Insert
          <?php 
// else Conditional region4
} else { ?>
          Update
          <?php } 
// endif Conditional region4
?>
        records for: <b><?php echo $row_rsquestion1['question_title']; ?></b></div>
      <?php } 
// endif Conditional region5
?><form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsanswer > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          
          <tr>
            <td class="KT_th"><label for="answer_id_member_<?php echo $cnt1; ?>"><?php echo thanhvien;?>:</label></td>
            <td><select name="answer_id_member_<?php echo $cnt1; ?>" id="answer_id_member_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_member['id_member']?>"<?php if (!(strcmp($row_rs_member['id_member'], $row_rsanswer['answer_id_member']))) {echo "SELECTED";} ?>><?php echo $row_rs_member['member_user']?></option>
              <?php
} while ($row_rs_member = mysql_fetch_assoc($rs_member));
  $rows = mysql_num_rows($rs_member);
  if($rows > 0) {
      mysql_data_seek($rs_member, 0);
	  $row_rs_member = mysql_fetch_assoc($rs_member);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("answer", "answer_id_member", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="answer_content_<?php echo $cnt1; ?>">Answer_content:</label></td>
            <td><textarea name="answer_content_<?php echo $cnt1; ?>" id="answer_content_<?php echo $cnt1; ?>" cols="70" rows="10"><?php echo KT_escapeAttribute($row_rsanswer['answer_content']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("answer_content");?> <?php echo $tNGs->displayFieldError("answer", "answer_content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="answer_day_update_<?php echo $cnt1; ?>"><?php echo ngaytraloi;?>:</label></td>
            <td><?php echo KT_formatDate($row_rsanswer['answer_day_update']); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="answer_visible_<?php echo $cnt1; ?>"><?php echo anhien;?>:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsanswer['answer_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="answer_visible_<?php echo $cnt1; ?>" id="answer_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("answer", "answer_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_answer_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsanswer['kt_pk_answer']); ?>" />
        <?php } while ($row_rsanswer = mysql_fetch_assoc($rsanswer)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_answer'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_answer')" />
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
mysql_free_result($rs_question);

mysql_free_result($rs_member);

mysql_free_result($rsquestion1);
?>
