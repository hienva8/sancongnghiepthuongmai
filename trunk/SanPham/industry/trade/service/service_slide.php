<?php require_once('../../Connections/ketnoi.php'); ?>
<?php
// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

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
$query_rs_products = "SELECT p.id_products,p.product_name,p.product_name_EN,p.product_short_describe,p.product_short_describe_EN,p.product_image_illustrate,p.id_member,mb.member_kind,ct.country_name,ct.country_name_EN,ct.country_image_illustrate FROM products AS p,member AS mb,country AS ct WHERE p.id_member=mb.id_member AND mb.member_id_country=ct.id_country AND p.product_type='service' LIMIT 0,10";
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../uploads/products/{rs_products.id_member}/{rs_products.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?>
<?php if ($totalRows_rs_products > 0) { // Show if recordset not empty ?>
<div class="carousel main">
            <div class="jCarouselLite">
                <ul>
            <?php do{ //print_r($row_rs_products);?>
<?php 
//lay du lieu bang company thong qua id thanh vien sau moi lan lap
$member = $row_rs_products["id_member"];

$query_rs_company ="SELECT company_name,company_name_EN FROM company WHERE company_id_member=$member";
$rs_company = mysql_query($query_rs_company,$ketnoi) or die(mysql_error());
$row_rs_company = mysql_fetch_assoc($rs_company);
?>				
<li>
                    	<h2><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=detail&imb=<?php echo $row_rs_products['id_member'];?>&ip=<?php echo $row_rs_products['id_products'];?>"><?php echo $row_rs_products["product_name"];?></a></h2>
                        <div class="img-c">                          <img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
                          <label><?php echo $row_rs_products["product_short_describe"];?></label>
                        </div>
<?php if($row_rs_products["member_kind"]=='VIP'){?>
                       	<div class="info-c">
                        	<img src="../../Interface/icon_3.gif" width="15" align="left" />
                          <label>&nbsp;<?php echo thanhvienvip;?></label>
                        </div>
                        <?php }?>
                        <div class="info-c1">
                        	<img src="../../Interface/vietnam-icon.png" width="15" align="left" />
                          <label>&nbsp;<?php echo $row_rs_products["country_name"];?></label>
                        </div>
<div class="info-c2">
                        	<a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=contact&imb=<?php echo $row_rs_products["id_member"];?>"><input type="image" src="../../Interface/contact.jpg" width="90" height="15" /></a>
                        </div>
                  </li>
<?php }while($row_rs_products=mysql_fetch_assoc($rs_products));?>
                      
                </ul>
            </div>
  
</div>
<?php } else {echo hienchuacoloichao;} // Show if recordset not empty ?>                   
<?php
mysql_free_result($rs_products);
?>
