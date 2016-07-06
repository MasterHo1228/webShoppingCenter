<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 21:58
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['AdminID']) && !empty($_GET['ID'])) {
    $EaID=$_GET['ID'];
    $_SESSION['EaID']=$EaID;
    $AdminID=$_SESSION['AdminID'];
    require_once ("../backend/dbconnUser.php");

    $strsqlVerify="SELECT ID FROM administrators WHERE ID=$EaID ;";

    $queryVerify=mysqli_query($link,$strsqlVerify);
    if (mysqli_num_rows($queryVerify)==0){
        echo "<script>alert('验证加载失败！')</script>";
    }
    elseif (mysqli_num_rows($queryVerify)==1){
        $strsqlLoad="SELECT Name,Gender,Email FROM administrators WHERE ID=$EaID";
        $queryLoad=mysqli_query($link,$strsqlLoad);
    }

    ?>
    <style type="text/css">
        input,select,textarea{
            margin: 5px 0;
            height: 22px;
        }
        .NotNull{
            color: red;
        }
    </style>
    <?php
    while ($rs=mysqli_fetch_array($queryLoad)){
        $EaName=$rs['Name'];
        $EaGender=$rs['Gender'];
        $EaEmail=$rs['Email'];
    }
    ?>
    <h1>编辑管理员信息</h1>
    <form action="../backend/updadmin.php" method="post" id="formEditAdmin">
        <span class="NotNull">*</span><label for="txtEaName">用户名：</label><input type="text" name="EaName" id="txtEaName" value="<?php echo $EaName?>" maxlength="20"><br/>
        <label for="txtEaPW">密码：</label><input type="password" name="EaPW" id="txtEaPW" maxlength="25"><br/>
        <label for="selEaGender">性别：</label>
        <select name="EaGender" id="selEaGender">
            <?php
                if ($EaGender=='Male'){
                    echo "<option value='Male' selected>Male</option>";
                    echo "<option value='Female'>Female</option>";
                }
                elseif ($EaGender=='Female'){
                    echo "<option value='Male'>Male</option>";
                    echo "<option value='Female' selected>Female</option>";
                }
            ?>
        </select><br/>
        <label for="txtEaEmail">E-Mail：</label><input type="email" name="EaEmail" id="txtEaEmail" value="<?php echo $EaEmail?>" maxlength="35"><br/>
        <input type="submit" value="提交" id="btnEditAdmin">
    </form>
    <?php
    mysqli_close($link);
}
?>