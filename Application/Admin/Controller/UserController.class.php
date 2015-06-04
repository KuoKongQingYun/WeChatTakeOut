<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	private function auth()
	{
		$admin=M('admin');
		$currentAdmin=$admin->where(array('id'=>I('cookie.adminID')))->find();
		if($currentAdmin['auth']=='' || $currentAdmin['auth']!=I('cookie.auth'))
		{
			$this->redirect('Login/index');
		}
	}
	public function index(){
		$this->auth();
		if(IS_POST)
		{
			$user->where(array('id' =>I('cookie.adminid')))->field('password')->save(array('password'=>md5(md5(I('newpasswd')))));
			$this->assign('info','修改密码成功');
		}
		$this->display();
	}
}