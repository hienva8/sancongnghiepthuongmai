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
$tor_listbusiness_form1 = new TOR_SetOrder($conn_ketnoi, 'business_form', 'id_business_form', 'NUMERIC_TYPE', 'bf_sort', 'listbusiness_form1_bf_sort_order');
$tor_listbusiness_form1->Execute();

// Filter
$tfi_listbusiness_form1 = new TFI_TableFilter($conn_ketnoi, "tfi_listbusiness_form1");
$tfi_listbusiness_form1->addColumn("business_form.bf_name", "STRING_TYPE", "bf_name", "%");
$tfi_listbusiness_form1->addColumn("business_form.bf_name_EN", "STRING_TYPE", "bf_name_EN", "%");
$tfi_listbusiness_form1->addColumn("business_form.bf_visible", "NUMERIC_TYPE", "bf_visible", "=");
$tfi_listbusiness_form1->Execute();

// Sorter
$tso_listbusiness_form1 = new TSO_TableSorter("rsbusiness_form1", "tso_listbusiness_form1");
$tso_listbusiness_form1->addColumn("business_form.bf_sort"); // Order column
$tso_listbusiness_form1->setDefault("business_form.bf_sort");
$tso_listbusiness_form1->Execute();

// Navigation
$nav_listbusiness_form1 = new NAV_Regular("nav_listbusiness_form1", "rsbusiness_form1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsbusiness_form1 = $_SESSION['max_rows_nav_listbusiness_form1'];
$pageNum_rsbusiness_form1 = 0;
if (isset($_GET['pageNum_rsbusiness_form1'])) {
  $pageNum_rsbusiness_form1 = $_GET['pageNum_rsbusiness_form1'];
}
$startRow_rsbusiness_form1 = $pageNum_rsbusiness_form1 * $maxRows_rsbusiness_form1;

// Defining List Recordset variable
$NXTFilter_rsbusiness_form1 = "1=1";
if (isset($_SESSION['filter_tfi_listbusiness_form1'])) {
  $NXTFilter_rsbusiness_form1 = $_SESSION['filter_tfi_listbusiness_form1'];
}
// Defining List Recordset variable
$NXTSort_rsbusiness_form1 = "business_form.bf_sort";
if (isset($_SESSION['sorter_tso_listbusiness_form1'])) {
  $NXTSort_rsbusiness_form1 = $_SESSION['sorter_tso_listbusiness_form1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsbusiness_form1 = "SELECT business_form.bf_name, business_form.bf_name_EN, business_form.bf_visible, business_form.id_business_form, business_form.bf_sort FROM business_form WHERE {$NXTFilter_rsbusiness_form1} ORDER BY {$NXTSort_rsbusiness_form1}";
$query_limit_rsbusiness_form1 = sprintf("%s LIMIT %d, %d", $query_rsbusiness_form1, $startRow_rsbusiness_form1, $maxRows_rsbusiness_form1);
$rsbusiness_form1 = mysql_query($query_limit_rsbusiness_form1, $ketnoi) or die(mysql_error());
$row_rsbusiness_form1 = mysql_fetch_assoc($rsbusiness_form1);

if (isset($_GET['totalRows_rsbusiness_form1'])) {
  $totalRows_rsbusiness_form1 = $_GET['totalRows_rsbusiness_form1'];
} else {
  $all_rsbusiness_form1 = mysql_query($query_rsbusiness_form1);
  $totalRows_rsbusiness_form1 = mysql_num_rows($all_rsbusiness_form1);
}
$totalPages_rsbusiness_form1 = ceil($totalRows_rsbusiness_form1/$maxRows_rsbusiness_form1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listbusiness_form1->checkBoundries();
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
  .KT_col_bf_name {width:140px; overflow:hidden;}
  .KT_col_bf_name_EN {width:140px; overflow:hidden;}
  .KT_col_bf_visible {width:140px; overflow:hidden;}
</style>
<?php echo $tor_listbusiness_form1->scriptDefinition(); ?>
</head>

<body>
<div class="KT_tng" id="listbusiness_form1">
  <h1> <?php echo hinhthuckinhdoanh;?>
    <?php
  $nav_listbusiness_form1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listbusiness_form1->getShowAllLink(); ?>"><?php echo NXT_getResource(hien); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listbusiness_form1'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listbusiness_form1']; ?>
          <?php 
  // else Conditional region1
  } else { ?>
          <?php echo NXT_getResource(tatca); ?>
          <?php } 
  // endif Conditional region1
?>
            <?php echo NXT_getResource(cacdong); ?></a> &nbsp;
        &nbsp;
                <?php 
  // Show IF Conditional region2
  if (@$_SESSION['has_filter_tfi_listbusiness_form1'] == 1) {
?>
                  <a href="<?php echo $tfi_listbusiness_form1->getResetFilterLink(); ?>"><?php echo NXT_getResource(anloc); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listbusiness_form1->getShowFilterLink(); ?>"><?php echo NXT_getResource(loctin); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="bf_name" class="KT_col_bf_name"><?php echo tenhinhthuckinhdoanhtiengviet;?></th>
            <th id="bf_name_EN" class="KT_col_bf_name_EN"><?php echo tenhinhthuckinhdoanhtienganh;?></th>
            <th id="bf_visible" class="KT_col_bf_visible"><?php echo anhien;?></th>
            <th id="bf_sort" class="KT_sorter <?php echo $tso_listbusiness_form1->getSortIcon('business_form.bf_sort'); ?> KT_order"> <a href="<?php echo $tso_listbusiness_form1->getSortLink('business_form.bf_sort'); ?>"><?php echo NXT_getResource(sapxepthutu); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource(luu); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listbusiness_form1'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listbusiness_form1_bf_name" id="tfi_listbusiness_form1_bf_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listbusiness_form1_bf_name']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listbusiness_form1_bf_name_EN" id="tfi_listbusiness_form1_bf_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listbusiness_form1_bf_name_EN']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listbusiness_form1_bf_visible" id="tfi_listbusiness_form1_bf_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listbusiness_form1_bf_visible']); ?>" size="20" maxlength="100" /></td>
              <td>&nbsp;</td>
              <td><input type="submit" name="tfi_listbusiness_form1" value="<?php echo NXT_getResource(loctin); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsbusiness_form1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="6"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsbusiness_form1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_business_form" class="id_checkbox" value="<?php echo $row_rsbusiness_form1['id_business_form']; ?>" />
                    <input type="hidden" name="id_business_form" class="id_field" value="<?php echo $row_rsbusiness_form1['id_business_form']; ?>" />
                </td>
                <td><div class="KT_col_bf_name"><?php echo KT_FormatForList($row_rsbusiness_form1['bf_name'], 20); ?></div></td>
                <td><div class="KT_col_bf_name_EN"><?php echo KT_FormatForList($row_rsbusiness_form1['bf_name_EN'], 20); ?></div></td>
                <td><div class="KT_col_bf_visible"><?php echo KT_FormatForList($row_rsbusiness_form1['bf_visible'], 20); ?></div></td>
                <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listbusiness_form1->getOrderFieldName() ?>" value="<?php echo $tor_listbusiness_form1->getOrderFieldValue($row_rsbusiness_form1) ?>" />
                  <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
                <td><a class="KT_edit_link" href="index.php?mod=form_business_form&amp;id_business_form=<?php echo $row_rsbusiness_form1['id_business_form']; ?>&amp;KT_back=1"><?php echo NXT_getResource(sua); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource(xoa); ?></a> </td>
              </tr>
              <?php } while ($row_rsbusiness_form1 = mysql_fetch_assoc($rsbusiness_form1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listbusiness_form1->Prepare();
            require("../includes/nav/NAV_Text_Navigation.inc.php");
          ?>
        </div>
      </div>
      <div class="KT_bottombuttons">
        <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource(sua); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource(xoa); ?></a> </div>
<span>&nbsp;</span>
        <select name="no_new" id="no_new">
          <option value="1">1</option>
          <option value="3">3</option>
          <option value="6">6</option>
        </select>
        <a class="KT_additem_op_link" href="index.php?mod=form_business_form&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource(themmoi); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsbusiness_form1);
?>
