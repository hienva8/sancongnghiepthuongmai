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

$maxRows_rs_business = 16;
$pageNum_rs_business = 0;
if (isset($_GET['pageNum_rs_business'])) {
  $pageNum_rs_business = $_GET['pageNum_rs_business'];
}
$startRow_rs_business = $pageNum_rs_business * $maxRows_rs_business;

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_business = "SELECT id_company, company_name, company_logo, company_shortinfo, company_id_member,company_potential FROM company LEFT JOIN member ON company_id_member=id_member WHERE company_potential=1";
$query_limit_rs_business = sprintf("%s LIMIT %d, %d", $query_rs_business, $startRow_rs_business, $maxRows_rs_business);
$rs_business = mysql_query($query_limit_rs_business, $ketnoi) or die(mysql_error());
$row_rs_business = mysql_fetch_assoc($rs_business);

if (isset($_GET['totalRows_rs_business'])) {
  $totalRows_rs_business = $_GET['totalRows_rs_business'];
} else {
  $all_rs_business = mysql_query($query_rs_business);
  $totalRows_rs_business = mysql_num_rows($all_rs_business);
}
$totalPages_rs_business = ceil($totalRows_rs_business/$maxRows_rs_business)-1;
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
<div id="mid_info_business">
  <div id="mid_info_business1"><?php echo doanhnghieptiemnang;?></div>
		

  <?php do { ?>
  
    <div id="mid_info_list_business">
      <div id="mid_info_list_business_img" class="khung"><img src="uploads/logo/<?php echo $row_rs_business['company_id_member']; ?>/<?php echo $row_rs_business['company_logo']; ?>" /></div>
      <div class="mid_info_business_title"><a href="shop/<?php echo member_VIP($row_rs_business['member_kind']);?>/index.php?imb=<?php echo $row_rs_business['company_id_member'];?>" target="_blank"><?php echo $row_rs_business['company_name']; ?></a>
          <h5><?php echo $row_rs_business['company_shortinfo']; ?></h5>
      </div>
    </div>
        <?php } while ($row_rs_business = mysql_fetch_assoc($rs_business)); ?>
        
</div>


</body>
</html>
<?php
mysql_free_result($rs_business);
?>
