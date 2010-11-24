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

$get_procat_rs_products = "1";
if (isset($_GET['ipc'])) {
  $get_procat_rs_products = $_GET['ipc'];
}
$get_id_prosubcat2_rs_products = "1";
if (isset($_GET['ipsc2'])) {
  $get_id_prosubcat2_rs_products = $_GET['ipsc2'];
}
$get_id_prosubcat1_rs_products = "1";
if (isset($_GET['ipsc1'])) {
  $get_id_prosubcat1_rs_products = $_GET['ipsc1'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT products.id_products,id_procat,products.product_name,products.product_name_EN,products.product_short_describe,products.product_short_describe_EN,products.product_image_illustrate,products.id_member,member.member_kind,country.country_name,country.country_name_EN,country.country_image_illustrate FROM products,member,country WHERE products.id_member=member.id_member AND products.id_country=country.id_country AND products.product_type='buy' AND products.id_procat=%s AND products.id_prosubcat1=%s AND products.id_prosubcat2=%s", GetSQLValueString($get_procat_rs_products, "int"),GetSQLValueString($get_id_prosubcat1_rs_products, "int"),GetSQLValueString($get_id_prosubcat2_rs_products, "int"));
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
$objDynamicThumb1->setFolder("../../uploads/products/{rs_products.id_member}/{rs_products.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?>

<div id="cates-info">
        	<div class="contact">
            
            </div>
        	<h1>Chào mua</h1>
<?php if ($totalRows_rs_products > 0) { // Show if recordset not empty ?>          
    <?php do{ //print_r($row_rs_products);?>
<?php 
//lay du lieu bang company thong qua id thanh vien sau moi lan lap
$member = $row_rs_products["id_member"];

$query_rs_company ="SELECT company_name,company_name_EN FROM company WHERE company_id_member=$member";
$rs_company = mysql_query($query_rs_company,$ketnoi) or die(mysql_error());
$row_rs_company = mysql_fetch_assoc($rs_company);
?>
  <div class="box">
    <div class="check">
      <input type="checkbox" name="checkbox" id="c123" value="<?php echo $row_rs_products['products.id_product'];?>"/>
    </div>
    <div class="box_2">
      <div class="img"> <img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
<h2><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=detail&imb=<?php echo $row_rs_products["id_member"];?>&amp;ipc=<?php echo $row_rs_products['id_procat'];?>&ip=<?php echo $row_rs_products['id_products'];?>"><?php echo $row_rs_products['product_name'];?></a></h2>
            <label><?php echo $row_rs_products['product_short_describe'];?></label>
        </div>
<div class="c-info">
                  <h2><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=shop&imb=<?php echo $row_rs_products['id_member'];?>"><?php echo $row_rs_company["company_name"];?></a></h2>
           	        <?php if($row_rs_products['member_kind']=='VIP'){?>
<div class="box_3">	<img src="../../Interface/icon_3.gif" align="left"/>
                      <h3> Thành viên VIP</h3>
		  	        </div>
                    <?php }?>
<div class="box_3">	<img src="../../uploads/country_flag/<?php echo $row_rs_products['country_image_illustrate'];?>" align="left"/>
                      <h3><?php echo $row_rs_products['country_name'];?></h3>
		  	        </div>
                    <div class="but"><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=contact&imb=<?php echo $row_rs_products["id_member"];?>&amp;ip=<?php echo $row_rs_products['id_products']; ?>"><input type="image" src="../../Interface/contact.jpg"/></a></div>
            </div>                    
                    </div>
  </div>
<?php }while($row_rs_products=mysql_fetch_assoc($rs_products));?>  
<?php } else {echo "Hiện chưa có thông tin";} // Show if recordset not empty ?>        
            
<div id="contact_2">
            		<div id="contact_3">
                			<img src="../../Interface/icon_6.jpg" align="left" />
                    		<h2>Chọn</h2>
                	</div>
                	<div id="contact_but">
                		<input type="image" src="../../Interface/contact.jpg" />
                	</div>
                	<div id="show-info">
                		<h2>Hiển thị theo dạng: </h2>                	               
                    	<img src="../../Interface/icon_5.jpg" align="left" />
                    	<img src="../../Interface/icon_4.jpg" align="left" />
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