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
$formValidation->addField("email", false, "text", "email", "", "", "Please enter email name is correct");
$formValidation->addField("tel", false, "text", "phone", "", "", "");
$formValidation->addField("id_contact_department", true, "numeric", "", "", "", "Please choose a contact department.");
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
$query_rs_contact_department = "SELECT id_contact_department, name FROM contact_department ORDER BY sort ASC";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT name, id_contact_department FROM contact_department ORDER BY name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

// Make an insert transaction instance
$ins_customer_contact = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_customer_contact);
// Register triggers
$ins_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_customer_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_customer_contact");
// Add columns
$ins_customer_contact->setTable("customer_contact");
$ins_customer_contact->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$ins_customer_contact->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$ins_customer_contact->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$ins_customer_contact->addColumn("id_country", "STRING_TYPE", "POST", "id_country");
$ins_customer_contact->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_customer_contact->addColumn("address", "STRING_TYPE", "POST", "address");
$ins_customer_contact->addColumn("tel", "STRING_TYPE", "POST", "tel");
$ins_customer_contact->addColumn("fax", "STRING_TYPE", "POST", "fax");
$ins_customer_contact->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_customer_contact->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$ins_customer_contact->addColumn("day_update", "DATE_TYPE", "POST", "day_update", "{NOW_DT}");
$ins_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_customer_contact = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_customer_contact);
// Register triggers
$upd_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_customer_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_customer_contact");
// Add columns
$upd_customer_contact->setTable("customer_contact");
$upd_customer_contact->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$upd_customer_contact->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$upd_customer_contact->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$upd_customer_contact->addColumn("id_country", "STRING_TYPE", "POST", "id_country");
$upd_customer_contact->addColumn("email", "STRING_TYPE", "POST", "email");
$upd_customer_contact->addColumn("address", "STRING_TYPE", "POST", "address");
$upd_customer_contact->addColumn("tel", "STRING_TYPE", "POST", "tel");
$upd_customer_contact->addColumn("fax", "STRING_TYPE", "POST", "fax");
$upd_customer_contact->addColumn("content", "STRING_TYPE", "POST", "content");
$upd_customer_contact->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$upd_customer_contact->addColumn("day_update", "DATE_TYPE", "POST", "day_update");
$upd_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE", "GET", "id_customer_contact");

// Make an instance of the transaction object
$del_customer_contact = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_customer_contact);
// Register triggers
$del_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_customer_contact");
// Add columns
$del_customer_contact->setTable("customer_contact");
$del_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE", "GET", "id_customer_contact");

// Make an insert transaction instance
$ins_customer_contact = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_customer_contact);
// Register triggers
$ins_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_customer_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_customer_contact");
// Add columns
$ins_customer_contact->setTable("customer_contact");
$ins_customer_contact->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$ins_customer_contact->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$ins_customer_contact->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$ins_customer_contact->addColumn("id_country", "STRING_TYPE", "POST", "id_country");
$ins_customer_contact->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_customer_contact->addColumn("address", "STRING_TYPE", "POST", "address");
$ins_customer_contact->addColumn("tel", "STRING_TYPE", "POST", "tel");
$ins_customer_contact->addColumn("fax", "STRING_TYPE", "POST", "fax");
$ins_customer_contact->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_customer_contact->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$ins_customer_contact->addColumn("day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_customer_contact = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_customer_contact);
// Register triggers
$upd_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_customer_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_customer_contact");
// Add columns
$upd_customer_contact->setTable("customer_contact");
$upd_customer_contact->addColumn("company_name", "STRING_TYPE", "POST", "company_name");
$upd_customer_contact->addColumn("company_address", "STRING_TYPE", "POST", "company_address");
$upd_customer_contact->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$upd_customer_contact->addColumn("id_country", "STRING_TYPE", "POST", "id_country");
$upd_customer_contact->addColumn("email", "STRING_TYPE", "POST", "email");
$upd_customer_contact->addColumn("address", "STRING_TYPE", "POST", "address");
$upd_customer_contact->addColumn("tel", "STRING_TYPE", "POST", "tel");
$upd_customer_contact->addColumn("fax", "STRING_TYPE", "POST", "fax");
$upd_customer_contact->addColumn("content", "STRING_TYPE", "POST", "content");
$upd_customer_contact->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$upd_customer_contact->addColumn("day_update", "DATE_TYPE", "CURRVAL", "");
$upd_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE", "GET", "id_customer_contact");

// Make an instance of the transaction object
$del_customer_contact = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_customer_contact);
// Register triggers
$del_customer_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_customer_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_customer_contact");
// Add columns
$del_customer_contact->setTable("customer_contact");
$del_customer_contact->setPrimaryKey("id_customer_contact", "NUMERIC_TYPE", "GET", "id_customer_contact");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustomer_contact = $tNGs->getRecordset("customer_contact");
$row_rscustomer_contact = mysql_fetch_assoc($rscustomer_contact);
$totalRows_rscustomer_contact = mysql_num_rows($rscustomer_contact);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?><script src="../includes/nxt/scripts/form.js" type="text/javascript"></script><script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
</head>

<body>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_customer_contact'] == "") {
?>
    <?php echo NXT_getResource("Insert_FH"); ?>
    <?php 
// else Conditional region1
} else { ?>
    <?php echo NXT_getResource("Update_FH"); ?>
    <?php } 
// endif Conditional region1
?>
    Customer_contact </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
      <?php $cnt1++; ?>
      <?php 
// Show IF Conditional region1 
if (@$totalRows_rscustomer_contact > 1) {
?>
      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
      <?php } 
// endif Conditional region1
?>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <tr>
          <td class="KT_th"><label for="company_name_<?php echo $cnt1; ?>"><?php echo tencongty;?> :</label></td>
          <td><input type="text" name="company_name_<?php echo $cnt1; ?>" id="company_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['company_name']); ?>" size="50" />
              <?php echo $tNGs->displayFieldHint("company_name");?> <?php echo $tNGs->displayFieldError("customer_contact", "company_name", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="company_address_<?php echo $cnt1; ?>"><?php echo diachicongty;?> :</label></td>
          <td><input type="text" name="company_address_<?php echo $cnt1; ?>" id="company_address_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['company_address']); ?>" size="70" />
              <?php echo $tNGs->displayFieldHint("company_address");?> <?php echo $tNGs->displayFieldError("customer_contact", "company_address", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="member_name_<?php echo $cnt1; ?>"><?php echo hoten;?> :</label></td>
          <td><input type="text" name="member_name_<?php echo $cnt1; ?>" id="member_name_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['member_name']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("member_name");?> <?php echo $tNGs->displayFieldError("customer_contact", "member_name", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="id_country_<?php echo $cnt1; ?>"><?php echo quoctich;?> :</label></td>
          <td><select name="id_country_<?php echo $cnt1; ?>" id="id_country_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
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
              <?php echo $tNGs->displayFieldError("customer_contact", "id_country", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="email_<?php echo $cnt1; ?>"><?php echo email;?> :</label></td>
          <td><input type="text" name="email_<?php echo $cnt1; ?>" id="email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['email']); ?>" size="30" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("customer_contact", "email", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="address_<?php echo $cnt1; ?>"><?php echo diachi;?> :</label></td>
          <td><input type="text" name="address_<?php echo $cnt1; ?>" id="address_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['address']); ?>" size="70" maxlength="200" />
              <?php echo $tNGs->displayFieldHint("address");?> <?php echo $tNGs->displayFieldError("customer_contact", "address", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="tel_<?php echo $cnt1; ?>"><?php echo dienthoai;?> :</label></td>
          <td><input type="text" name="tel_<?php echo $cnt1; ?>" id="tel_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['tel']); ?>" size="30" maxlength="20" />
              <?php echo $tNGs->displayFieldHint("tel");?> <?php echo $tNGs->displayFieldError("customer_contact", "tel", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="fax_<?php echo $cnt1; ?>"><?php echo fax;?> :</label></td>
          <td><input type="text" name="fax_<?php echo $cnt1; ?>" id="fax_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['fax']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("fax");?> <?php echo $tNGs->displayFieldError("customer_contact", "fax", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="content_<?php echo $cnt1; ?>"><?php echo noidung;?> :</label></td>
          <td><textarea name="content_<?php echo $cnt1; ?>" id="content_<?php echo $cnt1; ?>" cols="70" rows="10"><?php echo KT_escapeAttribute($row_rscustomer_contact['content']); ?></textarea>
              <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("customer_contact", "content", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="id_contact_department_<?php echo $cnt1; ?>"><?php echo bophanlienhe;?> :</label></td>
          <td><select name="id_contact_department_<?php echo $cnt1; ?>" id="id_contact_department_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
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
              <?php echo $tNGs->displayFieldError("customer_contact", "id_contact_department", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="day_update_<?php echo $cnt1; ?>"><?php echo ngaycapnhat;?> :</label></td>
          <td><?php echo KT_formatDate($row_rscustomer_contact['day_update']); ?></td>
        </tr>
      </table>
      <input type="hidden" name="kt_pk_customer_contact_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscustomer_contact['kt_pk_customer_contact']); ?>" />
      <?php } while ($row_rscustomer_contact = mysql_fetch_assoc($rscustomer_contact)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_customer_contact'] == "") {
      ?>
          <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
          <?php 
      // else Conditional region1
      } else { ?>
          <div class="KT_operations">
            <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_customer_contact')" />
          </div>
          <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
          <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
          <?php }
      // endif Conditional region1
      ?>
          <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
        </div>
      </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($rs_contact_department);

mysql_free_result($Recordset1);

mysql_free_result($rs_country);
?>
