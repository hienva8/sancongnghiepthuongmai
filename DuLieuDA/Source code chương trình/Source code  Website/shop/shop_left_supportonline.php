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

$get_id_member_rs_supportonline = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_supportonline = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_supportonline = sprintf("SELECT humanname_help,humansex_help, tel, nickname, status FROM supportonline WHERE id_member=%s AND visible = 1 ORDER BY sort ASC", GetSQLValueString($get_id_member_rs_supportonline, "int"));
$rs_supportonline = mysql_query($query_rs_supportonline, $ketnoi) or die(mysql_error());
$row_rs_supportonline = mysql_fetch_assoc($rs_supportonline);
$totalRows_rs_supportonline = mysql_num_rows($rs_supportonline);

$get_id_member_rs_member_support = "-1";
if (isset($_GET['imb'])) {
  $get_id_member_rs_member_support = $_GET['imb'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_member_support = sprintf("SELECT id_member,member_vip FROM member WHERE member_vip = 1 AND id_member=%s", GetSQLValueString($get_id_member_rs_member_support, "int"));
$rs_member_support = mysql_query($query_rs_member_support, $ketnoi) or die(mysql_error());
$row_rs_member_support = mysql_fetch_assoc($rs_member_support);
$totalRows_rs_member_support = mysql_num_rows($rs_member_support);
?>
 <?php 
// Show IF Conditional region1 
if (@$row_rs_member_support['member_vip'] == 1) {
?>
 <?php if ($totalRows_rs_supportonline > 0) { // Show if recordset not empty ?>
    
       <div class="business">
         <h1><?php echo hotrotructuyen;?></h1>
         <?php do { ?>
           <div id="info_help">
             <p style="padding:7px 0px 5px 45px;"><a href="ymsgr:sendIM?<?php echo $row_rs_supportonline['nickname']; ?>&amp;m=<?php echo lienhequangcao;?> http://vntrade360.com" title="<?php echo lienhequangcao;?>"> <img src="http://mail.opi.yahoo.com/online?u=<?php echo $row_rs_supportonline['nickname']; ?>&amp;m=g&amp;t=2" alt="<?php echo $row_rs_supportonline['status']; ?>" vspace="1" border="0" /></a></p>
             <center>
               <p class="style_help_3"><?php echo $row_rs_supportonline['humansex_help']; ?>.<?php echo $row_rs_supportonline['humanname_help']; ?> | <?php echo $row_rs_supportonline['tel']; ?></p>
             </center>
           </div>
           <?php } while ($row_rs_supportonline = mysql_fetch_assoc($rs_supportonline)); ?>
         <center>
           <img src="../interface/khung_2_1.jpg" />
         </center>
       </div>
     <?php } // Show if recordset not empty ?>
     <?php } 
// endif Conditional region1
?>
<?php
mysql_free_result($rs_supportonline);

mysql_free_result($rs_member_support);
?>
