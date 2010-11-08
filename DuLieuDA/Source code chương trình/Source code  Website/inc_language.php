<?php require_once('Connections/ketnoi.php'); ?>
<?php
session_start();
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
$query_rsDefaultLang = "SELECT * FROM site_settings WHERE default_lang = 'vietnam'";
$rsDefaultLang = mysql_query($query_rsDefaultLang, $ketnoi) or die(mysql_error());
$row_rsDefaultLang = mysql_fetch_assoc($rsDefaultLang);
$totalRows_rsDefaultLang = mysql_num_rows($rsDefaultLang);
?>
<?php
if ($_GET['lang'] =="")
{
if ($_COOKIE["mylang"] =="")
{
$lang = $row_rsDefaultLang['default_lang'];
}
else
{
$lang  = $_COOKIE["mylang"];
}
}
else
{
$lang  = $_GET['lang'];
}
setcookie ("mylang", $lang, time()+604800,"/");
include "lang/$lang.php";
$_SESSION['language']=$lang;
?>
<?php
mysql_free_result($rsDefaultLang);
?>