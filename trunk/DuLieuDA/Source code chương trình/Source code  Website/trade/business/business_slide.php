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
$query_rs_products = "SELECT cp.id_company,cp.company_id_member,cp.company_id_country,cp.company_id_industry,cp.company_name,cp.company_logo,cp.company_shortinfo,mb.member_kind,ct.country_name,ct.country_image_illustrate,ind.industry_name FROM company AS cp,member AS mb, country AS ct,industry AS ind WHERE cp.company_id_member=mb.id_member AND cp.company_id_country=ct.id_country AND cp.company_id_industry=ind.id_industry LIMIT 0,10";
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../uploads/logo/{rs_products.company_id_member}/");
$objDynamicThumb1->setRenameRule("{rs_products.company_logo}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);
?>
<?php if ($totalRows_rs_products > 0) { // Show if recordset not empty ?>
<div class="carousel main">
            <div class="jCarouselLite">
                <ul>
            <?php do{ //print_r($row_rs_products);?>
				
<li>
                    	<h2><a href="../../shop/<?php  echo member_VIP($row_rs_products['member_kind']);?>/index.php?imb=<?php echo $row_rs_products['company_id_member'];?>"><?php echo $row_rs_products["company_name"];?></a></h2>
                        <div class="img-c">                          <img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
                          <label><?php echo $row_rs_products["company_shortinfo"];?></label>
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
