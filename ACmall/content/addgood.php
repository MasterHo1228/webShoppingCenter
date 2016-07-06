<!--Created by MasterHo on 2016/6/7 via IntelliJ IDEA.-->
<?php
require_once ("../backend/dbconnGoods.php");
$queryLoadCate=mysqli_query($link,"SELECT cID,cName FROM goodscategory ;");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>添加商品</title>
    <script type="text/javascript" charset="utf-8" src="../js/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../js/ueditor.all.min.js"> </script>
    <style type="text/css">
        input,select,textarea{
            margin: 5px 0;
            height: 22px;
        }
        .inputPrice{
            width: 70px;
            height: 25px;
        }
        #btnAddGood{
            width: 125px;
            height: 28px;
            margin: 8px;
        }
        #newGoodsMain{
            margin-bottom: 20px;
        }
        #divGoodsDesc{
            width: 860px;
            height: 450px;
        }
        #divBtnSubmit{
            margin-top: 105px;
        }
        .NotNull{
            color: red;
        }
    </style>
</head>
<body>
<h1>添加新商品</h1>
    <form action="../backend/addgood.php" enctype="multipart/form-data" method="post" id="formAddGood">
        <div id="newGoodsMain">
            <span class="NotNull">*</span><label for="txtNewGoodName">商品名称：</label><input type="text" name="newGoodName" id="txtNewGoodName" maxlength="50"><br/>
            <span class="NotNull">*</span><label for="txtNewGoodPrice">商品价格：</label><input type="text" name="newGoodPrice" id="txtNewGoodPrice" class="inputPrice" maxlength="12">
            <label for="txtNewGoodVPrice">会员价：</label><input type="text" name="newGoodVPrice" id="txtNewGoodVPrice" class="inputPrice" maxlength="12">
            <label for="txtNewGoodOPrice">原价：</label><input type="text" name="newGoodOPrice" id="txtNewGoodOPrice" class="inputPrice" maxlength="12"><br/>
            <label for="txtNewGoodBrand">商品品牌：</label><input type="text" name="newGoodBrand" id="txtNewGoodBrand" maxlength="25"><br/>
            <label for="txtNewGoodModel">商品型号：</label><input type="text" name="newGoodModel" id="txtNewGoodModel" maxlength="20"><br/>
            <label for="selNewGoodCate">商品类型：</label><select name="newGoodCate" id="selNewGoodCate">
                <?php
                    while ($rs=mysqli_fetch_array($queryLoadCate)){
                        $cateID=$rs['cID'];
                        $cateName=$rs['cName'];
                        echo "<option value='".$cateID."'>".$cateName."</option>";
                    }
                ?>
            </select>
            <label for="selNewGoodRank">是否为首推商品：</label><select name="newGoodRank" id="selNewGoodRank">
                <option value="1">是</option>
                <option value="0" selected>否</option>
            </select><br/>
            <span class="NotNull">*</span><label for="txtNewGoodCount">商品数量:</label><input type="text" name="newGoodCount" id="txtNewGoodCount" maxlength="10"><br/>
            <label for="fiNewGoodPhoto">商品图片:</label><input type="file" name="newGoodPhoto" id="fiNewGoodPhoto"><br/>
        </div>
        <div id="divGoodsDesc">
            <span class="NotNull">*</span><label for="txtNewGoodDesc">商品描述：</label>
            <script id="txtNewGoodDesc" name="newGoodDesc" type="text/plain">此处编辑撰写商品信息。</script>
        </div>
        <div id="divBtnSubmit">
            <input type="submit" value="提交" id="btnAddGood">
        </div>
    </form>
</body>
<script type="text/javascript">
    var editor = UE.getEditor('txtNewGoodDesc');
</script>
</html>
<?php mysqli_close($link);?>