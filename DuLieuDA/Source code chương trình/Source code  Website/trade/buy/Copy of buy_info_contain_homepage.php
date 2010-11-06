<?php require_once('../../Connections/ketnoi.php'); ?>
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

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products1 = "SELECT products.id_products, products.id_procat, products.id_prosubcat1, products.id_prosubcat2, products.id_prosubcat3, products.id_country, products.id_member, products.product_name, products.product_name_EN, products.product_short_describe, products.product_short_describe_EN, products.product_image_illustrate, country.country_name, country.country_name_EN, country.country_image_illustrate, member.member_kind FROM ((products LEFT JOIN country ON products.id_country=country.id_country)LEFT JOIN member ON products.id_member=member.id_member) WHERE products.product_type='buy'";
$rs_products1 = mysql_query($query_rs_products1, $ketnoi) or die(mysql_error());
$row_rs_products1 = mysql_fetch_assoc($rs_products1);
$totalRows_rs_products1 = mysql_num_rows($rs_products1);

mysql_select_db($database_ketnoi, $ketnoi);
$query_master1procat = "SELECT * FROM procat ORDER BY procat_name";
$master1procat = mysql_query($query_master1procat, $ketnoi) or die(mysql_error());
$row_master1procat = mysql_fetch_assoc($master1procat);
$totalRows_master1procat = mysql_num_rows($master1procat);

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = "SELECT * FROM products WHERE id_procat=123456789 ORDER BY product_name";
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../library/CSS/style.css" rel="stylesheet" type="text/css" />
<link href="../../library/CSS/style_menu.css" rel="stylesheet" type="text/css" />
<link href="../../library/CSS/style_buy_sale.css" rel="stylesheet" type="text/css" />
<link href="../../library/CSS/style-slide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../library/js/jquery_menu.js"></script>
<script type="text/javascript" src="../../library/js/script.js"></script>
<script type="text/javascript" src="../../library/js/jquery.js"></script>
<script type="text/javascript" src="../../library/js/jcarousellite.js"></script>
</head>

<body>
<div class="right-center">
    	<div class="bor_1">
        	<img src="../../Interface/home-1.jpg" width="16" height="16" />&nbsp;<span class="st_1"><a href="#">Home</a>&nbsp;<b> ></b>&nbsp;<a href="#"> Chào mua</a></span>
        </div>
 		
        <?php if ($totalRows_master1procat > 0) { // Show if recordset not empty ?>
        <div class="cates">
            <fieldset>            
              <legend>Ngành nghề</legend>
          <table border="0">
                <tr>
                  <?php $i=0; ?>
                  <?php do { 
	$i++;       ?>
                  <td><img src="../../Interface/icon_2.jpg" width="5" height="9" /><a href="#"><?php echo $row_master1procat['procat_name']; ?> </a>
                    <?php
  if ($totalRows_master1procat>0) {
    $nested_query_rs_products = str_replace("123456789", $row_master1procat['id_procat'], $query_rs_products);
    mysql_select_db($database_ketnoi);
    $rs_products = mysql_query($nested_query_rs_products, $ketnoi) or die(mysql_error());
    $row_rs_products = mysql_fetch_assoc($rs_products);
    $totalRows_rs_products = mysql_num_rows($rs_products);
    $nested_sw = false;
    if (isset($row_rs_products) && is_array($row_rs_products)) {
?>
                    <?php
  //rs_products show if first nested loop version 3
  if (!isset($nested_sw) || $nested_sw == false) {
    $nested_sw = true;
  } else {
?>
                    <?php
  } // end show if first nested loop version 3
?>
                  (<?php echo $totalRows_rs_products; ?>)
                  <?php    
	}
  }
?>
<span class="number"></span>                  </td>
                  <?php if($i%4==0) echo "</tr><tr class='tr'>";  ?>
                  <?php } while ($row_master1procat = mysql_fetch_assoc($master1procat)); ?>
                  </tr>
              </table>
              </fieldset>
          </div>
          <?php } // Show if recordset not empty ?>
<div id="cates-info">
        	<div class="contact">
            
            </div>
   	<h1>Chào mua</h1>
            
            
            
            	<?php do { ?>
            	  <div class="box">
            	    <div class="check">
            	      <input type="checkbox" name="checkbox" id="c123" value="123"/>
           	        </div>
            	    <div class="box_2">
           	          <div class="img">
            	          <img src="../../Interface/Advertisement/add_2.jpg" align="left"/>                    
            	          <h2><a href="<?php echo $row_rs_products1['product_name']; ?>"><?php echo $row_rs_products1['product_name'];?></a></h2>
                          <label><?php echo $row_rs_products1['product_short_describe']; ?></label>
           	            </div>
            	      <div class="c-info">
            	        <h2><a href="#">CÔNG TY TNHH THƯƠNG MẠI & ĐẦU TƯ SONG PHÁT</a></h2>
            	        <?php 
// Show IF Conditional region1 
if (@$row_rs_products1['member_kind'] == "VIP") {
?>
            	          <div class="box_3">	<img src="../../interface/icon_3.gif" width="20" align="left"/>
            	            <h3>Thành viên VIP</h3>
  	                    </div>
            	          <?php } 
// endif Conditional region1
?>
            	        <div class="box_3">	<img src="../../Interface/vietnam-icon.png" align="left"/>
            	          <h3><?php echo $row_rs_products1['country_name']; ?></h3>
			  	          </div>
            	        <div class="but"><input type="image" src="../../Interface/contact.jpg"/>
            	          </div>
          	        </div>
          	      </div>
          	    </div>
            	  <?php } while ($row_rs_products1 = mysql_fetch_assoc($rs_products1)); ?><div id="contact_2">
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
</body>
</html>
<?php
mysql_free_result($rs_products1);

mysql_free_result($master1procat);

mysql_free_result($rs_products);
?>