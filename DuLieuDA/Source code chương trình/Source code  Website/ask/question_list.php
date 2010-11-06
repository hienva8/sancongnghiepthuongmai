<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

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

$maxRows_rs_question = 10;
$pageNum_rs_question = 0;
if (isset($_GET['pageNum_rs_question'])) {
  $pageNum_rs_question = $_GET['pageNum_rs_question'];
}
$startRow_rs_question = $pageNum_rs_question * $maxRows_rs_question;

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_question = "SELECT * FROM question WHERE question_visible = 1 ORDER BY question_day_update DESC";
$query_limit_rs_question = sprintf("%s LIMIT %d, %d", $query_rs_question, $startRow_rs_question, $maxRows_rs_question);
$rs_question = mysql_query($query_limit_rs_question, $ketnoi) or die(mysql_error());
$row_rs_question = mysql_fetch_assoc($rs_question);

if (isset($_GET['totalRows_rs_question'])) {
  $totalRows_rs_question = $_GET['totalRows_rs_question'];
} else {
  $all_rs_question = mysql_query($query_rs_question);
  $totalRows_rs_question = mysql_num_rows($all_rs_question);
}
$totalPages_rs_question = ceil($totalRows_rs_question/$maxRows_rs_question)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div id="khung_question_list">
  <?php if ($totalRows_rs_question > 0) { // Show if recordset not empty ?>
    <?php do { ?>
      <div id="title" class="question_list"><a href="../index.php?mod=question_detail&amp;iquestion=<?php echo $row_rs_question['id_question'] ;?>"><?php echo $row_rs_question['question_title']; ?></a></div>
      <div class="question_list">
        <div class="contact_info"><?php echo $row_rs_question['question_fullname']; ?> | <?php echo $row_rs_question['question_email']; ?></div>
        <div class="day_update"><?php echo date('d/m/Y',strtotime($row_rs_question['question_day_update'])); ?></div>
      </div>
      <div id="content" class="qa_line"><?php echo $row_rs_question['question_content']; ?></div>
      <?php } while ($row_rs_question = mysql_fetch_assoc($rs_question)); ?>
    <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rs_question == 0) { // Show if recordset empty ?>
  <div class="question_list"><?php echo hienchuacocauhoi;?></div>
  <?php } // Show if recordset empty ?>
    <div class="question_list">
      	<div id="mypanel" class="ddpanel">
			<div id="mypanelcontent" class="ddpanelcontent">
<?php
  mxi_includes_start("question_form.php");
  require(basename("question_form.php"));
  mxi_includes_end();
?>
			</div>
		<div id="mypaneltab" class="ddpaneltab">
<a href="#"><span><?php echo banmuonhoi;?></span></a>
	</div>
</div>
</div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_question);
?>
