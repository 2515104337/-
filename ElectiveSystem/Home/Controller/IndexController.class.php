<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
	//显示登录界面
    public function index(){
        $this->display();
    }
    //登录验证
	public function checkLogin(){
	    //获取输入的值
		$username = trim(I("post.username"));
		$pwd =trim(I("post.password"));
		$usertype =trim(I("post.role"));

		//判断是否输入用户名密码
		if(!$username){
		    $this->error('请输入用户名！');
		}
        if(!$pwd){
            $this->error('请输入密码!');
        }

        //学生
        if($usertype =='student'){
            //查询条件获取
            $condition['StuNo']=$username;
          

            // var_dump($condition);exit;

            //查询学生信息
            $userinfo=array();
            $userinfo =D('student')->where($condition)->find();
            // var_dump($userinfo);exit;
            // echo $userinfo['pwd'];exit;

            //与数据库中的信息进行验证
            if(!$userinfo){
                $this->error('用户不存在');
            }else{
                if($userinfo['pwd']===$pwd){ 
                    $College['CollegeNo']=$userinfo['collegeno'];
                $collegeInfo=M('college')->where($College)->find();
                $Major['collegeno']=$College['collegeno'];
                $MajorInfo=M('major')->where($Major)->find();
                
                //保存此学生信息
                session('role',$userinfo['student']);
                session('StuNo',$userinfo['stuno']);
                session('StuName',$userinfo['stuname']);
                session('CollegeNo',$userinfo['collegeno']);
                session('MajorName',$MajorInfo['majorname']);
                session('CollegeName',$collegeInfo['collegename']);
                session('Pwd',$userinfo['pwd']);
                session('Sex',$userinfo['sex']);
                $this->success('登录成功',U('/Home/Student/index'));

                }else{
                 $this->error('用户密码错误');

              }
            }
            
        }

        //老师
        if($usertype =='teacher'){
            //查询条件
            $condition['TeaNo']=$username;
          

            //查询数据
            $userinfo = D('teacher')->where($condition)->find();
            if(!$userinfo){
                $this->error('用户不存在');
            }else{
                if($userinfo['pwd']===$pwd){
                $College['CollegeNo']=$userinfo['collegeno'];
                $collegeInfo=M('college')->where($College)->find();

                session('role',$userinfo['teacher']);
                session('TeaNo',$userinfo['teano']);
                session('TeaName',$userinfo['teaname']);
                session('CollegeNo',$userinfo['collegeno']);
                session('CollegeName',$collegeInfo['collegename']);
                session('Pwd',$userinfo['pwd']);
                session('Sex',$userinfo['sex']);
                session('Introduction',$userinfo['introduction']);
                $this->success('登录成功',U('/Home/Teacher/index'));

                }else{
                    $this->error('用户密码错误');
                }

            }
            
        }

        //管理员

        if($usertype == 'manager'){
            $manager = M('manager');

            //查询条件
            $condition['ManNo']=$username;
            // $condition['Pwd']=$pwd;
            //查询数据
            $userinfo = $manager->where($condition)->find();
            // var_dump($userinfo);exit;
            // echo var_dump();exit;
            if(!$userinfo){           
                $this->error('用户不存在');
            }else{
                if($pwd===$userinfo['pwd']){ 
                session('rol',$userinfo['manger']);
                session('ManNo',$userinfo['manno']);
                session('ManName',$userinfo['manname']);
                session('Pwd',$userinfo['pwd']);
                $this->success('登陆成功',U('/Home/Manager/index'));            
            }else{
                $this->error('用户密码错误');
            }
          }
        }

    }
}

