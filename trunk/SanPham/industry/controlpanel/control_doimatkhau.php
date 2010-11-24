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

$colname_rs_member_change = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_rs_member_change = $_SESSION['kt_login_id'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_change = sprintf("SELECT id_member, member_user, member_password FROM member WHERE id_member = %s", GetSQLValueString($colname_rs_member_change, "int"));
$rs_member_change = mysql_query($query_rs_member_change, $ketnoi) or die(mysql_error());
$row_rs_member_change = mysql_fetch_assoc($rs_member_change);
$totalRows_rs_member_change = mysql_num_rows($rs_member_change);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="khung_doimatkhau">
<?php
if(isset($_SESSION['kt_login_id']))
{
 // tại đây thực thi các hoạt động khi đăng nhập thành công.
}
else
{
 header("location: ../index.php?mod=login");
 exit();
}
?>

<?php
$sql="select * from member where id_member='".$colname_rs_member_change."'";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);
?>

<?php
if(isset($_POST['ok']))
{
if($_POST['oldpass']!=$row_rs_member_change['member_password'])
	{
		echo "&bull; <font color=red>".saimatkhau."</font><br />";
	}else {
	$oldp = $_POST['oldpass'];
	}

 if($_POST['pass'] != $_POST['repass'])
 {
  echo "&bull; <font color=red>".matkhauvanhaplaimatkhaukhongdung."</font><br />";
 }
 else if($_POST['pass']==NULL or $_POST['repass']==NULL)
 {
 	echo "&bull; <font color=red>".vuilongnhapmatkhaucandoi."</font><br />";
 }else
 {
  if($_POST['pass'] != NULL)
  {
   $p=md5(stripslashes($_POST['pass']));
  }
 }
?>
<?php
if($p && $oldp)
{
 $sql="update member set member_password='".$p."' where id_member='".$colname_rs_member_change."'";
 mysql_query($sql);
 header("location:index.php");
 exit();
}

}
?>
<form action="index.php?mod=fpw&amp;imb=<?=$colname_rs_member_change?>" method=post>

<label><?php echo tendangnhap;?>:</label> <font color="red" style="font-weight:900"><?=$row_rs_member_change['member_user']?></font><br />
<label><?php echo matkhaucu;?>:</label> <input type=password name=oldpass size=20 /> <br />
<label><?php echo matkhau;?>:</label> <input type=password name=pass size=20 /> <br />
<label><?php echo nhaplaimatkhau;?>:</label> <input type=password name=repass size=20 /><br />
<input type=submit name=ok value="<?php echo sua;?>" />

</form>
</div>
</body>
</html>
<?php
mysql_free_result($rs_member_change);
?>
