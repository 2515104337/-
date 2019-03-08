<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>教师首页</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/teacher_index.css" />
</head>

<body class="all">

	<div class="A">
		<div class="link"><a href="<?php echo U('/Home/Teacher/add');?>">添加课程</a></div>
		<div class="link"><a href="<?php echo U('/Home/Teacher/coulist');?>">管理课程</a></div>
		<div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
	</div>
	<div class="B"></div>

	<div class="title">教师基本信息</div>
	<table cellspacing="0" class="table">
		<tr>
			<td class="td1">工号</td>
			<td class="td2"><?php echo (session('TeaNo')); ?></td>
			<td class="td1">姓名</td>
			<td class="td2"><?php echo (session('TeaName')); ?></td>
		</tr>
		<tr>
			<td class="td1">学院编号</td>
			<td class="td2"><?php echo (session('CollegeNo')); ?></td>
			<td class="td1">学院名称</td>
			<td class="td2"><?php echo (session('CollegeName')); ?></td>
		</tr>
		<tr>
			<td class="td1">初始密码</td>
			<td class="td2">******</td>
			<td class="td1">性别</td>
			<td class="td2"><?php echo (session('Sex')); ?></td>
		</tr>
		<tr>
			<td class="td1">简介</td>
			<td class="td2" colspan="3"><?php echo (session('Introduction')); ?></td>
		</tr>
	</table>

	<form method="post" action="<?php echo U('/Home/Teacher/teaedit_do');?>">
		<div class="submit">
			<input type="hidden" name="TeaNo" value="<?php echo (session('TeaNo')); ?>" class="button"/>
			<input type="submit" value="编辑" class="button"/>
		</div>
	</form>

</body>
</html>