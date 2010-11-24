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
$tfi_listcompany2 = new TFI_TableFilter($conn_ketnoi, "tfi_listcompany2");
$tfi_listcompany2->addColumn("company.id_company", "NUMERIC_TYPE", "id_company", "=");
$tfi_listcompany2->addColumn("company.company_name", "STRING_TYPE", "company_name", "%");
$tfi_listcompany2->addColumn("company.company_name_EN", "STRING_TYPE", "company_name_EN", "%");
$tfi_listcompany2->addColumn("country.id_country", "NUMERIC_TYPE", "company_id_country", "=");
$tfi_listcompany2->addColumn("company.company_postcode", "NUMERIC_TYPE", "company_postcode", "=");
$tfi_listcompany2->addColumn("company.company_logo", "FILE_TYPE", "company_logo", "%");
$tfi_listcompany2->addColumn("company.company_address", "STRING_TYPE", "company_address", "%");
$tfi_listcompany2->addColumn("company.company_address_EN", "STRING_TYPE", "company_address_EN", "%");
$tfi_listcompany2->addColumn("company.company_tell", "STRING_TYPE", "company_tell", "%");
$tfi_listcompany2->addColumn("company.company_mobile", "STRING_TYPE", "company_mobile", "%");
$tfi_listcompany2->addColumn("company.company_email", "STRING_TYPE", "company_email", "%");
$tfi_listcompany2->addColumn("company.company_fax", "STRING_TYPE", "company_fax", "%");
$tfi_listcompany2->addColumn("company.company_website", "STRING_TYPE", "company_website", "%");
$tfi_listcompany2->addColumn("industry.id_industry", "NUMERIC_TYPE", "company_id_industry", "=");
$tfi_listcompany2->addColumn("company.company_name_represent", "STRING_TYPE", "company_name_represent", "%");
$tfi_listcompany2->addColumn("company.company_mansex_represent", "NUMERIC_TYPE", "company_mansex_represent", "=");
$tfi_listcompany2->addColumn("company.company_manstatus_represent", "STRING_TYPE", "company_manstatus_represent", "%");
$tfi_listcompany2->addColumn("company.company_manstatus_represent_EN", "STRING_TYPE", "company_manstatus_represent_EN", "%");
$tfi_listcompany2->addColumn("company.company_number_employees", "STRING_TYPE", "company_number_employees", "%");
$tfi_listcompany2->addColumn("company.company_number_employees_EN", "STRING_TYPE", "company_number_employees_EN", "%");
$tfi_listcompany2->addColumn("company.company_year_foundation", "STRING_TYPE", "company_year_foundation", "%");
$tfi_listcompany2->addColumn("capital_revenue.id_capital_revenue", "STRING_TYPE", "company_authorized_capital", "%");
$tfi_listcompany2->addColumn("capital_revenue1.id_capital_revenue", "STRING_TYPE", "company_yearly_revenue", "%");
$tfi_listcompany2->addColumn("import_export.id_import_export", "STRING_TYPE", "company_export_rates", "%");
$tfi_listcompany2->addColumn("import_export1.id_import_export", "STRING_TYPE", "company_import_ratio", "%");
$tfi_listcompany2->addColumn("company.company_main_product", "STRING_TYPE", "company_main_product", "%");
$tfi_listcompany2->addColumn("company.company_main_product_EN", "STRING_TYPE", "company_main_product_EN", "%");
$tfi_listcompany2->addColumn("company.company_main_markets_orther", "STRING_TYPE", "company_main_markets_orther", "%");
$tfi_listcompany2->addColumn("company.company_shortinfo", "STRING_TYPE", "company_shortinfo", "%");
$tfi_listcompany2->addColumn("company.company_shortinfo_EN", "STRING_TYPE", "company_shortinfo_EN", "%");
$tfi_listcompany2->addColumn("company.company_info", "STRING_TYPE", "company_info", "%");
$tfi_listcompany2->addColumn("company.company_info_EN", "STRING_TYPE", "company_info_EN", "%");
$tfi_listcompany2->addColumn("company.company_day_update", "DATE_TYPE", "company_day_update", "=");
$tfi_listcompany2->addColumn("company.company_visible", "CHECKBOX_1_0_TYPE", "company_visible", "%");
$tfi_listcompany2->Execute();

// Sorter
$tso_listcompany2 = new TSO_TableSorter("rscompany1", "tso_listcompany2");
$tso_listcompany2->addColumn("company.id_company");
$tso_listcompany2->addColumn("company.company_name");
$tso_listcompany2->addColumn("company.company_name_EN");
$tso_listcompany2->addColumn("country.country_name");
$tso_listcompany2->addColumn("company.company_postcode");
$tso_listcompany2->addColumn("company.company_logo");
$tso_listcompany2->addColumn("company.company_address");
$tso_listcompany2->addColumn("company.company_address_EN");
$tso_listcompany2->addColumn("company.company_tell");
$tso_listcompany2->addColumn("company.company_mobile");
$tso_listcompany2->addColumn("company.company_email");
$tso_listcompany2->addColumn("company.company_fax");
$tso_listcompany2->addColumn("company.company_website");
$tso_listcompany2->addColumn("industry.industry_name");
$tso_listcompany2->addColumn("company.company_name_represent");
$tso_listcompany2->addColumn("company.company_mansex_represent");
$tso_listcompany2->addColumn("company.company_manstatus_represent");
$tso_listcompany2->addColumn("company.company_manstatus_represent_EN");
$tso_listcompany2->addColumn("company.company_number_employees");
$tso_listcompany2->addColumn("company.company_number_employees_EN");
$tso_listcompany2->addColumn("company.company_year_foundation");
$tso_listcompany2->addColumn("capital_revenue.cr_content");
$tso_listcompany2->addColumn("capital_revenue1.cr_content");
$tso_listcompany2->addColumn("import_export.content");
$tso_listcompany2->addColumn("import_export1.content");
$tso_listcompany2->addColumn("company.company_main_product");
$tso_listcompany2->addColumn("company.company_main_product_EN");
$tso_listcompany2->addColumn("company.company_main_markets_orther");
$tso_listcompany2->addColumn("company.company_shortinfo");
$tso_listcompany2->addColumn("company.company_shortinfo_EN");
$tso_listcompany2->addColumn("company.company_info");
$tso_listcompany2->addColumn("company.company_info_EN");
$tso_listcompany2->addColumn("company.company_day_update");
$tso_listcompany2->addColumn("company.company_visible");
$tso_listcompany2->setDefault("company.id_company");
$tso_listcompany2->Execute();

// Navigation
$nav_listcompany2 = new NAV_Regular("nav_listcompany2", "rscompany1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT cr_content, id_capital_revenue FROM capital_revenue ORDER BY cr_content";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset2 = "SELECT cr_content, id_capital_revenue FROM capital_revenue ORDER BY cr_content";
$Recordset2 = mysql_query($query_Recordset2, $ketnoi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset3 = "SELECT content, id_import_export FROM import_export ORDER BY content";
$Recordset3 = mysql_query($query_Recordset3, $ketnoi) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset4 = "SELECT content, id_import_export FROM import_export ORDER BY content";
$Recordset4 = mysql_query($query_Recordset4, $ketnoi) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name, country_name_EN FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_industry = "SELECT id_industry, industry_name, industry_name_EN FROM industry ORDER BY sort ASC";
$rs_industry = mysql_query($query_rs_industry, $ketnoi) or die(mysql_error());
$row_rs_industry = mysql_fetch_assoc($rs_industry);
$totalRows_rs_industry = mysql_num_rows($rs_industry);

//NeXTenesio3 Special List Recordset
$maxRows_rscompany1 = $_SESSION['max_rows_nav_listcompany2'];
$pageNum_rscompany1 = 0;
if (isset($_GET['pageNum_rscompany1'])) {
  $pageNum_rscompany1 = $_GET['pageNum_rscompany1'];
}
$startRow_rscompany1 = $pageNum_rscompany1 * $maxRows_rscompany1;

// Defining List Recordset variable
$NXTFilter_rscompany1 = "1=1";
if (isset($_SESSION['filter_tfi_listcompany2'])) {
  $NXTFilter_rscompany1 = $_SESSION['filter_tfi_listcompany2'];
}
// Defining List Recordset variable
$NXTSort_rscompany1 = "company.id_company";
if (isset($_SESSION['sorter_tso_listcompany2'])) {
  $NXTSort_rscompany1 = $_SESSION['sorter_tso_listcompany2'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rscompany1 = "SELECT company.id_company, company.company_name, company.company_name_EN, country.country_name AS company_id_country, company.company_postcode, company.company_logo, company.company_address, company.company_address_EN, company.company_tell, company.company_mobile, company.company_email, company.company_fax, company.company_website, industry.industry_name AS company_id_industry, company.company_name_represent, company.company_mansex_represent, company.company_manstatus_represent, company.company_manstatus_represent_EN, company.company_number_employees, company.company_number_employees_EN, company.company_year_foundation, capital_revenue.cr_content AS company_authorized_capital, capital_revenue1.cr_content AS company_yearly_revenue, import_export.content AS company_export_rates, import_export1.content AS company_import_ratio, company.company_main_product, company.company_main_product_EN, company.company_main_markets_orther, company.company_shortinfo, company.company_shortinfo_EN, company.company_info, company.company_info_EN, company.company_day_update, company.company_visible FROM (((((company LEFT JOIN country ON company.company_id_country = country.id_country) LEFT JOIN industry ON company.company_id_industry = industry.id_industry) LEFT JOIN capital_revenue ON company.company_authorized_capital = capital_revenue.id_capital_revenue) LEFT JOIN capital_revenue AS capital_revenue1 ON company.company_yearly_revenue = capital_revenue1.id_capital_revenue) LEFT JOIN import_export ON company.company_export_rates = import_export.id_import_export) LEFT JOIN import_export AS import_export1 ON company.company_import_ratio = import_export1.id_import_export WHERE {$NXTFilter_rscompany1} ORDER BY {$NXTSort_rscompany1}";
$query_limit_rscompany1 = sprintf("%s LIMIT %d, %d", $query_rscompany1, $startRow_rscompany1, $maxRows_rscompany1);
$rscompany1 = mysql_query($query_limit_rscompany1, $ketnoi) or die(mysql_error());
$row_rscompany1 = mysql_fetch_assoc($rscompany1);

if (isset($_GET['totalRows_rscompany1'])) {
  $totalRows_rscompany1 = $_GET['totalRows_rscompany1'];
} else {
  $all_rscompany1 = mysql_query($query_rscompany1);
  $totalRows_rscompany1 = mysql_num_rows($all_rscompany1);
}
$totalPages_rscompany1 = ceil($totalRows_rscompany1/$maxRows_rscompany1)-1;
//End NeXTenesio3 Special List Recordset
$company = $row_rscompany1['id_company'];
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_business_form_company = "SELECT business_form_company.id_business_form_company,company.id_company,business_form.bf_name,business_form.bf_name_EN FROM ((business_form_company LEFT JOIN company ON business_form_company.id_company=$company)LEFT JOIN business_form ON business_form_company.id_business_form = business_form.id_business_form)";
$rs_business_form_company = mysql_query($query_rs_business_form_company, $ketnoi) or die(mysql_error());
$row_rs_business_form_company = mysql_fetch_assoc($rs_business_form_company);
$totalRows_rs_business_form_company = mysql_num_rows($rs_business_form_company);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_main_markets_company = "SELECT main_markets.main_market_name, main_markets.main_market_name_EN FROM ((main_markets_company LEFT JOIN company ON main_markets_company.id_company = $company)LEFT JOIN main_markets ON main_markets_company.id_main_markets=main_markets.id_main_markets)";
$rs_main_markets_company = mysql_query($query_rs_main_markets_company, $ketnoi) or die(mysql_error());
$row_rs_main_markets_company = mysql_fetch_assoc($rs_main_markets_company);
$totalRows_rs_main_markets_company = mysql_num_rows($rs_main_markets_company);

$nav_listcompany2->checkBoundries();
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
  .KT_col_id_company {width:140px; overflow:hidden;}
  .KT_col_company_name {width:140px; overflow:hidden;}
  .KT_col_company_name_EN {width:140px; overflow:hidden;}
  .KT_col_company_id_country {width:140px; overflow:hidden;}
  .KT_col_company_postcode {width:140px; overflow:hidden;}
  .KT_col_company_logo {width:140px; overflow:hidden;}
  .KT_col_company_address {width:140px; overflow:hidden;}
  .KT_col_company_address_EN {width:140px; overflow:hidden;}
  .KT_col_company_tell {width:140px; overflow:hidden;}
  .KT_col_company_mobile {width:140px; overflow:hidden;}
  .KT_col_company_email {width:140px; overflow:hidden;}
  .KT_col_company_fax {width:140px; overflow:hidden;}
  .KT_col_company_website {width:140px; overflow:hidden;}
  .KT_col_company_id_industry {width:140px; overflow:hidden;}
  .KT_col_company_name_represent {width:140px; overflow:hidden;}
  .KT_col_company_mansex_represent {width:140px; overflow:hidden;}
  .KT_col_company_manstatus_represent {width:140px; overflow:hidden;}
  .KT_col_company_manstatus_represent_EN {width:140px; overflow:hidden;}
  .KT_col_company_number_employees {width:140px; overflow:hidden;}
  .KT_col_company_number_employees_EN {width:140px; overflow:hidden;}
  .KT_col_company_year_foundation {width:140px; overflow:hidden;}
  .KT_col_company_authorized_capital {width:140px; overflow:hidden;}
  .KT_col_company_yearly_revenue {width:140px; overflow:hidden;}
  .KT_col_company_export_rates {width:140px; overflow:hidden;}
  .KT_col_company_import_ratio {width:140px; overflow:hidden;}
  .KT_col_company_main_product {width:140px; overflow:hidden;}
  .KT_col_company_main_product_EN {width:140px; overflow:hidden;}
  .KT_col_company_main_markets_orther {width:140px; overflow:hidden;}
  .KT_col_company_shortinfo {width:140px; overflow:hidden;}
  .KT_col_company_shortinfo_EN {width:140px; overflow:hidden;}
  .KT_col_company_info {width:140px; overflow:hidden;}
  .KT_col_company_info_EN {width:140px; overflow:hidden;}
  .KT_col_company_day_update {width:140px; overflow:hidden;}
  .KT_col_company_visible {width:140px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listcompany2">
  <h1> Company
    <?php
  $nav_listcompany2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listcompany2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcompany2'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listcompany2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcompany2'] == 1) {
?>
                            <a href="<?php echo $tfi_listcompany2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listcompany2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="id_company" class="KT_sorter KT_col_id_company <?php echo $tso_listcompany2->getSortIcon('company.id_company'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.id_company'); ?>">Company</a> </th>
            <th id="company_name" class="KT_sorter KT_col_company_name <?php echo $tso_listcompany2->getSortIcon('company.company_name'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_name'); ?>">Company name</a> </th>
            <th id="company_name_EN" class="KT_sorter KT_col_company_name_EN <?php echo $tso_listcompany2->getSortIcon('company.company_name_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_name_EN'); ?>">company name(English)</a> </th>
            <th id="company_id_country" class="KT_sorter KT_col_company_id_country <?php echo $tso_listcompany2->getSortIcon('country.country_name'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('country.country_name'); ?>">Country</a> </th>
            <th id="company_postcode" class="KT_sorter KT_col_company_postcode <?php echo $tso_listcompany2->getSortIcon('company.company_postcode'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_postcode'); ?>">Postcode</a> </th>
            <th id="company_logo" class="KT_sorter KT_col_company_logo <?php echo $tso_listcompany2->getSortIcon('company.company_logo'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_logo'); ?>">Logo</a> </th>
            <th id="company_address" class="KT_sorter KT_col_company_address <?php echo $tso_listcompany2->getSortIcon('company.company_address'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_address'); ?>">Address</a> </th>
            <th id="company_address_EN" class="KT_sorter KT_col_company_address_EN <?php echo $tso_listcompany2->getSortIcon('company.company_address_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_address_EN'); ?>">Address(English)</a> </th>
            <th id="company_tell" class="KT_sorter KT_col_company_tell <?php echo $tso_listcompany2->getSortIcon('company.company_tell'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_tell'); ?>">Tell</a> </th>
            <th id="company_mobile" class="KT_sorter KT_col_company_mobile <?php echo $tso_listcompany2->getSortIcon('company.company_mobile'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_mobile'); ?>">Company_mobile</a> </th>
            <th id="company_email" class="KT_sorter KT_col_company_email <?php echo $tso_listcompany2->getSortIcon('company.company_email'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_email'); ?>">Email</a> </th>
            <th id="company_fax" class="KT_sorter KT_col_company_fax <?php echo $tso_listcompany2->getSortIcon('company.company_fax'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_fax'); ?>">Fax</a> </th>
            <th id="company_website" class="KT_sorter KT_col_company_website <?php echo $tso_listcompany2->getSortIcon('company.company_website'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_website'); ?>">Website</a> </th>
             <th id="company_website">Business form </th>
            <th id="company_id_industry" class="KT_sorter KT_col_company_id_industry <?php echo $tso_listcompany2->getSortIcon('industry.industry_name'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('industry.industry_name'); ?>">Categories industry</a> </th>
            <th id="company_name_represent" class="KT_sorter KT_col_company_name_represent <?php echo $tso_listcompany2->getSortIcon('company.company_name_represent'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_name_represent'); ?>">Represent name</a> </th>
            <th id="company_mansex_represent" class="KT_sorter KT_col_company_mansex_represent <?php echo $tso_listcompany2->getSortIcon('company.company_mansex_represent'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_mansex_represent'); ?>">Mansex represent</a> </th>
            <th id="company_manstatus_represent" class="KT_sorter KT_col_company_manstatus_represent <?php echo $tso_listcompany2->getSortIcon('company.company_manstatus_represent'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_manstatus_represent'); ?>">Manstatus represent</a> </th>
            <th id="company_manstatus_represent_EN" class="KT_sorter KT_col_company_manstatus_represent_EN <?php echo $tso_listcompany2->getSortIcon('company.company_manstatus_represent_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_manstatus_represent_EN'); ?>">Manstatus represent(English)</a> </th>
            <th id="company_number_employees" class="KT_sorter KT_col_company_number_employees <?php echo $tso_listcompany2->getSortIcon('company.company_number_employees'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_number_employees'); ?>">Employees</a> </th>
            <th id="company_number_employees_EN" class="KT_sorter KT_col_company_number_employees_EN <?php echo $tso_listcompany2->getSortIcon('company.company_number_employees_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_number_employees_EN'); ?>">Employees(English)</a> </th>
            <th id="company_year_foundation" class="KT_sorter KT_col_company_year_foundation <?php echo $tso_listcompany2->getSortIcon('company.company_year_foundation'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_year_foundation'); ?>">Year foundation</a> </th>
            <th id="company_authorized_capital" class="KT_sorter KT_col_company_authorized_capital <?php echo $tso_listcompany2->getSortIcon('capital_revenue.cr_content'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('capital_revenue.cr_content'); ?>">Authorized capital</a> </th>
            <th id="company_yearly_revenue" class="KT_sorter KT_col_company_yearly_revenue <?php echo $tso_listcompany2->getSortIcon('capital_revenue1.cr_content'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('capital_revenue1.cr_content'); ?>">Yearly revenue</a> </th>
            <th id="company_export_rates" class="KT_sorter KT_col_company_export_rates <?php echo $tso_listcompany2->getSortIcon('import_export.content'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('import_export.content'); ?>">Export rates</a> </th>
            <th id="company_import_ratio" class="KT_sorter KT_col_company_import_ratio <?php echo $tso_listcompany2->getSortIcon('import_export1.content'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('import_export1.content'); ?>">Import ratio</a> </th>
            <th id="company_main_product" class="KT_sorter KT_col_company_main_product <?php echo $tso_listcompany2->getSortIcon('company.company_main_product'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_main_product'); ?>">Main product</a> </th>
            <th id="company_main_product_EN" class="KT_sorter KT_col_company_main_product_EN <?php echo $tso_listcompany2->getSortIcon('company.company_main_product_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_main_product_EN'); ?>">Main product(English)</a> </th>
            <th id="company_main_markets_orther" class="KT_sorter KT_col_company_main_markets_orther <?php echo $tso_listcompany2->getSortIcon('company.company_main_markets_orther'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_main_markets_orther'); ?>">Main markets</a> </th>
            <th id="company_shortinfo" class="KT_sorter KT_col_company_shortinfo <?php echo $tso_listcompany2->getSortIcon('company.company_shortinfo'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_shortinfo'); ?>">Short introduce</a> </th>
            <th id="company_shortinfo_EN" class="KT_sorter KT_col_company_shortinfo_EN <?php echo $tso_listcompany2->getSortIcon('company.company_shortinfo_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_shortinfo_EN'); ?>">Short introduce(English)</a> </th>
            <th id="company_info" class="KT_sorter KT_col_company_info <?php echo $tso_listcompany2->getSortIcon('company.company_info'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_info'); ?>">Introduce</a> </th>
            <th id="company_info_EN" class="KT_sorter KT_col_company_info_EN <?php echo $tso_listcompany2->getSortIcon('company.company_info_EN'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_info_EN'); ?>">Introduce(English)</a> </th>
            <th id="company_day_update" class="KT_sorter KT_col_company_day_update <?php echo $tso_listcompany2->getSortIcon('company.company_day_update'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_day_update'); ?>">Day update</a> </th>
            <th id="company_visible" class="KT_sorter KT_col_company_visible <?php echo $tso_listcompany2->getSortIcon('company.company_visible'); ?>"> <a href="<?php echo $tso_listcompany2->getSortLink('company.company_visible'); ?>">Company_visible</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcompany2'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listcompany2_id_company" id="tfi_listcompany2_id_company" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_id_company']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany2_company_name" id="tfi_listcompany2_company_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_name']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listcompany2_company_name_EN" id="tfi_listcompany2_company_name_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_name_EN']); ?>" size="20" maxlength="200" /></td>
            <td><select name="tfi_listcompany2_company_id_country" id="tfi_listcompany2_company_id_country">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany2_company_id_country']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], @$_SESSION['tfi_listcompany2_company_id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name']?></option>
              <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listcompany2_company_postcode" id="tfi_listcompany2_company_postcode" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_postcode']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany2_company_logo" id="tfi_listcompany2_company_logo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_logo']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcompany2_company_address" id="tfi_listcompany2_company_address" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_address']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listcompany2_company_address_EN" id="tfi_listcompany2_company_address_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_address_EN']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listcompany2_company_tell" id="tfi_listcompany2_company_tell" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_tell']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcompany2_company_mobile" id="tfi_listcompany2_company_mobile" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_mobile']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcompany2_company_email" id="tfi_listcompany2_company_email" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_email']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcompany2_company_fax" id="tfi_listcompany2_company_fax" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_fax']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcompany2_company_website" id="tfi_listcompany2_company_website" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_website']); ?>" size="20" maxlength="60" /></td>
            <td>&nbsp;</td>
            <td><select name="tfi_listcompany2_company_id_industry" id="tfi_listcompany2_company_id_industry">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany2_company_id_industry']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_industry['id_industry']?>"<?php if (!(strcmp($row_rs_industry['id_industry'], @$_SESSION['tfi_listcompany2_company_id_industry']))) {echo "SELECTED";} ?>><?php echo $row_rs_industry['industry_name']?></option>
              <?php
} while ($row_rs_industry = mysql_fetch_assoc($rs_industry));
  $rows = mysql_num_rows($rs_industry);
  if($rows > 0) {
      mysql_data_seek($rs_industry, 0);
	  $row_rs_industry = mysql_fetch_assoc($rs_industry);
  }
?>
            </select>
            </td>
            <td><input type="text" name="tfi_listcompany2_company_name_represent" id="tfi_listcompany2_company_name_represent" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_name_represent']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listcompany2_company_mansex_represent" id="tfi_listcompany2_company_mansex_represent">
              <option value="Mr" <?php if (!(strcmp("Mr", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_mansex_represent'])))) {echo "SELECTED";} ?>>Mr</option>
              <option value="Mrs/Miss" <?php if (!(strcmp("Mrs/Miss", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_mansex_represent'])))) {echo "SELECTED";} ?>>Mrs/Miss</option>
              <option value="Orther" <?php if (!(strcmp("Orther", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_mansex_represent'])))) {echo "SELECTED";} ?>>Orther</option>
            </select>
            </td>
            <td><select name="tfi_listcompany2_company_manstatus_represent" id="tfi_listcompany2_company_manstatus_represent">
              <option value="" >-- chọn --</option>
              <option value="Ch&#7911; t&#7883;ch H&#272;QT" <?php if (!(strcmp("Chủ tịch HĐQT", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent'])))) {echo "SELECTED";} ?>>Chủ tịch HĐQT</option>
              <option value="T&#7893;ng Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Tổng Giám đốc", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent'])))) {echo "SELECTED";} ?>>Tổng Giám đốc</option>
              <option value="Ph&oacute; t&#7893;ng Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Phó tổng Giám đốc", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent'])))) {echo "SELECTED";} ?>>Phó tổng Giám đốc</option>
              <option value="Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Giám đốc", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent'])))) {echo "SELECTED";} ?>>Giám đốc</option>
              <option value="Ph&oacute; Gi&aacute;m &#273;&#7889;c" <?php if (!(strcmp("Phó Giám đốc", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent'])))) {echo "SELECTED";} ?>>Phó Giám đốc</option>
              <option value="Gi&aacute;m &#273;&#7889;c &#273;i&#7873;u h&agrave;nh" <?php if (!(strcmp("Giám đốc điều hành", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent'])))) {echo "SELECTED";} ?>>Giám đốc điều hành</option>
            </select>
            </td>
            <td><select name="tfi_listcompany2_company_manstatus_represent_EN" id="tfi_listcompany2_company_manstatus_represent_EN">
              <option value="" >--select--</option>
              <option value="Chairman/President" <?php if (!(strcmp("Chairman/President", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent_EN'])))) {echo "SELECTED";} ?>>Chairman/President</option>
              <option value="General Director" <?php if (!(strcmp("General Director", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_manstatus_represent_EN'])))) {echo "SELECTED";} ?>>General Director</option>
            </select>
            </td>
            <td><select name="tfi_listcompany2_company_number_employees" id="tfi_listcompany2_company_number_employees">
              <option value="" >--chọn--</option>
              <option value="D&#432;&#7899;i 50 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Dưới 50 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>Dưới 50 nhân viên</option>
              <option value="50 - 100 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("50 - 100 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>50 - 100 nhân viên</option>
              <option value="100 - 500 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("100 - 500 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>100 - 500 nhân viên</option>
              <option value="500 - 1000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("500 - 1000 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>500 - 1000 nhân viên</option>
              <option value="1000 - 2000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("1000 - 2000 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>1000 - 2000 nhân viên</option>
              <option value="2000 - 3000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("2000 - 3000 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>2000 - 3000 nhân viên</option>
              <option value="3000 - 4000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("3000 - 4000 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>3000 - 4000 nhân viên</option>
              <option value="4000 -5000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("4000 -5000 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>4000 -5000 nhân viên</option>
              <option value="Tr&ecirc;n 5000 nh&acirc;n vi&ecirc;n" <?php if (!(strcmp("Trên 5000 nhân viên", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees'])))) {echo "SELECTED";} ?>>Trên 5000 nhân viên</option>
            </select>
            </td>
            <td><select name="tfi_listcompany2_company_number_employees_EN" id="tfi_listcompany2_company_number_employees_EN">
              <option value="" >--select--</option>
              <option value="Under 50 member" <?php if (!(strcmp("Under 50 member", KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_number_employees_EN'])))) {echo "SELECTED";} ?>>Under 50 member</option>
              <option value="" ></option>
            </select>
            </td>
            <td><select name="tfi_listcompany2_company_year_foundation" id="tfi_listcompany2_company_year_foundation">
              <option value="" >--chọn--</option>
              <option value="1990" <?php if (!(strcmp(1990, KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_year_foundation'])))) {echo "SELECTED";} ?>>1990</option>
            </select>
            </td>
            <td><select name="tfi_listcompany2_company_authorized_capital" id="tfi_listcompany2_company_authorized_capital">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany2_company_authorized_capital']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_capital_revenue']?>"<?php if (!(strcmp($row_Recordset1['id_capital_revenue'], @$_SESSION['tfi_listcompany2_company_authorized_capital']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['cr_content']?></option>
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
            <td><select name="tfi_listcompany2_company_yearly_revenue" id="tfi_listcompany2_company_yearly_revenue">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany2_company_yearly_revenue']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['id_capital_revenue']?>"<?php if (!(strcmp($row_Recordset2['id_capital_revenue'], @$_SESSION['tfi_listcompany2_company_yearly_revenue']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['cr_content']?></option>
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
            <td><select name="tfi_listcompany2_company_export_rates" id="tfi_listcompany2_company_export_rates">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany2_company_export_rates']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset3['id_import_export']?>"<?php if (!(strcmp($row_Recordset3['id_import_export'], @$_SESSION['tfi_listcompany2_company_export_rates']))) {echo "SELECTED";} ?>><?php echo $row_Recordset3['content']?></option>
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
            <td><select name="tfi_listcompany2_company_import_ratio" id="tfi_listcompany2_company_import_ratio">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany2_company_import_ratio']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset4['id_import_export']?>"<?php if (!(strcmp($row_Recordset4['id_import_export'], @$_SESSION['tfi_listcompany2_company_import_ratio']))) {echo "SELECTED";} ?>><?php echo $row_Recordset4['content']?></option>
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
            <td><input type="text" name="tfi_listcompany2_company_main_product" id="tfi_listcompany2_company_main_product" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_main_product']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listcompany2_company_main_product_EN" id="tfi_listcompany2_company_main_product_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_main_product_EN']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listcompany2_company_main_markets_orther" id="tfi_listcompany2_company_main_markets_orther" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_main_markets_orther']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listcompany2_company_shortinfo" id="tfi_listcompany2_company_shortinfo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_shortinfo']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listcompany2_company_shortinfo_EN" id="tfi_listcompany2_company_shortinfo_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_shortinfo_EN']); ?>" size="20" maxlength="255" /></td>
            <td><input type="text" name="tfi_listcompany2_company_info" id="tfi_listcompany2_company_info" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_info']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany2_company_info_EN" id="tfi_listcompany2_company_info_EN" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_info_EN']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany2_company_day_update" id="tfi_listcompany2_company_day_update" value="<?php echo @$_SESSION['tfi_listcompany2_company_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listcompany2_company_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listcompany2_company_visible" id="tfi_listcompany2_company_visible" value="1" /></td>
            <td><input type="submit" name="tfi_listcompany2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rscompany1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="36"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rscompany1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_company" class="id_checkbox" value="<?php echo $row_rscompany1['id_company']; ?>" />
                <input type="hidden" name="id_company" class="id_field" value="<?php echo $row_rscompany1['id_company']; ?>" />
            </td>
            <td><div class="KT_col_id_company"><?php echo KT_FormatForList($row_rscompany1['id_company'], 20); ?></div></td>
            <td><div class="KT_col_company_name"><?php echo KT_FormatForList($row_rscompany1['company_name'], 20); ?></div></td>
            <td><div class="KT_col_company_name_EN"><?php echo KT_FormatForList($row_rscompany1['company_name_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_id_country"><?php echo KT_FormatForList($row_rscompany1['company_id_country'], 20); ?></div></td>
            <td><div class="KT_col_company_postcode"><?php echo KT_FormatForList($row_rscompany1['company_postcode'], 20); ?></div></td>
            <td><div class="KT_col_company_logo"><?php echo KT_FormatForList($row_rscompany1['company_logo'], 20); ?></div></td>
            <td><div class="KT_col_company_address"><?php echo KT_FormatForList($row_rscompany1['company_address'], 20); ?></div></td>
            <td><div class="KT_col_company_address_EN"><?php echo KT_FormatForList($row_rscompany1['company_address_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_tell"><?php echo KT_FormatForList($row_rscompany1['company_tell'], 20); ?></div></td>
            <td><div class="KT_col_company_mobile"><?php echo KT_FormatForList($row_rscompany1['company_mobile'], 20); ?></div></td>
            <td><div class="KT_col_company_email"><?php echo KT_FormatForList($row_rscompany1['company_email'], 20); ?></div></td>
            <td><div class="KT_col_company_fax"><?php echo KT_FormatForList($row_rscompany1['company_fax'], 20); ?></div></td>
            <td><div class="KT_col_company_website"><?php echo KT_FormatForList($row_rscompany1['company_website'], 20); ?></div></td>
            <td><?php do { ?>
			<?php echo $row_rs_business_form_company['bf_name']; ?>
            <?php  }while($row_rs_business_form_company = mysql_fetch_assoc($rs_business_form_company));?></td>
            <td><div class="KT_col_company_id_industry"><?php echo KT_FormatForList($row_rscompany1['company_id_industry'], 20); ?></div></td>
            <td><div class="KT_col_company_name_represent"><?php echo KT_FormatForList($row_rscompany1['company_name_represent'], 20); ?></div></td>
            <td><div class="KT_col_company_mansex_represent"><?php echo KT_FormatForList($row_rscompany1['company_mansex_represent'], 20); ?></div></td>
            <td><div class="KT_col_company_manstatus_represent"><?php echo KT_FormatForList($row_rscompany1['company_manstatus_represent'], 20); ?></div></td>
            <td><div class="KT_col_company_manstatus_represent_EN"><?php echo KT_FormatForList($row_rscompany1['company_manstatus_represent_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_number_employees"><?php echo KT_FormatForList($row_rscompany1['company_number_employees'], 20); ?></div></td>
            <td><div class="KT_col_company_number_employees_EN"><?php echo KT_FormatForList($row_rscompany1['company_number_employees_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_year_foundation"><?php echo KT_FormatForList($row_rscompany1['company_year_foundation'], 20); ?></div></td>
            <td><div class="KT_col_company_authorized_capital"><?php echo KT_FormatForList($row_rscompany1['company_authorized_capital'], 20); ?></div></td>
            <td><div class="KT_col_company_yearly_revenue"><?php echo KT_FormatForList($row_rscompany1['company_yearly_revenue'], 20); ?></div></td>
            <td><div class="KT_col_company_export_rates"><?php echo KT_FormatForList($row_rscompany1['company_export_rates'], 20); ?></div></td>
            <td><div class="KT_col_company_import_ratio"><?php echo KT_FormatForList($row_rscompany1['company_import_ratio'], 20); ?></div></td>
            <td><div class="KT_col_company_main_product"><?php echo KT_FormatForList($row_rscompany1['company_main_product'], 20); ?></div></td>
            <td><div class="KT_col_company_main_product_EN"><?php echo KT_FormatForList($row_rscompany1['company_main_product_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_main_markets_orther"><?php echo KT_FormatForList($row_rscompany1['company_main_markets_orther'], 20); ?>,
			<?php do{ ?>
			<?php echo $row_rs_main_markets_company['main_market_name']; ?>
            <?php }while($row_rs_main_markets_company = mysql_fetch_assoc($rs_main_markets_company)); ?>
             </div></td>
            <td><div class="KT_col_company_shortinfo"><?php echo KT_FormatForList($row_rscompany1['company_shortinfo'], 20); ?></div></td>
            <td><div class="KT_col_company_shortinfo_EN"><?php echo KT_FormatForList($row_rscompany1['company_shortinfo_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_info"><?php echo KT_FormatForList($row_rscompany1['company_info'], 20); ?></div></td>
            <td><div class="KT_col_company_info_EN"><?php echo KT_FormatForList($row_rscompany1['company_info_EN'], 20); ?></div></td>
            <td><div class="KT_col_company_day_update"><?php echo KT_formatDate($row_rscompany1['company_day_update']); ?></div></td>
            <td><div class="KT_col_company_visible"><?php echo KT_FormatForList($row_rscompany1['company_visible'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_company&amp;id_company=<?php echo $row_rscompany1['id_company']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rscompany1 = mysql_fetch_assoc($rscompany1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listcompany2->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?mod=form_company&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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

mysql_free_result($rs_country);

mysql_free_result($rs_industry);

mysql_free_result($rs_main_markets_company);

mysql_free_result($rscompany1);
?>
