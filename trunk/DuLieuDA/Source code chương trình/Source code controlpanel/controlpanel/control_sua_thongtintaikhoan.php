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
$formValidation->addField("member_user", true, "text", "", "", "", "");
$formValidation->addField("member_name", true, "text", "", "", "", "Vui lòng nhập họ tên.");
$formValidation->addField("member_id_country", true, "numeric", "", "", "", "
Vui lòng chọn quê quán.");
$formValidation->addField("member_email", true, "text", "email", "", "", "");
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
$query_rs_country = "SELECT id_country, country_name, country_image_illustrate FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

// Make an update transaction instance
$upd_member = new tNG_update($conn_ketnoi);
$tNGs->addTransaction($upd_member);
// Register triggers
$upd_member->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_member->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_member->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=facc");
// Add columns
$upd_member->setTable("member");
$upd_member->addColumn("member_user", "STRING_TYPE", "CURRVAL", "");
$upd_member->addColumn("member_name", "STRING_TYPE", "POST", "member_name");
$upd_member->addColumn("member_id_country", "NUMERIC_TYPE", "POST", "member_id_country");
$upd_member->addColumn("member_sex", "STRING_TYPE", "POST", "member_sex");
$upd_member->addColumn("member_address", "STRING_TYPE", "POST", "member_address");
$upd_member->addColumn("member_email", "STRING_TYPE", "POST", "member_email");
$upd_member->addColumn("member_tell", "STRING_TYPE", "POST", "member_tell");
$upd_member->addColumn("member_fax", "STRING_TYPE", "POST", "member_fax");
//$upd_member->addColumn("member_intro_short", "STRING_TYPE", "POST", "member_intro_short");
//$upd_member->addColumn("member_intro", "STRING_TYPE", "POST", "member_intro");
//$upd_member->addColumn("member_kind", "STRING_TYPE", "POST", "member_kind");
$upd_member->addColumn("member_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_member->setPrimaryKey("id_member", "NUMERIC_TYPE", "SESSION", "kt_login_id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmember = $tNGs->getRecordset("member");
$row_rsmember = mysql_fetch_assoc($rsmember);
$totalRows_rsmember = mysql_num_rows($rsmember);
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
<script type="text/javascript" src="../Editor/scripts/innovaeditor.js"></script>
</head>

<body>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td><?php echo tendangnhap;?>:</td>
      <td><?php echo KT_escapeAttribute($row_rsmember['member_user']); ?></td>
    </tr>
    <tr>
      <td><label for="member_name"><?php echo hoten;?>:</label></td>
      <td><input type="text" name="member_name" id="member_name" value="<?php echo KT_escapeAttribute($row_rsmember['member_name']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_name");?> <?php echo $tNGs->displayFieldError("member", "member_name"); ?> </td>
    </tr>
    <tr>
      <td><label for="member_id_country"><?php echo quequan;?>:</label></td>
      <td><select name="member_id_country" id="member_id_country">
      <option value=""><?php echo tatcaquocgia;?></option>
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
      <td><label for="member_sex_1"><?php echo gender;?>:</label></td>
      <td><div>
       <label class="background_type_member"> 
       <label for="member_sex_1">&nbsp;Mr &nbsp;</label>
       <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"Mr"))) {echo "CHECKED";} ?> type="radio" name="member_sex" id="member_sex_1" value="Mr" checked="checked" />
        
     </label>
            <label class="background_type_member">
            <label for="member_sex_2">&nbsp;Mrs/Miss &nbsp;</label>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"Mrs/Miss"))) {echo "CHECKED";} ?> type="radio" name="member_sex" id="member_sex_2" value="Mrs/Miss" />
            
         </label>
         <label class="background_type_member">
          <label for="member_sex_3">&nbsp;Orther &nbsp;</label>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rsmember['member_sex']),"Orther"))) {echo "CHECKED";} ?> type="radio" name="member_sex" id="member_sex_3" value="Orther" />
           
            </label>
          </div>
        <?php echo $tNGs->displayFieldError("member", "member_sex"); ?> </td>
    </tr>
    <tr>
      <td><label for="member_address"><?php echo diachi;?>:</label></td>
      <td><input type="text" name="member_address" id="member_address" value="<?php echo KT_escapeAttribute($row_rsmember['member_address']); ?>" size="70" />
          <?php echo $tNGs->displayFieldHint("member_address");?> <?php echo $tNGs->displayFieldError("member", "member_address"); ?> </td>
    </tr>
    <tr>
      <td><label for="member_email"><?php echo email;?>:</label></td>
      <td><input type="text" name="member_email" id="member_email" value="<?php echo KT_escapeAttribute($row_rsmember['member_email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_email");?> <?php echo $tNGs->displayFieldError("member", "member_email"); ?> </td>
    </tr>
    <tr>
      <td><label for="member_tell"><?php echo dienthoai;?>:</label></td>
      <td><input type="text" name="member_tell" id="member_tell" value="<?php echo KT_escapeAttribute($row_rsmember['member_tell']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_tell");?> <?php echo $tNGs->displayFieldError("member", "member_tell"); ?> </td>
    </tr>
    <tr>
      <td><label for="member_fax"><?php echo fax;?>:</label></td>
      <td><input type="text" name="member_fax" id="member_fax" value="<?php echo KT_escapeAttribute($row_rsmember['member_fax']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("member_fax");?> <?php echo $tNGs->displayFieldError("member", "member_fax"); ?> </td>
    </tr>
    
    <?php /*?><tr>
      <td><label for="member_kind"><?php echo loaithanhvien;?>:</label></td>
      <td><select name="member_kind" id="member_kind">
        <option value="business" <?php if (!(strcmp("business", KT_escapeAttribute($row_rsmember['member_kind'])))) {echo "SELECTED";} ?>>Business</option>
        <option value="member" <?php if (!(strcmp("member", KT_escapeAttribute($row_rsmember['member_kind'])))) {echo "SELECTED";} ?>>Member</option>
      </select>
          <?php echo $tNGs->displayFieldError("member", "member_kind"); ?> </td>
    </tr><?php */?>
    <tr>
      <td><?php echo ngaythamgia;?>:</td>
      <td><?php echo KT_formatDate($row_rsmember['member_day_update']); ?></td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Update1" id="KT_Update1" value="<?php echo capnhat;?>" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($rs_country);
?>
