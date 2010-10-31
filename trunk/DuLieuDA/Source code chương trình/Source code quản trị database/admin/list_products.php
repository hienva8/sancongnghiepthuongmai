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
$tfi_listproducts2 = new TFI_TableFilter($conn_ketnoi, "tfi_listproducts2");
$tfi_listproducts2->addColumn("procat.id_procat", "NUMERIC_TYPE", "id_procat", "=");
$tfi_listproducts2->addColumn("prosubcat1.id_prosubcat1", "NUMERIC_TYPE", "id_prosubcat1", "=");
$tfi_listproducts2->addColumn("prosubcat2.id_prosubcat2", "NUMERIC_TYPE", "id_prosubcat2", "=");
$tfi_listproducts2->addColumn("prosubcat3.id_prosubcat3", "NUMERIC_TYPE", "id_prosubcat3", "=");
$tfi_listproducts2->addColumn("country.id_country", "NUMERIC_TYPE", "id_country", "=");
$tfi_listproducts2->addColumn("products.product_name", "STRING_TYPE", "product_name", "%");
$tfi_listproducts2->addColumn("products.product_name_EN", "STRING_TYPE", "product_name_EN", "%");
$tfi_listproducts2->addColumn("products.product_short_describe", "STRING_TYPE", "product_short_describe", "%");
$tfi_listproducts2->addColumn("products.product_short_describe_EN", "STRING_TYPE", "product_short_describe_EN", "%");
$tfi_listproducts2->addColumn("products.product_image_illustrate", "FILE_TYPE", "product_image_illustrate", "%");
$tfi_listproducts2->addColumn("products.product_reference_price", "STRING_TYPE", "product_reference_price", "%");
$tfi_listproducts2->addColumn("rates.id_rates", "STRING_TYPE", "product_rates", "%");
$tfi_listproducts2->addColumn("products.product_unit", "STRING_TYPE", "product_unit", "%");
$tfi_listproducts2->addColumn("products.product_unit_EN", "STRING_TYPE", "product_unit_EN", "%");
$tfi_listproducts2->addColumn("products.product_type", "STRING_TYPE", "product_type", "%");
$tfi_listproducts2->addColumn("products.product_payment_methods_orther", "STRING_TYPE", "product_payment_methods_orther", "%");
$tfi_listproducts2->addColumn("products.product_payment_methods_orther_EN", "STRING_TYPE", "product_payment_methods_orther_EN", "%");
$tfi_listproducts2->addColumn("member.id_member", "NUMERIC_TYPE", "id_member", "=");
$tfi_listproducts2->addColumn("products.product_day_update", "DATE_TYPE", "product_day_update", "=");
$tfi_listproducts2->addColumn("products.product_showroom", "CHECKBOX_1_0_TYPE", "product_showroom", "%");
$tfi_listproducts2->addColumn("products.product_visible", "CHECKBOX_1_0_TYPE", "product_visible", "%");
$tfi_listproducts2->Execute();

// Sorter
$tso_listproducts2 = new TSO_TableSorter("rsproducts1", "tso_listproducts2");
$tso_listproducts2->addColumn("procat.procat_name");
$tso_listproducts2->addColumn("prosubcat1.prosubcat1_name");
$tso_listproducts2->addColumn("prosubcat2.prosubcat2_name");
$tso_listproducts2->addColumn("prosubcat3.prosubcat3_name");
$tso_listproducts2->addColumn("country.country_name");
$tso_listproducts2->addColumn("products.product_name");
$tso_listproducts2->addColumn("products.product_name_EN");
$tso_listproducts2->addColumn("products.product_short_describe");
$tso_listproducts2->addColumn("products.product_short_describe_EN");
$tso_listproducts2->addColumn("products.product_image_illustrate");
$tso_listproducts2->addColumn("products.product_reference_price");
$tso_listproducts2->addColumn("rates.rates_content");
$tso_listproducts2->addColumn("products.product_unit");
$tso_listproducts2->addColumn("products.product_unit_EN");
$tso_listproducts2->addColumn("products.product_type");
$tso_listproducts2->addColumn("products.product_payment_methods_orther");
$tso_listproducts2->addColumn("products.product_payment_methods_orther_EN");
$tso_listproducts2->addColumn("member.member_user");
$tso_listproducts2->addColumn("products.product_day_update");
$tso_listproducts2->addColumn("products.product_showroom");
$tso_listproducts2->addColumn("products.product_visible");
$tso_listproducts2->setDefault("products.product_day_update DESC");
$tso_listproducts2->Execute();

// Navigation
$nav_listproducts2 = new NAV_Regular("nav_listproducts2", "rsproducts1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT procat_name, id_procat FROM procat ORDER BY procat_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset2 = "SELECT prosubcat1_name, id_prosubcat1 FROM prosubcat1 ORDER BY prosubcat1_name";
$Recordset2 = mysql_query($query_Recordset2, $ketnoi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset3 = "SELECT prosubcat2_name, id_prosubcat2 FROM prosubcat2 ORDER BY prosubcat2_name";
$Recordset3 = mysql_query($query_Recordset3, $ketnoi) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset4 = "SELECT prosubcat3_name, id_prosubcat3 FROM prosubcat3 ORDER BY prosubcat3_name";
$Recordset4 = mysql_query($query_Recordset4, $ketnoi) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset5 = "SELECT country_name, id_country FROM country ORDER BY country_name";
$Recordset5 = mysql_query($query_Recordset5, $ketnoi) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset7 = "SELECT rates_content, id_rates FROM rates ORDER BY rates_content";
$Recordset7 = mysql_query($query_Recordset7, $ketnoi) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset6 = "SELECT member_user, id_member FROM member ORDER BY member_user";
$Recordset6 = mysql_query($query_Recordset6, $ketnoi) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

//NeXTenesio3 Special List Recordset
$maxRows_rsproducts1 = $_SESSION['max_rows_nav_listproducts2'];
$pageNum_rsproducts1 = 0;
if (isset($_GET['pageNum_rsproducts1'])) {
  $pageNum_rsproducts1 = $_GET['pageNum_rsproducts1'];
}
$startRow_rsproducts1 = $pageNum_rsproducts1 * $maxRows_rsproducts1;

// Defining List Recordset variable
$NXTFilter_rsproducts1 = "1=1";
if (isset($_SESSION['filter_tfi_listproducts2'])) {
  $NXTFilter_rsproducts1 = $_SESSION['filter_tfi_listproducts2'];
}
// Defining List Recordset variable
$NXTSort_rsproducts1 = "products.product_day_update DESC";
if (isset($_SESSION['sorter_tso_listproducts2'])) {
  $NXTSort_rsproducts1 = $_SESSION['sorter_tso_listproducts2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsproducts1 = "SELECT procat.procat_name AS id_procat, prosubcat1.prosubcat1_name AS id_prosubcat1, prosubcat2.prosubcat2_name AS id_prosubcat2, prosubcat3.prosubcat3_name AS id_prosubcat3, country.country_name AS id_country, products.product_name, products.product_name_EN, products.product_short_describe, products.product_short_describe_EN, products.product_image_illustrate, products.product_reference_price, rates.rates_content AS product_rates, products.product_unit, products.product_unit_EN, products.product_type, products.product_payment_methods_orther, products.product_payment_methods_orther_EN, member.member_user AS id_member, products.product_day_update, products.product_showroom, products.product_visible, products.id_products FROM ((((((products LEFT JOIN procat ON products.id_procat = procat.id_procat) LEFT JOIN prosubcat1 ON products.id_prosubcat1 = prosubcat1.id_prosubcat1) LEFT JOIN prosubcat2 ON products.id_prosubcat2 = prosubcat2.id_prosubcat2) LEFT JOIN prosubcat3 ON products.id_prosubcat3 = prosubcat3.id_prosubcat3) LEFT JOIN country ON products.id_country = country.id_country) LEFT JOIN rates ON products.product_rates = rates.id_rates) LEFT JOIN member ON products.id_member = member.id_member WHERE {$NXTFilter_rsproducts1} ORDER BY {$NXTSort_rsproducts1}";
$query_limit_rsproducts1 = sprintf("%s LIMIT %d, %d", $query_rsproducts1, $startRow_rsproducts1, $maxRows_rsproducts1);
$rsproducts1 = mysql_query($query_limit_rsproducts1, $ketnoi) or die(mysql_error());
$row_rsproducts1 = mysql_fetch_assoc($rsproducts1);

if (isset($_GET['totalRows_rsproducts1'])) {
  $totalRows_rsproducts1 = $_GET['totalRows_rsproducts1'];
} else {
  $all_rsproducts1 = mysql_query($query_rsproducts1);
  $totalRows_rsproducts1 = mysql_num_rows($all_rsproducts1);
}
$totalPages_rsproducts1 = ceil($totalRows_rsproducts1/$maxRows_rsproducts1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listproducts2->checkBoundries();
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
  .KT_col_id_procat {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat1 {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat2 {width:100px; overflow:hidden;}
  .KT_col_id_prosubcat3 {width:100px; overflow:hidden;}
  .KT_col_id_country {width:100px; overflow:hidden;}
  .KT_col_product_name {width:100px; overflow:hidden;}
  .KT_col_product_name_EN {width:100px; overflow:hidden;}
  .KT_col_product_short_describe {width:100px; overflow:hidden;}
  .KT_col_product_short_describe_EN {width:100px; overflow:hidden;}
  .KT_col_product_image_illustrate {width:100px; overflow:hidden;}
  .KT_col_product_reference_price {width:100px; overflow:hidden;}
  .KT_col_product_rates {width:70px; overflow:hidden;}
  .KT_col_product_unit {width:100px; overflow:hidden;}
  .KT_col_product_unit_EN {width:100px; overflow:hidden;}
  .KT_col_product_type {width:70px; overflow:hidden;}
  .KT_col_product_payment_methods_orther {width:100px; overflow:hidden;}
  .KT_col_product_payment_methods_orther_EN {width:100px; overflow:hidden;}
  .KT_col_id_member {width:100px; overflow:hidden;}
  .KT_col_product_day_update {width:100px; overflow:hidden;}
  .KT_col_product_showroom {width:50px; overflow:hidden;}
  .KT_col_product_visible {width:50px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listproducts2">
  <h1> Products
    <?php
  $nav_listproducts2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listproducts2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listproducts2'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listproducts2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listproducts2'] == 1) {
?>
                            <a href="<?php echo $tfi_listproducts2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listproducts2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="id_procat" class="KT_sorter KT_col_id_procat <?php echo $tso_listproducts2->getSortIcon('procat.procat_name'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('procat.procat_name'); ?>">Categories</a> </th>
            <th id="id_prosubcat1" class="KT_sorter KT_col_id_prosubcat1 <?php echo $tso_listproducts2->getSortIcon('prosubcat1.prosubcat1_name'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('prosubcat1.prosubcat1_name'); ?>">Sub Categories1</a> </th>
            <th id="id_prosubcat2" class="KT_sorter KT_col_id_prosubcat2 <?php echo $tso_listproducts2->getSortIcon('prosubcat2.prosubcat2_name'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('prosubcat2.prosubcat2_name'); ?>">Sub Categories2</a> </th>
            <th id="id_prosubcat3" class="KT_sorter KT_col_id_prosubcat3 <?php echo $tso_listproducts2->getSortIcon('prosubcat3.prosubcat3_name'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('prosubcat3.prosubcat3_name'); ?>">Sub Categories3</a> </th>
            <th id="id_country" class="KT_sorter KT_col_id_country <?php echo $tso_listproducts2->getSortIcon('country.country_name'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('country.country_name'); ?>">Country</a> </th>
            <th id="product_name" class="KT_sorter KT_col_product_name <?php echo $tso_listproducts2->getSortIcon('products.product_name'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_name'); ?>">Product name</a> </th>
            <th id="product_name_EN" class="KT_sorter KT_col_product_name_EN <?php echo $tso_listproducts2->getSortIcon('products.product_name_EN'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_name_EN'); ?>">Product name(English)</a> </th>
            <th id="product_short_describe" class="KT_sorter KT_col_product_short_describe <?php echo $tso_listproducts2->getSortIcon('products.product_short_describe'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_short_describe'); ?>">Short describe</a> </th>
            <th id="product_short_describe_EN" class="KT_sorter KT_col_product_short_describe_EN <?php echo $tso_listproducts2->getSortIcon('products.product_short_describe_EN'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_short_describe_EN'); ?>">Short describe(English)</a> </th>
            <th id="product_image_illustrate" class="KT_sorter KT_col_product_image_illustrate <?php echo $tso_listproducts2->getSortIcon('products.product_image_illustrate'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_image_illustrate'); ?>">Image illustrate</a> </th>
            <th id="product_reference_price" class="KT_sorter KT_col_product_reference_price <?php echo $tso_listproducts2->getSortIcon('products.product_reference_price'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_reference_price'); ?>">Reference price</a> </th>
            <th id="product_rates" class="KT_sorter KT_col_product_rates <?php echo $tso_listproducts2->getSortIcon('rates.rates_content'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('rates.rates_content'); ?>">Rates</a> </th>
            <th id="product_unit" class="KT_sorter KT_col_product_unit <?php echo $tso_listproducts2->getSortIcon('products.product_unit'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_unit'); ?>">Unit</a> </th>
            <th id="product_unit_EN" class="KT_sorter KT_col_product_unit_EN <?php echo $tso_listproducts2->getSortIcon('products.product_unit_EN'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_unit_EN'); ?>">Unit(English)</a> </th>
            <th id="product_type" class="KT_sorter KT_col_product_type <?php echo $tso_listproducts2->getSortIcon('products.product_type'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_type'); ?>">Type</a> </th>
            <th id="product_payment_methods_orther" class="KT_sorter KT_col_product_payment_methods_orther <?php echo $tso_listproducts2->getSortIcon('products.product_payment_methods_orther'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_payment_methods_orther'); ?>">Payment methods orther</a> </th>
            <th id="product_payment_methods_orther_EN" class="KT_sorter KT_col_product_payment_methods_orther_EN <?php echo $tso_listproducts2->getSortIcon('products.product_payment_methods_orther_EN'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_payment_methods_orther_EN'); ?>">Payment methods orther(English)</a> </th>
            <th id="id_member" class="KT_sorter KT_col_id_member <?php echo $tso_listproducts2->getSortIcon('member.member_user'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('member.member_user'); ?>">Member</a> </th>
            <th id="product_day_update" class="KT_sorter KT_col_product_day_update <?php echo $tso_listproducts2->getSortIcon('products.product_day_update'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_day_update'); ?>">Day update</a> </th>
            <th id="product_showroom" class="KT_sorter KT_col_product_showroom <?php echo $tso_listproducts2->getSortIcon('products.product_showroom'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_showroom'); ?>">Show room</a> </th>
            <th id="product_visible" class="KT_sorter KT_col_product_visible <?php echo $tso_listproducts2->getSortIcon('products.product_visible'); ?>"> <a href="<?php echo $tso_listproducts2->getSortLink('products.product_visible'); ?>">Visible</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listproducts2'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><select name="tfi_listproducts2_id_procat" id="tfi_listproducts2_id_procat">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_id_procat']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_procat']?>"<?php if (!(strcmp($row_Recordset1['id_procat'], @$_SESSION['tfi_listproducts2_id_procat']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['procat_name']?></option>
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
            <td><select name="tfi_listproducts2_id_prosubcat1" id="tfi_listproducts2_id_prosubcat1">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_id_prosubcat1']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['id_prosubcat1']?>"<?php if (!(strcmp($row_Recordset2['id_prosubcat1'], @$_SESSION['tfi_listproducts2_id_prosubcat1']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['prosubcat1_name']?></option>
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
            <td><select name="tfi_listproducts2_id_prosubcat2" id="tfi_listproducts2_id_prosubcat2">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_id_prosubcat2']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset3['id_prosubcat2']?>"<?php if (!(strcmp($row_Recordset3['id_prosubcat2'], @$_SESSION['tfi_listproducts2_id_prosubcat2']))) {echo "SELECTED";} ?>><?php echo $row_Recordset3['prosubcat2_name']?></option>
              <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
            </select>
            </td>
            <td><select name="tfi_listproducts2_id_prosubcat3" id="tfi_listproducts2_id_prosubcat3">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_id_prosubcat3']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset4['id_prosubcat3']?>"<?php if (!(strcmp($row_Recordset4['id_prosubcat3'], @$_SESSION['tfi_listproducts2_id_prosubcat3']))) {echo "SELECTED";} ?>><?php echo $row_Recordset4['prosubcat3_name']?></option>
              <?php
} while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));
  $rows = mysql_num_rows($Recordset4);
  if($rows > 0) {
      mysql_data_seek($Recordset4, 0);
	  $row_Recordset4 = mysql_fetch_assoc($Recordset4);
  }
?>
            </select>
            </td>
            <td><select name="tfi_listproducts2_id_country" id="tfi_listproducts2_id_country">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_id_country']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset5['id_country']?>"<?php if (!(strcmp($row_Recordset5['id_country'], @$_SESSION['tfi_listproducts2_id_country']))) {echo "SELECTED";} ?>><?php echo $row_Recordset5['country_name']?></option>
              <?php
} while ($row_Recordset5 = mysql_fetch_assoc($Recordset5));
  $rows = mysql_num_rows($Recordset5);
  if($rows > 0) {
      mysql_data_seek($Recordset5, 0);
	  $row_Recordset5 = mysql_fetch_assoc($Recordset5);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listproducts2_product_name" id="tfi_listproducts2_product_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_name']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listproducts2_product_name_EN" id="tfi_listproducts2_product_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_name_EN']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listproducts2_product_short_describe" id="tfi_listproducts2_product_short_describe" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_short_describe']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listproducts2_product_short_describe_EN" id="tfi_listproducts2_product_short_describe_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_short_describe_EN']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listproducts2_product_image_illustrate" id="tfi_listproducts2_product_image_illustrate" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_image_illustrate']); ?>" size="20" maxlength="30" /></td>
            <td><input type="text" name="tfi_listproducts2_product_reference_price" id="tfi_listproducts2_product_reference_price" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_reference_price']); ?>" size="20" maxlength="20" /></td>
            <td><select name="tfi_listproducts2_product_rates" id="tfi_listproducts2_product_rates">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_product_rates']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset7['id_rates']?>"<?php if (!(strcmp($row_Recordset7['id_rates'], @$_SESSION['tfi_listproducts2_product_rates']))) {echo "SELECTED";} ?>><?php echo $row_Recordset7['rates_content']?></option>
              <?php
} while ($row_Recordset7 = mysql_fetch_assoc($Recordset7));
  $rows = mysql_num_rows($Recordset7);
  if($rows > 0) {
      mysql_data_seek($Recordset7, 0);
	  $row_Recordset7 = mysql_fetch_assoc($Recordset7);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listproducts2_product_unit" id="tfi_listproducts2_product_unit" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_unit']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listproducts2_product_unit_EN" id="tfi_listproducts2_product_unit_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_unit_EN']); ?>" size="20" maxlength="50" /></td>
            <td><select name="tfi_listproducts2_product_type" id="tfi_listproducts2_product_type">
              <option value="" >--chọn--</option>
              <option value="product" <?php if (!(strcmp("product", KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_type'])))) {echo "SELECTED";} ?>>Product</option>
              <option value="sell" <?php if (!(strcmp("sell", KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_type'])))) {echo "SELECTED";} ?>>Sell</option>
              <option value="buy" <?php if (!(strcmp("buy", KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_type'])))) {echo "SELECTED";} ?>>Buy</option>
            </select>
            </td>
            <td><input type="text" name="tfi_listproducts2_product_payment_methods_orther" id="tfi_listproducts2_product_payment_methods_orther" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_payment_methods_orther']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listproducts2_product_payment_methods_orther_EN" id="tfi_listproducts2_product_payment_methods_orther_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_payment_methods_orther_EN']); ?>" size="20" maxlength="255" /></td>
            <td><select name="tfi_listproducts2_id_member" id="tfi_listproducts2_id_member">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproducts2_id_member']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset6['id_member']?>"<?php if (!(strcmp($row_Recordset6['id_member'], @$_SESSION['tfi_listproducts2_id_member']))) {echo "SELECTED";} ?>><?php echo $row_Recordset6['member_user']?></option>
              <?php
} while ($row_Recordset6 = mysql_fetch_assoc($Recordset6));
  $rows = mysql_num_rows($Recordset6);
  if($rows > 0) {
      mysql_data_seek($Recordset6, 0);
	  $row_Recordset6 = mysql_fetch_assoc($Recordset6);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listproducts2_product_day_update" id="tfi_listproducts2_product_day_update" value="<?php echo @$_SESSION['tfi_listproducts2_product_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_showroom']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listproducts2_product_showroom" id="tfi_listproducts2_product_showroom" value="1" /></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listproducts2_product_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listproducts2_product_visible" id="tfi_listproducts2_product_visible" value="1" /></td>
            <td><input type="submit" name="tfi_listproducts2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsproducts1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="23"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsproducts1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_products" class="id_checkbox" value="<?php echo $row_rsproducts1['id_products']; ?>" />
                <input type="hidden" name="id_products" class="id_field" value="<?php echo $row_rsproducts1['id_products']; ?>" />
            </td>
            <td><div class="KT_col_id_procat"><?php echo KT_FormatForList($row_rsproducts1['id_procat'], 20); ?></div></td>
            <td><div class="KT_col_id_prosubcat1"><?php echo KT_FormatForList($row_rsproducts1['id_prosubcat1'], 20); ?></div></td>
            <td><div class="KT_col_id_prosubcat2"><?php echo KT_FormatForList($row_rsproducts1['id_prosubcat2'], 20); ?></div></td>
            <td><div class="KT_col_id_prosubcat3"><?php echo KT_FormatForList($row_rsproducts1['id_prosubcat3'], 20); ?></div></td>
            <td><div class="KT_col_id_country"><?php echo KT_FormatForList($row_rsproducts1['id_country'], 20); ?></div></td>
            <td><div class="KT_col_product_name"><?php echo KT_FormatForList($row_rsproducts1['product_name'], 20); ?></div></td>
            <td><div class="KT_col_product_name_EN"><?php echo KT_FormatForList($row_rsproducts1['product_name_EN'], 20); ?></div></td>
            <td><div class="KT_col_product_short_describe"><?php echo KT_FormatForList($row_rsproducts1['product_short_describe'], 20); ?></div></td>
            <td><div class="KT_col_product_short_describe_EN"><?php echo KT_FormatForList($row_rsproducts1['product_short_describe_EN'], 20); ?></div></td>
            <td>&nbsp;</td>
            <td><div class="KT_col_product_reference_price"><?php echo KT_FormatForList($row_rsproducts1['product_reference_price'], 20); ?></div></td>
            <td><div class="KT_col_product_rates"><?php echo KT_FormatForList($row_rsproducts1['product_rates'], 10); ?></div></td>
            <td><div class="KT_col_product_unit"><?php echo KT_FormatForList($row_rsproducts1['product_unit'], 20); ?></div></td>
            <td><div class="KT_col_product_unit_EN"><?php echo KT_FormatForList($row_rsproducts1['product_unit_EN'], 20); ?></div></td>
            <td><div class="KT_col_product_type"><?php echo KT_FormatForList($row_rsproducts1['product_type'], 10); ?></div></td>
            <td><div class="KT_col_product_payment_methods_orther"><?php echo KT_FormatForList($row_rsproducts1['product_payment_methods_orther'], 20); ?></div></td>
            <td><div class="KT_col_product_payment_methods_orther_EN"><?php echo KT_FormatForList($row_rsproducts1['product_payment_methods_orther_EN'], 20); ?></div></td>
            <td><div class="KT_col_id_member"><?php echo KT_FormatForList($row_rsproducts1['id_member'], 20); ?></div></td>
            <td><div class="KT_col_product_day_update"><?php echo KT_formatDate($row_rsproducts1['product_day_update']); ?></div></td>
            <td><div class="KT_col_product_showroom"><?php echo KT_FormatForList($row_rsproducts1['product_showroom'], 20); ?></div></td>
            <td><div class="KT_col_product_visible"><?php echo KT_FormatForList($row_rsproducts1['product_visible'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_products&amp;id_products=<?php echo $row_rsproducts1['id_products']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a><a class="KT_link" href="index.php?mod=list_images_library&amp;NxT_id_products=<?php echo $row_rsproducts1['id_products']; ?>&amp;KT_back=1">details</a> </td>
          </tr>
          <?php } while ($row_rsproducts1 = mysql_fetch_assoc($rsproducts1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listproducts2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_products&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset7);

mysql_free_result($Recordset6);

mysql_free_result($rsproducts1);
?>
