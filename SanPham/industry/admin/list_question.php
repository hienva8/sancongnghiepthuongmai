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
$tfi_listquestion3 = new TFI_TableFilter($conn_ketnoi, "tfi_listquestion3");
$tfi_listquestion3->addColumn("question.question_fullname", "STRING_TYPE", "question_fullname", "%");
$tfi_listquestion3->addColumn("question.question_email", "STRING_TYPE", "question_email", "%");
$tfi_listquestion3->addColumn("question.question_title", "STRING_TYPE", "question_title", "%");
$tfi_listquestion3->addColumn("question.question_day_update", "DATE_TYPE", "question_day_update", "=");
$tfi_listquestion3->addColumn("question.question_visible", "NUMERIC_TYPE", "question_visible", "=");
$tfi_listquestion3->Execute();

// Sorter
$tso_listquestion3 = new TSO_TableSorter("rsquestion1", "tso_listquestion3");
$tso_listquestion3->addColumn("question.question_fullname");
$tso_listquestion3->addColumn("question.question_email");
$tso_listquestion3->addColumn("question.question_title");
$tso_listquestion3->addColumn("question.question_day_update");
$tso_listquestion3->addColumn("question.question_visible");
$tso_listquestion3->setDefault("question.question_day_update DESC");
$tso_listquestion3->Execute();

// Navigation
$nav_listquestion3 = new NAV_Regular("nav_listquestion3", "rsquestion1", "../", $_SERVER['PHP_SELF'], 20);

//NeXTenesio3 Special List Recordset
$maxRows_rsquestion1 = $_SESSION['max_rows_nav_listquestion3'];
$pageNum_rsquestion1 = 0;
if (isset($_GET['pageNum_rsquestion1'])) {
  $pageNum_rsquestion1 = $_GET['pageNum_rsquestion1'];
}
$startRow_rsquestion1 = $pageNum_rsquestion1 * $maxRows_rsquestion1;

// Defining List Recordset variable
$NXTFilter_rsquestion1 = "1=1";
if (isset($_SESSION['filter_tfi_listquestion3'])) {
  $NXTFilter_rsquestion1 = $_SESSION['filter_tfi_listquestion3'];
}
// Defining List Recordset variable
$NXTSort_rsquestion1 = "question.question_day_update DESC";
if (isset($_SESSION['sorter_tso_listquestion3'])) {
  $NXTSort_rsquestion1 = $_SESSION['sorter_tso_listquestion3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsquestion1 = "SELECT question.question_fullname, question.question_email, question.question_title, question.question_day_update, question.question_visible, question.id_question FROM question WHERE {$NXTFilter_rsquestion1} ORDER BY {$NXTSort_rsquestion1}";
$query_limit_rsquestion1 = sprintf("%s LIMIT %d, %d", $query_rsquestion1, $startRow_rsquestion1, $maxRows_rsquestion1);
$rsquestion1 = mysql_query($query_limit_rsquestion1, $ketnoi) or die(mysql_error());
$row_rsquestion1 = mysql_fetch_assoc($rsquestion1);

if (isset($_GET['totalRows_rsquestion1'])) {
  $totalRows_rsquestion1 = $_GET['totalRows_rsquestion1'];
} else {
  $all_rsquestion1 = mysql_query($query_rsquestion1);
  $totalRows_rsquestion1 = mysql_num_rows($all_rsquestion1);
}
$totalPages_rsquestion1 = ceil($totalRows_rsquestion1/$maxRows_rsquestion1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listquestion3->checkBoundries();
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
  .KT_col_question_fullname {width:100px; overflow:hidden;}
  .KT_col_question_email {width:100px; overflow:hidden;}
  .KT_col_question_title {width:140px; overflow:hidden;}
  .KT_col_question_day_update {width:100px; overflow:hidden;}
  .KT_col_question_visible {width:50px; overflow:hidden;}
</style>
</head>

<body>
<div class="KT_tng" id="listquestion3">
  <h1> <?php echo cauhoi;?>
    <?php
  $nav_listquestion3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listquestion3->getShowAllLink(); ?>"><?php echo NXT_getResource(hien); ?>
        <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listquestion3'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listquestion3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listquestion3'] == 1) {
?>
                  <a href="<?php echo $tfi_listquestion3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listquestion3->getShowFilterLink(); ?>"><?php echo NXT_getResource(loctin); ?></a>
                  <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="question_fullname" class="KT_sorter KT_col_question_fullname <?php echo $tso_listquestion3->getSortIcon('question.question_fullname'); ?>"> <a href="<?php echo $tso_listquestion3->getSortLink('question.question_fullname'); ?>"><?php echo hoten;?></a> </th>
            <th id="question_email" class="KT_sorter KT_col_question_email <?php echo $tso_listquestion3->getSortIcon('question.question_email'); ?>"> <a href="<?php echo $tso_listquestion3->getSortLink('question.question_email'); ?>"><?php echo email;?> </a> </th>
            <th id="question_title" class="KT_sorter KT_col_question_title <?php echo $tso_listquestion3->getSortIcon('question.question_title'); ?>"> <a href="<?php echo $tso_listquestion3->getSortLink('question.question_title'); ?>"><?php echo tieude;?> </a> </th>
            <th id="question_day_update" class="KT_sorter KT_col_question_day_update <?php echo $tso_listquestion3->getSortIcon('question.question_day_update'); ?>"> <a href="<?php echo $tso_listquestion3->getSortLink('question.question_day_update'); ?>"><?php echo ngaycapnhat;?></a> </th>
            <th id="question_visible" class="KT_sorter KT_col_question_visible <?php echo $tso_listquestion3->getSortIcon('question.question_visible'); ?>"> <a href="<?php echo $tso_listquestion3->getSortLink('question.question_visible'); ?>"><?php echo anhien;?></a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listquestion3'] == 1) {
?>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td><input type="text" name="tfi_listquestion3_question_fullname" id="tfi_listquestion3_question_fullname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listquestion3_question_fullname']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listquestion3_question_email" id="tfi_listquestion3_question_email" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listquestion3_question_email']); ?>" size="20" maxlength="60" /></td>
              <td><input type="text" name="tfi_listquestion3_question_title" id="tfi_listquestion3_question_title" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listquestion3_question_title']); ?>" size="20" maxlength="100" /></td>
              <td><input type="text" name="tfi_listquestion3_question_day_update" id="tfi_listquestion3_question_day_update" value="<?php echo @$_SESSION['tfi_listquestion3_question_day_update']; ?>" size="10" maxlength="22" /></td>
              <td><input type="text" name="tfi_listquestion3_question_visible" id="tfi_listquestion3_question_visible" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listquestion3_question_visible']); ?>" size="20" maxlength="100" /></td>
              <td><input type="submit" name="tfi_listquestion3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
            </tr>
            <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsquestion1 == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
            </tr>
            <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsquestion1 > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                <td><input type="checkbox" name="kt_pk_question" class="id_checkbox" value="<?php echo $row_rsquestion1['id_question']; ?>" />
                    <input type="hidden" name="id_question" class="id_field" value="<?php echo $row_rsquestion1['id_question']; ?>" />
                </td>
                <td><div class="KT_col_question_fullname"><?php echo KT_FormatForList($row_rsquestion1['question_fullname'], 20); ?></div></td>
                <td><div class="KT_col_question_email"><?php echo KT_FormatForList($row_rsquestion1['question_email'], 20); ?></div></td>
                <td><div class="KT_col_question_title"><?php echo KT_FormatForList($row_rsquestion1['question_title'], 20); ?></div></td>
                <td><div class="KT_col_question_day_update"><?php echo KT_formatDate($row_rsquestion1['question_day_update']); ?></div></td>
                <td><div class="KT_col_question_visible"><?php echo KT_FormatForList($row_rsquestion1['question_visible'], 20); ?></div></td>
                <td><a class="KT_edit_link" href="index.php?mod=form_question&amp;id_question=<?php echo $row_rsquestion1['id_question']; ?>&amp;KT_back=1"><?php echo NXT_getResource(sua); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource(xoa); ?></a><a class="KT_link" href="index.php?mod=list_answer&amp;NxT_id_question=<?php echo $row_rsquestion1['id_question']; ?>&amp;KT_back=1"><?php echo traloi;?></a> </td>
              </tr>
              <?php } while ($row_rsquestion1 = mysql_fetch_assoc($rsquestion1)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listquestion3->Prepare();
            require("../includes/nav/NAV_Text_Navigation.inc.php");
          ?>
        </div>
      </div>
      <div class="KT_bottombuttons">
        <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource(sua); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource(xoa); ?></a> </div>
<?php /*?><span>&nbsp;</span>
        <select name="no_new" id="no_new">
          <option value="1">1</option>
          <option value="3">3</option>
          <option value="6">6</option>
        </select>
        <a class="KT_additem_op_link" href="index.php?mod=form_question&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a><?php */?> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
</body>
</html>
<?php
mysql_free_result($rsquestion1);
?>
