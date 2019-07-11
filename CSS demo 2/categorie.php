<?php
$conn=mysqli_connect("localhost","root","","phponline");
require_once ("Templates/qhonline/top.php");
require_once ("Templates/qhonline/left.php");
?>
    <div id="info">
        <?php
        $id=$_GET['cid'];
        $B=4;
        if(isset($_GET['page'])){
            $C=$_GET['page'];
        }else{
            $sql="select news_id,news_title,news_info,news_img from news where cate_id='$id' and news_check='Y' order by news_id DESC";
            $query=mysqli_query($conn,$sql);
            $A=mysqli_num_rows($query);
            $C=ceil($A/$B);
        }
        if(isset($_GET['start'])){
            $X=$_GET['start'];
        }else{
            $X=0;
        }
        $sql="select news_id,news_title,news_info,news_img from news where cate_id='$id' and news_check='Y' order by news_id DESC limit $X,$B";
        $query=mysqli_query($conn,$sql);
        while ($data=mysqli_fetch_assoc($query)){
            echo"<div class='news'>";
            echo"<h1>$data[news_title]</h1>";
            if($data['news_img'] != NULL){
                echo"<img src='data/$data[news_img]' width='130' align='left'  />";
            }
            echo $data['news_info'];
            echo"<p align='right'>...<a href='detail.php?nid=$data[news_id]'>Đọc tiếp</a></p>";
            echo"<div class='cls'></div>";
            echo"</div>";
        }
        ?>
        <div align="center">
            <?php
            if($C>1){
                $D=$X/$B + 1;
                if($D > 1){
                    $Y=$X-$B;
                    echo"<a href='categorie.php?cid=$id&start=$Y&page=$C'>Trang Trước </a>";
                }
                if($D < $C){
                    $Y=$X+$B;
                    echo"<a href='categorie.php?cid=$id&start=$Y&page=$C'>Trang Kế</a>";
                }
            }
            ?>
        </div>
    </div>
<?php
require_once ("Templates/qhonline/bottom.php");
