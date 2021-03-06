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
$tor_listprosubcat6 = new TOR_SetOrder($conn_ketnoi, 'prosubcat4', 'id_prosubcat4', 'NUMERIC_TYPE', 'sort', 'listprosubcat6_sort_order');
$tor_listprosubcat6->Execute();

// Filter
$tfi_listprosubcat6 = new TFI_TableFilter($conn_ketnoi, "tfi_listprosubcat6");
$tfi_listprosubcat6->addColumn("prosubcat4.prosubcat4_name", "STRING_TYPE", "prosubcat4_name", "%");
$tfi_listprosubcat6->addColumn("prosubcat4.prosubcat4_name_EN", "STRING_TYPE", "prosubcat4_name_EN", "%");
$tfi_listprosubcat6->addColumn("prosubcat4.url", "STRING_TYPE", "url", "%");
$tfi_listprosubcat6->addColumn("prosubcat4.notes", "STRING_TYPE", "notes", "%");
$tfi_listprosubcat6->addColumn("prosubcat4.notes_EN", "STRING_TYPE", "notes_EN", "%");
$tfi_listprosubcat6->addColumn("procat.id_procat", "NUMERIC_TYPE", "id_procat", "=");
$tfi_listprosubcat6->addColumn("prosubcat1.id_prosubcat1", "NUMERIC_TYPE", "id_prosubcat1", "=");
$tfi_listprosubcat6->addColumn("prosubcat2.id_prosubcat2", "NUMERIC_TYPE", "id_prosubcat2", "=");
$tfi_listprosubcat6->addColumn("prosubcat3.id_prosubcat3", "NUMERIC_TYPE", "id_prosubcat3", "=");
$tfi_listprosubcat6->addColumn("prosubcat4.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listprosubcat6->addColumn("prosubcat4.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listprosubcat6->Execute();

// Sorter
$tso_listprosubcat6 = new TSO_TableSorter("rsprosubcat4", "tso_listprosubcat6");
$tso_listprosubcat6->addColumn("prosubcat4.sort"); // Order column
$tso_listprosubcat6->setDefault("prosubcat4.sort");
$tso_listprosubcat6->Execute();

// Navigation
$nav_listprosubcat6 = new NAV_Regular("nav_listprosubcat6", "rsprosubcat4", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT procat_name, id_procat FROM procat ORDER BY procat_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset2 = "SELECT prosubcat1_name, id_prosubcat1 FROM prosubcat1 ORDER BY prosubcat1_name";
$Recordset2 = mysql_query($query_Recordset2, $ketnoi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset3 = "SELECT prosubcat2_name, id_prosubcat2 FROM prosubcat2 ORDER BY prosubcat2_name";
$Recordset3 = mysql_query($query_Recordset3, $ketnoi) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset4 = "SELECT prosubcat3_name, id_prosubcat3 FROM prosubcat3 ORDER BY prosubcat3_name";
$Recordset4 = mysql_query($query_Recordset4, $ketnoi) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

//NeXTenesio3 Special List Recordset
$maxRows_rsprosubcat4 = $_SESSION['max_rows_nav_listprosubcat6'];
$pageNum_rsprosubcat4 = 0;
if (isset($_GET['pageNum_rsprosubcat4'])) {
  $pageNum_rsprosubcat4 = $_GET['pageNum_rsprosubcat4'];
}
$startRow_rsprosubcat4 = $pageNum_rsprosubcat4 * $maxRows_rsprosubcat4;

// Defining List Recordset variable
$NXTFilter_rsprosubcat4 = "1=1";
if (isset($_SESSION['filter_tfi_listprosubcat6'])) {
  $NXTFilter_rsprosubcat4 = $_SESSION['filter_tfi_listprosubcat6'];
}
// Defining List Recordset variable
$NXTSort_rsprosubcat4 = "prosubcat4.sort";
if (isset($_SESSION['sorter_tso_listprosubcat6'])) {
  $NXTSort_rsprosubcat4 = $_SESSION['sorter_tso_listprosubcat6'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsprosubcat4 = "SELECT prosubcat4.prosubcat4_name, prosubcat4.prosubcat4_name_EN, prosubcat4.url, prosubcat4.notes, prosubcat4.notes_EN, procat.procat_name AS id_procat, prosubcat1.prosubcat1_name AS id_prosubcat1, prosubcat2.prosubcat2_name AS id_prosubcat2, prosubcat3.prosubcat3_name AS id_prosubcat3, prosubcat4.day_update, prosubcat4.visible, prosubcat4.id_prosubcat4, prosubcat4.sort FROM (((prosubcat4 LEFT JOIN procat ON prosubcat4.id_procat = procat.id_procat) LEFT JOIN prosubcat1 ON prosubcat4.id_prosubcat1 = prosubcat1.id_prosubcat1) LEFT JOIN prosubcat2 ON prosubcat4.id_prosubcat2 = prosubcat2.id_prosubcat2) LEFT JOIN prosubcat3 ON prosubcat4.id_prosubcat3 = prosubcat3.id_prosubcat3 WHERE {$NXTFilter_rsprosubcat4} ORDER BY {$NXTSort_rsprosubcat4}";
$query_limit_rsprosubcat4 = sprintf("%s LIMIT %d, %d", $query_rsprosubcat4, $startRow_rsprosubcat4, $maxRows_rsprosubcat4);
$rsprosubcat4 = mysql_query($query_limit_rsprosubcat4, $ketnoi) or die(mysql_error());
$row_rsprosubcat4 = mysql_fetch_assoc($rsprosubcat4);

if (isset($_GET['totalRows_rsprosubcat4'])) {
  $totalRows_rsprosubcat4 = $_GET['totalRows_rsprosubcat4'];
} else {
  $all_rsprosubcat4 = mysql_query($query_rsprosubcat4);
  $totalRows_rsprosubcat4 = mysql_num_rows($all_rsprosubcat4);
}
$totalPages_rsprosubcat4 = ceil($totalRows_rsprosubcat4/$maxRows_rsprosubcat4)-1;
//End NeXTenesio3 Special List Recordset

$nav_listprosubcat6->checkBoundries();
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
  .KT_col_prosubcat4_name {width:100px; overflow:hidden;}
  .KT_col_prosubcat4_name_EN {width:100px; overflow:hidden;}
  .KT_col_url {width:100px; overflow:hidden;}
  .KT_col_notes {width:100px; overflow:hidden;}
  .KT_col_notes_EN {width:100px; overflow:hidden;}
  .KT_col_id_procat {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat1 {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat2 {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat3 {width:100px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listprosubcat6->scriptDefinition(); ?>

</head>

<body>
<div class="KT_tng" id="listprosubcat6">
  <h1> Sub catalogue4
    <?php
  $nav_listprosubcat6->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listprosubcat6->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listprosubcat6'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listprosubcat6']; ?>
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
  if (@$_SESSION['has_filter_tfi_listprosubcat6'] == 1) {
?>
                            <a href="<?php echo $tfi_listprosubcat6->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listprosubcat6->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="prosubcat4_name" class="KT_col_prosubcat4_name">Sub catalogue4</th>
            <th id="prosubcat4_name_EN" class="KT_col_prosubcat4_name_EN">Sub catalogue4(English)</th>
            <th id="url" class="KT_col_url">Url</th>
            <th id="notes" class="KT_col_notes">Notes</th>
            <th id="notes_EN" class="KT_col_notes_EN">Notes(English)</th>
            <th id="id_procat" class="KT_col_id_procat">Catalogue</th>
            <th id="id_prosubcat1" class="KT_col_id_prosubcat1">Sub catalogue1</th>
            <th id="id_prosubcat2" class="KT_col_id_prosubcat2">Sub catalogue2</th>
            <th id="id_prosubcat3" class="KT_col_id_prosubcat3">Sub catalogue3</th>
            <th id="day_update" class="KT_col_day_update">Day_update</th>
            <th id="visible" class="KT_col_visible">Visible</th>
            <th id="sort" class="KT_sorter <?php echo $tso_listprosubcat6->getSortIcon('prosubcat4.sort'); ?> KT_order"> <a href="<?php echo $tso_listprosubcat6->getSortLink('prosubcat4.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listprosubcat6'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listprosubcat6_prosubcat4_name" id="tfi_listprosubcat6_prosubcat4_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat6_prosubcat4_name']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat6_prosubcat4_name_EN" id="tfi_listprosubcat6_prosubcat4_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat6_prosubcat4_name_EN']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat6_url" id="tfi_listprosubcat6_url" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat6_url']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat6_notes" id="tfi_listprosubcat6_notes" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat6_notes']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listprosubcat6_notes_EN" id="tfi_listprosubcat6_notes_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat6_notes_EN']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listprosubcat6_id_procat" id="tfi_listprosubcat6_id_procat">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listprosubcat6_id_procat']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_procat']?>"<?php if (!(strcmp($row_Recordset1['id_procat'], @$_SESSION['tfi_listprosubcat6_id_procat']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['procat_name']?></option>
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
            <td><select name="tfi_listprosubcat6_id_prosubcat1" id="tfi_listprosubcat6_id_prosubcat1">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listprosubcat6_id_prosubcat1']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['id_prosubcat1']?>"<?php if (!(strcmp($row_Recordset2['id_prosubcat1'], @$_SESSION['tfi_listprosubcat6_id_prosubcat1']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['prosubcat1_name']?></option>
              <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
            </select>
            </td>
            <td><select name="tfi_listprosubcat6_id_prosubcat2" id="tfi_listprosubcat6_id_prosubcat2">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listprosubcat6_id_prosubcat2']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset3['id_prosubcat2']?>"<?php if (!(strcmp($row_Recordset3['id_prosubcat2'], @$_SESSION['tfi_listprosubcat6_id_prosubcat2']))) {echo "SELECTED";} ?>><?php echo $row_Recordset3['prosubcat2_name']?></option>
              <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
            </select>
            </td>
            <td><select name="tfi_listprosubcat6_id_prosubcat3" id="tfi_listprosubcat6_id_prosubcat3">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listprosubcat6_id_prosubcat3']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset4['id_prosubcat3']?>"<?php if (!(strcmp($row_Recordset4['id_prosubcat3'], @$_SESSION['tfi_listprosubcat6_id_prosubcat3']))) {echo "SELECTED";} ?>><?php echo $row_Recordset4['prosubcat3_name']?></option>
              <?php
} while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));
  $rows = mysql_num_rows($Recordset4);
  if($rows > 0) {
      mysql_data_seek($Recordset4, 0);
	  $row_Recordset4 = mysql_fetch_assoc($Recordset4);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listprosubcat6_day_update" id="tfi_listprosubcat6_day_update" value="<?php echo @$_SESSION['tfi_listprosubcat6_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input type="text" name="tfi_listprosubcat6_visible" id="tfi_listprosubcat6_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listprosubcat6_visible']); ?>" size="20" maxlength="100" /></td>
            <td>&nbsp;</td>
            <td><input type="submit" name="tfi_listprosubcat6" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsprosubcat4 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="14"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsprosubcat4 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_prosubcat4" class="id_checkbox" value="<?php echo $row_rsprosubcat4['id_prosubcat4']; ?>" />
                <input type="hidden" name="id_prosubcat4" class="id_field" value="<?php echo $row_rsprosubcat4['id_prosubcat4']; ?>" />
            </td>
            <td><div class="KT_col_prosubcat4_name"><?php echo KT_FormatForList($row_rsprosubcat4['prosubcat4_name'], 20); ?></div></td>
            <td><div class="KT_col_prosubcat4_name_EN"><?php echo KT_FormatForList($row_rsprosubcat4['prosubcat4_name_EN'], 20); ?></div></td>
            <td><div class="KT_col_url"><?php echo KT_FormatForList($row_rsprosubcat4['url'], 20); ?></div></td>
            <td><div class="KT_col_notes"><?php echo KT_FormatForList($row_rsprosubcat4['notes'], 20); ?></div></td>
            <td><div class="KT_col_notes_EN"><?php echo KT_FormatForList($row_rsprosubcat4['notes_EN'], 20); ?></div></td>
            <td><div class="KT_col_id_procat"><?php echo KT_FormatForList($row_rsprosubcat4['id_procat'], 20); ?></div></td>
            <td><div class="KT_col_id_prosubcat1"><?php echo KT_FormatForList($row_rsprosubcat4['id_prosubcat1'], 20); ?></div></td>
            <td><div class="KT_col_id_prosubcat2"><?php echo KT_FormatForList($row_rsprosubcat4['id_prosubcat2'], 20); ?></div></td>
            <td><div class="KT_col_id_prosubcat3"><?php echo KT_FormatForList($row_rsprosubcat4['id_prosubcat3'], 20); ?></div></td>
            <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rsprosubcat4['day_update']); ?></div></td>
            <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsprosubcat4['visible'], 20); ?></div></td>
            <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listprosubcat6->getOrderFieldName() ?>" value="<?php echo $tor_listprosubcat6->getOrderFieldValue($row_rsprosubcat4) ?>" />
              <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
            <td><a class="KT_edit_link" href="index.php?mod=form_prosubcat4&amp;id_prosubcat4=<?php echo $row_rsprosubcat4['id_prosubcat4']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rsprosubcat4 = mysql_fetch_assoc($rsprosubcat4)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listprosubcat6->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_prosubcat4&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($rsprosubcat4);
?>
