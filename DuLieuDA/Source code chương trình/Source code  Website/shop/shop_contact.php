<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("inbox_recipient", true, "numeric", "", "", "", "");
//$formValidation->addField("inbox_sender", true, "numeric", "", "", "", "");
$formValidation->addField("inbox_email", false, "text", "email", "", "", "");
$formValidation->addField("inbox_address", true, "text", "", "", "", "");
$formValidation->addField("inbox_tel", false, "text", "phone", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start CheckCaptcha trigger
//remove this line if you want to edit the code by hand
function CheckCaptcha(&$tNG) {
	$captcha = new tNG_Captcha("captcha_id_id", $tNG);
	$captcha->setFormField("POST", "captcha_id");
	$captcha->setErrorMsg("vui lòng nhập mã bão mật");
	return $captcha->Execute();
}
//end CheckCaptcha trigger

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
$linkcurrent= $_SERVER['PHP_SELF'];
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = "SELECT id_member, member_user FROM member";
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);

$get_id_member_rs_company = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_company = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_company = sprintf("SELECT company_name FROM company WHERE company_id_member = %s", GetSQLValueString($get_id_member_rs_company, "int"));
$rs_company = mysql_query($query_rs_company, $ketnoi) or die(mysql_error());
$row_rs_company = mysql_fetch_assoc($rs_company);
$totalRows_rs_company = mysql_num_rows($rs_company);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department ORDER BY sort ASC";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

$get_id_product_rs_product = "-1";
if (isset($_GET['ip'])) {
  $get_id_product_rs_product = $_GET['ip'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_product = sprintf("SELECT product_name FROM products WHERE id_products = %s", GetSQLValueString($get_id_product_rs_product, "int"));
$rs_product = mysql_query($query_rs_product, $ketnoi) or die(mysql_error());
$row_rs_product = mysql_fetch_assoc($rs_product);
$totalRows_rs_product = mysql_num_rows($rs_product);

$session_sender_rs_sender = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $session_sender_rs_sender = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_sender = sprintf("SELECT company_name,member_email,member_address,member_tell FROM (member LEFT JOIN company ON id_member=company_id_member) WHERE id_member = %s", GetSQLValueString($session_sender_rs_sender, "int"));
$rs_sender = mysql_query($query_rs_sender, $ketnoi) or die(mysql_error());
$row_rs_sender = mysql_fetch_assoc($rs_sender);
$totalRows_rs_sender = mysql_num_rows($rs_sender);

// Make an insert transaction instance
$ins_inbox = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_inbox);
// Register triggers
$ins_inbox->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_inbox->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_inbox->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=contactok&imb=$get_id_member_rs_company");
$ins_inbox->registerTrigger("BEFORE", "CheckCaptcha", 10);
// Add columns
$ins_inbox->setTable("inbox");
$ins_inbox->addColumn("inbox_recipient", "NUMERIC_TYPE", "VALUE", "$get_id_member_rs_company");
$ins_inbox->addColumn("box_contact_department", "NUMERIC_TYPE", "POST", "box_contact_department");
$ins_inbox->addColumn("inbox_name_product", "STRING_TYPE", "POST", "inbox_name_product");
$ins_inbox->addColumn("inbox_sender", "NUMERIC_TYPE", "VALUE", "{SESSION.kt_login_id}");
$ins_inbox->addColumn("inbox_email", "STRING_TYPE", "POST", "inbox_email");
$ins_inbox->addColumn("inbox_address", "STRING_TYPE", "POST", "inbox_address");
$ins_inbox->addColumn("inbox_tel", "STRING_TYPE", "POST", "inbox_tel");
$ins_inbox->addColumn("inbox_subject", "STRING_TYPE", "POST", "inbox_subject");
$ins_inbox->addColumn("inbox_content", "STRING_TYPE", "POST", "inbox_content");
$ins_inbox->addColumn("inbox_day_update", "DATE_TYPE", "POST", "inbox_day_update", "{NOW_DT}");
$ins_inbox->setPrimaryKey("id_inbox", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsinbox = $tNGs->getRecordset("inbox");
$row_rsinbox = mysql_fetch_assoc($rsinbox);
$totalRows_rsinbox = mysql_num_rows($rsinbox);

// Captcha Image
$captcha_id_obj = new KT_CaptchaImage("captcha_id_id");
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
  mxi_includes_start("shop_info_contact.php");
  require(basename("shop_info_contact.php"));
  mxi_includes_end();
?>
<fieldset class="fieldset_khung"><legend><?php echo lienhecongty;?></legend>

<?php if($_SESSION['kt_login_id'])
{?>
  <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table cellpadding="0" cellspacing="0" class="KT_tngtable" width="96%">
      <tr>
        <td><?php echo nguoinhan;?>:</td>
        <td><?php echo $row_rs_company['company_name']; ?></td>
      </tr>
      <tr>
        <td><label for="box_contact_department"><?php echo bophanlienhe;?>:</label></td>
        <td><select name="box_contact_department" id="box_contact_department">
            <?php 
do {  
?>
            <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rsinbox['box_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
            <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
            </select>
            <?php echo $tNGs->displayFieldError("inbox", "box_contact_department"); ?> </td>
      </tr>
      <?php if ($totalRows_rs_product > 0) { // Show if recordset not empty ?>
        <tr>
          <td><?php echo sanphamlienhe;?>:</td>
          <td><input name="inbox_name_product" type="text" id="inbox_name_product" value="<?php echo $row_rs_product['product_name']; ?>" size="50" maxlength="100" /></td>
        </tr>
        <?php } // Show if recordset not empty ?>
      
      <tr>
        <td><label for="inbox_email"><?php echo email;?>:</label></td>
        <td><input type="text" name="inbox_email" id="inbox_email" value="<?php echo $row_rs_sender['member_email']; ?>" size="32" />
            <?php echo $tNGs->displayFieldHint("inbox_email");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_email"); ?> </td>
      </tr>
      <tr>
        <td><label for="inbox_address"><?php echo diachi ;?>:</label></td>
        <td><input type="text" name="inbox_address" id="inbox_address" value="<?php echo $row_rs_sender['member_address']; ?>" size="32" />
            <?php echo $tNGs->displayFieldHint("inbox_address");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_address"); ?> </td>
      </tr>
      <tr>
        <td><label for="inbox_tel"><?php echo dienthoai;?>:</label></td>
        <td><input type="text" name="inbox_tel" id="inbox_tel" value="<?php echo $row_rs_sender['member_tell']; ?>" size="32" />
            <?php echo $tNGs->displayFieldHint("inbox_tel");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_tel"); ?> </td>
      </tr>
      <tr>
        <td><label for="inbox_subject"><?php echo chude;?>:</label></td>
        <td><input name="inbox_subject" type="text" id="inbox_subject" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_subject']); ?>" size="70" maxlength="255" />
            <?php echo $tNGs->displayFieldHint("inbox_subject");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_subject"); ?> </td>
      </tr>
      <tr>
        <td><label for="inbox_content"><?php echo noidung;?>:</label></td>
        <td><textarea name="inbox_content" id="inbox_content" cols="70" rows="15"><?php echo KT_escapeAttribute($row_rsinbox['inbox_content']); ?></textarea>
            <?php echo $tNGs->displayFieldHint("inbox_content");?> <?php echo $tNGs->displayFieldError("inbox", "inbox_content"); ?> </td>
      </tr>
      <tr>
        <td><?php echo mabaomat;?> <span style="color:#B80501; font-weight:900;">*</span>:</td>
        <td><input type="text" name="captcha_id" id="captcha_id" value="" />
          <br />
          <span style="color:red;"><?php echo vuilongnhapmabaomattruockhigui;?>.</span><br />
        <img src="<?php echo $captcha_id_obj->getImageURL("../");?>" border="1"/></td>
      </tr>
      <tr class="KT_buttons">
        <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo gui;?>" />        </td>
      </tr>
    </table>
    <input type="hidden" name="inbox_sender" id="inbox_sender" value="<?php echo KT_escapeAttribute($row_rsinbox['inbox_sender']); ?>" />
    <input type="hidden" name="inbox_day_update" id="inbox_day_update" value="<?php echo KT_formatDate($row_rsinbox['inbox_day_update']); ?>" />
      </form>
<?php } else {echo banphailathanhvien."<a href='index.php?mod=register'>".dangki."</a>"; }
?>
</fieldset>
</body>
</html>
<?php
mysql_free_result($rs_member);

mysql_free_result($rs_company);

mysql_free_result($rs_contact_department);

mysql_free_result($rs_product);

mysql_free_result($rs_sender);
?>