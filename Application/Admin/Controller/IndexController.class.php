<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
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

    	$user=M('user');
    	$order=M('order');
    	$item=M('item');
    	$this->assign('ItemCount',$item->Count());
    	$this->assign('OrderCount',$order->Count());
    	$this->assign('UserCount',$user->Count());
        $this->display();
    }
}