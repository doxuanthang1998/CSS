<?php
$conn=mysqli_connect("localhost","root","","phponline");
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
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
    $uid=$_SESSION['ses_userid'];
    if($t && $a && $i && $f && $ca && $ch){
        if($img != "none"){
            $sql="insert into news(news_title,news_author,news_info,news_full,cate_id,news_img,news_check,userid) values ('$t','$a','$i','$f','$ca','$img','$ch','$uid')";
        }else{
            $sql="insert into news(news_title,news_author,news_info,news_full,cate_id,news_check,userid) values ('$t','$a','$i','$f','$ca','$ch','$uid')";
        }
        mysqli_query($conn,$sql);
        header("location:list_news.php");
        exit();
    }
}
?>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<form action="add_news.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Chuyen  muc</td>
            <td><select name="cate">
                    <?php
                        $sql="select * from cate_news";
                        $query=mysqli_query($conn,$sql);
                        while($data=mysqli_fetch_assoc($query)){
                            echo"<option value='$data[cate_id]'>$data[cate_title]</option>";
                        }
                    ?>
                </select> </td>
        </tr>
        <tr>
            <td>Tieu de</td>
            <td><input type="text" name="txttitle" size="25"/></td>
        </tr>
        <tr>
            <td>Tac gia</td>
            <td><input type="text" name="txtauthor" size="25"/></td>
        </tr>
        <tr>
            <td>Mo ta</td>
            <td><textarea name="txtinfo" cols="30" rows="5"></textarea> </td>
        </tr>
        <tr>
            <td>Chi tiet</td>
            <td><textarea name="txtfull" cols="30" rows="15"></textarea> </td>
        </tr>
        <script type="text/javascript">
            CKEDITOR.replace('txtfull');
        </script>
        <tr>
            <td>Kiem duyet</td>
            <td><input type="radio" name="check" value="Y"/>Yes
                <input type="radio" name="check" value="N"/>No
            </td>
        </tr>
        <tr>
            <td>Hinh anh</td>
            <td><input type="file" name="img" size="35"/> </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="ok" value="Submit"/> </td>
        </tr>
    </table>
</form>
