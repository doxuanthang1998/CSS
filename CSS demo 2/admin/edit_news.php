<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$conn=mysqli_connect("localhost","root","","phponline");
$id=$_GET['nid'];
if(isset($_POST['ok'])){
    if($_POST['txttitle'] == NULL){
        echo"Vui lòng nhập tiêu đề bản tin <br />";
    }else{
        $t=$_POST['txttitle'];
    }
    if($_POST['txtauthor'] == NULL){
        echo"Vui lòng nhập tác giả bản tin <br />";
    }else{
        $a=$_POST['txtauthor'];
    }
    if($_POST['txtinfo'] == NULL){
        echo"Vui lòng nhập mô tả bản tin <br />";
    }else{
        $i=$_POST['txtinfo'];
    }
    if($_POST['txtfull'] == NULL){
        echo"Vui lòng nhập chi tiết bản tin <br />";
    }else{
        $f=$_POST['txtfull'];
    }
    if($_FILES['img']['name'] != NULL){
        move_uploaded_file($_FILES['img']['tmp_name'],"../data/".$_FILES['img']['name']);
        $img=$_FILES['img']['name'];
    }else{
        $img="none";
    }
    $ca=$_POST['cate'];
    $ch=$_POST['check'];
    if($t && $a && $i && $f && $img && $ca && $ch){
        if($img != "none"){
            $sql="update news set news_title='$t',news_author='$a',news_info='$i',news_full='$f',news_img='$img',cate_id='$ca',news_check='$ch' where news_id='$id'";
        }else{
            $sql="update news set news_title='$t',news_author='$a',news_info='$i',news_full='$f',cate_id='$ca',news_check='$ch' where news_id='$id'";
        }
        mysqli_query($conn,$sql);
        header("location:list_news.php");
        exit();
    }
}
$sql="select * from news where news_id='$id'";
$query=mysqli_query($conn,$sql);
$data2=mysqli_fetch_assoc($query);
?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<form action="edit_news.php?nid=<?php echo $data2['news_id'];?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Chuyên mục</td>
            <td><select name="cate">
                    <?php
                    $sql="select * from cate_news";
                    $query=mysqli_query($conn,$sql);
                    while($data=mysqli_fetch_assoc($query)){
                        if($data2['cate_id'] == $data['cate_id']){
                            echo"<option value='$data[cate_id]' selected='selected'>$data[cate_title]</option>";
                        }else{
                            echo"<option value='$data[cate_id]'>$data[cate_title]</option>";
                        }
                    }
                    ?>
                </select> </td>
        </tr>
        <tr>
            <td>Tiêu đề</td>
            <td><input type="text" name="txttitle" size="25" value="<?php echo $data2['news_title']; ?>"/></td>
        </tr>
        <tr>
            <td>Tác giả</td>
            <td><input type="text" name="txtauthor" size="25" value="<?php echo $data2['news_author']; ?>"/></td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td><textarea name="txtinfo" cols="30" rows="5"><?php echo $data2['news_info']; ?></textarea> </td>
        </tr>
        <tr>
            <td>Chi tiết</td>
            <td><textarea name="txtfull" cols="30" rows="15"><?php echo $data2['news_full']; ?></textarea> </td>
        </tr>
        <script type="text/javascript">
            CKEDITOR.replace('txtfull');
        </script>
        <tr>
            <td>Kiểm duyệt</td>
            <td><input type="radio" name="check" value="Y" <?php if($data2['news_check'] == "Y") echo"checked='checked'"; ?>/>Yes
                <input type="radio" name="check" value="N" <?php if($data2['news_check'] == "N") echo"checked='checked'"; ?>/>No
            </td>
        </tr>
        <?php
        if($data2['news_img'] != "none"){
            echo"<tr>";
            echo"<td>Hình ảnh cũ</td>";
            echo"<td><img src='../data/$data2[news_img]' width='150'/></td>";
            echo"</tr>";
        }
        ?>
        <tr>
            <td>Hình ảnh</td>
            <td><input type="file" name="img" size="35"/> </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="ok" value="Submit"/></td>
        </tr>
    </table>
</form>