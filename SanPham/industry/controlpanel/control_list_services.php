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
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the required classes
require_once('../includes/tfi/TFI.php');
require_once('../includes/tso/TSO.php');
require_once('../includes/nav/NAV.php');

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

$maxRows_rs_services = 10;
$pageNum_rs_services = 0;
if (isset($_GET['pageNum_rs_services'])) {
  $pageNum_rs_services = $_GET['pageNum_rs_services'];
}
$startRow_rs_services = $pageNum_rs_services * $maxRows_rs_services;

$session_member_rs_services = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $session_member_rs_services = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_services = sprintf("SELECT id_services, id_member, id_services_categories, title, title_EN, image_illustrate, day_update, visible FROM services WHERE id_member = %s", GetSQLValueString($session_member_rs_services, "int"));
$query_limit_rs_services = sprintf("%s LIMIT %d, %d", $query_rs_services, $startRow_rs_services, $maxRows_rs_services);
$rs_services = mysql_query($query_limit_rs_services, $ketnoi) or die(mysql_error());
$row_rs_services = mysql_fetch_assoc($rs_services);

if (isset($_GET['totalRows_rs_services'])) {
  $totalRows_rs_services = $_GET['totalRows_rs_services'];
} else {
  $all_rs_services = mysql_query($query_rs_services);
  $totalRows_rs_services = mysql_num_rows($all_rs_services);
}
$totalPages_rs_services = ceil($totalRows_rs_services/$maxRows_rs_services)-1;

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
$objDynamicThumb1->setFolder("../uploads/services/{SESSION.kt_login_id}/");
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
<link href="../library/CSS/style_controlpanel.css" rel="stylesheet" type="text/css" />
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js" type="text/javascript"></script><script src="../includes/nxt/scripts/list.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: true,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script>
</head>

<body>
<table id="customers">
<tr>
  <th>STT</th>
  <th><?php echo tieude_VN;?></th>
  <th><?php echo tieude_EN;?></th>
  <th><?php echo hinh;?></th>
  <th><?php echo ngaycapnhat;?></th>
  <th><?php echo thaotac;?></th>
</tr>
<?php $i=0; ?>
<?php do { $i++;?>
<?php if ($totalRows_rs_services > 0) { // Show if recordset not empty ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row_rs_services['title']; ?></td>
        <td><?php echo $row_rs_services['title_EN']; ?></td>
    <td><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" /></td>
    <td><?php echo date('d-m-Y | h:s',strtotime($row_rs_services['day_update'])); ?></td>
    <td><a class="KT_edit_link" href="index.php?mod=fsv&amp;id_services=<?php echo $row_rs_services['id_services'];?>"><?php echo sua;?></a> <a  href="index.php?mod=delsv&amp;isv=<?php echo $row_rs_services['id_services'];?>" onclick="if(!window.confirm('<?php echo banmuonxoadichvunay;?> ?')){return false;};"><?php echo xoa;?></a></td>
  </tr>
  <?php } // Show if recordset not empty ?>

<?php } while ($row_rs_services = mysql_fetch_assoc($rs_services)); ?>
<?php if ($totalRows_rs_services == 0) { // Show if recordset empty ?>
  <tr>
    <td colspan="6" align="center"><?php echo hienchuacosanpham;?></td>
  </tr>
  <?php } // Show if recordset empty ?>
  <?php 
// Show IF Conditional region1 
if ($totalRows_rs_services>0) {
?>
    <tr>
      <td style="border-right:0px;" colspan="5" align="center"><?php
$TFM_Previous = $pageNum_rs_services - 3;
if ($TFM_Previous >= 0) {
   printf('...<a href="'."%s?pageNum_rs_services=%d%s", $currentPage, $TFM_Previous, $queryString_rs_services.'">');
   echo "[Previous "."3"." pages] </a>...";
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
if($i != $TFM_endLink) echo(" | ");}
?>
          <?php
$TFM_Next = $pageNum_rs_services + 3;
$TFM_Last = $totalPages_rs_services+1;
if ($TFM_Next - 1 < $totalPages_rs_services) { 
  printf('...<a href="'."%s?pageNum_rs_services=%d%s", $currentPage, $TFM_Next, $queryString_rs_services.'">');
    echo "[Next "."3"." of ".$TFM_Last." pages] </a>...";
}
?></td>
<td style="border-left:0px;"><?php echo tongsosanpham;?> : <b><?php echo $totalRows_rs_services;?></b>
</td>
    </tr>
    <?php } 
// endif Conditional region1
?>
</table>

</body>
</html>
<?php
mysql_free_result($rs_services);
?>
