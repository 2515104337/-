<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员首页</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/manager_index.css" />
</head>

<body class="all">
    <div class="A">
        <div class="link"><a href="<?php echo U('/Home/Manager/stuadd');?>">添加学生</a></div>
        <div class="link"><a href="<?php echo U('/Home/Manager/stulist');?>">管理学生</a></div>
        <div class="link"><a href="<?php echo U('/Home/Manager/teaadd');?>">添加老师</a></div>
        <div class="link"><a href="<?php echo U('/Home/Manager/tealist');?>">管理老师</a></div>
        <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
    </div>
    <div class="B"></div>

    <div class="title">管理员基本信息</div>
    <table cellspacing="0" class="table">
        <tr>
            <td class="td1">工号</td>
            <td class="td2"><?php echo (session('ManNo')); ?></td>
            <td class="td1">姓名</td>
            <td class="td2"><?php echo (session('ManName')); ?></td>
        </tr>
        <tr>
            <td class="td1">初始密码</td>
            <td class="td2">******</td>
            <td class="td1"></td>
            <td class="td2"></td>
        </tr>
    </table>

    <form method="post" action="<?php echo U('/Home/Manager/manedit_do');?>">
        <div class="submit">
            <input type="hidden" name="ManNo" value="<?php echo (session('ManNo')); ?>" class="button"/>
            <input type="submit" value="编辑" class="button"/>
        </div>
    </form>

</body>
</html>