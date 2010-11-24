<?php
// Require the MXI classes
require_once ('includes/mxi/MXI.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title><link href="library/CSS/style_contac.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="khung_contact">
<div id="contact1"><a href="index.php"><?php echo trangchu;?></a>&nbsp;&raquo;&nbsp;<?php echo dangnhap;?></div>
<div id="contact2">
	<div id="contact2_1">
    	<div id="title" class="background_title">&nbsp;&reg;&nbsp;Quyền lợi khi tham gia thành viên với vnTrade360:&nbsp;</div>
        <div id="content1">
    	<ul>
		    <li>&nbsp;&bull;&nbsp;Tạo văn phòng trực tuyến cho Doanh nghiệp, Cá nhân.</li>
		    <li>&nbsp;&bull;&nbsp;Đăng và quản lý sản phẩm của Doanh nghiệp, Cá nhân.</li>
		    <li>&nbsp;&bull;&nbsp;Đăng và quản lý các thông tin chào bán, chào mua</li>
		    <li>&nbsp;&bull;&nbsp;Gửi yêu cầu bán, yêu cầu mua đến khách hàng tiềm năng</li>
            <li>&nbsp;&bull;&nbsp;Và một số quyền lợi hấp dẫn khác ... <a href="index.php?mod=right"><?php echo chitiet;?></a></li>
        </ul>
       </div>
    </div>
<div id="contact2_2"> 
<?php
  mxi_includes_start("login/login.php");
  require(basename("login/login.php"));
  mxi_includes_end();
?>
</div>
<div id="contact2_3">
<ul>
	<li><img src="uploads/advertisement/1_LOGO TV THU NHO(8).jpg" width="480" height="70" /></li>
    <li><img src="uploads/advertisement/slide4.jpg" width="480" height="70" /></li>
    </ul>
</div>
</div>

</div>
</body>
</html>
