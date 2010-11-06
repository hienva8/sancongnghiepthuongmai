<?php
session_start();
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ketnoi = "localhost";
$database_ketnoi = "industry";
$username_ketnoi = "root";
$password_ketnoi = "123456";
$ketnoi = mysql_pconnect($hostname_ketnoi, $username_ketnoi, $password_ketnoi) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_ketnoi, $ketnoi);
header('Content-type: text/html; charset:utf-8');
$url="http://localhost/industry/";
?>
