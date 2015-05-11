<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index($backurl='.')
	{
		$this->show();
	}

	public function dologin()
	{
		$Admin = D('Admin');
		if (!$Admin->create())
		{
			$this->error($Admin->getError());
		}
		else{
			$this->success("123",U("Index/index"));
			//$this->success('新增成功', 'Index/Index');
		}
	}
}