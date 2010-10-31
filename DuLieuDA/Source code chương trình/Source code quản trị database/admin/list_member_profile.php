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
$tfi_listmember_profile1 = new TFI_TableFilter($conn_ketnoi, "tfi_listmember_profile1");
$tfi_listmember_profile1->addColumn("member_profile.mbpro_id_member", "NUMERIC_TYPE", "mbpro_id_member", "=");
$tfi_listmember_profile1->addColumn("member_profile.mbpro_avatar", "FILE_TYPE", "mbpro_avatar", "%");
$tfi_listmember_profile1->addColumn("member_profile.mbpro_shortinfo", "STRING_TYPE", "mbpro_shortinfo", "%");
$tfi_listmember_profile1->addColumn("member_profile.mbpro_shortinfo_EN", "STRING_TYPE", "mbpro_shortinfo_EN", "%");
$tfi_listmember_profile1->addColumn("member_profile.mbpro_day_update", "DATE_TYPE", "mbpro_day_update", "=");
$tfi_listmember_profile1->addColumn("member_profile.mbpro_visible", "CHECKBOX_1_0_TYPE", "mbpro_visible", "%");
$tfi_listmember_profile1->Execute();

// Sorter
$tso_listmember_profile1 = new TSO_TableSorter("rsmember_profile1", "tso_listmember_profile1");
$tso_listmember_profile1->addColumn("member_profile.mbpro_id_member");
$tso_listmember_profile1->addColumn("member_profile.mbpro_avatar");
$tso_listmember_profile1->addColumn("member_profile.mbpro_shortinfo");
$tso_listmember_profile1->addColumn("member_profile.mbpro_shortinfo_EN");
$tso_listmember_profile1->addColumn("member_profile.mbpro_day_update");
$tso_listmember_profile1->addColumn("member_profile.mbpro_visible");
$tso_listmember_profile1->setDefault("member_profile.mbpro_day_update DESC");
$tso_listmember_profile1->Execute();

// Navigation
$nav_listmember_profile1 = new NAV_Regular("nav_listmember_profile1", "rsmember_profile1", "../", $_SERVER['PHP_SELF'], 20);

//NeXTenesio3 Special List Recordset
$maxRows_rsmember_profile1 = $_SESSION['max_rows_nav_listmember_profile1'];
$pageNum_rsmember_profile1 = 0;
if (isset($_GET['pageNum_rsmember_profile1'])) {
  $pageNum_rsmember_profile1 = $_GET['pageNum_rsmember_profile1'];
}
$startRow_rsmember_profile1 = $pageNum_rsmember_profile1 * $maxRows_rsmember_profile1;

// Defining List Recordset variable
$NXTFilter_rsmember_profile1 = "1=1";
if (isset($_SESSION['filter_tfi_listmember_profile1'])) {
  $NXTFilter_rsmember_profile1 = $_SESSION['filter_tfi_listmember_profile1'];
}
// Defining List Recordset variable
$NXTSort_rsmember_profile1 = "member_profile.mbpro_day_update DESC";
if (isset($_SESSION['sorter_tso_listmember_profile1'])) {
  $NXTSort_rsmember_profile1 = $_SESSION['sorter_tso_listmember_profile1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsmember_profile1 = "SELECT member_profile.mbpro_id_member, member_profile.mbpro_avatar, member_profile.mbpro_shortinfo, member_profile.mbpro_shortinfo_EN, member_profile.mbpro_day_update, member_profile.mbpro_visible, member_profile.id_member_profile FROM member_profile WHERE {$NXTFilter_rsmember_profile1} ORDER BY {$NXTSort_rsmember_profile1}";
$query_limit_rsmember_profile1 = sprintf("%s LIMIT %d, %d", $query_rsmember_profile1, $startRow_rsmember_profile1, $maxRows_rsmember_profile1);
$rsmember_profile1 = mysql_query($query_limit_rsmember_profile1, $ketnoi) or die(mysql_error());
$row_rsmember_profile1 = mysql_fetch_assoc($rsmember_profile1);

if (isset($_GET['totalRows_rsmember_profile1'])) {
  $totalRows_rsmember_profile1 = $_GET['totalRows_rsmember_profile1'];
} else {
  $all_rsmember_profile1 = mysql_query($query_rsmember_profile1);
  $totalRows_rsmember_profile1 = mysql_num_rows($all_rsmember_profile1);
}
$totalPages_rsmember_profile1 = ceil($totalRows_rsmember_profile1/$maxRows_rsmember_profile1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listmember_profile1->checkBoundries();
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
  .KT_col_mbpro_id_member {width:100px; overflow:hidden;}
  .KT_col_mbpro_avatar {width:100px; overflow:hidden;}
  .KT_col_mbpro_shortinfo {width:100px; overflow:hidden;}
  .KT_col_mbpro_shortinfo_EN {width:100px; overflow:hidden;}
  .KT_col_mbpro_day_update {width:100px; overflow:hidden;}
  .KT_col_mbpro_visible {width:50px; overflow:hidden;}
</style>
</head>

<body>
<div class="KT_tng" id="listmember_profile1">
  <h1> <?php echo hosocanhan;?>
    <?php
  $nav_listmember_profile1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listmember_profile1->getShowAllLink(); ?>"><?php echo NXT_getResource(hien); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listmember_profile1'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listmember_profile1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listmember_profile1'] == 1) {
?>
                  <a href="<?php echo $tfi_listmember_profile1->getResetFilterLink(); ?>"><?php echo NXT_getResource(anloc); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listmember_profile1->getShowFilterLink(); ?>"><?php echo NXT_getResource(loctin); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="mbpro_id_member" class="KT_sorter KT_col_mbpro_id_member <?php echo $tso_listmember_profile1->getSortIcon('member_profile.mbpro_id_member'); ?>"> <a href="<?php echo $tso_listmember_profile1->getSortLink('member_profile.mbpro_id_member'); ?>"><?php echo thanhvien;?></a> </th>
            <th id="mbpro_avatar" class="KT_sorter KT_col_mbpro_avatar <?php echo $tso_listmember_profile1->getSortIcon('member_profile.mbpro_avatar'); ?>"> <a href="<?php echo $tso_listmember_profile1->getSortLink('member_profile.mbpro_avatar'); ?>"><?php echo hinhdaidien;?> </a> </th>
            <th id="mbpro_shortinfo" class="KT_sorter KT_col_mbpro_shortinfo <?php echo $tso_listmember_profile1->getSortIcon('member_profile.mbpro_shortinfo'); ?>"> <a href="<?php echo $tso_listmember_profile1->getSortLink('member_profile.mbpro_shortinfo'); ?>"><?php echo gioithieungan.tiengviet;?> </a> </th>
            <th id="mbpro_shortinfo_EN" class="KT_sorter KT_col_mbpro_shortinfo_EN <?php echo $tso_listmember_profile1->getSortIcon('member_profile.mbpro_shortinfo_EN'); ?>"> <a href="<?php echo $tso_listmember_profile1->getSortLink('member_profile.mbpro_shortinfo_EN'); ?>"><?php echo gioithieungan.tienganh;?> </a> </th>
            <th id="mbpro_day_update" class="KT_sorter KT_col_mbpro_day_update <?php echo $tso_listmember_profile1->getSortIcon('member_profile.mbpro_day_update'); ?>"> <a href="<?php echo $tso_listmember_profile1->getSortLink('member_profile.mbpro_day_update'); ?>"><?php echo ngaycapnhat;?> </a> </th>
            <th id="mbpro_visible" class="KT_sorter KT_col_mbpro_visible <?php echo $tso_listmember_profile1->getSortIcon('member_profile.mbpro_visible'); ?>"> <a href="<?php echo $tso_listmember_profile1->getSortLink('member_profile.mbpro_visible'); ?>"><?php echo anhien;?> </a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listmember_profile1'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listmember_profile1_mbpro_id_member" id="tfi_listmember_profile1_mbpro_id_member" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember_profile1_mbpro_id_member']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listmember_profile1_mbpro_avatar" id="tfi_listmember_profile1_mbpro_avatar" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember_profile1_mbpro_avatar']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listmember_profile1_mbpro_shortinfo" id="tfi_listmember_profile1_mbpro_shortinfo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember_profile1_mbpro_shortinfo']); ?>" size="20" maxlength="255" /></td>
              <td><input type="text" name="tfi_listmember_profile1_mbpro_shortinfo_EN" id="tfi_listmember_profile1_mbpro_shortinfo_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember_profile1_mbpro_shortinfo_EN']); ?>" size="20" maxlength="255" /></td>
              <td><input type="text" name="tfi_listmember_profile1_mbpro_day_update" id="tfi_listmember_profile1_mbpro_day_update" value="<?php echo @$_SESSION['tfi_listmember_profile1_mbpro_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listmember_profile1_mbpro_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listmember_profile1_mbpro_visible" id="tfi_listmember_profile1_mbpro_visible" value="1" /></td>
              <td><input type="submit" name="tfi_listmember_profile1" value="<?php echo NXT_getResource(loc); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsmember_profile1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="8"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsmember_profile1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_member_profile" class="id_checkbox" value="<?php echo $row_rsmember_profile1['id_member_profile']; ?>" />
                    <input type="hidden" name="id_member_profile" class="id_field" value="<?php echo $row_rsmember_profile1['id_member_profile']; ?>" />
                </td>
                <td><div class="KT_col_mbpro_id_member"><?php echo KT_FormatForList($row_rsmember_profile1['mbpro_id_member'], 20); ?></div></td>
                <td><?php 
// Show IF Conditional region4 
if (@$row_rsmember_profile1['mbpro_avatar'] != "") {
?>
                    <?php 
// Show If File Exists (region5)
if (tNG_fileExists("../uploads/avatar/{rsmember_profile1.mbpro_id_member}/", "{rsmember_profile1.mbpro_avatar}")) {
?>
                      <img src="<?php echo tNG_showDynamicImage("../", "../uploads/avatar/{rsmember_profile1.mbpro_id_member}/", "{rsmember_profile1.mbpro_avatar}");?>" width="100" />
                      <?php } 
// EndIf File Exists (region5)
?>
                  <?php } 
// endif Conditional region4
?></td>
                <td><div class="KT_col_mbpro_shortinfo"><?php echo KT_FormatForList($row_rsmember_profile1['mbpro_shortinfo'], 20); ?></div></td>
                <td><div class="KT_col_mbpro_shortinfo_EN"><?php echo KT_FormatForList($row_rsmember_profile1['mbpro_shortinfo_EN'], 20); ?></div></td>
                <td><div class="KT_col_mbpro_day_update"><?php echo KT_formatDate($row_rsmember_profile1['mbpro_day_update']); ?></div></td>
                <td><div class="KT_col_mbpro_visible"><?php echo KT_FormatForList($row_rsmember_profile1['mbpro_visible'], 20); ?></div></td>
                <td><a class="KT_edit_link" href="index.php?mod=form_member_profile&amp;id_member_profile=<?php echo $row_rsmember_profile1['id_member_profile']; ?>&amp;KT_back=1"><?php echo NXT_getResource(sua); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource(xoa); ?></a> </td>
              </tr>
              <?php } while ($row_rsmember_profile1 = mysql_fetch_assoc($rsmember_profile1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listmember_profile1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_member_profile&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource(themmoi); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsmember_profile1);
?>
