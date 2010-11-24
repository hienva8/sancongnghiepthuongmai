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

mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_country = "SELECT id_country, country_name FROM country ORDER BY sort ASC";
$rs_country = mysql_query($query_rs_country, $ketnoi) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+'\n'; }
    } if (errors) alert('Please enter value');
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<link href="../library/CSS/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
	$array_search = array('product'=>'Sản phẩm','sell'=>'Chào bán','buy'=>'Chào mua');
?>
<div id="bg_2"> 
<form action="index.php" method="get" name="form1" id="form1" onsubmit="MM_validateForm('key1','','R');return document.MM_returnValue">
<div id="se-in">
  <div id="search">
  	  <input name="mod" type="hidden" id="mod" value="search" />
      <input type="text" value="<?php echo $_GET['key1'];?>" name="key1" size="45" height="22" id="key1"/>
    	<select name="key2" id="key2">
        <?php foreach($array_search as $key=>$value) {?>
          <option value="<?php echo $key;?>"><?php echo $value;?></option>
          <?php } ?>
      </select>
      <select name="key3" id="key3">
       <option value="all" selected="selected">Select country</option>
        <?php do { ?>
            <option value="<?php echo $row_rs_country['id_country']; ?>"><?php echo $row_rs_country['country_name']; ?></option>       
          <?php } while ($row_rs_country = mysql_fetch_assoc($rs_country)); ?>
       </select>
  </div>
     <div id="button-se"><input type="image" src="../interface/search.jpg"/>
     </div>
</div>
</form>
  <h1><font color="#FFFF00">Popular Searches:</font><font color="#FFFFFF"> Máy nghiền, máy xúc, xe nâng, máy kéo, ... </font></h1>
</div>
</body>
</html>
<?php
mysql_free_result($rs_country);
?>