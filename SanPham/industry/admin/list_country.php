<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

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
$tor_listcountry3 = new TOR_SetOrder($conn_ketnoi, 'country', 'id_country', 'NUMERIC_TYPE', 'sort', 'listcountry3_sort_order');
$tor_listcountry3->Execute();

// Filter
$tfi_listcountry3 = new TFI_TableFilter($conn_ketnoi, "tfi_listcountry3");
$tfi_listcountry3->addColumn("country.country_name", "STRING_TYPE", "country_name", "%");
$tfi_listcountry3->addColumn("country.country_name_EN", "STRING_TYPE", "country_name_EN", "%");
$tfi_listcountry3->addColumn("country.country_image_illustrate", "FILE_TYPE", "country_image_illustrate", "%");
$tfi_listcountry3->addColumn("country.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listcountry3->Execute();

// Sorter
$tso_listcountry3 = new TSO_TableSorter("rscountry1", "tso_listcountry3");
$tso_listcountry3->addColumn("country.sort"); // Order column
$tso_listcountry3->setDefault("country.sort");
$tso_listcountry3->Execute();

// Navigation
$nav_listcountry3 = new NAV_Regular("nav_listcountry3", "rscountry1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rscountry1 = $_SESSION['max_rows_nav_listcountry3'];
$pageNum_rscountry1 = 0;
if (isset($_GET['pageNum_rscountry1'])) {
  $pageNum_rscountry1 = $_GET['pageNum_rscountry1'];
}
$startRow_rscountry1 = $pageNum_rscountry1 * $maxRows_rscountry1;

// Defining List Recordset variable
$NXTFilter_rscountry1 = "1=1";
if (isset($_SESSION['filter_tfi_listcountry3'])) {
  $NXTFilter_rscountry1 = $_SESSION['filter_tfi_listcountry3'];
}
// Defining List Recordset variable
$NXTSort_rscountry1 = "country.sort";
if (isset($_SESSION['sorter_tso_listcountry3'])) {
  $NXTSort_rscountry1 = $_SESSION['sorter_tso_listcountry3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rscountry1 = "SELECT country.country_name, country.country_name_EN, country.country_image_illustrate, country.day_update, country.id_country, country.sort FROM country WHERE {$NXTFilter_rscountry1} ORDER BY {$NXTSort_rscountry1}";
$query_limit_rscountry1 = sprintf("%s LIMIT %d, %d", $query_rscountry1, $startRow_rscountry1, $maxRows_rscountry1);
$rscountry1 = mysql_query($query_limit_rscountry1, $ketnoi) or die(mysql_error());
$row_rscountry1 = mysql_fetch_assoc($rscountry1);

if (isset($_GET['totalRows_rscountry1'])) {
  $totalRows_rscountry1 = $_GET['totalRows_rscountry1'];
} else {
  $all_rscountry1 = mysql_query($query_rscountry1);
  $totalRows_rscountry1 = mysql_num_rows($all_rscountry1);
}
$totalPages_rscountry1 = ceil($totalRows_rscountry1/$maxRows_rscountry1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcountry3->checkBoundries();
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
  .KT_col_country_name {width:140px; overflow:hidden;}
  .KT_col_country_name_EN {width:140px; overflow:hidden;}
  .KT_col_country_image_illustrate {width:140px; overflow:hidden;}
  .KT_col_day_update {width:140px; overflow:hidden;}
</style>
<?php echo $tor_listcountry3->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listcountry3">
  <h1> Country
    <?php
  $nav_listcountry3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listcountry3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcountry3'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listcountry3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcountry3'] == 1) {
?>
                  <a href="<?php echo $tfi_listcountry3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listcountry3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="country_name" class="KT_col_country_name">Country name</th>
            <th id="country_name_EN" class="KT_col_country_name_EN">Country name(English)</th>
            <th id="country_image_illustrate" class="KT_col_country_image_illustrate">Image illustrate</th>
            <th id="day_update" class="KT_col_day_update">Day update</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listcountry3->getSortIcon('country.sort'); ?> KT_order"> <a href="<?php echo $tso_listcountry3->getSortLink('country.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcountry3'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listcountry3_country_name" id="tfi_listcountry3_country_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcountry3_country_name']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listcountry3_country_name_EN" id="tfi_listcountry3_country_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcountry3_country_name_EN']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listcountry3_country_image_illustrate" id="tfi_listcountry3_country_image_illustrate" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcountry3_country_image_illustrate']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listcountry3_day_update" id="tfi_listcountry3_day_update" value="<?php echo @$_SESSION['tfi_listcountry3_day_update']; ?>" size="10" maxlength="22" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listcountry3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rscountry1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rscountry1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_country" class="id_checkbox" value="<?php echo $row_rscountry1['id_country']; ?>" />
                    <input type="hidden" name="id_country" class="id_field" value="<?php echo $row_rscountry1['id_country']; ?>" />
                </td>
                <td><div class="KT_col_country_name"><?php echo KT_FormatForList($row_rscountry1['country_name'], 20); ?></div></td>
                <td><div class="KT_col_country_name_EN"><?php echo KT_FormatForList($row_rscountry1['country_name_EN'], 20); ?></div></td>
                <td><img src="<?php echo tNG_showDynamicImage("../", "../uploads/country_flag/", "{rscountry1.country_image_illustrate}");?>" width="30" /></td>
                <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rscountry1['day_update']); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listcountry3->getOrderFieldName() ?>" value="<?php echo $tor_listcountry3->getOrderFieldValue($row_rscountry1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_country&amp;id_country=<?php echo $row_rscountry1['id_country']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rscountry1 = mysql_fetch_assoc($rscountry1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listcountry3->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_country&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rscountry1);
?>
