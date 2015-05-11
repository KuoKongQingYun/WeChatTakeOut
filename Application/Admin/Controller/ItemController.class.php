<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index($backurl='.')
	{
		$this->show();
	}
	public function dologin($backurl='.')
	{
		//$a = array('abc' => '123','efg'=>'456' );
		setcookie("userid1","456");
		$this->show("123");
	}
}