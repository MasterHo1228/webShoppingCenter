<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/7
 * Time: 20:51
 */
session_start();
date_default_timezone_set("Asia/Shanghai");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID'])){
    if (empty($_SESSION['sUID'])){
        $saleSUID=999;
    }
    else{
        $saleSUID=$_SESSION['sUID'];
    }
    if (!empty($_POST['newGoodName']) && !empty($_POST['newGoodPrice']) && !empty($_POST['newGoodCount']) && !empty($_POST['newGoodDesc'])){
        require_once ("dbconnGoods.php");
        
        if(!empty($_FILES['newGoodPhoto']))
        {
            if(is_uploaded_file($_FILES['newGoodPhoto']['tmp_name'])){
                $newGoodPhoto=$_FILES['newGoodPhoto'];
                //获取数组里面的值
                $name=$newGoodPhoto['name'];//上传文件的文件名
                $type=$newGoodPhoto['type'];//上传文件的类型
                $size=$newGoodPhoto['size'];//上传文件的大小
                $tmp_name=$newGoodPhoto['tmp_name'];//上传文件的临时存放路径
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
                    $status=$newGoodPhoto['error'];//上传后系统返回的值
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

        $newGoodName=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodName'])),ENT_QUOTES,'UTF-8');
        $newGoodPrice=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodPrice'])),ENT_QUOTES,'UTF-8');
        $newGoodVPrice=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodVPrice'])),ENT_QUOTES,'UTF-8');
        $newGoodOPrice=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodOPrice'])),ENT_QUOTES,'UTF-8');
        $newGoodBrand=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodBrand'])),ENT_QUOTES,'UTF-8');
        $newGoodModel=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodModel'])),ENT_QUOTES,'UTF-8');
        $newGoodCate=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodCate'])),ENT_QUOTES,'UTF-8');
        $newGoodRank=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodRank'])),ENT_QUOTES,'UTF-8');
        $newGoodCount=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodCount'])),ENT_QUOTES,'UTF-8');
        $newGoodDesc=htmlentities((mysqli_real_escape_string($link,$_POST['newGoodDesc'])),ENT_QUOTES,'UTF-8');

        if (!empty($PhotoPos)){
            $photoLink=mysqli_real_escape_string($link,$PhotoPos);
            $strsqlAdd="INSERT INTO goods(gSalesSUID,gName,gPrice,gVPrice,gOriginPrice,gBrand,gModel,gCateID,gRankTop,gNums,gPhoto,gDescription) VALUES ('$saleSUID','$newGoodName','$newGoodPrice','$newGoodVPrice','$newGoodOPrice','$newGoodBrand','$newGoodModel','$newGoodCate','$newGoodRank','$newGoodCount','$photoLink','$newGoodDesc');";
        }
        else{
            $strsqlAdd="INSERT INTO goods(gSalesSUID,gName,gPrice,gVPrice,gOriginPrice,gBrand,gModel,gCateID,gRankTop,gNums,gDescription) VALUES ('$saleSUID','$newGoodName','$newGoodPrice','$newGoodVPrice','$newGoodOPrice','$newGoodBrand','$newGoodModel','$newGoodCate','$newGoodRank','$newGoodCount','$newGoodDesc');";
        }

        $queryAdd=mysqli_query($link,$strsqlAdd);
        if (empty(mysqli_error($link))){
            echo "<script>alert('发布成功!')</script>";
        }
        else{
            echo "<script>alert('发布失败！')</script>";
            echo mysqli_error($link);
        }
    }
    else{
        echo "<script>alert('请将必填项填写完整！');history.back();</script>";
    }
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>