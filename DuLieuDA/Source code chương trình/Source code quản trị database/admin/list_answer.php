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
$tfi_listanswer1 = new TFI_TableFilter($conn_ketnoi, "tfi_listanswer1");
$tfi_listanswer1->addColumn("answer.answer_id_member", "NUMERIC_TYPE", "answer_id_member", "=");
$tfi_listanswer1->addColumn("answer.answer_day_update", "DATE_TYPE", "answer_day_update", "=");
$tfi_listanswer1->addColumn("answer.answer_visible", "NUMERIC_TYPE", "answer_visible", "=");
$tfi_listanswer1->Execute();

// Sorter
$tso_listanswer1 = new TSO_TableSorter("rsanswer1", "tso_listanswer1");
$tso_listanswer1->addColumn("answer.answer_id_member");
$tso_listanswer1->addColumn("answer.answer_day_update");
$tso_listanswer1->addColumn("answer.answer_visible");
$tso_listanswer1->setDefault("answer.answer_day_update DESC");
$tso_listanswer1->Execute();

// Navigation
$nav_listanswer1 = new NAV_Regular("nav_listanswer1", "rsanswer1", "../", $_SERVER['PHP_SELF'], 20);

if (isset($_GET['NxT_id_question'])) {
  $NxTDetailCond__rsanswer1_cond = " answer.answer_id_question = " . GetSQLValueString($_GET['NxT_id_question'], "int") . " ";
}

//NeXTenesio3 Special List Recordset
$maxRows_rsanswer1 = $_SESSION['max_rows_nav_listanswer1'];
$pageNum_rsanswer1 = 0;
if (isset($_GET['pageNum_rsanswer1'])) {
  $pageNum_rsanswer1 = $_GET['pageNum_rsanswer1'];
}
$startRow_rsanswer1 = $pageNum_rsanswer1 * $maxRows_rsanswer1;

// Defining List Recordset variable
$NxTDetailCond_rsanswer1 = "1=1";
if (isset($NxTDetailCond__rsanswer1_cond)) {
  $NxTDetailCond_rsanswer1 = $NxTDetailCond__rsanswer1_cond;
}
// Defining List Recordset variable
$NXTFilter_rsanswer1 = "1=1";
if (isset($_SESSION['filter_tfi_listanswer1'])) {
  $NXTFilter_rsanswer1 = $_SESSION['filter_tfi_listanswer1'];
}
// Defining List Recordset variable
$NXTSort_rsanswer1 = "answer.answer_day_update DESC";
if (isset($_SESSION['sorter_tso_listanswer1'])) {
  $NXTSort_rsanswer1 = $_SESSION['sorter_tso_listanswer1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsanswer1 = "SELECT answer.answer_id_question, answer.answer_id_member, answer.answer_day_update, answer.answer_visible, answer.id_answer,member_user FROM answer,member WHERE id_member=answer_id_member AND {$NXTFilter_rsanswer1} AND  {$NxTDetailCond_rsanswer1} ORDER BY {$NXTSort_rsanswer1}";
$query_limit_rsanswer1 = sprintf("%s LIMIT %d, %d", $query_rsanswer1, $startRow_rsanswer1, $maxRows_rsanswer1);
$rsanswer1 = mysql_query($query_limit_rsanswer1, $ketnoi) or die(mysql_error());
$row_rsanswer1 = mysql_fetch_assoc($rsanswer1);

if (isset($_GET['totalRows_rsanswer1'])) {
  $totalRows_rsanswer1 = $_GET['totalRows_rsanswer1'];
} else {
  $all_rsanswer1 = mysql_query($query_rsanswer1);
  $totalRows_rsanswer1 = mysql_num_rows($all_rsanswer1);
}
$totalPages_rsanswer1 = ceil($totalRows_rsanswer1/$maxRows_rsanswer1)-1;
//End NeXTenesio3 Special List Recordset

$NxTMasterId_rsquestion1 = "-1";
if (isset($_GET['NxT_id_question'])) {
  $NxTMasterId_rsquestion1 = $_GET['NxT_id_question'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rsquestion1 = sprintf("SELECT id_question, question_title FROM question WHERE id_question = %s", GetSQLValueString($NxTMasterId_rsquestion1, "int"));
$rsquestion1 = mysql_query($query_rsquestion1, $ketnoi) or die(mysql_error());
$row_rsquestion1 = mysql_fetch_assoc($rsquestion1);
$totalRows_rsquestion1 = mysql_num_rows($rsquestion1);
$nav_listanswer1->checkBoundries();
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
  .KT_col_answer_id_member {width:140px; overflow:hidden;}
  .KT_col_answer_day_update {width:140px; overflow:hidden;}
  .KT_col_answer_visible {width:140px; overflow:hidden;}
</style>
</head>

<body>
<div class="KT_tng" id="listanswer1">
  <h1> Answer
    <?php
  $nav_listanswer1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <?php 
// Show IF Conditional region4 
if (isset($_GET['NxT_id_question'])) {
?>
      <table>
        <tr class="KT_masterlink">
          <td>List records for: &nbsp; <strong><?php echo $row_rsquestion1['question_title']; ?></strong></td>
          <td align="right"><a href="../includes/nxt/back.php?KT_back=-2">Back to the Question list</a></td>
        </tr>
              </table>
      <?php } 
// endif Conditional region4
?><form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listanswer1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listanswer1'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listanswer1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listanswer1'] == 1) {
?>
                  <a href="<?php echo $tfi_listanswer1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listanswer1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>            </th>
            <th id="answer_id_member" class="KT_sorter KT_col_answer_id_member <?php echo $tso_listanswer1->getSortIcon('answer.answer_id_member'); ?>"> <a href="<?php echo $tso_listanswer1->getSortLink('answer.answer_id_member'); ?>"><?php echo thanhvien;?></a> </th>
            <th id="answer_day_update" class="KT_sorter KT_col_answer_day_update <?php echo $tso_listanswer1->getSortIcon('answer.answer_day_update'); ?>"> <a href="<?php echo $tso_listanswer1->getSortLink('answer.answer_day_update'); ?>"><?php echo ngaytraloi;?></a> </th>
            <th id="answer_visible" class="KT_sorter KT_col_answer_visible <?php echo $tso_listanswer1->getSortIcon('answer.answer_visible'); ?>"> <a href="<?php echo $tso_listanswer1->getSortLink('answer.answer_visible'); ?>"><?php echo anhien;?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listanswer1'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listanswer1_answer_id_member" id="tfi_listanswer1_answer_id_member" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listanswer1_answer_id_member']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listanswer1_answer_day_update" id="tfi_listanswer1_answer_day_update" value="<?php echo @$_SESSION['tfi_listanswer1_answer_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listanswer1_answer_visible" id="tfi_listanswer1_answer_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listanswer1_answer_visible']); ?>" size="20" maxlength="100" /></td>
              <td><input type="submit" name="tfi_listanswer1" value="<?php echo NXT_getResource(loc); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsanswer1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsanswer1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_answer" class="id_checkbox" value="<?php echo $row_rsanswer1['id_answer']; ?>" />
                    <input type="hidden" name="id_answer" class="id_field" value="<?php echo $row_rsanswer1['id_answer']; ?>" />                </td>
                <td><div class="KT_col_answer_id_member"><?php echo KT_FormatForList($row_rsanswer1['member_user'], 20); ?></div></td>
                <td><div class="KT_col_answer_day_update"><?php echo KT_formatDate($row_rsanswer1['answer_day_update']); ?></div></td>
                <td><div class="KT_col_answer_visible"><?php echo KT_FormatForList($row_rsanswer1['answer_visible'], 20); ?></div></td>
                <td><a class="KT_edit_link" href="index.php?mod=form_answer&amp;<?php echo isset($_GET['NxT_id_question']) ? "NxT_id_question=".$_GET['NxT_id_question'] : ""; ?>&amp;id_answer=<?php echo $row_rsanswer1['id_answer']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
              </tr>
              <?php } while ($row_rsanswer1 = mysql_fetch_assoc($rsanswer1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listanswer1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?<?php echo isset($_GET['NxT_id_question']) ? "NxT_id_question=".$_GET['NxT_id_question'] : ""; ?>&amp;mod=form_answer&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsanswer1);

mysql_free_result($rsquestion1);

mysql_free_result($rs_member);
?>
