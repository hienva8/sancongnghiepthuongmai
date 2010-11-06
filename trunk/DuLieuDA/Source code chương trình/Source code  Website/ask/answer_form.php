<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
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

$colname_rs_member = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = sprintf("SELECT member_name, member_email FROM member WHERE id_member = %s", GetSQLValueString($colname_rs_member, "int"));
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);

// Make an insert transaction instance
$ins_answer = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_answer);
// Register triggers
$ins_answer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_answer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_answer->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=question");
// Add columns
$ins_answer->setTable("answer");
$ins_answer->addColumn("answer_id_question", "NUMERIC_TYPE", "POST", "answer_id_question", "{GET.iquestion}");
$ins_answer->addColumn("answer_id_member", "NUMERIC_TYPE", "POST", "answer_id_member", "{SESSION.kt_login_id}");
$ins_answer->addColumn("answer_content", "STRING_TYPE", "POST", "answer_content");
$ins_answer->addColumn("answer_day_update", "DATE_TYPE", "POST", "answer_day_update", "{NOW_DT}");
$ins_answer->setPrimaryKey("id_answer", "NUMERIC_TYPE");

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
</head>

<body>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td colspan="2"><label for="answer_content"><?php echo noidung;?> :</label></td>
    </tr>
      <tr>
      <td colspan="2"><textarea name="answer_content" id="answer_content" cols="77" rows="10" style="background-color:#FFFFF0"><?php echo KT_escapeAttribute($row_rsanswer['answer_content']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("answer_content");?> <?php echo $tNGs->displayFieldError("answer", "answer_content"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo guitraloi;?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="answer_id_question" id="answer_id_question" value="<?php echo KT_escapeAttribute($row_rsanswer['answer_id_question']); ?>" />
  <input type="hidden" name="answer_id_member" id="answer_id_member" value="<?php echo KT_escapeAttribute($row_rsanswer['answer_id_member']); ?>" />
  <input type="hidden" name="answer_day_update" id="answer_day_update" value="<?php echo KT_formatDate($row_rsanswer['answer_day_update']); ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($rs_member);
?>
