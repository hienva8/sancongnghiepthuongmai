<?php require_once("Connections/ketnoi.php"); ?>
<?php 
$query_rs_menu = "SELECT menu_name,menu_name_EN,url,outlink,notes,notes_EN,target FROM menu WHERE (position = 'index_top1' or position = 'index_top2') Order By sort";
$rs_menu = mysql_query($query_rs_menu);
$row_rs_menu = mysql_fetch_assoc($rs_menu);
?>
<?php 
$query_rs_footer = "SELECT title, content,content_EN FROM footer";
$rs_footer = mysql_query($query_rs_footer,$ketnoi) or die(mysql_error());
$row_rs_footer = mysql_fetch_assoc($rs_footer);
?>
<div id="menu_bot">
    	<ul>
        <?php do {?>
        	<li class="line"><a href="<?php print $row_rs_menu['url'];?>" title="<?php print $row_rs_menu['notes'];?>" target="<?php print $row_rs_menu['target'];?>"><?php print $row_rs_menu['menu_name'] ;?></a>
            </li>
        	<?php } while($row_rs_menu = mysql_fetch_assoc($rs_menu)); ?>
  </ul>                                                            
</div>

<div id="private">
	<h1><?php print $row_rs_footer['content']; ?>
    </h1>
</div>
<div id="coppyright">
	<h1>Copyright Notice © 2010 by Vn-Trade.com</h1>
</div>
