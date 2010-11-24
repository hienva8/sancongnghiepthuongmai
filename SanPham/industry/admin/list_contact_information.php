<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the required classes
require_once('../includes/tfi/TFI.php');
require_once('../includes/tso/TSO.php');
require_once('../includes/nav/NAV.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

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

// Filter
$tfi_listcontact_information3 = new TFI_TableFilter($conn_ketnoi, "tfi_listcontact_information3");
$tfi_listcontact_information3->addColumn("contact_information.id_contact_information", "NUMERIC_TYPE", "id_contact_information", "=");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_fullname", "STRING_TYPE", "ct_info_fullname", "%");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_company", "NUMERIC_TYPE", "ct_info_company", "=");
$tfi_listcontact_information3->addColumn("contact_department.id_contact_department", "NUMERIC_TYPE", "ct_info_department", "=");
$tfi_listcontact_information3->addColumn("position.id_position", "NUMERIC_TYPE", "ct_info_position", "=");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_email", "STRING_TYPE", "ct_info_email", "%");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_address", "STRING_TYPE", "ct_info_address", "%");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_tel", "STRING_TYPE", "ct_info_tel", "%");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_mobile", "STRING_TYPE", "ct_info_mobile", "%");
$tfi_listcontact_information3->addColumn("contact_information.ct_info_fax", "STRING_TYPE", "ct_info_fax", "%");
$tfi_listcontact_information3->Execute();

// Sorter
$tso_listcontact_information3 = new TSO_TableSorter("rscontact_information1", "tso_listcontact_information3");
$tso_listcontact_information3->addColumn("contact_information.id_contact_information");
$tso_listcontact_information3->addColumn("contact_information.ct_info_fullname");
$tso_listcontact_information3->addColumn("contact_information.ct_info_company");
$tso_listcontact_information3->addColumn("contact_department.name");
$tso_listcontact_information3->addColumn("position.position_name");
$tso_listcontact_information3->addColumn("contact_information.ct_info_email");
$tso_listcontact_information3->addColumn("contact_information.ct_info_address");
$tso_listcontact_information3->addColumn("contact_information.ct_info_tel");
$tso_listcontact_information3->addColumn("contact_information.ct_info_mobile");
$tso_listcontact_information3->addColumn("contact_information.ct_info_fax");
$tso_listcontact_information3->setDefault("contact_information.id_contact_information DESC");
$tso_listcontact_information3->Execute();

// Navigation
$nav_listcontact_information3 = new NAV_Regular("nav_listcontact_information3", "rscontact_information1", "../", $_SERVER['PHP_SELF'], 10);

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

//NeXTenesio3 Special List Recordset
$maxRows_rscontact_information1 = $_SESSION['max_rows_nav_listcontact_information3'];
$pageNum_rscontact_information1 = 0;
if (isset($_GET['pageNum_rscontact_information1'])) {
  $pageNum_rscontact_information1 = $_GET['pageNum_rscontact_information1'];
}
$startRow_rscontact_information1 = $pageNum_rscontact_information1 * $maxRows_rscontact_information1;

// Defining List Recordset variable
$NXTFilter_rscontact_information1 = "1=1";
if (isset($_SESSION['filter_tfi_listcontact_information3'])) {
  $NXTFilter_rscontact_information1 = $_SESSION['filter_tfi_listcontact_information3'];
}
// Defining List Recordset variable
$NXTSort_rscontact_information1 = "contact_information.id_contact_information DESC";
if (isset($_SESSION['sorter_tso_listcontact_information3'])) {
  $NXTSort_rscontact_information1 = $_SESSION['sorter_tso_listcontact_information3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rscontact_information1 = "SELECT contact_information.id_contact_information, contact_information.ct_info_fullname, contact_information.ct_info_company, contact_department.name AS ct_info_department, position.position_name AS ct_info_position, contact_information.ct_info_email, contact_information.ct_info_address, contact_information.ct_info_tel, contact_information.ct_info_mobile, contact_information.ct_info_fax FROM (contact_information LEFT JOIN contact_department ON contact_information.ct_info_department = contact_department.id_contact_department) LEFT JOIN position ON contact_information.ct_info_position = position.id_position WHERE {$NXTFilter_rscontact_information1} ORDER BY {$NXTSort_rscontact_information1}";
$query_limit_rscontact_information1 = sprintf("%s LIMIT %d, %d", $query_rscontact_information1, $startRow_rscontact_information1, $maxRows_rscontact_information1);
$rscontact_information1 = mysql_query($query_limit_rscontact_information1, $ketnoi) or die(mysql_error());
$row_rscontact_information1 = mysql_fetch_assoc($rscontact_information1);

if (isset($_GET['totalRows_rscontact_information1'])) {
  $totalRows_rscontact_information1 = $_GET['totalRows_rscontact_information1'];
} else {
  $all_rscontact_information1 = mysql_query($query_rscontact_information1);
  $totalRows_rscontact_information1 = mysql_num_rows($all_rscontact_information1);
}
$totalPages_rscontact_information1 = ceil($totalRows_rscontact_information1/$maxRows_rscontact_information1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcontact_information3->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: false,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script><style type="text/css">
  /* Dynamic List row settings */
  .KT_col_id_contact_information {width:5px; overflow:hidden;}
  .KT_col_ct_info_fullname {width:100px; overflow:hidden;}
  .KT_col_ct_info_company {width:100px; overflow:hidden;}
  .KT_col_ct_info_department {width:100px; overflow:hidden;}
  .KT_col_ct_info_position {width:100px; overflow:hidden;}
  .KT_col_ct_info_email {width:100px; overflow:hidden;}
  .KT_col_ct_info_address {width:100px; overflow:hidden;}
  .KT_col_ct_info_tel {width:100px; overflow:hidden;}
  .KT_col_ct_info_mobile {width:100px; overflow:hidden;}
  .KT_col_ct_info_fax {width:100px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listcontact_information3">
  <h1> Contact information
    <?php
  $nav_listcontact_information3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listcontact_information3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcontact_information3'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listcontact_information3']; ?>
            <?php 
  // else Conditional region1
  } else { ?>
            <?php echo NXT_getResource("all"); ?>
            <?php } 
  // endif Conditional region1
?>
            <?php echo NXT_getResource("records"); ?></a> &nbsp;
        &nbsp;
                            <?php 
  // Show IF Conditional region2
  if (@$_SESSION['has_filter_tfi_listcontact_information3'] == 1) {
?>
                            <a href="<?php echo $tfi_listcontact_information3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listcontact_information3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="id_contact_information" class="KT_sorter KT_col_id_contact_information <?php echo $tso_listcontact_information3->getSortIcon('contact_information.id_contact_information'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.id_contact_information'); ?>">ID</a> </th>
            <th id="ct_info_fullname" class="KT_sorter KT_col_ct_info_fullname <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_fullname'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_fullname'); ?>">Full name</a> </th>
            <th id="ct_info_company" class="KT_sorter KT_col_ct_info_company <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_company'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_company'); ?>">Company name</a> </th>
            <th id="ct_info_department" class="KT_sorter KT_col_ct_info_department <?php echo $tso_listcontact_information3->getSortIcon('contact_department.name'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_department.name'); ?>">Contact department</a> </th>
            <th id="ct_info_position" class="KT_sorter KT_col_ct_info_position <?php echo $tso_listcontact_information3->getSortIcon('position.position_name'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('position.position_name'); ?>">Position</a> </th>
            <th id="ct_info_email" class="KT_sorter KT_col_ct_info_email <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_email'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_email'); ?>">Email</a> </th>
            <th id="ct_info_address" class="KT_sorter KT_col_ct_info_address <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_address'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_address'); ?>">Address</a> </th>
            <th id="ct_info_tel" class="KT_sorter KT_col_ct_info_tel <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_tel'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_tel'); ?>">Tel</a> </th>
            <th id="ct_info_mobile" class="KT_sorter KT_col_ct_info_mobile <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_mobile'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_mobile'); ?>">Mobile</a> </th>
            <th id="ct_info_fax" class="KT_sorter KT_col_ct_info_fax <?php echo $tso_listcontact_information3->getSortIcon('contact_information.ct_info_fax'); ?>"> <a href="<?php echo $tso_listcontact_information3->getSortLink('contact_information.ct_info_fax'); ?>">Fax</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcontact_information3'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listcontact_information3_id_contact_information" id="tfi_listcontact_information3_id_contact_information" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_id_contact_information']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcontact_information3_ct_info_fullname" id="tfi_listcontact_information3_ct_info_fullname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_ct_info_fullname']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listcontact_information3_ct_info_company" id="tfi_listcontact_information3_ct_info_company">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcontact_information3_ct_info_company']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_company']?>"<?php if (!(strcmp($row_Recordset1['id_company'], @$_SESSION['tfi_listcontact_information3_ct_info_company']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['company_name']?></option>
              <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
            </select>
            </td>
            <td><select name="tfi_listcontact_information3_ct_info_department" id="tfi_listcontact_information3_ct_info_department">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcontact_information3_ct_info_department']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_contact_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_contact_department['id_contact_department'], @$_SESSION['tfi_listcontact_information3_ct_info_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_contact_department['name']?></option>
              <?php
} while ($row_rs_contact_department = mysql_fetch_assoc($rs_contact_department));
  $rows = mysql_num_rows($rs_contact_department);
  if($rows > 0) {
      mysql_data_seek($rs_contact_department, 0);
	  $row_rs_contact_department = mysql_fetch_assoc($rs_contact_department);
  }
?>
            </select>
            </td>
            <td><select name="tfi_listcontact_information3_ct_info_position" id="tfi_listcontact_information3_ct_info_position">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcontact_information3_ct_info_position']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_position['id_position']?>"<?php if (!(strcmp($row_rs_position['id_position'], @$_SESSION['tfi_listcontact_information3_ct_info_position']))) {echo "SELECTED";} ?>><?php echo $row_rs_position['position_name']?></option>
              <?php
} while ($row_rs_position = mysql_fetch_assoc($rs_position));
  $rows = mysql_num_rows($rs_position);
  if($rows > 0) {
      mysql_data_seek($rs_position, 0);
	  $row_rs_position = mysql_fetch_assoc($rs_position);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listcontact_information3_ct_info_email" id="tfi_listcontact_information3_ct_info_email" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_ct_info_email']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcontact_information3_ct_info_address" id="tfi_listcontact_information3_ct_info_address" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_ct_info_address']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listcontact_information3_ct_info_tel" id="tfi_listcontact_information3_ct_info_tel" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_ct_info_tel']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcontact_information3_ct_info_mobile" id="tfi_listcontact_information3_ct_info_mobile" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_ct_info_mobile']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcontact_information3_ct_info_fax" id="tfi_listcontact_information3_ct_info_fax" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_information3_ct_info_fax']); ?>" size="20" maxlength="20" /></td>
            <td><input type="submit" name="tfi_listcontact_information3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rscontact_information1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="12"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rscontact_information1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_contact_information" class="id_checkbox" value="<?php echo $row_rscontact_information1['id_contact_information']; ?>" />
                <input type="hidden" name="id_contact_information" class="id_field" value="<?php echo $row_rscontact_information1['id_contact_information']; ?>" />
            </td>
            <td><div class="KT_col_id_contact_information"><?php echo KT_FormatForList($row_rscontact_information1['id_contact_information'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_fullname"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_fullname'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_company"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_company'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_department"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_department'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_position"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_position'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_email"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_email'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_address"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_address'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_tel"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_tel'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_mobile"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_mobile'], 20); ?></div></td>
            <td><div class="KT_col_ct_info_fax"><?php echo KT_FormatForList($row_rscontact_information1['ct_info_fax'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_contact_information&amp;id_contact_information=<?php echo $row_rscontact_information1['id_contact_information']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rscontact_information1 = mysql_fetch_assoc($rscontact_information1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listcontact_information3->Prepare();
            require("../includes/nav/NAV_Text_Navigation.inc.php");
          ?>
        </div>
      </div>
      <div class="KT_bottombuttons">
        <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource("edit_all"); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource("delete_all"); ?></a> </div>
        <span>&nbsp;</span>
        <select name="no_new" id="no_new">
          <option value="1">1</option>
          <option value="3">3</option>
          <option value="6">6</option>
        </select>
        <a class="KT_additem_op_link" href="index.php?mod=form_contact_information&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rs_contact_department);

mysql_free_result($rs_position);

mysql_free_result($rscontact_information1);
?>