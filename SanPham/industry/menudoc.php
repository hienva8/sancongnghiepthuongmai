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
mysql_select_db($database_ketnoi, $ketnoi);
$query_master1procat = "SELECT id_procat, procat_name, procat_name_EN, url, notes, notes_EN FROM procat ORDER BY sort";
$master1procat = mysql_query($query_master1procat, $ketnoi) or die(mysql_error());
$row_master1procat = mysql_fetch_assoc($master1procat);
$totalRows_master1procat = mysql_num_rows($master1procat);

mysql_select_db($database_ketnoi, $ketnoi);
$query_detail2prosubcat1 = "SELECT id_prosubcat1, id_procat, prosubcat1_name, prosubcat1_name_EN, url, notes, notes_EN FROM prosubcat1 WHERE id_procat=123456789 ORDER BY sort";
$detail2prosubcat1 = mysql_query($query_detail2prosubcat1, $ketnoi) or die(mysql_error());
$row_detail2prosubcat1 = mysql_fetch_assoc($detail2prosubcat1);
$totalRows_detail2prosubcat1 = mysql_num_rows($detail2prosubcat1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
      <div id="menu_sta">
        	<center><h2><?php echo danhmucsanpham;?></h2></center>
          	<div id="info_menu">
           
          	  <ul class="dropdown dropdown-vertical">
               <?php do { ?>
              <li><a href="trade/product/index.php?mod=psc1&ipc=<?php echo $row_master1procat['id_procat'];?>" class="dir"> <?php echo $row_master1procat['procat_name']; ?></a>
                
                        <ul>
                        <?php
  if ($totalRows_master1procat>0) {
    $nested_query_detail2prosubcat1 = str_replace("123456789", $row_master1procat['id_procat'], $query_detail2prosubcat1);
    mysql_select_db($database_ketnoi);
    $detail2prosubcat1 = mysql_query($nested_query_detail2prosubcat1, $ketnoi) or die(mysql_error());
    $row_detail2prosubcat1 = mysql_fetch_assoc($detail2prosubcat1);
    $totalRows_detail2prosubcat1 = mysql_num_rows($detail2prosubcat1);
    $nested_sw = false;
    if (isset($row_detail2prosubcat1) && is_array($row_detail2prosubcat1)) {
      do { //Nested repeat
?>
                            <li><a href="trade/product/index.php?mod=psc2&ipc=<?php echo $row_detail2prosubcat1['id_procat'];?>&amp;ipsc1=<?php echo $row_detail2prosubcat1['id_prosubcat1'];?>"> <?php echo $row_detail2prosubcat1['prosubcat1_name']; ?></a></li>
                              <?php
      } while ($row_detail2prosubcat1 = mysql_fetch_assoc($detail2prosubcat1)); //Nested move next
    }
  }
?>
                        </ul>
                    </li>
		<?php } while ($row_master1procat = mysql_fetch_assoc($master1procat)); ?>
              </ul>
                
                
		</div>
            <center><img src="Interface/khung_2.jpg" height="15" align="left" width="190"/>
            </center>
</div>    
      
</body>
</html>

<?php
mysql_free_result($master1procat);

mysql_free_result($detail2prosubcat1);
?>