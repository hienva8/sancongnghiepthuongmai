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

// Make an update transaction instance
$upd_question = new tNG_update($conn_ketnoi);
$tNGs->addTransaction($upd_question);
// Register triggers
$upd_question->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_question->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_question->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_question");
// Add columns
$upd_question->setTable("question");
$upd_question->addColumn("question_fullname", "STRING_TYPE", "POST", "question_fullname");
$upd_question->addColumn("question_email", "STRING_TYPE", "POST", "question_email");
$upd_question->addColumn("question_title", "STRING_TYPE", "POST", "question_title");
$upd_question->addColumn("question_content", "STRING_TYPE", "POST", "question_content");
$upd_question->addColumn("question_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_question->addColumn("question_visible", "CHECKBOX_1_0_TYPE", "POST", "question_visible");
$upd_question->setPrimaryKey("id_question", "NUMERIC_TYPE", "GET", "id_question");

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
<h3> <?php echo capnhat." ".cauhoi;?>
   </h3>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="question_fullname"><?php echo hoten;?>:</label></td>
      <td><input type="text" name="question_fullname" id="question_fullname" value="<?php echo KT_escapeAttribute($row_rsquestion['question_fullname']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("question_fullname");?> <?php echo $tNGs->displayFieldError("question", "question_fullname"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="question_email"><?php echo email;?> :</label></td>
      <td><input type="text" name="question_email" id="question_email" value="<?php echo KT_escapeAttribute($row_rsquestion['question_email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("question_email");?> <?php echo $tNGs->displayFieldError("question", "question_email"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="question_title"><?php echo tieude;?> :</label></td>
      <td><input type="text" name="question_title" id="question_title" value="<?php echo KT_escapeAttribute($row_rsquestion['question_title']); ?>" size="70" />
          <?php echo $tNGs->displayFieldHint("question_title");?> <?php echo $tNGs->displayFieldError("question", "question_title"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="question_content"><?php echo noidung;?> :</label></td>
      <td><textarea name="question_content" id="question_content" cols="80" rows="10"><?php echo KT_escapeAttribute($row_rsquestion['question_content']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("question_content");?> <?php echo $tNGs->displayFieldError("question", "question_content"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><?php echo ngaylienhe;?>:</td>
      <td><?php echo KT_formatDate($row_rsquestion['question_day_update']); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="question_visible"><?php echo anhien;?>:</label></td>
      <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsquestion['question_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="question_visible" id="question_visible" value="1" />
          <?php echo $tNGs->displayFieldError("question", "question_visible"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Update1" id="KT_Update1" value="<?php echo capnhat;?>" />&nbsp;<input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource(huybo); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
