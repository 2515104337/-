<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>课程选课详情</title>
    <link rel="stylesheet" href="/electivesystem/public/css/teacher_courseListDetail.css" />
</head>

<body class="all">
    <div class="A">
        <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
        <div class="link"><a href="<?php echo U('/Home/Teacher/coulist');?>">返回</a></div>
        <div class="link"><a href="<?php echo U('/Home/Teacher/excel');?>">导出表单</a></div>
    </div>
    <div class="B"></div>


    <table cellspacing="0" class="table">
        <tr>
            <td class="title">学号</td>
            <td class="title">姓名</td>
            <td class="title">学院名称</td>
            <td class="title">专业名称</td>
            <td class="title">性别</td>
        </tr>

        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td class="td"><?php echo ($vo["StuNo"]); ?></td>
            <td class="td"><?php echo ($vo["StuName"]); ?></td>
            <td class="td"><?php echo ($vo["CollegeName"]); ?></td>
            <td class="td"><?php echo ($vo["MajorName"]); ?></td>
            <td class="td"><?php echo ($vo["Sex"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>


</body>

</html>