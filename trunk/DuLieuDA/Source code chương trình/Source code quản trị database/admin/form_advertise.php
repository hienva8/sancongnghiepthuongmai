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

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("title", true, "text", "", "", "", "Please ente advertise title.");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_Custom trigger
function Trigger_Custom(&$tNG) {
$startDate = $tNG -> getColumnValue("day_start");
$endDate = $tNG -> getColumnValue("day_end");
$diff = strtotime($endDate) - strtotime($startDate);
$remainDate = $diff/(60*60*24);
$tNG->addColumn("day_remain","NUMERIC_TYPE","EXPRESSION","$remainDate");
}
//end Trigger_Custom trigger

//start Trigger_FileDelete1 trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete1(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/advertisement/flashfile/");
  $deleteObj->setDbFieldName("fileflash");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete1 trigger

//start Trigger_FileUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileUpload(&$tNG) {
  $uploadObj = new tNG_FileUpload($tNG);
  $uploadObj->setFormFieldName("fileflash");
  $uploadObj->setDbFieldName("fileflash");
  $uploadObj->setFolder("../uploads/advertisement/flashfile/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("swf");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_FileUpload trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../uploads/advertisement/");
  $deleteObj->setDbFieldName("file_image");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("file_image");
  $uploadObj->setDbFieldName("file_image");
  $uploadObj->setFolder("../uploads/advertisement/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png, gif");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("sort");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_advertise = new tNG_multipleInsert($conn_ketnoi);
$tNGs->addTransaction($ins_advertise);
// Register triggers
$ins_advertise->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_advertise->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_advertise->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_advertise");
$ins_advertise->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
$ins_advertise->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$ins_advertise->registerTrigger("AFTER", "Trigger_FileUpload", 97);
$ins_advertise->registerTrigger("BEFORE", "Trigger_Custom", 50);
// Add columns
$ins_advertise->setTable("advertise");
$ins_advertise->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_advertise->addColumn("notes", "STRING_TYPE", "POST", "notes");
$ins_advertise->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$ins_advertise->addColumn("file_image", "FILE_TYPE", "FILES", "file_image");
$ins_advertise->addColumn("fileflash", "FILE_TYPE", "FILES", "fileflash");
$ins_advertise->addColumn("url", "STRING_TYPE", "POST", "url");
$ins_advertise->addColumn("day_update", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_advertise->addColumn("day_start", "DATE_TYPE", "POST", "day_start");
$ins_advertise->addColumn("day_end", "DATE_TYPE", "POST", "day_end");
$ins_advertise->addColumn("width", "NUMERIC_TYPE", "POST", "width");
$ins_advertise->addColumn("height", "NUMERIC_TYPE", "POST", "height");
$ins_advertise->addColumn("position", "STRING_TYPE", "POST", "position");
$ins_advertise->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible", "0");
$ins_advertise->setPrimaryKey("id_advertise", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_advertise = new tNG_multipleUpdate($conn_ketnoi);
$tNGs->addTransaction($upd_advertise);
// Register triggers
$upd_advertise->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_advertise->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_advertise->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_advertise");
$upd_advertise->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$upd_advertise->registerTrigger("AFTER", "Trigger_FileUpload", 97);
$upd_advertise->registerTrigger("BEFORE", "Trigger_Custom", 50);
// Add columns
$upd_advertise->setTable("advertise");
$upd_advertise->addColumn("title", "STRING_TYPE", "POST", "title");
$upd_advertise->addColumn("notes", "STRING_TYPE", "POST", "notes");
$upd_advertise->addColumn("notes_EN", "STRING_TYPE", "POST", "notes_EN");
$upd_advertise->addColumn("file_image", "FILE_TYPE", "FILES", "file_image");
$upd_advertise->addColumn("fileflash", "FILE_TYPE", "FILES", "fileflash");
$upd_advertise->addColumn("url", "STRING_TYPE", "POST", "url");
$upd_advertise->addColumn("day_update", "DATE_TYPE", "CURRVAL", "");
$upd_advertise->addColumn("day_start", "DATE_TYPE", "POST", "day_start");
$upd_advertise->addColumn("day_end", "DATE_TYPE", "POST", "day_end");
$upd_advertise->addColumn("width", "NUMERIC_TYPE", "POST", "width");
$upd_advertise->addColumn("height", "NUMERIC_TYPE", "POST", "height");
$upd_advertise->addColumn("position", "STRING_TYPE", "POST", "position");
$upd_advertise->addColumn("visible", "CHECKBOX_1_0_TYPE", "POST", "visible");
$upd_advertise->setPrimaryKey("id_advertise", "NUMERIC_TYPE", "GET", "id_advertise");

// Make an instance of the transaction object
$del_advertise = new tNG_multipleDelete($conn_ketnoi);
$tNGs->addTransaction($del_advertise);
// Register triggers
$del_advertise->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_advertise->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=list_advertise");
$del_advertise->registerTrigger("AFTER", "Trigger_FileDelete", 98);
$del_advertise->registerTrigger("AFTER", "Trigger_FileDelete1", 98);
// Add columns
$del_advertise->setTable("advertise");
$del_advertise->setPrimaryKey("id_advertise", "NUMERIC_TYPE", "GET", "id_advertise");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsadvertise = $tNGs->getRecordset("advertise");
$row_rsadvertise = mysql_fetch_assoc($rsadvertise);
$totalRows_rsadvertise = mysql_num_rows($rsadvertise);
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
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
<script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/Calendar.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/SmartDate.js"></script>
<script type="text/javascript" src="../includes/wdg/calendar/calendar_stripped.js"></script>
<script type="text/javascript" src="../includes/wdg/calendar/calendar-setup_stripped.js"></script>
<script src="../includes/resources/calendar.js"></script>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<div class="KT_tng">
  <h1>
    <?php 
// Show IF Conditional region1 
if (@$_GET['id_advertise'] == "") {
?>
      <?php echo NXT_getResource(them); ?>
      <?php 
// else Conditional region1
} else { ?>
      <?php echo NXT_getResource(capnhat); ?>
      <?php } 
// endif Conditional region1
?>
    <?php echo quangcao;?> </h1>
  <div class="KT_tngform">
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
      <?php $cnt1 = 0; ?>
      <?php do { ?>
        <?php $cnt1++; ?>
        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsadvertise > 1) {
?>
          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
          <?php } 
// endif Conditional region1
?>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <tr>
        <td class="KT_th" colspan="2"><label>
        <?php 
// Show If File Exists (region4)
if (tNG_fileExists("../uploads/advertisement/", "{rsadvertise.file_image}")) {
?>
          <img src="<?php echo tNG_showDynamicImage("../", "../uploads/advertisement/", "{rsadvertise.file_image}");?>" />
          <?php } 
// EndIf File Exists (region4)
?></label></td>
        </tr>
          <tr>
            <td class="KT_th"><label for="title_<?php echo $cnt1; ?>"><?php echo tieude;?> :</label></td>
            <td><input type="text" name="title_<?php echo $cnt1; ?>" id="title_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsadvertise['title']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("advertise", "title", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_<?php echo $cnt1; ?>"><?php echo ghichu;?> :</label></td>
            <td><textarea name="notes_<?php echo $cnt1; ?>" id="notes_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsadvertise['notes']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("notes");?> <?php echo $tNGs->displayFieldError("advertise", "notes", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="notes_EN_<?php echo $cnt1; ?>"><?php echo ghichutienganh;?> :</label></td>
            <td><textarea name="notes_EN_<?php echo $cnt1; ?>" id="notes_EN_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsadvertise['notes_EN']); ?></textarea>
                <?php echo $tNGs->displayFieldHint("notes_EN");?> <?php echo $tNGs->displayFieldError("advertise", "notes_EN", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="file_image_<?php echo $cnt1; ?>"><?php echo hinh;?> :</label></td>
            <td><input type="file" name="file_image_<?php echo $cnt1; ?>" id="file_image_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("advertise", "file_image", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="fileflash_<?php echo $cnt1; ?>"><?php echo fileflash;?> :</label></td>
            <td><input type="file" name="fileflash_<?php echo $cnt1; ?>" id="fileflash_<?php echo $cnt1; ?>" size="32" />
                <?php echo $tNGs->displayFieldError("advertise", "fileflash", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="url_<?php echo $cnt1; ?>"><?php echo duongdan;?> :</label></td>
            <td><input type="text" name="url_<?php echo $cnt1; ?>" id="url_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsadvertise['url']); ?>" size="32" maxlength="60" />
                <?php echo $tNGs->displayFieldHint("url");?> <?php echo $tNGs->displayFieldError("advertise", "url", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><?php echo ngaycapnhat;?> :</td>
            <td><?php echo KT_formatDate($row_rsadvertise['day_update']); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_start_<?php echo $cnt1; ?>"><?php echo ngaybatdau;?> :</label></td>
            <td><input name="day_start_<?php echo $cnt1; ?>" id="day_start_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsadvertise['day_start']); ?>" size="10" maxlength="22" wdg:mondayfirst="false" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="true" wdg:restricttomask="yes" />
                <?php echo $tNGs->displayFieldHint("day_start");?> <?php echo $tNGs->displayFieldError("advertise", "day_start", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="day_end_<?php echo $cnt1; ?>"><?php echo ngayketthuc;?> :</label></td>
            <td><input name="day_end_<?php echo $cnt1; ?>" id="day_end_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsadvertise['day_end']); ?>" size="10" maxlength="22" wdg:mondayfirst="false" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="true" wdg:restricttomask="yes" />
                <?php echo $tNGs->displayFieldHint("day_end");?> <?php echo $tNGs->displayFieldError("advertise", "day_end", $cnt1); ?> </td>
          </tr>
<tr>
            <td class="KT_th"><label for="width_<?php echo $cnt1; ?>"><?php echo chieurong;?> :</label></td>
            <td><input type="text" name="width_<?php echo $cnt1; ?>" id="width_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsadvertise['width']); ?>" size="7" />
                <?php echo $tNGs->displayFieldHint("width");?> <?php echo $tNGs->displayFieldError("advertise", "width", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="heigh_<?php echo $cnt1; ?>"><?php echo chieucao;?> :</label></td>
            <td><input type="text" name="heigh_<?php echo $cnt1; ?>" id="heigh_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsadvertise['height']); ?>" size="7" />
                <?php echo $tNGs->displayFieldHint("height");?> <?php echo $tNGs->displayFieldError("advertise", "height", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="position_<?php echo $cnt1; ?>"><?php echo vitri;?> :</label></td>
            <td><select name="position_<?php echo $cnt1; ?>" id="position_<?php echo $cnt1; ?>">
              <option value="top" <?php if (!(strcmp("top", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>top</option>
              <option value="left" <?php if (!(strcmp("left", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>left</option>
              <option value="right" <?php if (!(strcmp("right", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>right</option>
              <option value="bottom" <?php if (!(strcmp("bottom", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>bottom</option>
              <option value="mid1" <?php if (!(strcmp("mid1", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>mid1</option>
              <option value="mid2" <?php if (!(strcmp("mid2", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>mid2</option>
              <option value="product" <?php if (!(strcmp("product", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>product</option>
              <option value="buy" <?php if (!(strcmp("buy", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>buy</option>
              <option value="sell" <?php if (!(strcmp("sell", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>sell</option>
              <option value="business" <?php if (!(strcmp("business", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>business</option>
              <option value="services" <?php if (!(strcmp("services", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>Services</option>
              <option value="auction" <?php if (!(strcmp("auction", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>Auction</option>
              <option value="login" <?php if (!(strcmp("login", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>Login</option>
              <option value="ask" <?php if (!(strcmp("ask", KT_escapeAttribute($row_rsadvertise['position'])))) {echo "selected=\"selected\"";} ?>>Answer - Question</option>
            </select>
                <?php echo $tNGs->displayFieldError("advertise", "position", $cnt1); ?> </td>
          </tr>
          <tr>
            <td class="KT_th"><label for="visible_<?php echo $cnt1; ?>"><?php echo anhien;?> :</label></td>
            <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsadvertise['visible']),"1"))) {echo "checked";} ?> type="checkbox" name="visible_<?php echo $cnt1; ?>" id="visible_<?php echo $cnt1; ?>" value="1" />
                <?php echo $tNGs->displayFieldError("advertise", "visible", $cnt1); ?> </td>
          </tr>
        </table>
        <input type="hidden" name="kt_pk_advertise_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsadvertise['kt_pk_advertise']); ?>" />
        <?php } while ($row_rsadvertise = mysql_fetch_assoc($rsadvertise)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id_advertise'] == "") {
      ?>
            <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource(themmoi); ?>" />
            <?php 
      // else Conditional region1
      } else { ?>
            <div class="KT_operations">
              <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource(copyphienban); ?>" onclick="nxt_form_insertasnew(this, 'id_advertise')" />
            </div>
            <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource(capnhat); ?>" />
            <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource(xoa); ?>" onclick="return confirm('<?php echo NXT_getResource(dongyxoa); ?>');" />
            <?php }
      // endif Conditional region1
      ?>
          <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource(huybo); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
        </div>
      </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
</body>
</html>
