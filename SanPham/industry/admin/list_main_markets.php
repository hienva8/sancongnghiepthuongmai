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
$tor_listmain_markets1 = new TOR_SetOrder($conn_ketnoi, 'main_markets', 'id_main_markets', 'NUMERIC_TYPE', 'main_market_sort', 'listmain_markets1_main_market_sort_order');
$tor_listmain_markets1->Execute();

// Filter
$tfi_listmain_markets1 = new TFI_TableFilter($conn_ketnoi, "tfi_listmain_markets1");
$tfi_listmain_markets1->addColumn("main_markets.main_market_name", "STRING_TYPE", "main_market_name", "%");
$tfi_listmain_markets1->addColumn("main_markets.main_market_name_EN", "STRING_TYPE", "main_market_name_EN", "%");
$tfi_listmain_markets1->Execute();

// Sorter
$tso_listmain_markets1 = new TSO_TableSorter("rsmain_markets1", "tso_listmain_markets1");
$tso_listmain_markets1->addColumn("main_markets.main_market_sort"); // Order column
$tso_listmain_markets1->setDefault("main_markets.main_market_sort");
$tso_listmain_markets1->Execute();

// Navigation
$nav_listmain_markets1 = new NAV_Regular("nav_listmain_markets1", "rsmain_markets1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsmain_markets1 = $_SESSION['max_rows_nav_listmain_markets1'];
$pageNum_rsmain_markets1 = 0;
if (isset($_GET['pageNum_rsmain_markets1'])) {
  $pageNum_rsmain_markets1 = $_GET['pageNum_rsmain_markets1'];
}
$startRow_rsmain_markets1 = $pageNum_rsmain_markets1 * $maxRows_rsmain_markets1;

// Defining List Recordset variable
$NXTFilter_rsmain_markets1 = "1=1";
if (isset($_SESSION['filter_tfi_listmain_markets1'])) {
  $NXTFilter_rsmain_markets1 = $_SESSION['filter_tfi_listmain_markets1'];
}
// Defining List Recordset variable
$NXTSort_rsmain_markets1 = "main_markets.main_market_sort";
if (isset($_SESSION['sorter_tso_listmain_markets1'])) {
  $NXTSort_rsmain_markets1 = $_SESSION['sorter_tso_listmain_markets1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsmain_markets1 = "SELECT main_markets.main_market_name, main_markets.main_market_name_EN, main_markets.id_main_markets, main_markets.main_market_sort FROM main_markets WHERE {$NXTFilter_rsmain_markets1} ORDER BY {$NXTSort_rsmain_markets1}";
$query_limit_rsmain_markets1 = sprintf("%s LIMIT %d, %d", $query_rsmain_markets1, $startRow_rsmain_markets1, $maxRows_rsmain_markets1);
$rsmain_markets1 = mysql_query($query_limit_rsmain_markets1, $ketnoi) or die(mysql_error());
$row_rsmain_markets1 = mysql_fetch_assoc($rsmain_markets1);

if (isset($_GET['totalRows_rsmain_markets1'])) {
  $totalRows_rsmain_markets1 = $_GET['totalRows_rsmain_markets1'];
} else {
  $all_rsmain_markets1 = mysql_query($query_rsmain_markets1);
  $totalRows_rsmain_markets1 = mysql_num_rows($all_rsmain_markets1);
}
$totalPages_rsmain_markets1 = ceil($totalRows_rsmain_markets1/$maxRows_rsmain_markets1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listmain_markets1->checkBoundries();
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
  .KT_col_main_market_name {width:140px; overflow:hidden;}
  .KT_col_main_market_name_EN {width:140px; overflow:hidden;}
</style>
<?php echo $tor_listmain_markets1->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listmain_markets1">
  <h1> Main markets
    <?php
  $nav_listmain_markets1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listmain_markets1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listmain_markets1'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listmain_markets1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listmain_markets1'] == 1) {
?>
                  <a href="<?php echo $tfi_listmain_markets1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listmain_markets1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="main_market_name" class="KT_col_main_market_name">Market name</th>
            <th id="main_market_name_EN" class="KT_col_main_market_name_EN">Market name(English)</th>
            <th id="main_market_sort" class="KT_sorter <?php echo $tso_listmain_markets1->getSortIcon('main_markets.main_market_sort'); ?> KT_order"> <a href="<?php echo $tso_listmain_markets1->getSortLink('main_markets.main_market_sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listmain_markets1'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listmain_markets1_main_market_name" id="tfi_listmain_markets1_main_market_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmain_markets1_main_market_name']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listmain_markets1_main_market_name_EN" id="tfi_listmain_markets1_main_market_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmain_markets1_main_market_name_EN']); ?>" size="20" maxlength="60" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listmain_markets1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsmain_markets1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsmain_markets1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_main_markets" class="id_checkbox" value="<?php echo $row_rsmain_markets1['id_main_markets']; ?>" />
                    <input type="hidden" name="id_main_markets" class="id_field" value="<?php echo $row_rsmain_markets1['id_main_markets']; ?>" />
                </td>
                <td><div class="KT_col_main_market_name"><?php echo KT_FormatForList($row_rsmain_markets1['main_market_name'], 20); ?></div></td>
                <td><div class="KT_col_main_market_name_EN"><?php echo KT_FormatForList($row_rsmain_markets1['main_market_name_EN'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listmain_markets1->getOrderFieldName() ?>" value="<?php echo $tor_listmain_markets1->getOrderFieldValue($row_rsmain_markets1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_main_markets&amp;id_main_markets=<?php echo $row_rsmain_markets1['id_main_markets']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsmain_markets1 = mysql_fetch_assoc($rsmain_markets1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listmain_markets1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_main_markets&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsmain_markets1);
?>
