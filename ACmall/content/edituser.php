<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 21:58
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['AdminID']) && !empty($_GET['uID'])) {
    $EuID=$_GET['uID'];
    $_SESSION['EuID']=$EuID;
    $AdminID=$_SESSION['AdminID'];
    require_once ("../backend/dbconnUser.php");

    $strsqlVerify="SELECT uID FROM user WHERE uID=$EuID ;";

    $queryVerify=mysqli_query($link,$strsqlVerify);
    if (mysqli_num_rows($queryVerify)==0){
        echo "<script>alert('验证加载失败！')</script>";
    }
    elseif (mysqli_num_rows($queryVerify)==1){
        $strsqlLoad="SELECT uName,uGender,uDateOfBirth,uEmail,uStatus FROM user WHERE uID=$EuID";
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
        $EuName=$rs['uName'];
        $EuGender=$rs['uGender'];
        $EuDateOfBirth=$rs['uDateOfBirth'];
        $EuEmail=$rs['uEmail'];
        $EuStatus=$rs['uStatus'];
    }
    ?>
    <h1>编辑会员用户信息</h1>
    <form action="../backend/upduser.php" method="post" id="formEditGood">
        <span class="NotNull">*</span><label for="txtEuName">用户名：</label><input type="text" name="EuName" id="txtEuName" value="<?php echo $EuName?>" maxlength="15"><br/>
        <label for="txtEuPW">密码：</label><input type="password" name="EuPW" id="txtEuPW" maxlength="25"><br/>
        <label for="selEuGender">性别：</label>
        <select name="EuGender" id="selEuGender">
            <?php
                if ($EuGender=='Male'){
                    echo "<option value='Male' selected>Male</option>";
                    echo "<option value='Female'>Female</option>";
                }
                elseif ($EuGender=='Female'){
                    echo "<option value='Male'>Male</option>";
                    echo "<option value='Female' selected>Female</option>";
                }
            ?>
        </select><br/>
        <label for="txtEuDateOfBirth">生日：</label><input type="date" name="EuDateOfBirth" id="txtEuDateOfBirth" value="<?php echo $EuDateOfBirth?>"><br/>
        <label for="txtEuEmail">E-Mail：</label><input type="email" name="EuEmail" id="txtEuEmail" value="<?php echo $EuEmail?>" maxlength="30"><br/>
        <label for="selEuStatus">账号状态：</label><select name="EuStatus" id="selEuStatus">
            <?php
            if ($EuStatus=='1'){
                echo "<option value='1' selected>正常</option>";
                echo "<option value='0'>冻结</option>";
            }
            elseif ($EuStatus=='0'){
                echo "<option value='1'>正常</option>";
                echo "<option value='0' selected>冻结</option>";
            }
            ?>
        </select><br/>
        <input type="submit" value="提交" id="btnEditUser">
    </form>
    <?php
    mysqli_close($link);
}
?>