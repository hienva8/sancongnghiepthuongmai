<?php require_once("Connections/ketnoi.php");?>
<?php 
$query_rs_product1 = "SELECT id_products FROM products WHERE product_type='buy'";
$rs_product1 = mysql_query($query_rs_product1);
$totalRows_rs_product1 = mysql_num_rows($rs_product1);
?>
<?php 
$query_rs_product2 = "SELECT id_products FROM products WHERE product_type='sell'";
$rs_product2 = mysql_query($query_rs_product2);
$totalRows_rs_product2 = mysql_num_rows($rs_product2);
?>
<?php 
$query_rs_product3 = "SELECT id_products FROM products WHERE product_type='product'";
$rs_product3 = mysql_query($query_rs_product3,$ketnoi) or die(mysql_error());
$totalRows_rs_product3 = mysql_num_rows($rs_product3);
?>
<?php 
$query_rs_company = "SELECT id_company FROM company";
$rs_company = mysql_query($query_rs_company);
$totalRows_rs_company = mysql_num_rows($rs_company);
?>
<?php 
$query_rs_member = "SELECT id_member FROM member";
$rs_member = mysql_query($query_rs_member);
$totalRows_rs_member = mysql_num_rows($rs_member);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
		<div id="count">
        	<center><h1><?php echo thongke;?></h1></center>           		
               <div id="left_info">
                	<ul>
                    	<li><img src="interface/money_icon.gif" width="15" height="15"/>&nbsp;<?php echo chaomua;?></li>
                        <li><img src="interface/money_icon.gif" width="15" height="15"/>&nbsp;<?php echo chaoban;?></li>               
                        <li><img src="interface/money_icon.gif" width="15" height="15"/>&nbsp;<?php echo sanpham;?></li>
                        <li><img src="interface/business.png" align="top" /> <?php echo doanhnghiep;?></li>
                        <li><img src="interface/user.png" align="top" style="z-index:9000; background:#FFFFFF; list-style-image:inherit"/> <?php echo thanhvien;?></li>
                     </ul>
                </div>
                <div id="right_info">
                	<ul>
                    	<li><?php echo $totalRows_rs_product1 ;?></li>
                        <li><?php echo $totalRows_rs_product2 ;?></li>               
                        <li><?php echo $totalRows_rs_product3 ;?></li>
                        <li><?php echo $totalRows_rs_company ;?></li>
                        <li><?php echo $totalRows_rs_member ;?></li>
                    </ul>
                </div>      
         
          	<img src="Interface/khung_2.jpg" height="15" align="top" width="220"/>
                	
        </div>
</body>
</html>