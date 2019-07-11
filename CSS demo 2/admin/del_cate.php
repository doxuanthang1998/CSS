<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$id=$_GET['cid'];
$conn = mysqli_connect("localhost","root","","phponline");
$sql="delete from cate_news where cate_id='$id'";
mysqli_query($conn,$sql);
header("location:list_cate.php");
exit();

