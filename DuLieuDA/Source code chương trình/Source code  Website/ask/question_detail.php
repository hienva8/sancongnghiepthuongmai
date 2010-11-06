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

$get_id_question_rs_answer = "-1";
if (isset($_GET['iquestion'])) {
  $get_id_question_rs_answer = $_GET['iquestion'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_answer = sprintf("SELECT id_answer, answer_content, answer_day_update,member_name,member_email FROM answer,member WHERE answer_id_question=%s AND answer_visible = 1 AND answer_id_member=id_member", GetSQLValueString($get_id_question_rs_answer, "int"));
$rs_answer = mysql_query($query_rs_answer, $ketnoi) or die(mysql_error());
$row_rs_answer = mysql_fetch_assoc($rs_answer);
$totalRows_rs_answer = mysql_num_rows($rs_answer);

$get_id_question_rs_question = "-1";
if (isset($_GET['iquestion'])) {
  $get_id_question_rs_question = $_GET['iquestion'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_question = sprintf("SELECT * FROM question WHERE question_visible = 1 AND id_question=%s ORDER BY question_day_update DESC", GetSQLValueString($get_id_question_rs_question, "int"));
$rs_question = mysql_query($query_rs_question, $ketnoi) or die(mysql_error());
$row_rs_question = mysql_fetch_assoc($rs_question);
$totalRows_rs_question = mysql_num_rows($rs_question);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/css/style.css" type="text/css" rel="stylesheet" />

</head>

<body>
<div id="khung_answer_list">
	<div class="answer_list">
    	<div class="contact_info"><?php echo $row_rs_question['question_fullname']; ?> | <?php echo $row_rs_question['question_email']; ?></div>
      <div class="day_update"><?php echo $row_rs_question['question_day_update']; ?></div>
  </div>
	<div id="title"><?php echo $row_rs_question['question_title']; ?></div>
    <div id="content"><?php echo $row_rs_question['question_content']; ?></div>

 <?php
  mxi_includes_start("answer_list.php");
  require(basename("answer_list.php"));
  mxi_includes_end();
?>
  <div class="answer_list">
  	<div id="mypanel" class="ddpanel">
<div id="mypanelcontent" class="ddpanelcontent">
<?php if(isset($_SESSION['kt_login_id'])){?>
    <?php
  mxi_includes_start("answer_form.php");
  require(basename("answer_form.php"));
  mxi_includes_end();
?>
<?php }else{ echo "<center><br />".banphailathanhvien."&nbsp;<a href='../index.php?mod=register'>".dangki."</a></center>";}?>
</div>
<div id="mypaneltab" class="ddpaneltab">
<a href="#"><span><?php echo traloi;?></span></a>
</div>
</div>

</div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_answer);

mysql_free_result($rs_question);
?>
