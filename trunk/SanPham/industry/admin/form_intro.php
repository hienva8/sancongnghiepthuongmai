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
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$ins_intro = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_intro);
// Register triggers
$ins_intro->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_intro->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_intro->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_intro");
// Add columns
$ins_intro->setTable("intro");
$ins_intro->addColumn("intro_content", "STRING_TYPE", "POST", "intro_content");
$ins_intro->addColumn("intro_content_EN", "STRING_TYPE", "POST", "intro_content_EN");
$ins_intro->addColumn("intro_day_update", "DATE_TYPE", "POST", "intro_day_update", "{NOW_DT}");
$ins_intro->addColumn("intro_visible", "CHECKBOX_1_0_TYPE", "POST", "intro_visible", "0");
$ins_intro->setPrimaryKey("id_intro", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_intro = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_intro);
// Register triggers
$upd_intro->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_intro->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_intro->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_intro");
// Add columns
$upd_intro->setTable("intro");
$upd_intro->addColumn("intro_content", "STRING_TYPE", "POST", "intro_content");
$upd_intro->addColumn("intro_content_EN", "STRING_TYPE", "POST", "intro_content_EN");
$upd_intro->addColumn("intro_day_update", "DATE_TYPE", "CURRVAL", "");
$upd_intro->addColumn("intro_visible", "CHECKBOX_1_0_TYPE", "POST", "intro_visible");
$upd_intro->setPrimaryKey("id_intro", "NUMERIC_TYPE", "GET", "id_intro");

// Make an instance of the transaction object
$del_intro = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_intro);
// Register triggers
$del_intro->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_intro->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_intro");
// Add columns
$del_intro->setTable("intro");
$del_intro->setPrimaryKey("id_intro", "NUMERIC_TYPE", "GET", "id_intro");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsintro = $tNGs->getRecordset("intro");
$row_rsintro = mysql_fetch_assoc($rsintro);
$totalRows_rsintro = mysql_num_rows($rsintro);
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
 <script type="text/javascript" src="../Editor/scripts/innovaeditor.js"></script>
</head>

<body>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_intro'] == "") {
?>
      <?php echo NXT_getResource("Insert_FH"); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource("Update_FH"); ?>
      <?php } 
// endif Conditional region1
?>
    Intro </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsintro > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td colspan="2"><label for="intro_content_<?php echo $cnt1; ?>"><?php echo noidung;?> :</label></td>
          </tr>
            <tr>
            <td colspan="2"><textarea name="intro_content_<?php echo $cnt1; ?>" id="intro_content_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsintro['intro_content']); ?></textarea>
            <script>
    var oEdit1 = new InnovaEditor("oEdit1");

    /***************************************************
      SETTING EDITOR DIMENSION (WIDTH x HEIGHT)
    ***************************************************/

    oEdit1.width=950;//You can also use %, for example: oEdit1.width="100%"
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


    oEdit1.REPLACE("intro_content_<?php echo $cnt1; ?>");
          </script>
                <?php echo $tNGs->displayFieldHint("intro_content");?> <?php echo $tNGs->displayFieldError("intro", "intro_content", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th" colspan="2"><label for="intro_content_EN_<?php echo $cnt1; ?>"><?php echo noidungtienganh;?> :</label></td>
            </tr>
            <tr>
            <td colspan="2"><textarea name="intro_content_EN_<?php echo $cnt1; ?>" id="intro_content_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsintro['intro_content_EN']); ?></textarea>
            <script>
    var oEdit2 = new InnovaEditor("oEdit2");

    /***************************************************
      SETTING EDITOR DIMENSION (WIDTH x HEIGHT)
    ***************************************************/

    oEdit2.width=950;//You can also use %, for example: oEdit2.width="100%"
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


    oEdit2.REPLACE("intro_content_EN_<?php echo $cnt1; ?>");
          </script>
                <?php echo $tNGs->displayFieldHint("intro_content_EN");?> <?php echo $tNGs->displayFieldError("intro", "intro_content_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td width="150"><label for="intro_day_update_<?php echo $cnt1; ?>"><?php echo ngaycapnhat;?> :</label></td>
            <td width="810"><?php echo KT_formatDate($row_rsintro['intro_day_update']); ?></td>
          </tr>
          <tr>
            <td width="150"><label for="intro_visible_<?php echo $cnt1; ?>"><?php echo anhien;?> :</label></td>
      <td width="810"><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsintro['intro_visible']),"1"))) {echo "checked";} ?> type="checkbox" name="intro_visible_<?php echo $cnt1; ?>" id="intro_visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("intro", "intro_visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_intro_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsintro['kt_pk_intro']); ?>" />
        <?php } while ($row_rsintro = mysql_fetch_assoc($rsintro)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_intro'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id_intro')" />
            </div>
            <input type="submit" name="KT_Update1" value="<?php echo capnhat; ?>" />
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
