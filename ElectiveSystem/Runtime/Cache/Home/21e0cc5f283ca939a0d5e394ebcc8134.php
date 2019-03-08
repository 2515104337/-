<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生首页</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/student_index.css" />
</head>

<body class="all">

    <div class="A">
        <div class="link"><a href="<?php echo U('/Home/Student/chooseCourse');?>">进入学生选课系统</a></div>
        <div class="link"><a href="<?php echo U('/Home/Student/courseList');?>">学生已选课程管理</a></div>
        <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
    </div>
    <div class="B"></div>

    <div class="title">学生基本信息</div>
    <table cellspacing="0" class="table">
        <tr>
            <td class="td1">学号</td>
            <td class="td2"><?php echo (session('StuNo')); ?></td>
            <td class="td1">姓名</td>
            <td class="td2"><?php echo (session('StuName')); ?></td>
        </tr>
        <tr>
            <td class="td1">学院</td>
            <td class="td2"><?php echo (session('CollegeName')); ?></td>
            <td class="td1">专业/班级 名称</td>
            <td class="td2"><?php echo (session('MajorName')); ?></td>
        </tr>
        <tr>
            <td class="td1">初始密码</td>
            <td class="td2">******</td>
            <td class="td1">性别</td>
            <td class="td2"><?php echo (session('Sex')); ?></td>
        </tr>
    </table>

    <form method="post" action="<?php echo U('/Home/Student/stuedit_do');?>">
        <div class="submit">
            <input type="hidden" name="StuNo" value="<?php echo (session('StuNo')); ?>" class="button"/>
            <input type="submit" value="编辑" class="button"/>
        </div>
    </form>

</body>
</html>