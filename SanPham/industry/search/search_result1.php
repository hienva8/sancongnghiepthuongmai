<?php require_once('../Connections/ketnoi.php'); ?>
<?php $searchstring=trim($_GET['key1']); // ham xoa khoang trang 2 ben cua chuoi?>
<?php 
function search_highlight($needle, $replace, $haystack)
{
  $haystack = eregi_replace($needle,$replace,$haystack); // ham thay the $needle == $replace trong chuoi $haystack
 return $haystack;
}
?>
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
///////////tim kiem chuoi voi array_search 
function search_array($str) 
{
	$array = array('Sản phẩm'=>'product','Chào bán'=>'sell','Chào mua'=>'buy');
	$khoa  = array_search($str,$array);
	return $khoa;
}
//////////////////
$key2_rs_search = "-1";
if (isset($_GET['key2'])) {
  $key2_rs_search = $_GET['key2'];
}
$key1_khongdau_rs_search = "-1";
if (isset($_GET['key1'])) {
  $keyword1 = $_GET['key1'];
  $key1_khongdau_rs_search = trim(mb_strtolower(stripVietName($keyword1),'utf-8'));
}
$key1_rs_search = "-1";
if (isset($_GET['key1'])) {
  $keyword2 = $_GET['key1'];
  $key1_rs_search = trim(mb_strtolower($keyword2,'utf-8'));
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_search = sprintf("SELECT id_products, p.id_country,p. id_member, product_name, product_short_describe, product_image_illustrate,mb.member_kind,ct.country_name,country_image_illustrate,cp.company_name FROM products AS p,member AS mb,country AS ct,company AS cp WHERE product_type=%s AND (LOWER(CONVERT(product_name USING utf8)) LIKE %s OR LOWER(CONVERT(product_short_describe USING utf8)) LIKE %s  OR LOWER(CONVERT(product_name USING utf8)) LIKE %s OR LOWER(CONVERT(product_short_describe USING utf8)) LIKE %s) AND product_visible =1 AND p.id_member=mb.id_member AND mb.member_id_country=ct.id_country AND mb.id_member=cp.company_id_member", GetSQLValueString($key2_rs_search, "text"),GetSQLValueString("%" . $key1_rs_search . "%", "text"),GetSQLValueString("%" . $key1_rs_search . "%", "text"),GetSQLValueString("%" . $key1_khongdau_rs_search . "%", "text"),GetSQLValueString("%" . $key1_khongdau_rs_search . "%", "text"));
$rs_search = mysql_query($query_rs_search, $ketnoi) or die(mysql_error());
$row_rs_search = mysql_fetch_assoc($rs_search);
$totalRows_rs_search = mysql_num_rows($rs_search);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_search.id_member}/{rs_search.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_search.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?><link href="../library/CSS/style.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style_buy_sale.css" rel="stylesheet" type="text/css" />
<link href="../library/CSS/style-slide.css" rel="stylesheet" type="text/css" />
<div class="right-center">
    	<div class="bor_1">
       	  <img src="../interface/home-1.jpg" width="16" height="16" />&nbsp;<span class="st_1"><a href="#">Home</a>&nbsp;<b> ></b>&nbsp; <?php echo timkiem;?></span>
          &nbsp;-&nbsp;<?php echo ketquatimkiem;?>: <?php echo $totalRows_rs_search;?>
        </div>
  <div class="cates"></div>
<div id="cates-info">
        	<div class="contact">
            
            </div>
        	<h1><?php echo search_array($key2_rs_search); ?></h1>
            
             <?php 
// Show IF Conditional region1 
if (@$totalRows_rs_search > 0) {
?>
            	<?php do { ?>
            	   
            	      <div class="box">
            	        <div class="check">
            	          <input type="checkbox" name="checkbox" id="c123" value="123"/>
           	            </div>
              	    <div class="box_2">
              	      <div class="img"> <img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
              	        <h2><a href="../shop/<?php echo member_VIP($row_rs_search['member_kind']);?>/index.php?mod=detail&amp;imb=<?php echo $row_rs_search['id_member'];?>&amp;ip=<?php echo $row_rs_search['id_products'];?>"><?php echo search_highlight($searchstring,"<span style='background-color:#FFFFCC'><b>$searchstring</b></span>",$row_rs_search['product_name']); ?></a></h2>
                          <label><?php echo search_highlight($searchstring,"<span style='background-color:#FFFFCC'><b>$searchstring</b></span>",$row_rs_search['product_short_describe']); ?></label>
           	          </div>
                        <div class="c-info">
                          <h2><a href="#"><?php echo $row_rs_search['company_name']; ?></a></h2>
                      	    <div class="box_3">
                      	      <img src="../interface/icon_3.gif" align="left"/>
                      	      <h3><?php echo thanhvienvip;?></h3>
   				  	      </div>
                       	    <div class="box_3">	<img src="../uploads/country_flag/<?php echo $row_rs_search['country_image_illustrate']; ?>"  align="left"/>
                       	      <h3><?php echo $row_rs_search['country_name']; ?></h3>
       				  	    </div>
                            <div class="but"><input type="image" src="../interface/contact.jpg"/></div>
                        </div>                    
                  </div>
                          </div>
                           <?php } while ($row_rs_search = mysql_fetch_assoc($rs_search)); ?>
            	      <?php 
// else Conditional region1
} else { ?>
            <?php echo khongtimthay; ?>	     
  <?php } 
// endif Conditional region1
?>
            	   <div id="contact_2">
            	<div id="contact_3">
               	  <img src="../interface/icon_6.jpg" align="left" />
                  <h2>Chọn</h2>
                </div>
                <div id="contact_but">
               	  <input type="image" src="../interface/contact.jpg" />
                </div>
                <div id="show-info">
               	  <h2>Hiển thị theo dạng: </h2>                	               
                  <img src="../interface/icon_5.jpg" align="left" />
                  <img src="../interface/icon_4.jpg" align="left" />
                </div>
            </div>
            <div id="num_page">
           	  <div id="page_1">
               	<h2>Trang 1/196 </h2>                    
                </div>
                <div id="page_2">
               	  <h2>Đầu << 1 | 2 | 3 | 4 | 6 | 7 | 8 >> Cuối </h2>
                </div>
                <div id="count_page">
               	  <center><h2>Tổng số mẫu tin: 196</h2></center>
                    
                </div>
            </div>
  </div>
</div>
<?php
mysql_free_result($rs_search);
?>