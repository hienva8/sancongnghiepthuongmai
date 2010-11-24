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
$formValidation->addField("ct_info_fullname", true, "text", "", "", "", "Please enter full name");
$formValidation->addField("ct_info_email", false, "text", "email", "", "", "");
$formValidation->addField("ct_info_address", true, "text", "", "", "", "Please enter your address");
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

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT company_name, id_company FROM company ORDER BY company_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_position = "SELECT id_position, position_name FROM `position` ORDER BY sort ASC";
$rs_position = mysql_query($query_rs_position, $ketnoi) or die(mysql_error());
$row_rs_position = mysql_fetch_assoc($rs_position);
$totalRows_rs_position = mysql_num_rows($rs_position);

// Make an update transaction instance
$upd_contact_information = new tNG_update($conn_ketnoi);
$tNGs->addTransaction($upd_contact_information);
// Register triggers
$upd_contact_information->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_contact_information->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_contact_information->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=fct_info");
// Add columns
$upd_contact_information->setTable("contact_information");
$upd_contact_information->addColumn("ct_info_fullname", "STRING_TYPE", "POST", "ct_info_fullname");
$upd_contact_information->addColumn("ct_info_company", "STRING_TYPE", "POST", "ct_info_company");
$upd_contact_information->addColumn("ct_info_department", "NUMERIC_TYPE", "POST", "ct_info_department");
$upd_contact_information->addColumn("ct_info_position", "NUMERIC_TYPE", "POST", "ct_info_position");
$upd_contact_information->addColumn("ct_info_email", "STRING_TYPE", "POST", "ct_info_email");
$upd_contact_information->addColumn("ct_info_address", "STRING_TYPE", "POST", "ct_info_address");
$upd_contact_information->addColumn("ct_info_tel", "STRING_TYPE", "POST", "ct_info_tel");
$upd_contact_information->addColumn("ct_info_mobile", "STRING_TYPE", "POST", "ct_info_mobile");
$upd_contact_information->addColumn("ct_info_fax", "STRING_TYPE", "POST", "ct_info_fax");
$upd_contact_information->addColumn("ct_info_website", "STRING_TYPE", "POST", "ct_info_website");
$upd_contact_information->setPrimaryKey("ct_info_id_member", "NUMERIC_TYPE", "SESSION", "kt_login_id");

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
  <table id="khung" style="margin-left:200px;" cellpadding="2" cellspacing="0" class="KT_tngtable">
    <?php 
// Show IF Conditional region1 
if (@$row_rscontact_information['ct_info_company'] != "") {
?>
      <tr>
        <td><label for="ct_info_company"><?php echo tencongty;?>:</label></td>
        <td><input name="ct_info_company" type="text" id="ct_info_company" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_company']); ?>" size="50" maxlength="200" />
            <?php echo $tNGs->displayFieldHint("ct_info_company");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_company"); ?> </td>
      </tr>
      <?php } 
// endif Conditional region1
?>
    <tr>
      <td><label for="ct_info_fullname"><?php echo hoten;?>:</label></td>
      <td><input name="ct_info_fullname" type="text" id="ct_info_fullname" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_fullname']); ?>" size="32" maxlength="60" />
          <?php echo $tNGs->displayFieldHint("ct_info_fullname");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_fullname"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_department"><?php echo bophanlienhe;?>::</label></td>
      <td><select name="ct_info_department" id="ct_info_department">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rscontact_information['ct_info_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
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
    <?php 
// Show IF Conditional region2 
if (@$row_rscontact_information['ct_info_position'] != "") {
?>
      <tr>
        <td><label for="ct_info_position"><?php echo chucvu;?>:</label></td>
        <td><select name="ct_info_position" id="ct_info_position">
            <?php 
do {  
?>
            <option value="<?php echo $row_rs_position['id_position']?>"<?php if (!(strcmp($row_rs_position['id_position'], $row_rscontact_information['ct_info_position']))) {echo "SELECTED";} ?>><?php echo $row_rs_position['position_name']?></option>
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
      <td><label for="ct_info_email"><?php echo email;?>:</label></td>
      <td><input name="ct_info_email" type="text" id="ct_info_email" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_email']); ?>" size="32" maxlength="60" />
          <?php echo $tNGs->displayFieldHint("ct_info_email");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_email"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_address"><?php echo diachi;?>:</label></td>
      <td><input name="ct_info_address" type="text" id="ct_info_address" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_address']); ?>" size="50" maxlength="200" />
          <?php echo $tNGs->displayFieldHint("ct_info_address");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_address"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_tel"><?php echo dienthoai;?>:</label></td>
      <td><input name="ct_info_tel" type="text" id="ct_info_tel" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_tel']); ?>" size="32" maxlength="20" />
          <?php echo $tNGs->displayFieldHint("ct_info_tel");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_tel"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_fax"><?php echo fax;?>:</label></td>
      <td><input name="ct_info_fax" type="text" id="ct_info_fax" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_fax']); ?>" size="32" maxlength="20" />
          <?php echo $tNGs->displayFieldHint("ct_info_fax");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_fax"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_mobile"><?php echo didong;?>:</label></td>
      <td><input name="ct_info_mobile" type="text" id="ct_info_mobile" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_mobile']); ?>" size="32" maxlength="20" />
          <?php echo $tNGs->displayFieldHint("ct_info_mobile");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_mobile"); ?> </td>
    </tr>
    <tr>
      <td><label for="ct_info_website"><?php echo website;?>:</label></td>
      <td><input name="ct_info_website" type="text" id="ct_info_website" value="<?php echo KT_escapeAttribute($row_rscontact_information['ct_info_website']); ?>" size="40" maxlength="50" />
          <?php echo $tNGs->displayFieldHint("ct_info_website");?> <?php echo $tNGs->displayFieldError("contact_information", "ct_info_website"); ?> </td>
    </tr>

    <tr class="KT_buttons">
      <td colspan="2" class="bottom_background"><input type="submit" name="KT_Update1" id="KT_Update1" value="<?php echo capnhat;?>" />
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rs_contact_department);

mysql_free_result($rs_position);
?>