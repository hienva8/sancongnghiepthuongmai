<?php 
require_once("Connections/ketnoi.php");
?>
<?php 
if(isset($_POST['ok']))
{
	if($_POST['kt_login_user'] == NULL)	
	{
		echo "Please enter username";
	}
	else
	{
		$u = stripslashes($_POST['kt_login_user']);
	}
	if($_POST['kt_login_password'] == NULL)
	{
		echo "please enter password";
	}
	else
	{
		$p = md5(stripslashes($_POST['kt_login_password']));
	}
	if($u && $p)
	{
		$sql = "SELECT * FROM member WHERE member_user='$u' AND member_password='$p'";
		$query = mysql_query($sql,$ketnoi) or die(mysql_error());
		if(mysql_num_rows($query) == 0)
		{
			echo "Wrong username or password";
		}
		else
		{
			$row = mysql_fetch_assoc($query);
			session_start();
			session_register("kt_login_user");
			$_SESSION['kt_login_user'] = $row['member_user'];
			
			session_register("kt_login_id");
			$_SESSION['kt_login_id']   = $row['id_member'] ;
			
			session_register("kt_login_level");
			$_SESSION['kt_login_level'] = $row['member_accesslevel'];
			
			setcookie("kt_login_id",$row['member_user'],time() + 3600 );
			header("location:login_success.php");
			exit();
		}
	}
}
echo "<br />".$u."<br />".$p."<br />";
echo "<br />".$row['kt_login_user']."<br />"; 
echo $row['kt_login_password'];
echo $sql;
?>