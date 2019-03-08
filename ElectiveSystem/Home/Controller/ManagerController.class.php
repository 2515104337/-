<?php
namespace Home\Controller;
use Think\Controller;
class ManagerController extends Controller{
    public function index(){
	    $this->display();
	}

    //添加学生信息
    public function stuadd(){
        $this->display();
    }
    public function stuadd_do(){
        $stu=D('student');
        $res=$stu->create($_POST,1);
        if(!$res){
            $this->error($stu->getError());
        }
        $stu->StuNo=$_SESSION['StuNo'];
        $re=$stu->add($res);
        
        // var_dump($res);exit;
        

        


        if(!$re){
            $this->error('学生信息添加失败！');
        }
        else{
            $this->success('学生信息添加成功！',U('/Home/Manager/stulist'));
        }
    }
    //批量添加学生信息
    public function upload(){
        ini_set('memory_limit','1024M');
        if (!empty($_FILES)) {
            $config = array(
            'exts' => array('xlsx','xls'),
            'maxSize' => 314572,
            'rootPath' =>"./Home/",
            'savePath' => 'Uploads/',
            'subName' => array('date','Ymd'),
           );
          $upload = new \Think\Upload($config);
          if (!$info = $upload->upload()) {
               $this->error($upload->getError());

            }
          vendor("PHPExcel.PHPExcel");
          $file_name=$upload->rootPath.$info['excel']['savepath'].$info['excel']['savename'];
          $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
          if ($extension == 'xlsx') {
             $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
             $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls'){
                   $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                   $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            }
         $sheet =$objPHPExcel->getSheet(0);
         $highestRow = $sheet->getHighestRow();//取得总行数
         $highestColumn =$sheet->getHighestColumn(); //取得总列数
         //根据总列数来判断是学生还是老师
         if($highestColumn=='F'){
         for ($i = 2; $i <= $highestRow; $i++) {
    //前面小写的a是表中的字段名，后面的大写A是excel中位置
        $data['StuNo'] =(string)($objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue());
        $data['StuName'] =(string)($objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue());
        $data['Pwd'] =(string)($objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue());
        $data['CollegeNo'] = (string)($objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue());
        $data['MajorName'] = (string)($objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue());
        $data['Sex'] = (string)($objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue());
        
        $stu=D('student');

        $res=$stu->add($data);
        }
        if(!$res){
            $this->error('批量导入学生信息失败！');
        }else{

            $this->success('批量学生信息添加成功！',U('/Home/Manager/stulist'));
          }
        }
        if($highestColumn=='G'){
         for ($i = 2; $i <= $highestRow; $i++) {
    //前面小写的a是表中的字段名，后面的大写A是excel中位置
        $data['TeaNo'] =(string)($objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue());
        $data['TeaName'] =(string)($objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue());
        $data['Pwd'] =(string)($objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue());
        $data['CollegeNo'] = (string)($objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue());
        $data['CollegeName'] = (string)($objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue());
        $data['Introduction'] = (string)($objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue());
        $data['Sex'] = (string)($objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue());
        $tea=D('teacher');

        $res=$tea->add($data);
        }
        if(!$res){
            $this->error('批量导入老师信息失败！');
        }else{

            $this->success('批量老师信息添加成功！',U('/Home/Manager/tealist'));
          }
        }
      }
    }
    //分页列表学生信息
    public function  stulist(){
    $stu = M('student');
   
    $count = $stu->count();
    // echo $count;exit;
    $p = getpage($count,20);
    $list = $stu->field(true)->order('StuNo')->limit($p->firstRow, $p->listRows)->select();
    $this->assign('list', $list); // 赋值数据集
    $this->assign('page', $p->show()); // 赋值分页输出
    $this->display();
    }
    

    //显示学生信息
    // public function stulist(){
    //     $stu = M('student');
    //     $where['StuNo']=$_SESSION['StuNo'];
    //     $stulist = $stu->order('StuNo asc')->select();
    //     $this->assign('list',$stulist);
    //     $this->display();
    // }

    //编辑学生
    //传递此学生参数
    public function stuedit_do(){
        $StuNo=$_POST['StuNo'];

        $Student['StuNo']=$StuNo;
        $studentInfo=M('student')->where($Student)->find();
        $Major['CollegeNo']=$studentInfo['collegeno'];
        $majorInfo=M('major')->where($Major)->find();
        session('editStuNo',$studentInfo['stuno']);
        session('editStuName',$studentInfo['stuname']);
        session('editCollegeNo',$studentInfo['collegeno']);
        session('editMajorName',$majorInfo['majorname']);
        session('editPwd',$studentInfo['pwd']);
        session('editSex',$studentInfo['sex']);


        $this->success('正在跳转！',U('/Home/Manager/stuedit'));
    }
    //显示默认学生参数
    public function stuedit(){
        $this->display();
    }
    //修改提交新参数并跳转
    public function stuedit_edit(){
        $editstudent = M("student"); // 实例化User对象
        // 要修改的数据对象属性赋值
        $data['StuNo'] = $_POST["StuNo"];
        $data['StuName'] = $_POST["StuName"];
        $data['CollegeNo'] = $_POST["CollegeNo"];
        $data['MajorName'] = $_POST["MajorName"];
        $data['Pwd'] = $_POST["Pwd"];
        $data['Sex'] = $_POST["Sex"];
        $StuNo['StuNo']=$_POST["StuNo"];
        $editstudent->where($CouNo)->save($data); // 根据条件保存修改的数据

        if(!$editstudent){
            $this->error('学生信息修改失败！');
        }
        else{
            $this->success('学生信息修改成功！',U('/Home/Manager/stulist'));
        }
	}

    //删除学生信息
    public function deleteStudent(){
        $StuNo=I('get.StuNo');
        $mod=M('student')->where("StuNo = '$StuNo' ")->delete();
        if (!$mod){
            $this->error('删除学生信息失败！');
         }
        else{
            $this->success('删除学生信息成功！',U('/Home/Manager/stulist'));
        }
    }



    //添加老师信息
    public function teaadd(){
        $this->display();
    }
    public function teaadd_do(){
        $tea=D('Teacher');
        $res=$tea->create($_POST,1);
        if(!$res){
            $this->error($tea->getError());
        }
        $tea->TeaNo=$_SESSION['TeaNo'];
        $re=$tea->add($res);

        if(!$re){
            $this->error('老师信息添加失败！');
        }
        else{
            $this->success('老师信息添加成功！',U('/Home/Manager/tealist'));
        }
    }
    


    //分页显示老师信息
    public function  tealist(){
    $tea = M('teacher');
    $count = $tea->count();
    $p = getpage($count,10);
    $list = $tea->field(true)->order('TeaNo')->limit($p->firstRow, $p->listRows)->select();
    $this->assign('list', $list); // 赋值数据集
    $this->assign('page', $p->show()); // 赋值分页输出
    $this->display();
    }
    // public function tealist(){
    //     $tea = M('teacher');
    //     $where['TeaNo']=$_SESSION['TeaNo'];
    //     $tealist = $tea->order('TeaNo asc')->select();
    //     $this->assign('list',$tealist);
    //     $this->display();
    // }

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

        $this->success('正在跳转！',U('/Home/Manager/teaedit'));
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
        $TeaNo['TeaNo']=$_POST["TeaNo"];
         // echo $editteacher->fetchsql(true)->where($TeaNo)->save($data);exit;
        $editteacher->where($TeaNo)->save($data); // 根据条件保存修改的数据

        if(!$editteacher){
            $this->error('老师信息修改失败！');
        }
        else{
            $this->success('老师信息修改成功！',U('/Home/Manager/tealist'));
        }
	}

    //删除老师信息
    public function deleteTeacher(){
        $TeaNo=I('get.TeaNo');
        $mod=M('teacher')->where("TeaNo = '$TeaNo' ")->delete();
        if (!$mod){
            $this->error('删除老师信息失败！');
         }
        else{
            $this->success('删除老师信息成功！',U('/Home/Manager/tealist'));
        }
    }


    //编辑管理员
    //传递此管理员参数
    public function manedit_do(){
        $ManNo=$_POST['ManNo'];
        // echo $ManNo;exit;

        $Manager['ManNo']=$ManNo;
        $managerInfo=M('manager')->where($Manager)->find();
        session('editManNo',$managerInfo['manno']);
        session('editManName',$managerInfo['manname']);
        session('editPwd',$managerInfo['pwd']);

        $this->success('正在跳转！',U('/Home/Manager/manedit'));
    }
    //显示默认老师参数
    public function manedit(){
        $this->display();
    }
    //修改提交新参数并跳转
    public function manedit_edit(){
        $editmanager = M("manager"); // 实例化User对象
        // 要修改的数据对象属性赋值
        $data['ManNo'] = $_POST["ManNo"];
        $data['ManName'] = $_POST["ManName"];
        $data['Pwd'] = $_POST["Pwd"];
        $ManNo['ManNo']=$_SESSION["ManNo"];
        $editmanager->where($ManNo)->save($data); // 根据条件保存修改的数据

        if(!$editmanager){
            $this->error('信息修改失败！');
        }
        else{
            $this->success('信息修改成功！',U('/Home/Index/index'));
        }
    }
}
?>