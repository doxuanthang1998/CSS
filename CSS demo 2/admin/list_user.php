<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
?>
<script language="JavaScript">
    function kiemtra() {
        if(!window.confirm('Bạn có muốn xóa thành viên này không ?')){
            return false;
        }
    }
</script>
<link href="style.css" rel="stylesheet" type="text/css"/>
<table align="center" width="350">
    <tr>
        <td colspan="2" align="center" class="title"><a href="index.php" class="title">Home</a></td>
        <td colspan="3" align="center" class="title"><a href="add_user.php" class="title">Thêm Thành Viên</a></td>
    </tr>
    <tr>
        <td class="title">STT</td>
        <td class="title">Tên truy cập</td>
        <td class="title">Cấp bậc</td>
        <td class="title">Sửa</td>
        <td class="title">Xóa</td>
    </tr>
    <?php
        $conn=mysqli_connect("localhost","root","","phponline");
        $sql="select * from user order by userid DESC ";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) == 0){
            echo"<tr>";
            echo"<td colspan='5'>Không có dữ liệu</td>";
            echo"</tr>";
        }else{
            $stt=0;
            while ($data=mysqli_fetch_assoc($query)){
                $stt++;
                echo"<tr>";
                echo"<td>$stt</td>";
                echo"<td>$data[username]</td>";
                if($data['level'] == 1){
                    echo"<td>Thành viên</td>";
                }elseif($data['level'] == 2){
                    echo"<td><font color='red'>Quản trị viên</font></td>";
                }
                echo"<td><a href='edit_user.php?uid=$data[userid];'>Sửa</a></td>";
                echo"<td><a href='del_user.php?uid=$data[userid];' onclick='return kiemtra();'>Xóa</a></td>";
                echo"</tr>";
            }
        }
    ?>
</table>
