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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_products = 12;
$pageNum_rs_products = 0;
if (isset($_GET['pageNum_rs_products'])) {
  $pageNum_rs_products = $_GET['pageNum_rs_products'];
}
$startRow_rs_products = $pageNum_rs_products * $maxRows_rs_products;

$get_id_member_rs_products = "1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_products = $_GET['imb'];
}
$get_id_procat_rs_products = "1";
if (isset($_GET['ipc'])) {
  $get_id_procat_rs_products = $_GET['ipc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_products, id_procat,id_member, product_name, product_name_EN, product_image_illustrate FROM products WHERE id_procat=%s AND id_member=%s AND product_showroom=1 AND product_visible = 1 ORDER BY product_day_update ASC", GetSQLValueString($get_id_procat_rs_products, "int"),GetSQLValueString($get_id_member_rs_products, "int"));
$query_limit_rs_products = sprintf("%s LIMIT %d, %d", $query_rs_products, $startRow_rs_products, $maxRows_rs_products);
$rs_products = mysql_query($query_limit_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);

if (isset($_GET['totalRows_rs_products'])) {
  $totalRows_rs_products = $_GET['totalRows_rs_products'];
} else {
  $all_rs_products = mysql_query($query_rs_products);
  $totalRows_rs_products = mysql_num_rows($all_rs_products);
}
$totalPages_rs_products = ceil($totalRows_rs_products/$maxRows_rs_products)-1;

$get_id_procat_rs_procat = "-1";
if (isset($_GET['ipc'])) {
  $get_id_procat_rs_procat = $_GET['ipc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_procat = sprintf("SELECT procat_name, procat_name_EN FROM procat WHERE id_procat=%s", GetSQLValueString($get_id_procat_rs_procat, "int"));
$rs_procat = mysql_query($query_rs_procat, $ketnoi) or die(mysql_error());
$row_rs_procat = mysql_fetch_assoc($rs_procat);
$totalRows_rs_procat = mysql_num_rows($rs_procat);

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

$TFM_LimitLinksEndCount = 3;
$TFM_temp = $pageNum_rs_products + 1;
$TFM_startLink = max(1,$TFM_temp - intval($TFM_LimitLinksEndCount/2));
$TFM_temp = $TFM_startLink + $TFM_LimitLinksEndCount - 1;
$TFM_endLink = min($TFM_temp, $totalPages_rs_products + 1);
if($TFM_endLink != $TFM_temp) $TFM_startLink = max(1,$TFM_endLink - $TFM_LimitLinksEndCount + 1);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_products.id_member}/{rs_products.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?><div class="showcase">        	
  <h1><?php echo $row_rs_procat['procat_name']; ?></h1>
            <table border="0">
                	<tr>
                    
                          <?php
do { // horizontal looper version 3
?>
                          <td><a href="business/index.php?mod=detail&amp;ipc=<?php echo $get_id_procat_rs_products;?>&amp;ip=<?php echo $row_rs_products['id_products'];?>&amp;imb=<?php echo $get_id_member_rs_products;?>"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" />
                          <h2><?php echo $row_rs_products['product_name']; ?></h2>
                          </a> </td>
                            <?php
$row_rs_products = mysql_fetch_assoc($rs_products);
    if (!isset($nested_rs_products)) {
      $nested_rs_products= 1;
    }
    if (isset($row_rs_products) && is_array($row_rs_products) && $nested_rs_products++ % 4==0) {
      echo "</tr><tr>";
    }
  } while ($row_rs_products); //end horizontal looper version 3
?>
       	    </tr>
  </table>
           		
</div>
<div id="contact_2">
            		<div id="contact_3">
                    		<h2></h2>
                	</div>
                	<div id="contact_but">
                	  
  </div>
                	<div id="show-info">
               		  <h2> 
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
$TFM_Next = $pageNum_rs_products + 3;
$TFM_Last = $totalPages_rs_products+1;
if ($TFM_Next - 1 < $totalPages_rs_products) { 
  printf('...<a href="'."%s?pageNum_rs_products=%d%s", $currentPage, $TFM_Next, $queryString_rs_products.'">');
    echo "[Next "."3"." of ".$TFM_Last." pages] </a>...";
}
?></h2>
  </div>
</div>
<?php
mysql_free_result($rs_products);

mysql_free_result($rs_procat);
?>
