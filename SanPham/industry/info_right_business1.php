<?php require_once("Connections/ketnoi.php"); 
require_once('includes/tng/tNG.inc.php');
?>
<?php
$query_rs_history = "SELECT id_business_history,business_history.id_member,member.member_kind,title,title_EN,short_describe,short_describe_EN,image_illustrate,type FROM (business_history LEFT JOIN member ON business_history.id_member=member.id_member) WHERE type='VIP' AND member.member_kind='VIP' Order By sort ASC LIMIT 0,3";
$rs_history = mysql_query($query_rs_history,$ketnoi) or die(mysql_error());
$row_rs_history = mysql_fetch_assoc($rs_history);
$totalRows_rs_history = mysql_num_rows($rs_history);
$file = "uploads/business/";
$image = $row_rs_history['image_illustrate'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="library/js/contentslider.js"></script>
<link href="library/css/contentslider.css" type="text/css" rel="stylesheet" />
</head>
<body>
		<div class="business">
        	<h1>Câu chuyện doanh nhân</h1>
<?php  do { ?>
          <?php if($totalRows_rs_history > 0) {?>
          <div class="top-bus">
          		
            	<?php if (tNG_fileExists("uploads/business/",$row_rs_history['image_illustrate'])){?><img src="uploads/business/<?php print $row_rs_history['image_illustrate']; ?>" align="left" width="80" />
	<?php } ?>
                <div id="title"><a href="index.php?mod=business&idmen=<?php print $row_rs_history['id_member'];?>"><?php print $row_rs_history['title'];?></a></div>
               <div id="short"> <?php print $row_rs_history['short_describe']; ?></div>
	            <div class="cls"></div>
                 <div id="line"> - - - - - - - - - - - </div>
    </div>
          <?php } ?>
<?php } while($row_rs_history = mysql_fetch_assoc($rs_history));?>
            <div class="top-bus">
              <p align="right"><a href="#" style="color:#003366; text-decoration:none">more <span class="style1">&gt;&gt;</span></a></p>
          </div>            
          <img src="Interface/khung_2.jpg" height="15" align="top" width="220"/>
        </div>
</body>
</html>        
<?php 
mysql_free_result($rs_history);
?>