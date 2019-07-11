<?php
$conn=mysqli_connect("localhost","root","","phponline");
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
if(isset($_POST['ok'])){
    if($_POST['txttitle'] == NULL){
        echo"Vui lòng nhập tên trang <br />";
    }else{
        $t=$_POST['txttitle'];
    }
    if($_POST['txtinfo'] == NULL){
        echo"Vui lòng nhập nội dung trang <br />";
    }else{
        $n=$_POST['txtinfo'];
    }
    if($t && $n){
        $sql="insert into page(page_title,page_info) values ('$t','$n')";
        mysqli_query($conn,$sql);
        header("location:list_page.php");
        exit();
    }
}
?>
<form action="add_page.php" method="post">
    <table>
        <tr>
            <td>Tên Trang</td>
            <td><input type="text" name="txttitle" size="25"/></td>
        </tr>
        <tr>
            <td>Nội Dung Trang</td>
            <td><textarea name="txtinfo" cols="45" rows="8"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="ok" value="Submit"/></td>
        </tr>
    </table>
</form>