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

$get_id_member_rs_products = "1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_products = $_GET['imb'];
}
$get_id_products_rs_products = "1";
if (isset($_GET['ip'])) {
  $get_id_products_rs_products = $_GET['ip'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_products,id_member,country_name,country_name_EN,product_name, product_name_EN, product_short_describe, product_short_describe_EN, product_content, product_content_EN, product_image_illustrate, product_reference_price, product_rates, product_unit, product_unit_EN, product_payment_methods_orther, product_payment_methods_orther_EN,product_view FROM (products LEFT JOIN country ON products.id_country=country.id_country) WHERE id_member=%s AND products.id_products=%s AND product_visible = 1", GetSQLValueString($get_id_member_rs_products, "int"),GetSQLValueString($get_id_products_rs_products, "int"));
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

$get_id_products_rs_payment_methods_products = "7";
if (isset($_GET['ip'])) {
  $get_id_products_rs_payment_methods_products = $_GET['ip'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_payment_methods_products = sprintf("SELECT products.id_products,id_payment_methods_products,methods_name,methods_name_EN FROM ((payment_methods_products LEFT JOIN products ON payment_methods_products.id_products=products.id_products)LEFT JOIN payment_methods ON payment_methods_products.id_payment_methods=payment_methods.id_payment_methods) WHERE payment_methods_products.id_products=%s", GetSQLValueString($get_id_products_rs_payment_methods_products, "int"));
$rs_payment_methods_products = mysql_query($query_rs_payment_methods_products, $ketnoi) or die(mysql_error());
$row_rs_payment_methods_products = mysql_fetch_assoc($rs_payment_methods_products);
$totalRows_rs_payment_methods_products = mysql_num_rows($rs_payment_methods_products);

$maxRows_rs_images_library = 5;
$pageNum_rs_images_library = 0;
if (isset($_GET['pageNum_rs_images_library'])) {
  $pageNum_rs_images_library = $_GET['pageNum_rs_images_library'];
}
$startRow_rs_images_library = $pageNum_rs_images_library * $maxRows_rs_images_library;

$get_id_products_rs_images_library = "1";
if (isset($_GET['ip'])) {
  $get_id_products_rs_images_library = $_GET['ip'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_images_library = sprintf("SELECT il_image FROM images_library WHERE id_products=%s", GetSQLValueString($get_id_products_rs_images_library, "int"));
$query_limit_rs_images_library = sprintf("%s LIMIT %d, %d", $query_rs_images_library, $startRow_rs_images_library, $maxRows_rs_images_library);
$rs_images_library = mysql_query($query_limit_rs_images_library, $ketnoi) or die(mysql_error());
$row_rs_images_library = mysql_fetch_assoc($rs_images_library);

if (isset($_GET['totalRows_rs_images_library'])) {
  $totalRows_rs_images_library = $_GET['totalRows_rs_images_library'];
} else {
  $all_rs_images_library = mysql_query($query_rs_images_library);
  $totalRows_rs_images_library = mysql_num_rows($all_rs_images_library);
}
$totalPages_rs_images_library = ceil($totalRows_rs_images_library/$maxRows_rs_images_library)-1;

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_products.id_member}/{rs_products.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products.product_image_illustrate}");
$objDynamicThumb1->setResize(200, 160, true);
$objDynamicThumb1->setWatermark(false);
?>
<link href="../library/css/style-product.css" rel="stylesheet" type="text/css" />
<link href="../library/css/style_shop.css" rel="stylesheet" type="text/css" />
<link href="../library/css/style.css" rel="stylesheet" type="text/css" />
<link href="../library/css/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../library/css/style_buy_sale.css" rel="stylesheet" type="text/css" />
<div id="info-pro">
        	<div id="pro-lab"><label><?php echo $row_rs_products['product_name']; ?></label>
       	</div>
            <div id="pro1"> <img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" />
<center><div id="info-pro1">
                	
                  <label>Xem ảnh lớn</label>
              </div></center>
            <div id="info-pro12">
              <?php if ($totalRows_rs_images_library > 0) { // Show if recordset not empty ?>
                  <?php 
// Show If File Exists (region1)
if (tNG_fileExists("../uploads/products/images_library/{rs_products.id_products}/", "{rs_images_library.il_image}")) {
?>
                      <?php do { ?>
                        <input type="image" src="../uploads/products/images_library/<?php echo $row_rs_products['id_products'];?>/<?php echo $row_rs_images_library['il_image'];?>" width="35px" height="35px"/>
                        <?php } while ($row_rs_images_library = mysql_fetch_assoc($rs_images_library)); ?>
                    <?php } 
// EndIf File Exists (region1)
?>
<?php } // Show if recordset not empty ?>
</div>
  </div>
<div id="pro2">
           	  <table border="0">
					<tr>
                    	<td height="25" colspan="2" class="td1"><?php echo thongtinchitiet;?></td>            
                  	</tr>
                    <tr>
                    	<td width="40%" height="27" class="td2"><?php echo tensanpham;?>:</td>
                   	  	<td width="60%" height="25" class="td2"><?php echo $row_rs_products['product_name']; ?></td>
                	</tr>
                    <tr>
                    	<td width="40%" height="27" class="td2"><?php echo xuatxu;?>: </td>
                   	  <td width="60%" height="25" class="td2"><?php echo $row_rs_products['country_name']; ?></td>
                	</tr>
                    <tr>
                    	<td width="40%" height="27" class="td2"><?php echo giathamkhao;?>: </td>
                   	  <td width="60%" height="25" class="td2"><?php echo $row_rs_products['product_reference_price']; ?> <?php echo $row_rs_products['product_rates']; ?></td>
                	</tr>
                    <tr>
                    	<td width="40%" height="27" class="td2"><?php echo donvitinh;?>: </td>
                   	  <td width="60%" height="25" class="td2"><?php echo $row_rs_products['product_unit']; ?></td>
                	</tr>
                    <tr>
                    	<td width="40%" height="27" class="td2"><?php echo phuongthucthanhtoan;?>: </td>
                   	  <td width="60%" height="25" class="td2"><?php echo $row_rs_products['product_payment_methods_orther']; ?>
                          <?php 
// Show IF Conditional region2 
if (@$row_rs_payment_methods_products['id_products'] != "") {
?>
                            ,<?php echo $row_rs_payment_methods_products['methods_name']; ?>
  <?php } 
// endif Conditional region2
?>
</td>
                	</tr>
                    <tr>
                    	<td width="40%" height="27" class="td3"><?php echo luoctruycap;?>: </td>
                   	  <td width="60%" height="25" class="td3"><?php echo $row_rs_products['product_view']; ?></td>
               	</tr>
              </table>
          </div>
  </div>
  <div id="info-des">
            	<div id="info-des1"><label><?php echo mota;?></label></div>
                <div id="info-cont"><?php echo $row_rs_products['product_content']; ?></div>
  </div>
           
                  <?php
 					 mxi_includes_start("shop_sanphamcungloai.php");
 					 require(basename("shop_sanphamcungloai.php"));
 					 mxi_includes_end();
				?>

<?php
mysql_free_result($rs_products);

mysql_free_result($rs_payment_methods_products);

mysql_free_result($rs_images_library);
?>
