<?php 
require_once("../Connections/ketnoi.php");
require_once("../library/functions/functions.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
$table 			= "inbox";
$attributes 	= "inbox_recycle_bin";
$attributes1 	= "inbox_sent";
$id_name 		= "id_inbox";
$get_id_mail 	= $_GET['iibx'];


////////xoa thu da gui
if(($_GET['mod']='libxsent') && isset($get_id_mail))
{
	delinbox($table,$attributes1,$id_name,$get_id_mail);
}
////////xoa inbox
if(($_GET['mod']='libx') && isset($get_id_mail))
{
	delinbox($table,$attributes,$id_name,$get_id_mail);
}

///////xoa thu trong csdl
if(($_GET['mod']='ibxdel') && isset($get_id_mail))
{
	delmail($table,$id_name,$get_id_mail);
}

?>
<body>
</body>
</html>
