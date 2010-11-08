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
$query_rs_banner = "SELECT id_advertise, title, notes, notes_EN, file_image, url, width, height, `position`, fileflash FROM advertise WHERE position='mid1' AND (date_format(day_end,'%y%m%d') > date_format(time(),'%y%m%d')) AND visible = 1 ORDER BY sort ASC";
$rs_banner = mysql_query($query_rs_banner, $ketnoi) or die(mysql_error());
$row_rs_banner = mysql_fetch_assoc($rs_banner);
$totalRows_rs_banner = mysql_num_rows($rs_banner);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<script type="text/javascript">

var pic_width=535; //Bạn hãy định lại độ rộng theo đúng kích thước khi upload hình
var pic_height=150; // Bạn hãy định lại chiều cao theo đúng kích thước khi upload hình
var button_pos=5;
var stop_time=3000;
var show_text=1;
var txtcolor="fff";
var bgcolor="fff";
var imag=new Array();
var link=new Array();
var text=new Array();
<?php
$dem=1;
do{
?>

imag[<?php echo $dem; ?>] = "upload/quangcao/<?php echo $row_rs_banner['file_image']; ?>";
link[<?php echo $dem; ?>] = "<?php echo $row_rs_banner['url']; ?>";
text[<?php echo $dem; ?>] = "<?php echo $row_rs_banner['title']; ?>";
<?php
$row_rs_banner = mysql_fetch_assoc($rs_banner);
$dem++;
?>
<?php
//} while ( $row_rs_tinnong = mysql_fetch_assoc($rs_tinnong) );
} while ( $dem <= $totalRows_rs_banner );
?>


var swf_height=show_text==1?pic_height+0:pic_height;
var pics="", links="", texts="";
for(var i=1; i<imag.length; i++){
	pics=pics+("|"+imag[i]);
	links=links+("|"+link[i]);
	texts=texts+("|"+text[i]);
}
pics=pics.substring(1);
links=links.substring(1);
texts=texts.substring(1);
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cabversion=6,0,0,0" width="'+ pic_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="gallery.swf">');
document.write('<param name="quality" value="high"><param name="wmode" value="opaque">');
document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'">');
document.write('<embed src="gallery.swf" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'" quality="high" width="'+ pic_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>');
</script> 
</body>
</html>
<?php
mysql_free_result($rs_banner);
?>
