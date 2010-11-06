<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("mbpro_id_industry", true, "numeric", "", "", "", "Vui lòng chọn lĩnh vực hoạt động.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("mbpro_avatar");
  $uploadObj->setDbFieldName("mbpro_avatar");
  $uploadObj->setFolder("../uploads/avatar/{SESSION.kt_login_id}/");
  $uploadObj->setResize("true", 100, 0);
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
$query_rs_industry = "SELECT id_industry, industry_name FROM industry ORDER BY sort ASC";
$rs_industry = mysql_query($query_rs_industry, $ketnoi) or die(mysql_error());
$row_rs_industry = mysql_fetch_assoc($rs_industry);
$totalRows_rs_industry = mysql_num_rows($rs_industry);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_authorized_capital = "SELECT id_capital_revenue, cr_content FROM capital_revenue ORDER BY sort ASC";
$rs_authorized_capital = mysql_query($query_rs_authorized_capital, $ketnoi) or die(mysql_error());
$row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital);
$totalRows_rs_authorized_capital = mysql_num_rows($rs_authorized_capital);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_authorized_capital1 = "SELECT id_capital_revenue, cr_content FROM capital_revenue ORDER BY sort ASC";
$rs_authorized_capital1 = mysql_query($query_rs_authorized_capital1, $ketnoi) or die(mysql_error());
$row_rs_authorized_capital1 = mysql_fetch_assoc($rs_authorized_capital1);
$totalRows_rs_authorized_capital1 = mysql_num_rows($rs_authorized_capital1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export = "SELECT id_import_export, content FROM import_export ORDER BY sort ASC";
$rs_import_export = mysql_query($query_rs_import_export, $ketnoi) or die(mysql_error());
$row_rs_import_export = mysql_fetch_assoc($rs_import_export);
$totalRows_rs_import_export = mysql_num_rows($rs_import_export);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_import_export1 = "SELECT id_import_export, content FROM import_export ORDER BY sort ASC";
$rs_import_export1 = mysql_query($query_rs_import_export1, $ketnoi) or die(mysql_error());
$row_rs_import_export1 = mysql_fetch_assoc($rs_import_export1);
$totalRows_rs_import_export1 = mysql_num_rows($rs_import_export1);

$colname_rs_member1 = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member1 = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member1 = sprintf("SELECT id_member, member_id_country, member_name, member_sex, member_email, member_address, member_tell, member_fax,country_name FROM member,country WHERE id_member = %s AND member_id_country=id_country", GetSQLValueString($colname_rs_member1, "int"));
$rs_member1 = mysql_query($query_rs_member1, $ketnoi) or die(mysql_error());
$row_rs_member1 = mysql_fetch_assoc($rs_member1);
$totalRows_rs_member1 = mysql_num_rows($rs_member1);

// Make an update transaction instance
$upd_member_profile = new tNG_update($conn_ketnoi);
$tNGs->addTransaction($upd_member_profile);
// Register triggers
$upd_member_profile->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_member_profile->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_member_profile->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=fmbprofile");
$upd_member_profile->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_member_profile->setTable("member_profile");
$upd_member_profile->addColumn("mbpro_avatar", "FILE_TYPE", "FILES", "mbpro_avatar");
$upd_member_profile->addColumn("mbpro_year_active", "STRING_TYPE", "POST", "mbpro_year_active");
$upd_member_profile->addColumn("mbpro_id_industry", "NUMERIC_TYPE", "POST", "mbpro_id_industry");
$upd_member_profile->addColumn("mbpro_authorized_capital_EN", "STRING_TYPE", "POST", "mbpro_authorized_capital_EN");
$upd_member_profile->addColumn("mbpro_yearly_revenue_EN", "STRING_TYPE", "POST", "mbpro_yearly_revenue_EN");
$upd_member_profile->addColumn("mbpro_export_rates", "STRING_TYPE", "POST", "mbpro_export_rates");
$upd_member_profile->addColumn("mbpro_import_ratio", "STRING_TYPE", "POST", "mbpro_import_ratio");
$upd_member_profile->addColumn("mbpro_main_product_EN", "STRING_TYPE", "POST", "mbpro_main_product_EN");
$upd_member_profile->addColumn("mbpro_main_markets_orther_EN", "STRING_TYPE", "POST", "mbpro_main_markets_orther_EN");
$upd_member_profile->addColumn("mbpro_shortinfo_EN", "STRING_TYPE", "POST", "mbpro_shortinfo_EN");
$upd_member_profile->addColumn("mbpro_info_EN", "STRING_TYPE", "POST", "mbpro_info_EN");
$upd_member_profile->addColumn("mbpro_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_member_profile->addColumn("mbpro_visible", "CHECKBOX_1_0_TYPE", "POST", "mbpro_visible");
$upd_member_profile->setPrimaryKey("mbpro_id_member", "NUMERIC_TYPE", "SESSION", "kt_login_id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsmember_profile = $tNGs->getRecordset("member_profile");
$row_rsmember_profile = mysql_fetch_assoc($rsmember_profile);
$totalRows_rsmember_profile = mysql_num_rows($rsmember_profile);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<script type="text/javascript" src="../Editor/scripts/innovaeditor.js"></script>
<?php echo $tNGs->displayValidationRules();?>
<style>
label {
width:50px;
float:left;
}
</style>
</head>

<body>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
  <tr>
      <td width="20%"><label><?php echo hoten;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['member_name']; ?></td>
    </tr>
     <tr>
      <td width="20%"><label><?php echo quoctich;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['country_name']; ?></td>
    </tr>
     <tr>
      <td width="20%"><label><?php echo gioitinh;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['member_sex']; ?></td>
    </tr>
     <tr>
      <td width="20%"><label><?php echo diachi;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['member_address']; ?></td>
    </tr>
     <tr>
      <td width="20%"><label><?php echo email;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['member_email']; ?></td>
    </tr>
     <tr>
      <td width="20%"><label><?php echo dienthoai;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['member_tell']; ?></td>
    </tr>
     <tr>
      <td width="20%"><label><?php echo fax;?> :</label></td>
      <td width="80%"><?php echo $row_rs_member1['member_fax']; ?></td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_avatar"><?php echo hinhdaidien;?> :</label></td>
<td width="80%"><input type="file" name="mbpro_avatar" id="mbpro_avatar" size="32" />
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_avatar"); ?> <img src="<?php echo tNG_showDynamicImage("../", "../uploads/avatar/{rsmember_profile.mbpro_id_member}/", "{rsmember_profile.mbpro_avatar}");?>" align="right" /></td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_year_active"><?php echo namhoatdong;?> :</label></td>
      <td width="80%"><select name="mbpro_year_active" id="mbpro_year_active">
        <option value="" ><?php echo nam;?>...</option>
        <?php for($i=date('Y');$i>=1900;$i--){ ?>
        <option value="<?php echo $i;?>" <?php if (!(strcmp($i, KT_escapeAttribute($row_rsmember_profile['mbpro_year_active'])))) {echo "SELECTED";} ?>><?php echo $i;?></option>
        <?php }?>

      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_year_active"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_id_industry"><?php echo congnghiep;?>:</label></td>
      <td width="80%"><select name="mbpro_id_industry" id="mbpro_id_industry">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_industry['id_industry']?>"<?php if (!(strcmp($row_rs_industry['id_industry'], $row_rsmember_profile['mbpro_id_industry']))) {echo "SELECTED";} ?>><?php echo $row_rs_industry['industry_name']?></option>
        <?php
} while ($row_rs_industry = mysql_fetch_assoc($rs_industry));
  $rows = mysql_num_rows($rs_industry);
  if($rows > 0) {
      mysql_data_seek($rs_industry, 0);
	  $row_rs_industry = mysql_fetch_assoc($rs_industry);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_id_industry"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_authorized_capital_EN"><?php echo vondautu;?> :</label></td>
      <td width="80%"><select name="mbpro_authorized_capital_EN" id="mbpro_authorized_capital_EN">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_authorized_capital['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_authorized_capital['id_capital_revenue'], $row_rsmember_profile['mbpro_authorized_capital_EN']))) {echo "SELECTED";} ?>><?php echo $row_rs_authorized_capital['cr_content']?></option>
        <?php
} while ($row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital));
  $rows = mysql_num_rows($rs_authorized_capital);
  if($rows > 0) {
      mysql_data_seek($rs_authorized_capital, 0);
	  $row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_authorized_capital_EN"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_yearly_revenue_EN"><?php echo doanhthuhangnam;?> :</label></td>
      <td width="80%"><select name="mbpro_yearly_revenue_EN" id="mbpro_yearly_revenue_EN">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_authorized_capital['id_capital_revenue']?>"<?php if (!(strcmp($row_rs_authorized_capital['id_capital_revenue'], $row_rsmember_profile['mbpro_yearly_revenue_EN']))) {echo "SELECTED";} ?>><?php echo $row_rs_authorized_capital['cr_content']?></option>
        <?php
} while ($row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital));
  $rows = mysql_num_rows($rs_authorized_capital);
  if($rows > 0) {
      mysql_data_seek($rs_authorized_capital, 0);
	  $row_rs_authorized_capital = mysql_fetch_assoc($rs_authorized_capital);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_yearly_revenue_EN"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_export_rates"><?php echo tilexuatkhau;?> :</label></td>
      <td width="80%"><select name="mbpro_export_rates" id="mbpro_export_rates">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rsmember_profile['mbpro_export_rates']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export['content']?></option>
        <?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_export_rates"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_import_ratio"><?php echo tilenhapkhau;?> :</label></td>
      <td width="80%"><select name="mbpro_import_ratio" id="mbpro_import_ratio">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_import_export['id_import_export']?>"<?php if (!(strcmp($row_rs_import_export['id_import_export'], $row_rsmember_profile['mbpro_import_ratio']))) {echo "SELECTED";} ?>><?php echo $row_rs_import_export['content']?></option>
        <?php
} while ($row_rs_import_export = mysql_fetch_assoc($rs_import_export));
  $rows = mysql_num_rows($rs_import_export);
  if($rows > 0) {
      mysql_data_seek($rs_import_export, 0);
	  $row_rs_import_export = mysql_fetch_assoc($rs_import_export);
  }
?>
      </select>
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_import_ratio"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_main_product_EN"><?php echo sanphamchinh;?> :</label></td>
<td width="80%"><input type="text" name="mbpro_main_product_EN" id="mbpro_main_product_EN" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_main_product_EN']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("mbpro_main_product_EN");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_main_product_EN"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_main_markets_orther_EN"><?php echo thitruongkhac;?> :</label></td>
<td width="80%"><input type="text" name="mbpro_main_markets_orther_EN" id="mbpro_main_markets_orther_EN" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_main_markets_orther_EN']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("mbpro_main_markets_orther_EN");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_main_markets_orther_EN"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_shortinfo_EN"><?php echo gioithieungan;?> :</label></td>
<td width="80%"><input type="text" name="mbpro_shortinfo_EN" id="mbpro_shortinfo_EN" value="<?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_shortinfo_EN']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("mbpro_shortinfo_EN");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_shortinfo_EN"); ?> </td>
    </tr>
    <tr>
      <td colspan="2"><label for="mbpro_info_EN"><?php echo gioithieu;?> :</label></td>
      </tr>
      <tr>
      <td colspan="2"><textarea name="mbpro_info_EN" id="mbpro_info_EN" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsmember_profile['mbpro_info_EN']); ?></textarea>
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


    oEdit1.REPLACE("mbpro_info_EN");
          </script>

          <?php echo $tNGs->displayFieldHint("mbpro_info_EN");?> <?php echo $tNGs->displayFieldError("member_profile", "mbpro_info_EN"); ?> </td>
    </tr>
    <tr>
      <td width="20%"><?php echo ngaycapnhat;?> :</td>
      <td width="80%"><?php echo KT_formatDate($row_rsmember_profile['mbpro_day_update']); ?></td>
    </tr>
    <tr>
      <td width="20%"><label for="mbpro_visible"><?php echo anhien;?> :</label></td>
<td width="80%"><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsmember_profile['mbpro_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="mbpro_visible" id="mbpro_visible" value="1" />
          <?php echo $tNGs->displayFieldError("member_profile", "mbpro_visible"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Update1" id="KT_Update1" value="<?php echo capnhat;?>" />      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($rs_industry);

mysql_free_result($rs_authorized_capital);

mysql_free_result($rs_authorized_capital1);

mysql_free_result($rs_import_export);

mysql_free_result($rs_import_export1);

mysql_free_result($rs_member1);
?>
