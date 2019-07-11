<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$conn=mysqli_connect("localhost","root","","phponline");
$id=$_GET['nid'];
$sql="delete from news where news_id='$id'";
mysqli_query($conn,$sql);
header("location:list_news.php");
exit();
