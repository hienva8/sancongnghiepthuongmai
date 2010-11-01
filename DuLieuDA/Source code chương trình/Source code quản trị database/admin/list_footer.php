<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the required classes
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

// Filter
$tfi_listfooter3 = new TFI_TableFilter($conn_ketnoi, "tfi_listfooter3");
$tfi_listfooter3->addColumn("footer.title", "STRING_TYPE", "title", "%");
$tfi_listfooter3->addColumn("footer.content", "STRING_TYPE", "content", "%");
$tfi_listfooter3->addColumn("footer.content_EN", "STRING_TYPE", "content_EN", "%");
$tfi_listfooter3->addColumn("footer.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listfooter3->Execute();

// Sorter
$tso_listfooter3 = new TSO_TableSorter("rsfooter1", "tso_listfooter3");
$tso_listfooter3->addColumn("footer.title");
$tso_listfooter3->addColumn("footer.content");
$tso_listfooter3->addColumn("footer.content_EN");
$tso_listfooter3->addColumn("footer.visible");
$tso_listfooter3->setDefault("footer.title");
$tso_listfooter3->Execute();

// Navigation
$nav_listfooter3 = new NAV_Regular("nav_listfooter3", "rsfooter1", "../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsfooter1 = $_SESSION['max_rows_nav_listfooter3'];
$pageNum_rsfooter1 = 0;
if (isset($_GET['pageNum_rsfooter1'])) {
  $pageNum_rsfooter1 = $_GET['pageNum_rsfooter1'];
}
$startRow_rsfooter1 = $pageNum_rsfooter1 * $maxRows_rsfooter1;

// Defining List Recordset variable
$NXTFilter_rsfooter1 = "1=1";
if (isset($_SESSION['filter_tfi_listfooter3'])) {
  $NXTFilter_rsfooter1 = $_SESSION['filter_tfi_listfooter3'];
}
// Defining List Recordset variable
$NXTSort_rsfooter1 = "footer.title";
if (isset($_SESSION['sorter_tso_listfooter3'])) {
  $NXTSort_rsfooter1 = $_SESSION['sorter_tso_listfooter3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsfooter1 = "SELECT footer.title, footer.content, footer.content_EN, footer.visible, footer.id_footer FROM footer WHERE {$NXTFilter_rsfooter1} ORDER BY {$NXTSort_rsfooter1}";
$query_limit_rsfooter1 = sprintf("%s LIMIT %d, %d", $query_rsfooter1, $startRow_rsfooter1, $maxRows_rsfooter1);
$rsfooter1 = mysql_query($query_limit_rsfooter1, $ketnoi) or die(mysql_error());
$row_rsfooter1 = mysql_fetch_assoc($rsfooter1);

if (isset($_GET['totalRows_rsfooter1'])) {
  $totalRows_rsfooter1 = $_GET['totalRows_rsfooter1'];
} else {
  $all_rsfooter1 = mysql_query($query_rsfooter1);
  $totalRows_rsfooter1 = mysql_num_rows($all_rsfooter1);
}
$totalPages_rsfooter1 = ceil($totalRows_rsfooter1/$maxRows_rsfooter1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listfooter3->checkBoundries();
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
  .KT_col_content {width:140px; overflow:hidden;}
  .KT_col_content_EN {width:140px; overflow:hidden;}
  .KT_col_visible {width:140px; overflow:hidden;}
</style>
</head>

<body>
<div class="KT_tng" id="listfooter3">
  <h1> Content footer
    <?php
  $nav_listfooter3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listfooter3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listfooter3'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listfooter3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listfooter3'] == 1) {
?>
                  <a href="<?php echo $tfi_listfooter3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listfooter3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="title" class="KT_sorter KT_col_title <?php echo $tso_listfooter3->getSortIcon('footer.title'); ?>"> <a href="<?php echo $tso_listfooter3->getSortLink('footer.title'); ?>">Title</a> </th>
            <th id="content" class="KT_sorter KT_col_content <?php echo $tso_listfooter3->getSortIcon('footer.content'); ?>"> <a href="<?php echo $tso_listfooter3->getSortLink('footer.content'); ?>">Content</a> </th>
            <th id="content_EN" class="KT_sorter KT_col_content_EN <?php echo $tso_listfooter3->getSortIcon('footer.content_EN'); ?>"> <a href="<?php echo $tso_listfooter3->getSortLink('footer.content_EN'); ?>">content(English)</a> </th>
            <th id="visible" class="KT_sorter KT_col_visible <?php echo $tso_listfooter3->getSortIcon('footer.visible'); ?>"> <a href="<?php echo $tso_listfooter3->getSortLink('footer.visible'); ?>">Visible</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listfooter3'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listfooter3_title" id="tfi_listfooter3_title" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listfooter3_title']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listfooter3_content" id="tfi_listfooter3_content" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listfooter3_content']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listfooter3_content_EN" id="tfi_listfooter3_content_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listfooter3_content_EN']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listfooter3_visible" id="tfi_listfooter3_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listfooter3_visible']); ?>" size="20" maxlength="100" /></td>
              <td><input type="submit" name="tfi_listfooter3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsfooter1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="6"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsfooter1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_footer" class="id_checkbox" value="<?php echo $row_rsfooter1['id_footer']; ?>" />
                    <input type="hidden" name="id_footer" class="id_field" value="<?php echo $row_rsfooter1['id_footer']; ?>" />
                </td>
                <td><div class="KT_col_title"><?php echo KT_FormatForList($row_rsfooter1['title'], 20); ?></div></td>
                <td><div class="KT_col_content"><?php echo KT_FormatForList($row_rsfooter1['content'], 20); ?></div></td>
                <td><div class="KT_col_content_EN"><?php echo KT_FormatForList($row_rsfooter1['content_EN'], 20); ?></div></td>
                <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsfooter1['visible'], 20); ?></div></td>
                <td><a class="KT_edit_link" href="index.php?mod=form_footer&amp;id_footer=<?php echo $row_rsfooter1['id_footer']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsfooter1 = mysql_fetch_assoc($rsfooter1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listfooter3->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_footer&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsfooter1);
?>
