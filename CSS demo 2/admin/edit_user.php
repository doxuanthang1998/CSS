<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$conn=mysqli_connect("localhost","root","","phponline");
$id=$_GET['uid'];
if(isset($_POST['ok'])){
    if($_POST['txtuser'] == NULL){
        echo"Vui lòng nhập vào tên truy cập của bạn <br />";
    }else{
        $u=$_POST['txtuser'];
    }
    if($_POST['txtpass'] != $_POST['txtpass2']){
        echo"Mật khẩu và xác nhận mật khẩu không chính xác <br />";
    }else{
        if($_POST['txtpass'] != NULL){
            $p=md5($_POST['txtpass']);
        }else{
            $p="none";
        }
    }
    $l=$_POST['level'];
    if($u && $p && $l){
        $sql="select * from user where username='$u' and userid != '$id'";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) == 1){
            echo"Tên truy cập này đã có người sử dụng, vui lòng thử với tên truy cập khác <br />";
        }else{
            if($p != "none"){
                $sql="update user set username='$u',password='$p',level='$l' where userid='$id'";
            }else{
                $sql="update user set username='$u',level='$l' where userid='$id'";
            }
            mysqli_query($conn,$sql);
            header("location:list_user.php");
            exit();
        }
    }
}
$sql="select * from user where userid='$id'";
$query=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($query);
?>
<form action="edit_user.php?uid=<?php echo $data['userid']; ?>" method="post">
    Cap bac: <select name="level">
        <option value="1" <?php if($data['level'] == 1) echo"selected"; ?>>Thanh Vien</option>
        <option value="2" <?php if($data['level'] == 2) echo"selected"; ?>>Quan Tri Vien</option>
    </select><br />
    Ten truy cap: <input type="text" name="txtuser" size="25" value="<?php echo $data['username']; ?>"/><br />
    Mat khau: <input type="password" name="txtpass" size="25"/><br />
    Xac nhan mat khau: <input type="password" name="txtpass2" size="25"/><br />
    <input type="submit" name="ok" value="Submit"/>
</form>
