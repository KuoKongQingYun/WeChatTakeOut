<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index()
	{
		$this->display();
	}
	public function dologin()
	{
		$admin = D('admin');
		$currentAdmin = $admin->where(array('username'=>I('username'),'password'=>md5(md5(I('password')))))->find();
		if(!is_null($currentAdmin))
		{
			cookie('adminID',$currentAdmin['id']);
			$string=new \Org\Util\String();
			$randString=$string->buildFormatRand('****************');
			cookie('auth',md5($randString));
			$admin->where(array('id'=>$currentAdmin['id']))->field('auth')->save(array('auth'=>md5($randString)));
			$this->redirect('Index/index');
		}
		else
		{
			$this->redirect('index');
		}
	}
}