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

$get_id_member_rs_services = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_services = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_services = sprintf("SELECT id_services,id_services_categories,id_member,title, title_EN,image_illustrate, short_describe, short_describe_EN, day_update FROM services WHERE id_member=%s AND visible = 1 ORDER BY day_update DESC", GetSQLValueString($get_id_member_rs_services, "int"));
$rs_services = mysql_query($query_rs_services, $ketnoi) or die(mysql_error());
$row_rs_services = mysql_fetch_assoc($rs_services);
$totalRows_rs_services = mysql_num_rows($rs_services);

$queryString_rs_services = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_services") == false && 
        stristr($param, "totalRows_rs_services") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_services = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_services = sprintf("&totalRows_rs_services=%d%s", $totalRows_rs_services, $queryString_rs_services);


// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/services/{rs_services.id_member}/");
$objDynamicThumb1->setRenameRule("{rs_services.image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);

$TFM_LimitLinksEndCount = 3;
$TFM_temp = $pageNum_rs_services + 1;
$TFM_startLink = max(1,$TFM_temp - intval($TFM_LimitLinksEndCount/2));
$TFM_temp = $TFM_startLink + $TFM_LimitLinksEndCount - 1;
$TFM_endLink = min($TFM_temp, $totalPages_rs_services + 1);
if($TFM_endLink != $TFM_temp) $TFM_startLink = max(1,$TFM_endLink - $TFM_LimitLinksEndCount + 1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="showcase">        	
  <h1><?php echo dichvu;?></h1>
  

  <?php do { ?>
    <div class="box">
            <div class="box_2">
              <div class="img" style="width:98%;"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" align="left" />
                <h2><a href="<?php  echo member_VIP($row_rs_services['member_kind']);?>/index.php?mod=svdetail&imb=<?php echo $row_rs_services["id_member"];?>&amp;isvc=<?php echo $row_rs_services['id_services_categories'];?>&isv=<?php echo $row_rs_services['id_services'];?>"><?php echo $row_rs_services['title'];?></a></h2>
                <label><?php echo $row_rs_services['short_describe'];?></label>
              </div>
      </div>
              </div>
    <?php } while ($row_rs_services = mysql_fetch_assoc($rs_services)); ?>
    <?php if ($totalRows_rs_services == 0) { // Show if recordset empty ?>
      <div style="text-align:center"><?php echo hienchuacodichvu;?></div>
      <?php } // Show if recordset empty ?>
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
$TFM_Previous = $pageNum_rs_services - 3;
if ($TFM_Previous >= 0) {
   printf('<a href="'."%s?pageNum_rs_services=%d%s", $currentPage, $TFM_Previous, $queryString_rs_services.'">');
   echo "<<";
   //Basic-UltraDev Previous X pages SB
}
?>
               		    <?php
for ($i = $TFM_startLink; $i <= $TFM_endLink; $i++) {
  $TFM_LimitPageEndCount = $i -1;
  if($TFM_LimitPageEndCount != $pageNum_rs_services) {
    printf('<a href="'."%s?pageNum_rs_services=%d%s", $currentPage, $TFM_LimitPageEndCount, $queryString_rs_services.'">');
    echo "$i</a>";
  }else{
    echo "<strong>$i</strong>";
  }
if($i != $TFM_endLink) echo("| ");}
?>
                        <?php
$TFM_Next = $pageNum_rs_services + 3;
$TFM_Last = $totalPages_rs_services+1;
if ($TFM_Next - 1 < $totalPages_rs_services) { 
  printf('<a href="'."%s?pageNum_rs_services=%d%s", $currentPage, $TFM_Next, $queryString_rs_services.'">');
    echo ">>";
}
?></h2>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_services);
?>
