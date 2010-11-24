<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

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

$get_id_member_rs_products_cungloai = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_products_cungloai = $_GET['imb'];
}
$get_id_sv_rs_products_cungloai = "1";
if (isset($_GET['isv'])) {
  $get_id_sv_rs_products_cungloai = $_GET['isv'];
}
$get_id_svcat_rs_products_cungloai = "1";
if (isset($_GET['isvc'])) {
  $get_id_svcat_rs_products_cungloai = $_GET['isvc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products_cungloai = sprintf("SELECT id_services, id_services_categories,sv.id_member, title, image_illustrate,short_describe FROM services AS sv,member AS mb WHERE sv.id_member=%s AND id_services_categories=%s AND sv.id_services!=%s AND sv.id_member=mb.id_member AND visible = 1 ORDER BY day_update DESC", GetSQLValueString($get_id_member_rs_products_cungloai, "int"),GetSQLValueString($get_id_svcat_rs_products_cungloai, "int"),GetSQLValueString($get_id_sv_rs_products_cungloai, "int"));
$rs_products_cungloai = mysql_query($query_rs_products_cungloai, $ketnoi) or die(mysql_error());
$row_rs_products_cungloai = mysql_fetch_assoc($rs_products_cungloai);
$totalRows_rs_products_cungloai = mysql_num_rows($rs_products_cungloai);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/services/{rs_products_cungloai.id_member}/");
$objDynamicThumb1->setRenameRule("{rs_products_cungloai.image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?>
<?php if ($totalRows_rs_products_cungloai > 0) { // Show if recordset not empty ?>
  <div class="showcase"> 
  <div class="title_cungloai"><?php echo dichvucungloai;?></div>
      <?php do { ?>
        <div class="box">
          <div class="box_2">
            <div class="img" style="width:98%; margin-left:10px;"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
  <h2><a href="<?php  echo member_VIP($row_rs_products_cungloai['member_kind']);?>/index.php?mod=svdetail&imb=<?php echo $row_rs_products_cungloai["id_member"];?>&amp;isvc=<?php echo $row_rs_products_cungloai['id_services_categories'];?>&isv=<?php echo $row_rs_products_cungloai['id_services'];?>"><?php echo $row_rs_products_cungloai['title'];?></a></h2>
              <label><?php echo $row_rs_products_cungloai['short_describe'];?></label>
            </div>
      </div>
            </div>
        <?php } while ($row_rs_products_cungloai = mysql_fetch_assoc($rs_products_cungloai)); ?><div class="cls_2"></div>
</div>
    <?php } // Show if recordset not empty ?>
<?php
mysql_free_result($rs_products_cungloai);
?>
