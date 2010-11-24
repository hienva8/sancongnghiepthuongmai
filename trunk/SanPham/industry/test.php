<?php 
function search_array($str) 
{
	$array = array(a=>'a');
	$khoa  = array_search($str,$array);
	return $khoa;
}
$str = 'a';
echo search_array($str);


?>