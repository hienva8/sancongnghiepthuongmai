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
$tor_listhelp2 = new TOR_SetOrder($conn_ketnoi, 'help', 'id_help', 'NUMERIC_TYPE', 'sort', 'listhelp2_sort_order');
$tor_listhelp2->Execute();

// Filter
$tfi_listhelp2 = new TFI_TableFilter($conn_ketnoi, "tfi_listhelp2");
$tfi_listhelp2->addColumn("help.title", "STRING_TYPE", "title", "%");
$tfi_listhelp2->addColumn("help.title_EN", "STRING_TYPE", "title_EN", "%");
$tfi_listhelp2->addColumn("help.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listhelp2->addColumn("help.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listhelp2->Execute();

// Sorter
$tso_listhelp2 = new TSO_TableSorter("rshelp1", "tso_listhelp2");
$tso_listhelp2->addColumn("help.sort"); // Order column
$tso_listhelp2->setDefault("help.sort");
$tso_listhelp2->Execute();

// Navigation
$nav_listhelp2 = new NAV_Regular("nav_listhelp2", "rshelp1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rshelp1 = $_SESSION['max_rows_nav_listhelp2'];
$pageNum_rshelp1 = 0;
if (isset($_GET['pageNum_rshelp1'])) {
  $pageNum_rshelp1 = $_GET['pageNum_rshelp1'];
}
$startRow_rshelp1 = $pageNum_rshelp1 * $maxRows_rshelp1;

// Defining List Recordset variable
$NXTFilter_rshelp1 = "1=1";
if (isset($_SESSION['filter_tfi_listhelp2'])) {
  $NXTFilter_rshelp1 = $_SESSION['filter_tfi_listhelp2'];
}
// Defining List Recordset variable
$NXTSort_rshelp1 = "help.sort";
if (isset($_SESSION['sorter_tso_listhelp2'])) {
  $NXTSort_rshelp1 = $_SESSION['sorter_tso_listhelp2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rshelp1 = "SELECT help.title, help.title_EN, help.day_update, help.visible, help.id_help, help.sort FROM help WHERE {$NXTFilter_rshelp1} ORDER BY {$NXTSort_rshelp1}";
$query_limit_rshelp1 = sprintf("%s LIMIT %d, %d", $query_rshelp1, $startRow_rshelp1, $maxRows_rshelp1);
$rshelp1 = mysql_query($query_limit_rshelp1, $ketnoi) or die(mysql_error());
$row_rshelp1 = mysql_fetch_assoc($rshelp1);

if (isset($_GET['totalRows_rshelp1'])) {
  $totalRows_rshelp1 = $_GET['totalRows_rshelp1'];
} else {
  $all_rshelp1 = mysql_query($query_rshelp1);
  $totalRows_rshelp1 = mysql_num_rows($all_rshelp1);
}
$totalPages_rshelp1 = ceil($totalRows_rshelp1/$maxRows_rshelp1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listhelp2->checkBoundries();
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
  duplicate_buttons: true,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script>
<style type="text/css">
  /* Dynamic List row settings */
  .KT_col_title {width:140px; overflow:hidden;}
  .KT_col_title_EN {width:140px; overflow:hidden;}
  .KT_col_day_update {width:140px; overflow:hidden;}
  .KT_col_visible {width:140px; overflow:hidden;}
</style>
<?php echo $tor_listhelp2->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listhelp2">
  <h1> Help
    <?php
  $nav_listhelp2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listhelp2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listhelp2'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listhelp2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listhelp2'] == 1) {
?>
                  <a href="<?php echo $tfi_listhelp2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listhelp2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="title" class="KT_col_title">Title</th>
            <th id="title_EN" class="KT_col_title_EN">Title(English)</th>
            <th id="day_update" class="KT_col_day_update">Day update</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listhelp2->getSortIcon('help.sort'); ?> KT_order"> <a href="<?php echo $tso_listhelp2->getSortLink('help.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listhelp2'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listhelp2_title" id="tfi_listhelp2_title" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhelp2_title']); ?>" size="20" maxlength="200" /></td>
              <td><input type="text" name="tfi_listhelp2_title_EN" id="tfi_listhelp2_title_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhelp2_title_EN']); ?>" size="20" maxlength="200" /></td>
              <td><input type="text" name="tfi_listhelp2_day_update" id="tfi_listhelp2_day_update" value="<?php echo @$_SESSION['tfi_listhelp2_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listhelp2_visible" id="tfi_listhelp2_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhelp2_visible']); ?>" size="20" maxlength="100" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listhelp2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rshelp1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rshelp1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_help" class="id_checkbox" value="<?php echo $row_rshelp1['id_help']; ?>" />
                    <input type="hidden" name="id_help" class="id_field" value="<?php echo $row_rshelp1['id_help']; ?>" />
                </td>
                <td><div class="KT_col_title"><?php echo KT_FormatForList($row_rshelp1['title'], 20); ?></div></td>
                <td><div class="KT_col_title_EN"><?php echo KT_FormatForList($row_rshelp1['title_EN'], 20); ?></div></td>
                <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rshelp1['day_update']); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rshelp1['visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listhelp2->getOrderFieldName() ?>" value="<?php echo $tor_listhelp2->getOrderFieldValue($row_rshelp1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_help&amp;id_help=<?php echo $row_rshelp1['id_help']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rshelp1 = mysql_fetch_assoc($rshelp1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listhelp2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_help&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rshelp1);
?>
