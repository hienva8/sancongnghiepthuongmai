<?php require_once("Connections/ketnoi.php"); 
require_once('includes/tng/tNG.inc.php');
?>
<?php
$query_rs_history = "SELECT id_business_history,business_history.id_member,member.member_kind,title,title_EN,short_describe,short_describe_EN,image_illustrate FROM (business_history LEFT JOIN member ON business_history.id_member=member.id_member) WHERE visible=1 Order By sort ASC LIMIT 0,3";
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
  <h1><?php echo cauchuyendoanhnhan;?></h1>

  	<div id="slider1" class="sliderwrapper">    
	<?php  do { ?>

          <?php if($totalRows_rs_history > 0) {?>
         <div class="contentdiv">
            	<?php if (tNG_fileExists("uploads/business/",$row_rs_history['image_illustrate'])){?><img src="uploads/business/<?php print $row_rs_history['image_illustrate']; ?>" align="left" width="80" style="margin:0px 3px 3px 0px; border:1px ridge #CCCCCC;" />
	<?php } ?>
                <div><a href="index.php?mod=business_history&amp;ibn_his=<?php print $row_rs_history['id_business_history']; ?>"><?php print $row_rs_history['title'];?></a></div>
               <div style="margin-top:3px;"> <?php print $row_rs_history['short_describe']; ?></div>   
               <div class="clear"></div>
    	</div>
          <?php } ?>

	<?php } while($row_rs_history = mysql_fetch_assoc($rs_history));?>
	</div>
<div id="paginate-slider1" class="pagination"></div>
<img src="Interface/khung_2.jpg" height="15" align="top" width="220"/>          
</div>


<script type="text/javascript">

featuredcontentslider.init({
id: "slider1", //id of main slider DIV
contentsource: ["inline", ""], //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
toc: "#increment", //Valid values: "#increment", "markup", ["label1", "label2", etc]
nextprev: ["Previous", "Next"], //labels for "prev" and "next" links. Set to "" to hide.
enablefade: [true, 0.2], //[true/false, fadedegree]
autorotate: [true, 3000], //[true/false, pausetime]
onChange: function(previndex, curindex){ //event handler fired whenever script changes slide
//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
}
})

</script>
</body>
</html>        
<?php 
mysql_free_result($rs_history);
?>