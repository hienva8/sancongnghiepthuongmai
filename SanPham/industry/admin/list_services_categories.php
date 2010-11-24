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
$tor_listservices_categories1 = new TOR_SetOrder($conn_ketnoi, 'services_categories', 'id_services_categories', 'NUMERIC_TYPE', 'svcat_sort', 'listservices_categories1_svcat_sort_order');
$tor_listservices_categories1->Execute();

// Filter
$tfi_listservices_categories1 = new TFI_TableFilter($conn_ketnoi, "tfi_listservices_categories1");
$tfi_listservices_categories1->addColumn("services_categories.svcat_name", "STRING_TYPE", "svcat_name", "%");
$tfi_listservices_categories1->addColumn("services_categories.svcat_name_EN", "STRING_TYPE", "svcat_name_EN", "%");
$tfi_listservices_categories1->addColumn("services_categories.svcat_url", "STRING_TYPE", "svcat_url", "%");
$tfi_listservices_categories1->addColumn("services_categories.svcat_notes", "STRING_TYPE", "svcat_notes", "%");
$tfi_listservices_categories1->addColumn("services_categories.svcat_notes_EN", "STRING_TYPE", "svcat_notes_EN", "%");
$tfi_listservices_categories1->addColumn("services_categories.svcat_visible", "NUMERIC_TYPE", "svcat_visible", "=");
$tfi_listservices_categories1->Execute();

// Sorter
$tso_listservices_categories1 = new TSO_TableSorter("rsservices_categories1", "tso_listservices_categories1");
$tso_listservices_categories1->addColumn("services_categories.svcat_sort"); // Order column
$tso_listservices_categories1->setDefault("services_categories.svcat_sort");
$tso_listservices_categories1->Execute();

// Navigation
$nav_listservices_categories1 = new NAV_Regular("nav_listservices_categories1", "rsservices_categories1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsservices_categories1 = $_SESSION['max_rows_nav_listservices_categories1'];
$pageNum_rsservices_categories1 = 0;
if (isset($_GET['pageNum_rsservices_categories1'])) {
  $pageNum_rsservices_categories1 = $_GET['pageNum_rsservices_categories1'];
}
$startRow_rsservices_categories1 = $pageNum_rsservices_categories1 * $maxRows_rsservices_categories1;

// Defining List Recordset variable
$NXTFilter_rsservices_categories1 = "1=1";
if (isset($_SESSION['filter_tfi_listservices_categories1'])) {
  $NXTFilter_rsservices_categories1 = $_SESSION['filter_tfi_listservices_categories1'];
}
// Defining List Recordset variable
$NXTSort_rsservices_categories1 = "services_categories.svcat_sort";
if (isset($_SESSION['sorter_tso_listservices_categories1'])) {
  $NXTSort_rsservices_categories1 = $_SESSION['sorter_tso_listservices_categories1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsservices_categories1 = "SELECT services_categories.svcat_name, services_categories.svcat_name_EN, services_categories.svcat_url, services_categories.svcat_notes, services_categories.svcat_notes_EN, services_categories.svcat_visible, services_categories.id_services_categories, services_categories.svcat_sort FROM services_categories WHERE {$NXTFilter_rsservices_categories1} ORDER BY {$NXTSort_rsservices_categories1}";
$query_limit_rsservices_categories1 = sprintf("%s LIMIT %d, %d", $query_rsservices_categories1, $startRow_rsservices_categories1, $maxRows_rsservices_categories1);
$rsservices_categories1 = mysql_query($query_limit_rsservices_categories1, $ketnoi) or die(mysql_error());
$row_rsservices_categories1 = mysql_fetch_assoc($rsservices_categories1);

if (isset($_GET['totalRows_rsservices_categories1'])) {
  $totalRows_rsservices_categories1 = $_GET['totalRows_rsservices_categories1'];
} else {
  $all_rsservices_categories1 = mysql_query($query_rsservices_categories1);
  $totalRows_rsservices_categories1 = mysql_num_rows($all_rsservices_categories1);
}
$totalPages_rsservices_categories1 = ceil($totalRows_rsservices_categories1/$maxRows_rsservices_categories1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listservices_categories1->checkBoundries();
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
  .KT_col_svcat_name {width:140px; overflow:hidden;}
  .KT_col_svcat_name_EN {width:140px; overflow:hidden;}
  .KT_col_svcat_url {width:140px; overflow:hidden;}
  .KT_col_svcat_notes {width:100px; overflow:hidden;}
  .KT_col_svcat_notes_EN {width:100px; overflow:hidden;}
  .KT_col_svcat_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listservices_categories1->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listservices_categories1">
  <h1> Services categories
    <?php
  $nav_listservices_categories1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listservices_categories1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listservices_categories1'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listservices_categories1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listservices_categories1'] == 1) {
?>
                  <a href="<?php echo $tfi_listservices_categories1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listservices_categories1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="svcat_name" class="KT_col_svcat_name">Title</th>
            <th id="svcat_name_EN" class="KT_col_svcat_name_EN">Title(English)</th>
            <th id="svcat_url" class="KT_col_svcat_url">Url</th>
            <th id="svcat_notes" class="KT_col_svcat_notes">Notes</th>
            <th id="svcat_notes_EN" class="KT_col_svcat_notes_EN">Notes(English)</th>
            <th id="svcat_visible" class="KT_col_svcat_visible">Visible</th>
            <th id="svcat_sort" class="KT_sorter <?php echo $tso_listservices_categories1->getSortIcon('services_categories.svcat_sort'); ?> KT_order"> <a href="<?php echo $tso_listservices_categories1->getSortLink('services_categories.svcat_sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listservices_categories1'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listservices_categories1_svcat_name" id="tfi_listservices_categories1_svcat_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices_categories1_svcat_name']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listservices_categories1_svcat_name_EN" id="tfi_listservices_categories1_svcat_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices_categories1_svcat_name_EN']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listservices_categories1_svcat_url" id="tfi_listservices_categories1_svcat_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices_categories1_svcat_url']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listservices_categories1_svcat_notes" id="tfi_listservices_categories1_svcat_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices_categories1_svcat_notes']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listservices_categories1_svcat_notes_EN" id="tfi_listservices_categories1_svcat_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices_categories1_svcat_notes_EN']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listservices_categories1_svcat_visible" id="tfi_listservices_categories1_svcat_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices_categories1_svcat_visible']); ?>" size="20" maxlength="100" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listservices_categories1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsservices_categories1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="9"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsservices_categories1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_services_categories" class="id_checkbox" value="<?php echo $row_rsservices_categories1['id_services_categories']; ?>" />
                    <input type="hidden" name="id_services_categories" class="id_field" value="<?php echo $row_rsservices_categories1['id_services_categories']; ?>" />
                </td>
                <td><div class="KT_col_svcat_name"><?php echo KT_FormatForList($row_rsservices_categories1['svcat_name'], 20); ?></div></td>
                <td><div class="KT_col_svcat_name_EN"><?php echo KT_FormatForList($row_rsservices_categories1['svcat_name_EN'], 20); ?></div></td>
                <td><div class="KT_col_svcat_url"><?php echo KT_FormatForList($row_rsservices_categories1['svcat_url'], 20); ?></div></td>
                <td><div class="KT_col_svcat_notes"><?php echo KT_FormatForList($row_rsservices_categories1['svcat_notes'], 20); ?></div></td>
                <td><div class="KT_col_svcat_notes_EN"><?php echo KT_FormatForList($row_rsservices_categories1['svcat_notes_EN'], 20); ?></div></td>
                <td><div class="KT_col_svcat_visible"><?php echo KT_FormatForList($row_rsservices_categories1['svcat_visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listservices_categories1->getOrderFieldName() ?>" value="<?php echo $tor_listservices_categories1->getOrderFieldValue($row_rsservices_categories1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_services_categories&amp;id_services_categories=<?php echo $row_rsservices_categories1['id_services_categories']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsservices_categories1 = mysql_fetch_assoc($rsservices_categories1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listservices_categories1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_services_categories&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsservices_categories1);
?>
