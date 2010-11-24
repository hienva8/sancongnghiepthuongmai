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
$tor_listprocat1 = new TOR_SetOrder($conn_ketnoi, 'procat', 'id_procat', 'NUMERIC_TYPE', 'sort', 'listprocat1_sort_order');
$tor_listprocat1->Execute();

// Filter
$tfi_listprocat1 = new TFI_TableFilter($conn_ketnoi, "tfi_listprocat1");
$tfi_listprocat1->addColumn("procat.procat_name", "STRING_TYPE", "procat_name", "%");
$tfi_listprocat1->addColumn("procat.procat_name_EN", "STRING_TYPE", "procat_name_EN", "%");
$tfi_listprocat1->addColumn("procat.url", "STRING_TYPE", "url", "%");
$tfi_listprocat1->addColumn("procat.notes", "STRING_TYPE", "notes", "%");
$tfi_listprocat1->addColumn("procat.notes_EN", "STRING_TYPE", "notes_EN", "%");
$tfi_listprocat1->addColumn("procat.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listprocat1->addColumn("procat.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listprocat1->Execute();

// Sorter
$tso_listprocat1 = new TSO_TableSorter("rsprocat1", "tso_listprocat1");
$tso_listprocat1->addColumn("procat.sort"); // Order column
$tso_listprocat1->setDefault("procat.sort");
$tso_listprocat1->Execute();

// Navigation
$nav_listprocat1 = new NAV_Regular("nav_listprocat1", "rsprocat1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsprocat1 = $_SESSION['max_rows_nav_listprocat1'];
$pageNum_rsprocat1 = 0;
if (isset($_GET['pageNum_rsprocat1'])) {
  $pageNum_rsprocat1 = $_GET['pageNum_rsprocat1'];
}
$startRow_rsprocat1 = $pageNum_rsprocat1 * $maxRows_rsprocat1;

// Defining List Recordset variable
$NXTFilter_rsprocat1 = "1=1";
if (isset($_SESSION['filter_tfi_listprocat1'])) {
  $NXTFilter_rsprocat1 = $_SESSION['filter_tfi_listprocat1'];
}
// Defining List Recordset variable
$NXTSort_rsprocat1 = "procat.sort";
if (isset($_SESSION['sorter_tso_listprocat1'])) {
  $NXTSort_rsprocat1 = $_SESSION['sorter_tso_listprocat1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsprocat1 = "SELECT procat.procat_name, procat.procat_name_EN, procat.url, procat.notes, procat.notes_EN, procat.day_update, procat.visible, procat.id_procat, procat.sort FROM procat WHERE {$NXTFilter_rsprocat1} ORDER BY {$NXTSort_rsprocat1}";
$query_limit_rsprocat1 = sprintf("%s LIMIT %d, %d", $query_rsprocat1, $startRow_rsprocat1, $maxRows_rsprocat1);
$rsprocat1 = mysql_query($query_limit_rsprocat1, $ketnoi) or die(mysql_error());
$row_rsprocat1 = mysql_fetch_assoc($rsprocat1);

if (isset($_GET['totalRows_rsprocat1'])) {
  $totalRows_rsprocat1 = $_GET['totalRows_rsprocat1'];
} else {
  $all_rsprocat1 = mysql_query($query_rsprocat1);
  $totalRows_rsprocat1 = mysql_num_rows($all_rsprocat1);
}
$totalPages_rsprocat1 = ceil($totalRows_rsprocat1/$maxRows_rsprocat1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listprocat1->checkBoundries();
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
  .KT_col_procat_name {width:100px; overflow:hidden;}
  .KT_col_procat_name_EN {width:100px; overflow:hidden;}
  .KT_col_url {width:100px; overflow:hidden;}
  .KT_col_notes {width:100px; overflow:hidden;}
  .KT_col_notes_EN {width:100px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listprocat1->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listprocat1">
  <h1> Catalogue
    <?php
  $nav_listprocat1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listprocat1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listprocat1'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listprocat1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listprocat1'] == 1) {
?>
                  <a href="<?php echo $tfi_listprocat1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listprocat1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="procat_name" class="KT_col_procat_name">Catalogue name</th>
            <th id="procat_name_EN" class="KT_col_procat_name_EN">Catalogue name(English)</th>
            <th id="url" class="KT_col_url">Url</th>
            <th id="notes" class="KT_col_notes">Notes</th>
            <th id="notes_EN" class="KT_col_notes_EN">notes_EN</th>
            <th id="day_update" class="KT_col_day_update">Day_update</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listprocat1->getSortIcon('procat.sort'); ?> KT_order"> <a href="<?php echo $tso_listprocat1->getSortLink('procat.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listprocat1'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listprocat1_procat_name" id="tfi_listprocat1_procat_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprocat1_procat_name']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listprocat1_procat_name_EN" id="tfi_listprocat1_procat_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprocat1_procat_name_EN']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listprocat1_url" id="tfi_listprocat1_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprocat1_url']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listprocat1_notes" id="tfi_listprocat1_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprocat1_notes']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listprocat1_notes_EN" id="tfi_listprocat1_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprocat1_notes_EN']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listprocat1_day_update" id="tfi_listprocat1_day_update" value="<?php echo @$_SESSION['tfi_listprocat1_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listprocat1_visible" id="tfi_listprocat1_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprocat1_visible']); ?>" size="20" maxlength="100" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listprocat1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsprocat1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="10"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsprocat1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_procat" class="id_checkbox" value="<?php echo $row_rsprocat1['id_procat']; ?>" />
                    <input type="hidden" name="id_procat" class="id_field" value="<?php echo $row_rsprocat1['id_procat']; ?>" />
                </td>
                <td><div class="KT_col_procat_name"><?php echo KT_FormatForList($row_rsprocat1['procat_name'], 20); ?></div></td>
                <td><div class="KT_col_procat_name_EN"><?php echo KT_FormatForList($row_rsprocat1['procat_name_EN'], 20); ?></div></td>
                <td><div class="KT_col_url"><?php echo KT_FormatForList($row_rsprocat1['url'], 20); ?></div></td>
                <td><div class="KT_col_notes"><?php echo KT_FormatForList($row_rsprocat1['notes'], 20); ?></div></td>
                <td><div class="KT_col_notes_EN"><?php echo KT_FormatForList($row_rsprocat1['notes_EN'], 20); ?></div></td>
                <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rsprocat1['day_update']); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsprocat1['visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listprocat1->getOrderFieldName() ?>" value="<?php echo $tor_listprocat1->getOrderFieldValue($row_rsprocat1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_procat&amp;id_procat=<?php echo $row_rsprocat1['id_procat']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsprocat1 = mysql_fetch_assoc($rsprocat1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listprocat1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_procat&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsprocat1);
?>
