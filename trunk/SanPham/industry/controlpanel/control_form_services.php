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

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_ketnoi, "../");
//Grand Levels: Any
$restrict->Execute();
//End Restrict Access To Page

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("title", true, "text", "", "", "", "Vui lòng nhập tiêu đề.");
$formValidation->addField("id_services_categories", true, "numeric", "", "", "", "Vui lòng chọn loại dịch vụ.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/services/{SESSION.kt_login_id}/");
  $deleteObj->setDbFieldName("image_illustrate");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("image_illustrate");
  $uploadObj->setDbFieldName("image_illustrate");
  $uploadObj->setFolder("../uploads/services/{SESSION.kt_login_id}/");
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
$query_rs_services_categories = "SELECT id_services_categories, svcat_name FROM services_categories WHERE svcat_visible = 1 ORDER BY svcat_sort ASC";
$rs_services_categories = mysql_query($query_rs_services_categories, $ketnoi) or die(mysql_error());
$row_rs_services_categories = mysql_fetch_assoc($rs_services_categories);
$totalRows_rs_services_categories = mysql_num_rows($rs_services_categories);

// Make an insert transaction instance
$ins_services = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_services);
// Register triggers
$ins_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_services->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lsv");
$ins_services->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_services->setTable("services");
$ins_services->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_services->addColumn("id_services_categories", "NUMERIC_TYPE", "POST", "id_services_categories");
$ins_services->addColumn("image_illustrate", "FILE_TYPE", "FILES", "image_illustrate");
$ins_services->addColumn("short_describe", "STRING_TYPE", "POST", "short_describe");
$ins_services->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_services->addColumn("day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_services->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "1");
$ins_services->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member", "{SESSION.kt_login_id}");
$ins_services->setPrimaryKey("id_services", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_services = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_services);
// Register triggers
$upd_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_services->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lsv");
$upd_services->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_services->setTable("services");
$upd_services->addColumn("title", "STRING_TYPE", "POST", "title");
$upd_services->addColumn("id_services_categories", "NUMERIC_TYPE", "POST", "id_services_categories");
$upd_services->addColumn("image_illustrate", "FILE_TYPE", "FILES", "image_illustrate");
$upd_services->addColumn("short_describe", "STRING_TYPE", "POST", "short_describe");
$upd_services->addColumn("content", "STRING_TYPE", "POST", "content");
$upd_services->addColumn("day_update", "DATE_TYPE", "CURRVAL", "");
$upd_services->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_services->addColumn("id_member", "NUMERIC_TYPE", "POST", "id_member");
$upd_services->setPrimaryKey("id_services", "NUMERIC_TYPE", "GET", "id_services");

// Make an instance of the transaction object
$del_services = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_services);
// Register triggers
$del_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=lsv");
$del_services->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_services->setTable("services");
$del_services->setPrimaryKey("id_services", "NUMERIC_TYPE", "GET", "id_services");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsservices = $tNGs->getRecordset("services");
$row_rsservices = mysql_fetch_assoc($rsservices);
$totalRows_rsservices = mysql_num_rows($rsservices);
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
  duplicate_buttons: false,
  show_as_grid: true,
  merge_down_value: true
}
</script>
<script type="text/javascript" src="../Editor/scripts/innovaeditor.js"></script>
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
if (@$totalRows_rsservices > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td><label for="title_<?php echo $cnt1; ?>">Tiêu đề:</label></td>
            <td><input type="text" name="title_<?php echo $cnt1; ?>" id="title_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['title']); ?>" size="50" maxlength="200" />
                <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("services", "title", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="id_services_categories_<?php echo $cnt1; ?>">Loại dịch vụ:</label></td>
            <td><select name="id_services_categories_<?php echo $cnt1; ?>" id="id_services_categories_<?php echo $cnt1; ?>">
              <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
              <?php 
do {  
?>
              <option value="<?php echo $row_rs_services_categories['id_services_categories']?>"<?php if (!(strcmp($row_rs_services_categories['id_services_categories'], $row_rsservices['id_services_categories']))) {echo "SELECTED";} ?>><?php echo $row_rs_services_categories['svcat_name']?></option>
              <?php
} while ($row_rs_services_categories = mysql_fetch_assoc($rs_services_categories));
  $rows = mysql_num_rows($rs_services_categories);
  if($rows > 0) {
      mysql_data_seek($rs_services_categories, 0);
	  $row_rs_services_categories = mysql_fetch_assoc($rs_services_categories);
  }
?>
            </select>
                <?php echo $tNGs->displayFieldError("services", "id_services_categories", $cnt1); ?> </td>
          </tr>
          <tr>
            <td><label for="image_illustrate_<?php echo $cnt1; ?>">Hình minh họa:</label></td>
            <td><input type="file" name="image_illustrate_<?php echo $cnt1; ?>" id="image_illustrate_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("services", "image_illustrate", $cnt1); ?> <?php 
// Show If File Exists (region3)
if (tNG_fileExists("../uploads/services/{SESSION.kt_login_id}/", "{rsservices.image_illustrate}")) {
?>
                  <img src="<?php echo tNG_showDynamicImage("../", "../uploads/services/{SESSION.kt_login_id}/", "{rsservices.image_illustrate}");?>" width="100" align="right" />
                  <?php } 
// EndIf File Exists (region3)
?></td>
          </tr>
          <tr>
            <td><label for="short_describe_<?php echo $cnt1; ?>">Mô tả ngắn:</label></td>
            <td><input type="text" name="short_describe_<?php echo $cnt1; ?>" id="short_describe_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['short_describe']); ?>" size="100" maxlength="255" />
                <?php echo $tNGs->displayFieldHint("short_describe");?> <?php echo $tNGs->displayFieldError("services", "short_describe", $cnt1); ?></td>
          </tr>
          <tr>
            <td colspan="2"><label for="content_<?php echo $cnt1; ?>">Nội dung:</label></td>
          </tr>
            <tr>
            <td colspan="2"><textarea name="content_<?php echo $cnt1; ?>" id="content_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsservices['content']); ?></textarea>
            <script>
    var oEdit1 = new InnovaEditor("oEdit1");

    /***************************************************
      SETTING EDITOR DIMENSION (WIDTH x HEIGHT)
    ***************************************************/

    oEdit1.width=735;//You can also use %, for example: oEdit1.width="100%"
    oEdit1.height=350;


    /***************************************************
      SHOWING DISABLED BUTTONS
    ***************************************************/

    oEdit1.btnPrint=true;
    oEdit1.btnPasteText=true;
    oEdit1.btnFlash=true;
    oEdit1.btnMedia=true;
    oEdit1.btnLTR=true;
    oEdit1.btnRTL=true;
    oEdit1.btnSpellCheck=true;
    oEdit1.btnStrikethrough=true;
    oEdit1.btnSuperscript=true;
    oEdit1.btnSubscript=true;
    oEdit1.btnClearAll=true;
    oEdit1.btnSave=true;
    oEdit1.btnStyles=true; //Show "Styles/Style Selection" button

    /***************************************************
      APPLYING STYLESHEET
      (Using external css file)
    ***************************************************/

    oEdit1.css="style/test.css"; //Specify external css file here

    /***************************************************
      APPLYING STYLESHEET
      (Using predefined style rules)
    ***************************************************/
    /*
    oEdit1.arrStyle = [["BODY",false,"","font-family:Verdana,Arial,Helvetica;font-size:x-small;"],
          [".ScreenText",true,"Screen Text","font-family:Tahoma;"],
          [".ImportantWords",true,"Important Words","font-weight:bold;"],
          [".Highlight",true,"Highlight","font-family:Arial;color:red;"]];

    If you'd like to set the default writing to "Right to Left", you can use:

    oEdit1.arrStyle = [["BODY",false,"","direction:rtl;unicode-bidi:bidi-override;"]];
    */


    /***************************************************
      ENABLE ASSET MANAGER ADD-ON
    ***************************************************/

    oEdit1.cmdAssetManager = "modalDialogShow('../Editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
    //Use relative to root path (starts with "/")

    /***************************************************
      ADDING YOUR CUSTOM LINK LOOKUP
    ***************************************************/

    oEdit1.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.

    /***************************************************
      ADDING YOUR CUSTOM CONTENT LOOKUP
    ***************************************************/

    oEdit1.cmdCustomObject = "modelessDialogShow('objects.htm',365,270)"; //Command to open your custom content lookup page.

    /***************************************************
      USING CUSTOM TAG INSERTION FEATURE
    ***************************************************/

    oEdit1.arrCustomTag=[["First Name","{%first_name%}"],
        ["Last Name","{%last_name%}"],
        ["Email","{%email%}"]];//Define custom tag selection

    /***************************************************
      SETTING COLOR PICKER's CUSTOM COLOR SELECTION
    ***************************************************/

    oEdit1.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors

    /***************************************************
      SETTING EDITING MODE

      Possible values:
        - "HTMLBody" (default)
        - "XHTMLBody"
        - "HTML"
        - "XHTML"
    ***************************************************/

    oEdit1.mode="XHTMLBody";


    oEdit1.REPLACE("content_<?php echo $cnt1; ?>");
          </script>
                <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("services", "content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td>Ngày đăng:</td>
            <td><?php echo KT_formatDate($row_rsservices['day_update']); ?></td>
          </tr>
          <tr>
            <td><label for="visible_<?php echo $cnt1; ?>">Ẩn/Hiện:</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsservices['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("services", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_services_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsservices['kt_pk_services']); ?>" />
        <input type="hidden" name="id_member_<?php echo $cnt1; ?>" id="id_member_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['id_member']); ?>" />
        <?php } while ($row_rsservices = mysql_fetch_assoc($rsservices)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_services'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_services')" />
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
mysql_free_result($rs_services_categories);
?>
