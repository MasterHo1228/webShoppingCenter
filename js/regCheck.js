// JavaScript Document


$(function () {
    var un = $('#uName');
    var ps = $('#ps');
    var ps1 = $('#ps1');

    var pn = $('#pn');
    var pm = $('#pm');
    var pm1 = $('#pm1');


    un.blur(function () {
        if (un.val() == "") {
            pn.empty().append("用户名不能为空！").show();
            $('#btnRegist').attr("disabled", true);
        }
        else if(un.val().length<6){
            pn.empty().append("用户名至少需要6位字符！").show();
            $('#btnRegist').attr("disabled", true);
        }
        else {
            pn.hide();
            $('#btnRegist').attr("disabled", false);
        }
    });

    ps.blur(function () {
        if (ps.val() == "") {
            pm.empty().append("密码不能为空！").show();
            $('#btnRegist').attr("disabled", true);
        }
        else if(ps.val().length<8){
            pm.empty().append("密码至少需要8位字符！").show();
            $('#btnRegist').attr("disabled", true);
        }
        else {
            pm.hide();
            $('#btnRegist').attr("disabled", false);
        }
    });

    ps1.blur(function () {
        if (ps.val() != ps1.val()) {
            pm1.show();
            $('#btnRegist').attr("disabled", true);
        }
        else {
            pm1.hide();
            $('#btnRegist').attr("disabled", false);
        }
    });
    $("#email").blur(function () {
        var search_str = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;
        if(!search_str.test($(this).val())){
            $("#emW").show();
            $('#btnRegist').attr("disabled", true);
        }
        else{
            $("#emW").hide();
            $('#btnRegist').attr("disabled", false);
        }
    })

});