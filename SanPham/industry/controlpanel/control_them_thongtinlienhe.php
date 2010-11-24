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
$formValidation->addField("ct_info_fullname", true, "text", "", "", "", "<?php echo vuilongnhaphoten;?>");
$formValidation->addField("ct_info_address", true, "text", "", "", "", "
<?php echo vuilongnhapdiachi;?>");
$formValidation->addField("ct_info_email", false, "text", "email", "", "", "");
$formValidation->addField("ct_info_tel", false, "text", "phone", "", "", "");
$formValidation->addField("ct_info_mobile", false, "text", "phone", "", "", "");
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

$colname_rs_company = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_company = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_company = sprintf("SELECT company_name_EN FROM company WHERE company_id_member = %s ORDER BY company_name ASC", GetSQLValueString($colname_rs_company, "int"));
$rs_company = mysql_query($query_rs_company, $ketnoi) or die(mysql_error());
$row_rs_company = mysql_fetch_assoc($rs_company);
$totalRows_rs_company = mysql_num_rows($rs_company);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department WHERE type = 'member' AND visible=1";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_position = "SELECT id_position, position_name FROM `position` ORDER BY sort ASC";
$rs_position = mysql_query($query_rs_position, $ketnoi) or die(mysql_error());
$row_rs_position = mysql_fetch_assoc($rs_position);
$totalRows_rs_position = mysql_num_rows($rs_position);

$colname_rs_member_contact = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member_contact = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_contact = sprintf("SELECT id_member, member_id_country, member_name_EN, member_sex, member_email, member_address, member_tell, member_fax, member_kind FROM member WHERE id_member = %s", GetSQLValueString($colname_rs_member_contact, "int"));
$rs_member_contact = mysql_query($query_rs_member_contact, $ketnoi) or die(mysql_error());
$row_rs_member_contact = mysql_fetch_assoc($rs_member_contact);
$totalRows_rs_member_contact = mysql_num_rows($rs_member_contact);

// Make an insert transaction instance
$ins_contact_information = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_contact_information);
// Register triggers
$ins_contact_information->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_contact_information->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_contact_information->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=fct_info");
// Add columns
$ins_contact_information->setTable("contact_information");
$ins_contact_information->addColumn("ct_info_company", "NUMERIC_TYPE", "POST", "ct_info_company", "{rs_company.company_name}");
$ins_contact_information->addColumn("ct_info_fullname", "STRING_TYPE", "POST", "ct_info_fullname");
$ins_contact_information->addColumn("ct_info_department", "NUMERIC_TYPE", "POST", "ct_info_department");
$ins_contact_information->addColumn("ct_info_position", "NUMERIC_TYPE", "POST", "ct_info_position");
$ins_contact_information->addColumn("ct_info_address", "STRING_TYPE", "POST", "ct_info_address", "{rs_member_contact.member_address}");
$ins_contact_information->addColumn("ct_info_email", "STRING_TYPE", "POST", "ct_info_email", "{rs_member_contact.member_email}");
$ins_contact_information->addColumn("ct_info_tel", "STRING_TYPE", "POST", "ct_info_tel", "{rs_member_contact.member_tell}");
$ins_contact_information->addColumn("ct_info_fax", "STRING_TYPE", "POST", "ct_info_fax");
$ins_contact_information->addColumn("ct_info_mobile", "STRING_TYPE", "POST", "ct_info_mobile");
$ins_contact_information->addColumn("ct_info_website", "STRING_TYPE", "POST", "ct_info_website");
$ins_contact_information->addColumn("ct_info_id_member", "NUMERIC_TYPE", "POST", "ct_info_id_member", "{SESSION.kt_login_id}");
$ins_contact_information->setPrimaryKey("id_contact_information", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscontact_information = $tNGs->getRecordset("contact_information");
$row_rscontact_information = mysql_fetch_assoc($rscontact_information);
$totalRows_rscontact_information = mysql_num_rows($rscontact_information);
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
<?php  ghichu(); ?>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table id="khung" cellpadding="2" cellspacing="0" class="KT_tngtable">
    <?php 
// Show IF Conditional region1 
if (@$row_rs_member_contact['member_kind'] == "business") {
?>
      <tr>
        <td><label for="ct_info_company"><?php echo tencongty;?>:</label></td>
        <td><input type="text" name="ct_info_company" id="ct_info_company" value="<?php echo $row_rs_company['company_name_EN']; ?>" size="32" />
            <?php echo $tNGs->displayFieldHint("ct_info_company");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_company"); ?> </td>
      </tr>
      <?php } 
// endif Conditional region1
?>
    <tr>
      <td><label for="ct_info_fullname"><?php echo hoten;?>:</label></td>
      <td><input type="text" name="ct_info_fullname" id="ct_info_fullname" value="<?php echo $row_rs_member_contact['member_name_EN']; ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_fullname");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_fullname"); ?> </td>
    </tr>
    <?php 
// Show IF Conditional region3 
if (@$row_rs_member_contact['member_kind'] == "business") {
?>
      <tr>
        <td><label for="ct_info_department"><?php echo bophanlienhe;?>::</label></td>
        <td><select name="ct_info_department" id="ct_info_department">
            <option value="" <?php if (!(strcmp("", $row_rscontact_information['ct_info_department']))) {echo "selected=\"selected\"";} ?>><?php echo chon;?></option>
            <?php
do {  
?>
          <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rscontact_information['ct_info_department']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_contact_department['name']?></option>
            <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
          </select>
            <?php echo $tNGs->displayFieldError("contact_information", "ct_info_department"); ?> </td>
      </tr>
      <?php } 
// endif Conditional region3
?>
    <?php 
// Show IF Conditional region2 
if (@$row_rs_member_contact['member_kind'] == "business") {
?>
      <tr>
        <td><label for="ct_info_position"><?php echo chucvu;?>:</label></td>
        <td><select name="ct_info_position" id="ct_info_position">
            <option value="" <?php if (!(strcmp("", $row_rscontact_information['ct_info_position']))) {echo "selected=\"selected\"";} ?>><?php echo chon;?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_rs_position['id_position']?>"<?php if (!(strcmp($row_rs_position['id_position'], $row_rscontact_information['ct_info_position']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_position['position_name']?></option>
            <?php
} while ($row_rs_position = mysql_fetch_assoc($rs_position));
  $rows = mysql_num_rows($rs_position);
  if($rows > 0) {
      mysql_data_seek($rs_position, 0);
	  $row_rs_position = mysql_fetch_assoc($rs_position);
  }
?>
          </select>
            <?php echo $tNGs->displayFieldError("contact_information", "ct_info_position"); ?> </td>
      </tr>
      <?php } 
// endif Conditional region2
?>
    <tr>
      <td><label for="ct_info_address"><?php echo diachi;?>:</label></td>
      <td><input type="text" name="ct_info_address" id="ct_info_address" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_address']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_address");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_address"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_email"><?php echo email;?>:</label></td>
      <td><input type="text" name="ct_info_email" id="ct_info_email" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_email");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_email"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_tel"><?php echo dienthoai;?>:</label></td>
      <td><input type="text" name="ct_info_tel" id="ct_info_tel" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_tel']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_tel");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_tel"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_fax"><?php echo fax;?>:</label></td>
      <td><input type="text" name="ct_info_fax" id="ct_info_fax" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_fax']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_fax");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_fax"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_mobile"><?php echo didong;?>:</label></td>
      <td><input type="text" name="ct_info_mobile" id="ct_info_mobile" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_mobile']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_mobile");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_mobile"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_website"><?php echo website;?>:</label></td>
      <td><input type="text" name="ct_info_website" id="ct_info_website" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_website']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("ct_info_website");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_website"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo themmoi;?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="ct_info_id_member" id="ct_info_id_member" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_id_member']); ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_company);

mysql_free_result($rs_contact_department);

mysql_free_result($rs_position);

mysql_free_result($rs_member_contact);
?>
