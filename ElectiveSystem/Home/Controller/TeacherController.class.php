<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends Controller{
    public function index(){
	    $this->display();
	}


    public function add(){
        $this->display();
    }

    //添加课程
    public function add_do(){
        
        $CouName=$_POST['CouName'];
        if(!empty(trim($CouName))){
           $data['CouName']=$CouName;
        }else{
            $this->error('课程名称不能为空！');
        }
        $LimitNum=$_POST['LimitNum'];
        if(!empty(trim($LimitNum))){
           $data['LimitNum']=$LimitNum;
        }else{
            $this->error('限定人数不能为空！');
        }
        $Credit=$_POST['Credit'];
        if(!empty(trim($Credit))){
           $data['Credit']=$Credit;
        }else{
            $this->error('课程学分不能为空！');
        }
        $SchoolTime=$_POST['SchoolTime'];
        if(!empty(trim($SchoolTime))){
           $data['SchoolTime']=$SchoolTime;
        }else{
            $this->error('上课时间不能为空！');
        }
        $Location=$_POST['Location'];
        if(!empty(trim($Location))){
           $data['Location']=$Location;
        }else{
            $this->error('上课地点不能为空！');
        }
        $data['TeaName']=$_POST['TeaName'];
        $data['TeaNo']=$_POST['TeaNo'];
        $data['ClassHour']=$_POST['ClassHour'];
        $data['ExpHour']=$_POST['ExpHour'];

        $cou=M('course');
        
        $re=$cou->add($data);
        if(!$re){
            $this->error('课程创建失败！');
        }
        else{
            $this->success('课程创建成功！',U('/Home/Teacher/coulist'));
        }
    }

    //显示课程
    public function coulist(){
        $where['TeaNo']=$_SESSION['TeaNo'];
        $teacoulist = M('course')->where($where)->select();
        $this->assign('list',$teacoulist);
        $this->display();
    }

    //查看选课学生详细信息
    public function courseListDetail(){
        //找出选这门课的学生的学号
        $CouNo=$_POST['CouNo'];
         // echo $CouNo;exit;
        session('CouNo',$CouNo);
        $Course['CouNo']=$CouNo;
        $stulist=M('stucou')->where($Course)->select();
        $count=count($stulist);
        

        //找出这个学号对应的学生信息
        for($i=0;$i<$count;$i++){
            $stuInfo['StuNo']=$stulist[$i]['stuno'];

            $studetail=M('student')->where($stuInfo)->find();
            $stuMessage[$i]['StuNo']=$studetail['stuno'];
            $stuMessage[$i]['StuName']=$studetail['stuname'];
            $stuMessage[$i]['Sex']=$studetail['sex'];
            // $stuMessage[$i]['CollegeNo']=$studetail['collegeNo'];

            $Major['CollegeNo']=$studetail['collegeno'];
            $MajorInfo=M('major')->where($Major)->find();
            $stuMessage[$i]['MajorName']=$MajorInfo['majorname'];
            
            $College['CollegeNo']=$studetail['collegeno'];
            $couInfo = M('college')->where($College)->find();
            $stuMessage[$i]['CollegeName']=$couInfo['collegename'];
                 
        }
        
        $this->assign('list',$stuMessage);
        $this->display();
    }
    //导出学生excel表
    public function excel(){
        // echo '111';
        //引入PHPExcel库文件
        Vendor('PHPExcel.PHPExcel');
        //创建对象
        $excel = new \PHPExcel();
        // var_dump($excel);
        //Excel表格式
        $letter = array('A','B','C','D','E');
        //表头数组
        $header = array('学号','姓名','性别','学院','专业');
        //填充表头信息
        for($i = 0;$i < count($header);$i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1","$header[$i]");
        }
        //学生信息
        $CouNo=$_SESSION['CouNo'];
        $Course['CouNo']=$CouNo;
        $stulist=M('stucou')->where($Course)->select();
        $stuMessage;
        for($i=0;$i<count($stulist);$i++){
            $stuInfo['StuNo']=$stulist[$i]['stuno'];

            $studetail=M('student')->where($stuInfo)->find();
            $stuMessage[$i]['StuNo']=$studetail['stuno'];
            $stuMessage[$i]['StuName']=$studetail['stuname'];
            $stuMessage[$i]['Sex']=$studetail['sex'];
            // $stuMessage[$i]['CollegeNo']=$studetail['collegeNo'];

            $College['CollegeNo']=$studetail['collegeno'];
            $couInfo = M('college')->where($College)->find();
            $stuMessage[$i]['CollegeName']=$couInfo['collegename'];

            $Major['CollegeNo']=$studetail['collegeno'];
            $MajorInfo=M('major')->where($Major)->find();
            $stuMessage[$i]['MajorName']=$MajorInfo['majorname'];
            
            
        }
        // echo count($stuMessage);exit;
        //填充表格信息
        for ($i = 2;$i <= count($stuMessage) + 1;$i++) {
            $j = 0;
            foreach ($stuMessage[$i - 2] as $key=>$value) {
                $excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
                $j++;
            }
        }
         

        //创建Excel输入对象
        $write = new \PHPExcel_Writer_Excel5($excel);
        ob_end_clean();
        ob_start();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        Header('content-Type:application/vnd.ms-excel;charset=utf-8');
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="学生信息.xls"');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }

    //编辑课程
    //传递此门课程参数
    public function edit_do(){
        $CouNo=$_POST['CouNo'];
        $Course['CouNo']=$CouNo;
        $courseInfo=M('course')->where($Course)->find();
        session('editCouNo',$courseInfo['couno']);
        session('editCouName',$courseInfo['couname']);
        session('editTeaNo',$courseInfo['teano']);
        session('editTeaName',$courseInfo['teaname']);
        session('editLimitNum',$courseInfo['limitnum']);
        session('editCredit',$courseInfo['credit']);
        session('editSchoolTime',$courseInfo['schooltime']);
        session('editLocation',$courseInfo['location']);
        session('editClassHour',$courseInfo['classhour']);
        session('editExpHour',$courseInfo['exphour']);

        $this->success('正在跳转！',U('/Home/Teacher/edit'));
    }
    //显示默认参数
    public function edit(){
        $this->display();
    }
    //修改提交新参数并跳转
    public function edit_edit(){
        // 要修改的数据对象属性赋值
        $data['CouNo'] = $_POST["CouNo"];
        $data['CouName'] = $_POST["CouName"];
        $data['TeaNo'] = $_POST["TeaNo"];
        $data['TeaName'] = $_POST["TeaName"];
        $data['LimitNum'] = $_POST["LimitNum"];
        $data['Credit'] = $_POST["Credit"];
        $data['SchoolTime'] = $_POST["SchoolTime"];
        $data['Location'] = $_POST["Location"];
        $data['ClassHour'] = $_POST["ClassHour"];
        $data['ExpHour'] = $_POST["ExpHour"];
        $CouNo['CouNo']=$_SESSION["editCouNo"];
        M("course")->where($CouNo)->save($data); 
        // 根据条件保存修改的数据

        $this->success('课程信息修改成功！',U('/Home/Teacher/coulist'));
    }

    //删除课程
    public function delete(){
        $CouNo=I('get.CouNo');
        $mod=M('course')->where("CouNo = '$CouNo'")->delete();
        M('stucou')->where("CouNo = '$CouNo'")->delete();

        if($mod){
            $this->success('课程删除成功',U('/Home/Teacher/coulist'));

        }else{
            $this->success('课程删除失败！');
        }
    }



    //编辑老师
    //传递此老师参数
    public function teaedit_do(){
        $TeaNo=$_POST['TeaNo'];

        $Teacher['TeaNo']=$TeaNo;
        $teacherInfo=M('teacher')->where($Teacher)->find();
        session('editTeaNo',$teacherInfo['teano']);
        session('editTeaName',$teacherInfo['teaname']);
        session('editCollegeNo',$teacherInfo['collegeno']);
        session('editCollegeName',$teacherInfo['collegename']);
        session('editPwd',$teacherInfo['pwd']);
        session('editSex',$teacherInfo['sex']);
        session('editIntroduction',$teacherInfo['introduction']);

        $this->success('正在跳转！',U('/Home/Teacher/teaedit'));
    }
    //显示默认老师参数
    public function teaedit(){
        $this->display();
    }
    //修改提交新参数并跳转
    public function teaedit_edit(){
        $editteacher = M("teacher"); // 实例化User对象
        // 要修改的数据对象属性赋值
        $data['TeaNo'] = $_POST["TeaNo"];
        $data['TeaName'] = $_POST["TeaName"];
        $data['CollegeNo'] = $_POST["CollegeNo"];
        $data['CollegeName'] = $_POST["CollegeName"];
        $data['Pwd'] = $_POST["Pwd"];
        $data['Sex'] = $_POST["Sex"];
        $data['Introduction'] = $_POST["Introduction"];
        $TeaNo['TeaNo']=$_SESSION["TeaNo"];
        $editteacher->where($TeaNo)->save($data); // 根据条件保存修改的数据

        $Teacher['TeaNo'] = $_POST["TeaNo"];
        $Teacher['TeaName'] = $_POST["TeaName"];
        M('course')->where($TeaNo)->save($Teacher);


        if(!$editteacher){
            $this->error('信息修改失败！');
        }
        else{
            $this->success('信息修改成功！',U('/Home/Index/index'));
        }
	}
}
?>

