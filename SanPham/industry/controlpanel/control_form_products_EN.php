<?php require_once('../Connections/ketnoi.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

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

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_ketnoi, "../");
//Grand Levels: Any
$restrict->Execute();
//End Restrict Access To Page

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("product_name_EN", true, "text", "", "", "", "Please enter product name.");
$formValidation->addField("id_procat", true, "numeric", "", "", "", "Please choose categories");
$formValidation->addField("product_reference_price", false, "text", "phone", "", "", "please enter number");
$formValidation->addField("product_rates", true, "text", "", "", "", "Please choose product rates.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_Default_ManyToMany trigger
//remove this line if you want to edit the code by hand 
function Trigger_Default_ManyToMany(&$tNG) {
  $mtm = new tNG_ManyToMany($tNG);
  $mtm->setTable("payment_methods_products");
  $mtm->setPkName("id_products");
  $mtm->setFkName("id_payment_methods");
  $mtm->setFkReference("mtm");
  return $mtm->Execute();
}
//end Trigger_Default_ManyToMany trigger

//start Trigger_DeleteDetail trigger
//remove this line if you want to edit the code by hand
function Trigger_DeleteDetail(&$tNG) {
  $tblDelObj = new tNG_DeleteDetailRec($tNG);
  $tblDelObj->setTable("payment_methods_products");
  $tblDelObj->setFieldName("id_products");
  return $tblDelObj->Execute();
}
//end Trigger_DeleteDetail trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/products/{SESSION.kt_login_id}/{id_products}/");
  $deleteObj->setDbFieldName("product_image_illustrate");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("product_image_illustrate");
  $uploadObj->setDbFieldName("product_image_illustrate");
  $uploadObj->setFolder("../uploads/products/{SESSION.kt_login_id}/{id_products}/");
  $uploadObj->setResize("true", 300, 0);
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, bmp");
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
$query_rs_procat = "SELECT id_procat, procat_name_EN FROM procat WHERE visible = 1 ORDER BY sort ASC";
$rs_procat = mysql_query($query_rs_procat, $ketnoi) or die(mysql_error());
$row_rs_procat = mysql_fetch_assoc($rs_procat);
$totalRows_rs_procat = mysql_num_rows($rs_procat);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat1 = "SELECT id_prosubcat1, id_procat, prosubcat1_name_EN FROM prosubcat1 WHERE visible = 1 ORDER BY sort ASC";
$rs_prosubcat1 = mysql_query($query_rs_prosubcat1, $ketnoi) or die(mysql_error());
$row_rs_prosubcat1 = mysql_fetch_assoc($rs_prosubcat1);
$totalRows_rs_prosubcat1 = mysql_num_rows($rs_prosubcat1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat2 = "SELECT id_prosubcat2, id_procat, id_prosubcat1, prosubcat2_name_EN FROM prosubcat2 WHERE visible = 1 ORDER BY sort ASC";
$rs_prosubcat2 = mysql_query($query_rs_prosubcat2, $ketnoi) or die(mysql_error());
$row_rs_prosubcat2 = mysql_fetch_assoc($rs_prosubcat2);
$totalRows_rs_prosubcat2 = mysql_num_rows($rs_prosubcat2);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat3 = "SELECT id_prosubcat3, id_procat, id_prosubcat1, id_prosubcat2, prosubcat3_name_EN FROM prosubcat3 WHERE visible = 1 ORDER BY sort ASC";
$rs_prosubcat3 = mysql_query($query_rs_prosubcat3, $ketnoi) or die(mysql_error());
$row_rs_prosubcat3 = mysql_fetch_assoc($rs_prosubcat3);
$totalRows_rs_prosubcat3 = mysql_num_rows($rs_prosubcat3);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name_EN FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_rates = "SELECT id_rates, rates_content FROM rates ORDER BY rates_sort ASC";
$rs_rates = mysql_query($query_rs_rates, $ketnoi) or die(mysql_error());
$row_rs_rates = mysql_fetch_assoc($rs_rates);
$totalRows_rs_rates = mysql_num_rows($rs_rates);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rspayment_methods = "SELECT payment_methods.id_payment_methods, payment_methods.methods_name, payment_methods_products.id_products FROM payment_methods LEFT JOIN payment_methods_products ON (payment_methods_products.id_payment_methods=payment_methods.id_payment_methods AND payment_methods_products.id_products=0123456789)";
$rspayment_methods = mysql_query($query_rspayment_methods, $ketnoi) or die(mysql_error());
$row_rspayment_methods = mysql_fetch_assoc($rspayment_methods);
$totalRows_rspayment_methods = mysql_num_rows($rspayment_methods);

// Make an insert transaction instance
$ins_products = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_products);
// Register triggers
$ins_products->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_products->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_products->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lp");
$ins_products->registerTrigger("AFTER", "Trigger_Default_ManyToMany", 50);
$ins_products->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_products->setTable("products");
$ins_products->addColumn("product_name_EN", "STRING_TYPE", "POST", "product_name_EN");
$ins_products->addColumn("id_procat", "NUMERIC_TYPE", "POST", "id_procat");
$ins_products->addColumn("id_prosubcat1", "NUMERIC_TYPE", "POST", "id_prosubcat1");
$ins_products->addColumn("id_prosubcat2", "NUMERIC_TYPE", "POST", "id_prosubcat2");
$ins_products->addColumn("id_prosubcat3", "NUMERIC_TYPE", "POST", "id_prosubcat3");
$ins_products->addColumn("id_country", "NUMERIC_TYPE", "POST", "id_country");
$ins_products->addColumn("product_image_illustrate", "FILE_TYPE", "FILES", "product_image_illustrate");
$ins_products->addColumn("product_short_describe_EN", "STRING_TYPE", "POST", "product_short_describe_EN");
$ins_products->addColumn("product_content_EN", "STRING_TYPE", "POST", "product_content_EN");
$ins_products->addColumn("product_reference_price", "STRING_TYPE", "POST", "product_reference_price");
$ins_products->addColumn("product_rates", "STRING_TYPE", "POST", "product_rates");
$ins_products->addColumn("product_unit_EN", "STRING_TYPE", "POST", "product_unit_EN");
$ins_products->addColumn("product_type", "STRING_TYPE", "POST", "product_type");
$ins_products->addColumn("product_payment_methods_orther_EN", "STRING_TYPE", "POST", "product_payment_methods_orther_EN");
$ins_products->addColumn("product_day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_products->addColumn("product_visible", "CHECKBOX_1_0_TYPE", "POST", "product_visible", "0");
$ins_products->addColumn("product_showroom", "CHECKBOX_1_0_TYPE", "POST", "product_showroom", "0");
$ins_products->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member", "{SESSION.kt_login_id}");
$ins_products->setPrimaryKey("id_products", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_products = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_products);
// Register triggers
$upd_products->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_products->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_products->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lp");
$upd_products->registerTrigger("AFTER", "Trigger_Default_ManyToMany", 50);
$upd_products->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_products->setTable("products");
$upd_products->addColumn("product_name_EN", "STRING_TYPE", "POST", "product_name_EN");
$upd_products->addColumn("id_procat", "NUMERIC_TYPE", "POST", "id_procat");
$upd_products->addColumn("id_prosubcat1", "NUMERIC_TYPE", "POST", "id_prosubcat1");
$upd_products->addColumn("id_prosubcat2", "NUMERIC_TYPE", "POST", "id_prosubcat2");
$upd_products->addColumn("id_prosubcat3", "NUMERIC_TYPE", "POST", "id_prosubcat3");
$upd_products->addColumn("id_country", "NUMERIC_TYPE", "POST", "id_country");
$upd_products->addColumn("product_image_illustrate", "FILE_TYPE", "FILES", "product_image_illustrate");
$upd_products->addColumn("product_short_describe_EN", "STRING_TYPE", "POST", "product_short_describe_EN");
$upd_products->addColumn("product_content_EN", "STRING_TYPE", "POST", "product_content_EN");
$upd_products->addColumn("product_reference_price", "STRING_TYPE", "POST", "product_reference_price");
$upd_products->addColumn("product_rates", "STRING_TYPE", "POST", "product_rates");
$upd_products->addColumn("product_unit_EN", "STRING_TYPE", "POST", "product_unit_EN");
$upd_products->addColumn("product_type", "STRING_TYPE", "POST", "product_type");
$upd_products->addColumn("product_payment_methods_orther_EN", "STRING_TYPE", "POST", "product_payment_methods_orther_EN");
$upd_products->addColumn("product_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_products->addColumn("product_visible", "CHECKBOX_1_0_TYPE", "POST", "product_visible");
$upd_products->addColumn("product_showroom", "CHECKBOX_1_0_TYPE", "POST", "product_showroom");
$upd_products->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member");
$upd_products->setPrimaryKey("id_products", "NUMERIC_TYPE", "GET", "id_products");

// Make an instance of the transaction object
$del_products = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_products);
// Register triggers
$del_products->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_products->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lp");
$del_products->registerTrigger("BEFORE", "Trigger_DeleteDetail", 99);
$del_products->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_products->setTable("products");
$del_products->setPrimaryKey("id_products", "NUMERIC_TYPE", "GET", "id_products");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsproducts = $tNGs->getRecordset("products");
$row_rsproducts = mysql_fetch_assoc($rsproducts);
$totalRows_rsproducts = mysql_num_rows($rsproducts);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
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
  duplicate_buttons: false,
  show_as_grid: true,
  merge_down_value: true
}
</script>
 <script type="text/javascript" src="../Editor/scripts/innovaeditor.js"></script>
 <script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
 <script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
 <script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
 <script type="text/javascript" src="../includes/wdg/classes/JSRecordset.js"></script>
 <script type="text/javascript" src="../includes/wdg/classes/DependentDropdown.js"></script>
 <?php
//begin JSRecordset
$jsObject_rs_prosubcat1 = new WDG_JsRecordset("rs_prosubcat1");
echo $jsObject_rs_prosubcat1->getOutput();
//end JSRecordset
?>
 <?php
//begin JSRecordset
$jsObject_rs_prosubcat2 = new WDG_JsRecordset("rs_prosubcat2");
echo $jsObject_rs_prosubcat2->getOutput();
//end JSRecordset
?>
 <?php
//begin JSRecordset
$jsObject_rs_prosubcat3 = new WDG_JsRecordset("rs_prosubcat3");
echo $jsObject_rs_prosubcat3->getOutput();
//end JSRecordset
?>
</head>

<body>
<div class="KT_tng">
  <div>
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsproducts > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">

          <tr>
            <td width="100"><label for="product_name_EN_<?php echo $cnt1; ?>">Product name:</label></td>
            <td><input name="product_name_EN_<?php echo $cnt1; ?>" type="text" id="product_name_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproducts['product_name_EN']); ?>" size="50" maxlength="100" />
                <?php echo $tNGs->displayFieldHint("product_name_EN");?> <?php echo $tNGs->displayFieldError("products", "product_name_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="id_procat_<?php echo $cnt1; ?>">Categories:</label></td>
            <td><select name="id_procat_<?php echo $cnt1; ?>" id="id_procat_<?php echo $cnt1; ?>">
                <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                <?php 
do {  
?>
                <option value="<?php echo $row_rs_procat['id_procat']?>"<?php if (!(strcmp($row_rs_procat['id_procat'], $row_rsproducts['id_procat']))) {echo "SELECTED";} ?>><?php echo $row_rs_procat['procat_name_EN']?></option>
                <?php
} while ($row_rs_procat = mysql_fetch_assoc($rs_procat));
  $rows = mysql_num_rows($rs_procat);
  if($rows > 0) {
      mysql_data_seek($rs_procat, 0);
	  $row_rs_procat = mysql_fetch_assoc($rs_procat);
  }
?>
              </select>
                <?php echo $tNGs->displayFieldError("products", "id_procat", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="id_prosubcat1_<?php echo $cnt1; ?>">Sub Categories 1:</label></td>
            <td><select name="id_prosubcat1_<?php echo $cnt1; ?>" id="id_prosubcat1_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat1" wdg:displayfield="prosubcat1_name_EN" wdg:valuefield="id_prosubcat1" wdg:fkey="id_procat" wdg:triggerobject="id_procat_<?php echo $cnt1; ?>" wdg:selected="<?php echo $row_rsproducts['id_prosubcat1'] ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              </select>
                <?php echo $tNGs->displayFieldError("products", "id_prosubcat1", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="id_prosubcat2_<?php echo $cnt1; ?>">Sub Categories 2:</label></td>
            <td><select name="id_prosubcat2_<?php echo $cnt1; ?>" id="id_prosubcat2_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat2" wdg:displayfield="prosubcat2_name_EN" wdg:valuefield="id_prosubcat2" wdg:fkey="id_prosubcat1" wdg:triggerobject="id_prosubcat1_<?php echo $cnt1; ?>" wdg:selected="<?php echo $row_rsproducts['id_prosubcat2'] ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              </select>
                <?php echo $tNGs->displayFieldError("products", "id_prosubcat2", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="id_prosubcat3_<?php echo $cnt1; ?>">Sub Categories 3:</label></td>
            <td><select name="id_prosubcat3_<?php echo $cnt1; ?>" id="id_prosubcat3_<?php echo $cnt1; ?>" wdg:subtype="DependentDropdown" wdg:type="widget" wdg:recordset="rs_prosubcat3" wdg:displayfield="prosubcat3_name_EN" wdg:valuefield="id_prosubcat3" wdg:fkey="id_prosubcat2" wdg:triggerobject="id_prosubcat2_<?php echo $cnt1; ?>" wdg:selected="<?php echo $row_rsproducts['id_prosubcat3'] ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              </select>
                <?php echo $tNGs->displayFieldError("products", "id_prosubcat3", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="id_country_<?php echo $cnt1; ?>">Country:</label></td>
            <td><select name="id_country_<?php echo $cnt1; ?>" id="id_country_<?php echo $cnt1; ?>">
                <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                <?php 
do {  
?>
                <option value="<?php echo $row_rs_country['id_country']?>"<?php if (!(strcmp($row_rs_country['id_country'], $row_rsproducts['id_country']))) {echo "SELECTED";} ?>><?php echo $row_rs_country['country_name_EN']?></option>
                <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
              </select>
                <?php echo $tNGs->displayFieldError("products", "id_country", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="product_image_illustrate_<?php echo $cnt1; ?>">Image illustrate:</label></td>
            <td><input type="file" name="product_image_illustrate_<?php echo $cnt1; ?>" id="product_image_illustrate_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("products", "product_image_illustrate", $cnt1); ?>
                <?php 
// Show If File Exists (region4)
if (tNG_fileExists("../uploads/products/{SESSION.kt_login_id}/{rsproducts.id_products}/", "{rsproducts.product_image_illustrate}")) {
?>
                  <img src="<?php echo tNG_showDynamicImage("../", "../uploads/products/{SESSION.kt_login_id}/{rsproducts.id_products}/", "{rsproducts.product_image_illustrate}");?>" width="100px" height="100px" align="right"/>
                  <?php } 
// EndIf File Exists (region4)
?>            </td>
          </tr>
          <tr>
            <td width="100"><label for="product_short_describe_EN_<?php echo $cnt1; ?>">Short describe:</label></td>
            <td><input name="product_short_describe_EN_<?php echo $cnt1; ?>" type="text" id="product_short_describe_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproducts['product_short_describe_EN']); ?>" size="100" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("product_short_describe_EN");?> <?php echo $tNGs->displayFieldError("products", "product_short_describe_EN", $cnt1); ?> </td>
          </tr>
         
          <tr>
            <td colspan="2">Nội dung:</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="product_content_EN_<?php echo $cnt1; ?>" id="product_content_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsproducts['product_content_EN']); ?></textarea>
               
              <script>
    var oEdit2 = new InnovaEditor("oEdit2");

    /***************************************************
      SETTING EDITOR DIMENSION (WIDTH x HEIGHT)
    ***************************************************/

    oEdit2.width=735;//You can also use %, for example: oEdit2.width="100%"
    oEdit2.height=350;


    /***************************************************
      SHOWING DISABLED BUTTONS
    ***************************************************/

    oEdit2.btnPrint=true;
    oEdit2.btnPasteText=true;
    oEdit2.btnFlash=true;
    oEdit2.btnMedia=true;
    oEdit2.btnLTR=true;
    oEdit2.btnRTL=true;
    oEdit2.btnSpellCheck=true;
    oEdit2.btnStrikethrough=true;
    oEdit2.btnSuperscript=true;
    oEdit2.btnSubscript=true;
    oEdit2.btnClearAll=true;
    oEdit2.btnSave=true;
    oEdit2.btnStyles=true; //Show "Styles/Style Selection" button

    /***************************************************
      APPLYING STYLESHEET
      (Using external css file)
    ***************************************************/

    oEdit2.css="style/test.css"; //Specify external css file here

    /***************************************************
      APPLYING STYLESHEET
      (Using predefined style rules)
    ***************************************************/
    /*
    oEdit2.arrStyle = [["BODY",false,"","font-family:Verdana,Arial,Helvetica;font-size:x-small;"],
          [".ScreenText",true,"Screen Text","font-family:Tahoma;"],
          [".ImportantWords",true,"Important Words","font-weight:bold;"],
          [".Highlight",true,"Highlight","font-family:Arial;color:red;"]];

    If you'd like to set the default writing to "Right to Left", you can use:

    oEdit2.arrStyle = [["BODY",false,"","direction:rtl;unicode-bidi:bidi-override;"]];
    */


    /***************************************************
      ENABLE ASSET MANAGER ADD-ON
    ***************************************************/

    oEdit2.cmdAssetManager = "modalDialogShow('../Editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
    //Use relative to root path (starts with "/")

    /***************************************************
      ADDING YOUR CUSTOM LINK LOOKUP
    ***************************************************/

    oEdit2.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.

    /***************************************************
      ADDING YOUR CUSTOM CONTENT LOOKUP
    ***************************************************/

    oEdit2.cmdCustomObject = "modelessDialogShow('objects.htm',365,270)"; //Command to open your custom content lookup page.

    /***************************************************
      USING CUSTOM TAG INSERTION FEATURE
    ***************************************************/

    oEdit2.arrCustomTag=[["First Name","{%first_name%}"],
        ["Last Name","{%last_name%}"],
        ["Email","{%email%}"]];//Define custom tag selection

    /***************************************************
      SETTING COLOR PICKER's CUSTOM COLOR SELECTION
    ***************************************************/

    oEdit2.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors

    /***************************************************
      SETTING EDITING MODE

      Possible values:
        - "HTMLBody" (default)
        - "XHTMLBody"
        - "HTML"
        - "XHTML"
    ***************************************************/

    oEdit2.mode="XHTMLBody";


    oEdit2.REPLACE("product_content_EN_<?php echo $cnt1; ?>");
          </script>
				
			  <?php echo $tNGs->displayFieldHint("product_content_EN");?> <?php echo $tNGs->displayFieldError("products", "product_content_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="product_reference_price_<?php echo $cnt1; ?>">Reference price:</label></td>
            <td><input type="text" name="product_reference_price_<?php echo $cnt1; ?>" id="product_reference_price_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproducts['product_reference_price']); ?>" size="20" maxlength="20" />
               <?php echo $tNGs->displayFieldError("products", "product_reference_price", $cnt1); ?> &nbsp;&nbsp;
                <select name="product_rates_<?php echo $cnt1; ?>" id="product_rates_<?php echo $cnt1; ?>">
                  <label for="product_rates_<?php echo $cnt1; ?>">
                  <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                  </label>
                  <?php 
do {  
?>
                  <option value="<?php echo $row_rs_rates['id_rates']?>"<?php if (!(strcmp($row_rs_rates['id_rates'], $row_rsproducts['product_rates']))) {echo "SELECTED";} ?>><?php echo $row_rs_rates['rates_content']?></option>
                  <?php
} while ($row_rs_rates = mysql_fetch_assoc($rs_rates));
  $rows = mysql_num_rows($rs_rates);
  if($rows > 0) {
      mysql_data_seek($rs_rates, 0);
	  $row_rs_rates = mysql_fetch_assoc($rs_rates);
  }
?>
                </select>
                <?php echo $tNGs->displayFieldError("products", "product_rates", $cnt1); ?></td>
          </tr>
          <tr>
            <td width="100"><label for="product_unit_EN_<?php echo $cnt1; ?>">Unit:</label></td>
            <td><input type="text" name="product_unit_EN_<?php echo $cnt1; ?>" id="product_unit_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproducts['product_unit_EN']); ?>" size="32" />
                <?php echo $tNGs->displayFieldHint("product_unit_EN");?> <?php echo $tNGs->displayFieldError("products", "product_unit_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="product_type_<?php echo $cnt1; ?>">Product type:</label></td>
            <td><select name="product_type_<?php echo $cnt1; ?>" id="product_type_<?php echo $cnt1; ?>">
                <option value="product" <?php if (!(strcmp("product", KT_escapeAttribute($row_rsproducts['product_type'])))) {echo "SELECTED";} ?> selected="selected">product</option>
                <option value="sell" <?php if (!(strcmp("sell", KT_escapeAttribute($row_rsproducts['product_type'])))) {echo "SELECTED";} ?>>sell</option>
                <option value="buy" <?php if (!(strcmp("buy", KT_escapeAttribute($row_rsproducts['product_type'])))) {echo "SELECTED";} ?>>buy</option>
              </select>
                <?php echo $tNGs->displayFieldError("products", "product_type", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="product_payment_methods_orther_EN_<?php echo $cnt1; ?>">product_payment_methods_orther_EN:</label></td>
            <td><input name="product_payment_methods_orther_EN_<?php echo $cnt1; ?>" type="text" id="product_payment_methods_orther_EN_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproducts['product_payment_methods_orther_EN']); ?>" size="100" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("product_payment_methods_orther_EN");?> <?php echo $tNGs->displayFieldError("products", "product_payment_methods_orther_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label>Payment methods:</label></td>
            <td><table border="0" class="KT_mtm">
                <tr>
                  <?php
  $cnt2 = 0;
?>
                  <?php
  if ($totalRows_rsproducts>0) {
    $nested_query_rspayment_methods = str_replace("123456789", $row_rsproducts['id_products'], $query_rspayment_methods);
    mysql_select_db($database_ketnoi);
    $rspayment_methods = mysql_query($nested_query_rspayment_methods, $ketnoi) or die(mysql_error());
    $row_rspayment_methods = mysql_fetch_assoc($rspayment_methods);
    $totalRows_rspayment_methods = mysql_num_rows($rspayment_methods);
    $nested_sw = false;
    if (isset($row_rspayment_methods) && is_array($row_rspayment_methods)) {
      do { //Nested repeat
?>
                    <td><input id="mtm_<?php echo $row_rspayment_methods['id_payment_methods']; ?>_<?php echo $cnt1; ?>" name="mtm_<?php echo $row_rspayment_methods['id_payment_methods']; ?>_<?php echo $cnt1; ?>" type="checkbox" value="1" <?php if ($row_rspayment_methods['id_products'] != "") {?> checked<?php }?> />                    </td>
                    <td><label for="mtm_<?php echo $row_rspayment_methods['id_payment_methods']; ?>_<?php echo $cnt1; ?>"><?php echo $row_rspayment_methods['methods_name']; ?></label>                    </td>
                    <?php
	$cnt2++;
	if ($cnt2%3 == 0) {
		echo "</tr><tr>";
	}
?>
                    <?php
      } while ($row_rspayment_methods = mysql_fetch_assoc($rspayment_methods)); //Nested move next
    }
  }
?>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td width="100">Day update:</td>
            <td><?php echo KT_formatDate($row_rsproducts['product_day_update']); ?></td>
          </tr>
          <tr>
            <td width="100"><label for="product_showroom_<?php echo $cnt1; ?>">Showroom:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsproducts['product_showroom']),"1"))) {echo "checked";} ?> type="checkbox" name="product_showroom_<?php echo $cnt1; ?>" id="product_showroom_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("products", "product_showroom", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="100"><label for="product_visible_<?php echo $cnt1; ?>">Visible:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsproducts['product_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="product_visible_<?php echo $cnt1; ?>" id="product_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("products", "product_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_products_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsproducts['kt_pk_products']); ?>" />
        <input type="hidden" name="id_member_<?php echo $cnt1; ?>" id="id_member_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproducts['id_member']); ?>" />
        <?php } while ($row_rsproducts = mysql_fetch_assoc($rsproducts)); ?>
      <div>
        <div class="KT_topbuttons">
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_products'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_products')" />
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
</div>
</body>
</html>
<?php
mysql_free_result($rs_procat);

mysql_free_result($rs_prosubcat1);

mysql_free_result($rs_prosubcat2);

mysql_free_result($rs_prosubcat3);

mysql_free_result($rs_country);

mysql_free_result($rs_rates);

mysql_free_result($rspayment_methods);
?>