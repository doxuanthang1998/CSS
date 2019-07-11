<?php
$conn=mysqli_connect("localhost","root","","phponline");
session_start();
if($_SESSION['ses_level'] != 2){
    header("location:login.php");
    exit();
}
$id=$_GET['pid'];
if(isset($_POST['ok'])) {
    if ($_POST['txttitle'] == NULL) {
        echo "Vui lòng nhập tên trang <br />";
    } else {
        $t = $_POST['txttitle'];
    }
    if ($_POST['txtinfo'] == NULL) {
        echo "Vui lòng nhập nội dung trang <br />";
    } else {
        $n = $_POST['txtinfo'];
    }
    if ($t && $n) {
        $sql = "update page set page_title='$t',page_info='$n' where page_id='$id'";
        mysqli_query($conn, $sql);
        header("location:list_page.php");
        exit();
    }
}
$sql="select * from page where page_id='$id'";
$query=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($query);
?>
<form action="edit_page.php?pid=<?php echo $data['page_id']; ?>" method="post">
    <table>
        <tr>
            <td>Tên Trang</td>
            <td><input type="text" name="txttitle" size="25" value="<?php echo $data['page_title']; ?>"/></td>
        </tr>
        <tr>
            <td>Nội Dung Trang</td>
            <td><textarea name="txtinfo" cols="45" rows="8"><?php echo $data['page_info']; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="ok" value="Submit"/></td>
        </tr>
    </table>
</form>