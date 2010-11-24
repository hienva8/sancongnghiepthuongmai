<?php require_once('../../Connections/ketnoi.php'); ?>
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

//$get_id_procat_rs_prosubcat2 = "1";
if (isset($_GET['ipc'])) {
  $get_id_procat_rs_prosubcat2 = $_GET['ipc'];
}
$get_id_prosubcat1_rs_prosubcat2 = "1";
if (isset($_GET['ipsc1'])) {
  $get_id_prosubcat1_rs_prosubcat2 = $_GET['ipsc1'];
}
$get_id_prosubcat2_rs_prosubcat2 = "1";
if (isset($_GET['ipsc2'])) {
  $get_id_prosubcat2_rs_prosubcat2 = $_GET['ipsc2'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat2 = sprintf("SELECT prosubcat2.id_prosubcat2, prosubcat2.id_procat,prosubcat2.id_prosubcat1, prosubcat2.prosubcat2_name, prosubcat2.prosubcat2_name_EN,prosubcat1.prosubcat1_name_EN,prosubcat1.prosubcat1_name,prosubcat1.prosubcat1_name_EN FROM (prosubcat2 LEFT JOIN prosubcat1 ON prosubcat2.id_prosubcat1=prosubcat1.id_prosubcat1) WHERE prosubcat2.id_procat=%s AND prosubcat2.id_prosubcat1=%s AND prosubcat2.id_prosubcat2=%s AND prosubcat2.visible = 1 ORDER BY prosubcat2.sort ASC", GetSQLValueString($get_id_procat_rs_prosubcat2, "int"),GetSQLValueString($get_id_prosubcat1_rs_prosubcat2, "int"),GetSQLValueString($get_id_prosubcat2_rs_prosubcat2, "int"));
$rs_prosubcat2 = mysql_query($query_rs_prosubcat2, $ketnoi) or die(mysql_error());
$row_rs_prosubcat2 = mysql_fetch_assoc($rs_prosubcat2);
$totalRows_rs_prosubcat2 = mysql_num_rows($rs_prosubcat2);
?>
<?php
$get_id_prosubcat1_rs_prosubcat1 = "1";
if (isset($_GET['ipsc1'])) {
  $get_id_prosubcat1_rs_prosubcat1 = $_GET['ipsc1'];
}
$get_id_procat_rs_prosubcat1 = "1";
if (isset($_GET['ipc'])) {
  $get_id_procat_rs_prosubcat1 = $_GET['ipc'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_prosubcat1 = sprintf("SELECT prosubcat1.id_prosubcat1, prosubcat1.id_procat, prosubcat1.prosubcat1_name, prosubcat1.prosubcat1_name_EN, procat.id_procat, procat.procat_name, procat.procat_name_EN FROM (prosubcat1 LEFT JOIN procat ON prosubcat1.id_procat=procat.id_procat) WHERE prosubcat1.id_prosubcat1=%s AND prosubcat1.id_procat=%s", GetSQLValueString($get_id_prosubcat1_rs_prosubcat1, "int"),GetSQLValueString($get_id_procat_rs_prosubcat1, "int"));
$rs_prosubcat1 = mysql_query($query_rs_prosubcat1, $ketnoi) or die(mysql_error());
$row_rs_prosubcat1 = mysql_fetch_assoc($rs_prosubcat1);
$totalRows_rs_prosubcat1 = mysql_num_rows($rs_prosubcat1);

$get_id_procat_rs_products = "1";
if (isset($_GET['ipc'])) {
  $get_id_procat_rs_products = $_GET['ipc'];
}
$get_id_prosubcat2_rs_products = "1";
if (isset($_GET['ipsc2'])) {
  $get_id_prosubcat2_rs_products = $_GET['ipsc2'];
}
mysql_select_db($database_ketnoi, $ketnoi);
$query_rs_products = sprintf("SELECT id_products FROM products WHERE id_prosubcat1 = 123456789 AND id_procat=%s  AND id_prosubcat2=%s AND product_type='product' ORDER BY product_name ASC", GetSQLValueString($get_id_procat_rs_products, "int"),GetSQLValueString($get_id_prosubcat2_rs_products, "int"));
$rs_products = mysql_query($query_rs_products, $ketnoi) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

?>

<div class="bor_1">
        	<img src="../../Interface/home-1.jpg" width="16" height="16" />&nbsp;<span class="st_1"><a href="../../index.php">Home</a>&nbsp;<b> ></b>&nbsp;<a href="#"> <?php echo sanpham;?></a>&nbsp;<b> ></b>&nbsp;<a href="index.php?mod=psc1&ipc=<?php echo $row_rs_prosubcat1['id_procat']; ?>"><?php echo $row_rs_prosubcat1['procat_name']; ?></a>&nbsp;<b> ></b>&nbsp;<?php echo $row_rs_prosubcat1['prosubcat1_name']; ?></span></div>
<div class="cates">
        	<fieldset>            
            	<legend>Ngành nghề</legend>            	 
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rs_prosubcat2 > "") {
?>
                  <table border="0">
                    <tr>
                      <?php $i=0;?>      
                      <?php do { 
			$i++;
	      ?>
                      <td><img src="../../Interface/icon_2.jpg" width="5" height="9" /><a href="index.php?mod=psc3&ipc=<?php echo $row_rs_prosubcat2['id_procat'];?>&ipsc1=<?php echo $row_rs_prosubcat2['id_prosubcat1'];?>&ipsc2=<?php echo $row_rs_prosubcat2['id_prosubcat2']; ?>"> <?php echo $row_rs_prosubcat2['prosubcat2_name']; ?></a><span class="number">       
                      <?php
  if ($totalRows_rs_prosubcat2>0) {
    $nested_query_rs_products = str_replace("123456789", $row_rs_prosubcat2['id_prosubcat1'], $query_rs_products);
    mysql_select_db($database_ketnoi);
    $rs_products = mysql_query($nested_query_rs_products, $ketnoi) or die(mysql_error());
    $row_rs_products = mysql_fetch_assoc($rs_products);
    $totalRows_rs_products = mysql_num_rows($rs_products);
    $nested_sw = false;
    if (isset($row_rs_products) && is_array($row_rs_products)) {
    
?>
                          <?php
  //rs_products show if first nested loop version 3
  if (!isset($nested_sw) || $nested_sw == false) {
    $nested_sw = true;
  } else {
?>
                            ,
                          <?php
  } // end show if first nested loop version 3
?>
                          (<?php echo $totalRows_rs_products; ?>)
                          <?php
    
    }
  }
?>
                          </span> </td>
                      <?php if($i%4==0) echo "</tr><tr class='tr'>";  ?> 
                      <?php } while ($row_rs_prosubcat2 = mysql_fetch_assoc($rs_prosubcat2)); ?>
                      </tr>          
                                  </table>
                  <?php 
// else Conditional region1
} else { ?>
                  <?php echo hienchuaconganhnghe;?>
  <?php } 
// endif Conditional region1
?></fieldset>    
</div>
<?php
mysql_free_result($rs_prosubcat2);

mysql_free_result($rs_prosubcat1);

mysql_free_result($rs_products);
?>
