<?php require_once('../Connections/ketnoi.php'); ?><?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Passwords do not match.");
  $myThrowError->setField("member_password");
  $myThrowError->setFieldErrorMsg("The two passwords do not match.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

//start Trigger_WelcomeEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_WelcomeEmail(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{KT_defaultSender}");
  $emailObj->setTo("{member_email}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("Welcome");
  //FromFile method
  $emailObj->setContentFile("includes/mailtemplates/welcome.html");
  $emailObj->setEncoding("UTF-8");
  $emailObj->setFormat("HTML/Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_WelcomeEmail trigger

//start Trigger_ActivationEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_ActivationEmail(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{KT_defaultSender}");
  $emailObj->setTo("{member_email}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("Activation");
  //FromFile method
  $emailObj->setContentFile("includes/mailtemplates/activate.html");
  $emailObj->setEncoding("UTF-8");
  $emailObj->setFormat("HTML/Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_ActivationEmail trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("member_user", true, "text", "", "", "", "Please enter a username.");
$formValidation->addField("member_password", true, "text", "", "", "", "Please enter a password.");
$formValidation->addField("member_id_country", true, "numeric", "", "", "", "Please choose your country");
$formValidation->addField("member_name", true, "text", "", "", "", "Please enter full name.");
$formValidation->addField("member_email", true, "text", "email", "", "", "Please enter your email");
$formValidation->addField("member_address", true, "text", "", "", "", "Please enter your address.");
$formValidation->addField("member_tell", true, "text", "phone", "", "", "Please enter your phone.");
$formValidation->addField("member_kind", true, "numeric", "", "", "", "Please choose kind member");
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
$query_rs_country = "SELECT id_country, country_name, country_name_EN FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

// Make an insert transaction instance
$userRegistration = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($userRegistration);
// Register triggers
$userRegistration->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$userRegistration->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$userRegistration->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=register_success");
$userRegistration->registerConditionalTrigger("{POST.member_password} != {POST.re_member_password}", "BEFORE", "Trigger_CheckPasswords", 50);
$userRegistration->registerTrigger("AFTER", "Trigger_WelcomeEmail", 40);
$userRegistration->registerTrigger("AFTER", "Trigger_ActivationEmail", 40);
// Add columns
$userRegistration->setTable("member");
$userRegistration->addColumn("member_user", "STRING_TYPE", "POST", "member_user");
$userRegistration->addColumn("member_password", "STRING_TYPE", "POST", "member_password");
$userRegistration->addColumn("member_id_country", "NUMERIC_TYPE", "POST", "member_id_country");
$userRegistration->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$userRegistration->addColumn("member_sex", "NUMERIC_TYPE", "POST", "member_sex");
$userRegistration->addColumn("member_email", "STRING_TYPE", "POST", "member_email");
$userRegistration->addColumn("member_address", "STRING_TYPE", "POST", "member_address");
$userRegistration->addColumn("member_tell", "STRING_TYPE", "POST", "member_tell");
$userRegistration->addColumn("member_fax", "STRING_TYPE", "POST", "member_fax");
$userRegistration->addColumn("member_kind", "NUMERIC_TYPE", "POST", "member_kind");
$userRegistration->addColumn("member_maillisting", "CHECKBOX_1_0_TYPE", "POST", "member_maillisting", "0");
$userRegistration->addColumn("member_day_update", "DATE_TYPE", "POST", "member_day_update", "{NOW_DT}");
$userRegistration->setPrimaryKey("id_member", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmember = $tNGs->getRecordset("member");
$row_rsmember = mysql_fetch_assoc($rsmember);
$totalRows_rsmember = mysql_num_rows($rsmember);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?>
</head>

<body>

<?php
	echo $tNGs->getErrorMsg();
?>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="member_user">User name:</label></td>
      <td><input type="text" name="member_user" id="member_user" value="<?php echo KT_escapeAttribute($row_rsmember['member_user']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_user");?> <?php echo $tNGs->displayFieldError("member", "member_user"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_password">Password:</label></td>
      <td><input type="password" name="member_password" id="member_password" value="" size="32" />
          <?php echo $tNGs->displayFieldHint("member_password");?> <?php echo $tNGs->displayFieldError("member", "member_password"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="re_member_password">Re-type Password:</label></td>
      <td><input type="password" name="re_member_password" id="re_member_password" value="" size="32" />
      </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_id_country">Member_id_country:</label></td>
      <td><select name="member_id_country" id="member_id_country">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], $row_rsmember['member_id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name']?></option>
        <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member", "member_id_country"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_name">Full name:</label></td>
      <td><input type="text" name="member_name" id="member_name" value="<?php echo KT_escapeAttribute($row_rsmember['member_name']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_name");?> <?php echo $tNGs->displayFieldError("member", "member_name"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_sex_1">Member:</label></td>
      <td><div>
        <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"1"))) {echo "CHECKED";} ?> type="radio" name="member_sex" id="member_sex_1" value="1" checked="checked"/>
        <label for="member_sex_1">Mr</label>
      </div>
          <div>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"2"))) {echo "CHECKED";} ?> type="radio" name="member_sex" id="member_sex_2" value="2" />
            <label for="member_sex_2">Miss/Mrs</label>
          </div>
        <div>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"3"))) {echo "CHECKED";} ?> type="radio" name="member_sex" id="member_sex_3" value="3" />
            <label for="member_sex_3">Orther</label>
          </div>
        <?php echo $tNGs->displayFieldError("member", "member_sex"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_email">Email:</label></td>
      <td><input type="text" name="member_email" id="member_email" value="<?php echo KT_escapeAttribute($row_rsmember['member_email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_email");?> <?php echo $tNGs->displayFieldError("member", "member_email"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_address">Address:</label></td>
      <td><input type="text" name="member_address" id="member_address" value="<?php echo KT_escapeAttribute($row_rsmember['member_address']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_address");?> <?php echo $tNGs->displayFieldError("member", "member_address"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_tell">Phone:</label></td>
      <td><input type="text" name="member_tell" id="member_tell" value="<?php echo KT_escapeAttribute($row_rsmember['member_tell']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_tell");?> <?php echo $tNGs->displayFieldError("member", "member_tell"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_fax">Fax:</label></td>
      <td><input type="text" name="member_fax" id="member_fax" value="<?php echo KT_escapeAttribute($row_rsmember['member_fax']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_fax");?> <?php echo $tNGs->displayFieldError("member", "member_fax"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_kind_1">Kind:</label></td>
      <td><div>
        <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_kind']),"2"))) {echo "CHECKED";} ?> type="radio" name="member_kind" id="member_kind_1" value="2" checked="checked"/>
        <label for="member_kind_1">Công ty,Doanh nghiệp</label>
      </div>
          <div>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_kind']),"3"))) {echo "CHECKED";} ?> type="radio" name="member_kind" id="member_kind_2" value="3" />
            <label for="member_kind_2">Thành viên thường</label>
          </div>
        <?php echo $tNGs->displayFieldError("member", "member_kind"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="member_maillisting">Member_maillisting:</label></td>
      <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_maillisting']),"1"))) {echo "checked";} ?> type="checkbox" name="member_maillisting" id="member_maillisting" value="1" />
          <?php echo $tNGs->displayFieldError("member", "member_maillisting"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Register" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="member_day_update" id="member_day_update" value="<?php echo KT_formatDate($row_rsmember['member_day_update']); ?>" />
</form>
<p>&nbsp;</p>

</body>
</html><?php
mysql_free_result($rs_country);
?>
