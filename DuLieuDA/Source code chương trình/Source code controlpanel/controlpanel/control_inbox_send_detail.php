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

$session_member_rs_inbox = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $session_member_rs_inbox = $_SESSION['kt_login_id'];
}
$get_id_inbox_rs_inbox = "-1";
if (isset($_GET['iibx'])) {
  $get_id_inbox_rs_inbox = $_GET['iibx'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_inbox = sprintf("SELECT inbox.*,member_user FROM (inbox LEFT JOIN member ON id_member=inbox_sender) WHERE inbox_sender= %s AND id_inbox=%s", GetSQLValueString($session_member_rs_inbox, "int"),GetSQLValueString($get_id_inbox_rs_inbox, "int"));
$rs_inbox = mysql_query($query_rs_inbox, $ketnoi) or die(mysql_error());
$row_rs_inbox = mysql_fetch_assoc($rs_inbox);
$totalRows_rs_inbox = mysql_num_rows($rs_inbox);

$sender_rs_member_sender = "-1";
if (isset($row_rs_inbox['inbox_sender'])) {
  $sender_rs_member_sender = $row_rs_inbox['inbox_sender'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_sender = sprintf("SELECT id_member,company_name,country_name,country_image_illustrate FROM ((member LEFT JOIN company ON member.id_member=company.company_id_member)LEFT JOIN country ON member.member_id_country=country.id_country) WHERE id_member = %s", GetSQLValueString($sender_rs_member_sender, "int"));
$rs_member_sender = mysql_query($query_rs_member_sender, $ketnoi) or die(mysql_error());
$row_rs_member_sender = mysql_fetch_assoc($rs_member_sender);
$totalRows_rs_member_sender = mysql_num_rows($rs_member_sender);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../library/css/style_controlpanel.css" rel="stylesheet" type="text/css" />

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

</head>

<body>
<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
<div id="inbox_detail">
	<div class="inbox_detail_line">
	    <div class="inbox_detail_line_left"><label><?php echo nguoigui;?>:</label></div>
		<div class="inbox_detail_line_mid"><?php echo $row_rs_inbox['member_user']; ?></div>
     
<div class="inbox_detail_line">
	    <label><?php echo ngaygui;?>:</label><span class="font12"><?php echo date('d-m-Y | h:s',strtotime($row_rs_inbox['inbox_day_update'])); ?></span>
    </div>
	<div class="inbox_detail_line">
    	<label><?php echo nguoinhan;?></label><?php echo $row_rs_inbox['inbox_email']; ?>
    </div>

    <div class="inbox_detail_line">
	    <label><?php echo chude;?>:</label><?php echo $row_rs_inbox['inbox_subject']; ?>
    </div>
    <div class="inbox_detail_line">
	    <label><?php echo noidung;?>:</label><span class="font12"><?php echo $row_rs_inbox['inbox_content']; ?></span>
    </div>
    <div class="inbox_detail_line">
	    <?php /*?><input type="submit" name="traloi" value="<?php echo traloi;?>" /><?php */?>
    </div>
       
</div>
</form>
</body>
</html>
<?php
mysql_free_result($rs_inbox);

mysql_free_result($rs_member_sender);
?>
