<?php 
session_start();
function member_VIP($rs)
{
	$business = 'business';
	$member = 'member';
	if(strlen($rs)==6)
		return $member;
	else 
		return $business;
}


function deleteRS($get_ip,$table,$id_products,$imb)
{
if($get_ip)
{ 
  $query_rs_table="delete from $table where $id_products = $get_ip AND id_member=$imb";
  $rs_table=mysql_query($query_rs_table);
  if ($rs_table)
  {
  	echo "<script>window.location.href = 'javascript:history.back()';</script>";
  }
  else
  {
  	echo "<script>alert('Xoa khong thanh cong');window.location.href = 'javascript:history.back()';</script>";
  }
 }
}

function contropanel_title()
{
$get_mod = $_GET['mod'];
switch($get_mod) {
	case "lp":
		echo "&raquo;&nbsp;".danhsachsanpham;
		break;
	case "fp":
		if(isset($_GET['id_products']))
		echo "&raquo;&nbsp;".suasanpham;
		else
		echo "&raquo;&nbsp;".themsanpham;
		break;
	case "ls":	
		echo "&raquo;&nbsp;".danhsachchaoban;
		break;
	case "fs":
		if(isset($_GET['id_products']))
		echo "&raquo;&nbsp;".suachaoban;
		else
		echo "&raquo;&nbsp;".dangchaoban;
		break;
	case "lb":
		echo "&raquo;&nbsp;".danhsachchaomua;
		break;
	case "fb":
		if(isset($_GET['id_products']))
		echo "&raquo;&nbsp;".suachaomua;
		else
		echo "&raquo;&nbsp;".dangchaomua;
		break;
	case "fsv":
		if(isset($_GET['id_services']))
		echo "&raquo;&nbsp;".suadichvu;
		else
		echo "&raquo;&nbsp;".dangdichvu;
		break;
	case "lsv":	
		echo "&raquo;&nbsp;".danhsachdichvu;
		break;
	case "libx":
		echo "&raquo;&nbsp;".hopthu;
		break;
	case "libxsent":
		echo "&raquo;&nbsp;".thudagui;
		break;
	case "libxdel":
		echo "&raquo;&nbsp;".thudaxoa;
		break;
	case "fcomposemail":
		echo "&raquo;&nbsp;".soanthu;
		break;
	case "facc":
		echo "&raquo;&nbsp;".thongtintaikhoan;
		break;
	case "fbsn":
		echo "&raquo;&nbsp;".thongtindoanhnghiep;
		break;
	case "fct_info":
		echo "&raquo;&nbsp;".thongtinlienhe;
		break;
	case "fpw":
		echo "&raquo;&nbsp;".doimatkhau;
		break;
	case "lsupport":
		echo "&raquo;&nbsp;".hotrotructuyen;
		break;
	}
}
function delfile($filename)
{
if(is_file($filename)){
if (!unlink($filename)) 
	return false;
else 
	return true;
}
}
////////////////
function ghichu() 
{
	echo "
	<div style='vertical-align:middle; text-align:center;background-color:#EBEBEB; padding:10px 20px width:95%; height:30px; border:1px solid #99CCFF;clear:both; line-height:30px'>";	
	echo vuilongnhapnoidung;
	echo "</div>";
}
///////////////////dua thu vao thung rac
function delinbox($table,$attributes,$id_name,$get_id_mail)
{
	$query_rs_table = "UPDATE $table SET $attributes=1 WHERE $id_name=$get_id_mail";
	 $rs_table=mysql_query($query_rs_table);

}
///////////////////xoa thu thung rac va thu da gui
function delmail($table,$id_name,$get_id_mail)
{
	$query_rs_table = "DELETE *FROM $table  WHERE $id_name=$get_id_mail";
	 $rs_table=mysql_query($query_rs_table);
}
////////////////////function catchuoi() 2 tham so: chuoi va vi tri cat
function getstr($chuoi,$gioihan){
    if(strlen($chuoi)<=$gioihan)
    {
        return $chuoi;
    }
    else{
        /* 
		so sanh vi tri cat voi ki tu khoang trang dau tien trong chuoi ban dau tinh tu vi tri cat, neu vi tri khoang trang lon hon thi cat chuoi tai vi tri khoang trang do 
        */
        if(strpos($chuoi," ",$gioihan) > $gioihan){
            $new_gioihan=strpos($chuoi," ",$gioihan);
            $new_chuoi = substr($chuoi,0,$new_gioihan)."...";
            return $new_chuoi;
        }
		// con lai
        $new_chuoi = substr($chuoi,0,$gioihan)."...";
        return $new_chuoi;
    }
}
///////////////////////////KIEM TRA LEVEL USER
function check_level($duongdan1,$duongdan2)
{
 if($_SESSION['kt_login_level']==1)
	{
		return $duongdan = $duongdan1;
	}
	else
	{
		return $duongdan = $duongdan2;
	}
}
?>