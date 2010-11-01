<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the required classes
require_once('../includes/tor/TOR.php');
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

// Order
$tor_listcontact_department3 = new TOR_SetOrder($conn_ketnoi, 'contact_department', 'id_contact_department', 'NUMERIC_TYPE', 'sort', 'listcontact_department3_sort_order');
$tor_listcontact_department3->Execute();

// Filter
$tfi_listcontact_department3 = new TFI_TableFilter($conn_ketnoi, "tfi_listcontact_department3");
$tfi_listcontact_department3->addColumn("contact_department.name", "STRING_TYPE", "name", "%");
$tfi_listcontact_department3->addColumn("contact_department.name_EN", "STRING_TYPE", "name_EN", "%");
$tfi_listcontact_department3->addColumn("contact_department.type", "STRING_TYPE", "type", "%");
$tfi_listcontact_department3->addColumn("contact_department.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listcontact_department3->addColumn("contact_department.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listcontact_department3->Execute();

// Sorter
$tso_listcontact_department3 = new TSO_TableSorter("rscontact_department1", "tso_listcontact_department3");
$tso_listcontact_department3->addColumn("contact_department.sort"); // Order column
$tso_listcontact_department3->setDefault("contact_department.sort");
$tso_listcontact_department3->Execute();

// Navigation
$nav_listcontact_department3 = new NAV_Regular("nav_listcontact_department3", "rscontact_department1", "../", $_SERVER['PHP_SELF'], 20);

//NeXTenesio3 Special List Recordset
$maxRows_rscontact_department1 = $_SESSION['max_rows_nav_listcontact_department3'];
$pageNum_rscontact_department1 = 0;
if (isset($_GET['pageNum_rscontact_department1'])) {
  $pageNum_rscontact_department1 = $_GET['pageNum_rscontact_department1'];
}
$startRow_rscontact_department1 = $pageNum_rscontact_department1 * $maxRows_rscontact_department1;

// Defining List Recordset variable
$NXTFilter_rscontact_department1 = "1=1";
if (isset($_SESSION['filter_tfi_listcontact_department3'])) {
  $NXTFilter_rscontact_department1 = $_SESSION['filter_tfi_listcontact_department3'];
}
// Defining List Recordset variable
$NXTSort_rscontact_department1 = "contact_department.sort";
if (isset($_SESSION['sorter_tso_listcontact_department3'])) {
  $NXTSort_rscontact_department1 = $_SESSION['sorter_tso_listcontact_department3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rscontact_department1 = "SELECT contact_department.name, contact_department.name_EN, contact_department.type, contact_department.day_update, contact_department.visible, contact_department.id_contact_department, contact_department.sort FROM contact_department WHERE {$NXTFilter_rscontact_department1} ORDER BY {$NXTSort_rscontact_department1}";
$query_limit_rscontact_department1 = sprintf("%s LIMIT %d, %d", $query_rscontact_department1, $startRow_rscontact_department1, $maxRows_rscontact_department1);
$rscontact_department1 = mysql_query($query_limit_rscontact_department1, $ketnoi) or die(mysql_error());
$row_rscontact_department1 = mysql_fetch_assoc($rscontact_department1);

if (isset($_GET['totalRows_rscontact_department1'])) {
  $totalRows_rscontact_department1 = $_GET['totalRows_rscontact_department1'];
} else {
  $all_rscontact_department1 = mysql_query($query_rscontact_department1);
  $totalRows_rscontact_department1 = mysql_num_rows($all_rscontact_department1);
}
$totalPages_rscontact_department1 = ceil($totalRows_rscontact_department1/$maxRows_rscontact_department1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcontact_department3->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: false,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script>
<style type="text/css">
  /* Dynamic List row settings */
  .KT_col_name {width:100px; overflow:hidden;}
  .KT_col_name_EN {width:100px; overflow:hidden;}
  .KT_col_type {width:80px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listcontact_department3->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listcontact_department3">
  <h1> Contact_department
    <?php
  $nav_listcontact_department3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listcontact_department3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcontact_department3'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listcontact_department3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcontact_department3'] == 1) {
?>
                  <a href="<?php echo $tfi_listcontact_department3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listcontact_department3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="name" class="KT_col_name"><?php echo tenbophanlienhe;?></th>
            <th id="name_EN" class="KT_col_name_EN"><?php echo tenbophanlienhetienganh;?></th>
            <th id="type" class="KT_col_type"><?php echo loaibophanlienhe;?></th>
            <th id="day_update" class="KT_col_day_update"><?php echo ngaycapnhat;?></th>
            <th id="visible" class="KT_col_visible"><?php echo anhien;?></th>
            <th id="sort" class="KT_sorter <?php echo $tso_listcontact_department3->getSortIcon('contact_department.sort'); ?> KT_order"> <a href="<?php echo $tso_listcontact_department3->getSortLink('contact_department.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcontact_department3'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listcontact_department3_name" id="tfi_listcontact_department3_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_department3_name']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listcontact_department3_name_EN" id="tfi_listcontact_department3_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_department3_name_EN']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listcontact_department3_type" id="tfi_listcontact_department3_type" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_department3_type']); ?>" size="20" maxlength="10" /></td>
              <td><input type="text" name="tfi_listcontact_department3_day_update" id="tfi_listcontact_department3_day_update" value="<?php echo @$_SESSION['tfi_listcontact_department3_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listcontact_department3_visible" id="tfi_listcontact_department3_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact_department3_visible']); ?>" size="20" maxlength="100" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listcontact_department3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rscontact_department1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="8"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rscontact_department1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_contact_department" class="id_checkbox" value="<?php echo $row_rscontact_department1['id_contact_department']; ?>" />
                    <input type="hidden" name="id_contact_department" class="id_field" value="<?php echo $row_rscontact_department1['id_contact_department']; ?>" />
                </td>
                <td><div class="KT_col_name"><?php echo KT_FormatForList($row_rscontact_department1['name'], 20); ?></div></td>
                <td><div class="KT_col_name_EN"><?php echo KT_FormatForList($row_rscontact_department1['name_EN'], 20); ?></div></td>
                <td><div class="KT_col_type"><?php echo KT_FormatForList($row_rscontact_department1['type'], 20); ?></div></td>
                <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rscontact_department1['day_update']); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rscontact_department1['visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listcontact_department3->getOrderFieldName() ?>" value="<?php echo $tor_listcontact_department3->getOrderFieldValue($row_rscontact_department1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_contact_department&amp;id_contact_department=<?php echo $row_rscontact_department1['id_contact_department']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rscontact_department1 = mysql_fetch_assoc($rscontact_department1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listcontact_department3->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_contact_department&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rscontact_department1);
?>
