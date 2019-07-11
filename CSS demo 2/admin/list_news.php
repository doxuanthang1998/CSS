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
        if(!window.confirm('Bạn có chắc muốn xóa bản tin này không ?')){
            return false;
        }
    }
</script>
<link href="style.css" type="text/css" rel="stylesheet"/>
<table align="center" width="500">
    <tr>
        <td colspan="2" align="center" class="title"><a href="index.php" class="title">Home</a> </td>
        <td colspan="5" align="center" class="title"><a href="add_news.php" class="title">Thêm Tin Tức</a></td>
    </tr>
    <tr>
        <td class="title">STT</td>
        <td class="title">Tiêu đề</td>
        <td class="title">Chuyên mục</td>
        <td class="title">Tác giả</td>
        <td class="title">Kiểm duyệt</td>
        <td class="title">Sửa</td>
        <td class="title">Xóa</td>
    </tr>
    <?php
        $sql="select news_id,news_title,cate_title,news_author,news_check from news as n, cate_news as cn, user as u where 
n.cate_id=cn.cate_id and n.userid=u.userid order by news_id DESC ";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) == 0){
            echo"<tr>";
            echo"<td colspan='7'>Không có dữ liệu</td>";
            echo"</tr>";
        }else{
            $stt=0;
            while($data=mysqli_fetch_assoc($query)){
                $stt++;
                echo"<tr>";
                echo"<td>$stt</td>";
                echo"<td>$data[news_title]</td>";
                echo"<td>$data[cate_title]</td>";
                echo"<td>$data[news_author]</td>";
                if($data['news_check'] == "Y"){
                    echo"<td>Duyệt</td>";
                }else{
                    echo"<td><font color='red'>Chưa duyệt</font></td>";
                }
                echo"<td><a href='edit_news.php?nid=$data[news_id];'>Sửa</a></td>";
                echo"<td><a href='del_news.php?nid=$data[news_id];' onclick='return kiemtra();'>Xóa</a></td>";
                echo"</tr>";
            }
        }
    ?>
</table>
