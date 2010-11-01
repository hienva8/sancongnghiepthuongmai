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
$tor_listprosubcat4 = new TOR_SetOrder($conn_ketnoi, 'prosubcat2', 'id_prosubcat2', 'NUMERIC_TYPE', 'sort', 'listprosubcat4_sort_order');
$tor_listprosubcat4->Execute();

// Filter
$tfi_listprosubcat4 = new TFI_TableFilter($conn_ketnoi, "tfi_listprosubcat4");
$tfi_listprosubcat4->addColumn("prosubcat2.prosubcat2_name", "STRING_TYPE", "prosubcat2_name", "%");
$tfi_listprosubcat4->addColumn("prosubcat2.prosubcat2_name_EN", "STRING_TYPE", "prosubcat2_name_EN", "%");
$tfi_listprosubcat4->addColumn("prosubcat2.url", "STRING_TYPE", "url", "%");
$tfi_listprosubcat4->addColumn("prosubcat2.notes", "STRING_TYPE", "notes", "%");
$tfi_listprosubcat4->addColumn("prosubcat2.notes_EN", "STRING_TYPE", "notes_EN", "%");
$tfi_listprosubcat4->addColumn("prosubcat2.id_procat", "NUMERIC_TYPE", "id_procat", "=");
$tfi_listprosubcat4->addColumn("prosubcat2.id_prosubcat1", "NUMERIC_TYPE", "id_prosubcat1", "=");
$tfi_listprosubcat4->addColumn("prosubcat2.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listprosubcat4->addColumn("prosubcat2.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listprosubcat4->Execute();

// Sorter
$tso_listprosubcat4 = new TSO_TableSorter("rsprosubcat2", "tso_listprosubcat4");
$tso_listprosubcat4->addColumn("prosubcat2.sort"); // Order column
$tso_listprosubcat4->setDefault("prosubcat2.sort");
$tso_listprosubcat4->Execute();

// Navigation
$nav_listprosubcat4 = new NAV_Regular("nav_listprosubcat4", "rsprosubcat2", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsprosubcat2 = $_SESSION['max_rows_nav_listprosubcat4'];
$pageNum_rsprosubcat2 = 0;
if (isset($_GET['pageNum_rsprosubcat2'])) {
  $pageNum_rsprosubcat2 = $_GET['pageNum_rsprosubcat2'];
}
$startRow_rsprosubcat2 = $pageNum_rsprosubcat2 * $maxRows_rsprosubcat2;

// Defining List Recordset variable
$NXTFilter_rsprosubcat2 = "1=1";
if (isset($_SESSION['filter_tfi_listprosubcat4'])) {
  $NXTFilter_rsprosubcat2 = $_SESSION['filter_tfi_listprosubcat4'];
}
// Defining List Recordset variable
$NXTSort_rsprosubcat2 = "prosubcat2.sort";
if (isset($_SESSION['sorter_tso_listprosubcat4'])) {
  $NXTSort_rsprosubcat2 = $_SESSION['sorter_tso_listprosubcat4'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsprosubcat2 = "SELECT prosubcat2.prosubcat2_name, prosubcat2.prosubcat2_name_EN, prosubcat2.url, prosubcat2.notes, prosubcat2.notes_EN, prosubcat2.id_procat, prosubcat2.id_prosubcat1, prosubcat2.day_update, prosubcat2.visible, prosubcat2.id_prosubcat2, prosubcat2.sort FROM prosubcat2 WHERE {$NXTFilter_rsprosubcat2} ORDER BY {$NXTSort_rsprosubcat2}";
$query_limit_rsprosubcat2 = sprintf("%s LIMIT %d, %d", $query_rsprosubcat2, $startRow_rsprosubcat2, $maxRows_rsprosubcat2);
$rsprosubcat2 = mysql_query($query_limit_rsprosubcat2, $ketnoi) or die(mysql_error());
$row_rsprosubcat2 = mysql_fetch_assoc($rsprosubcat2);

if (isset($_GET['totalRows_rsprosubcat2'])) {
  $totalRows_rsprosubcat2 = $_GET['totalRows_rsprosubcat2'];
} else {
  $all_rsprosubcat2 = mysql_query($query_rsprosubcat2);
  $totalRows_rsprosubcat2 = mysql_num_rows($all_rsprosubcat2);
}
$totalPages_rsprosubcat2 = ceil($totalRows_rsprosubcat2/$maxRows_rsprosubcat2)-1;
//End NeXTenesio3 Special List Recordset

$nav_listprosubcat4->checkBoundries();
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
  .KT_col_prosubcat2_name {width:100px; overflow:hidden;}
  .KT_col_prosubcat2_name_EN {width:100px; overflow:hidden;}
  .KT_col_url {width:100px; overflow:hidden;}
  .KT_col_notes {width:100px; overflow:hidden;}
  .KT_col_notes_EN {width:100px; overflow:hidden;}
  .KT_col_id_procat {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat1 {width:100px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listprosubcat4->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listprosubcat4">
  <h1> Sub catalogue2
    <?php
  $nav_listprosubcat4->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listprosubcat4->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listprosubcat4'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listprosubcat4']; ?>
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
  if (@$_SESSION['has_filter_tfi_listprosubcat4'] == 1) {
?>
                  <a href="<?php echo $tfi_listprosubcat4->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listprosubcat4->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="prosubcat2_name" class="KT_col_prosubcat2_name">Sub catalogue2</th>
            <th id="prosubcat2_name_EN" class="KT_col_prosubcat2_name_EN">Sub catalogue2(English)</th>
            <th id="url" class="KT_col_url">Url</th>
            <th id="notes" class="KT_col_notes">Notes</th>
            <th id="notes_EN" class="KT_col_notes_EN">Notes(English)</th>
            <th id="id_procat" class="KT_col_id_procat">Catalogue</th>
            <th id="id_prosubcat1" class="KT_col_id_prosubcat1">Sub catalogue1</th>
            <th id="day_update" class="KT_col_day_update">Day update</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listprosubcat4->getSortIcon('prosubcat2.sort'); ?> KT_order"> <a href="<?php echo $tso_listprosubcat4->getSortLink('prosubcat2.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listprosubcat4'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listprosubcat4_prosubcat2_name" id="tfi_listprosubcat4_prosubcat2_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_prosubcat2_name']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listprosubcat4_prosubcat2_name_EN" id="tfi_listprosubcat4_prosubcat2_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_prosubcat2_name_EN']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listprosubcat4_url" id="tfi_listprosubcat4_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_url']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listprosubcat4_notes" id="tfi_listprosubcat4_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_notes']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listprosubcat4_notes_EN" id="tfi_listprosubcat4_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_notes_EN']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listprosubcat4_id_procat" id="tfi_listprosubcat4_id_procat" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_id_procat']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listprosubcat4_id_prosubcat1" id="tfi_listprosubcat4_id_prosubcat1" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_id_prosubcat1']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listprosubcat4_day_update" id="tfi_listprosubcat4_day_update" value="<?php echo @$_SESSION['tfi_listprosubcat4_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listprosubcat4_visible" id="tfi_listprosubcat4_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat4_visible']); ?>" size="20" maxlength="100" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listprosubcat4" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsprosubcat2 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="12"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsprosubcat2 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_prosubcat2" class="id_checkbox" value="<?php echo $row_rsprosubcat2['id_prosubcat2']; ?>" />
                    <input type="hidden" name="id_prosubcat2" class="id_field" value="<?php echo $row_rsprosubcat2['id_prosubcat2']; ?>" />
                </td>
                <td><div class="KT_col_prosubcat2_name"><?php echo KT_FormatForList($row_rsprosubcat2['prosubcat2_name'], 20); ?></div></td>
                <td><div class="KT_col_prosubcat2_name_EN"><?php echo KT_FormatForList($row_rsprosubcat2['prosubcat2_name_EN'], 20); ?></div></td>
                <td><div class="KT_col_url"><?php echo KT_FormatForList($row_rsprosubcat2['url'], 20); ?></div></td>
                <td><div class="KT_col_notes"><?php echo KT_FormatForList($row_rsprosubcat2['notes'], 20); ?></div></td>
                <td><div class="KT_col_notes_EN"><?php echo KT_FormatForList($row_rsprosubcat2['notes_EN'], 20); ?></div></td>
                <td><div class="KT_col_id_procat"><?php echo KT_FormatForList($row_rsprosubcat2['id_procat'], 20); ?></div></td>
                <td><div class="KT_col_id_prosubcat1"><?php echo KT_FormatForList($row_rsprosubcat2['id_prosubcat1'], 20); ?></div></td>
                <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rsprosubcat2['day_update']); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsprosubcat2['visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listprosubcat4->getOrderFieldName() ?>" value="<?php echo $tor_listprosubcat4->getOrderFieldValue($row_rsprosubcat2) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_prosubcat2&amp;id_prosubcat2=<?php echo $row_rsprosubcat2['id_prosubcat2']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsprosubcat2 = mysql_fetch_assoc($rsprosubcat2)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listprosubcat4->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_prosubcat2&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsprosubcat2);
?>
