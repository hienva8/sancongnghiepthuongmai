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
$formValidation->addField("humanname_help", true, "text", "", "", "", "vuilongnhapten.");
$formValidation->addField("nickname", true, "text", "", "", "", "Please enter a email.");
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
$query_rs_contact_department = "SELECT id_contact_department, name, name_EN FROM contact_department WHERE visible = 1 ORDER BY sort ASC";
$rs_contact_department = mysql_query($query_rs_contact_department, $ketnoi) or die(mysql_error());
$row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
$totalRows_rs_contact_department = mysql_num_rows($rs_contact_department);

// Make an insert transaction instance
$ins_supportonline = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_supportonline);
// Register triggers
$ins_supportonline->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_supportonline->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_supportonline->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_supportonline");
// Add columns
$ins_supportonline->setTable("supportonline");
$ins_supportonline->addColumn("id_contact_department", "NUMERIC_TYPE", "POST", "id_contact_department");
$ins_supportonline->addColumn("humanname_help", "STRING_TYPE", "POST", "humanname_help");
$ins_supportonline->addColumn("humansex_help", "STRING_TYPE", "POST", "humansex_help");
$ins_supportonline->addColumn("tel", "STRING_TYPE", "POST", "tel");
$ins_supportonline->addColumn("nickname", "STRING_TYPE", "POST", "nickname");
$ins_supportonline->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_supportonline->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "1");
$ins_supportonline->setPrimaryKey("id_supportonline", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rssupportonline = $tNGs->getRecordset("supportonline");
$row_rssupportonline = mysql_fetch_assoc($rssupportonline);
$totalRows_rssupportonline = mysql_num_rows($rssupportonline);
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

<h3><?php echo themmoi." ".hotrotructuyen;?>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="id_contact_department"><?php echo bophanlienhe;?> :</label></td>
      <td><select name="id_contact_department" id="id_contact_department">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], $row_rssupportonline['id_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
        <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("supportonline", "id_contact_department"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="humanname_help"><?php echo hoten;?> :</label></td>
      <td><input type="text" name="humanname_help" id="humanname_help" value="<?php echo KT_escapeAttribute($row_rssupportonline['humanname_help']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("humanname_help");?> <?php echo $tNGs->displayFieldError("supportonline", "humanname_help"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="humansex_help_1"><?php echo gioitinh;?> :</label></td>
      <td><div>
        <input <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['humansex_help']),"Mr"))) {echo "CHECKED";} ?> type="radio" name="humansex_help" id="humansex_help_1" value="Mr" />
        <label for="humansex_help_1"><?php echo ong;?></label>
      </div>
          <div>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['humansex_help']),"Mrs/Miss"))) {echo "CHECKED";} ?> type="radio" name="humansex_help" id="humansex_help_2" value="Mrs/Miss" />
            <label for="humansex_help_2"><?php echo ba;?></label>
          </div>
        <div>
            <input <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['humansex_help']),"Orther"))) {echo "CHECKED";} ?> type="radio" name="humansex_help" id="humansex_help_3" value="Orther" />
            <label for="humansex_help_3"><?php echo khac;?></label>
          </div>
        <?php echo $tNGs->displayFieldError("supportonline", "humansex_help"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="tel"><?php echo dienthoai;?> :</label></td>
      <td><input type="text" name="tel" id="tel" value="<?php echo KT_escapeAttribute($row_rssupportonline['tel']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("tel");?> <?php echo $tNGs->displayFieldError("supportonline", "tel"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="nickname"><?php echo email;?> :</label></td>
      <td><input type="text" name="nickname" id="nickname" value="<?php echo KT_escapeAttribute($row_rssupportonline['nickname']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("nickname");?> <?php echo $tNGs->displayFieldError("supportonline", "nickname"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="status"><?php echo status;?> :</label></td>
      <td><input type="text" name="status" id="status" value="<?php echo KT_escapeAttribute($row_rssupportonline['status']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("status");?> <?php echo $tNGs->displayFieldError("supportonline", "status"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="visible"><?php echo anhien;?>:</label></td>
      <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rssupportonline['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible" id="visible" value="1" />
          <?php echo $tNGs->displayFieldError("supportonline", "visible"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Insert record" />
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_contact_department);
?>
