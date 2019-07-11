<?php
$conn=mysqli_connect("localhost","root","","phponline");
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$id=$_GET['pid'];
$sql="delete from page where page_id='$id'";
mysqli_query($conn,$sql);
header("location:list_page.php");
exit();

