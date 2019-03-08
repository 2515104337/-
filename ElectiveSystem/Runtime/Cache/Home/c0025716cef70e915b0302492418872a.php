<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑学生信息</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/manager_stuedit.css" />
</head>

<body class="all">
    <div class="A">
        <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
        <div class="link"><a href="<?php echo U('/Home/Manager/stulist');?>">返回</a></div>
    </div>
    <div class="B"></div>

    <form method="post" action="<?php echo U('/Home/Manager/stuedit_edit');?>">
        <div class="title">编辑学生信息</div>
        <table cellspacing="0" class="table">
            <tr>
                <td class="td1">学号</td>
                <td class="td2"><input type="text" name="StuNo" value="<?php echo (session('editStuNo')); ?>"></td>
                <td class="td1">姓名</td>
                <td class="td2"><input type="text" name="StuName" value="<?php echo (session('editStuName')); ?>"></td>
            </tr>
            <tr>
                <td class="td1">学院 编号</td>
                <td class="td2"><input type="text" name="CollegeNo" value="<?php echo (session('editCollegeNo')); ?>"></td>
                <td class="td1">专业/班级 名称</td>
                <td class="td2"><input type="text" name="MajorName" value="<?php echo (session('editMajorName')); ?>"></td>
            </tr>
            <tr>
                <td class="td1">初始密码</td>
                <td class="td2"><input type="text" name="Pwd" value="<?php echo (session('editPwd')); ?>"></td>
                <td class="td1">性别</td>
                <td class="td2"><input type="text" name="Sex" value="<?php echo (session('editSex')); ?>"></td>
            </tr>
        </table>

        <div class="submit">
            <input type="submit" name="Submit" value="提交" class="button">
        </div>
    </form>

</body>
</html>