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
$tor_listprosubcat3 = new TOR_SetOrder($conn_ketnoi, 'prosubcat1', 'id_prosubcat1', 'NUMERIC_TYPE', 'sort', 'listprosubcat3_sort_order');
$tor_listprosubcat3->Execute();

// Filter
$tfi_listprosubcat3 = new TFI_TableFilter($conn_ketnoi, "tfi_listprosubcat3");
$tfi_listprosubcat3->addColumn("prosubcat1.prosubcat1_name", "STRING_TYPE", "prosubcat1_name", "%");
$tfi_listprosubcat3->addColumn("prosubcat1.prosubcat1_name_EN", "STRING_TYPE", "prosubcat1_name_EN", "%");
$tfi_listprosubcat3->addColumn("prosubcat1.url", "STRING_TYPE", "url", "%");
$tfi_listprosubcat3->addColumn("prosubcat1.notes", "STRING_TYPE", "notes", "%");
$tfi_listprosubcat3->addColumn("prosubcat1.notes_EN", "STRING_TYPE", "notes_EN", "%");
$tfi_listprosubcat3->addColumn("procat.id_procat", "NUMERIC_TYPE", "id_procat", "=");
$tfi_listprosubcat3->addColumn("prosubcat1.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listprosubcat3->addColumn("prosubcat1.visible", "CHECKBOX_1_0_TYPE", "visible", "%");
$tfi_listprosubcat3->Execute();

// Sorter
$tso_listprosubcat3 = new TSO_TableSorter("rsprosubcat1", "tso_listprosubcat3");
$tso_listprosubcat3->addColumn("prosubcat1.sort"); // Order column
$tso_listprosubcat3->setDefault("prosubcat1.sort");
$tso_listprosubcat3->Execute();

// Navigation
$nav_listprosubcat3 = new NAV_Regular("nav_listprosubcat3", "rsprosubcat1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT procat_name, id_procat FROM procat ORDER BY procat_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

//NeXTenesio3 Special List Recordset
$maxRows_rsprosubcat1 = $_SESSION['max_rows_nav_listprosubcat3'];
$pageNum_rsprosubcat1 = 0;
if (isset($_GET['pageNum_rsprosubcat1'])) {
  $pageNum_rsprosubcat1 = $_GET['pageNum_rsprosubcat1'];
}
$startRow_rsprosubcat1 = $pageNum_rsprosubcat1 * $maxRows_rsprosubcat1;

// Defining List Recordset variable
$NXTFilter_rsprosubcat1 = "1=1";
if (isset($_SESSION['filter_tfi_listprosubcat3'])) {
  $NXTFilter_rsprosubcat1 = $_SESSION['filter_tfi_listprosubcat3'];
}
// Defining List Recordset variable
$NXTSort_rsprosubcat1 = "prosubcat1.sort";
if (isset($_SESSION['sorter_tso_listprosubcat3'])) {
  $NXTSort_rsprosubcat1 = $_SESSION['sorter_tso_listprosubcat3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsprosubcat1 = "SELECT prosubcat1.prosubcat1_name, prosubcat1.prosubcat1_name_EN, prosubcat1.url, prosubcat1.notes, prosubcat1.notes_EN, procat.procat_name AS id_procat, prosubcat1.day_update, prosubcat1.visible, prosubcat1.id_prosubcat1, prosubcat1.sort FROM prosubcat1 LEFT JOIN procat ON prosubcat1.id_procat = procat.id_procat WHERE {$NXTFilter_rsprosubcat1} ORDER BY {$NXTSort_rsprosubcat1}";
$query_limit_rsprosubcat1 = sprintf("%s LIMIT %d, %d", $query_rsprosubcat1, $startRow_rsprosubcat1, $maxRows_rsprosubcat1);
$rsprosubcat1 = mysql_query($query_limit_rsprosubcat1, $ketnoi) or die(mysql_error());
$row_rsprosubcat1 = mysql_fetch_assoc($rsprosubcat1);

if (isset($_GET['totalRows_rsprosubcat1'])) {
  $totalRows_rsprosubcat1 = $_GET['totalRows_rsprosubcat1'];
} else {
  $all_rsprosubcat1 = mysql_query($query_rsprosubcat1);
  $totalRows_rsprosubcat1 = mysql_num_rows($all_rsprosubcat1);
}
$totalPages_rsprosubcat1 = ceil($totalRows_rsprosubcat1/$maxRows_rsprosubcat1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listprosubcat3->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: true,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script><style type="text/css">
  /* Dynamic List row settings */
  .KT_col_prosubcat1_name {width:100px; overflow:hidden;}
  .KT_col_prosubcat1_name_EN {width:100px; overflow:hidden;}
  .KT_col_url {width:100px; overflow:hidden;}
  .KT_col_notes {width:100px; overflow:hidden;}
  .KT_col_notes_EN {width:100px; overflow:hidden;}
  .KT_col_id_procat {width:100px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listprosubcat3->scriptDefinition(); ?>

</head>

<body>
<div class="KT_tng" id="listprosubcat3">
  <h1>Sub catalogue1
    <?php
  $nav_listprosubcat3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listprosubcat3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listprosubcat3'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listprosubcat3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listprosubcat3'] == 1) {
?>
                            <a href="<?php echo $tfi_listprosubcat3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listprosubcat3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="prosubcat1_name" class="KT_col_prosubcat1_name">Sub catalogue1</th>
            <th id="prosubcat1_name_EN" class="KT_col_prosubcat1_name_EN">Sub catalogue1(English)</th>
            <th id="url" class="KT_col_url">Url</th>
            <th id="notes" class="KT_col_notes">Notes</th>
            <th id="notes_EN" class="KT_col_notes_EN">notes(English)</th>
            <th id="id_procat" class="KT_col_id_procat">Catalogue name</th>
            <th id="day_update" class="KT_col_day_update">Day update</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listprosubcat3->getSortIcon('prosubcat1.sort'); ?> KT_order"> <a href="<?php echo $tso_listprosubcat3->getSortLink('prosubcat1.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listprosubcat3'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listprosubcat3_prosubcat1_name" id="tfi_listprosubcat3_prosubcat1_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat3_prosubcat1_name']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat3_prosubcat1_name_EN" id="tfi_listprosubcat3_prosubcat1_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat3_prosubcat1_name_EN']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat3_url" id="tfi_listprosubcat3_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat3_url']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat3_notes" id="tfi_listprosubcat3_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat3_notes']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat3_notes_EN" id="tfi_listprosubcat3_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat3_notes_EN']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listprosubcat3_id_procat" id="tfi_listprosubcat3_id_procat">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listprosubcat3_id_procat']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_procat']?>"<?php if (!(strcmp($row_Recordset1['id_procat'], @$_SESSION['tfi_listprosubcat3_id_procat']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['procat_name']?></option>
              <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listprosubcat3_day_update" id="tfi_listprosubcat3_day_update" value="<?php echo @$_SESSION['tfi_listprosubcat3_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listprosubcat3_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listprosubcat3_visible" id="tfi_listprosubcat3_visible" value="1" /></td>
            <td>&nbsp;</td>
            <td><input type="submit" name="tfi_listprosubcat3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsprosubcat1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="11"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsprosubcat1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_prosubcat1" class="id_checkbox" value="<?php echo $row_rsprosubcat1['id_prosubcat1']; ?>" />
                <input type="hidden" name="id_prosubcat1" class="id_field" value="<?php echo $row_rsprosubcat1['id_prosubcat1']; ?>" />
            </td>
            <td><div class="KT_col_prosubcat1_name"><?php echo KT_FormatForList($row_rsprosubcat1['prosubcat1_name'], 20); ?></div></td>
            <td><div class="KT_col_prosubcat1_name_EN"><?php echo KT_FormatForList($row_rsprosubcat1['prosubcat1_name_EN'], 20); ?></div></td>
            <td><div class="KT_col_url"><?php echo KT_FormatForList($row_rsprosubcat1['url'], 20); ?></div></td>
            <td><div class="KT_col_notes"><?php echo KT_FormatForList($row_rsprosubcat1['notes'], 20); ?></div></td>
            <td><div class="KT_col_notes_EN"><?php echo KT_FormatForList($row_rsprosubcat1['notes_EN'], 20); ?></div></td>
            <td><div class="KT_col_id_procat"><?php echo KT_FormatForList($row_rsprosubcat1['id_procat'], 20); ?></div></td>
            <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rsprosubcat1['day_update']); ?></div></td>
            <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsprosubcat1['visible'], 20); ?></div></td>
            <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listprosubcat3->getOrderFieldName() ?>" value="<?php echo $tor_listprosubcat3->getOrderFieldValue($row_rsprosubcat1) ?>" />
              <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
            <td><a class="KT_edit_link" href="index.php?mod=form_prosubcat1&amp;id_prosubcat1=<?php echo $row_rsprosubcat1['id_prosubcat1']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rsprosubcat1 = mysql_fetch_assoc($rsprosubcat1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listprosubcat3->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_prosubcat1&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rsprosubcat1);
?>
