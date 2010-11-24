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
$tor_listadvertise3 = new TOR_SetOrder($conn_ketnoi, 'advertise', 'id_advertise', 'NUMERIC_TYPE', 'sort', 'listadvertise3_sort_order');
$tor_listadvertise3->Execute();

// Filter
$tfi_listadvertise3 = new TFI_TableFilter($conn_ketnoi, "tfi_listadvertise3");
$tfi_listadvertise3->addColumn("advertise.title", "STRING_TYPE", "title", "%");
$tfi_listadvertise3->addColumn("advertise.notes", "STRING_TYPE", "notes", "%");
$tfi_listadvertise3->addColumn("advertise.notes_EN", "STRING_TYPE", "notes_EN", "%");
$tfi_listadvertise3->addColumn("advertise.file_image", "FILE_TYPE", "file_image", "%");
$tfi_listadvertise3->addColumn("advertise.fileflash", "STRING_TYPE", "fileflash", "%");
$tfi_listadvertise3->addColumn("advertise.url", "STRING_TYPE", "url", "%");
$tfi_listadvertise3->addColumn("advertise.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listadvertise3->addColumn("advertise.day_start", "DATE_TYPE", "day_start", "=");
$tfi_listadvertise3->addColumn("advertise.day_end", "DATE_TYPE", "day_end", "=");
$tfi_listadvertise3->addColumn("advertise.width", "NUMERIC_TYPE", "width", "=");
$tfi_listadvertise3->addColumn("advertise.position", "STRING_TYPE", "position", "%");
$tfi_listadvertise3->addColumn("advertise.visible", "CHECKBOX_1_0_TYPE", "visible", "%");
$tfi_listadvertise3->Execute();

// Sorter
$tso_listadvertise3 = new TSO_TableSorter("rsadvertise1", "tso_listadvertise3");
$tso_listadvertise3->addColumn("advertise.sort"); // Order column
$tso_listadvertise3->setDefault("advertise.sort");
$tso_listadvertise3->Execute();

// Navigation
$nav_listadvertise3 = new NAV_Regular("nav_listadvertise3", "rsadvertise1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsadvertise1 = $_SESSION['max_rows_nav_listadvertise3'];
$pageNum_rsadvertise1 = 0;
if (isset($_GET['pageNum_rsadvertise1'])) {
  $pageNum_rsadvertise1 = $_GET['pageNum_rsadvertise1'];
}
$startRow_rsadvertise1 = $pageNum_rsadvertise1 * $maxRows_rsadvertise1;

// Defining List Recordset variable
$NXTFilter_rsadvertise1 = "1=1";
if (isset($_SESSION['filter_tfi_listadvertise3'])) {
  $NXTFilter_rsadvertise1 = $_SESSION['filter_tfi_listadvertise3'];
}
// Defining List Recordset variable
$NXTSort_rsadvertise1 = "advertise.sort";
if (isset($_SESSION['sorter_tso_listadvertise3'])) {
  $NXTSort_rsadvertise1 = $_SESSION['sorter_tso_listadvertise3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsadvertise1 = "SELECT advertise.title, advertise.notes, advertise.notes_EN, advertise.file_image, advertise.fileflash, advertise.url, advertise.day_update, advertise.day_start, advertise.day_end, advertise.width, advertise.position, advertise.visible, advertise.id_advertise, advertise.sort FROM advertise WHERE {$NXTFilter_rsadvertise1} ORDER BY {$NXTSort_rsadvertise1}";
$query_limit_rsadvertise1 = sprintf("%s LIMIT %d, %d", $query_rsadvertise1, $startRow_rsadvertise1, $maxRows_rsadvertise1);
$rsadvertise1 = mysql_query($query_limit_rsadvertise1, $ketnoi) or die(mysql_error());
$row_rsadvertise1 = mysql_fetch_assoc($rsadvertise1);

if (isset($_GET['totalRows_rsadvertise1'])) {
  $totalRows_rsadvertise1 = $_GET['totalRows_rsadvertise1'];
} else {
  $all_rsadvertise1 = mysql_query($query_rsadvertise1);
  $totalRows_rsadvertise1 = mysql_num_rows($all_rsadvertise1);
}
$totalPages_rsadvertise1 = ceil($totalRows_rsadvertise1/$maxRows_rsadvertise1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listadvertise3->checkBoundries();
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
  .KT_col_notes {width:140px; overflow:hidden;}
  .KT_col_notes_EN {width:140px; overflow:hidden;}
  .KT_col_file_image {width:140px; overflow:hidden;}
  .KT_col_fileflash {width:140px; overflow:hidden;}
  .KT_col_url {width:140px; overflow:hidden;}
  .KT_col_day_update {width:140px; overflow:hidden;}
  .KT_col_day_start {width:140px; overflow:hidden;}
  .KT_col_day_end {width:140px; overflow:hidden;}
  .KT_col_width {width:140px; overflow:hidden;}
  .KT_col_position {width:140px; overflow:hidden;}
  .KT_col_visible {width:140px; overflow:hidden;}
</style>
<?php echo $tor_listadvertise3->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listadvertise3">
  <h1> Advertise
    <?php
  $nav_listadvertise3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listadvertise3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listadvertise3'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listadvertise3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listadvertise3'] == 1) {
?>
                  <a href="<?php echo $tfi_listadvertise3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listadvertise3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
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
            <th id="notes" class="KT_col_notes">Notes</th>
            <th id="notes_EN" class="KT_col_notes_EN">notes(English)</th>
            <th id="file_image" class="KT_col_file_image">Image</th>
            <th id="fileflash" class="KT_col_fileflash">Flash file</th>
            <th id="url" class="KT_col_url">Url</th>
            <th id="day_update" class="KT_col_day_update">Day update</th>
            <th id="day_start" class="KT_col_day_start">Day start</th>
            <th id="day_end" class="KT_col_day_end">Day end</th>
            <th id="width" class="KT_col_width">Width</th>
            <th id="position" class="KT_col_position">Position</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listadvertise3->getSortIcon('advertise.sort'); ?> KT_order"> <a href="<?php echo $tso_listadvertise3->getSortLink('advertise.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listadvertise3'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listadvertise3_title" id="tfi_listadvertise3_title" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_title']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listadvertise3_notes" id="tfi_listadvertise3_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_notes']); ?>" size="20" maxlength="200" /></td>
              <td><input type="text" name="tfi_listadvertise3_notes_EN" id="tfi_listadvertise3_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_notes_EN']); ?>" size="20" maxlength="200" /></td>
              <td><input type="text" name="tfi_listadvertise3_file_image" id="tfi_listadvertise3_file_image" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_file_image']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listadvertise3_fileflash" id="tfi_listadvertise3_fileflash" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_fileflash']); ?>" size="20" maxlength="30" /></td>
              <td><input type="text" name="tfi_listadvertise3_url" id="tfi_listadvertise3_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_url']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listadvertise3_day_update" id="tfi_listadvertise3_day_update" value="<?php echo @$_SESSION['tfi_listadvertise3_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listadvertise3_day_start" id="tfi_listadvertise3_day_start" value="<?php echo @$_SESSION['tfi_listadvertise3_day_start']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listadvertise3_day_end" id="tfi_listadvertise3_day_end" value="<?php echo @$_SESSION['tfi_listadvertise3_day_end']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listadvertise3_width" id="tfi_listadvertise3_width" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_width']); ?>" size="20" maxlength="100" /></td>
              <td><select name="tfi_listadvertise3_position" id="tfi_listadvertise3_position">
                  <option value="top" <?php if (!(strcmp("top", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>top</option>
                  <option value="left" <?php if (!(strcmp("left", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>left</option>
                  <option value="right" <?php if (!(strcmp("right", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>right</option>
                  <option value="bottom" <?php if (!(strcmp("bottom", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>bottom</option>
                  <option value="mid1" <?php if (!(strcmp("mid1", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>mid1</option>
                  <option value="mid2" <?php if (!(strcmp("mid2", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>mid2</option>
                  <option value="product" <?php if (!(strcmp("product", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>product</option>
                  <option value="buy" <?php if (!(strcmp("buy", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>buy</option>
                  <option value="sell" <?php if (!(strcmp("sell", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>sell</option>
                  <option value="business" <?php if (!(strcmp("business", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>business</option>
                  <option value="services" <?php if (!(strcmp("services", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>services</option>
                  <option value="auction" <?php if (!(strcmp("auction", KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_position'])))) {echo "SELECTED";} ?>>auction</option>
                </select>
              </td>
              <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listadvertise3_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listadvertise3_visible" id="tfi_listadvertise3_visible" value="1" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listadvertise3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsadvertise1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="15"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsadvertise1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_advertise" class="id_checkbox" value="<?php echo $row_rsadvertise1['id_advertise']; ?>" />
                    <input type="hidden" name="id_advertise" class="id_field" value="<?php echo $row_rsadvertise1['id_advertise']; ?>" />
                </td>
                <td><div class="KT_col_title"><?php echo KT_FormatForList($row_rsadvertise1['title'], 20); ?></div></td>
                <td><div class="KT_col_notes"><?php echo KT_FormatForList($row_rsadvertise1['notes'], 20); ?></div></td>
                <td><div class="KT_col_notes_EN"><?php echo KT_FormatForList($row_rsadvertise1['notes_EN'], 20); ?></div></td>
                <td><div class="KT_col_file_image"><?php echo KT_FormatForList($row_rsadvertise1['file_image'], 20); ?></div></td>
                <td><div class="KT_col_fileflash"><?php echo KT_FormatForList($row_rsadvertise1['fileflash'], 20); ?></div></td>
                <td><div class="KT_col_url"><?php echo KT_FormatForList($row_rsadvertise1['url'], 20); ?></div></td>
                <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rsadvertise1['day_update']); ?></div></td>
                <td><div class="KT_col_day_start"><?php echo KT_formatDate($row_rsadvertise1['day_start']); ?></div></td>
                <td><div class="KT_col_day_end"><?php echo KT_formatDate($row_rsadvertise1['day_end']); ?></div></td>
                <td><div class="KT_col_width"><?php echo KT_FormatForList($row_rsadvertise1['width'], 20); ?></div></td>
                <td><div class="KT_col_position"><?php echo KT_FormatForList($row_rsadvertise1['position'], 20); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsadvertise1['visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listadvertise3->getOrderFieldName() ?>" value="<?php echo $tor_listadvertise3->getOrderFieldValue($row_rsadvertise1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_advertise&amp;id_advertise=<?php echo $row_rsadvertise1['id_advertise']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsadvertise1 = mysql_fetch_assoc($rsadvertise1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listadvertise3->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_advertise&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsadvertise1);
?>
