<?php
$conn=mysqli_connect("localhost","root","","phponline");
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
?>
<script language="JavaScript">
    function kiemtra() {
        if(!window.confirm('Bạn có muốn xóa trang này không ?')){
            return false;
        }
    }
</script>
<link href="style.css" rel="stylesheet" type="text/css"/>
<table width="450" align="center">
    <tr>
        <td colspan="2" align="center" class="title"><a href="index.php" class="title">Home</a> </td>
        <td colspan="2" align="center" class="title"><a href="add_page.php" class="title">Thêm Trang</a> </td>
    </tr>
    <tr>
        <td class="title">STT</td>
        <td class="title">Tên Trang</td>
        <td class="title">Sửa</td>
        <td class="title">Xóa</td>
    </tr>
    <?php
        $sql="select * from page order by page_id DESC ";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) == 0){
            echo"<tr>";
            echo"<td colspan='4'>Chưa có dữ liệu</td>";
            echo"</tr>";
        }else{
            $stt=0;
            while ($data=mysqli_fetch_assoc($query)){
                $stt++;
                echo"<tr>";
                echo"<td>$stt</td>";
                echo"<td>$data[page_title]</td>";
                echo"<td><a href='edit_page.php?pid=$data[page_id];'>Sửa</a></td>";
                echo"<td><a href='del_page.php?pid=$data[page_id];' onclick='return kiemtra();'>Xóa</a></td>";
                echo"</tr>";
            }
        }
    ?>
</table>
