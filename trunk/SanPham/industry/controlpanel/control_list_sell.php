<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_ketnoi, "../");
//Grand Levels: Any
$restrict->Execute();
//End Restrict Access To Page

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

$maxRows_rs_products = 10;
$pageNum_rs_products = 0;
if (isset($_GET['pageNum_rs_products'])) {
  $pageNum_rs_products = $_GET['pageNum_rs_products'];
}
$startRow_rs_products = $pageNum_rs_products * $maxRows_rs_products;

$session_member_rs_products = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $session_member_rs_products = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_products,id_member,product_name,product_name_EN, product_image_illustrate, product_day_update FROM products WHERE id_member = %s AND product_type='sell' ORDER BY product_day_update DESC", GetSQLValueString($session_member_rs_products, "int"));
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

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_products.id_member}/{rs_products.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_products.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);

$TFM_LimitLinksEndCount = 3;
$TFM_temp = $pageNum_rs_products + 1;
$TFM_startLink = max(1,$TFM_temp - intval($TFM_LimitLinksEndCount/2));
$TFM_temp = $TFM_startLink + $TFM_LimitLinksEndCount - 1;
$TFM_endLink = min($TFM_temp, $totalPages_rs_products + 1);
if($TFM_endLink != $TFM_temp) $TFM_startLink = max(1,$TFM_endLink - $TFM_LimitLinksEndCount + 1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/CSS/style_controlpanel.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table id="customers">
<tr>
  <th><?php echo sothutu;?></th>
  <th><?php echo tieude_VN;?></th>
  <th><?php echo tieude_EN;?></th>
  <th><?php echo hinh;?></th>
  <th><?php echo ngaydang;?></th>
  <th><?php echo thaotac;?></th>
</tr>
<?php $i=0; ?>
<?php do { $i++;?>
<?php if ($totalRows_rs_products > 0) { // Show if recordset not empty ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row_rs_products['product_name']; ?></td>
        <td><?php echo $row_rs_products['product_name_EN']; ?></td>
    <td><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" /></td>
    <td><?php echo date('d-m-Y | h:s',strtotime($row_rs_products['product_day_update'])); ?></td>
    <td><a href="index.php?mod=fs&amp;id_products=<?php echo $row_rs_products['id_products'];?>"><?php echo sua; ?></a> | <a  href="index.php?mod=dels&amp;ip=<?php echo $row_rs_products['id_products'];?>" onclick="if(!window.confirm('<?php echo bancomuonxoasanphamnay;?>')){return false;};"><?php echo xoa;?></a></td>
  </tr>
  <?php } // Show if recordset not empty ?>

<?php } while ($row_rs_products = mysql_fetch_assoc($rs_products)); ?>
<?php if ($totalRows_rs_products == 0) { // Show if recordset empty ?>
  <tr>
    <td colspan="6" align="center"><?php echo hienchuacosanpham;?></td>
  </tr>
  <?php } // Show if recordset empty ?>
  <?php 
// Show IF Conditional region1 
if ($totalRows_rs_products>0) {
?>
    <tr>
      <th style="border-right:0px;" colspan="5" align="center"><?php
$TFM_Previous = $pageNum_rs_products - 3;
if ($TFM_Previous >= 0) {
   printf('...<a href="'."%s?pageNum_rs_products=%d%s", $currentPage, $TFM_Previous, $queryString_rs_products.'">');
   echo "[Previous "."3"." pages] </a>...";
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
$TFM_Next = $pageNum_rs_products + 3;
$TFM_Last = $totalPages_rs_products+1;
if ($TFM_Next - 1 < $totalPages_rs_products) { 
  printf('...<a href="'."%s?pageNum_rs_products=%d%s", $currentPage, $TFM_Next, $queryString_rs_products.'">');
    echo "[Next "."3"." of ".$TFM_Last." pages] </a>...";
}
?></th>
<th style="border-left:0px;"><?php echo tongsosanpham;?> : <b><?php echo $totalRows_rs_products;?></b>
</th>
    </tr>
    <?php } 
// endif Conditional region1
?>
</table>

</body>
</html>
<?php
mysql_free_result($rs_products);
?>
