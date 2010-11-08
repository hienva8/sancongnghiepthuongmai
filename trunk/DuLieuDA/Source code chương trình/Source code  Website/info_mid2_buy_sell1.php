<?php require_once('Connections/ketnoi.php'); ?>
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

$maxRows_rs_products_sell = 10;
$pageNum_rs_products_sell = 0;
if (isset($_GET['pageNum_rs_products_sell'])) {
  $pageNum_rs_products_sell = $_GET['pageNum_rs_products_sell'];
}
$startRow_rs_products_sell = $pageNum_rs_products_sell * $maxRows_rs_products_sell;

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products_sell = "SELECT id_products, products.id_member, product_name, product_day_update FROM products,member WHERE product_visible = 1 AND product_type='sell' AND products.id_member=member.id_member ORDER BY product_day_update DESC";
$query_limit_rs_products_sell = sprintf("%s LIMIT %d, %d", $query_rs_products_sell, $startRow_rs_products_sell, $maxRows_rs_products_sell);
$rs_products_sell = mysql_query($query_limit_rs_products_sell, $ketnoi) or die(mysql_error());
$row_rs_products_sell = mysql_fetch_assoc($rs_products_sell);

if (isset($_GET['totalRows_rs_products_sell'])) {
  $totalRows_rs_products_sell = $_GET['totalRows_rs_products_sell'];
} else {
  $all_rs_products_sell = mysql_query($query_rs_products_sell);
  $totalRows_rs_products_sell = mysql_num_rows($all_rs_products_sell);
}
$totalPages_rs_products_sell = ceil($totalRows_rs_products_sell/$maxRows_rs_products_sell)-1;

$maxRows_rs_products_buy = 10;
$pageNum_rs_products_buy = 0;
if (isset($_GET['pageNum_rs_products_buy'])) {
  $pageNum_rs_products_buy = $_GET['pageNum_rs_products_buy'];
}
$startRow_rs_products_buy = $pageNum_rs_products_buy * $maxRows_rs_products_buy;

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products_buy = "SELECT id_products, products.id_member, product_name, product_day_update,country_name,country_image_illustrate FROM (products LEFT JOIN country ON products.id_country=country.id_country),member WHERE product_visible = 1 AND product_type='buy' AND products.id_member=member.id_member ORDER BY product_day_update DESC";
$query_limit_rs_products_buy = sprintf("%s LIMIT %d, %d", $query_rs_products_buy, $startRow_rs_products_buy, $maxRows_rs_products_buy);
$rs_products_buy = mysql_query($query_limit_rs_products_buy, $ketnoi) or die(mysql_error());
$row_rs_products_buy = mysql_fetch_assoc($rs_products_buy);

if (isset($_GET['totalRows_rs_products_buy'])) {
  $totalRows_rs_products_buy = $_GET['totalRows_rs_products_buy'];
} else {
  $all_rs_products_buy = mysql_query($query_rs_products_buy);
  $totalRows_rs_products_buy = mysql_num_rows($all_rs_products_buy);
}
$totalPages_rs_products_buy = ceil($totalRows_rs_products_buy/$maxRows_rs_products_buy)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="library/CSS/style.css" rel="stylesheet" type="text/css"/>
<link href="library/CSS/style_menu.css" rel="stylesheet" type="text/css" />
<link href="library/CSS/style_menu_stand.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="mid_info_buy_sell">
	<div id="mid_info_chaobanmoinhat"><?php echo chaobanmoinhat;?></div>
    <div id="mid_info_chaomuamoinhat"><?php echo chaomuamoinhat;?></div>
	<div id="mid_info_buy">
    	<?php do { 
		///////truy van lay hinh co cua thanh vien thuoc san pham chao ban
$get_id_member_rs_member_sell = "-1";
if (isset($row_rs_products_sell['id_member'])) {
  $get_id_member_rs_member_sell = $row_rs_products_sell['id_member'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_sell = sprintf("SELECT member_kind,country_name,country_image_illustrate FROM member,country WHERE id_member = %s AND member_id_country=id_country", GetSQLValueString($get_id_member_rs_member_sell, "int"));
$rs_member_sell = mysql_query($query_rs_member_sell, $ketnoi) or die(mysql_error());
$row_rs_member_sell = mysql_fetch_assoc($rs_member_sell);
$totalRows_rs_member_sell = mysql_num_rows($rs_member_sell);
		?>
          <div class="mid_info_list">
            <div class="mid_info_list_product"><img src="uploads/country_flag/<?php echo $row_rs_member_sell['country_image_illustrate']; ?>" width="12px" height="12px"  align="left" border="0"/>&nbsp;<a href="shop/<?php echo member_VIP($row_rs_member_sell['member_kind']);?>/index.php?mod=detail&amp;imb=<?php echo $row_rs_products_sell['id_member'];?>&amp;ip=<?php echo $row_rs_products_sell['id_products'];?>"><?php echo getstr($row_rs_products_sell['product_name'],35); ?></a></div>
            <div class="mid_info_date"><?php echo date('d-m-Y',strtotime($row_rs_products_sell['product_day_update'])); ?></div>
          </div>
    	  <?php } while ($row_rs_products_sell = mysql_fetch_assoc($rs_products_sell)); ?></div>
	<div id="mid_info_sell">
      <?php do { 
	  ////truy van lay hinh anh co cua thanh vien thuoc san pham chao mua
	  $get_id_member_rs_member_buy = "-1";
if (isset($row_rs_products_buy['id_member'])) {
  $get_id_member_rs_member_buy = $row_rs_products_buy['id_member'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_buy = sprintf("SELECT member_kind,country_name,country_image_illustrate FROM member,country WHERE id_member = %s AND member_id_country=id_country", GetSQLValueString($get_id_member_rs_member_buy, "int"));
$rs_member_buy = mysql_query($query_rs_member_buy, $ketnoi) or die(mysql_error());
$row_rs_member_buy = mysql_fetch_assoc($rs_member_buy);
$totalRows_rs_member_buy = mysql_num_rows($rs_member_buy);	  
	  ?>
      <div class="mid_info_list">
          <div class="mid_info_list_product"><img src="uploads/country_flag/<?php echo $row_rs_member_buy['country_image_illustrate']; ?>" width="12px" height="12px" align="left" border="0"/>&nbsp;<a href="shop/<?php echo member_VIP($row_rs_member_buy['member_kind']);?>/index.php?mod=detail&amp;imb=<?php echo $row_rs_products_buy['id_member'];?>&amp;ip=<?php echo $row_rs_products_buy['id_products'];?>"><?php echo getstr($row_rs_products_buy['product_name'],35); ?></a></div>
            <div class="mid_info_date"><?php echo date('d-m-Y',strtotime($row_rs_products_buy['product_day_update'])); ?></div>
      </div>
        <?php } while ($row_rs_products_buy = mysql_fetch_assoc($rs_products_buy)); ?></div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_products_sell);

mysql_free_result($rs_products_buy);

mysql_free_result($rs_member_sell);

mysql_free_result($rs_member_buy);
?>
