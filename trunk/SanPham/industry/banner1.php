<?php
// Require the MXI classes
require_once ('includes/mxi/MXI.php');
?><?php require_once('Connections/ketnoi.php'); ?>
<?php 
$query_rs_banner1 = "SELECT id_menu,menu_name,menu_name_EN,url,outlink,notes,notes_EN,target FROM menu WHERE visible=1 AND position='index_top1' ORDER BY sort ASC";
$rs_banner1 = mysql_query($query_rs_banner1,$ketnoi) or die(mysql_error());
$Total_rs_banner1 = mysql_num_rows($rs_banner1);
?>
<?php 
$query_rs_banner2 = "SELECT id_menu,menu_name,menu_name_EN,url,outlink,notes,notes_EN,target FROM menu WHERE visible=1 AND position='index_top2' ORDER BY sort ASC";
$rs_banner2 = mysql_query($query_rs_banner2,$ketnoi) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>San Giao Dich Cong Nghiep </title>
</head>

<body>
<div id="banner">
	<div id="ig">
      <?php
  mxi_includes_start("choose_language.php");
  require(basename("choose_language.php"));
  mxi_includes_end();
?>
</div>
<div id="menu_banner">
      <ul>
      <?php while($row_rs_banner1 = mysql_fetch_assoc($rs_banner1)){?>
       	<li class="text-uppercase"><a href="<?php echo $row_rs_banner1['url']; ?>" class="line" title="<?php echo $row_rs_banner1['notes'];?>">
		<?php echo $row_rs_banner1['menu_name']; ?>
        </a>
        <?php } ?>
        </li>
      </ul>
  </div>
    <div id="menu-container">
    	<ul id="navigationMenu">
			<center>
            <?php while($row_rs_banner2 = mysql_fetch_assoc($rs_banner2)){?>
            <li><a href="<?php echo $row_rs_banner2['url']; ?>" title="<?php echo $row_rs_banner2['notes'];?>" class="normalMenu">
		<?php echo $row_rs_banner2['menu_name']; ?>
            </a></li>
            <?php }  ?>
            </center>
		</ul>
  </div>   
</div>
</body>
</html>