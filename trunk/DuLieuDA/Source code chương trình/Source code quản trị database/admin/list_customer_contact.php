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
$tfi_listcustomer_contact2 = new TFI_TableFilter($conn_ketnoi, "tfi_listcustomer_contact2");
$tfi_listcustomer_contact2->addColumn("customer_contact.company_name", "STRING_TYPE", "company_name", "%");
$tfi_listcustomer_contact2->addColumn("customer_contact.member_name", "STRING_TYPE", "member_name", "%");
$tfi_listcustomer_contact2->addColumn("country.id_country", "NUMERIC_TYPE", "id_country", "=");
$tfi_listcustomer_contact2->addColumn("customer_contact.title", "STRING_TYPE", "title", "%");
$tfi_listcustomer_contact2->addColumn("contact_department.id_contact_department", "NUMERIC_TYPE", "id_contact_department", "=");
$tfi_listcustomer_contact2->addColumn("customer_contact.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listcustomer_contact2->Execute();

// Sorter
$tso_listcustomer_contact2 = new TSO_TableSorter("rscustomer_contact1", "tso_listcustomer_contact2");
$tso_listcustomer_contact2->addColumn("customer_contact.company_name");
$tso_listcustomer_contact2->addColumn("customer_contact.member_name");
$tso_listcustomer_contact2->addColumn("country.country_name");
$tso_listcustomer_contact2->addColumn("customer_contact.title");
$tso_listcustomer_contact2->addColumn("contact_department.name");
$tso_listcustomer_contact2->addColumn("customer_contact.day_update");
$tso_listcustomer_contact2->setDefault("customer_contact.day_update DESC");
$tso_listcustomer_contact2->Execute();

// Navigation
$nav_listcustomer_contact2 = new NAV_Regular("nav_listcustomer_contact2", "rscustomer_contact1", "../", $_SERVER['PHP_SELF'], 20);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_department = "SELECT id_contact_department, name FROM contact_department ORDER BY sort ASC";
$rs_department = mysql_query($query_rs_department, $ketnoi) or die(mysql_error());
$row_rs_department = mysql_fetch_assoc($rs_department);
$totalRows_rs_department = mysql_num_rows($rs_department);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

//NeXTenesio3 Special List Recordset
$maxRows_rscustomer_contact1 = $_SESSION['max_rows_nav_listcustomer_contact2'];
$pageNum_rscustomer_contact1 = 0;
if (isset($_GET['pageNum_rscustomer_contact1'])) {
  $pageNum_rscustomer_contact1 = $_GET['pageNum_rscustomer_contact1'];
}
$startRow_rscustomer_contact1 = $pageNum_rscustomer_contact1 * $maxRows_rscustomer_contact1;

// Defining List Recordset variable
$NXTFilter_rscustomer_contact1 = "1=1";
if (isset($_SESSION['filter_tfi_listcustomer_contact2'])) {
  $NXTFilter_rscustomer_contact1 = $_SESSION['filter_tfi_listcustomer_contact2'];
}
// Defining List Recordset variable
$NXTSort_rscustomer_contact1 = "customer_contact.day_update DESC";
if (isset($_SESSION['sorter_tso_listcustomer_contact2'])) {
  $NXTSort_rscustomer_contact1 = $_SESSION['sorter_tso_listcustomer_contact2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rscustomer_contact1 = "SELECT customer_contact.company_name, customer_contact.company_address, customer_contact.member_name, country.country_name AS id_country, customer_contact.address, customer_contact.email, customer_contact.tel, customer_contact.fax, customer_contact.title, customer_contact.content, contact_department.name AS id_contact_department, customer_contact.day_update, customer_contact.id_customer_contact FROM (customer_contact LEFT JOIN country ON customer_contact.id_country = country.id_country) LEFT JOIN contact_department ON customer_contact.id_contact_department = contact_department.id_contact_department WHERE {$NXTFilter_rscustomer_contact1} ORDER BY {$NXTSort_rscustomer_contact1}";
$query_limit_rscustomer_contact1 = sprintf("%s LIMIT %d, %d", $query_rscustomer_contact1, $startRow_rscustomer_contact1, $maxRows_rscustomer_contact1);
$rscustomer_contact1 = mysql_query($query_limit_rscustomer_contact1, $ketnoi) or die(mysql_error());
$row_rscustomer_contact1 = mysql_fetch_assoc($rscustomer_contact1);

if (isset($_GET['totalRows_rscustomer_contact1'])) {
  $totalRows_rscustomer_contact1 = $_GET['totalRows_rscustomer_contact1'];
} else {
  $all_rscustomer_contact1 = mysql_query($query_rscustomer_contact1);
  $totalRows_rscustomer_contact1 = mysql_num_rows($all_rscustomer_contact1);
}
$totalPages_rscustomer_contact1 = ceil($totalRows_rscustomer_contact1/$maxRows_rscustomer_contact1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcustomer_contact2->checkBoundries();
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
  .KT_col_company_name {width:140px; overflow:hidden;}
  .KT_col_member_name {width:100px; overflow:hidden;}
  .KT_col_id_country {width:100px; overflow:hidden;}
  .KT_col_title {width:140px; overflow:hidden;}
  .KT_col_id_contact_department {width:100px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
</style>
</head>

<body>
<div class="KT_tng" id="listcustomer_contact2">
  <h1> <?php echo lienhe;?>
    <?php
  $nav_listcustomer_contact2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listcustomer_contact2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcustomer_contact2'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listcustomer_contact2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcustomer_contact2'] == 1) {
?>
                            <a href="<?php echo $tfi_listcustomer_contact2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listcustomer_contact2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="company_name" class="KT_sorter KT_col_company_name <?php echo $tso_listcustomer_contact2->getSortIcon('customer_contact.company_name'); ?>"> <a href="<?php echo $tso_listcustomer_contact2->getSortLink('customer_contact.company_name'); ?>"><?php echo tencongty;?> </a> </th>
            <th id="member_name" class="KT_sorter KT_col_member_name <?php echo $tso_listcustomer_contact2->getSortIcon('customer_contact.member_name'); ?>"> <a href="<?php echo $tso_listcustomer_contact2->getSortLink('customer_contact.member_name'); ?>"><?php echo nguoilienhe;?> </a> </th>
            <th id="id_country" class="KT_sorter KT_col_id_country <?php echo $tso_listcustomer_contact2->getSortIcon('country.country_name'); ?>"> <a href="<?php echo $tso_listcustomer_contact2->getSortLink('country.country_name'); ?>"><?php echo quoctich;?> </a> </th>
            <th id="title" class="KT_sorter KT_col_title <?php echo $tso_listcustomer_contact2->getSortIcon('customer_contact.title'); ?>"> <a href="<?php echo $tso_listcustomer_contact2->getSortLink('customer_contact.title'); ?>"><?php echo vandelienhe;?></a> </th>
            <th id="id_contact_department" class="KT_sorter KT_col_id_contact_department <?php echo $tso_listcustomer_contact2->getSortIcon('contact_department.name'); ?>"> <a href="<?php echo $tso_listcustomer_contact2->getSortLink('contact_department.name'); ?>"><?php echo bophanlienhe;?></a> </th>
            <th id="day_update" class="KT_sorter KT_col_day_update <?php echo $tso_listcustomer_contact2->getSortIcon('customer_contact.day_update'); ?>"> <a href="<?php echo $tso_listcustomer_contact2->getSortLink('customer_contact.day_update'); ?>"><?php echo ngaylienhe;?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcustomer_contact2'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listcustomer_contact2_company_name" id="tfi_listcustomer_contact2_company_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer_contact2_company_name']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listcustomer_contact2_member_name" id="tfi_listcustomer_contact2_member_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer_contact2_member_name']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listcustomer_contact2_id_country" id="tfi_listcustomer_contact2_id_country">
      <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcustomer_contact2_id_country']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
<?php
do {  
?>
			<option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], @$_SESSION['tfi_listcustomer_contact2_id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name']?></option>
<?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
		</select>
            </td>
            <td><input type="text" name="tfi_listcustomer_contact2_title" id="tfi_listcustomer_contact2_title" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer_contact2_title']); ?>" size="20" maxlength="255" /></td>
            <td><select name="tfi_listcustomer_contact2_id_contact_department" id="tfi_listcustomer_contact2_id_contact_department">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcustomer_contact2_id_contact_department']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_department['id_contact_department']?>"<?php if (!(strcmp($row_rs_department['id_contact_department'], @$_SESSION['tfi_listcustomer_contact2_id_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_rs_department['name']?></option>
              <?php
} while ($row_rs_department = mysql_fetch_assoc($rs_department));
  $rows = mysql_num_rows($rs_department);
  if($rows > 0) {
      mysql_data_seek($rs_department, 0);
	  $row_rs_department = mysql_fetch_assoc($rs_department);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listcustomer_contact2_day_update" id="tfi_listcustomer_contact2_day_update" value="<?php echo @$_SESSION['tfi_listcustomer_contact2_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input type="submit" name="tfi_listcustomer_contact2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rscustomer_contact1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="8"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rscustomer_contact1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_customer_contact" class="id_checkbox" value="<?php echo $row_rscustomer_contact1['id_customer_contact']; ?>" />
                <input type="hidden" name="id_customer_contact" class="id_field" value="<?php echo $row_rscustomer_contact1['id_customer_contact']; ?>" />
            </td>
            <td><div class="KT_col_company_name"><?php echo KT_FormatForList($row_rscustomer_contact1['company_name'], 20); ?></div></td>
            <td><div class="KT_col_member_name"><?php echo KT_FormatForList($row_rscustomer_contact1['member_name'], 20); ?></div></td>
            <td><div class="KT_col_id_country"><?php echo KT_FormatForList($row_rscustomer_contact1['id_country'], 20); ?></div></td>
            <td><div class="KT_col_title"><?php echo KT_FormatForList($row_rscustomer_contact1['title'], 20); ?></div></td>
            <td><div class="KT_col_id_contact_department"><?php echo KT_FormatForList($row_rscustomer_contact1['id_contact_department'], 20); ?></div></td>
            <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rscustomer_contact1['day_update']); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_customer_contact&amp;id_customer_contact=<?php echo $row_rscustomer_contact1['id_customer_contact']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rscustomer_contact1 = mysql_fetch_assoc($rscustomer_contact1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listcustomer_contact2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_customer_contact&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($rs_department);

mysql_free_result($rs_country);

mysql_free_result($rscustomer_contact1);
?>
