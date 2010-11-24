<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

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

$maxRows_rs_supportonline = 10;
$pageNum_rs_supportonline = 0;
if (isset($_GET['pageNum_rs_supportonline'])) {
  $pageNum_rs_supportonline = $_GET['pageNum_rs_supportonline'];
}
$startRow_rs_supportonline = $pageNum_rs_supportonline * $maxRows_rs_supportonline;

$colname_rs_supportonline = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_supportonline = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_supportonline = sprintf("SELECT id_supportonline, humanname_help, humansex_help, nickname, sp.visible,name FROM supportonline AS sp,contact_department WHERE sp.id_member = %s AND  sp.id_contact_department=contact_department.id_contact_department ORDER BY sp.sort ASC", GetSQLValueString($colname_rs_supportonline, "int"));
$query_limit_rs_supportonline = sprintf("%s LIMIT %d, %d", $query_rs_supportonline, $startRow_rs_supportonline, $maxRows_rs_supportonline);
$rs_supportonline = mysql_query($query_limit_rs_supportonline, $ketnoi) or die(mysql_error());
$row_rs_supportonline = mysql_fetch_assoc($rs_supportonline);

if (isset($_GET['totalRows_rs_supportonline'])) {
  $totalRows_rs_supportonline = $_GET['totalRows_rs_supportonline'];
} else {
  $all_rs_supportonline = mysql_query($query_rs_supportonline);
  $totalRows_rs_supportonline = mysql_num_rows($all_rs_supportonline);
}
$totalPages_rs_supportonline = ceil($totalRows_rs_supportonline/$maxRows_rs_supportonline)-1;

$queryString_rs_supportonline = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_supportonline") == false && 
        stristr($param, "totalRows_rs_supportonline") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_supportonline = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_supportonline = sprintf("&totalRows_rs_supportonline=%d%s", $totalRows_rs_supportonline, $queryString_rs_supportonline);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../uploads/products/{rs_supportonline.id_member}/{rs_supportonline.id_products}/");
$objDynamicThumb1->setRenameRule("{rs_supportonline.product_image_illustrate}");
$objDynamicThumb1->setResize(100, 0, true);
$objDynamicThumb1->setWatermark(false);

$TFM_LimitLinksEndCount = 3;
$TFM_temp = $pageNum_rs_supportonline + 1;
$TFM_startLink = max(1,$TFM_temp - intval($TFM_LimitLinksEndCount/2));
$TFM_temp = $TFM_startLink + $TFM_LimitLinksEndCount - 1;
$TFM_endLink = min($TFM_temp, $totalPages_rs_supportonline + 1);
if($TFM_endLink != $TFM_temp) $TFM_startLink = max(1,$TFM_endLink - $TFM_LimitLinksEndCount + 1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/CSS/style_controlpanel.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body>
<?php
$linkcurrent = $_SERVER['PHP_SELF'];
?>
<script>
loadstatustext = '<center><img src="../interface/loading.gif"><center>';
function ajaxLoad(url,id)
   {
       if (document.getElementById) {
           var x = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
           }
           if (x)
               {
           x.onreadystatechange = function()
                   {
                       el = document.getElementById(id);
                       el.innerHTML = loadstatustext;
               if (x.readyState == 4 && x.status == 200)
                       {
                       el.innerHTML = x.responseText;
                   }
                   }
               x.open("GET", url, true);
               x.send(null);
               }
    }
</script>
<!----------show tin phan hoi----------->
<script type="text/javascript"> 
    function showStuff(id) { 
        document.getElementById(id).style.display = 'block'; 
    } 
    function hideStuff(id) { 
        document.getElementById(id).style.display = 'none'; 
    } 
</script>
<!-----end---->
<table id="customers">
<tr>
  <th><?php echo sothutu;?></th>
  <th><?php echo hoten;?></th>
  <th><?php echo gioitinh;?></th>
  <th><?php echo email;?></th>
  <th><?php echo bophanlienhe;?></th>
  <th><?php echo thaotac;?></th>
</tr>
<?php $i=0; ?>
<?php do { $i++;?>
<?php if ($totalRows_rs_supportonline > 0) { // Show if recordset not empty ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row_rs_supportonline['humanname_help']; ?></td>
      <td><?php echo $row_rs_supportonline['humansex_help']; ?></td>
    <td><?php echo $row_rs_supportonline['nickname']; ?></td>
    <td><?php echo $row_rs_supportonline['name']; ?></td>
    <td><a  href="javascript:void(0,0)"  onclick="ajaxLoad('control_form_supportonline.php?id_supportonline=<?php echo $row_rs_supportonline['id_supportonline']; ?>','hienthi');;showStuff('answer1')"><?php echo sua; ?></a> | <a  href="<?php echo $linkcurrent;?>?mod=lsupport"  onclick="ajaxLoad('control_list_delete.php?isupport=<?php echo $row_rs_supportonline['id_supportonline']; ?>','hienthi');"><?php echo xoa;?></a></td>
  </tr>
  <?php } // Show if recordset not empty ?>

<?php } while ($row_rs_supportonline = mysql_fetch_assoc($rs_supportonline)); ?>
<?php if ($totalRows_rs_supportonline == 0) { // Show if recordset empty ?>
  <tr>
    <td colspan="6" align="center"><?php echo hienchuacothanhvienhotro;?></td>
  </tr>
   <?php } // Show if recordset empty ?> 
  <?php 
// Show IF Conditional region1 
if ($totalRows_rs_supportonline>0) {
?>
    <tr>
      <th style="border-right:0px;" colspan="5" align="center"><?php
$TFM_Previous = $pageNum_rs_supportonline - 3;
if ($TFM_Previous >= 0) {
   printf('...<a href="'."%s?pageNum_rs_supportonline=%d%s", $currentPage, $TFM_Previous, $queryString_rs_supportonline.'">');
   echo "[Previous "."3"." pages] </a>...";
   //Basic-UltraDev Previous X pages SB
}
?>
          <?php
for ($i = $TFM_startLink; $i <= $TFM_endLink; $i++) {
  $TFM_LimitPageEndCount = $i -1;
  if($TFM_LimitPageEndCount != $pageNum_rs_supportonline) {
    printf('<a href="'."%s?pageNum_rs_supportonline=%d%s", $currentPage, $TFM_LimitPageEndCount, $queryString_rs_supportonline.'">');
    echo "$i</a>";
  }else{
    echo "<strong>$i</strong>";
  }
if($i != $TFM_endLink) echo(" | ");}
?>
          <?php
$TFM_Next = $pageNum_rs_supportonline + 3;
$TFM_Last = $totalPages_rs_supportonline+1;
if ($TFM_Next - 1 < $totalPages_rs_supportonline) { 
  printf('...<a href="'."%s?pageNum_rs_supportonline=%d%s", $currentPage, $TFM_Next, $queryString_rs_supportonline.'">');
    echo "[Next "."3"." of ".$TFM_Last." pages] </a>...";
}
?></th>
<th style="border-left:0px;"><?php echo tongsothanhvien;?> : <b><?php echo $totalRows_rs_supportonline;?></b>
</th>
    </tr>
    <?php } 
// endif Conditional region1
?>
<tr>
  		<th colspan="5"></th>
    	<th align="right"><input type="submit" onclick="showStuff('answer1')" value="<?php echo themmoi; ?>" /></th>
  </tr>

</table>
<span id="answer1" style="display:none; return:false;">
<div class="khung_support" >
	<div id="hienthi" class="khung_support1">
	<?php if($totalRows_rs_supportonline<3){?>
	<?php
  mxi_includes_start("control_form_supportonline.php");
  require(basename("control_form_supportonline.php"));
  mxi_includes_end();
?>
<?php }else{ echo "<font color=red><strong>".thongbao."</strong></font>"." : ".sothanhvienhotrotructuyendadu;}?>
	
</div>
</div>
</span>
</body>
</html>
<?php
mysql_free_result($rs_supportonline);
?>