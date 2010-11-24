<?php require_once('../Connections/ketnoi.php'); ?>
<?php
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

$maxRows_rs_answer = 10;
$pageNum_rs_answer = 0;
if (isset($_GET['pageNum_rs_answer'])) {
  $pageNum_rs_answer = $_GET['pageNum_rs_answer'];
}
$startRow_rs_answer = $pageNum_rs_answer * $maxRows_rs_answer;

$get_id_question_rs_answer = "5";
if (isset($_GET['iquestion'])) {
  $get_id_question_rs_answer = $_GET['iquestion'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_answer = sprintf("SELECT id_answer, answer_id_question, answer_id_member, answer_content, answer_day_update,member_name,member_email FROM answer,member WHERE answer_id_question=%s AND answer_id_member=id_member AND answer_visible = 1 ORDER BY answer_day_update DESC", GetSQLValueString($get_id_question_rs_answer, "int"));
$query_limit_rs_answer = sprintf("%s LIMIT %d, %d", $query_rs_answer, $startRow_rs_answer, $maxRows_rs_answer);
$rs_answer = mysql_query($query_limit_rs_answer, $ketnoi) or die(mysql_error());
$row_rs_answer = mysql_fetch_assoc($rs_answer);

if (isset($_GET['totalRows_rs_answer'])) {
  $totalRows_rs_answer = $_GET['totalRows_rs_answer'];
} else {
  $all_rs_answer = mysql_query($query_rs_answer);
  $totalRows_rs_answer = mysql_num_rows($all_rs_answer);
}
$totalPages_rs_answer = ceil($totalRows_rs_answer/$maxRows_rs_answer)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../library/css/style.css" type="text/css" rel="stylesheet" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="khung_answer">
	<div class="answer_list" style="background-color:#F7F7F7; margin-left:3px;">* <?php echo traloicauhoi;?> </div>
	<?php do { ?>
	  <div class="khung_answer1">
	    <div class="answer_list">
	      <div class="contact_info"><?php echo $row_rs_answer['member_name']; ?> | <?php echo $row_rs_answer['member_email']; ?></div>
       	    <div class="day_update"><?php echo $row_rs_answer['answer_day_update']; ?></div>
          </div>
          <div class="answer_list"><?php echo $row_rs_answer['answer_content']; ?></div>
          </div>
	  <?php } while ($row_rs_answer = mysql_fetch_assoc($rs_answer)); ?></div>

</body>
</html>
<?php
mysql_free_result($rs_answer);
?>
