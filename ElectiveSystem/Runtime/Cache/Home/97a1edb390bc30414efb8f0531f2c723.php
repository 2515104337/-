<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑管理员信息</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/manager_manedit.css" />
</head>

<body class="all">
<div class="A">
    <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
    <div class="link"><a href="<?php echo U('/Home/Manager/index');?>">返回</a></div>
</div>
<div class="B"></div>

<form method="post" action="<?php echo U('/Home/Manager/manedit_edit');?>">
    <div class="title">编辑管理员信息</div>
    <table cellspacing="0" class="table">
        <tr>
            <td class="td1">工号</td>
            <td class="td2"><input type="text" name="ManNo" value="<?php echo (session('editManNo')); ?>"></td>
            <td class="td1">姓名</td>
            <td class="td2"><input type="text" name="ManName" value="<?php echo (session('editManName')); ?>"></td>
        </tr>
        <tr>
            <td class="td1">初始密码</td>
            <td class="td2"><input type="text" name="Pwd" value="<?php echo (session('editPwd')); ?>"></td>
            <td class="td1"></td>
            <td class="td2"></td>
        </tr>
    </table>

    <div class="submit">
        <input type="submit" name="Submit" value="提交" class="button">
    </div>
</form>

</body>
</html>