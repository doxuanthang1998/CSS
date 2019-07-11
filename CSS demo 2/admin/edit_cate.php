<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$conn = mysqli_connect("localhost","root","","phponline");
$id=$_GET['cid'];
if(isset($_POST['ok'])){
    if($_POST['txttitle'] == NULL){
        echo"Vui lòng nhập vào tên chuyên mục của bạn <br />";
    }else{
        $t=$_POST['txttitle'];
    }
    if($t){
        $sql="update cate_news set cate_title='$t' where cate_id='$id'";
        mysqli_query($conn,$sql);
        header("location:list_cate.php");
        exit();
    }
}
$sql="select * from cate_news where cate_id='$id'";
$query=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($query);
?>
<form action="edit_cate.php?cid=<?php echo $data['cate_id'] ?>" method="post">
    Categorie Name: <input type="text" name="txttitle" size="25" value="<?php echo $data['cate_title'] ?>"/><br />
    <input type="submit" name="ok" value="Submit"/>
</form>
