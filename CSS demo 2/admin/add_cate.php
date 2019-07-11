<?php
session_start();
if ($_SESSION['ses_level'] != 2){
    header("location:login.php");
}
if(isset($_POST['ok'])){
    if($_POST['txttitle'] == NULL){
        echo"Vui lòng nhập tên chuyên mục của bạn <br />";
    }else{
        $c = $_POST['txttitle'];
    }
    if($c){
        $conn=mysqli_connect("localhost","root","","phponline");
        $sql="insert into cate_news(cate_title) values ('$c')";
        mysqli_query($conn,$sql);
        header("location:list_cate.php");
        exit();
    }
}
?>
<form action="add_cate.php" method="post">
    Categorie Name: <input type="text" name="txttitle" size="25"/>
    <input type="submit" name="ok" value="Submit"/>
</form>