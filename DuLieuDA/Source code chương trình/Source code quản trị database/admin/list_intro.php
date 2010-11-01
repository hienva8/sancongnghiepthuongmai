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
$tfi_listintro2 = new TFI_TableFilter($conn_ketnoi, "tfi_listintro2");
$tfi_listintro2->addColumn("intro.intro_content", "STRING_TYPE", "intro_content", "%");
$tfi_listintro2->addColumn("intro.intro_content_EN", "STRING_TYPE", "intro_content_EN", "%");
$tfi_listintro2->addColumn("intro.intro_day_update", "DATE_TYPE", "intro_day_update", "=");
$tfi_listintro2->addColumn("intro.intro_visible", "NUMERIC_TYPE", "intro_visible", "=");
$tfi_listintro2->Execute();

// Sorter
$tso_listintro2 = new TSO_TableSorter("rsintro1", "tso_listintro2");
$tso_listintro2->addColumn("intro.intro_content");
$tso_listintro2->addColumn("intro.intro_content_EN");
$tso_listintro2->addColumn("intro.intro_day_update");
$tso_listintro2->addColumn("intro.intro_visible");
$tso_listintro2->setDefault("intro.intro_day_update DESC");
$tso_listintro2->Execute();

// Navigation
$nav_listintro2 = new NAV_Regular("nav_listintro2", "rsintro1", "../", $_SERVER['PHP_SELF'], 20);

//NeXTenesio3 Special List Recordset
$maxRows_rsintro1 = $_SESSION['max_rows_nav_listintro2'];
$pageNum_rsintro1 = 0;
if (isset($_GET['pageNum_rsintro1'])) {
  $pageNum_rsintro1 = $_GET['pageNum_rsintro1'];
}
$startRow_rsintro1 = $pageNum_rsintro1 * $maxRows_rsintro1;

// Defining List Recordset variable
$NXTFilter_rsintro1 = "1=1";
if (isset($_SESSION['filter_tfi_listintro2'])) {
  $NXTFilter_rsintro1 = $_SESSION['filter_tfi_listintro2'];
}
// Defining List Recordset variable
$NXTSort_rsintro1 = "intro.intro_day_update DESC";
if (isset($_SESSION['sorter_tso_listintro2'])) {
  $NXTSort_rsintro1 = $_SESSION['sorter_tso_listintro2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsintro1 = "SELECT intro.intro_content, intro.intro_content_EN, intro.intro_day_update, intro.intro_visible, intro.id_intro FROM intro WHERE {$NXTFilter_rsintro1} ORDER BY {$NXTSort_rsintro1}";
$query_limit_rsintro1 = sprintf("%s LIMIT %d, %d", $query_rsintro1, $startRow_rsintro1, $maxRows_rsintro1);
$rsintro1 = mysql_query($query_limit_rsintro1, $ketnoi) or die(mysql_error());
$row_rsintro1 = mysql_fetch_assoc($rsintro1);

if (isset($_GET['totalRows_rsintro1'])) {
  $totalRows_rsintro1 = $_GET['totalRows_rsintro1'];
} else {
  $all_rsintro1 = mysql_query($query_rsintro1);
  $totalRows_rsintro1 = mysql_num_rows($all_rsintro1);
}
$totalPages_rsintro1 = ceil($totalRows_rsintro1/$maxRows_rsintro1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listintro2->checkBoundries();
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
  .KT_col_intro_content {width:140px; overflow:hidden;}
  .KT_col_intro_content_EN {width:140px; overflow:hidden;}
  .KT_col_intro_day_update {width:140px; overflow:hidden;}
  .KT_col_intro_visible {width:140px; overflow:hidden;}
</style>
</head>

<body>
<div class="KT_tng" id="listintro2">
  <h1> Intro
    <?php
  $nav_listintro2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listintro2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listintro2'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listintro2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listintro2'] == 1) {
?>
                  <a href="<?php echo $tfi_listintro2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listintro2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="intro_content" class="KT_sorter KT_col_intro_content <?php echo $tso_listintro2->getSortIcon('intro.intro_content'); ?>"> <a href="<?php echo $tso_listintro2->getSortLink('intro.intro_content'); ?>"><?php echo noidung;?></a> </th>
            <th id="intro_content_EN" class="KT_sorter KT_col_intro_content_EN <?php echo $tso_listintro2->getSortIcon('intro.intro_content_EN'); ?>"> <a href="<?php echo $tso_listintro2->getSortLink('intro.intro_content_EN'); ?>"><?php echo noidungtienganh;?></a> </th>
            <th id="intro_day_update" class="KT_sorter KT_col_intro_day_update <?php echo $tso_listintro2->getSortIcon('intro.intro_day_update'); ?>"> <a href="<?php echo $tso_listintro2->getSortLink('intro.intro_day_update'); ?>"><?php echo ngaycapnhat;?></a> </th>
            <th id="intro_visible" class="KT_sorter KT_col_intro_visible <?php echo $tso_listintro2->getSortIcon('intro.intro_visible'); ?>"> <a href="<?php echo $tso_listintro2->getSortLink('intro.intro_visible'); ?>"><?php echo anhien;?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listintro2'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listintro2_intro_content" id="tfi_listintro2_intro_content" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listintro2_intro_content']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listintro2_intro_content_EN" id="tfi_listintro2_intro_content_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listintro2_intro_content_EN']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listintro2_intro_day_update" id="tfi_listintro2_intro_day_update" value="<?php echo @$_SESSION['tfi_listintro2_intro_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listintro2_intro_visible" id="tfi_listintro2_intro_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listintro2_intro_visible']); ?>" size="20" maxlength="100" /></td>
              <td><input type="submit" name="tfi_listintro2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsintro1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="6"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsintro1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_intro" class="id_checkbox" value="<?php echo $row_rsintro1['id_intro']; ?>" />
                    <input type="hidden" name="id_intro" class="id_field" value="<?php echo $row_rsintro1['id_intro']; ?>" />
                </td>
                <td><div class="KT_col_intro_content"><?php echo KT_FormatForList($row_rsintro1['intro_content'], 20); ?></div></td>
                <td><div class="KT_col_intro_content_EN"><?php echo KT_FormatForList($row_rsintro1['intro_content_EN'], 20); ?></div></td>
                <td><div class="KT_col_intro_day_update"><?php echo KT_formatDate($row_rsintro1['intro_day_update']); ?></div></td>
                <td><div class="KT_col_intro_visible"><?php echo KT_FormatForList($row_rsintro1['intro_visible'], 20); ?></div></td>
                <td><a class="KT_edit_link" href="index.php?mod=form_intro&amp;id_intro=<?php echo $row_rsintro1['id_intro']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsintro1 = mysql_fetch_assoc($rsintro1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listintro2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_intro&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsintro1);
?>
