<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>教师添加课程</title>
	<link rel="stylesheet" href="/ElectiveSystem/public/css/teacher_add.css" />
</head>

<body class="all">
	<div class="A">
		<div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
		<div class="link"><a href="<?php echo U('/Home/Teacher/index');?>">返回</a></div>
	</div>
	<div class="B"></div>

	<form name="form1" method="post" action="<?php echo U('/Home/Teacher/add_do');?>">
		<div class="title">添加课程信息</div>
		<table cellspacing="0" class="table">
			<tr>
				<td class="td1">课程名称</td>
				<td class="td2"><input type="text" name="CouName"></td>
				<td class="td1">老师工号</td>
				<td class="td2"><input type="text" name="TeaNo" value="<?php echo (session('TeaNo')); ?>"></td>
			</tr>
			<tr>
				<td class="td1">老师姓名</td>
				<td class="td2"><input type="text" name="TeaName" value="<?php echo (session('TeaName')); ?>"></td>
				<td class="td1">限定人数</td>
				<td class="td2"><input type="text" name="LimitNum"></td>
			</tr>
			<tr>
				<td class="td1">课程学分</td>
				<td class="td2"><input type="text" name="Credit"></td>
				<td class="td1">上课时间</td>
				<td class="td2"><input type="text" name="SchoolTime"></td>
			</tr>
			<tr>
				<td class="td1">上课地点</td>
				<td class="td2"><input type="text" name="Location"></td>
				<td class="td1">课时</td>
				<td class="td2"><input type="text" name="ClassHour"></td>
			</tr>
			<tr>
				<td class="td1">实验课时</td>
				<td class="td2"><input type="text" name="ExpHour"></td>
				
			</tr>
		</table>

		<div class="submit">
			<input type="submit" name="Submit" value="提交" class="button">
		</div>
	</form>

</body>
</html>