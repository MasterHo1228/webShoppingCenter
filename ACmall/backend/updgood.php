<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 0:57
 */
session_start();
date_default_timezone_set("Asia/Shanghai");
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_SESSION['gID'])) {
    if (!empty($_POST['EGoodName']) && !empty($_POST['EGoodPrice']) && !empty($_POST['EGoodCount']) && !empty($_POST['EGoodDesc'])){
        require_once ("dbconnGoods.php");

        if(!empty($_FILES['EGoodPhoto']))
        {
            if(is_uploaded_file($_FILES['EGoodPhoto']['tmp_name'])){
                $EGoodPhoto=$_FILES['EGoodPhoto'];
                //获取数组里面的值
                $name=$EGoodPhoto['name'];//上传文件的文件名
                $type=$EGoodPhoto['type'];//上传文件的类型
                $size=$EGoodPhoto['size'];//上传文件的大小
                $tmp_name=$EGoodPhoto['tmp_name'];//上传文件的临时存放路径
                //判断是否为图片
                switch ($type){
                    case 'image/pjpeg':
                        $fileType='.jpg';
                        $okType=true;
                        break;
                    case 'image/jpeg':
                        $fileType='.jpg';
                        $okType=true;
                        break;
                    case 'image/gif':
                        $fileType='.gif';
                        $okType=true;
                        break;
                    case 'image/png':
                        $fileType='.png';
                        $okType=true;
                        break;
                }
                if($okType){
                    $status=$EGoodPhoto['error'];//上传后系统返回的值
                    //把上传的临时文件移动到up目录下面
                    $fileName=date("YmdHis",time()).rand(1000,9999);
                    move_uploaded_file($tmp_name,"../../images/goods/".$fileName.$fileType);
                    $photoDir='images/goods/';
                    $PhotoPos=$photoDir.$fileName.$fileType;

                    if($status==0){
                        echo "<script>alert('图片上传成功！')</script>";
                    }
                    elseif ($status==1){
                        echo "<script>alert('上传的图片太大，上传失败！')</script>";
                    }
                    elseif ($status==2){
                        echo "<script>alert('图片文件太大，上传失败！')</script>";
                    }
                    elseif ($status==3){
                        echo "<script>alert('图片上传中途被中断，上传失败！')</script>";
                    }
                    elseif ($status==4){
                        echo "<script>alert('没有文件被上传！')</script>";
                    }
                    else{
                        echo "<script>alert('图片文件异常！')</script>";
                    }
                }
                else{
                    echo "<script>alert('请上传jpg,gif,png格式的图片！')</script>";
                }
            }
        }

        $gID=$_SESSION['gID'];
        $EGoodName=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodName'])),ENT_QUOTES,'UTF-8');
        $EGoodPrice=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodPrice'])),ENT_QUOTES,'UTF-8');
        $EGoodVPrice=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodVPrice'])),ENT_QUOTES,'UTF-8');
        $EGoodOPrice=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodOPrice'])),ENT_QUOTES,'UTF-8');
        $EGoodBrand=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodBrand'])),ENT_QUOTES,'UTF-8');
        $EGoodModel=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodModel'])),ENT_QUOTES,'UTF-8');
        $EGoodCate=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodCate'])),ENT_QUOTES,'UTF-8');
        $EGoodRank=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodRank'])),ENT_QUOTES,'UTF-8');
        $EGoodCount=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodCount'])),ENT_QUOTES,'UTF-8');
        $EGoodDesc=htmlentities((mysqli_real_escape_string($link,$_POST['EGoodDesc'])),ENT_QUOTES,'UTF-8');

        if (!empty($PhotoPos)){
            $photoLink=mysqli_real_escape_string($link,$PhotoPos);
            $strsqlUpd="UPDATE goods SET gName='$EGoodName',gPrice=$EGoodPrice,gVPrice=$EGoodVPrice,gOriginPrice=$EGoodOPrice,gBrand='$EGoodBrand',gModel='$EGoodModel',gCateID='$EGoodCate',gRankTop='$EGoodRank',gNums=$EGoodCount,gPhoto='$photoLink',gDescription='$EGoodDesc' WHERE gID=$gID ;";
        }
        else{
            $strsqlUpd="UPDATE goods SET gName='$EGoodName',gPrice=$EGoodPrice,gVPrice=$EGoodVPrice,gOriginPrice=$EGoodOPrice,gBrand='$EGoodBrand',gModel='$EGoodModel',gCateID='$EGoodCate',gRankTop='$EGoodRank',gNums=$EGoodCount,gDescription='$EGoodDesc' WHERE gID=$gID ;";
        }

        $queryUpd=mysqli_query($link,$strsqlUpd);
        if (empty(mysqli_error($link))){
            echo "<script>alert('商品信息更新成功！')</script>";
        }
        else{
            echo "<script>alert('商品信息更新失败！')</script>";
        }
        mysqli_close($link);
    }
    else{
        echo "<script>alert('请将必填项填写完整！');history.back();</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>

