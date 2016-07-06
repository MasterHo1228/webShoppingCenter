<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/27
 * Time: 9:27
 */
function check_email($email){
    if (preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/',$email)){
        return true;
    }else{
        return false;
    }
}
?>