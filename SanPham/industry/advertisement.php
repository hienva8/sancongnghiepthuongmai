<?php 
$query_rs_ad = "SELECT id_advertise,title,notes,notes_EN,file_image,fileflash,url,width,height,position FROM advertise WHERE position = 'left' AND (date_format(day_end,'%y%m%d') >= date_format(now(),'%y%m%d')) AND visible=1 Order By sort ASC";
$rs_ad = mysql_query($query_rs_ad,$ketnoi) or die(mysql_error());
$row_rs_ad = mysql_fetch_assoc($rs_ad);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="library/js/swfobject.js"></script>
</head>
<body>
	<div class="adds">
        	<center>
          
            <?php do { ?>
             <?php if($row_rs_ad['file_image'] != NULL) {?>
            	<img src="uploads/advertisement/<?php echo $row_rs_ad["file_image"];?>" width="<?php print $row_rs_ad['width'];?>" height="<?php print $row_rs_ad['height'];?>" title="<?php print $row_rs_ad['notes'];?>"/>
            
            <?php } elseif($row_rs_ad['fileflash'] != NULL) {?>
             <div id="<?php echo $row_rs_ad['position']; ?>"></div>
             <script type="text/javascript"> 
    var so = new SWFObject("uploads/advertisement/flashfile/<?php echo $row_rs_ad['fileflash']; ?>", "<?php 
echo $row_rs_ad['position']; ?>", "<?php echo $row_rs_ad['width']; ?>", "<?php 
echo $row_rs_ad['height']; ?>", "8"); 
    so.addParam("FlashVars", "link=<?php echo $row_rs_ad['url']; ?>");  
    so.write("<?php echo $row_rs_ad['position']; ?>"); 
      </script>   
              <?php } ?>
              <?php } while($row_rs_ad = mysql_fetch_assoc($rs_ad)); ?>
            </center>
    </div>
</body>
</html>
<?php 
mysql_free_result($rs_ad);
?>