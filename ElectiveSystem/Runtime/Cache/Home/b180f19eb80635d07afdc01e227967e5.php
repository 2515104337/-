<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑课程</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/teacher_edit.css" />
</head>

<body class="all">
    <div class="A">
        <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
        <div class="link"><a href="<?php echo U('/Home/Teacher/coulist');?>">返回</a></div>
    </div>
    <div class="B"></div>

    <form method="post" action="<?php echo U('/Home/Teacher/edit_edit');?>">
        <div class="title">编辑课程信息</div>
        <table cellspacing="0" class="table">
            <tr>
                <td class="td1">课程编号</td>
                <td class="td2"><input type="text" name="CouNo" value="<?php echo (session('editCouNo')); ?>"></td>
                <td class="td1">课程名称</td>
                <td class="td2"><input type="text" name="CouName" value="<?php echo (session('editCouName')); ?>"></td>
            </tr>
            <tr>
                <td class="td1">老师工号</td>
                <td class="td2"><input type="text" name="TeaNo" value="<?php echo (session('editTeaNo')); ?>"></td>
                <td class="td1">老师名字</td>
                <td class="td2"><input type="text" name="TeaName" value="<?php echo (session('editTeaName')); ?>"></td>
            </tr>
            <tr>
                <td class="td1">限定人数</td>
                <td class="td2"><input type="text" name="LimitNum" value="<?php echo (session('editLimitNum')); ?>"></td>
                <td class="td1">课程学分</td>
                <td class="td2"><input type="text" name="Credit" value="<?php echo (session('editCredit')); ?>"></td>
            </tr>
            <tr>
                <td class="td1">时间</td>
                <td class="td2"><input type="text" name="SchoolTime" value="<?php echo (session('editSchoolTime')); ?>"></td>
                <td class="td1">地点</td>
                <td class="td2"><input type="text" name="Location" value="<?php echo (session('editLocation')); ?>"></td>
            </tr>
            <tr>
                <td class="td1">课时</td>
                <td class="td2"><input type="text" name="ClassHour" value="<?php echo (session('editClassHour')); ?>"></td>
                <td class="td1">实验课时</td>
                <td class="td2"><input type="text" name="ExpHour" value="<?php echo (session('editExpHour')); ?>"></td>
            </tr>
        </table>


        <div class="submit">
            <input type="submit" value="提交" name="ok" class="button">
        </div>

    </form>

</body>
</html>