<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("id_products", false, "numeric", "int", "", "", "Please choose  product name.");
$tNGs->prepareValidation($formValidation);
// End trigger
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = "SELECT id_products, product_name, product_name_EN FROM products";
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

$NxTMasterId_rsproducts1 = "-1";
if (isset($_GET['NxT_id_products'])) {
  $NxTMasterId_rsproducts1 = $_GET['NxT_id_products'];
}
//recordset of images_library
$query_rs_images_library ="SELECT id_images_library FROM images_library WHERE id_products =  $NxTMasterId_rsproducts1";
$rs_images_library = mysql_query($query_rs_images_library);
$totalRows_rs_images_library = mysql_num_rows($rs_images_library);
//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/products/{SESSION.kt_login_id}/{GET.NxT_id_products}/$NxTMasterId_rsproducts1}/");
  $deleteObj->setDbFieldName("il_image");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("il_image");
  $uploadObj->setDbFieldName("il_image");
  $uploadObj->setFolder("../uploads/products/images_library/{GET.NxT_id_products}/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, gif, bmp");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

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


mysql_select_db($database_ketnoi, $ketnoi);
$query_rsproducts1 = sprintf("SELECT id_products, product_name FROM products WHERE id_products = %s", GetSQLValueString($NxTMasterId_rsproducts1, "int"));
$rsproducts1 = mysql_query($query_rsproducts1, $ketnoi) or die(mysql_error());
$row_rsproducts1 = mysql_fetch_assoc($rsproducts1);
$totalRows_rsproducts1 = mysql_num_rows($rsproducts1);

// Make an insert transaction instance
$ins_images_library = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_images_library);
// Register triggers
$ins_images_library->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_images_library->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_images_library->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_images_library&NxT_id_products=$NxTMasterId_rsproducts1");
$ins_images_library->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_images_library->setTable("images_library");
$ins_images_library->addColumn("id_products", "NUMERIC_TYPE", "GET", "NxT_id_products");
$ins_images_library->addColumn("il_image", "FILE_TYPE", "FILES", "il_image");
$ins_images_library->addColumn("li_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_images_library->setPrimaryKey("id_images_library", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_images_library = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_images_library);
// Register triggers
$upd_images_library->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_images_library->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_images_library->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_images_library&NxT_id_products=$NxTMasterId_rsproducts1");
$upd_images_library->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_images_library->setTable("images_library");
$upd_images_library->addColumn("il_image", "FILE_TYPE", "FILES", "il_image");
$upd_images_library->addColumn("li_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_images_library->setPrimaryKey("id_images_library", "NUMERIC_TYPE", "GET", "id_images_library");

// Make an instance of the transaction object
$del_images_library = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_images_library);
// Register triggers
$del_images_library->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_images_library->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_images_library&NxT_id_products=$NxTMasterId_rsproducts1");
$del_images_library->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_images_library->setTable("images_library");
$del_images_library->setPrimaryKey("id_images_library", "NUMERIC_TYPE", "GET", "id_images_library");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsimages_library = $tNGs->getRecordset("images_library");
$row_rsimages_library = mysql_fetch_assoc($rsimages_library);
$totalRows_rsimages_library = mysql_num_rows($rsimages_library);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script src="../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
</head>

<body>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_images_library'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Images library</h1>
  <div class="KT_tngform">
    <?php 
// Show IF Conditional region5 
if (isset($_GET['NxT_id_products'])) {
?>
      <div>
        <?php 
// Show IF Conditional region4 
if (!isset($_GET['id_images_library'])) {
?>
          Insert
  <?php 
// else Conditional region4
} else { ?>
          Update
  <?php } 
// endif Conditional region4
?>
        records for: <b><?php echo $row_rsproducts1['product_name']; ?></b></div>
      <?php } 
// endif Conditional region5
?><form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsimages_library > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
       <?php if(isset($_GET['id_images_library'])){ ?> <tr><td class="KT_th">Old image</td>
        	<td><?php 
// Show If File Exists (region7)
if (tNG_fileExists("../uploads/products/images_library/{GET.NxT_id_products}/", "{rsimages_library.il_image}")) {
?>
                <img src="<?php echo tNG_showDynamicImage("../", "../uploads/products/images_library/{GET.NxT_id_products}/", "{rsimages_library.il_image}");?>" />
                <?php } 
// EndIf File Exists (region7)
?><br /></td>
        </tr>
        <?php } ?>
<tr>
            <td class="KT_th"><label for="il_image_<?php echo $cnt1; ?>">New image:</label></td>
            <td>
              <?php 
// Show IF Conditional region6 
if ($totalRows_rs_images_library <= 4) {
?>
                <input type="file" name="il_image_<?php echo $cnt1; ?>" id="il_image_<?php echo $cnt1; ?>" size="32" />
                <?php }else{ print "bạn đã upload đủ 5 hình trong thư viện hình:<b> ".$row_rsproducts1['product_name']."</b>";}?>
                <?php echo $tNGs->displayFieldError("images_library", "il_image", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th">Day update:</td>
            <td><?php echo KT_formatDate($row_rsimages_library['li_day_update']); ?></td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_images_library_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsimages_library['kt_pk_images_library']); ?>" />
        <?php } while ($row_rsimages_library = mysql_fetch_assoc($rsimages_library)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_images_library'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_images_library')" />
            </div>
            <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
            <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
            <?php }
      // endif Conditional region1
      ?>
          <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
        </div>
      </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_products);

mysql_free_result($rsproducts1);
?>
