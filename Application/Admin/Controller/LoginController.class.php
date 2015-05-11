<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index($backurl='.')
	{
		$this->success('新增成功', $backurl);
	}
	public function dologin($backurl='.')
	{
		setcookie("userid",123);
	}
}