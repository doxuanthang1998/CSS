<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
if(isset($_POST['ok'])){
    if($_POST['txtuser'] == NULL){
        echo"Vui lòng nhập tên truy cập của bạn <br />";
    }else{
        $u=$_POST['txtuser'];
    }
    if($_POST['txtpass'] == NULL){
        echo"Vui lòng nhập mật khẩu của bạn <br />";
    }else{
        if($_POST['txtpass'] != $_POST['txtpass2']){
            echo"Mật khẩu và xác nhận mật khẩu của bạn không chính xác <br />";
        }else{
            $p=md5($_POST['txtpass']);
        }
    }
    $l=$_POST['level'];
    if($u && $p && $l){
        $conn=mysqli_connect("localhost","root","","phponline");
        $sql="select * from user where username='$u' ";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) == 1){
            echo"Tài khoản này đã tồn tại, vui lòng chọn một tài khoản khác <br />";
        }else{
            $sql="insert into user(username,password,level) values ('$u','$p','$l')";
            mysqli_query($conn,$sql);
            header("location:list_user.php");
            exit();
        }
    }
}
?>
<form action="add_user.php" method="post">
    Cap bac: <select name="level">
        <option value="1">Thanh Vien</option>
        <option value="2">Quan Tri Vien</option>
    </select><br />
    Ten truy cap: <input type="text" name="txtuser" size="25"/><br />
    Mat khau: <input type="password" name="txtpass" size="25"/><br />
    Xac nhan mat khau: <input type="password" name="txtpass2" size="25"/><br />
    <input type="submit" name="ok" value="Submit"/>
</form>
