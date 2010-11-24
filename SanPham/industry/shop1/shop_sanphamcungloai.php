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
$get_id_products_rs_products_cungloai = "1";
if (isset($_GET['ip'])) {
  $get_id_products_rs_products_cungloai = $_GET['ip'];
}
$get_id_procat_rs_products_cungloai = "1";
if (isset($_GET['ipc'])) {
  $get_id_procat_rs_products_cungloai = $_GET['ipc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products_cungloai = sprintf("SELECT id_products, id_procat,id_member, product_name, product_name_EN, product_image_illustrate FROM products WHERE id_member=%s AND id_procat=%s AND id_products!=%s AND product_visible = 1 ORDER BY product_day_update DESC", GetSQLValueString($get_id_member_rs_products_cungloai, "int"),GetSQLValueString($get_id_procat_rs_products_cungloai, "int"),GetSQLValueString($get_id_products_rs_products_cungloai, "int"));
$rs_products_cungloai = mysql_query($query_rs_products_cungloai, $ketnoi) or die(mysql_error());
$row_rs_products_cungloai = mysql_fetch_assoc($rs_products_cungloai);
$totalRows_rs_products_cungloai = mysql_num_rows($rs_products_cungloai);

$get_id_member_rs_member = "1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_member = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member = sprintf("SELECT member_kind FROM member WHERE id_member=%s", GetSQLValueString($get_id_member_rs_member, "int"));
$rs_member = mysql_query($query_rs_member, $ketnoi) or die(mysql_error());
$row_rs_member = mysql_fetch_assoc($rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_products_cungloai.id_member}/{rs_products_cungloai.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products_cungloai.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?>
<?php if ($totalRows_rs_products_cungloai > 0) { // Show if recordset not empty ?>
<div class="showcase">     
      <div class="title_cungloai"><?php echo sanphamcungloai;?></div>
      <table border="0">
        <tr>
          
          <?php
  do { // horizontal looper version 3
?>
          <td><a href="<?php echo member_VIP($row_rs_member['member_kind']);?>/index.php?mod=detail&ipc=<?php echo $get_id_procat_rs_products_cungloai;?>&ip=<?php echo $row_rs_products_cungloai['id_products'];?>&imb=<?php echo $get_id_member_rs_products_cungloai;?>"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" />
              <h2 align="center"><?php echo $row_rs_products_cungloai['product_name']; ?></h2>
          </a></td>
            <?php
    $row_rs_products_cungloai = mysql_fetch_assoc($rs_products_cungloai);
    if (!isset($nested_rs_products_cungloai)) {
      $nested_rs_products_cungloai= 1;
    }
    if (isset($row_rs_products_cungloai) && is_array($row_rs_products_cungloai) && $nested_rs_products_cungloai++ % 4==0) {
      echo "</tr><tr>";
    }
  } while ($row_rs_products_cungloai); //end horizontal looper version 3
?>
                </tr>
      </table>
    <div class="cls_2"></div>
    </div>
    <?php } // Show if recordset not empty ?>
<?php
mysql_free_result($rs_products_cungloai);

mysql_free_result($rs_member);
?>
