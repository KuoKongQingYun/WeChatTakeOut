<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
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

        $order=M('order');
		$selectOrder=$order->order('id')->select();

		foreach ($selectOrder as &$value) {
			$user=M('user');
			$findUser=$user->where(array('id'=>$value['user_id']))->find();
			$value['name']=$findUser['name'];
			$value['address']=$findUser['address'];
			$value['phone']=$findUser['phone'];
		}

		$this->assign('orderList',$selectOrder);
		$this->display();
    }
    public function del(){
		$this->auth();

        $order=M('order');
		$order->where(array('id'=>I('id')))->delete();

		$this->redirect('index');
    }
    public function view(){
		$this->auth();

        $order=M('order');
		$findOder=$order->where(array('id'=>I('id')))->find();

		$user=M('user');
		$findUser=$user->where(array('id'=>$findOder['user_id']))->find();

		$this->assign('id',$findOder['id']);
		$this->assign('content',$findOder['content']);
		$this->assign('name',$findUser['name']);
		$this->assign('address',$findUser['address']);
		$this->assign('phone',$findUser['phone']);

		$this->display();
    }
    public function conform(){
    	$this->auth();

        $order=M('order');
		$findOder=$order->where(array('id'=>I('id')))->field('status')->save(array('status'=>'1'));

		$this->redirect('index');
    }
}