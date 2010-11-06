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
$formValidation->addField("yourname", true, "text", "", "", "", "");
$formValidation->addField("yourmail", false, "text", "email", "", "", "");
$formValidation->addField("yourfriendmail", true, "text", "email", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_SendEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_SendEmail(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{yourmail}");
  $emailObj->setTo("{yourfriendmail}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("{title}");
  //WriteContent method
  $emailObj->setContent("Full name: {yourname}<br />\nContent: <br />\n{message}");
  $emailObj->setEncoding("UTF-8");
  $emailObj->setFormat("Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_SendEmail trigger

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

$colname_rs_thongtinlienhe = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_thongtinlienhe = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_thongtinlienhe = sprintf("SELECT ct_info_fullname, ct_info_company, ct_info_email FROM contact_information WHERE ct_info_id_member = %s", GetSQLValueString($colname_rs_thongtinlienhe, "int"));
$rs_thongtinlienhe = mysql_query($query_rs_thongtinlienhe, $ketnoi) or die(mysql_error());
$row_rs_thongtinlienhe = mysql_fetch_assoc($rs_thongtinlienhe);
$totalRows_rs_thongtinlienhe = mysql_num_rows($rs_thongtinlienhe);

// Make a custom transaction instance
$customTransaction = new tNG_custom($conn_ketnoi);
$tNGs->addTransaction($customTransaction);
// Register triggers
$customTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Custom1");
$customTransaction->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$customTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=sendmailok");
$customTransaction->registerTrigger("AFTER", "Trigger_SendEmail", 98);
// Add columns
$customTransaction->addColumn("yourname", "STRING_TYPE", "POST", "yourname", "{rs_thongtinlienhe.ct_info_fullname}");
$customTransaction->addColumn("yourmail", "STRING_TYPE", "POST", "yourmail", "{rs_thongtinlienhe.ct_info_email}");
$customTransaction->addColumn("yourfriendmail", "STRING_TYPE", "POST", "yourfriendmail");
$customTransaction->addColumn("title", "STRING_TYPE", "POST", "title");
$customTransaction->addColumn("message", "STRING_TYPE", "POST", "message");
// End of custom transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
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
<?php
	echo $tNGs->getErrorMsg();
?>
<form action="index.php?mod=sendmailok" method="POST" enctype="application/x-www-form-urlencoded" name="form1" id="form1">
  <table id="khung_soanthu" cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td><label for="yourname"><?php echo tencuaban;?>:</label></td>
	<td>
		<input type="text" name="yourname" id="yourname" value="<?php echo KT_escapeAttribute($row_rscustom['yourname']); ?>" size="32" />
		<?php echo $tNGs->displayFieldHint("yourname");?> <?php echo $tNGs->displayFieldError("custom", "yourname"); ?> </label></td>
    </tr>
    <tr>
      <td><label for="yourmail"><?php echo nguoigui;?>:</label></td>
      <td><input type="text" name="yourmail" id="yourmail" value="<?php echo KT_escapeAttribute($row_rscustom['yourmail']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("yourmail");?> <?php echo $tNGs->displayFieldError("custom", "yourmail"); ?> </td>
    </tr>
    <tr>
      <td><label for="yourfriendmail"><?php echo nguoinhan;?>:</label></td>
      <td><input type="text" name="yourfriendmail" id="yourfriendmail" value="<?php echo KT_escapeAttribute($row_rscustom['yourfriendmail']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("yourfriendmail");?> <?php echo $tNGs->displayFieldError("custom", "yourfriendmail"); ?> </td>
    </tr>
    <tr>
      <td><label for="title"><?php echo tieude;?>:</label></td>
      <td><input type="text" name="title" id="title" value="<?php echo KT_escapeAttribute($row_rscustom['title']); ?>" size="50" />
          <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("custom", "title"); ?> </td>
    </tr>
    <tr>
      <td><label for="message"><?php echo noidung;?>:</label></td>
      <td><textarea name="message" id="message" cols="70" rows="10"><?php echo KT_escapeAttribute($row_rscustom['message']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("message");?> <?php echo $tNGs->displayFieldError("custom", "message"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Custom1" id="KT_Custom1" value="<?php echo guithu;?>" />
      <input type="hidden"  name="kt_login_id" id="kt_login_id" value="<?php echo $_SESSION['kt_login_id'];?>" />
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_thongtinlienhe);
?>
