<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员管理老师</title>
    <link rel="stylesheet" href="/ElectiveSystem/public/css/manager_tealist.css" />
    <link rel="stylesheet" href="/ElectiveSystem/public/css/page.css" />
</head>

<body class="all">
    <div class="A">
        <div class="link"><a href="<?php echo U('/Home/Index/index');?>">退出登录</a></div>
        <div class="link"><a href="<?php echo U('/Home/Manager/index');?>">返回</a></div>
    </div>
    <div class="B"></div>


    <table cellspacing="0" class="table">
        <tr>
            <td class="title">工号</td>
            <td class="title">姓名</td>
            <td class="title">学院</td>
            <td class="title">性别</td>
            <td class="title" colspan="2">操作</td>
        </tr>

        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td class="td"><?php echo ($vo["teano"]); ?></td>
                <td class="td"><?php echo ($vo["teaname"]); ?></td>
                <td class="td"><?php echo ($vo["collegename"]); ?></td>
                <td class="td"><?php echo ($vo["sex"]); ?></td>
                <form method="post" action="<?php echo U('/Home/Manager/teaedit_do');?>">
                    <td class="td2">
                        <input type="hidden" name="TeaNo" value="<?php echo ($vo["teano"]); ?>" class="button"/>
                        <input type="submit" value="编辑" class="button"/>
                    </td>
                </form>

                <td class="td2"><a href="<?php echo U("/Home/Manager/deleteTeacher/TeaNo/$vo[teano]");?>" onclick="return confirm('确定删除?')">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <td colspan="8" bgcolor="#FFFFFF">

        <div class="pages"><?php echo ($page); ?></div>

    </td>

</body>
</html>