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
$tor_listmenu2 = new TOR_SetOrder($conn_ketnoi, 'menu', 'id_menu', 'NUMERIC_TYPE', 'sort', 'listmenu2_sort_order');
$tor_listmenu2->Execute();

// Filter
$tfi_listmenu2 = new TFI_TableFilter($conn_ketnoi, "tfi_listmenu2");
$tfi_listmenu2->addColumn("menu.menu_name", "STRING_TYPE", "menu_name", "%");
$tfi_listmenu2->addColumn("menu.menu_name_EN", "STRING_TYPE", "menu_name_EN", "%");
$tfi_listmenu2->addColumn("menu.url", "STRING_TYPE", "url", "%");
$tfi_listmenu2->addColumn("menu.outlink", "STRING_TYPE", "outlink", "%");
$tfi_listmenu2->addColumn("menu.notes", "STRING_TYPE", "notes", "%");
$tfi_listmenu2->addColumn("menu.notes_EN", "STRING_TYPE", "notes_EN", "%");
$tfi_listmenu2->addColumn("menu.target", "STRING_TYPE", "target", "%");
$tfi_listmenu2->addColumn("menu.position", "STRING_TYPE", "position", "%");
$tfi_listmenu2->addColumn("menu.visible", "CHECKBOX_1_0_TYPE", "visible", "%");
$tfi_listmenu2->Execute();

// Sorter
$tso_listmenu2 = new TSO_TableSorter("rsmenu1", "tso_listmenu2");
$tso_listmenu2->addColumn("menu.sort"); // Order column
$tso_listmenu2->setDefault("menu.sort");
$tso_listmenu2->Execute();

// Navigation
$nav_listmenu2 = new NAV_Regular("nav_listmenu2", "rsmenu1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsmenu1 = $_SESSION['max_rows_nav_listmenu2'];
$pageNum_rsmenu1 = 0;
if (isset($_GET['pageNum_rsmenu1'])) {
  $pageNum_rsmenu1 = $_GET['pageNum_rsmenu1'];
}
$startRow_rsmenu1 = $pageNum_rsmenu1 * $maxRows_rsmenu1;

// Defining List Recordset variable
$NXTFilter_rsmenu1 = "1=1";
if (isset($_SESSION['filter_tfi_listmenu2'])) {
  $NXTFilter_rsmenu1 = $_SESSION['filter_tfi_listmenu2'];
}
// Defining List Recordset variable
$NXTSort_rsmenu1 = "menu.sort";
if (isset($_SESSION['sorter_tso_listmenu2'])) {
  $NXTSort_rsmenu1 = $_SESSION['sorter_tso_listmenu2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsmenu1 = "SELECT menu.menu_name, menu.menu_name_EN, menu.url, menu.outlink, menu.notes, menu.notes_EN, menu.target, menu.position, menu.visible, menu.id_menu, menu.sort FROM menu WHERE {$NXTFilter_rsmenu1} ORDER BY {$NXTSort_rsmenu1}";
$query_limit_rsmenu1 = sprintf("%s LIMIT %d, %d", $query_rsmenu1, $startRow_rsmenu1, $maxRows_rsmenu1);
$rsmenu1 = mysql_query($query_limit_rsmenu1, $ketnoi) or die(mysql_error());
$row_rsmenu1 = mysql_fetch_assoc($rsmenu1);

if (isset($_GET['totalRows_rsmenu1'])) {
  $totalRows_rsmenu1 = $_GET['totalRows_rsmenu1'];
} else {
  $all_rsmenu1 = mysql_query($query_rsmenu1);
  $totalRows_rsmenu1 = mysql_num_rows($all_rsmenu1);
}
$totalPages_rsmenu1 = ceil($totalRows_rsmenu1/$maxRows_rsmenu1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listmenu2->checkBoundries();
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
  .KT_col_menu_name {width:100px; overflow:hidden;}
  .KT_col_menu_name_EN {width:100px; overflow:hidden;}
  .KT_col_url {width:100px; overflow:hidden;}
  .KT_col_outlink {width:100px; overflow:hidden;}
  .KT_col_notes {width:100px; overflow:hidden;}
  .KT_col_notes_EN {width:100px; overflow:hidden;}
  .KT_col_target {width:50px; overflow:hidden;}
  .KT_col_position {width:80px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listmenu2->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listmenu2">
  <h1> Menu
    <?php
  $nav_listmenu2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listmenu2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listmenu2'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listmenu2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listmenu2'] == 1) {
?>
                  <a href="<?php echo $tfi_listmenu2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listmenu2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="menu_name" class="KT_col_menu_name">Menu name</th>
            <th id="menu_name_EN" class="KT_col_menu_name_EN">Menu name(English)</th>
            <th id="url" class="KT_col_url">Url</th>
            <th id="outlink" class="KT_col_outlink">Outlink</th>
            <th id="notes" class="KT_col_notes">Notes</th>
            <th id="notes_EN" class="KT_col_notes_EN">notes(English)</th>
            <th id="target" class="KT_col_target">Target</th>
            <th id="position" class="KT_col_position">Position</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listmenu2->getSortIcon('menu.sort'); ?> KT_order"> <a href="<?php echo $tso_listmenu2->getSortLink('menu.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listmenu2'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listmenu2_menu_name" id="tfi_listmenu2_menu_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_menu_name']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listmenu2_menu_name_EN" id="tfi_listmenu2_menu_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_menu_name_EN']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listmenu2_url" id="tfi_listmenu2_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_url']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listmenu2_outlink" id="tfi_listmenu2_outlink" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_outlink']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listmenu2_notes" id="tfi_listmenu2_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_notes']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listmenu2_notes_EN" id="tfi_listmenu2_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_notes_EN']); ?>" size="20" maxlength="100" /></td>
              <td><select name="tfi_listmenu2_target" id="tfi_listmenu2_target">
                  <option value="_self" <?php if (!(strcmp("_self", KT_escapeAttribute(@$_SESSION['tfi_listmenu2_target'])))) {echo "SELECTED";} ?>>self</option>
                  <option value="_blank" <?php if (!(strcmp("_blank", KT_escapeAttribute(@$_SESSION['tfi_listmenu2_target'])))) {echo "SELECTED";} ?>>blank</option>
                </select>
              </td>
              <td><input type="text" name="tfi_listmenu2_position" id="tfi_listmenu2_position" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmenu2_position']); ?>" size="20" maxlength="20" /></td>
              <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listmenu2_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listmenu2_visible" id="tfi_listmenu2_visible" value="1" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listmenu2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsmenu1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="12"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsmenu1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_menu" class="id_checkbox" value="<?php echo $row_rsmenu1['id_menu']; ?>" />
                    <input type="hidden" name="id_menu" class="id_field" value="<?php echo $row_rsmenu1['id_menu']; ?>" />
                </td>
                <td><div class="KT_col_menu_name"><?php echo KT_FormatForList($row_rsmenu1['menu_name'], 20); ?></div></td>
                <td><div class="KT_col_menu_name_EN"><?php echo KT_FormatForList($row_rsmenu1['menu_name_EN'], 20); ?></div></td>
                <td><div class="KT_col_url"><?php echo KT_FormatForList($row_rsmenu1['url'], 20); ?></div></td>
                <td><div class="KT_col_outlink"><?php echo KT_FormatForList($row_rsmenu1['outlink'], 20); ?></div></td>
                <td><div class="KT_col_notes"><?php echo KT_FormatForList($row_rsmenu1['notes'], 20); ?></div></td>
                <td><div class="KT_col_notes_EN"><?php echo KT_FormatForList($row_rsmenu1['notes_EN'], 20); ?></div></td>
                <td><div class="KT_col_target"><?php echo KT_FormatForList($row_rsmenu1['target'], 10); ?></div></td>
                <td><div class="KT_col_position"><?php echo KT_FormatForList($row_rsmenu1['position'], 20); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsmenu1['visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listmenu2->getOrderFieldName() ?>" value="<?php echo $tor_listmenu2->getOrderFieldValue($row_rsmenu1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_menu&amp;id_menu=<?php echo $row_rsmenu1['id_menu']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsmenu1 = mysql_fetch_assoc($rsmenu1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listmenu2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_menu&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsmenu1);
?>
