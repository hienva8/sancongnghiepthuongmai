<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("member_name", true, "text", "", "", "", "Vui lòng nhập họ tên bạn.");
$formValidation->addField("id_country", true, "numeric", "", "", "", "Vui lòng chọn quốc tịch.");
$formValidation->addField("address", true, "text", "", "", "", "Vui lòng nhập địa chỉ bạn.");
$formValidation->addField("email", false, "text", "email", "", "", "");
$formValidation->addField("tel", false, "text", "phone", "", "", "");
$formValidation->addField("id_contact_department", true, "numeric", "", "", "", "Vui lòng chọn bộ phận liên hệ");
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

$colname_rs_comp_member = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_comp_member = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_comp_member = sprintf("SELECT company_name, company_address,member_name,member_id_country,member_address,member_email,member_tell,member_fax,id_country,country_name FROM company,member,country WHERE company_id_member = %s AND id_member=%s AND member_id_country=id_country", GetSQLValueString($colname_rs_comp_member, "int"),GetSQLValueString($colname_rs_comp_member, "int"));
$rs_comp_member = mysql_query($query_rs_comp_member, $ketnoi) or die(mysql_error());
$row_rs_comp_member = mysql_fetch_assoc($rs_comp_member);
$totalRows_rs_comp_member = mysql_num_rows($rs_comp_member);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department WHERE type = 'member' ORDER BY sort ASC";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

// Make an insert transaction instance
$ins_customer_contact = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_customer_contact);
// Register triggers
$ins_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_customer_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=contactok");
// Add columns
$ins_customer_contact->setTable("customer_contact");
$ins_customer_contact->addColumn("company_name", "STRING_TYPE", "POST", "company_name","{rs_comp_member.company_name}");
$ins_customer_contact->addColumn("company_address", "STRING_TYPE", "POST", "company_address", "{rs_comp_member.company_address}");
$ins_customer_contact->addColumn("member_name", "STRING_TYPE", "POST", "member_name", "{rs_comp_member.member_name}");
$ins_customer_contact->addColumn("id_country", "NUMERIC_TYPE", "POST", "id_country", "{rs_comp_member.member_id_country}");
$ins_customer_contact->addColumn("address", "STRING_TYPE", "POST", "address", "{rs_comp_member.member_address}");
$ins_customer_contact->addColumn("email", "STRING_TYPE", "POST", "email", "{rs_comp_member.member_email}");
$ins_customer_contact->addColumn("tel", "STRING_TYPE", "POST", "tel", "{rs_comp_member.member_tell}");
$ins_customer_contact->addColumn("fax", "STRING_TYPE", "POST", "fax", "{rs_comp_member.member_fax}");
$ins_customer_contact->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_customer_contact->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_customer_contact->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$ins_customer_contact->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustomer_contact = $tNGs->getRecordset("customer_contact");
$row_rscustomer_contact = mysql_fetch_assoc($rscustomer_contact);
$totalRows_rscustomer_contact = mysql_num_rows($rscustomer_contact);

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
<form action="../index.php?mod=contactok" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable" style="border:ridge 1px #99CCFF">
    <tr>
      <td width="80"><label for="company_name"><?php echo diachicongty;?> :</label></td>
      <td><input type="text" name="company_name" id="company_address" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['company_name']); ?>" size="50" />
          <?php echo $tNGs->displayFieldHint("company_name");?> <?php echo $tNGs->displayFieldError("customer_contact", "company_name"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="company_address"><?php echo diachicongty;?> :</label></td>
      <td><input type="text" name="company_address" id="company_address" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['company_address']); ?>" size="70" />
          <?php echo $tNGs->displayFieldHint("company_address");?> <?php echo $tNGs->displayFieldError("customer_contact", "company_address"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="member_name"><?php echo hoten;?> :</label></td>
      <td><input type="text" name="member_name" id="member_name" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['member_name']); ?>" size="50" />
          <?php echo $tNGs->displayFieldHint("member_name");?> <?php echo $tNGs->displayFieldError("customer_contact", "member_name"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="id_country"><?php echo quoctich;?> :</label></td>
      <td><select name="id_country" id="id_country">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], $row_rscustomer_contact['id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name']?></option>
        <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("customer_contact", "id_country"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="address"><?php echo diachi;?> :</label></td>
      <td><input type="text" name="address" id="address" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['address']); ?>" size="70" />
          <?php echo $tNGs->displayFieldHint("address");?> <?php echo $tNGs->displayFieldError("customer_contact", "address"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="email"><?php echo email;?> :</label></td>
      <td><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("customer_contact", "email"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="tel"><?php echo dienthoai;?> :</label></td>
      <td><input type="text" name="tel" id="tel" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['tel']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("tel");?> <?php echo $tNGs->displayFieldError("customer_contact", "tel"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="fax"><?php echo fax;?> :</label></td>
      <td><input type="text" name="fax" id="fax" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['fax']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("fax");?> <?php echo $tNGs->displayFieldError("customer_contact", "fax"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="title"><?php echo vandelienhe;?> :</label></td>
      <td><input type="text" name="title" id="title" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['title']); ?>" size="70" />
          <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("customer_contact", "title"); ?> </td>
    </tr>
    <tr>
      <td colspan="2"><label for="content"><?php echo noidung;?> :</label></td>
    </tr>
      <tr>
      <td colspan="2"><textarea name="content" id="content" cols="50" rows="10" style="width:530px; background-color:#FFFFF0"><?php echo KT_escapeAttribute($row_rscustomer_contact['content']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("customer_contact", "content"); ?> </td>
    </tr>
    <tr>
      <td width="80"><label for="id_contact_department"><?php echo bophanlienhe;?> :</label></td>
      <td><select name="id_contact_department" id="id_contact_department">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rscustomer_contact['id_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
        <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("customer_contact", "id_contact_department"); ?> </td>
    </tr>
        <tr>
      <td width="80"><label for="mabaomat"><?php echo mabaomat;?> :</label></td>
      <td><br />
<?php echo vuilongnhapmabaomattruockhigui;?>.<br /></td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo gui;?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="day_update" id="day_update" value="<?php echo KT_formatDate($row_rscustomer_contact['day_update']); ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($rs_comp_member);

mysql_free_result($rs_contact_department);

mysql_free_result($rs_country);
?>