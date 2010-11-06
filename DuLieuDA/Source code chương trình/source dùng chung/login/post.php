<?php
if(isset($_POST['name']) && isset($_POST['mess']))
{

	$n	=	$_POST['name'];
	$m	=	$_POST['mess'];
	if($n != "" && $m!= "")
	{
		echo "Bai viet da duoc dang, cam on ban da comment";
		echo "<br>Ten: $n<br />";
		echo "Noi Dung : $m";
	}
	else
	{
		echo "0";
	}
	
	
}
?>