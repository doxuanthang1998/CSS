<?php
session_start();
if($_SESSION['ses_level'] != 2){
	header("location:login.php");
	exit();
}
?>
<link href='style.css' rel='stylesheet' type='text/css' />
<table align='center' width='750'>
	<tr>
		<td colspan='7' class='title'>Chào bạn, <?php echo $_SESSION['ses_username'];?> </td>
	</tr>
	<tr>
		<td><a href='add_cate.php'>Thêm Chuyên Mục</a></td>
		<td><a href='list_cate.php'>Quản Lý Chuyên Mục</a></td>
		<td><a href='add_news.php'>Thêm Tin Tức</a></td>
		<td><a href='list_news.php'>Quản Lý Tin Tức</a></td>
		<td><a href='add_user.php'>Thêm Thành Viên</a></td>
		<td><a href='list_user.php'>Quản Lý Thành Viên</a></td>

	</tr>
    <tr>
        <td colspan="2"><a href="add_page.php">Thêm Trang</a></td>
        <td colspan="2"><a href="list_page.php">Quản Lý Trang</a></td>
        <td colspan="2"><a href='logout.php'>Đăng Xuất</a></td>
    </tr>
</table>

