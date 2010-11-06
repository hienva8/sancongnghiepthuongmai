<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

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

$get_id_member_rs_products = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_products = $_GET['imb'];
}
$get_id_sv_rs_products = "-1";
if (isset($_GET['isv'])) {
  $get_id_sv_rs_products = $_GET['isv'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_services,sv.id_services_categories,sv.id_member,title,image_illustrate,content,view,sv.day_update,country_name,view,svcat_name FROM services AS sv,member AS mb,country AS ct,services_categories AS svc WHERE sv.id_member=%s AND id_services=%s AND sv.id_services_categories=svc.id_services_categories AND visible = 1", GetSQLValueString($get_id_member_rs_products, "int"),GetSQLValueString($get_id_sv_rs_products, "int"));
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_products.id_member}/{rs_products.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products.product_image_illustrate}");
$objDynamicThumb1->setResize(200, 160, true);
$objDynamicThumb1->setWatermark(false);
?>
<link href="../library/css/style-product.css" rel="stylesheet" type="text/css" />

<div id="info-pro">
        <div id="pro-lab"><label><?php echo $row_rs_products['title']; ?></label></div>
        <div id="info-cont"><?php echo $row_rs_products['content']; ?></div>
            </div>
<div id="info-des">
                
</div>	
                  <?php
 					mxi_includes_start("shop_dichvucungloai.php");
 				    require(basename("shop_dichvucungloai.php"));
 					mxi_includes_end();
				?>

<?php
mysql_free_result($rs_products);
?>
