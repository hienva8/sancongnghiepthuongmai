<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

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
$tfi_listservices8 = new TFI_TableFilter($conn_ketnoi, "tfi_listservices8");
$tfi_listservices8->addColumn("services.title", "STRING_TYPE", "title", "%");
$tfi_listservices8->addColumn("services.title_EN", "STRING_TYPE", "title_EN", "%");
$tfi_listservices8->addColumn("services.image_illustrate", "STRING_TYPE", "image_illustrate", "%");
$tfi_listservices8->addColumn("services.short_describe", "STRING_TYPE", "short_describe", "%");
$tfi_listservices8->addColumn("services.short_describe_EN", "STRING_TYPE", "short_describe_EN", "%");
$tfi_listservices8->addColumn("services.id_member", "NUMERIC_TYPE", "id_member", "=");
$tfi_listservices8->addColumn("services_categories.id_services_categories", "NUMERIC_TYPE", "id_services_categories", "=");
$tfi_listservices8->addColumn("services.day_update", "DATE_TYPE", "day_update", "=");
$tfi_listservices8->addColumn("services.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listservices8->Execute();

// Sorter
$tso_listservices8 = new TSO_TableSorter("rsservices1", "tso_listservices8");
$tso_listservices8->addColumn("services.title");
$tso_listservices8->addColumn("services.title_EN");
$tso_listservices8->addColumn("services.image_illustrate");
$tso_listservices8->addColumn("services.short_describe");
$tso_listservices8->addColumn("services.short_describe_EN");
$tso_listservices8->addColumn("services.id_member");
$tso_listservices8->addColumn("services_categories.svcat_name");
$tso_listservices8->addColumn("services.day_update");
$tso_listservices8->addColumn("services.visible");
$tso_listservices8->setDefault("services.day_update DESC");
$tso_listservices8->Execute();

// Navigation
$nav_listservices8 = new NAV_Regular("nav_listservices8", "rsservices1", "../", $_SERVER['PHP_SELF'], 20);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_svcat = "SELECT id_services_categories, svcat_name FROM services_categories ORDER BY svcat_sort ASC";
$rs_svcat = mysql_query($query_rs_svcat, $ketnoi) or die(mysql_error());
$row_rs_svcat = mysql_fetch_assoc($rs_svcat);
$totalRows_rs_svcat = mysql_num_rows($rs_svcat);

//NeXTenesio3 Special List Recordset
$maxRows_rsservices1 = $_SESSION['max_rows_nav_listservices8'];
$pageNum_rsservices1 = 0;
if (isset($_GET['pageNum_rsservices1'])) {
  $pageNum_rsservices1 = $_GET['pageNum_rsservices1'];
}
$startRow_rsservices1 = $pageNum_rsservices1 * $maxRows_rsservices1;

// Defining List Recordset variable
$NXTFilter_rsservices1 = "1=1";
if (isset($_SESSION['filter_tfi_listservices8'])) {
  $NXTFilter_rsservices1 = $_SESSION['filter_tfi_listservices8'];
}
// Defining List Recordset variable
$NXTSort_rsservices1 = "services.day_update DESC";
if (isset($_SESSION['sorter_tso_listservices8'])) {
  $NXTSort_rsservices1 = $_SESSION['sorter_tso_listservices8'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsservices1 = "SELECT services.title, services.title_EN, services.image_illustrate, services.short_describe, services.short_describe_EN, services.id_member, services_categories.svcat_name AS id_services_categories, services.day_update, services.visible, services.id_services,member_user FROM (services LEFT JOIN services_categories ON services.id_services_categories = services_categories.id_services_categories),member WHERE {$NXTFilter_rsservices1} AND services.id_member=member.id_member ORDER BY {$NXTSort_rsservices1}";
$query_limit_rsservices1 = sprintf("%s LIMIT %d, %d", $query_rsservices1, $startRow_rsservices1, $maxRows_rsservices1);
$rsservices1 = mysql_query($query_limit_rsservices1, $ketnoi) or die(mysql_error());
$row_rsservices1 = mysql_fetch_assoc($rsservices1);

if (isset($_GET['totalRows_rsservices1'])) {
  $totalRows_rsservices1 = $_GET['totalRows_rsservices1'];
} else {
  $all_rsservices1 = mysql_query($query_rsservices1);
  $totalRows_rsservices1 = mysql_num_rows($all_rsservices1);
}
$totalPages_rsservices1 = ceil($totalRows_rsservices1/$maxRows_rsservices1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listservices8->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: false,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script><style type="text/css">
  /* Dynamic List row settings */
  .KT_col_title {width:100px; overflow:hidden;}
  .KT_col_title_EN {width:100px; overflow:hidden;}
  .KT_col_image_illustrate {width:100px; overflow:hidden;}
  .KT_col_short_describe {width:100px; overflow:hidden;}
  .KT_col_short_describe_EN {width:100px; overflow:hidden;}
  .KT_col_id_member {width:80px; overflow:hidden;}
  .KT_col_id_services_categories {width:100px; overflow:hidden;}
  .KT_col_day_update {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listservices8">
  <h1> Services
    <?php
  $nav_listservices8->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listservices8->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listservices8'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listservices8']; ?>
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
  if (@$_SESSION['has_filter_tfi_listservices8'] == 1) {
?>
                            <a href="<?php echo $tfi_listservices8->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listservices8->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="title" class="KT_sorter KT_col_title <?php echo $tso_listservices8->getSortIcon('services.title'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.title'); ?>">Title</a> </th>
            <th id="title_EN" class="KT_sorter KT_col_title_EN <?php echo $tso_listservices8->getSortIcon('services.title_EN'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.title_EN'); ?>">Title(English)</a> </th>
            <th id="image_illustrate" class="KT_sorter KT_col_image_illustrate <?php echo $tso_listservices8->getSortIcon('services.image_illustrate'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.image_illustrate'); ?>">Image illustrate</a> </th>
            <th id="short_describe" class="KT_sorter KT_col_short_describe <?php echo $tso_listservices8->getSortIcon('services.short_describe'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.short_describe'); ?>">Short describe</a> </th>
            <th id="short_describe_EN" class="KT_sorter KT_col_short_describe_EN <?php echo $tso_listservices8->getSortIcon('services.short_describe_EN'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.short_describe_EN'); ?>">Short describe(English)</a> </th>
            <th id="id_member" class="KT_sorter KT_col_id_member <?php echo $tso_listservices8->getSortIcon('services.id_member'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.id_member'); ?>">Member</a> </th>
            <th id="id_services_categories" class="KT_sorter KT_col_id_services_categories <?php echo $tso_listservices8->getSortIcon('services_categories.svcat_name'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services_categories.svcat_name'); ?>">Services categories</a> </th>
            <th id="day_update" class="KT_sorter KT_col_day_update <?php echo $tso_listservices8->getSortIcon('services.day_update'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.day_update'); ?>">Date update</a> </th>
            <th id="visible" class="KT_sorter KT_col_visible <?php echo $tso_listservices8->getSortIcon('services.visible'); ?>"> <a href="<?php echo $tso_listservices8->getSortLink('services.visible'); ?>">Visible</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listservices8'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listservices8_title" id="tfi_listservices8_title" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices8_title']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listservices8_title_EN" id="tfi_listservices8_title_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices8_title_EN']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listservices8_image_illustrate" id="tfi_listservices8_image_illustrate" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices8_image_illustrate']); ?>" size="20" maxlength="50" /></td>
            <td><input type="text" name="tfi_listservices8_short_describe" id="tfi_listservices8_short_describe" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices8_short_describe']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listservices8_short_describe_EN" id="tfi_listservices8_short_describe_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices8_short_describe_EN']); ?>" size="20" maxlength="255" /></td>
            <td><select name="tfi_listservices8_id_member" id="tfi_listservices8_id_member">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listservices8_id_member']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['id_member']?>"<?php if (!(strcmp($row_Recordset2['id_member'], @$_SESSION['tfi_listservices8_id_member']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['member_user']?></option>
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
            <td><select name="tfi_listservices8_id_services_categories" id="tfi_listservices8_id_services_categories">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listservices8_id_services_categories']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_svcat['id_services_categories']?>"<?php if (!(strcmp($row_rs_svcat['id_services_categories'], @$_SESSION['tfi_listservices8_id_services_categories']))) {echo "SELECTED";} ?>><?php echo $row_rs_svcat['svcat_name']?></option>
              <?php
} while ($row_rs_svcat = mysql_fetch_assoc($rs_svcat));
  $rows = mysql_num_rows($rs_svcat);
  if($rows > 0) {
      mysql_data_seek($rs_svcat, 0);
	  $row_rs_svcat = mysql_fetch_assoc($rs_svcat);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listservices8_day_update" id="tfi_listservices8_day_update" value="<?php echo @$_SESSION['tfi_listservices8_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input type="text" name="tfi_listservices8_visible" id="tfi_listservices8_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices8_visible']); ?>" size="20" maxlength="100" /></td>
            <td><input type="submit" name="tfi_listservices8" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsservices1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="11"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsservices1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_services" class="id_checkbox" value="<?php echo $row_rsservices1['id_services']; ?>" />
                <input type="hidden" name="id_services" class="id_field" value="<?php echo $row_rsservices1['id_services']; ?>" />
            </td>
            <td><div class="KT_col_title"><?php echo KT_FormatForList($row_rsservices1['title'], 20); ?></div></td>
            <td><div class="KT_col_title_EN"><?php echo KT_FormatForList($row_rsservices1['title_EN'], 20); ?></div></td>
            <td><img src="<?php echo tNG_showDynamicImage("../", "../uploads/services/{rsservices1.id_member}/", "{rsservices1.image_illustrate}");?>" width="90" /></td>
            <td><div class="KT_col_short_describe"><?php echo KT_FormatForList($row_rsservices1['short_describe'], 20); ?></div></td>
            <td><div class="KT_col_short_describe_EN"><?php echo KT_FormatForList($row_rsservices1['short_describe_EN'], 20); ?></div></td>
            <td><div class="KT_col_id_member"><?php echo KT_FormatForList($row_rsservices1['member_user'], 20); ?></div></td>
            <td><div class="KT_col_id_services_categories"><?php echo KT_FormatForList($row_rsservices1['id_services_categories'], 20); ?></div></td>
            <td><div class="KT_col_day_update"><?php echo KT_formatDate($row_rsservices1['day_update']); ?></div></td>
            <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rsservices1['visible'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_services&amp;id_services=<?php echo $row_rsservices1['id_services']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rsservices1 = mysql_fetch_assoc($rsservices1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listservices8->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_services&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($rs_svcat);

mysql_free_result($rsservices1);
?>
