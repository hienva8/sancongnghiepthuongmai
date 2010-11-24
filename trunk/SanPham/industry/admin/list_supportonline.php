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
$tor_listsupportonline1 = new TOR_SetOrder($conn_ketnoi, 'supportonline', 'id_supportonline', 'NUMERIC_TYPE', 'sort', 'listsupportonline1_sort_order');
$tor_listsupportonline1->Execute();

// Filter
$tfi_listsupportonline1 = new TFI_TableFilter($conn_ketnoi, "tfi_listsupportonline1");
$tfi_listsupportonline1->addColumn("supportonline.humanname_help", "STRING_TYPE", "humanname_help", "%");
$tfi_listsupportonline1->addColumn("supportonline.tel", "STRING_TYPE", "tel", "%");
$tfi_listsupportonline1->addColumn("supportonline.nickname", "STRING_TYPE", "nickname", "%");
$tfi_listsupportonline1->addColumn("supportonline.status", "STRING_TYPE", "status", "%");
$tfi_listsupportonline1->addColumn("contact_department.id_contact_department", "NUMERIC_TYPE", "id_contact_department", "=");
$tfi_listsupportonline1->addColumn("supportonline.visible", "NUMERIC_TYPE", "visible", "=");
$tfi_listsupportonline1->Execute();

// Sorter
$tso_listsupportonline1 = new TSO_TableSorter("rssupportonline1", "tso_listsupportonline1");
$tso_listsupportonline1->addColumn("supportonline.sort"); // Order column
$tso_listsupportonline1->setDefault("supportonline.sort");
$tso_listsupportonline1->Execute();

// Navigation
$nav_listsupportonline1 = new NAV_Regular("nav_listsupportonline1", "rssupportonline1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT name, id_contact_department FROM contact_department ORDER BY name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

//NeXTenesio3 Special List Recordset
$maxRows_rssupportonline1 = $_SESSION['max_rows_nav_listsupportonline1'];
$pageNum_rssupportonline1 = 0;
if (isset($_GET['pageNum_rssupportonline1'])) {
  $pageNum_rssupportonline1 = $_GET['pageNum_rssupportonline1'];
}
$startRow_rssupportonline1 = $pageNum_rssupportonline1 * $maxRows_rssupportonline1;

// Defining List Recordset variable
$NXTFilter_rssupportonline1 = "1=1";
if (isset($_SESSION['filter_tfi_listsupportonline1'])) {
  $NXTFilter_rssupportonline1 = $_SESSION['filter_tfi_listsupportonline1'];
}
// Defining List Recordset variable
$NXTSort_rssupportonline1 = "supportonline.sort";
if (isset($_SESSION['sorter_tso_listsupportonline1'])) {
  $NXTSort_rssupportonline1 = $_SESSION['sorter_tso_listsupportonline1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rssupportonline1 = "SELECT supportonline.humanname_help, supportonline.tel, supportonline.nickname, supportonline.status, contact_department.name AS id_contact_department, supportonline.visible, supportonline.id_supportonline, supportonline.sort FROM supportonline LEFT JOIN contact_department ON supportonline.id_contact_department = contact_department.id_contact_department WHERE {$NXTFilter_rssupportonline1} ORDER BY {$NXTSort_rssupportonline1}";
$query_limit_rssupportonline1 = sprintf("%s LIMIT %d, %d", $query_rssupportonline1, $startRow_rssupportonline1, $maxRows_rssupportonline1);
$rssupportonline1 = mysql_query($query_limit_rssupportonline1, $ketnoi) or die(mysql_error());
$row_rssupportonline1 = mysql_fetch_assoc($rssupportonline1);

if (isset($_GET['totalRows_rssupportonline1'])) {
  $totalRows_rssupportonline1 = $_GET['totalRows_rssupportonline1'];
} else {
  $all_rssupportonline1 = mysql_query($query_rssupportonline1);
  $totalRows_rssupportonline1 = mysql_num_rows($all_rssupportonline1);
}
$totalPages_rssupportonline1 = ceil($totalRows_rssupportonline1/$maxRows_rssupportonline1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listsupportonline1->checkBoundries();
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
  .KT_col_humanname_help {width:100px; overflow:hidden;}
  .KT_col_tel {width:100px; overflow:hidden;}
  .KT_col_nickname {width:100px; overflow:hidden;}
  .KT_col_status {width:100px; overflow:hidden;}
  .KT_col_id_contact_department {width:100px; overflow:hidden;}
  .KT_col_visible {width:50px; overflow:hidden;}
</style>
<?php echo $tor_listsupportonline1->scriptDefinition(); ?>

</head>

<body>
<div class="KT_tng" id="listsupportonline1">
  <h1> Support online
    <?php
  $nav_listsupportonline1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listsupportonline1->getShowAllLink(); ?>"><?php echo NXT_getResource(hien); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listsupportonline1'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listsupportonline1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listsupportonline1'] == 1) {
?>
                            <a href="<?php echo $tfi_listsupportonline1->getResetFilterLink(); ?>"><?php echo NXT_getResource(anloc); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listsupportonline1->getShowFilterLink(); ?>"><?php echo NXT_getResource(loctin); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="humanname_help" class="KT_col_humanname_help"><?php echo hoten;?></th>
            <th id="tel" class="KT_col_tel"><?php echo dienthoai;?></th>
            <th id="nickname" class="KT_col_nickname"><?php echo email;?></th>
            <th id="status" class="KT_col_status"><?php echo status;?></th>
            <th id="id_contact_department" class="KT_col_id_contact_department"><?php echo bophanlienhe;?></th>
            <th id="visible" class="KT_col_visible"><?php echo anhien;?></th>
            <th id="sort" class="KT_sorter <?php echo $tso_listsupportonline1->getSortIcon('supportonline.sort'); ?> KT_order"> <a href="<?php echo $tso_listsupportonline1->getSortLink('supportonline.sort'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource(luu); ?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listsupportonline1'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listsupportonline1_humanname_help" id="tfi_listsupportonline1_humanname_help" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupportonline1_humanname_help']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listsupportonline1_tel" id="tfi_listsupportonline1_tel" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupportonline1_tel']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listsupportonline1_nickname" id="tfi_listsupportonline1_nickname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupportonline1_nickname']); ?>" size="20" maxlength="30" /></td>
            <td><input type="text" name="tfi_listsupportonline1_status" id="tfi_listsupportonline1_status" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupportonline1_status']); ?>" size="20" maxlength="30" /></td>
            <td><select name="tfi_listsupportonline1_id_contact_department" id="tfi_listsupportonline1_id_contact_department">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsupportonline1_id_contact_department']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_contact_department']?>"<?php if (!(strcmp($row_Recordset1['id_contact_department'], @$_SESSION['tfi_listsupportonline1_id_contact_department']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['name']?></option>
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
            <td><input type="text" name="tfi_listsupportonline1_visible" id="tfi_listsupportonline1_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupportonline1_visible']); ?>" size="20" maxlength="100" /></td>
            <td>&nbsp;</td>
            <td><input type="submit" name="tfi_listsupportonline1" value="<?php echo NXT_getResource(loctin); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rssupportonline1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="9"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rssupportonline1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_supportonline" class="id_checkbox" value="<?php echo $row_rssupportonline1['id_supportonline']; ?>" />
                <input type="hidden" name="id_supportonline" class="id_field" value="<?php echo $row_rssupportonline1['id_supportonline']; ?>" />
            </td>
            <td><div class="KT_col_humanname_help"><?php echo KT_FormatForList($row_rssupportonline1['humanname_help'], 20); ?></div></td>
            <td><div class="KT_col_tel"><?php echo KT_FormatForList($row_rssupportonline1['tel'], 20); ?></div></td>
            <td><div class="KT_col_nickname"><?php echo KT_FormatForList($row_rssupportonline1['nickname'], 20); ?></div></td>
            <td><div class="KT_col_status"><?php echo KT_FormatForList($row_rssupportonline1['status'], 20); ?></div></td>
            <td><div class="KT_col_id_contact_department"><?php echo KT_FormatForList($row_rssupportonline1['id_contact_department'], 20); ?></div></td>
            <td><div class="KT_col_visible"><?php echo KT_FormatForList($row_rssupportonline1['visible'], 20); ?></div></td>
            <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listsupportonline1->getOrderFieldName() ?>" value="<?php echo $tor_listsupportonline1->getOrderFieldValue($row_rssupportonline1) ?>" />
              <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a> </td>
            <td><a class="KT_edit_link" href="index.php?mod=form_supportonline&amp;id_supportonline=<?php echo $row_rssupportonline1['id_supportonline']; ?>&amp;KT_back=1"><?php echo NXT_getResource(sua); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource(xoa); ?></a> </td>
          </tr>
          <?php } while ($row_rssupportonline1 = mysql_fetch_assoc($rssupportonline1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listsupportonline1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_supportonline&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource(themmoi); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rssupportonline1);
?>
