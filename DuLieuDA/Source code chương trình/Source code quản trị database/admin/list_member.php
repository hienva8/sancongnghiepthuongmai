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
$tfi_listmember3 = new TFI_TableFilter($conn_ketnoi, "tfi_listmember3");
$tfi_listmember3->addColumn("member.member_user", "STRING_TYPE", "member_user", "%");
$tfi_listmember3->addColumn("member.member_name", "STRING_TYPE", "member_name", "%");
$tfi_listmember3->addColumn("country.id_country", "NUMERIC_TYPE", "member_id_country", "=");
$tfi_listmember3->addColumn("member.member_sex", "NUMERIC_TYPE", "member_sex", "=");
$tfi_listmember3->addColumn("member.member_email", "STRING_TYPE", "member_email", "%");
$tfi_listmember3->addColumn("member.member_tell", "STRING_TYPE", "member_tell", "%");
$tfi_listmember3->addColumn("member.member_fax", "STRING_TYPE", "member_fax", "%");
$tfi_listmember3->addColumn("member.member_kind", "NUMERIC_TYPE", "member_kind", "=");
$tfi_listmember3->addColumn("member.member_day_update", "DATE_TYPE", "member_day_update", "=");
$tfi_listmember3->addColumn("member.member_accesslevel", "NUMERIC_TYPE", "member_accesslevel", "=");
$tfi_listmember3->addColumn("member.member_active", "NUMERIC_TYPE", "member_active", "=");
$tfi_listmember3->Execute();

// Sorter
$tso_listmember3 = new TSO_TableSorter("rsmember1", "tso_listmember3");
$tso_listmember3->addColumn("member.member_user");
$tso_listmember3->addColumn("member.member_name");
$tso_listmember3->addColumn("country.country_name");
$tso_listmember3->addColumn("member.member_sex");
$tso_listmember3->addColumn("member.member_email");
$tso_listmember3->addColumn("member.member_tell");
$tso_listmember3->addColumn("member.member_fax");
$tso_listmember3->addColumn("member.member_kind");
$tso_listmember3->addColumn("member.member_day_update");
$tso_listmember3->addColumn("member.member_accesslevel");
$tso_listmember3->addColumn("member.member_active");
$tso_listmember3->setDefault("member.member_day_update DESC");
$tso_listmember3->Execute();

// Navigation
$nav_listmember3 = new NAV_Regular("nav_listmember3", "rsmember1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT country_name, id_country FROM country ORDER BY country_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

//NeXTenesio3 Special List Recordset
$maxRows_rsmember1 = $_SESSION['max_rows_nav_listmember3'];
$pageNum_rsmember1 = 0;
if (isset($_GET['pageNum_rsmember1'])) {
  $pageNum_rsmember1 = $_GET['pageNum_rsmember1'];
}
$startRow_rsmember1 = $pageNum_rsmember1 * $maxRows_rsmember1;

// Defining List Recordset variable
$NXTFilter_rsmember1 = "1=1";
if (isset($_SESSION['filter_tfi_listmember3'])) {
  $NXTFilter_rsmember1 = $_SESSION['filter_tfi_listmember3'];
}
// Defining List Recordset variable
$NXTSort_rsmember1 = "member.member_day_update DESC";
if (isset($_SESSION['sorter_tso_listmember3'])) {
  $NXTSort_rsmember1 = $_SESSION['sorter_tso_listmember3'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsmember1 = "SELECT member.member_user, member.member_name, country.country_name AS member_id_country, member.member_sex, member.member_email, member.member_tell, member.member_fax, member.member_kind, member.member_day_update, member.member_accesslevel, member.member_active, member.id_member FROM member LEFT JOIN country ON member.member_id_country = country.id_country WHERE {$NXTFilter_rsmember1} ORDER BY {$NXTSort_rsmember1}";
$query_limit_rsmember1 = sprintf("%s LIMIT %d, %d", $query_rsmember1, $startRow_rsmember1, $maxRows_rsmember1);
$rsmember1 = mysql_query($query_limit_rsmember1, $ketnoi) or die(mysql_error());
$row_rsmember1 = mysql_fetch_assoc($rsmember1);

if (isset($_GET['totalRows_rsmember1'])) {
  $totalRows_rsmember1 = $_GET['totalRows_rsmember1'];
} else {
  $all_rsmember1 = mysql_query($query_rsmember1);
  $totalRows_rsmember1 = mysql_num_rows($all_rsmember1);
}
$totalPages_rsmember1 = ceil($totalRows_rsmember1/$maxRows_rsmember1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listmember3->checkBoundries();
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
  .KT_col_member_user {width:80px; overflow:hidden;}
  .KT_col_member_name {width:100px; overflow:hidden;}
  .KT_col_member_id_country {width:100px; overflow:hidden;}
  .KT_col_member_sex {width:50px; overflow:hidden;}
  .KT_col_member_email {width:80px; overflow:hidden;}
  .KT_col_member_tell {width:80px; overflow:hidden;}
  .KT_col_member_fax {width:80px; overflow:hidden;}
  .KT_col_member_kind {width:50px; overflow:hidden;}
  .KT_col_member_day_update {width:80px; overflow:hidden;}
  .KT_col_member_accesslevel {width:50px; overflow:hidden;}
  .KT_col_member_active {width:50px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listmember3">
  <h1> Member
    <?php
  $nav_listmember3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listmember3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listmember3'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listmember3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listmember3'] == 1) {
?>
                            <a href="<?php echo $tfi_listmember3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listmember3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="member_user" class="KT_sorter KT_col_member_user <?php echo $tso_listmember3->getSortIcon('member.member_user'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_user'); ?>">User name</a> </th>
            <th id="member_name" class="KT_sorter KT_col_member_name <?php echo $tso_listmember3->getSortIcon('member.member_name'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_name'); ?>">Full name</a> </th>
            <th id="member_id_country" class="KT_sorter KT_col_member_id_country <?php echo $tso_listmember3->getSortIcon('country.country_name'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('country.country_name'); ?>">Country</a> </th>
            <th id="member_sex" class="KT_sorter KT_col_member_sex <?php echo $tso_listmember3->getSortIcon('member.member_sex'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_sex'); ?>">Gender</a> </th>
            <th id="member_email" class="KT_sorter KT_col_member_email <?php echo $tso_listmember3->getSortIcon('member.member_email'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_email'); ?>">Email</a> </th>
            <th id="member_tell" class="KT_sorter KT_col_member_tell <?php echo $tso_listmember3->getSortIcon('member.member_tell'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_tell'); ?>">Phone</a> </th>
            <th id="member_fax" class="KT_sorter KT_col_member_fax <?php echo $tso_listmember3->getSortIcon('member.member_fax'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_fax'); ?>">Fax</a> </th>
            <th id="member_kind" class="KT_sorter KT_col_member_kind <?php echo $tso_listmember3->getSortIcon('member.member_kind'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_kind'); ?>">Kind</a> </th>
            <th id="member_day_update" class="KT_sorter KT_col_member_day_update <?php echo $tso_listmember3->getSortIcon('member.member_day_update'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_day_update'); ?>">Day update</a> </th>
            <th id="member_accesslevel" class="KT_sorter KT_col_member_accesslevel <?php echo $tso_listmember3->getSortIcon('member.member_accesslevel'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_accesslevel'); ?>">Level</a> </th>
            <th id="member_active" class="KT_sorter KT_col_member_active <?php echo $tso_listmember3->getSortIcon('member.member_active'); ?>"> <a href="<?php echo $tso_listmember3->getSortLink('member.member_active'); ?>">Active</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listmember3'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listmember3_member_user" id="tfi_listmember3_member_user" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_user']); ?>" size="20" maxlength="50" /></td>
            <td><input type="text" name="tfi_listmember3_member_name" id="tfi_listmember3_member_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_name']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listmember3_member_id_country" id="tfi_listmember3_member_id_country">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listmember3_member_id_country']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_country']?>"<?php if (!(strcmp($row_Recordset1['id_country'], @$_SESSION['tfi_listmember3_member_id_country']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['country_name']?></option>
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
            <td><select name="tfi_listmember3_member_sex" id="tfi_listmember3_member_sex">
              <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_sex'])))) {echo "SELECTED";} ?>>Mr</option>
              <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_sex'])))) {echo "SELECTED";} ?>>Mrs/Miss</option>
              <option value="3" <?php if (!(strcmp(3, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_sex'])))) {echo "SELECTED";} ?>>Orther</option>
            </select>
            </td>
            <td><input type="text" name="tfi_listmember3_member_email" id="tfi_listmember3_member_email" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_email']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listmember3_member_tell" id="tfi_listmember3_member_tell" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_tell']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listmember3_member_fax" id="tfi_listmember3_member_fax" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_fax']); ?>" size="20" maxlength="20" /></td>
            <td><select name="tfi_listmember3_member_kind" id="tfi_listmember3_member_kind">
              <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_kind'])))) {echo "SELECTED";} ?>>VIP</option>
              <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_kind'])))) {echo "SELECTED";} ?>>Business</option>
              <option value="3" <?php if (!(strcmp(3, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_kind'])))) {echo "SELECTED";} ?>>Member</option>
            </select>
            </td>
            <td><input type="text" name="tfi_listmember3_member_day_update" id="tfi_listmember3_member_day_update" value="<?php echo @$_SESSION['tfi_listmember3_member_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><select name="tfi_listmember3_member_accesslevel" id="tfi_listmember3_member_accesslevel">
              <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_accesslevel'])))) {echo "SELECTED";} ?>>Admin</option>
              <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_accesslevel'])))) {echo "SELECTED";} ?>>Member</option>
            </select>
            </td>
            <td><input type="text" name="tfi_listmember3_member_active" id="tfi_listmember3_member_active" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listmember3_member_active']); ?>" size="20" maxlength="100" /></td>
            <td><input type="submit" name="tfi_listmember3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsmember1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="13"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsmember1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_member" class="id_checkbox" value="<?php echo $row_rsmember1['id_member']; ?>" />
                <input type="hidden" name="id_member" class="id_field" value="<?php echo $row_rsmember1['id_member']; ?>" />
            </td>
            <td><div class="KT_col_member_user"><?php echo KT_FormatForList($row_rsmember1['member_user'], 20); ?></div></td>
            <td><div class="KT_col_member_name"><?php echo KT_FormatForList($row_rsmember1['member_name'], 20); ?></div></td>
            <td><div class="KT_col_member_id_country"><?php echo KT_FormatForList($row_rsmember1['member_id_country'], 20); ?></div></td>
            <td><div class="KT_col_member_sex"><?php echo KT_FormatForList($row_rsmember1['member_sex'], 20); ?></div></td>
            <td><div class="KT_col_member_email"><?php echo KT_FormatForList($row_rsmember1['member_email'], 20); ?></div></td>
            <td><div class="KT_col_member_tell"><?php echo KT_FormatForList($row_rsmember1['member_tell'], 20); ?></div></td>
            <td><div class="KT_col_member_fax"><?php echo KT_FormatForList($row_rsmember1['member_fax'], 20); ?></div></td>
            <td><div class="KT_col_member_kind"><?php echo KT_FormatForList($row_rsmember1['member_kind'], 20); ?></div></td>
            <td><div class="KT_col_member_day_update"><?php echo KT_formatDate($row_rsmember1['member_day_update']); ?></div></td>
            <td><div class="KT_col_member_accesslevel"><?php echo KT_FormatForList($row_rsmember1['member_accesslevel'], 20); ?></div></td>
            <td><div class="KT_col_member_active"><?php echo KT_FormatForList($row_rsmember1['member_active'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_member&amp;id_member=<?php echo $row_rsmember1['id_member']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rsmember1 = mysql_fetch_assoc($rsmember1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listmember3->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_member&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rsmember1);
?>
