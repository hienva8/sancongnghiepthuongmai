<?php require_once('../Connections/ketnoi.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_inbox = 10;
$pageNum_rs_inbox = 0;
if (isset($_GET['pageNum_rs_inbox'])) {
  $pageNum_rs_inbox = $_GET['pageNum_rs_inbox'];
}
$startRow_rs_inbox = $pageNum_rs_inbox * $maxRows_rs_inbox;

$session_member_rs_inbox = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $session_member_rs_inbox = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_inbox = sprintf("SELECT id_inbox, box_contact_department, inbox_sender, inbox_subject, inbox_day_update, inbox_recycle_bin,name,member_user FROM ((inbox LEFT JOIN contact_department ct ON inbox.box_contact_department= ct.id_contact_department)LEFT JOIN member ON id_member=inbox_sender) WHERE inbox_sender = %s AND inbox_sent=1 ORDER BY inbox_day_update DESC", GetSQLValueString($session_member_rs_inbox, "int"));
$query_limit_rs_inbox = sprintf("%s LIMIT %d, %d", $query_rs_inbox, $startRow_rs_inbox, $maxRows_rs_inbox);
$rs_inbox = mysql_query($query_limit_rs_inbox, $ketnoi) or die(mysql_error());
$row_rs_inbox = mysql_fetch_assoc($rs_inbox);

if (isset($_GET['totalRows_rs_inbox'])) {
  $totalRows_rs_inbox = $_GET['totalRows_rs_inbox'];
} else {
  $all_rs_inbox = mysql_query($query_rs_inbox);
  $totalRows_rs_inbox = mysql_num_rows($all_rs_inbox);
}
$totalPages_rs_inbox = ceil($totalRows_rs_inbox/$maxRows_rs_inbox)-1;

$queryString_rs_inbox = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_inbox") == false && 
        stristr($param, "totalRows_rs_inbox") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_inbox = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_inbox = sprintf("&totalRows_rs_inbox=%d%s", $totalRows_rs_inbox, $queryString_rs_inbox);

$TFM_LimitLinksEndCount = 3;
$TFM_temp = $pageNum_rs_inbox + 1;
$TFM_startLink = max(1,$TFM_temp - intval($TFM_LimitLinksEndCount/2));
$TFM_temp = $TFM_startLink + $TFM_LimitLinksEndCount - 1;
$TFM_endLink = min($TFM_temp, $totalPages_rs_inbox + 1);
if($TFM_endLink != $TFM_temp) $TFM_startLink = max(1,$TFM_endLink - $TFM_LimitLinksEndCount + 1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../library/CSS/style_controlpanel.css" rel="stylesheet" type="text/css" />

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
<table id="customers">
<tr>
  <th><?php echo sothutu;?></th>
  <th><?php echo nguoigui;?></th>
  <th><?php echo bophanlienhe;?></th>
  <th><?php echo tieude;?></th>
  <th><?php echo ngaydang;?></th>
  <th><?php echo thaotac;?></th>
</tr>
<?php $i=0; ?>
<?php do { $i++;?>
<?php if ($totalRows_rs_inbox > 0) { // Show if recordset not empty ?>
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row_rs_inbox['member_user']; ?></td>
      <td><?php echo $row_rs_inbox['name']; ?></td>
    <td><?php echo getstr($row_rs_inbox['inbox_subject'],50); ?></td>
    <td><?php echo date('d-m-Y | h:s',strtotime($row_rs_inbox['inbox_day_update'])); ?></td>
    <td><a href="index.php?mod=lbx_sentdetail&amp;iibx=<?php echo $row_rs_inbox['id_inbox']; ?>"><?php echo xem; ?></a> | <a  href="<?php echo $linkcurrent;?>?mod=libxsent&iibx=<?php echo $row_rs_inbox['id_inbox']; ?>"  onclick="ajaxLoad('control_inbox_del.php?mod=libxsent&iibx=<?php echo $row_rs_inbox['id_inbox']; ?>','hienthi');"><?php echo xoa;?></a></td>
  </tr>
  <?php } // Show if recordset not empty ?>

<?php } while ($row_rs_inbox = mysql_fetch_assoc($rs_inbox)); ?>
<?php if ($totalRows_rs_inbox == 0) { // Show if recordset empty ?>
  <tr>
    <td colspan="6" align="center"><?php echo hienchuacothudagui;?></td>
  </tr>
  <?php } // Show if recordset empty ?>
  <?php 
// Show IF Conditional region1 
if ($totalRows_rs_inbox>0) {
?>
    <tr>
      <th style="border-right:0px;" colspan="5" align="center"><?php
$TFM_Previous = $pageNum_rs_inbox - 3;
if ($TFM_Previous >= 0) {
   printf('...<a href="'."%s?pageNum_rs_inbox=%d%s", $currentPage, $TFM_Previous, $queryString_rs_inbox.'">');
   echo "[Previous "."3"." pages] </a>...";
   //Basic-UltraDev Previous X pages SB
}
?>
          <?php
for ($i = $TFM_startLink; $i <= $TFM_endLink; $i++) {
  $TFM_LimitPageEndCount = $i -1;
  if($TFM_LimitPageEndCount != $pageNum_rs_inbox) {
    printf('<a href="'."%s?pageNum_rs_inbox=%d%s", $currentPage, $TFM_LimitPageEndCount, $queryString_rs_inbox.'">');
    echo "$i</a>";
  }else{
    echo "<strong>$i</strong>";
  }
if($i != $TFM_endLink) echo(" | ");}
?>
          <?php
$TFM_Next = $pageNum_rs_inbox + 3;
$TFM_Last = $totalPages_rs_inbox+1;
if ($TFM_Next - 1 < $totalPages_rs_inbox) { 
  printf('...<a href="'."%s?pageNum_rs_inbox=%d%s", $currentPage, $TFM_Next, $queryString_rs_inbox.'">');
    echo "[Next "."3"." of ".$TFM_Last." pages] </a>...";
}
?></th>
<th style="border-left:0px;"><?php echo tongsothu;?> : <b><?php echo $totalRows_rs_inbox;?></b></th>
    </tr>
    <?php } 
// endif Conditional region1
?>
</table>

</body>
</html>
<?php
mysql_free_result($rs_inbox);
?>