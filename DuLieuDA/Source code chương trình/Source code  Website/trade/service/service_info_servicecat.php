<?php require_once('../../Connections/ketnoi.php'); ?>
<?php
// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');
?>
<?php
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

$currentPage = $_SERVER["PHP_SELF"];

$get_id_cat_rs_products = "-1";
if (isset($_GET['isvc'])) {
  $get_id_cat_rs_products = $_GET['isvc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_services,sv.id_services_categories,sv.id_member,sv.image_illustrate,sv.title,sv.short_describe,mb.member_kind,ct.country_name,ct.country_name_EN,ct.country_image_illustrate,cp.company_name FROM services AS sv,member AS mb, country AS ct,company AS cp WHERE id_services_categories=%s AND sv.id_member=mb.id_member AND mb.member_id_country=ct.id_country AND mb.id_member=cp.company_id_member", GetSQLValueString($get_id_cat_rs_products, "int"));
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);


$queryString_rs_products = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_products") == false && 
        stristr($param, "totalRows_rs_products") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_products = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_products = sprintf("&totalRows_rs_products=%d%s", $totalRows_rs_products, $queryString_rs_products);

$TFM_LimitLinksEndCount = 10;
$TFM_temp = $pageNum_rs_products + 1;
$TFM_startLink = max(1,$TFM_temp - intval($TFM_LimitLinksEndCount/2));
$TFM_temp = $TFM_startLink + $TFM_LimitLinksEndCount - 1;
$TFM_endLink = min($TFM_temp, $totalPages_rs_products + 1);
if($TFM_endLink != $TFM_temp) $TFM_startLink = max(1,$TFM_endLink - $TFM_LimitLinksEndCount + 1);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../uploads/services/{rs_products.id_member}/");
$objDynamicThumb1->setRenameRule("{rs_products.image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?>

<div id="cates-info">
        	<div class="contact">
            
            </div>
        	<h1><?php echo sanpham;?></h1>
            <?php if ($totalRows_rs_products > 0) { // Show if recordset not empty ?>          
            <?php do{ ?>

  <div class="box">
    <div class="check">
      <input type="checkbox" name="service" id="c123" value="<?php echo $row_rs_products['id_services'];?>"/>
    </div>
    <div class="box_2">
      <div class="img"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
<h2><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=svdetail&imb=<?php echo $row_rs_products["id_member"];?>&isv=<?php echo $row_rs_products['id_services'];?>"><?php echo $row_rs_products['title'];?></a></h2>
            <label><?php echo $row_rs_products['short_describe'];?></label>
        </div>
<div class="c-info">
                  <h2><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=shop&imb=<?php echo $row_rs_products['id_member'];?>"><?php echo $row_rs_products["company_name"];?></a></h2>
           	        <?php if($row_rs_products['member_kind']=='VIP'){?>
                    <div class="box_3">	<img src="../../interface/icon_3.gif" align="right"/>
                      <h3><?php echo thanhvienvip;?></h3>
		  	        </div>
                    <?php }?>
                    <div class="box_3">	<img src="../../uploads/country_flag/<?php echo $row_rs_products['country_image_illustrate'];?>" align="left"/>
                      <h3><?php echo $row_rs_products['country_name'];?></h3>
		  	        </div>
                    <div class="but"><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=contact&imb=<?php echo $row_rs_products["id_member"];?>&amp;isv=<?php echo $row_rs_products['id_services']; ?>"><input type="image"  src="../../interface/contact.jpg" title="contact"/></a></div>
        </div>                    
      </div>
  </div>
<?php }while($row_rs_products=mysql_fetch_assoc($rs_products));?>  
<?php } else {echo hienchuacosanpham;} // Show if recordset not empty ?>        
            
<div id="contact_2">
            		<div id="contact_3">
                			<img src="../../interface/icon_6.jpg" align="left" />
                    		<h2>Chọn</h2>
                	</div>
                	<div id="contact_but">
                		<input type="image" src="../../interface/contact.jpg" />
                	</div>
                	<div id="show-info">
                		<h2>Hiển thị theo dạng: </h2>                	               
                    	<img src="../../interface/icon_5.jpg" align="left" />
                    	<img src="../../interface/icon_4.jpg" align="left" />
               	 	</div>
</div>
            	<div id="num_page">
            		<div id="page_1">
                		<h2>Trang  </h2>                    
               	  </div>
                	<div id="page_2">
                		<h2>&nbsp;
                		  <?php
$TFM_Previous = $pageNum_rs_products - 10;
if ($TFM_Previous >= 0) {
   printf('...<a href="'."%s?pageNum_rs_products=%d%s", $currentPage, $TFM_Previous, $queryString_rs_products.'">');
   echo "[Previous "."10"." pages] </a>...";
   //Basic-UltraDev Previous X pages SB
}
?>
                          <?php
for ($i = $TFM_startLink; $i <= $TFM_endLink; $i++) {
  $TFM_LimitPageEndCount = $i -1;
  if($TFM_LimitPageEndCount != $pageNum_rs_products) {
    printf('<a href="'."%s?pageNum_rs_products=%d%s", $currentPage, $TFM_LimitPageEndCount, $queryString_rs_products.'">');
    echo "$i</a>";
  }else{
    echo "<strong>$i</strong>";
  }
if($i != $TFM_endLink) echo(" | ");}
?>
                      <?php
$TFM_Next = $pageNum_rs_products + 10;
$TFM_Last = $totalPages_rs_products+1;
if ($TFM_Next - 1 < $totalPages_rs_products) { 
  printf('...<a href="'."%s?pageNum_rs_products=%d%s", $currentPage, $TFM_Next, $queryString_rs_products.'">');
    echo "[Next "."10"." of ".$TFM_Last." pages] </a>...";
}
?></h2>
               	  </div>
                	<div id="count_page">
                		<center><h2>Tổng số mẫu tin: <?php echo $totalRows_rs_products;?></h2></center>
                 	</div>
            	</div>
        </div>
<?php
mysql_free_result($rs_products);
?>