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
$formValidation->addField("question_fullname", true, "text", "", "", "", "Vui lòng nhập họ tên.");
$formValidation->addField("question_email", true, "text", "email", "", "", "Vui lòng nhập email.");
$formValidation->addField("question_title", true, "text", "", "", "", "Vui lòng nhập tiêu đề.");
$formValidation->addField("question_content", true, "text", "", "", "", "Vui lòng nhập nội dung.");
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
$query_rs_member_ask = "SELECT id_member, member_name, member_email FROM member";
$rs_member_ask = mysql_query($query_rs_member_ask, $ketnoi) or die(mysql_error());
$row_rs_member_ask = mysql_fetch_assoc($rs_member_ask);
$totalRows_rs_member_ask = mysql_num_rows($rs_member_ask);

// Make an insert transaction instance
$ins_question = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_question);
// Register triggers
$ins_question->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_question->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_question->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=question");
// Add columns
$ins_question->setTable("question");
$ins_question->addColumn("question_fullname", "STRING_TYPE", "POST", "question_fullname", "{rs_member_ask.member_name}");
$ins_question->addColumn("question_email", "STRING_TYPE", "POST", "question_email", "{rs_member_ask.member_email}");
$ins_question->addColumn("question_title", "STRING_TYPE", "POST", "question_title");
$ins_question->addColumn("question_content", "STRING_TYPE", "POST", "question_content");
$ins_question->addColumn("question_day_update", "DATE_TYPE", "POST", "question_day_update", "{NOW_DT}");
$ins_question->setPrimaryKey("id_question", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsquestion = $tNGs->getRecordset("question");
$row_rsquestion = mysql_fetch_assoc($rsquestion);
$totalRows_rsquestion = mysql_num_rows($rsquestion);
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
  <table cellpadding="2" cellspacing="0" class="KT_tngtable" style="border-color:#99CCFF;">
    <tr style="border-bottom:dashed 1px #99CCFF;">
      <td><label for="question_fullname"><?php echo hoten;?> :</label></td>
      <td class="qa_line"><input type="text" name="question_fullname" id="question_fullname" value="<?php echo KT_escapeAttribute($row_rsquestion['question_fullname']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("question_fullname");?> <?php echo $tNGs->displayFieldError("question", "question_fullname"); ?> </td>
    </tr>
    <tr>
      <td><label for="question_email"><?php echo email;?> :</label></td>
      <td><input type="text" name="question_email" id="question_email" value="<?php echo KT_escapeAttribute($row_rsquestion['question_email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("question_email");?> <?php echo $tNGs->displayFieldError("question", "question_email"); ?> </td>
    </tr>
    <tr>
      <td><label for="question_title"><?php echo tieude;?> :</label></td>
      <td><input type="text" name="question_title" id="question_title" value="<?php echo KT_escapeAttribute($row_rsquestion['question_title']); ?>" size="70" />
          <?php echo $tNGs->displayFieldHint("question_title");?> <?php echo $tNGs->displayFieldError("question", "question_title"); ?> </td>
    </tr>
    <tr>
      <td colspan="2"><label for="question_content"><?php echo noidung;?> :</label></td>
    </tr>
      <tr>
      <td colspan="2"><textarea name="question_content" id="question_content" cols="77" rows="10" style="background-color:#FFFFF0"><?php echo KT_escapeAttribute($row_rsquestion['question_content']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("question_content");?> <?php echo $tNGs->displayFieldError("question", "question_content"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo guicauhoi;?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="question_day_update" id="question_day_update" value="<?php echo KT_formatDate($row_rsquestion['question_day_update']); ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($rs_member_ask);
?>