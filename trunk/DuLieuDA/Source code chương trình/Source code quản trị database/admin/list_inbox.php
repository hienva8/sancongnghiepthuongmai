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
$tfi_listinbox2 = new TFI_TableFilter($conn_ketnoi, "tfi_listinbox2");
$tfi_listinbox2->addColumn("inbox.inbox_sender", "NUMERIC_TYPE", "inbox_sender", "=");
$tfi_listinbox2->addColumn("inbox.inbox_recipient", "NUMERIC_TYPE", "inbox_recipient", "=");
$tfi_listinbox2->addColumn("inbox.inbox_subject", "STRING_TYPE", "inbox_subject", "%");
$tfi_listinbox2->addColumn("inbox.inbox_day_update", "DATE_TYPE", "inbox_day_update", "=");
$tfi_listinbox2->addColumn("inbox.inbox_recycle_bin", "CHECKBOX_1_0_TYPE", "inbox_recycle_bin", "%");
$tfi_listinbox2->Execute();

// Sorter
$tso_listinbox2 = new TSO_TableSorter("rsinbox1", "tso_listinbox2");
$tso_listinbox2->addColumn("inbox.inbox_sender");
$tso_listinbox2->addColumn("inbox.inbox_recipient");
$tso_listinbox2->addColumn("inbox.inbox_subject");
$tso_listinbox2->addColumn("inbox.inbox_day_update");
$tso_listinbox2->addColumn("inbox.inbox_recycle_bin");
$tso_listinbox2->setDefault("inbox.inbox_day_update DESC");
$tso_listinbox2->Execute();

// Navigation
$nav_listinbox2 = new NAV_Regular("nav_listinbox2", "rsinbox1", "../", $_SERVER['PHP_SELF'], 20);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = "SELECT id_member, member_user FROM member";
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);

//NeXTenesio3 Special List Recordset
$maxRows_rsinbox1 = $_SESSION['max_rows_nav_listinbox2'];
$pageNum_rsinbox1 = 0;
if (isset($_GET['pageNum_rsinbox1'])) {
  $pageNum_rsinbox1 = $_GET['pageNum_rsinbox1'];
}
$startRow_rsinbox1 = $pageNum_rsinbox1 * $maxRows_rsinbox1;

// Defining List Recordset variable
$NXTFilter_rsinbox1 = "1=1";
if (isset($_SESSION['filter_tfi_listinbox2'])) {
  $NXTFilter_rsinbox1 = $_SESSION['filter_tfi_listinbox2'];
}
// Defining List Recordset variable
$NXTSort_rsinbox1 = "inbox.inbox_day_update DESC";
if (isset($_SESSION['sorter_tso_listinbox2'])) {
  $NXTSort_rsinbox1 = $_SESSION['sorter_tso_listinbox2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsinbox1 = "SELECT inbox.inbox_sender, inbox.inbox_recipient, inbox.inbox_subject, inbox.inbox_day_update, inbox.inbox_recycle_bin, inbox.id_inbox FROM inbox WHERE {$NXTFilter_rsinbox1} ORDER BY {$NXTSort_rsinbox1}";
$query_limit_rsinbox1 = sprintf("%s LIMIT %d, %d", $query_rsinbox1, $startRow_rsinbox1, $maxRows_rsinbox1);
$rsinbox1 = mysql_query($query_limit_rsinbox1, $ketnoi) or die(mysql_error());
$row_rsinbox1 = mysql_fetch_assoc($rsinbox1);

if (isset($_GET['totalRows_rsinbox1'])) {
  $totalRows_rsinbox1 = $_GET['totalRows_rsinbox1'];
} else {
  $all_rsinbox1 = mysql_query($query_rsinbox1);
  $totalRows_rsinbox1 = mysql_num_rows($all_rsinbox1);
}
$totalPages_rsinbox1 = ceil($totalRows_rsinbox1/$maxRows_rsinbox1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listinbox2->checkBoundries();
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
  .KT_col_inbox_sender {width:100px; overflow:hidden;}
  .KT_col_inbox_recipient {width:100px; overflow:hidden;}
  .KT_col_inbox_subject {width:100px; overflow:hidden;}
  .KT_col_inbox_day_update {width:100px; overflow:hidden;}
  .KT_col_inbox_recycle_bin {width:50px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listinbox2">
  <h1> Inbox
    <?php
  $nav_listinbox2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listinbox2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listinbox2'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listinbox2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listinbox2'] == 1) {
?>
                            <a href="<?php echo $tfi_listinbox2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listinbox2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="inbox_sender" class="KT_sorter KT_col_inbox_sender <?php echo $tso_listinbox2->getSortIcon('inbox.inbox_sender'); ?>"> <a href="<?php echo $tso_listinbox2->getSortLink('inbox.inbox_sender'); ?>">Sender</a> </th>
            <th id="inbox_recipient" class="KT_sorter KT_col_inbox_recipient <?php echo $tso_listinbox2->getSortIcon('inbox.inbox_recipient'); ?>"> <a href="<?php echo $tso_listinbox2->getSortLink('inbox.inbox_recipient'); ?>">Recipient</a> </th>
            <th id="inbox_subject" class="KT_sorter KT_col_inbox_subject <?php echo $tso_listinbox2->getSortIcon('inbox.inbox_subject'); ?>"> <a href="<?php echo $tso_listinbox2->getSortLink('inbox.inbox_subject'); ?>">Subject</a> </th>
            <th id="inbox_day_update" class="KT_sorter KT_col_inbox_day_update <?php echo $tso_listinbox2->getSortIcon('inbox.inbox_day_update'); ?>"> <a href="<?php echo $tso_listinbox2->getSortLink('inbox.inbox_day_update'); ?>">Date update</a> </th>
            <th id="inbox_recycle_bin" class="KT_sorter KT_col_inbox_recycle_bin <?php echo $tso_listinbox2->getSortIcon('inbox.inbox_recycle_bin'); ?>"> <a href="<?php echo $tso_listinbox2->getSortLink('inbox.inbox_recycle_bin'); ?>">Recycle bin</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listinbox2'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listinbox2_inbox_sender" id="tfi_listinbox2_inbox_sender" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listinbox2_inbox_sender']); ?>" size="20" maxlength="100" /></td>
            <td><select name="tfi_listinbox2_inbox_recipient" id="tfi_listinbox2_inbox_recipient">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listinbox2_inbox_recipient']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_member['id_member']?>"<?php if (!(strcmp($row_rs_member['id_member'], @$_SESSION['tfi_listinbox2_inbox_recipient']))) {echo "SELECTED";} ?>><?php echo $row_rs_member['member_user']?></option>
              <?php
} while ($row_rs_member = mysql_fetch_assoc($rs_member));
  $rows = mysql_num_rows($rs_member);
  if($rows > 0) {
      mysql_data_seek($rs_member, 0);
	  $row_rs_member = mysql_fetch_assoc($rs_member);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listinbox2_inbox_subject" id="tfi_listinbox2_inbox_subject" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listinbox2_inbox_subject']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listinbox2_inbox_day_update" id="tfi_listinbox2_inbox_day_update" value="<?php echo @$_SESSION['tfi_listinbox2_inbox_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listinbox2_inbox_recycle_bin']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listinbox2_inbox_recycle_bin" id="tfi_listinbox2_inbox_recycle_bin" value="1" /></td>
            <td><input type="submit" name="tfi_listinbox2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsinbox1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsinbox1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_inbox" class="id_checkbox" value="<?php echo $row_rsinbox1['id_inbox']; ?>" />
                <input type="hidden" name="id_inbox" class="id_field" value="<?php echo $row_rsinbox1['id_inbox']; ?>" />
            </td>
            <td><div class="KT_col_inbox_sender"><?php echo KT_FormatForList($row_rsinbox1['inbox_sender'], 20); ?></div></td>
            <td><div class="KT_col_inbox_recipient"><?php echo KT_FormatForList($row_rsinbox1['inbox_recipient'], 20); ?></div></td>
            <td><div class="KT_col_inbox_subject"><?php echo KT_FormatForList($row_rsinbox1['inbox_subject'], 20); ?></div></td>
            <td><div class="KT_col_inbox_day_update"><?php echo KT_formatDate($row_rsinbox1['inbox_day_update']); ?></div></td>
            <td><div class="KT_col_inbox_recycle_bin"><?php echo KT_FormatForList($row_rsinbox1['inbox_recycle_bin'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_inbox&amp;id_inbox=<?php echo $row_rsinbox1['id_inbox']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rsinbox1 = mysql_fetch_assoc($rsinbox1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listinbox2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_inbox&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($rs_member);

mysql_free_result($rsinbox1);
?>
