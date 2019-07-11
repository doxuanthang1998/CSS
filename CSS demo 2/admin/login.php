<?php
session_start();
$u='';
if(isset($_POST['ok'])){
	if($_POST['txtuser'] == NULL){
		echo "Vui lòng nhập tên truy cập của bạn<br />";
	}else{
		$u=$_POST['txtuser'];
	}
	if($_POST['txtpass'] == NULL){
		echo "Vui lòng nhập mật khẩu của bạn <br />";
	}else{
		$p=$_POST['txtpass'];
	}
	if($u && $p){
	    $conn = mysqli_connect("localhost","root","","phponline");
	    $sql="select * from user where username='$u' and password='$p'";
		$query=mysqli_query($conn,$sql);
		if(mysqli_num_rows($query) == 0){
			echo "Tên truy cập và mật khẩu không chính xác, vui lòng thử lại.";
		}else{
			$data=mysqli_fetch_assoc($query);
			$_SESSION['ses_username']=$data['username'];
			$_SESSION['ses_level']=$data['level'];
			$_SESSION['ses_userid']=$data['userid'];
			header("location:index.php");
			exit();
		}
	}
}
?>
<form action="login.php" method="post">
Username: <input type="text" name="txtuser" size="25" /><br />
Password: <input type="password" name="txtpass" size="25" /><br />
<input type="submit" name="ok" value="Login" />
</form>