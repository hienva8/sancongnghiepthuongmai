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

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("Filedata");
  $uploadObj->setDbFieldName("il_image");
  $uploadObj->setFolder("../uploads/products/{SESSION.kt_login_id}/{id_products}/");
  $uploadObj->setResize("true", 100, 0);
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, gif, bmp");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_Redirect trigger
//remove this line if you want to edit the code by hand
function Trigger_Redirect(&$tNG) {
  $redObj = new tNG_Redirect($tNG);
  $redObj->setURL(KT_getFullUri());
  $redObj->setKeepURLParams(false);
  return $redObj->Execute();
}
//end Trigger_Redirect trigger

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
$tfi_listimages_library1 = new TFI_TableFilter($conn_ketnoi, "tfi_listimages_library1");
$tfi_listimages_library1->addColumn("images_library.il_image", "FILE_TYPE", "il_image", "%");
$tfi_listimages_library1->addColumn("images_library.li_day_update", "DATE_TYPE", "li_day_update", "=");
$tfi_listimages_library1->Execute();

// Sorter
$tso_listimages_library1 = new TSO_TableSorter("rsimages_library1", "tso_listimages_library1");
$tso_listimages_library1->addColumn("images_library.il_image");
$tso_listimages_library1->addColumn("images_library.li_day_update");
$tso_listimages_library1->setDefault("images_library.li_day_update DESC");
$tso_listimages_library1->Execute();

// Navigation
$nav_listimages_library1 = new NAV_Regular("nav_listimages_library1", "rsimages_library1", "../", $_SERVER['PHP_SELF'], 10);

if (isset($_GET['NxT_id_products'])) {
  $NxTDetailCond__rsimages_library1_cond = " images_library.id_products = " . GetSQLValueString($_GET['NxT_id_products'], "int") . " ";
}

mysql_select_db($database_ketnoi, $ketnoi);
$query_Recordset1 = "SELECT product_name, id_products FROM products ORDER BY product_name";
$Recordset1 = mysql_query($query_Recordset1, $ketnoi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$NxTMasterId_rsproducts1 = "-1";
if (isset($_GET['NxT_id_products'])) {
  $NxTMasterId_rsproducts1 = $_GET['NxT_id_products'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rsproducts1 = sprintf("SELECT id_products, product_name FROM products WHERE id_products = %s", GetSQLValueString($NxTMasterId_rsproducts1, "int"));
$rsproducts1 = mysql_query($query_rsproducts1, $ketnoi) or die(mysql_error());
$row_rsproducts1 = mysql_fetch_assoc($rsproducts1);
$totalRows_rsproducts1 = mysql_num_rows($rsproducts1);

// Make an insert transaction instance
$ins_images_library = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_images_library);
// Register triggers
$ins_images_library->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_images_library->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_images_library->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "FILES", "Filedata");
$ins_images_library->registerConditionalTrigger("{GET.isFlash} != 1", "END", "Trigger_Redirect", 90);
$ins_images_library->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$ins_images_library->registerConditionalTrigger("{GET.isFlash} == 1", "ERROR", "Trigger_Default_MUploadError", 10);
// Add columns
$ins_images_library->setTable("images_library");
$ins_images_library->addColumn("id_products", "NUMERIC_TYPE", "VALUE", "{GET.NxT_id_products}");
$ins_images_library->addColumn("li_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_images_library->addColumn("il_image", "FILE_TYPE", "FILES", "Filedata");
$ins_images_library->setPrimaryKey("id_images_library", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

//NeXTenesio3 Special List Recordset
$maxRows_rsimages_library1 = $_SESSION['max_rows_nav_listimages_library1'];
$pageNum_rsimages_library1 = 0;
if (isset($_GET['pageNum_rsimages_library1'])) {
  $pageNum_rsimages_library1 = $_GET['pageNum_rsimages_library1'];
}
$startRow_rsimages_library1 = $pageNum_rsimages_library1 * $maxRows_rsimages_library1;

// Defining List Recordset variable
$NxTDetailCond_rsimages_library1 = "1=1";
if (isset($NxTDetailCond__rsimages_library1_cond)) {
  $NxTDetailCond_rsimages_library1 = $NxTDetailCond__rsimages_library1_cond;
}
// Defining List Recordset variable
$NXTFilter_rsimages_library1 = "1=1";
if (isset($_SESSION['filter_tfi_listimages_library1'])) {
  $NXTFilter_rsimages_library1 = $_SESSION['filter_tfi_listimages_library1'];
}
// Defining List Recordset variable
$NXTSort_rsimages_library1 = "images_library.li_day_update DESC";
if (isset($_SESSION['sorter_tso_listimages_library1'])) {
  $NXTSort_rsimages_library1 = $_SESSION['sorter_tso_listimages_library1'];
}
mysql_select_db($database_ketnoi, $ketnoi);

$query_rsimages_library1 = "SELECT products.product_name AS id_products, images_library.il_image, images_library.li_day_update, images_library.id_images_library FROM images_library LEFT JOIN products ON images_library.id_products = products.id_products WHERE {$NXTFilter_rsimages_library1} AND  {$NxTDetailCond_rsimages_library1}  ORDER BY {$NXTSort_rsimages_library1}";
$query_limit_rsimages_library1 = sprintf("%s LIMIT %d, %d", $query_rsimages_library1, $startRow_rsimages_library1, $maxRows_rsimages_library1);
$rsimages_library1 = mysql_query($query_limit_rsimages_library1, $ketnoi) or die(mysql_error());
$row_rsimages_library1 = mysql_fetch_assoc($rsimages_library1);

if (isset($_GET['totalRows_rsimages_library1'])) {
  $totalRows_rsimages_library1 = $_GET['totalRows_rsimages_library1'];
} else {
  $all_rsimages_library1 = mysql_query($query_rsimages_library1);
  $totalRows_rsimages_library1 = mysql_num_rows($all_rsimages_library1);
}
$totalPages_rsimages_library1 = ceil($totalRows_rsimages_library1/$maxRows_rsimages_library1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listimages_library1->checkBoundries();

// Get the transaction recordset
$rsimages_library = $tNGs->getRecordset("images_library");
$row_rsimages_library = mysql_fetch_assoc($rsimages_library);
$totalRows_rsimages_library = mysql_num_rows($rsimages_library);

// Multiple Upload Helper Object
$muploadHelper = new tNG_MuploadHelper("../", 32);
$muploadHelper->setMaxSize(5000);
$muploadHelper->setMaxNumber(0);
$muploadHelper->setExistentNumber(0);
$muploadHelper->setAllowedExtensions("jpg, jpe, jpeg, png, gif, bmp");
//recordset of images_library
$query_rs_images_library ="SELECT id_images_library FROM images_library WHERE id_products =  $NxTMasterId_rsproducts1";
$rs_images_library = mysql_query($query_rs_images_library);
$totalRows_rs_images_library = mysql_num_rows($rs_images_library);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  .KT_col_il_image {width:140px; overflow:hidden;}
  .KT_col_li_day_update {width:140px; overflow:hidden;}
</style>
<?php echo $tNGs->displayValidationRules();?><?php echo $muploadHelper->getScripts(); ?>
</head>

<body>
<div class="KT_tng" id="listimages_library1">
  <h1> Images library
    <?php
  $nav_listimages_library1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
  | 
  <?php
	echo $tNGs->getErrorMsg();
?>
<?php if ($totalRows_rs_images_library <= 4) {
?>
  <?php
// Multiple Upload Helper
echo $tNGs->getSavedErrorMsg();
echo $muploadHelper->Execute();
?>
</h1>
<?php }else{ print "<font style='font-weight:normal' size=2 color=red>Bạn đã upload đủ 5 hình trong thư viện hình:<b> ".$row_rsproducts1['product_name']."</b></font>";}?>
  <div class="KT_tnglist">
    <?php 
// Show IF Conditional region4 
if (isset($_GET['NxT_id_products'])) {
?>
      <table>
        <tr class="KT_masterlink">
          <td>Library of:&nbsp;<strong><?php echo $row_rsproducts1['product_name']; ?></strong></td>
          <td align="right"> &nbsp;&nbsp;&nbsp;&nbsp;&raquo; <a href="../includes/nxt/back.php?KT_back=-2">Back to the Products list</a></td>
        </tr>
              </table>
      <?php } 
// endif Conditional region4
?><form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listimages_library1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
            <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listimages_library1'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listimages_library1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listimages_library1'] == 1) {
?>
                            <a href="<?php echo $tfi_listimages_library1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                            <?php 
  // else Conditional region2
  } else { ?>
                            <a href="<?php echo $tfi_listimages_library1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                            <?php } 
  // endif Conditional region2
?>
      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>            </th>
            <th id="il_image" class="KT_sorter KT_col_il_image <?php echo $tso_listimages_library1->getSortIcon('images_library.il_image'); ?>"> <a href="<?php echo $tso_listimages_library1->getSortLink('images_library.il_image'); ?>">Images</a> </th>
            <th id="li_day_update" class="KT_sorter KT_col_li_day_update <?php echo $tso_listimages_library1->getSortIcon('images_library.li_day_update'); ?>"> <a href="<?php echo $tso_listimages_library1->getSortLink('images_library.li_day_update'); ?>">Day update</a> </th>
            <th>&nbsp;</th>
          </tr>
          <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listimages_library1'] == 1) {
?>
          <tr class="KT_row_filter">
            <td>&nbsp;</td>
            <td><input type="text" name="tfi_listimages_library1_il_image" id="tfi_listimages_library1_il_image" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listimages_library1_il_image']); ?>" size="20" maxlength="50" /></td>
            <td><input type="text" name="tfi_listimages_library1_li_day_update" id="tfi_listimages_library1_li_day_update" value="<?php echo @$_SESSION['tfi_listimages_library1_li_day_update']; ?>" size="10" maxlength="22" /></td>
            <td><input type="submit" name="tfi_listimages_library1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
          </tr>
          <?php } 
  // endif Conditional region3
?>
        </thead>
        <tbody>
          <?php if ($totalRows_rsimages_library1 == 0) { // Show if recordset empty ?>
          <tr>
            <td colspan="4"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
          </tr>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsimages_library1 > 0) { // Show if recordset not empty ?>
          <?php do { ?>
          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
            <td><input type="checkbox" name="kt_pk_images_library" class="id_checkbox" value="<?php echo $row_rsimages_library1['id_images_library']; ?>" />
                <input type="hidden" name="id_images_library" class="id_field" value="<?php echo $row_rsimages_library1['id_images_library']; ?>" />            </td>
            <td><?php 
// Show If File Exists (region5)
if (tNG_fileExists("../uploads/products/images_library/{GET.NxT_id_products}/", "{rsimages_library1.il_image}")) {
?>
                <img src="<?php echo tNG_showDynamicImage("../", "../uploads/products/images_library/$NxTMasterId_rsproducts1/", "{rsimages_library1.il_image}");?>" width="100" />
                <?php } 
// EndIf File Exists (region5)
?></td>
            <td><div class="KT_col_li_day_update"><?php echo KT_formatDate($row_rsimages_library1['li_day_update']); ?></div></td>
            <td><a class="KT_edit_link" href="index.php?<?php echo isset($_GET['NxT_id_products']) ? "NxT_id_products=".$_GET['NxT_id_products'] : ""; ?>&amp;mod=form_images_library&amp;id_images_library=<?php echo $row_rsimages_library1['id_images_library']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
          </tr>
          <?php } while ($row_rsimages_library1 = mysql_fetch_assoc($rsimages_library1)); ?>
          <?php } // Show if recordset not empty ?>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listimages_library1->Prepare();
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
        <a class="KT_additem_op_link" href="index.php?<?php echo isset($_GET['NxT_id_products']) ? "NxT_id_products=".$_GET['NxT_id_products'] : ""; ?>&amp;mod=form_images_library&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rsproducts1);

mysql_free_result($rsimages_library1);
?>
