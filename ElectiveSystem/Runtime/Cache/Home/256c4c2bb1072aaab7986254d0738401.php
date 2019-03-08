<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生已选课程</title>
    <link rel="stylesheet" href="/electivesystem/public/css/student_courseList.css" />
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
                <!-- <?php var_dump($vo);?> -->
                <td class="td"><?php echo ($vo["CouNo"]); ?></td>
                <td class="td3"><?php echo ($vo["CouName"]); ?></td>
                <td class="td"><?php echo ($vo["TeaName"]); ?></td>
                <td class="td"><?php echo ($vo["SchoolTime"]); ?></td>
                <td class="td"><?php echo ($vo["Location"]); ?></td>
                <td class="td"><?php echo ($vo["Credit"]); ?></td>
                <td class="td"><?php echo ($vo["ClassHour"]); ?></td>
                <td class="td"><?php echo ($vo["ExpHour"]); ?></td>
                <td class="td"><?php echo ($vo["ChooseNum"]); ?></td>
                <td class="td"><?php echo ($vo["LimitNum"]); ?></td>
                <td class="td2"><a href="<?php echo U("/Home/Student/delete/CouNo/$vo[CouNo]");?>">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    

</body>
</html>