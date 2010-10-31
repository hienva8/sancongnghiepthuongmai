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
$tfi_listcompany1 = new TFI_TableFilter($conn_ketnoi, "tfi_listcompany1");
$tfi_listcompany1->addColumn("company.id_company", "NUMERIC_TYPE", "id_company", "=");
$tfi_listcompany1->addColumn("company.company_name", "STRING_TYPE", "company_name", "%");
$tfi_listcompany1->addColumn("country.id_country", "NUMERIC_TYPE", "company_id_country", "=");
$tfi_listcompany1->addColumn("company.company_postcode", "NUMERIC_TYPE", "company_postcode", "=");
$tfi_listcompany1->addColumn("company.company_logo", "STRING_TYPE", "company_logo", "%");
$tfi_listcompany1->addColumn("company.company_address", "STRING_TYPE", "company_address", "%");
$tfi_listcompany1->addColumn("company.company_tell", "STRING_TYPE", "company_tell", "%");
$tfi_listcompany1->addColumn("company.company_email", "STRING_TYPE", "company_email", "%");
$tfi_listcompany1->addColumn("company.company_fax", "STRING_TYPE", "company_fax", "%");
$tfi_listcompany1->addColumn("company.company_website", "STRING_TYPE", "company_website", "%");
$tfi_listcompany1->addColumn("industry.id_industry", "NUMERIC_TYPE", "company_id_industry", "=");
$tfi_listcompany1->addColumn("company.company_business_form", "STRING_TYPE", "company_business_form", "%");
$tfi_listcompany1->addColumn("company.company_name_represent", "STRING_TYPE", "company_name_represent", "%");
$tfi_listcompany1->addColumn("company.company_mansex_represent", "NUMERIC_TYPE", "company_mansex_represent", "=");
$tfi_listcompany1->addColumn("company.company_manstatus_represent", "STRING_TYPE", "company_manstatus_represent", "%");
$tfi_listcompany1->Execute();

// Sorter
$tso_listcompany1 = new TSO_TableSorter("rscompany1", "tso_listcompany1");
$tso_listcompany1->addColumn("company.id_company");
$tso_listcompany1->addColumn("company.company_name");
$tso_listcompany1->addColumn("country.country_name");
$tso_listcompany1->addColumn("company.company_postcode");
$tso_listcompany1->addColumn("company.company_logo");
$tso_listcompany1->addColumn("company.company_address");
$tso_listcompany1->addColumn("company.company_tell");
$tso_listcompany1->addColumn("company.company_email");
$tso_listcompany1->addColumn("company.company_fax");
$tso_listcompany1->addColumn("company.company_website");
$tso_listcompany1->addColumn("industry.industry_name");
$tso_listcompany1->addColumn("company.company_business_form");
$tso_listcompany1->addColumn("company.company_name_represent");
$tso_listcompany1->addColumn("company.company_mansex_represent");
$tso_listcompany1->addColumn("company.company_manstatus_represent");
$tso_listcompany1->setDefault("company.id_company");
$tso_listcompany1->Execute();

// Navigation
$nav_listcompany1 = new NAV_Regular("nav_listcompany1", "rscompany1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT country_name, id_country FROM country ORDER BY country_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset2 = "SELECT industry_name, id_industry FROM industry ORDER BY industry_name";
$Recordset2 = mysql_query($query_Recordset2, $ketnoi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


//NeXTenesio3 Special List Recordset
$maxRows_rscompany1 = $_SESSION['max_rows_nav_listcompany1'];
$pageNum_rscompany1 = 0;
if (isset($_GET['pageNum_rscompany1'])) {
  $pageNum_rscompany1 = $_GET['pageNum_rscompany1'];
}
$startRow_rscompany1 = $pageNum_rscompany1 * $maxRows_rscompany1;

// Defining List Recordset variable
$NXTFilter_rscompany1 = "1=1";
if (isset($_SESSION['filter_tfi_listcompany1'])) {
  $NXTFilter_rscompany1 = $_SESSION['filter_tfi_listcompany1'];
}
// Defining List Recordset variable
$NXTSort_rscompany1 = "company.id_company";
if (isset($_SESSION['sorter_tso_listcompany1'])) {
  $NXTSort_rscompany1 = $_SESSION['sorter_tso_listcompany1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rscompany1 = "SELECT company.id_company, company.company_name, country.country_name AS company_id_country, company.company_postcode, company.company_logo, company.company_address, company.company_tell, company.company_email, company.company_fax, company.company_website, industry.industry_name AS company_id_industry, company.company_business_form, company.company_name_represent, company.company_mansex_represent, company.company_manstatus_represent FROM (company LEFT JOIN country ON company.company_id_country = country.id_country) LEFT JOIN industry ON company.company_id_industry = industry.id_industry WHERE {$NXTFilter_rscompany1} ORDER BY {$NXTSort_rscompany1}";
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

$nav_listcompany1->checkBoundries();
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
  .KT_col_id_company {width:20px; overflow:hidden;}
  .KT_col_company_name {width:100px; overflow:hidden;}
  .KT_col_company_id_country {width:100px; overflow:hidden;}
  .KT_col_company_postcode {width:50px; overflow:hidden;}
  .KT_col_company_logo {width:100px; overflow:hidden;}
  .KT_col_company_address {width:100px; overflow:hidden;}
  .KT_col_company_tell {width:80px; overflow:hidden;}
  .KT_col_company_email {width:80px; overflow:hidden;}
  .KT_col_company_fax {width:80px; overflow:hidden;}
  .KT_col_company_website {width:80px; overflow:hidden;}
  .KT_col_company_id_industry {width:100px; overflow:hidden;}
  .KT_col_company_business_form {width:80px; overflow:hidden;}
  .KT_col_company_name_represent {width:80px; overflow:hidden;}
  .KT_col_company_mansex_represent {width:50px; overflow:hidden;}
  .KT_col_company_manstatus_represent {width:80px; overflow:hidden;}
</style>

</head>

<body>
<div class="KT_tng" id="listcompany1">
  <h1> Company
    <?php
  $nav_listcompany1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listcompany1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcompany1'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listcompany1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcompany1'] == 1) {
?>
                            <a href="<?php echo $tfi_listcompany1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listcompany1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
            </th>
            <th id="id_company" class="KT_sorter KT_col_id_company <?php echo $tso_listcompany1->getSortIcon('company.id_company'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.id_company'); ?>">Id_company</a> </th>
            <th id="company_name" class="KT_sorter KT_col_company_name <?php echo $tso_listcompany1->getSortIcon('company.company_name'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_name'); ?>">Company name</a> </th>
            <th id="company_id_country" class="KT_sorter KT_col_company_id_country <?php echo $tso_listcompany1->getSortIcon('country.country_name'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('country.country_name'); ?>">Country</a> </th>
            <th id="company_postcode" class="KT_sorter KT_col_company_postcode <?php echo $tso_listcompany1->getSortIcon('company.company_postcode'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_postcode'); ?>">Postcode</a> </th>
            <th id="company_logo" class="KT_sorter KT_col_company_logo <?php echo $tso_listcompany1->getSortIcon('company.company_logo'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_logo'); ?>">Logo</a> </th>
            <th id="company_address" class="KT_sorter KT_col_company_address <?php echo $tso_listcompany1->getSortIcon('company.company_address'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_address'); ?>">Address</a> </th>
            <th id="company_tell" class="KT_sorter KT_col_company_tell <?php echo $tso_listcompany1->getSortIcon('company.company_tell'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_tell'); ?>">Tell</a> </th>
            <th id="company_email" class="KT_sorter KT_col_company_email <?php echo $tso_listcompany1->getSortIcon('company.company_email'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_email'); ?>">Email</a> </th>
            <th id="company_fax" class="KT_sorter KT_col_company_fax <?php echo $tso_listcompany1->getSortIcon('company.company_fax'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_fax'); ?>">Fax</a> </th>
            <th id="company_website" class="KT_sorter KT_col_company_website <?php echo $tso_listcompany1->getSortIcon('company.company_website'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_website'); ?>">Website</a> </th>
            <th id="company_id_industry" class="KT_sorter KT_col_company_id_industry <?php echo $tso_listcompany1->getSortIcon('industry.industry_name'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('industry.industry_name'); ?>">Categories industry</a> </th>
            <th id="company_business_form" class="KT_sorter KT_col_company_business_form <?php echo $tso_listcompany1->getSortIcon('company.company_business_form'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_business_form'); ?>">Business_form</a> </th>
            <th id="company_name_represent" class="KT_sorter KT_col_company_name_represent <?php echo $tso_listcompany1->getSortIcon('company.company_name_represent'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_name_represent'); ?>">Company name represent</a> </th>
            <th id="company_mansex_represent" class="KT_sorter KT_col_company_mansex_represent <?php echo $tso_listcompany1->getSortIcon('company.company_mansex_represent'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_mansex_represent'); ?>">Company mansex represent</a> </th>
            <th id="company_manstatus_represent" class="KT_sorter KT_col_company_manstatus_represent <?php echo $tso_listcompany1->getSortIcon('company.company_manstatus_represent'); ?>"> <a href="<?php echo $tso_listcompany1->getSortLink('company.company_manstatus_represent'); ?>">Company manstatus represent</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcompany1'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listcompany1_id_company" id="tfi_listcompany1_id_company" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_id_company']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany1_company_name" id="tfi_listcompany1_company_name" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_name']); ?>" size="20" maxlength="200" /></td>
            <td><select name="tfi_listcompany1_company_id_country" id="tfi_listcompany1_company_id_country">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany1_company_id_country']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['id_country']?>"<?php if (!(strcmp($row_Recordset1['id_country'], @$_SESSION['tfi_listcompany1_company_id_country']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['country_name']?></option>
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
            <td><input type="text" name="tfi_listcompany1_company_postcode" id="tfi_listcompany1_company_postcode" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_postcode']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany1_company_logo" id="tfi_listcompany1_company_logo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_logo']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcompany1_company_address" id="tfi_listcompany1_company_address" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_address']); ?>" size="20" maxlength="200" /></td>
            <td><input type="text" name="tfi_listcompany1_company_tell" id="tfi_listcompany1_company_tell" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_tell']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcompany1_company_email" id="tfi_listcompany1_company_email" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_email']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcompany1_company_fax" id="tfi_listcompany1_company_fax" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_fax']); ?>" size="20" maxlength="20" /></td>
            <td><input type="text" name="tfi_listcompany1_company_website" id="tfi_listcompany1_company_website" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_website']); ?>" size="20" maxlength="60" /></td>
            <td><select name="tfi_listcompany1_company_id_industry" id="tfi_listcompany1_company_id_industry">
              <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcompany1_company_id_industry']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['id_industry']?>"<?php if (!(strcmp($row_Recordset2['id_industry'], @$_SESSION['tfi_listcompany1_company_id_industry']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['industry_name']?></option>
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
            <td><input type="text" name="tfi_listcompany1_company_business_form" id="tfi_listcompany1_company_business_form" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_business_form']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcompany1_company_name_represent" id="tfi_listcompany1_company_name_represent" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_name_represent']); ?>" size="20" maxlength="60" /></td>
            <td><input type="text" name="tfi_listcompany1_company_mansex_represent" id="tfi_listcompany1_company_mansex_represent" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_mansex_represent']); ?>" size="20" maxlength="100" /></td>
            <td><input type="text" name="tfi_listcompany1_company_manstatus_represent" id="tfi_listcompany1_company_manstatus_represent" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcompany1_company_manstatus_represent']); ?>" size="20" maxlength="30" /></td>
            <td><input type="submit" name="tfi_listcompany1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rscompany1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="17"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
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
            <td><div class="KT_col_company_id_country"><?php echo KT_FormatForList($row_rscompany1['company_id_country'], 20); ?></div></td>
            <td><div class="KT_col_company_postcode"><?php echo KT_FormatForList($row_rscompany1['company_postcode'], 20); ?></div></td>
            <td><div class="KT_col_company_logo"><?php echo KT_FormatForList($row_rscompany1['company_logo'], 20); ?></div></td>
            <td><div class="KT_col_company_address"><?php echo KT_FormatForList($row_rscompany1['company_address'], 20); ?></div></td>
            <td><div class="KT_col_company_tell"><?php echo KT_FormatForList($row_rscompany1['company_tell'], 20); ?></div></td>
            <td><div class="KT_col_company_email"><?php echo KT_FormatForList($row_rscompany1['company_email'], 20); ?></div></td>
            <td><div class="KT_col_company_fax"><?php echo KT_FormatForList($row_rscompany1['company_fax'], 20); ?></div></td>
            <td><div class="KT_col_company_website"><?php echo KT_FormatForList($row_rscompany1['company_website'], 20); ?></div></td>
            <td><div class="KT_col_company_id_industry"><?php echo KT_FormatForList($row_rscompany1['company_id_industry'], 20); ?></div></td>
            <td>
			<?php do { ?>
			<?php echo $row_rs_business_form_company['bf_name']; ?>
            <?php  }while($row_rs_business_form_company = mysql_fetch_assoc($rs_business_form_company));?>
            </td>
            <td><div class="KT_col_company_name_represent"><?php echo KT_FormatForList($row_rscompany1['company_name_represent'], 20); ?></div></td>
            <td><div class="KT_col_company_mansex_represent"><?php echo KT_FormatForList($row_rscompany1['company_mansex_represent'], 20); ?></div></td>
            <td><div class="KT_col_company_manstatus_represent"><?php echo KT_FormatForList($row_rscompany1['company_manstatus_represent'], 20); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?mod=form_company&amp;id_company=<?php echo $row_rscompany1['id_company']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rscompany1 = mysql_fetch_assoc($rscompany1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listcompany1->Prepare();
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

mysql_free_result($rs_business_form_company);

mysql_free_result($rscompany1);
?>
