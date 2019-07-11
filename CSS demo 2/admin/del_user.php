<?php
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$conn=mysqli_connect("localhost","root","","phponline");
$id=$_GET['uid'];
if($id == 1){
    echo"<script>";
    echo"alert('Bạn không thể xóa thành viên này !!!'); window.location='list_user.php';</script>";
}else{
    $sql = "delete from user where userid='$id'";
    mysqli_query($conn,$sql);
    header("location:list_user.php");
    exit();
}
