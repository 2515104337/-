<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller{
    public function index(){
        $this->display();
    }

    //选择课程
    public function chooseCourse(){
        $stu=M('student');
        $stuno =session('StuNo');
        // echo $stuno;exit;//01学生
        $stuinfo=$stu->alias('st')->join('__COLLEGE__ as cl on cl.Collegeno=st.Collegeno')->find($stuno);
        // var_dump($stuinfo);exit;
        $cou=M('course');
        $count = $cou->count();
        $p = getpage($count,5);
        $coulist =$cou->field('c.*,sc.StuNo')->alias('c')->join("LEFT JOIN __STUCOU__ as sc on sc.CouNo = c.CouNo and sc.StuNo = '".$stuno."'")->order('CouNo')->limit($p->firstRow, $p->listRows)->select();
        // var_dump($coulist);exit;
        $this->assign('list', $coulist); // 赋值数据集
        $this->assign('page', $p->show()); // 赋值分页输出
        $this->display();
    }

    //选择课程
    public function choseCourseDo(){
        $couno=I('get.CouNo');
        // echo $couno;exit;
        $stuno=session('StuNo');
        // echo $stuno;exit;

        //判断所选课条件是否满足
        $StuNo['StuNo']=$stuno;
        $Stu=M("stucou")->where($StuNo)->select();
        $CouNo['CouNo']=$couno;
        $ChooseNum=M("course")->where($CouNo)->find();
        $stuCourse;

        //找出对应编号学生已选课程
        for($i=0;$i<count($Stu);$i++){
            $Cou['CouNo']=$Stu[$i]['couno'];
            $schooltime=M('course')->where($Cou)->find();
            $stuCourse[$i]['SchoolTime']=$schooltime['schooltime'];
            // echo $stuCourse[$i]['SchoolTime'];exit;
            
        }
        // echo count($stuCourse);exit;


        //判断是否时间冲突
        for($i=0;$i<count($stuCourse);$i++){
            if($ChooseNum['schooltime'] == $stuCourse[$i]['SchoolTime']){

                $this->error('上课时间冲突，选课失败！');
            }
        }
        

        
        
        if($ChooseNum['choosenum'] >= $ChooseNum['limitnum']){
            $this->error('人数已满，选课失败！');
        }
        else{
            //若选课成功，选课人数+1
            $Ch=M("course");
            $Ch->where("CouNo=$couno")->setInc('ChooseNum',1);
        }

        //选课列表增加
        $data['StuNo']=$stuno;
        $data['CouNo']=$couno;
        M('stucou')->add($data);

        $this->success('选课成功！');
    }

    //显示已选课程
    public function courseList(){
        $StuNo['StuNo']=$_SESSION['StuNo'];
        // echo $_SESSION['StuNo'];exit;
        $stu = M('stucou')->where($StuNo)->select();
        // var_dump($stu);exit;
        $stuCourse;
        for($i=0;$i<count($stu);$i++){
            $Cou['CouNo']=$stu[$i]['couno'];
            $coulist = M('course')->where($Cou)->find();
            // var_dump($coulist);exit;
            $stuCourse[$i]['CouNo']=$coulist['couno'];
            $stuCourse[$i]['CouName']=$coulist['couname'];
            $stuCourse[$i]['TeaName']=$coulist['teaname'];
            $stuCourse[$i]['SchoolTime']=$coulist['schooltime'];
            $stuCourse[$i]['Location']=$coulist['location'];
            $stuCourse[$i]['Credit']=$coulist['credit'];
            $stuCourse[$i]['ClassHour']=$coulist['classhour'];
            $stuCourse[$i]['ExpHour']=$coulist['exphour'];
            $stuCourse[$i]['ChooseNum']=$coulist['choosenum'];
            $stuCourse[$i]['LimitNum']=$coulist['limitnum'];
        }
        $this->assign('list',$stuCourse);
        $this->display();
    }

    //删除已选课程
    public function delete(){
        $CouNo=I('get.CouNo');
        $cou['StuNo']=$_SESSION['StuNo'];
        $cou['CouNo']=$CouNo;
        $mod=D('Stucou')->where($cou)->delete();

        //选课人数-1
        $Couno['CouNo']=$CouNo;
        $ChooseNum=M("course")->where($Couno)->find();
        // var_dump($ChooseNum);exit;
        $Ch=M("course");    
        $Ch->where("CouNo=$Couno[CouNo]")->setDec('ChooseNum',1);

        $this->success('已选课程删除成功！',U('/Home/Student/courseList'));
    }


    //编辑学生
    //传递此学生参数
    public function stuedit_do(){
        $StuNo=$_POST['StuNo'];

        $Student['StuNo']=$StuNo;
        $studentInfo=M('student')->where($Student)->find();
        $Major['CollegeNo']=$studentInfo['collegeno'];
        $MajorInfo=M('major')->where($Major)->find();
        session('editStuNo',$studentInfo['stuno']);
        session('editStuName',$studentInfo['stuname']);
        session('editMajorName',$MajorInfo['majorname']);
        session('editPwd',$studentInfo['pwd']);
        session('editSex',$studentInfo['sex']);

        $this->success('正在跳转！',U('/Home/Student/stuedit'));
    }
    //显示默认学生参数
    public function stuedit(){
        $this->display();
    }
    //修改提交新参数并跳转
    public function stuedit_edit(){
        $editstudent = M("student"); 
        // 要修改的数据对象属性赋值
        $data['StuNo'] = $_POST["StuNo"];
        $data['StuName'] = $_POST["StuName"];
        $data['CollegeNo'] = $_POST["CollegeNo"];
        $data['MajorName'] = $_POST["MajorName"];
        $data['Pwd'] = $_POST["Pwd"];
        $data['Sex'] = $_POST["Sex"];
        $StuNo['StuNo']=$_SESSION["StuNo"];
        $editstudent->where($StuNo)->save($data); // 根据条件保存修改的数据

        $Student['StuNo'] = $_POST["StuNo"];
        M('stucou')->where($StuNo)->save($Student);

        if(!$editstudent){
            $this->error('信息修改失败！');
        }
        else{
            $this->success('信息修改成功！',U('/Home/Index/index'));
        }
	}
}
?>






