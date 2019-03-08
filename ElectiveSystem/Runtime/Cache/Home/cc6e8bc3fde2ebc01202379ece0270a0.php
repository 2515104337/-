<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生选课</title>
	<link rel="stylesheet" href="/ElectiveSystem/public/css/student_chooseCourse.css" />
	<link rel="stylesheet" href="/ElectiveSystem/public/css/page.css" />
</head>


<body class="all">
	<div class="A">
		<div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
		<div class="link"><a href="<?php echo U('/Home/Student/index');?>">返回</a></div>
	</div>
	<div class="B"></div>

	<table cellspacing="0" class="table">
		<tr>
			<td class="title">课程编号</td>
			<td class="title">课程名称</td>
			<td class="title">课程老师</td>
			<td class="title">时间</td>
			<td class="title">地点</td>
			<td class="title">学分</td>
			<td class="title">课时</td>
			<td class="title">实验课时</td>
			<td class="title">已选人数</td>
			<td class="title">人数上限</td>
			<td class="title">操作</td>
		</tr>

		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td class="td"><?php echo ($vo["couno"]); ?></td>
				<td class="td3"><?php echo ($vo["couname"]); ?></td>
				<td class="td"><?php echo ($vo["teaname"]); ?></td>
				<td class="td"><?php echo ($vo["schooltime"]); ?></td>
				<td class="td"><?php echo ($vo["location"]); ?></td>
				<td class="td"><?php echo ($vo["credit"]); ?></td>
				<td class="td"><?php echo ($vo["classhour"]); ?></td>
				<td class="td"><?php echo ($vo["exphour"]); ?></td>
				<td class="td"><?php echo ($vo["choosenum"]); ?></td>
				<td class="td"><?php echo ($vo["limitnum"]); ?></td>
				<td class="td2">
					<?php if($vo[stuno] == ''): ?><a href="<?php echo U("/Home/Student/choseCourseDo/CouNo/$vo[couno]");?>">添加</a>
						<?php else: ?>
						<c>已选</c><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<td colspan="8" bgcolor="#FFFFFF">

        <div class="pages"><?php echo ($page); ?></div>

    </td>

</body>
</html>