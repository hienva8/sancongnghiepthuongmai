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

$maxRows_rs_products = 12;
$pageNum_rs_products = 0;
if (isset($_GET['pageNum_rs_products'])) {
  $pageNum_rs_products = $_GET['pageNum_rs_products'];
}
$startRow_rs_products = $pageNum_rs_products * $maxRows_rs_products;

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = "SELECT id_products,id_procat, products.id_member, member_kind,product_name,product_image_illustrate FROM products,member WHERE product_visible = 1 AND product_popular=1 AND products.id_member=member.id_member ORDER BY product_day_update DESC";
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

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products_new = "SELECT id_products,id_procat, products.id_member,member_kind, product_name,product_image_illustrate FROM products,member WHERE product_visible = 1  AND product_type='product' AND products.id_member=member.id_member ORDER BY product_day_update DESC";
$rs_products_new = mysql_query($query_rs_products_new, $ketnoi) or die(mysql_error());
$row_rs_products_new = mysql_fetch_assoc($rs_products_new);
$totalRows_rs_products_new = mysql_num_rows($rs_products_new);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div id="mid_info_products">      
          <div id="TabbedPanels1" class="TabbedPanels">
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab"><?php echo sanphamuachuong;?></li>
              <li class="TabbedPanelsTab"><?php echo sanphammoinhat;?></li>
            </ul>
            <div class="TabbedPanelsContentGroup">
              <div class="TabbedPanelsContent">
              	<div class="left-pro">
                  <?php if ($totalRows_rs_products > 0) { // Show if recordset not empty ?>
                    <table class="table">
                      <tr>
                        <?php $i=0; 
							do { $i++; ?>
                        <td><a href="shop/<?php echo member_VIP($row_rs_products['member_kind']);?>/index.php?mod=detail&amp;imb=<?php echo $row_rs_products['id_member']; ?>&amp;ipc=<?php echo $row_rs_products['id_procat']; ?>&amp;ip=<?php echo $row_rs_products['id_products']; ?>" target="_blank"><img src="uploads/products/<?php echo $row_rs_products['id_member']; ?>/<?php echo $row_rs_products['id_products']; ?>/<?php echo $row_rs_products['product_image_illustrate']; ?>"  class="khung"/>
                              <?php echo getstr($row_rs_products['product_name'],30); ?>
                        </a> </td>
                        <?php if($i==6) echo "</tr><tr>";?>
                        <?php } while ($row_rs_products = mysql_fetch_assoc($rs_products)); ?>
                      </tr>
                    </table>
                    <?php } // Show if recordset not empty ?>
</div>
              
              </div>
              <div class="TabbedPanelsContent">
                <?php if ($totalRows_rs_products_new > 0) { // Show if recordset not empty ?>
                <table class="table">
                    <tr>
                     <?php $i=0; 
							do { $i++; ?>
                      <td>
                        <a href="shop/<?php echo member_VIP($row_rs_products_new['member_kind']);?>/index.php?mod=detail&amp;imb=<?php echo $row_rs_products_new['id_member']; ?>&amp;ipc=<?php echo $row_rs_products_new['id_procat']; ?>&amp;ip=<?php echo $row_rs_products_new['id_products']; ?>" target="_blank"><img src="uploads/products/<?php echo $row_rs_products_new['id_member']; ?>/<?php echo $row_rs_products_new['id_products']; ?>/<?php echo $row_rs_products_new['product_image_illustrate']; ?>"  class="khung"/>
                        <?php echo getstr($row_rs_products_new['product_name'],30); ?>
                        </a>                        
                        </td>  
                        <?php if($i==6) echo "</tr><tr>";?>
                        <?php } while ($row_rs_products_new = mysql_fetch_assoc($rs_products_new)); ?>                       
                          </tr>
                  </table>
                  <?php } // Show if recordset not empty ?>
</div>
            </div>
          </div>
 </div>
</body>
</html>
<?php
mysql_free_result($rs_products);

mysql_free_result($rs_products_new);
?>